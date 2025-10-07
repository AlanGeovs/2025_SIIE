

<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

try {
    // Verificar que la sesión tenga los valores necesarios
    if (!isset($_SESSION['id_ficha']) || !isset($_SESSION['cct'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Sesión no válida. Faltan datos requeridos.'
        ]);
        exit;
    }

    $id_ficha = $_SESSION['id_ficha'];
    $cct = $_SESSION['cct'];

    // Consultar si existe registro en modulo_3 para el id_ficha
    $stmt = $pdo->prepare("SELECT num_edificaciones FROM modulo_3 WHERE id_ficha = ?");
    $stmt->execute([$id_ficha]);
    $modulo3 = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($modulo3 && isset($modulo3['num_edificaciones'])) {
        $num_edificaciones = (int)$modulo3['num_edificaciones'];

        if ($num_edificaciones > 0) {
            // Consultar las edificaciones asociadas
            $stmt_edif = $pdo->prepare("SELECT * FROM modulo_3_edificaciones WHERE id_ficha = ?");
            $stmt_edif->execute([$id_ficha]);
            $edificaciones = $stmt_edif->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode([
                'success' => true,
                'num_edificaciones' => $num_edificaciones,
                'edificaciones' => $edificaciones
            ]);
            exit;
        } else {
            // num_edificaciones es 0
            echo json_encode([
                'success' => true,
                'num_edificaciones' => 0
            ]);
            exit;
        }
    } else {
        // No existe registro en modulo_3
        echo json_encode([
            'success' => true,
            'num_edificaciones' => 0
        ]);
        exit;
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al consultar el módulo 3: ' . $e->getMessage()
    ]);
    exit;
}
?> 