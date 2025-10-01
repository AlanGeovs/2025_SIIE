

<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_reporte = $_POST['id_reporte'] ?? null;

    if (!$id_reporte) {
        http_response_code(400);
        echo 'ID de reporte faltante.';
        exit;
    }

    global $pdo;

    // Obtener datos del reporte y del plantel
    $stmt = $pdo->prepare("
        SELECT s.*, p.nombre, p.turno, p.nivel_educativo, p.entidad, p.municipio, p.domicilio, p.n_ext, p.cp, p.cct
        FROM siniestros s
        INNER JOIN planteles p ON s.cct = p.cct
        WHERE s.id = :id
    ");
    $stmt->execute([':id' => $id_reporte]);
    $reporte = $stmt->fetch();

    if (!$reporte) {
        http_response_code(404);
        echo 'Reporte no encontrado.';
        exit;
    }

    // Función auxiliar para obtener datos por tabla
    function obtenerDetalles($tabla, $pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE id_siniestro = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll();
    }

    $tablas = [
        'detalle_areas_principales' => 'Áreas principales dañadas',
        'detalle_areas_adicionales' => 'Áreas adicionales dañadas',
        'detalle_areas_comunes' => 'Áreas comunes dañadas',
        'detalle_elementos' => 'Elementos dañados',
        'detalle_mobiliario' => 'Mobiliario dañado',
        'detalle_equipo' => 'Equipo dañado',
    ];

    $bloques = '';
    foreach ($tablas as $tabla => $titulo) {
        $datos = obtenerDetalles($tabla, $pdo, $id_reporte);
        if (!empty($datos)) {
            $bloques .= "<h3 style='color:#691c32;'>$titulo</h3>";
            $bloques .= "<table border='1' width='100%' cellspacing='0' cellpadding='5'>";
            $bloques .= "<thead><tr><th>Elemento</th><th>Cantidad</th><th>Zona</th><th>Tipo de daño</th><th>Evidencia</th></tr></thead><tbody>";
            foreach ($datos as $fila) {
                $img = (!empty($fila['evidencia']) && filter_var($fila['evidencia'], FILTER_VALIDATE_URL))
                    ? "<img src='{$fila['evidencia']}' width='200' />"
                    : (!empty($fila['evidencia']) ? "<img src='https://sia.inifed.mx/uploads/{$fila['evidencia']}' width='200' />" : 'Sin evidencia');
                $bloques .= "<tr>
                    <td>{$fila['elemento']}</td>
                    <td>{$fila['cantidad']}</td>
                    <td>{$fila['zona']}</td>
                    <td>{$fila['tipo_dano']}</td>  
                    <td>{$fila['evidencia']}<br>$img</td>
                </tr>";
            }
            $bloques .= "</tbody></table><br>";
        }
    }

    ob_start();
    include '../views/reporte_template.php';
    $html = ob_get_clean();

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("reporte_siniestro_{$id_reporte}.pdf", ["Attachment" => true]);
}
?> 