<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php';

try {
    $cct =          $_SESSION['cct'] ?? '';
    $id_usuario =   $_SESSION['usuario_id'] ?? 0;
    $id_ficha =     $_SESSION['id_ficha'] ?? 0;

    // Retrieve POST data for modulo 2 general responses (real columns)
    $accesibilidad = isset($_POST['accesibilidad']) ? $_POST['accesibilidad'] : null;
    $red_hidraulica = isset($_POST['red_hidraulica']) ? $_POST['red_hidraulica'] : null;
    $condicion_red_hidraulica = isset($_POST['condicion_red_hidraulica']) ? $_POST['condicion_red_hidraulica'] : null;
    $red_hidraulica_int = isset($_POST['red_hidraulica_int']) ? $_POST['red_hidraulica_int'] : null;
    $condicion_red_interna = isset($_POST['condicion_red_interna']) ? $_POST['condicion_red_interna'] : null;
    $tipo_suministro_agua = isset($_POST['tipo_suministro_agua']) ? $_POST['tipo_suministro_agua'] : null;
    $descarga_sanitaria = isset($_POST['descarga_sanitaria']) ? $_POST['descarga_sanitaria'] : null;
    $condicion_descarga_sanitaria = isset($_POST['condicion_descarga_sanitaria']) ? $_POST['condicion_descarga_sanitaria'] : null;
    $gestion_basura = isset($_POST['gestion_basura']) ? $_POST['gestion_basura'] : null;
    $condicion_gestion_basura = isset($_POST['condicion_gestion_basura']) ? $_POST['condicion_gestion_basura'] : null;
    $suministro_energia = isset($_POST['suministro_energia']) ? $_POST['suministro_energia'] : null;
    $condicion_suministro_energia = isset($_POST['condicion_suministro_energia']) ? $_POST['condicion_suministro_energia'] : null;
    $suministro_gas = isset($_POST['suministro_gas']) ? $_POST['suministro_gas'] : null;
    $tipo_almacenamiento_gas = isset($_POST['tipo_almacenamiento_gas']) ? $_POST['tipo_almacenamiento_gas'] : null;
    $condicion_suministro_gas = isset($_POST['condicion_suministro_gas']) ? $_POST['condicion_suministro_gas'] : null;

    // Insert or update main modulo2 record with real columns
    $sql_main = "INSERT INTO modulo2 (
        id_ficha, cct, accesibilidad, red_hidraulica, condicion_red_hidraulica, red_hidraulica_int, condicion_red_interna,
        tipo_suministro_agua, descarga_sanitaria, condicion_descarga_sanitaria, gestion_basura, condicion_gestion_basura,
        suministro_energia, condicion_suministro_energia, suministro_gas, tipo_almacenamiento_gas, condicion_suministro_gas, id_usuario
    ) VALUES (
        :id_ficha, :cct, :accesibilidad, :red_hidraulica, :condicion_red_hidraulica, :red_hidraulica_int, :condicion_red_interna,
        :tipo_suministro_agua, :descarga_sanitaria, :condicion_descarga_sanitaria, :gestion_basura, :condicion_gestion_basura,
        :suministro_energia, :condicion_suministro_energia, :suministro_gas, :tipo_almacenamiento_gas, :condicion_suministro_gas, :id_usuario
    )
    ON DUPLICATE KEY UPDATE
        accesibilidad = VALUES(accesibilidad),
        red_hidraulica = VALUES(red_hidraulica),
        condicion_red_hidraulica = VALUES(condicion_red_hidraulica),
        red_hidraulica_int = VALUES(red_hidraulica_int),
        condicion_red_interna = VALUES(condicion_red_interna),
        tipo_suministro_agua = VALUES(tipo_suministro_agua),
        descarga_sanitaria = VALUES(descarga_sanitaria),
        condicion_descarga_sanitaria = VALUES(condicion_descarga_sanitaria),
        gestion_basura = VALUES(gestion_basura),
        condicion_gestion_basura = VALUES(condicion_gestion_basura),
        suministro_energia = VALUES(suministro_energia),
        condicion_suministro_energia = VALUES(condicion_suministro_energia),
        suministro_gas = VALUES(suministro_gas),
        tipo_almacenamiento_gas = VALUES(tipo_almacenamiento_gas),
        condicion_suministro_gas = VALUES(condicion_suministro_gas),
        id_usuario = VALUES(id_usuario)";

    $stmt_main = $pdo->prepare($sql_main);
    $stmt_main->execute([
        ':id_ficha' => $id_ficha,
        ':cct' => $cct,
        ':accesibilidad' => $accesibilidad,
        ':red_hidraulica' => $red_hidraulica,
        ':condicion_red_hidraulica' => $condicion_red_hidraulica,
        ':red_hidraulica_int' => $red_hidraulica_int,
        ':condicion_red_interna' => $condicion_red_interna,
        ':tipo_suministro_agua' => $tipo_suministro_agua,
        ':descarga_sanitaria' => $descarga_sanitaria,
        ':condicion_descarga_sanitaria' => $condicion_descarga_sanitaria,
        ':gestion_basura' => $gestion_basura,
        ':condicion_gestion_basura' => $condicion_gestion_basura,
        ':suministro_energia' => $suministro_energia,
        ':condicion_suministro_energia' => $condicion_suministro_energia,
        ':suministro_gas' => $suministro_gas,
        ':tipo_almacenamiento_gas' => $tipo_almacenamiento_gas,
        ':condicion_suministro_gas' => $condicion_suministro_gas,
        ':id_usuario' => $id_usuario
    ]);

    // Get id_modulo2 for foreign key references
    $id_modulo2 = $pdo->lastInsertId();
    if (!$id_modulo2) {
        // If lastInsertId returns 0, fetch id_modulo2 from existing record
        $stmt_id = $pdo->prepare("SELECT id_modulo2 FROM modulo2 WHERE id_ficha = :id_ficha AND cct = :cct");
        $stmt_id->execute([':id_ficha' => $id_ficha, ':cct' => $cct]);
        $id_modulo2 = $stmt_id->fetchColumn();
    }

    // Build almacenamiento array from flat POST keys
    $almacenamientos = [];
    $servicios_almacenamiento = ['agua', 'cisterna', 'pileta', 'tanque', 'tambo', 'tinaco'];
    foreach ($servicios_almacenamiento as $servicio) {
        $almacenamientos[] = [
            'servicio' => $servicio,
            'existencia' => $_POST["almacenamiento_{$servicio}_existencia"] ?? null,
            'cantidad' => $_POST["almacenamiento_{$servicio}_cantidad"] ?? null,
            'en_uso' => $_POST["almacenamiento_{$servicio}_en_uso"] ?? null,
            'condicion' => $_POST["almacenamiento_{$servicio}_condicion"] ?? null,
            'evidencia' => $_POST["almacenamiento_{$servicio}_evidencia"] ?? null,
        ];
    }

    // Handle modulo_2_almacenamiento_agua
    // First delete existing entries for this id_modulo2 to prevent duplicates
    $stmt_del_alm = $pdo->prepare("DELETE FROM modulo_2_almacenamiento_agua WHERE id_modulo2 = :id_modulo2");
    $stmt_del_alm->execute([':id_modulo2' => $id_modulo2]);

    $sql_alm = "INSERT INTO modulo_2_almacenamiento_agua (id_modulo2, id_ficha, cct, servicio, existencia, cantidad, en_uso, condicion, evidencia)
                VALUES (:id_modulo2, :id_ficha, :cct, :servicio, :existencia, :cantidad, :en_uso, :condicion, :evidencia)";
    $stmt_alm = $pdo->prepare($sql_alm);

    foreach ($almacenamientos as $alm) {
        if (isset($alm['existencia']) && strtoupper($alm['existencia']) === 'SI') {
            $stmt_alm->execute([
                ':id_modulo2' => $id_modulo2,
                ':id_ficha' => $id_ficha,
                ':cct' => $cct,
                ':servicio' => $alm['servicio'],
                ':existencia' => $alm['existencia'],
                ':cantidad' => $alm['cantidad'],
                ':en_uso' => $alm['en_uso'],
                ':condicion' => $alm['condicion'],
                ':evidencia' => $alm['evidencia']
            ]);
        }
    }

    // Build servicios_tics array from flat POST keys
    $servicios_tics = [];
    $servicios_tics_keys = ['antena', 'red', 'celular', 'internet', 'telefonia'];
    foreach ($servicios_tics_keys as $servicio_key) {
        $servicios_tics[] = [
            'servicio' => "tics_{$servicio_key}",
            'existencia' => $_POST["tics_{$servicio_key}_existencia"] ?? null,
            'cantidad' => $_POST["tics_{$servicio_key}_cantidad"] ?? null,
            'en_uso' => $_POST["tics_{$servicio_key}_en_uso"] ?? null,
            'condicion' => $_POST["tics_{$servicio_key}_condicion"] ?? null,
            'evidencia' => $_POST["tics_{$servicio_key}_evidencia"] ?? null,
        ];
    }

    // Handle modulo_2_servicios_tics
    // Delete existing entries first
    $stmt_del_serv = $pdo->prepare("DELETE FROM modulo_2_servicios_tics WHERE id_modulo2 = :id_modulo2");
    $stmt_del_serv->execute([':id_modulo2' => $id_modulo2]);

    $sql_serv = "INSERT INTO modulo_2_servicios_tics (id_modulo2, id_ficha, cct, servicio, existencia, cantidad, en_uso, condicion, evidencia)
                 VALUES (:id_modulo2, :id_ficha, :cct, :servicio, :existencia, :cantidad, :en_uso, :condicion, :evidencia)";
    $stmt_serv = $pdo->prepare($sql_serv);

    foreach ($servicios_tics as $serv) {
        if (isset($serv['existencia']) && strtoupper($serv['existencia']) === 'SI') {
            $stmt_serv->execute([
                ':id_modulo2' => $id_modulo2,
                ':id_ficha' => $id_ficha,
                ':cct' => $cct,
                ':servicio' => $serv['servicio'],
                ':existencia' => $serv['existencia'],
                ':cantidad' => $serv['cantidad'],
                ':en_uso' => $serv['en_uso'],
                ':condicion' => $serv['condicion'],
                ':evidencia' => $serv['evidencia']
            ]);
        }
    }

    echo json_encode(['success' => true, 'message' => 'Datos del módulo 2 guardados correctamente.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error al guardar los datos: ' . $e->getMessage()]);
}
?>
