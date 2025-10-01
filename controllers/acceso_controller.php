<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../lib/wp-password.php';

$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

if (!$correo || !$password) {
    header('Location: /login?error=Faltan datos');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);



    $esValida = false;

    if ($usuario) {
        // Verifica si la contraseña coincide con la encriptación moderna
        if (password_verify($password, $usuario['password'])) {
            $esValida = true;
        } elseif (function_exists('wp_check_password') && wp_check_password($password, $usuario['password'])) {
            // Si es una contraseña de WordPress válida, actualiza a formato moderno
            $nuevoHash = password_hash($password, PASSWORD_DEFAULT);
            $updateStmt = $pdo->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
            $updateStmt->execute([$nuevoHash, $usuario['id']]);
            $esValida = true;
        }
    }

    if ($esValida) {
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['nombre'] = $usuario['nombre'] ?? $usuario['nombres'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'] ?? 'capturista';
        header('Location: /dashboard');
    } else {
        header('Location: /acceso?error=Correo o contraseña incorrectos');
    }
} catch (PDOException $e) {
    header('Location: /acceso?error=Error en base de datos');
}
