<?php
//mostrar errores
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


require_once __DIR__ . '/../config/db.php';
global $pdo;

// if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
//     echo 'ID de reporte no proporcionado.';
//     exit;
// } 

$id_reporte = intval($_GET['id']);

// Obtener datos del siniestro
$stmtSiniestro = $pdo->prepare("SELECT * FROM siniestros WHERE id = ?");
$stmtSiniestro->execute([$id_reporte]);
$siniestro = $stmtSiniestro->fetch();

if (!$siniestro) {
    echo "No se encontró el siniestro. ID: "   . htmlspecialchars($id_reporte);
    exit;
}

// Obtener datos del plantel
$stmtPlantel = $pdo->prepare("SELECT * FROM planteles WHERE cct = ?");
$stmtPlantel->execute([$siniestro['cct']]);
$plantel = $stmtPlantel->fetch();

function renderDetalle($pdo, $tabla, $titulo, $id_siniestro)
{
    $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE id_siniestro = ? ORDER BY 
        CASE 
            WHEN tipo_dano = 'Grave' THEN 1 
            WHEN tipo_dano = 'Moderado' THEN 2 
            WHEN tipo_dano = 'Leve' THEN 3 
            ELSE 4 
        END");
    $stmt->execute([$id_siniestro]);
    $resultados = $stmt->fetchAll();

    if (count($resultados) === 0) return '';

    $html = "<h4 class='mt-5'>$titulo</h4>";
    foreach ($resultados as $fila) {
        $imagen = htmlspecialchars($fila['evidencia']);
        $url = 'https://sia.inifed.mx/uploads/' . urlencode($imagen);
        $tipo = strtolower($fila['tipo_dano']);
        $clase = 'tipo-dano-leve';
        if ($tipo === 'grave') {
            $clase = 'tipo-dano-grave';
        } elseif ($tipo === 'moderado') {
            $clase = 'tipo-dano-moderado';
        }
        $html .= "
            <div style='page-break-inside: avoid;'>
                <table style='width: 100%; page-break-inside: avoid;'>
                    <tr>
                        <td style='width: 40%; vertical-align: top; padding: 2px;'>
                            <h4>{$titulo}</h4> 
                            <p><strong>Área:</strong> {$fila['elemento']}</p>
                            <p><span class=\"$clase\"> {$fila['tipo_dano']}</span> </p>
                            <p><strong>Cantidad:</strong> {$fila['cantidad']}</p>  
                        </td> 
                        <td style='width: 60%; text-align: center; padding: 2px;'>
                            <img src='$url' alt='Evidencia' style='max-height: 180px; width: auto; object-fit: contain;  '>
                        </td>
                    </tr>
                </table>
            </div>";
    }
    return $html;
}

function renderDetalleFiltrado($pdo, $tabla, $titulo, $id_siniestro, $nivel_dano)
{
    $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE id_siniestro = ? AND tipo_dano = ? ORDER BY id ASC");
    $stmt->execute([$id_siniestro, $nivel_dano]);
    $resultados = $stmt->fetchAll();

    if (count($resultados) === 0) return '';

    // Eliminamos el encabezado <h4 class='mt-4'>$titulo</h4> para evitar duplicados
    $html = "";

    $tablaCount = 0;
    static $globalCount = 0;
    foreach ($resultados as $fila) {
        $globalCount++;
        $tablaCount++;

        // Insertar salto de página después de cada tercera tabla, excepto en la primera página donde solo se permiten 2
        if ($globalCount > 2 && ($tablaCount - 2) % 3 == 0) {
            $html .= "<div style='page-break-before: always;'></div>";
        }

        // Espaciado extra antes de cada tabla si corresponde
        $espaciado_extra = '';
        if ($globalCount % 3 === 0) {
            $espaciado_extra = "<div style='height: 150px;'></div>";
        }

        $imagen = htmlspecialchars($fila['evidencia']);
        $url = 'https://sia.inifed.mx/uploads/' . urlencode($imagen);
        $tipo = strtolower($fila['tipo_dano']);
        $clase = 'tipo-dano-leve';
        if ($tipo === 'grave') {
            $clase = 'tipo-dano-grave';
        } elseif ($tipo === 'moderado') {
            $clase = 'tipo-dano-moderado';
        }

        $html .= $espaciado_extra . "
            <div style='page-break-inside: avoid; margin-top: 20px;'>
                <table style='width: 50%; page-break-inside: avoid;'>
                    <tr>
                        <td style=' vertical-align: top; padding: 2px;'>
                            <h4>$titulo</h4>
                            <p><strong>Área:</strong> {$fila['elemento']} <span class=\"$clase\"> {$fila['tipo_dano']}</span>  <strong>Cantidad:</strong> {$fila['cantidad']}</p>
                        
                            <img src='$url' alt='Evidencia' style='max-height: 230px; width: 300px; object-fit: contain;'>
                        </td> 
                    </tr>
                </table>  
            </div>";
    }
    return $html;
}

setlocale(LC_ALL, 'es_ES.UTF-8');
require_once __DIR__ . '/../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);

ob_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Diagnóstico #<?= $id_reporte ?></title>
    <style>
        @page {
            margin-top: 30px;
            margin-bottom: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            color: #333;
            font-size: 12px;
        }

        h1 {
            font-size: 18px;
            color: #691c32;
        }

        h3,
        h4 {
            color: #691c32;
        }

        .header-logo {
            max-height: 60px;
        }

        header {
            border-bottom: 1px solid #ccc;
            /* padding-bottom: 10px;
            margin-bottom: 20px; */
        }

        /* Centrado vertical de logos y textos en el header */
        header table {
            width: 100%;
            vertical-align: middle;
        }

        header td {
            vertical-align: middle;
        }

        main {
            margin: 5px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        cuerpo {
            margin-top: 10px;
            padding: 5px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-left: -10px;
            margin-right: -10px;
        }

        .col-md-6 {
            width: 50%;
            padding-left: 10px;
            padding-right: 10px;
            box-sizing: border-box;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 10px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            font-size: 11px;
            color: black;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            margin-bottom: 0.3rem;
        }

        .siniestroTitulo {

            font-family: 'Arial, sans-serif';
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            color: #691c32;
            padding: 10px;
        }

        .tipo-dano-grave {
            background-color: #c0392b;
            color: white;
            padding: 5px 8px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
            margin-top: 7px;
        }

        .tipo-dano-moderado {
            background-color: #e67e22;
            color: white;
            padding: 5px 8px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
            margin-top: 7px;
        }

        .tipo-dano-leve {
            background-color: #f1c40f;
            color: #000;
            padding: 5px 8px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
            margin-top: 7px;
        }
    </style>
</head>

<body>
    <header style="border-bottom: 1px solid #ccc; position: fixed; top: 0; left: 0; right: 0; width: 100%; background: #fff; z-index: 10;">

        <table style="width: 100%;">
            <tr>
                <td style="width: 40%; text-align: left;">
                    <img src="https://sia.inifed.mx/public/assets/img/logosep.png" class="header-logo" alt="SEP" style="height: 45px; margin-right: 5px;">
                    <img src="https://sia.inifed.mx/public/assets/img/logo-inifed.png" class="header-logo" alt="INIFED" style="height: 45px;">
                </td>
                <td style="width: 50%; text-align: center;">
                    <h1 class="h5" style="color: #691c32; font-size: 18px;">Sistema de Alerta de Daños <br>(SIA)</h1>
                </td>
                <td style="width: 10%; text-align: right;">
                    <img src="https://sia.inifed.mx/public/assets/img/gobmujer.png" class="header-logo" alt="Gobierno Mujer" style="height: 45px; margin-left: 10px;">
                </td>
            </tr>
        </table>
    </header>

    <main class="d-flex justify-content-center   bg-white" style="margin-top:60px; margin-bottom:30px;">
        <style>
            @media print {
                body {
                    counter-reset: page;
                }

                main {
                    margin-top: 60px;
                }

                main:not(:first-of-type) {
                    /* margin-top: 0 !important; */
                    margin-top: 10px !important;
                }

                body:before {
                    content: "";
                    display: block;
                    height: 80px;
                }



                main+div,
                main+table {
                    margin-top: 100px !important;
                }
            }
        </style>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; text-align: left; padding: 2px;">
                    <h2 class="h5 " style="color: #691c32; font-size: 24px;">Ficha de Diagnóstico </h2>
                </td>
                <td style="width: 50%; text-align: right; padding: 2px;">
                    <?php
                    $fecha = new DateTime($siniestro['creado']);
                    $fecha->modify('-1 hour');
                    $fecha_formateada = $fecha->format('d-m-Y H:i');
                    // Obtener clave de entidad desde los primeros 2 dígitos del CCT
                    $clave_estado = substr($plantel['cct'], 0, 2);
                    $estados = [
                        '01' => 'AGS',
                        '02' => 'BCN',
                        '03' => 'BCS',
                        '04' => 'CAMP',
                        '05' => 'COAH',
                        '06' => 'COL',
                        '07' => 'CHIS',
                        '08' => 'CHIH',
                        '09' => 'CDMX',
                        '10' => 'DGO',
                        '11' => 'GTO',
                        '12' => 'GRO',
                        '13' => 'HGO',
                        '14' => 'JAL',
                        '15' => 'MEX',
                        '16' => 'MICH',
                        '17' => 'MORE',
                        '18' => 'NAY',
                        '19' => 'NL',
                        '20' => 'OAX',
                        '21' => 'PUE',
                        '22' => 'QRO',
                        '23' => 'QROO',
                        '24' => 'SLP',
                        '25' => 'SIN',
                        '26' => 'SON',
                        '27' => 'TAB',
                        '28' => 'TAM',
                        '29' => 'TLAX',
                        '30' => 'VER',
                        '31' => 'YUC',
                        '32' => 'ZAC'
                    ];
                    $clave = $estados[$clave_estado] ?? 'XXX';
                    $folio = str_pad($id_reporte, 4, '0', STR_PAD_LEFT);
                    ?>
                    <span class="h5">Fecha y hora: <?= $fecha_formateada ?> hrs.</span><br>
                    <span class="h6">Reporte: <?= $clave . '-' . $folio ?></span>
                </td>
            </tr>
        </table>


        <div class="container text-center">
            <h4>Datos del Centro de Trabajo</h4>
            <div style="border-radius: 8px; padding: 12px; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">

                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 1px;"><strong>Entidad:</strong> <?= $plantel['entidad'] ?></td>
                        <td style="padding: 1px;"><strong>CCT:</strong> <?= $plantel['cct'] ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 1px;"><strong>Municipio:</strong> <?= $plantel['municipio'] ?></td>
                        <td style="padding: 1px;"><strong>Nombre del plantel:</strong> <?= $plantel['nombre'] ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 1px;"><strong>Nivel educativo:</strong> <?= $plantel['nivel_educativo'] ?></td>
                        <td style="padding: 1px;"><strong>Turno:</strong> <?= $plantel['turno'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 1px;"><strong>Dirección:</strong> <?= $plantel['domicilio'] ?> #<?= $plantel['n_ext'] ?>, CP <?= $plantel['cp'] ?></td>
                    </tr>
                </table>
            </div>

            <h4>Tipo de Siniestro</h4>
            <table style="width: 100%;   border-radius: 8px; padding: 12px; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" ">
                <tr>
                    <td class=" siniestroTitulo">
                <?= $siniestro['tipo_siniestro'] ?>
                </td>
                <td style="padding: 10px; width: 50%;">
                    <?php
                    $niveles = [
                        'municipal' => 'Municipal',
                        'estatal' => 'Estatal',
                        'sedena' => 'Plan DN-III-E (SEDENA)',
                        'marina' => 'Plan Marina (SEMAR)',
                        'gna' => 'Plan GN-A (Guardia Nacional)',
                        'proteccion-civil' => 'Comisión interna de Protección Civil'
                    ];
                    $nivel_descripcion = isset($siniestro['nivel_atencion']) && $siniestro['nivel_atencion'] !== ''
                        ? ($niveles[$siniestro['nivel_atencion']] ?? $siniestro['nivel_atencion'])
                        : 'Ninguna';
                    ?>
                    <strong>Nivel de atención: </strong> <?= $nivel_descripcion ?> - <?= $siniestro['brigadas_activadas'] ?>
                </td>
                </tr>
            </table>

            <h4>Ranking de daños</h4>

            <?php
            $niveles = ['Grave', 'Moderado', 'Leve'];
            $secciones = [
                ['tabla' => 'detalle_areas_principales', 'titulo' => 'Áreas principales dañadas'],
                ['tabla' => 'detalle_areas_comunes', 'titulo' => 'Áreas comunes dañadas'],
                ['tabla' => 'detalle_areas_adicionales', 'titulo' => 'Áreas adicionales dañadas'],
                ['tabla' => 'detalle_elementos', 'titulo' => 'Elementos afectados'],
                ['tabla' => 'detalle_equipo', 'titulo' => 'Equipo dañado'],
                ['tabla' => 'detalle_mobiliario', 'titulo' => 'Mobiliario dañado'],
            ];

            foreach ($niveles as $nivel) {

                foreach ($secciones as $sec) {
                    $html = renderDetalleFiltrado($pdo, $sec['tabla'], $sec['titulo'], $id_reporte, $nivel);
                    if (!empty($html)) echo $html;
                }
            }
            ?>
        </div>
    </main>


    <footer style="position: fixed; bottom: 0; left: 0; right: 0; height: 40px; text-align: center; font-size: 11px; color: black;">
        Sistema de Infraestructura Educativa (SIIE) v1.0 | INIFED &copy; <?= date('Y') ?> | Desarrollado por la Gerencia del Sistema Nacional de Información
    </footer>
</body>

</html>
<?php
$html = ob_get_clean();

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);

// Numeración de páginas usando page_text para Dompdf v1.0.2, debe ir ANTES de render()
$canvas = $dompdf->getCanvas();
$font = $dompdf->getFontMetrics()->getFont("Helvetica", "normal");
$canvas->page_text(270, 770, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0, 0, 0));

//formato de descarga en tamaño carta  8.5 x 11 pulgadas
$dompdf->setPaper('Letter', 'portrait'); // Tamaño carta
// $dompdf->setPaper('A4', 'portrait');
$dompdf->render();
// forzar a abrir el PDF en el navegador
$dompdf->stream("reporte_siniestro_{$id_reporte}.pdf", ["Attachment" => false]);
// FOrzar a descargar el PDF
// $dompdf->stream("reporte_siniestro_{$id_reporte}.pdf", ["Attachment" => true]); 
exit;
?>