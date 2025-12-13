<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Sesión no válida'
    ]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['elementos']) || !is_array($input['elementos'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No se recibieron elementos'
    ]);
    exit;
}

$idUsuario = (int) $_SESSION['usuario_id'];

try {
    $pdo->beginTransaction();

    $sql = "
        INSERT INTO datos_areascomunes (
            id_articulo,
            existencia,
            cantidad,
            en_uso,
            condicion,
            dano_estructural,
            dano_instalacion,
            obra_proceso,
            construccion_adicional,
            created_at,
            updated_at
        ) VALUES ( 
            :id_articulo,
            :existencia,
            :cantidad,
            :en_uso,
            :condicion,
            :dano_estructural,
            :dano_instalacion,
            :obra_proceso,
            :construccion_adicional,
            NOW(),
            NOW()
        )
    ";

    $stmt = $pdo->prepare($sql);

    foreach ($input['elementos'] as $el) {
        // Solo guardar si tiene existencia marcada
        if (empty($el['existencia'])) {
            continue;
        }

        $stmt->execute([
            ':id_articulo'            => (int) $el['id_articulo'],
            ':existencia'             => $el['existencia'],
            ':cantidad'               => $el['cantidad'] ?? null,
            ':en_uso'                 => $el['en_uso'] ?? null,
            ':condicion'              => $el['condicion'] ?? null,
            ':dano_estructural'       => $el['dano_estructural'] ?? null,
            ':dano_instalacion'       => $el['dano_instalacion'] ?? null,
            ':obra_proceso'           => $el['obra_proceso'] ?? null,
            ':construccion_adicional' => $el['construccion_adicional'] ?? null
        ]);
    }

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Elementos guardados correctamente'
    ]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
