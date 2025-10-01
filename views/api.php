<?php
require_once __DIR__ . '/../config/db.php';
global $pdo;

// Helper to emit JSON consistently
function send_json($data, int $code = 200)
{
    http_response_code($code);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar conexión
if (!$pdo) {
    send_json(['error' => 'No se pudo conectar a la base de datos'], 500);
}

// Obtener ruta solicitada de forma robusta (siempre REQUEST_URI)
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Normalizar segmentos y eliminar vacíos
$uriParts = array_values(array_filter(explode('/', trim((string)$path, '/')), 'strlen'));

// Ubicar el índice del segmento "api" sin asumir posición fija (raíz o subcarpeta)
$apiIndex = array_search('api', $uriParts, true);
if ($apiIndex === false) {
    send_json(['error' => 'Ruta no válida', 'segments' => $uriParts], 404);
}

$action = $uriParts[$apiIndex + 1] ?? null; // reporte | global | pdf
$param  = $uriParts[$apiIndex + 2] ?? null; // id cuando aplique

try {
    switch ($action) {
        case 'reporte':
            if ($param === null || !ctype_digit($param)) {
                send_json(['error' => 'Falta ID numérico de reporte'], 400);
            }
            $id = (int)$param;

            $stmt = $pdo->prepare("
                SELECT 
                    s.*, 
                    p.nombre, p.entidad, p.nivel_educativo, p.municipio, 
                    p.domicilio, p.n_ext, p.cp, p.longitud, p.latitud 
                FROM siniestros s
                LEFT JOIN planteles p ON s.cct = p.cct
                WHERE s.id = ?
            ");
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                send_json(['error' => 'Reporte no encontrado', 'id' => $id], 404);
            }
            send_json($data);

        case 'global':
            $stmt = $pdo->query("
                SELECT 
                    s.cct,
                    p.nombre,
                    p.nivel_educativo,
                    p.entidad,
                    p.municipio,
                    p.localidad,
                    p.turno,
                    p.domicilio,
                    p.n_ext,
                    p.cp,
                    s.id AS id_siniestro,
                    s.creado AS fecha_reporte,
                    s.tipo_siniestro,
                    s.nivel_atencion,
                    s.brigadas_activadas,
                    GROUP_CONCAT(DISTINCT CONCAT_WS(' - ', dap.elemento, dap.tipo_dano, dap.cantidad) SEPARATOR ' | ') AS areas_principales,
                    GROUP_CONCAT(DISTINCT CONCAT_WS(' - ', dac.elemento, dac.tipo_dano, dac.cantidad) SEPARATOR ' | ') AS areas_comunes,
                    GROUP_CONCAT(DISTINCT CONCAT_WS(' - ', daad.elemento, daad.tipo_dano, daad.cantidad) SEPARATOR ' | ') AS areas_adicionales,
                    GROUP_CONCAT(DISTINCT CONCAT_WS(' - ', de.elemento, de.tipo_dano, de.cantidad) SEPARATOR ' | ') AS elementos,
                    GROUP_CONCAT(DISTINCT CONCAT_WS(' - ', deq.elemento, deq.tipo_dano, deq.cantidad) SEPARATOR ' | ') AS equipo,
                    GROUP_CONCAT(DISTINCT CONCAT_WS(' - ', dm.elemento, dm.tipo_dano, dm.cantidad) SEPARATOR ' | ') AS mobiliario
                FROM siniestros s
                LEFT JOIN planteles p ON s.cct = p.cct
                LEFT JOIN detalle_areas_principales dap ON s.id = dap.id_siniestro
                LEFT JOIN detalle_areas_comunes dac ON s.id = dac.id_siniestro
                LEFT JOIN detalle_areas_adicionales daad ON s.id = daad.id_siniestro
                LEFT JOIN detalle_elementos de ON s.id = de.id_siniestro
                LEFT JOIN detalle_equipo deq ON s.id = deq.id_siniestro
                LEFT JOIN detalle_mobiliario dm ON s.id = dm.id_siniestro
                GROUP BY s.id
                ORDER BY s.id DESC;
            ");
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            send_json($data);

        case 'pdf':
            if ($param === null || !ctype_digit($param)) {
                send_json(['error' => 'Falta ID numérico para PDF'], 400);
            }
            $id = (int)$param;
            // Redirigir respetando el host actual (funciona en dev y prod)
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            header('Location: ' . $scheme . '://' . $host . '/views/ver_reporte.php?id=' . $id);
            exit;

        default:
            send_json(['error' => 'Ruta no válida', 'action' => $action], 404);
    }
} catch (Throwable $e) {
    send_json(['error' => 'Error interno', 'message' => $e->getMessage()], 500);
}
