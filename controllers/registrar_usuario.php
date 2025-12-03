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
    $nombres = mb_strtoupper(trim($input['nombres'] ?? ''), 'UTF-8');
    $apellido_p = mb_strtoupper(trim($input['apellido_p'] ?? ''), 'UTF-8');
    $apellido_m = mb_strtoupper(trim($input['apellido_m'] ?? ''), 'UTF-8');
    $telefono_fijo = trim($input['telefono_fijo'] ?? '');
    $telefono_movil = trim($input['telefono_movil'] ?? '');
    $cct = trim($input['cct'] ?? '');

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

        // Insertar en la base de datos (sin id_ficha por ahora)
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password, nombres, apellido_p, apellido_m, telefono_fijo, telefono_movil, tipo_usuario, activo, cct) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
            1,
            $cct
        ]);

        $user_id = $conn->lastInsertId();

        // Insertar en fichas con el CCT y el user_id
        $stmt = $conn->prepare("INSERT INTO fichas (cct, id_usuario) VALUES (?, ?)");
        $stmt->execute([$cct, $user_id]);

        $id_ficha = $conn->lastInsertId();

        // Actualizar usuario con id_ficha
        $stmt = $conn->prepare("UPDATE usuarios SET id_ficha = ? WHERE id = ?");
        $stmt->execute([$id_ficha, $user_id]);

        // Iniciar sesión automática
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $user_id;
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $nombres;
        $_SESSION['apellido_p'] = $apellido_p;
        $_SESSION['apellido_m'] = $apellido_m;
        $_SESSION['cct'] = $cct;
        $_SESSION['id_ficha'] = $id_ficha;
        $_SESSION['tipo_usuario'] = 'capturista';

        // Respuesta JSON
        echo json_encode(['success' => true, 'message' => 'Registro exitoso e inicio de sesión completado.']);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al registrar: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
