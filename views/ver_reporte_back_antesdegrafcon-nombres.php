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



// Refactor: recolecta imágenes de todas las secciones y renderiza en una sola tabla paginada,
// ordenando por tipo_dano (Grave, Moderado, Leve), pero sin separar por tablas
function renderDetalleFiltrado($pdo, $secciones, $id_siniestro)
{
    // $secciones: array de arrays con ['tabla' => ..., 'titulo' => ...]
    $imagenes = [];
    $tipo_orden = ['Grave', 'Moderado', 'Leve'];
    // Recolectar todas las imágenes de todas las secciones y todos los tipos
    foreach ($secciones as $sec) {
        $tabla = $sec['tabla'];
        $titulo = $sec['titulo'];
        $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE id_siniestro = ? ORDER BY id ASC");
        $stmt->execute([$id_siniestro]);
        $resultados = $stmt->fetchAll();
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
            $imagenes[] = [
                'titulo' => $titulo,
                'elemento' => $fila['elemento'],
                'clase' => $clase,
                'tipo_dano' => $fila['tipo_dano'],
                'cantidad' => $fila['cantidad'],
                'evidencia' => $url,
                'tipo_dano_sort' => $fila['tipo_dano']
            ];
        }
    }
    if (count($imagenes) === 0) return '';

    // Ordenar imágenes por tipo_dano: Grave, Moderado, Leve
    usort($imagenes, function ($a, $b) use ($tipo_orden) {
        $ai = array_search($a['tipo_dano'], $tipo_orden);
        $bi = array_search($b['tipo_dano'], $tipo_orden);
        $ai = $ai === false ? 99 : $ai;
        $bi = $bi === false ? 99 : $bi;
        if ($ai === $bi) return 0;
        return $ai < $bi ? -1 : 1;
    });

    // Renderizar todas las imágenes en una sola tabla paginada (2 columnas x 4 filas = 8 imágenes por página)
    $html = "";
    $total = count($imagenes);
    $perPage = 8; // 8 imágenes por página
    $cols = 2;
    for ($page = 0; $page * $perPage < $total; $page++) {
        // Insertar espacio adicional solo a partir de la tercera página (índice >= 16)
        if ($page * $perPage >= 6) {
            $html .= "<div style=\"height: 35px;\"></div>";
        }
        $html .= "<table style='width:100%; border-spacing: 0 100px; margin-top: 10px; border-collapse: collapse;'>";
        $start = $page * $perPage;
        $end = min($start + $perPage, $total);
        for ($i = $start; $i < $end; $i += $cols) {
            $html .= "<tr>";
            for ($j = 0; $j < $cols; $j++) {
                $idx = $i + $j;
                if ($idx < $end) {
                    $img = $imagenes[$idx];
                    $html .= "<td style='width:50%; vertical-align:top; padding: 10px; height:202px;'>
                        <p><span class=\"tituloAreas\">{$img['titulo']}</span><br> 
                        {$img['elemento']} <span class=\"{$img['clase']}\"> {$img['tipo_dano']} </span> <strong>Cantidad:</strong> {$img['cantidad']}</p>
                        <img src=\"{$img['evidencia']}\" style='max-width: 350px; max-height: 175px; display: block; margin: auto;'>
                        </td>";
                } else {
                    $html .= "<td style='width:50%; height:202px;'></td>";
                }
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        // Agregar salto de página después de cada página excepto la última
        if (($page + 1) * $perPage < $total) {
            $html .= "<div style='page-break-after: always;'></div>";
        }
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

        .tituloAreas {
            font-weight: 700;
            color: #691c32;
        }

        h4 {
            color: #691c32;
            margin-top: 30px;
        }

        .header-logo {
            max-height: 60px;
        }

        header {

            border-bottom: 1px solid #ccc;
            /* fondo transparente */

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

        .siniestroTitulo2 {

            font-family: 'Arial, sans-serif';
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: #691c32;
            padding: 10px;
        }

        .siniestroTitulo,
        .numeroAreas {

            font-family: 'Arial, sans-serif';
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            color: #691c32;
            padding: 10px;
        }

        .tipo-dano-grave {
            background-color: #c0392b;
            color: white;
            padding: 2px 2px;
            border-radius: 5px;
            font-weight: bold;

            margin-top: 2px;
        }

        .tipo-dano-moderado {
            background-color: #e67e22;
            color: white;
            padding: 2px 2px;
            border-radius: 5px;
            font-weight: bold;

            margin-top: 2px;
        }

        .tipo-dano-leve {
            background-color: #f1c40f;
            color: #000;
            padding: 2px 2px;
            border-radius: 5px;
            font-weight: bold;

            margin-top: 2px;
        }

        .image-row {
            margin-top: 20px;
        }

        .image-cell {
            padding: 10px;
            vertical-align: top;
            width: 50%;
        }

        .image-cell img {
            max-width: 320px;
            max-height: 200px;
            display: block;
            margin: 0 auto;
        }

        .image-container {
            margin-left: 40px;
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
            <table style="width: 100%;   border-radius: 8px; padding: 12px; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <tr>
                    <!-- Si $siniestro['tipo_siniestro'] tiene mas de 3 elementos, cambiar la clase siniestroTitulo a siniestroTitulo2 -->
                    <td class=" <?= (str_word_count($siniestro['tipo_siniestro']) > 3) ? 'siniestroTitulo2' : 'siniestroTitulo' ?>">
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

            <!-- Resumen de áreas afectadas: Áreas principales y comunes -->
            <h4>Resumen de daños</h4>
            <div style="display: flex; gap: 40px; justify-content: space-between;   ">
                <table style=" width: 50%; border-radius: 8px; padding: 12px; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);   ">
                    <tr style=" width: 50%;    ">

                        <td style=" width: 85%;">

                            <?php
                            $stmtAP = $pdo->prepare("SELECT COUNT(*) FROM detalle_areas_principales WHERE id_siniestro = ?");
                            $stmtAP->execute([$id_reporte]);
                            $totalAP = $stmtAP->fetchColumn();
                            ?>
                            <span style="display:inline-block;width:15px;height:15px;background-color:#611232;margin-right:5px;"></span> <strong>ÁREAS PRINCIPALES</strong>
                        </td>
                        <td style=" width: 15%;"><span class="numeroAreas"><?= $totalAP ?></span></td>
                    </tr>
                    <tr style=" width: 48%; ">
                        <td>
                            <?php
                            $stmtAC = $pdo->prepare("SELECT COUNT(*) FROM detalle_areas_comunes WHERE id_siniestro = ?");
                            $stmtAC->execute([$id_reporte]);
                            $totalAC = $stmtAC->fetchColumn();
                            ?>
                            <span style="display:inline-block;width:15px;height:15px;background-color:#a5722c;margin-right:5px;"></span> <strong>ÁREAS COMUNES</strong>
                        </td>
                        <td><span class="numeroAreas"><?= $totalAC ?></span></td>
                    </tr>
                    <!-- Areas adicionales  -->
                    <tr style=" width: 48%; ">
                        <td>
                            <?php
                            $stmtAEA = $pdo->prepare("SELECT COUNT(*) FROM detalle_areas_adicionales WHERE id_siniestro = ?");
                            $stmtAEA->execute([$id_reporte]);
                            $totalAEA = $stmtAEA->fetchColumn();
                            ?>
                            <span style="display:inline-block;width:15px;height:15px;background-color:#98989a;margin-right:5px;"></span> <strong>ÁREAS EDUCATIVAS ADICIONALES</strong>
                        </td>
                        <td><span class="numeroAreas"><?= $totalAEA ?></span></td>
                    </tr>


                    <tr style=" width: 48%; ">
                        <td>
                            <?php
                            $stmtDE = $pdo->prepare("SELECT COUNT(*) FROM detalle_elementos WHERE id_siniestro = ?");
                            $stmtDE->execute([$id_reporte]);
                            $totalDE = $stmtDE->fetchColumn();
                            ?>
                            <span style="display:inline-block;width:15px;height:15px;background-color:#1e5b4f;margin-right:5px;"></span> <strong>ELEMENTOS</strong>
                        </td>
                        <td><span class="numeroAreas"><?= $totalDE ?></span></td>
                    </tr>
                    <!-- Equipo y mobiliario -->
                    <tr style=" width: 48%; ">
                        <td>
                            <?php
                            $stmtEQ = $pdo->prepare("SELECT COUNT(*) FROM detalle_equipo WHERE id_siniestro = ?");
                            $stmtEQ->execute([$id_reporte]);
                            $totalEQ = $stmtEQ->fetchColumn();

                            $stmtMB = $pdo->prepare("SELECT COUNT(*) FROM detalle_mobiliario WHERE id_siniestro = ?");
                            $stmtMB->execute([$id_reporte]);
                            $totalMB = $stmtMB->fetchColumn();

                            $totalEM = $totalEQ + $totalMB;
                            ?>
                            <span style="display:inline-block;width:15px;height:15px;background-color:#9b2247;margin-right:5px;"></span> <strong>EQUIPO Y MOBILIARIO DAÑADO</strong>
                        </td>
                        <td><span class="numeroAreas"><?= $totalEM ?></span>


                        </td>


                    </tr>


                </table>
                <table style="width: 100%; border-radius: 8px; padding: 12px; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-left: 360px;">
                    <tr>
                        <td>
                            <?php
                            // --- Generar gráfica pastel en memoria ---
                            $totalAP = intval($totalAP ?? 0);
                            $totalAC = intval($totalAC ?? 0);
                            $totalAEA = intval($totalAEA ?? 0);
                            $totalDE = intval($totalDE ?? 0);
                            $totalEQ = intval($totalEQ ?? 0);
                            $totalMB = intval($totalMB ?? 0);
                            $totalEM = $totalEQ + $totalMB;
                            $data = [$totalAP, $totalAC, $totalAEA, $totalDE, $totalEM];
                            $colors = ['611232', 'a5722c', 'e6d194', '1e5b4f', '98989a']; // pastel colors
                            $text_colors = [
                                [97, 18, 50],      // #611232
                                [165, 114, 44],    // #a5722c
                                [230, 209, 148],   // #e6d194
                                [30, 91, 79],      // #1e5b4f
                                [152, 152, 154],   // #98989a
                            ];
                            $labels = [
                                'ÁREAS PRINCIPALES',
                                'ÁREAS COMUNES',
                                'ÁREAS EDUCATIVAS ADICIONALES',
                                'ELEMENTOS',
                                'EQUIPO Y MOBILIARIO DAÑADO'
                            ];
                            $size = 350;
                            $img = imagecreatetruecolor($size, $size);
                            imagesavealpha($img, true);
                            $trans = imagecolorallocatealpha($img, 255, 255, 255, 127);
                            imagefill($img, 0, 0, $trans);

                            $total = array_sum($data);
                            $start = 0;
                            $white = imagecolorallocate($img, 255, 255, 255);
                            // Definir colores de texto por índice
                            $gd_text_colors = [];
                            foreach ($text_colors as $rgb) {
                                $gd_text_colors[] = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]);
                            }
                            // Para fuente TTF, buscar una fuente básica
                            $fontFile = __DIR__ . '/../public/assets/fonts/arial.ttf';
                            if (!file_exists($fontFile)) {
                                // fallback a fuente del sistema (no garantizado en servidor)
                                $fontFile = '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf';
                            }
                            for ($i = 0; $i < count($data); $i++) {
                                if ($data[$i] <= 0) continue;
                                $angle = ($data[$i] / $total) * 360;
                                sscanf($colors[$i], "%02x%02x%02x", $r, $g, $b);
                                $col = imagecolorallocate($img, $r, $g, $b);
                                imagefilledarc($img, $size / 2, $size / 2, $size - 20, $size - 20, $start, $start + $angle, $col, IMG_ARC_PIE);
                                // Calcular el ángulo medio para el texto del porcentaje
                                $midAngle = deg2rad($start + $angle / 2);
                                $radius = ($size - 60) / 2;
                                $textX = (int)($size / 2 + $radius * cos($midAngle) - 12);
                                $textY = (int)($size / 2 + $radius * sin($midAngle) - 6);
                                $percent = round($data[$i] / $total * 100);
                                $label = $percent . '%';
                                // Dibuja el texto del porcentaje en blanco y fuente tamaño 2 (aprox 12px)
                                imagestring($img, 2, $textX, $textY, $label, $white);

                                // --- Dibuja el texto del nombre del apartado ---
                                $label_text = $labels[$i];
                                // Desplazamiento radial mayor que el radio del pastel (afuera del círculo)
                                $textRadius = ($size - 10) / 2 + 22;
                                $labelAngle = $midAngle;
                                $lx = (int)($size / 2 + $textRadius * cos($labelAngle));
                                $ly = (int)($size / 2 + $textRadius * sin($labelAngle));
                                // Ajuste vertical para centrar texto
                                $fontSize = 11; // px (usando imagettftext)
                                $angle_deg = 0;
                                $colorText = $gd_text_colors[$i];
                                // Si la fuente TTF existe, usar imagettftext, si no, fallback a imagestring
                                if (file_exists($fontFile) && function_exists('imagettftext')) {
                                    // Ajustar para que el texto no se salga del canvas
                                    $bbox = imagettfbbox($fontSize, $angle_deg, $fontFile, $label_text);
                                    $textWidth = abs($bbox[2] - $bbox[0]);
                                    $textHeight = abs($bbox[7] - $bbox[1]);
                                    // Centrar el texto horizontalmente
                                    $lx_adj = $lx - (int)($textWidth / 2);
                                    $ly_adj = $ly + (int)($textHeight / 2);
                                    imagettftext($img, $fontSize, $angle_deg, $lx_adj, $ly_adj, $colorText, $fontFile, $label_text);
                                } else {
                                    // Fallback: imagestring, tamaño 3, ajustar posición
                                    $lx_adj = $lx - (int)(strlen($label_text) * imagefontwidth(3) / 2);
                                    $ly_adj = $ly - (int)(imagefontheight(3) / 2);
                                    imagestring($img, 3, $lx_adj, $ly_adj, $label_text, $colorText);
                                }

                                $start += $angle;
                            }
                            // centro en blanco
                            $inner = imagecolorallocate($img, 255, 255, 255);
                            imagefilledellipse($img, $size / 2, $size / 2, $size / 2, $size / 2, $inner);
                            ob_start();
                            imagepng($img);
                            $chartBase64 = base64_encode(ob_get_clean());
                            imagedestroy($img);
                            ?>
                            <img src="data:image/png;base64,<?= $chartBase64 ?>" width="250" height="250" alt="Gráfica de pastel">

                        </td>
                    </tr>
                </table>

            </div>





            <div style="page-break-before: always;"></div>
            <br><br><br>

            <?php
            $secciones = [
                ['tabla' => 'detalle_areas_principales', 'titulo' => 'Áreas principales'],
                ['tabla' => 'detalle_areas_comunes', 'titulo' => 'Áreas comunes'],
                ['tabla' => 'detalle_areas_adicionales', 'titulo' => 'Áreas adicionales'],
                ['tabla' => 'detalle_elementos', 'titulo' => 'Elementos afectados'],
                ['tabla' => 'detalle_equipo', 'titulo' => 'Equipo dañado'],
                ['tabla' => 'detalle_mobiliario', 'titulo' => 'Mobiliario dañado'],
            ];
            $html = renderDetalleFiltrado($pdo, $secciones, $id_reporte);
            if (!empty($html)) echo $html;
            ?>
            <!-- <h4>Imagen demo</h4>
            <img src="https://quickchart.io/chart?c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Users',data:[120,60,50,180,120]}]}}"> -->
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