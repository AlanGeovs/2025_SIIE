<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}



try {
    // Requeridos
    $cct =          $_SESSION['cct'] ?? '';
    $id_usuario =   $_SESSION['usuario_id'] ?? 0;
    $id_ficha =     $_SESSION['id_ficha'] ?? 0;

    // Campos del módulo 6
    $documento_propiedad = $_POST['documento-propiedad'] ?? null;
    $tipo_documento = $_POST['tipo-documento'] ?? null;
    $plano_arquitectonico = $_POST['plano_arquitectonico'] ?? null;
    $plano_estructural = $_POST['plano_estructural'] ?? null;
    $plano_instalacion = $_POST['plano_instalacion'] ?? null;
    $plano_proteccion_civil = $_POST['plano_proteccion_civil'] ?? null;
    $plano_topografico = $_POST['plano_topografico'] ?? null;
    $plano_accesibilidad = $_POST['plano_accesibilidad'] ?? null;
    $plano_senalizacion = $_POST['plano_senalizacion'] ?? null;
    $plano_areas_verdes = $_POST['plano_areas_verdes'] ?? null;
    $plano_mobiliario_equipamiento = $_POST['plano_mobiliario_equipamiento'] ?? null;
    $plano_zonificacion = $_POST['plano_zonificacion_uso_espacios'] ?? null;

    // if (empty($cct) || empty($id_usuario) || empty($id_ficha)) {
    //     echo json_encode(['success' => false, 'message' => 'Faltan parámetros obligatorios']);
    //     exit;
    // }

    // Verificar si ya existe registro
    $stmt = $pdo->prepare("SELECT id_modulo6 FROM modulo6 WHERE id_ficha = :id_ficha");
    $stmt->execute([':id_ficha' => $id_ficha]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        $sql = "UPDATE modulo6 
                   SET cct = :cct,
                       documento_propiedad = :documento_propiedad,
                       tipo_documento = :tipo_documento,
                       plano_arquitectonico = :plano_arquitectonico,
                       plano_estructural = :plano_estructural,
                       plano_instalacion = :plano_instalacion,
                       plano_proteccion_civil = :plano_proteccion_civil,
                       plano_topografico = :plano_topografico,
                       plano_accesibilidad = :plano_accesibilidad,
                       plano_senalizacion = :plano_senalizacion,
                       plano_areas_verdes = :plano_areas_verdes,
                       plano_mobiliario_equipamiento = :plano_mobiliario_equipamiento,
                       plano_zonificacion = :plano_zonificacion,
                       id_usuario = :id_usuario
                 WHERE id_ficha = :id_ficha";
    } else {
        $sql = "INSERT INTO modulo6 (
                    id_ficha, cct, documento_propiedad, tipo_documento,
                    plano_arquitectonico, plano_estructural, plano_instalacion,
                    plano_proteccion_civil, plano_topografico, plano_accesibilidad,
                    plano_senalizacion, plano_areas_verdes, plano_mobiliario_equipamiento,
                    plano_zonificacion, id_usuario
                ) VALUES (
                    :id_ficha, :cct, :documento_propiedad, :tipo_documento,
                    :plano_arquitectonico, :plano_estructural, :plano_instalacion,
                    :plano_proteccion_civil, :plano_topografico, :plano_accesibilidad,
                    :plano_senalizacion, :plano_areas_verdes, :plano_mobiliario_equipamiento,
                    :plano_zonificacion, :id_usuario
                )";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_ficha' => $id_ficha,
        ':cct' => $cct,
        ':documento_propiedad' => $documento_propiedad,
        ':tipo_documento' => $tipo_documento,
        ':plano_arquitectonico' => $plano_arquitectonico,
        ':plano_estructural' => $plano_estructural,
        ':plano_instalacion' => $plano_instalacion,
        ':plano_proteccion_civil' => $plano_proteccion_civil,
        ':plano_topografico' => $plano_topografico,
        ':plano_accesibilidad' => $plano_accesibilidad,
        ':plano_senalizacion' => $plano_senalizacion,
        ':plano_areas_verdes' => $plano_areas_verdes,
        ':plano_mobiliario_equipamiento' => $plano_mobiliario_equipamiento,
        ':plano_zonificacion' => $plano_zonificacion,
        ':id_usuario' => $id_usuario
    ]);

    $stmt = $pdo->prepare("UPDATE fichas SET m6 = 1 WHERE id_ficha = :id_ficha");
    $stmt->execute([':id_ficha' => $id_ficha]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
