<?php
session_start();
require_once __DIR__ . '/config/db.php';

// --- Early route for API endpoints (before any path mangling) ---
$requestPathEarly = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
if ($requestPathEarly === '/api' || strpos($requestPathEarly, '/api/') === 0) {
    require __DIR__ . '/views/api.php';
    exit;
}
// --- End API early route ---

// Función para cargar la vista correspondiente
function cargarVista($vista)
{
    $archivo = __DIR__ . "/views/{$vista}.php";
    if (file_exists($archivo)) {
        require $archivo;
    } else {
        http_response_code(404);
        echo "<h1>Error 404</h1><p>Página no encontrada</p>";
    }
}

// Obtener la ruta limpia desde la URL
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

$base = ($scriptName === '/' || $scriptName === '\\') ? '' : $scriptName;
$relative = $requestUri;
if ($base !== '' && strpos($relative, $base) === 0) {
    $relative = substr($relative, strlen($base));
}
$path = trim(parse_url($relative, PHP_URL_PATH), '/');

// Si la ruta está vacía, cargar index
if ($path === '') {
    cargarVista('index');
    exit;
}

// Mapear rutas limpias a archivos en /views
switch ($path) {
    case 'index':
        cargarVista('index');
        break;
    case 'dashboard':
        cargarVista('dashboard');
        break;
    case 'registro':
        cargarVista('registro');
        break;
    case 'acceso':
        cargarVista('acceso');
        break;
    case 'detalle':
        cargarVista('detalle_reportes');
        break;
    case 'login':
        cargarVista('login');
        break;
    case 'documentacion':
        cargarVista('documentacion');
        break;
    case 'recuperar':
        cargarVista('recuperar_password');
        break;
    case 'reset':
        cargarVista('reset_password');
        break;
    case 'captura-reporte':
        cargarVista('captura_reporte');
        break;
    case 'reportes':
        cargarVista('lista_reportes');
        break;
    case 'ver-reporte':
        cargarVista('ver_reporte');
        break;
    //logout redirige a index.php
    case 'logout':
        session_destroy();
        header('Location: /');
        exit;
    case 'sfam':
        cargarVista('sfam_inicio');
        break;
    default:
        http_response_code(404);
        echo "<h1>Error 404</h1><p>Ruta '$path' no válida</p>";
        break;
}
