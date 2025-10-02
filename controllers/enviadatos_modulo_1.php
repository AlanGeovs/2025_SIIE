<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php'; // Asegúrate de que este archivo crea $pdo con PDO

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit;
    }

    // Validar usuario
    if (!isset($_SESSION['usuario_id'])) {
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        exit;
    }

    $id_usuario = $_SESSION['usuario_id'];
    $id_ficha = $_SESSION['id_ficha'] ?? null;

    // Campos requeridos
    $required = ['cct', 'nombre_plantel', 'entidad', 'municipio'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['success' => false, 'message' => "Falta el campo obligatorio: $field"]);
            exit;
        }
    }

    // Recibir datos
    $cct = trim($_SESSION['cct']);
    $nombre_plantel = mb_strtoupper(trim($_POST['nombre_plantel']), 'UTF-8');
    $cct_asociado = $_POST['cct_asociado'] ?? null;
    $calle = isset($_POST['calle']) ? mb_strtoupper(trim($_POST['calle']), 'UTF-8') : null;
    $n_int = $_POST['n_int'] ?? null;
    $n_ext = $_POST['n_ext'] ?? null;
    $entidad = $_POST['entidad'];
    $municipio = $_POST['municipio'];
    $colonia = isset($_POST['colonia']) ? mb_strtoupper(trim($_POST['colonia']), 'UTF-8') : null;
    $n_salones = !empty($_POST['n_salones']) ? intval($_POST['n_salones']) : 0;
    $n_alumnos = !empty($_POST['n_alumnos']) ? intval($_POST['n_alumnos']) : 0;
    $nivel = $_POST['nivel_escolar'] ?? null;
    $turno = $_POST['turno'] ?? null;
    $antiguedad = !empty($_POST['antiguedad_inmueble']) ? intval($_POST['antiguedad_inmueble']) : null;
    $catalogado = isset($_POST['catalogado']) ? 1 : 0;
    // $opcion_arqueolo = $_POST['opcion_arqueolo'] ??  
    $inmueble_hist = $_POST['opcion_arqueolo'] ?? null;

    // Actualizar
    $sql = "UPDATE fichas SET
        nombre_plantel = :nombre_plantel,
        cct_asociado = :cct_asociado,
        calle = :calle,
        n_int = :n_int,
        n_ext = :n_ext,
        entidad = :entidad,
        municipio = :municipio,
        colonia = :colonia,
        n_salones = :n_salones,
        n_alumnos = :n_alumnos,
        nivel = :nivel,
        turno = :turno,
        antiguedad = :antiguedad,
        catalogado = :catalogado,
        inmueble_hist = :inmueble_hist,
        id_usuario = :id_usuario,
        m1 = :m1
        WHERE id_ficha = :id_ficha AND cct = :cct";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre_plantel' => $nombre_plantel,
        ':cct_asociado' => $cct_asociado,
        ':calle' => $calle,
        ':n_int' => $n_int,
        ':n_ext' => $n_ext,
        ':entidad' => $entidad,
        ':municipio' => $municipio,
        ':colonia' => $colonia,
        ':n_salones' => $n_salones,
        ':n_alumnos' => $n_alumnos,
        ':nivel' => $nivel,
        ':turno' => $turno,
        ':antiguedad' => $antiguedad,
        ':catalogado' => $catalogado,
        ':inmueble_hist' => $inmueble_hist,
        ':id_usuario' => $id_usuario,
        ':m1' => 1,
        ':id_ficha' => $id_ficha,
        ':cct' => $cct,
    ]);

    // Actualizar CCT en la tabla usuarios
    $sqlUpdate = "UPDATE usuarios SET cct = :cct WHERE id = :id_usuario";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->execute([
        ':cct' => $cct,
        ':id_usuario' => $id_usuario
    ]);

    echo json_encode(['success' => true, 'message' => 'Módulo "I. Datos del Centro de Trabajo" guardado correctamente']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
