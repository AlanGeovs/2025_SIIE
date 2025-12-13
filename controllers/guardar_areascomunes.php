<?php
// guardar_areascomunes.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
session_start();

require_once __DIR__ . '/../config/db.php'; // Must provide $pdo (PDO instance)

try {
    // Read JSON payload
    $json = file_get_contents('php://input');
    if (!$json) {
        echo json_encode(['success' => false, 'message' => 'No se recibió información']);
        exit;
    }

    $data = json_decode($json, true);
    if (!is_array($data)) {
        echo json_encode(['success' => false, 'message' => 'Formato JSON inválido']);
        exit;
    }

    // data must be a non-empty array
    if (empty($data) || !is_array($data)) {
        echo json_encode(['success' => false, 'message' => 'No se recibieron áreas comunes']);
        exit;
    }

    // Retrieve user id from session
    $id_user = $_SESSION['usuario_id'] ?? null;
    if (!$id_user) {
        throw new Exception("No user in session");
    }

    // Begin transaction
    $pdo->beginTransaction();

    // Prepared Insert
    $stmt = $pdo->prepare("
        INSERT INTO datos_areascomunes
        (id_articulo, letra, existencia, cantidad, en_uso, condicion, dano_estructural, dano_instalacion,
         obra_proceso, construccion_adicional, id_user)
        VALUES
        (:id_articulo, :letra, :existencia, :cantidad, :en_uso, :condicion, :dano_estructural,
         :dano_instalacion, :obra_proceso, :construccion_adicional, :id_user)
    ");

    foreach ($data as $area) {

        // Validate id_articulo
        if (!isset($area['id_articulo'])) {
            throw new Exception("Falta id_articulo en un registro");
        }

        // Normalize values
        $letra = $area['letra'] ?? null;
        $existencia = $area['existencia'] ?? null;
        $cantidad = $area['cantidad'] ?? null;
        $enUso = $area['en_uso'] ?? ($area['uso'] ?? null);
        $condicion = $area['condicion'] ?? null;
        $danoEstructural = $area['dano_estructural'] ?? ($area['danio_estructural'] ?? null);
        $danoInstalacion = $area['dano_instalacion'] ?? ($area['danio_instalacion'] ?? null);
        $obraProceso = $area['obra_proceso'] ?? ($area['obra_en_proceso'] ?? null);
        $construccion = $area['construccion_adicional'] ?? null;

        // Insert row
        $stmt->execute([
            ':id_articulo' => $area['id_articulo'],
            ':letra' => $letra,
            ':existencia' => $existencia,
            ':cantidad' => $cantidad,
            ':en_uso' => $enUso,
            ':condicion' => $condicion,
            ':dano_estructural' => $danoEstructural,
            ':dano_instalacion' => $danoInstalacion,
            ':obra_proceso' => $obraProceso,
            ':construccion_adicional' => $construccion,
            ':id_user' => $id_user
        ]);
    }

    // Commit
    $pdo->commit();

    echo json_encode(['success' => true, 'message' => 'Áreas comunes guardadas correctamente']);
    exit;
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
