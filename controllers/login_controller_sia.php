<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/session.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$cct1 = strtoupper(trim($input['cct1'] ?? ''));
$cct2 = strtoupper(trim($input['cct2'] ?? ''));

if (!$cct1 || !$cct2) {
    echo json_encode(['success' => false, 'message' => 'Ambos campos de CCT son obligatorios.']);
    exit;
}

if ($cct1 !== $cct2) {
    echo json_encode(['success' => false, 'message' => 'Los valores del CCT no coinciden.']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM planteles WHERE cct = ?");
    $stmt->execute([$cct1]);
    $plantel = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($plantel) {
        $updateStmt = $pdo->prepare("UPDATE planteles SET ultimo_ingreso = CURRENT_TIMESTAMP WHERE cct = ?");
        $updateStmt->execute([$cct1]);

        session_regenerate_id(true);
        $_SESSION['cct'] = $plantel['cct'];
        $_SESSION['nombre'] = $plantel['nombre'] ?? '';
        $_SESSION['entidad'] = $plantel['entidad'] ?? '';
        $_SESSION['municipio'] = $plantel['municipio'] ?? '';
        $_SESSION['turno'] = $plantel['turno'] ?? '';
        $_SESSION['nivel_educativo'] = $plantel['nivel_educativo'] ?? '';
        $_SESSION['domicilio'] = $plantel['domicilio'] ?? '';
        $_SESSION['n_ext'] = $plantel['n_ext'] ?? '';

        echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'CCT no encontrado en la base de datos.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a base de datos.']);
}
