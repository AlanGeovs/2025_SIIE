<?php

header('Content-Type: application/json');
require_once '../config/db.php';
// global $pdo;

$input = $_POST;
$token = trim($input['token'] ?? '');
$new_password = trim($input['password'] ?? '');
$confirm_password = trim($input['confirm_password'] ?? '');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

if (!$token || !$new_password || !$confirm_password) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

if ($new_password !== $confirm_password) {
    echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden.']);
    exit;
}

// Verifica token y expira en menos de 1 hora
try {
    $stmt = $pdo->prepare("SELECT id, token_expira FROM usuarios WHERE reset_token = ?");
    $stmt->execute([$token]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo json_encode(['success' => false, 'message' => 'Token inválido.']);
        exit;
    }

    if (strtotime($usuario['token_expira']) < time()) {
        echo json_encode(['success' => false, 'message' => 'El token ha expirado.']);
        exit;
    }

    $hash = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE usuarios SET password = ?, reset_token = NULL, token_expira = NULL WHERE id = ?");
    $stmt->execute([$hash, $usuario['id']]);

    echo json_encode(['success' => true, 'message' => 'Contraseña actualizada correctamente.']);
    exit;
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en el servidor.', 'error' => $e->getMessage()]);
    exit;
}
