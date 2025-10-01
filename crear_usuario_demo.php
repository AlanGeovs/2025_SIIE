<?php
require_once __DIR__ . '/config/db.php';

$nombre = "Admin SIA";
$correo = "admin@sia.mx";
$passwordPlano = "demo";
$tipo = "admin";

$passwordHash = password_hash($passwordPlano, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, password, tipo_usuario) VALUES (?, ?, ?, ?)");
$stmt->execute([$nombre, $correo, $passwordHash, $tipo]);

echo "Usuario creado con contraseña 'demo'.<br>";
echo "Hash generado: <br><code>$passwordHash</code>";
