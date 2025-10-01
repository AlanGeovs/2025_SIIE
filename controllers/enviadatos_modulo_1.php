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

    // Campos requeridos
    $required = ['cct', 'nombre_plantel', 'entidad', 'municipio'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['success' => false, 'message' => "Falta el campo obligatorio: $field"]);
            exit;
        }
    }

    // Recibir datos
    $cct = trim($_POST['cct']);
    $nombre_plantel = trim($_POST['nombre_plantel']);
    $cct_asociado = $_POST['cct_asociado'] ?? null;
    $calle = $_POST['calle'] ?? null;
    $n_int = $_POST['n_int'] ?? null;
    $n_ext = $_POST['n_ext'] ?? null;
    $entidad = $_POST['entidad'];
    $municipio = $_POST['municipio'];
    $colonia = $_POST['colonia'] ?? null;
    $n_salones = !empty($_POST['n_salones']) ? intval($_POST['n_salones']) : 0;
    $n_alumnos = !empty($_POST['n_alumnos']) ? intval($_POST['n_alumnos']) : 0;
    $nivel = $_POST['nivel_escolar'] ?? null;
    $turno = $_POST['turno'] ?? null;
    $antiguedad = !empty($_POST['antiguedad_inmueble']) ? intval($_POST['antiguedad_inmueble']) : null;
    $catalogado = isset($_POST['catalogado']) ? 1 : 0;
    // $opcion_arqueolo = $_POST['opcion_arqueolo'] ??  
    $inmueble_hist = $_POST['opcion_arqueolo'] ?? null;

    // Insertar
    $sql = "INSERT INTO fichas 
        (cct, nombre_plantel, cct_asociado, calle, n_int, n_ext, entidad, municipio, colonia, 
         n_salones, n_alumnos, nivel, turno, antiguedad, catalogado, inmueble_hist, id_usuario, m1)
        VALUES 
        (:cct, :nombre_plantel, :cct_asociado, :calle, :n_int, :n_ext, :entidad, :municipio, :colonia, 
         :n_salones, :n_alumnos, :nivel, :turno, :antiguedad, :catalogado, :inmueble_hist, :id_usuario, :m1)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':cct' => $cct,
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
