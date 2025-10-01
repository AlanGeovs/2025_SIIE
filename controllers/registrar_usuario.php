<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/session.php';

global $pdo;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    // $input = $_POST;
    $correo = trim($input['correo'] ?? '');
    $password = trim($input['contrasena'] ?? '');
    $confirmar = trim($input['confirmar'] ?? $password);
    $nombres = trim($input['nombres'] ?? '');
    $apellido_p = trim($input['apellido_p'] ?? '');
    $apellido_m = trim($input['apellido_m'] ?? '');
    $telefono_fijo = trim($input['telefono_fijo'] ?? '');
    $telefono_movil = trim($input['telefono_movil'] ?? '');

    error_log("Correo recibido: '$correo'");
    if (!$correo || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Correo electrónico inválido o vacío.']);
        exit;
    }

    if (strlen($password) < 4) {
        echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 6 caracteres.']);
        exit;
    }

    if ($password !== $confirmar) {
        echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    try {
        $conn = $pdo;

        // Validar si ya existe el correo
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'El correo ya está registrado.']);
            exit;
        }

        // Encriptar la contraseña
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar en la base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password, nombres, apellido_p, apellido_m, telefono_fijo, telefono_movil, tipo_usuario, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $nombre_completo = "$nombres $apellido_p $apellido_m";
        $stmt->execute([
            $nombre_completo,
            $correo,
            $hash,
            $nombres,
            $apellido_p,
            $apellido_m,
            (int) $telefono_fijo,
            (int) $telefono_movil,
            'capturista',
            1
        ]);

        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al registrar: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
