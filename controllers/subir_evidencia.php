<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Validar parámetros requeridos
$required = ['cct', 'modulo', 'id_ficha', 'id_usuario', 'nombre_doc', 'pregunta'];
foreach ($required as $param) {
    if (empty($_POST[$param])) {
        echo json_encode(['success' => false, 'message' => "Falta el parámetro: $param"]);
        exit;
    }
}

if (!isset($_FILES['evidencia']) || $_FILES['evidencia']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Error al subir el archivo']);
    exit;
}

$permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
$max_size = 10 * 1024 * 1024; // 10 MB

$mime_type = mime_content_type($_FILES['evidencia']['tmp_name']);
$size = $_FILES['evidencia']['size'];

if (!in_array($mime_type, $permitidos)) {
    echo json_encode(['success' => false, 'message' => 'Solo se permiten archivos JPG, JPEG o PNG']);
    exit;
}

if ($size > $max_size) {
    echo json_encode(['success' => false, 'message' => 'El archivo excede el tamaño máximo de 10 MB']);
    exit;
}

// Obtener valores y limpiar
$cct = preg_replace('/[^A-Z0-9]/', '', strtoupper($_POST['cct']));
$modulo = intval($_POST['modulo']);
$id_ficha = intval($_POST['id_ficha']);
$id_usuario = intval($_POST['id_usuario']);
$nombre_original = basename($_POST['nombre_doc']);
$pregunta = trim($_POST['pregunta']);

// Nombre del archivo
$extension = strtolower(pathinfo($_FILES['evidencia']['name'], PATHINFO_EXTENSION));
$timestamp = time();
$nombre_archivo = "{$cct}-F{$id_ficha}-M{$modulo}-{$pregunta}-{$timestamp}.{$extension}";
$nombre_archivo = str_replace(' ', '_', $nombre_archivo);

// Directorio
$dir = '../uploads';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$destino = $dir . '/' . $nombre_archivo;

if (move_uploaded_file($_FILES['evidencia']['tmp_name'], $destino)) {
    try {
        require_once __DIR__ . '/../config/db.php';
        $sql = "INSERT INTO evidencias (id_ficha, cct, modulo, nombre_doc, id_usuario, pregunta) 
                VALUES (:id_ficha, :cct, :modulo, :nombre_doc, :id_usuario, :pregunta)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_ficha' => $id_ficha,
            ':cct' => $cct,
            ':modulo' => $modulo,
            ':nombre_doc' => $nombre_archivo,
            ':id_usuario' => $id_usuario,
            ':pregunta' => $pregunta
        ]);
        echo json_encode(['success' => true, 'filename' => $nombre_archivo]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al guardar en BD: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudo mover el archivo']);
}
