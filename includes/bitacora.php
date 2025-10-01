<?php


function registrarBitacora($pdo, $id_usuario, $accion)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO bitacora (id_usuario, accion) VALUES (?, ?)");
        $stmt->execute([$id_usuario, $accion]);
    } catch (PDOException $e) {
        error_log("Error al registrar bitácora: " . $e->getMessage());
    }
}
