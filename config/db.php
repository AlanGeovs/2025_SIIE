<?php
// config/db.php

$host = 'localhost';
$dbname = 'dbc3mttmeow4pj';
$username = 'ueewddazigcq2';
$password = 'ta4tsruzphpx';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Opciones seguras
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit;
}
