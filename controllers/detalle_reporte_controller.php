<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_GET['action'] === 'eliminar' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt1 = $pdo->prepare("DELETE FROM detalle_areas_principales WHERE id_siniestro = ?");
    $stmt2 = $pdo->prepare("DELETE FROM detalle_areas_comunes WHERE id_siniestro = ?");
    $stmt3 = $pdo->prepare("DELETE FROM detalle_areas_adicionales WHERE id_siniestro = ?");
    $stmt4 = $pdo->prepare("DELETE FROM detalle_elementos WHERE id_siniestro = ?");
    $stmt5 = $pdo->prepare("DELETE FROM detalle_equipo WHERE id_siniestro = ?");
    $stmt6 = $pdo->prepare("DELETE FROM detalle_mobiliario WHERE id_siniestro = ?");
    $stmt7 = $pdo->prepare("DELETE FROM siniestros WHERE id = ?");

    $stmt1->execute([$id]);
    $stmt2->execute([$id]);
    $stmt3->execute([$id]);
    $stmt4->execute([$id]);
    $stmt5->execute([$id]);
    $stmt6->execute([$id]);
    $stmt7->execute([$id]);

    // Redirigir de vuelta a la vista
    header("Location: ../views/lista_reportes.php");
    exit();
}
