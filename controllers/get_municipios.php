

<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php';

try {
    if (!isset($_GET['id_ent']) || empty($_GET['id_ent'])) {
        echo json_encode([]);
        exit;
    }

    $id_ent = intval($_GET['id_ent']);

    $stmt = $pdo->prepare("SELECT id_mun, mun FROM municipios WHERE id_ent = ? ORDER BY mun ASC");
    $stmt->execute([$id_ent]);
    $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($municipios);
} catch (Exception $e) {
    echo json_encode([]);
}
