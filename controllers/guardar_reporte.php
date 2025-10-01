<?php
header('Content-Type: application/json');
require_once '../config/db.php';
require_once '../includes/session.php';

if (!isset($_SESSION['cct'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Sesión no válida.']);
    exit;
}

//redirigirSiNoLogeado();

// Sanitiza entradas
$cct = $_SESSION['cct'] ?? '';
//fecha de siniestro es la fechha y hora actual
$fecha = date('Y-m-d');
$hora = date('H:i:s');
$tipo_siniestro_array = $_POST['tipo_siniestro'] ?? [];
$tipo_siniestro = is_array($tipo_siniestro_array) ? implode(', ', $tipo_siniestro_array) : $tipo_siniestro_array; // ahora es array; concatenamos en string separado por comas
$nivel_atencion = isset($_POST['nivel_atencion']) ? $_POST['nivel_atencion'] : (isset($_POST['atencion_oficial']) ? [$_POST['atencion_oficial']] : []);
$brigadas = $_POST['brigadas'] ?? [];
$edificios = $_POST['cantidad_edificios'] ?? '';
$desc = $_POST['descripcion'] ?? '';

// Validaciones básicas
if (!$cct || !$fecha || !$hora || !$tipo_siniestro) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    exit;
}

// Combina arrays
$fechaCompleta = $fecha . ' ' . $hora . ':00';
$str_niveles =   $nivel_atencion;
$str_brigadas =   $brigadas;
// $str_niveles = is_array($nivel_atencion) ? implode(',', $nivel_atencion) : $nivel_atencion;
// $str_brigadas = implode(',', $brigadas);

// Insertar en la tabla siniestros 
try {
    $stmt = $pdo->prepare("
        INSERT INTO siniestros (cct, id_user, fecha, tipo_siniestro, nivel_atencion, brigadas_activadas, descripcion, edificios )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $cct,
        $_SESSION['usuario_id'],
        $fechaCompleta,
        $tipo_siniestro,
        $str_niveles,
        $str_brigadas,
        $desc,
        $edificios
    ]);

    $nuevoId = $pdo->lastInsertId();

    // Procesar secciones 2.1 a 2.5
    $secciones = [
        'areas_principales' => 'detalle_areas_principales',
        'areas_adicionales' => 'detalle_areas_adicionales',
        'mobiliario' => 'detalle_mobiliario',
        'equipo' => 'detalle_equipo',
        'areas_comunes' => 'detalle_areas_comunes',
        'elementos' => 'detalle_elementos'
    ];

    // Para prevenir errores por NOT NULL en evidencia, inicializa $archivo 
    $archivo = '';

    foreach ($secciones as $nombreCampo => $nombreTabla) {
        if (isset($_POST[$nombreCampo]) && is_array($_POST[$nombreCampo])) {
            foreach ($_POST[$nombreCampo] as $item => $datos) {
                $cantidad = intval($datos['cantidad'] ?? 0);
                if ($cantidad <= 0) continue;

                $zona = $datos['zona'] ?? null;
                $tipo = $datos['tipo'] ?? '';

                $nombre_archivo = $datos['nombre_archivo'] ?? null;

                $stmt_det = $pdo->prepare("
                    INSERT INTO {$nombreTabla} (id_siniestro, elemento, cantidad, zona, tipo_dano, evidencia, nombre_archivo)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt_det->execute([
                    $nuevoId,
                    $item,
                    $cantidad,
                    $zona,
                    $tipo,
                    $nombre_archivo,
                    $nombre_archivo
                ]);
            }
        }
    }

    echo json_encode(['success' => true, 'id_reporte' => $nuevoId]);
    exit;
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al guardar el reporte',
        'error' => $e->getMessage()
    ]);
    exit;
}
