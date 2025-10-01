<?php
session_start();

require_once __DIR__ . '/../config/db.php';

header('Content-Type: text/csv; charset=utf-8');

$fechaHora = date('Ymd');
// Cambiar el nombre del archivo a reportes_siniestros_fecha_hora.csv
header("Content-Disposition: attachment; filename=reportes_siniestros_{$fechaHora}.csv");
// header('Content-Disposition: attachment; filename=reportes_siniestros.csv');

$output = fopen('php://output', 'w');

// Encabezados del CSV
fputcsv($output, [
    'CCT',
    'Nombre',
    'Nivel Educativo',
    'Entidad',
    'Municipio',
    'Localidad',
    'Turno',
    'Domicilio',
    'No. Ext',
    'CP',
    'ID Siniestro',
    'Fecha Reporte',
    'Tipo Siniestro',
    'Nivel Atención',
    'Brigadas Activadas',
    'Áreas Principales',
    'Áreas Comunes',
    'Áreas Educativas Adicionales',
    'Elementos',
    'Equipo',
    'Mobiliario'
]);

$query = "
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
    ORDER BY s.id DESC
";

$stmt = $pdo->query($query);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}

fclose($output);
exit;
