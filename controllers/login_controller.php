<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/session.php';

session_start();

$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

if (!$correo || !$password) {
    header('Location: /login/?error=Faltan datos');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ? AND activo = 1 LIMIT 1");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['nombre'] = $usuario['nombres'];
        $_SESSION['apellido_p'] = $usuario['apellido_p'];
        $_SESSION['apellido_m'] = $usuario['apellido_m'];
        $_SESSION['cct'] = $usuario['cct'];
        $_SESSION['id_ficha'] = $usuario['id_ficha'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'] ?? 'capturista';

        header('Location: /dashboard');
        exit;
    } else {
        header('Location: /login/?error=Correo o contraseña incorrectos');
        exit;
    }
} catch (PDOException $e) {
    header('Location: /login/?error=Error en base de datos');
    exit;
}
