<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');

try {
    require_once __DIR__ . '/../config/db.php'; // Debe exponer $pdo (PDO)

    // Validar sesión mínima
    if (
        empty($_SESSION['id_ficha']) ||
        empty($_SESSION['cct']) ||
        empty($_SESSION['usuario_id'])
    ) {
        echo json_encode(['success' => false, 'message' => 'Sesión expirada o incompleta.']);
        exit;
    }

    $cct        = $_SESSION['cct'];
    $id_usuario = (int)$_SESSION['usuario_id'];
    $id_ficha   = (int)$_SESSION['id_ficha'];

    // ---- Sanitizador ----
    function sanitize($v)
    {
        if (is_array($v)) {
            return array_map('sanitize', $v);
        }
        return htmlspecialchars(trim((string)$v), ENT_QUOTES, 'UTF-8');
    }

    // Recibir POST saneado
    $post = sanitize($_POST);

    // Mapeo de valores recibidos (usar nombres SIN acentos)
    $verificacion            = $post['verificacion']            ?? null;
    $fecha_verificacion      = $post['fecha_verificacion']      ?? null;
    $organismo_verificador   = $post['organismo_verificador']   ?? null;

    // 4.1 Programa de PC
    $programa_pc             = $post['programa']                ?? null;
    $formato_programa        = $post['formato_programa']        ?? null; // (si el select tiene name en el HTML)
    $documentos_programa     = $post['documentos_programa']     ?? null; // array (checkbox)
    $documentos_programa_json = $documentos_programa ? json_encode($documentos_programa, JSON_UNESCAPED_UNICODE) : null;

    // Responsable (en el HTML aún no llevan name, quedarán NULL si no existen)
    $responsable_nombre      = $post['responsable_nombre']      ?? null;
    $responsable_apellido_p  = $post['responsable_apellido_p']  ?? null;
    $responsable_apellido_m  = $post['responsable_apellido_m']  ?? null;
    $responsable_tel_fijo    = $post['responsable_tel_fijo']    ?? null;
    $responsable_tel_movil   = $post['responsable_tel_movil']   ?? null;
    $capacitacion_responsable = $post['capacitacion_responsable'] ?? null;
    $tipo_capacitacion       = $post['capacitacion_tipo']       ?? null;

    // Brigadas (checkbox múltiple)
    $brigadas                = $post['brigadas']                ?? null;
    $brigadas_json           = $brigadas ? json_encode($brigadas, JSON_UNESCAPED_UNICODE) : null;

    // 4.4.1 Simulacros
    $simulacros              = $post['simulacros']              ?? null;
    // En el HTML se envía como "simulacro_periodo"
    $periodicidad_simulacros = $post['simulacro_periodo']       ?? null;

    // 4.5 Bitácora
    $bitacora                = $post['bitacora']                ?? null;
    $fecha_bitacora          = $post['fecha_bitacora']          ?? null;

    // 4.6 Programa de seguridad (sí/no a nivel general)
    $programa_seguridad      = $post['tiene_programas_seguridad'] ?? null;

    // 4.7 Materiales peligrosos (sí/no a nivel general)
    $materiales_peligrosos   = $post['materiales']              ?? null;

    // 4.1.2 Elementos de PC (sí/no a nivel general)
    $elementos_pc_flag       = $post['elementos_pc']            ?? null;

    // Señalamientos (sí/no a nivel general) -> deducir si hay alguno con "si"
    $senalamientos_flag = 'no';
    for ($i = 0; $i < 5; $i++) {
        if (($post["senalamiento_existe_{$i}"] ?? '') === 'si') {
            $senalamientos_flag = 'si';
            break;
        }
    }

    // 4.8 Dictamen estructural
    $dictamen_estructural    = $post['dictamen_estructural']    ?? null;
    $fecha_emision           = $post['fecha_emision']           ?? null; // YEAR (opcional)
    $quien_emitio            = $post['quien_emitio']            ?? null; // (opcional)

    // 4.8.1 Amenazas naturales
    $amenazas_naturales      = $post['naturales']               ?? null;
    $existencia_arroyo       = $post['existencia_arroyo']       ?? null;
    $existencia_barranca     = $post['existencia_barranca']     ?? null;
    $existencia_falla_geologica      = $post['existencia_falla_geologica']      ?? null;
    $existencia_hundimiento_regional = $post['existencia_hundimiento_regional'] ?? null;
    $existencia_inundacion   = $post['existencia_inundacion']   ?? null;
    $existencia_ladera       = $post['existencia_ladera']       ?? null;
    $existencia_rio          = $post['existencia_rio']          ?? null;
    $ubicacion_rio           = $post['ubicacion_rio']           ?? null;
    $existencia_talud        = $post['existencia_talud']        ?? null;

    // 4.8.2 Amenazas externas
    $amenazas_externas                 = $post['externos']                            ?? null;
    $existencia_externo_amenaza_vial   = $post['existencia_externo_amenaza_vial']    ?? null;
    $ubicacion_externo_amenaza_vial    = $post['ubicacion_externo_amenaza_vial']     ?? null;
    $existencia_externo_causa_social   = $post['existencia_externo_causa_social']    ?? null;
    $existencia_externo_ducto_de_combustible_o_de_gas = $post['existencia_externo_ducto_de_combustible_o_de_gas'] ?? null;
    $existencia_externo_gasera         = $post['existencia_externo_gasera']          ?? null;
    $ubicacion_externo_gasera          = $post['ubicacion_externo_gasera']           ?? null;
    $existencia_externo_gasolinera     = $post['existencia_externo_gasolinera']      ?? null;

    // --------- Transacción ---------
    $pdo->beginTransaction();

    // ¿Existe ya registro de módulo 4?
    $stmt = $pdo->prepare("SELECT id_modulo4 FROM modulo_4 WHERE id_ficha = ? AND cct = ?");
    $stmt->execute([$id_ficha, $cct]);
    $id_modulo4 = $stmt->fetchColumn();

    if ($id_modulo4) {
        // UPDATE sólo con columnas existentes en la tabla
        $sql = "UPDATE modulo_4 SET
                    verificacion = ?, fecha_verificacion = ?, organismo_verificador = ?,
                    programa_pc = ?, formato_programa = ?, documentos_programa = ?,
                    responsable_nombre = ?, responsable_apellido_p = ?, responsable_apellido_m = ?,
                    responsable_tel_fijo = ?, responsable_tel_movil = ?, capacitacion_responsable = ?, tipo_capacitacion = ?,
                    simulacros = ?, periodicidad_simulacros = ?,
                    bitacora = ?, fecha_bitacora = ?,
                    dictamen_estructural = ?, fecha_emision = ?, quien_emitio = ?,
                    elementos_pc = ?, senalamientos = ?, programa_seguridad = ?, materiales_peligrosos = ?,
                    amenazas_naturales = ?, amenazas_externas = ?
                WHERE id_ficha = ? AND cct = ?";
        $pdo->prepare($sql)->execute([
            $verificacion,
            $fecha_verificacion,
            $organismo_verificador,
            $programa_pc,
            $formato_programa,
            $documentos_programa_json,
            $responsable_nombre,
            $responsable_apellido_p,
            $responsable_apellido_m,
            $responsable_tel_fijo,
            $responsable_tel_movil,
            $capacitacion_responsable,
            $tipo_capacitacion,
            $simulacros,
            $periodicidad_simulacros,
            $bitacora,
            $fecha_bitacora,
            $dictamen_estructural,
            $fecha_emision,
            $quien_emitio,
            $elementos_pc_flag,
            $senalamientos_flag,
            $programa_seguridad,
            $materiales_peligrosos,
            $amenazas_naturales,
            $amenazas_externas,
            $id_ficha,
            $cct
        ]);
    } else {
        // INSERT sólo con columnas existentes en la tabla
        $sql = "INSERT INTO modulo_4 (
                    id_ficha, cct,
                    verificacion, fecha_verificacion, organismo_verificador,
                    programa_pc, formato_programa, documentos_programa,
                    responsable_nombre, responsable_apellido_p, responsable_apellido_m,
                    responsable_tel_fijo, responsable_tel_movil, capacitacion_responsable, tipo_capacitacion,
                    simulacros, periodicidad_simulacros,
                    bitacora, fecha_bitacora,
                    dictamen_estructural, fecha_emision, quien_emitio,
                    elementos_pc, senalamientos, programa_seguridad, materiales_peligrosos,
                    amenazas_naturales, amenazas_externas
                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $pdo->prepare($sql)->execute([
            $id_ficha,
            $cct,
            $verificacion,
            $fecha_verificacion,
            $organismo_verificador,
            $programa_pc,
            $formato_programa,
            $documentos_programa_json,
            $responsable_nombre,
            $responsable_apellido_p,
            $responsable_apellido_m,
            $responsable_tel_fijo,
            $responsable_tel_movil,
            $capacitacion_responsable,
            $tipo_capacitacion,
            $simulacros,
            $periodicidad_simulacros,
            $bitacora,
            $fecha_bitacora,
            $dictamen_estructural,
            $fecha_emision,
            $quien_emitio,
            $elementos_pc_flag,
            $senalamientos_flag,
            $programa_seguridad,
            $materiales_peligrosos,
            $amenazas_naturales,
            $amenazas_externas
        ]);
        $id_modulo4 = (int)$pdo->lastInsertId();
    }

    // --------- Tablas complementarias ---------

    // 4.1.2 Elementos de PC
    $pdo->prepare("DELETE FROM modu_4_elementos_pc WHERE id_ficha = ? AND cct = ?")->execute([$id_ficha, $cct]);
    $elementosPCMap = [
        0 => 'Alarma',
        1 => 'Alerta sísmica',
        2 => 'Botiquín de primeros auxilios',
        3 => 'Extintor',
    ];
    foreach ($elementosPCMap as $i => $nombreElem) {
        $existe   = $post["pc_existe_{$i}"]   ?? null;
        if ($existe === 'si') {
            $cantidad = $post["pc_cantidad_{$i}"] ?? null;
            $en_uso   = $post["pc_enuso_{$i}"]    ?? null;
            $cond     = $post["pc_condicion_{$i}"] ?? null;

            $sql = "INSERT INTO modu_4_elementos_pc
                        (id_modulo4, id_ficha, cct, elemento, existencia, cantidad, en_uso, condicion)
                    VALUES (?,?,?,?,?,?,?,?)";
            $pdo->prepare($sql)->execute([
                $id_modulo4,
                $id_ficha,
                $cct,
                $nombreElem,
                'si',
                $cantidad,
                $en_uso,
                $cond
            ]);
        }
    }

    // 4.4 Señalamientos
    $pdo->prepare("DELETE FROM modu_4_senalamientos WHERE id_ficha = ? AND cct = ?")->execute([$id_ficha, $cct]);
    $senalesMap = [
        0 => 'Extintor',
        1 => 'Punto de reunión',
        2 => 'Ruta de evacuación',
        3 => 'Salida de emergencia',
        4 => 'Zona de seguridad',
    ];
    foreach ($senalesMap as $i => $nombreSenal) {
        $existe = $post["senalamiento_existe_{$i}"] ?? null;
        if ($existe === 'si') {
            $cantidad = $post["senalamiento_cantidad_{$i}"]  ?? null;
            $en_uso   = $post["senalamiento_enuso_{$i}"]     ?? null;
            $cond     = $post["senalamiento_condicion_{$i}"] ?? null;

            $sql = "INSERT INTO modu_4_senalamientos
                        (id_modulo4, id_ficha, cct, tipo_senalamiento, existencia, cantidad, en_uso, condicion)
                    VALUES (?,?,?,?,?,?,?,?)";
            $pdo->prepare($sql)->execute([
                $id_modulo4,
                $id_ficha,
                $cct,
                $nombreSenal,
                'si',
                $cantidad,
                $en_uso,
                $cond
            ]);
        }
    }

    // 4.6 Programas de seguridad
    $pdo->prepare("DELETE FROM modu_4_prog_seguridad WHERE id_ficha = ? AND cct = ?")->execute([$id_ficha, $cct]);
    $programasSeguridad = [
        0 => 'Atención a personas con discapacidad',
        1 => 'Control de entrada con gafetes',
        2 => 'Restricción de acceso a áreas peligrosas',
        3 => 'Protocolo ante amenaza de bomba',
        4 => 'Reglas para personal de vigilancia',
        5 => 'Seguridad en cocinas y comedores',
        6 => 'Uso de estacionamiento escolar',
        7 => 'Uso adecuado de aparatos eléctricos',
    ];
    foreach ($programasSeguridad as $i => $nombreProg) {
        $aplica = $post["programa_{$i}"] ?? null;
        if ($aplica === 'si') {
            $sql = "INSERT INTO modu_4_prog_seguridad
                        (id_modulo4, id_ficha, cct, programa, aplica)
                    VALUES (?,?,?,?,?)";
            $pdo->prepare($sql)->execute([
                $id_modulo4,
                $id_ficha,
                $cct,
                $nombreProg,
                'si'
            ]);
        }
    }

    // 4.7 Materiales peligrosos
    $pdo->prepare("DELETE FROM modu_4_materiales_peligrosos WHERE id_ficha = ? AND cct = ?")->execute([$id_ficha, $cct]);
    $materialesMap = [
        0 => 'Ácido muriático',
        1 => 'Hipoclorito de sodio (cloro)',
        2 => 'Alcohol etílico',
        3 => 'Formol',
        4 => 'Sosa cáustica',
        5 => 'Detergente industrial',
        6 => 'Reactivos de laboratorio',
        7 => 'Solventes y thinner',
        8 => 'Gas LP',
        9 => 'Amoniaco',
    ];
    foreach ($materialesMap as $i => $nombreMat) {
        $cuenta = $post["cuenta_{$i}"] ?? null;
        if ($cuenta === 'si') {
            $almacenados  = $post["almacenados_{$i}"]  ?? null;
            $senalamiento = $post["senalamientos_{$i}"] ?? null;
            $hojas        = $post["hojas_{$i}"]        ?? null;
            $capacitacion = $post["capacitacion_{$i}"] ?? null;

            $sql = "INSERT INTO modu_4_materiales_peligrosos
                        (id_modulo4, id_ficha, cct, material, cuenta, almacenados, senalamientos, hojas_seguridad, capacitacion)
                    VALUES (?,?,?,?,?,?,?,?,?)";
            $pdo->prepare($sql)->execute([
                $id_modulo4,
                $id_ficha,
                $cct,
                $nombreMat,
                'si',
                $almacenados,
                $senalamiento,
                $hojas,
                $capacitacion
            ]);
        }
    }

    // 4.8.1 Amenazas naturales
    $pdo->prepare("DELETE FROM modu_4_amenazas_naturales WHERE id_ficha = ? AND cct = ?")->execute([$id_ficha, $cct]);
    if ($amenazas_naturales === 'si') {
        $naturalesKeys = [
            'arroyo'               => [$existencia_arroyo,               ($post['ubicacion_arroyo'] ?? null)],
            'barranca'             => [$existencia_barranca,             ($post['ubicacion_barranca'] ?? null)],
            'falla_geologica'      => [$existencia_falla_geologica,      ($post['ubicacion_falla_geologica'] ?? null)],
            'hundimiento_regional' => [$existencia_hundimiento_regional, ($post['ubicacion_hundimiento_regional'] ?? null)],
            'inundacion'           => [$existencia_inundacion,           ($post['ubicacion_inundacion'] ?? null)],
            'ladera'               => [$existencia_ladera,               ($post['ubicacion_ladera'] ?? null)],
            'rio'                  => [$existencia_rio,                  $ubicacion_rio],
            'talud'                => [$existencia_talud,                ($post['ubicacion_talud'] ?? null)],
        ];
        foreach ($naturalesKeys as $amenaza => [$existe, $ubic]) {
            if ($existe === 'si') {
                $sql = "INSERT INTO modu_4_amenazas_naturales
                            (id_modulo4, id_ficha, cct, amenaza, existencia, zona_ubicacion)
                        VALUES (?,?,?,?,?,?)";
                $pdo->prepare($sql)->execute([
                    $id_modulo4,
                    $id_ficha,
                    $cct,
                    $amenaza,
                    'si',
                    $ubic
                ]);
            }
        }
    }

    // 4.8.2 Amenazas externas
    $pdo->prepare("DELETE FROM modu_4_amenazas_externas WHERE id_ficha = ? AND cct = ?")->execute([$id_ficha, $cct]);
    if ($amenazas_externas === 'si') {
        $externasKeys = [
            'amenaza_vial'                    => [$existencia_externo_amenaza_vial,    $ubicacion_externo_amenaza_vial],
            'causa_social'                    => [$existencia_externo_causa_social,    ($post['ubicacion_externo_causa_social'] ?? null)],
            'ducto_de_combustible_o_de_gas'   => [$existencia_externo_ducto_de_combustible_o_de_gas, ($post['ubicacion_externo_ducto_de_combustible_o_de_gas'] ?? null)],
            'gasera'                          => [$existencia_externo_gasera,          $ubicacion_externo_gasera],
            'gasolinera'                      => [$existencia_externo_gasolinera,      ($post['ubicacion_externo_gasolinera'] ?? null)],
        ];
        foreach ($externasKeys as $amenaza => [$existe, $ubic]) {
            if ($existe === 'si') {
                $sql = "INSERT INTO modu_4_amenazas_externas
                            (id_modulo4, id_ficha, cct, amenaza, existencia, zona_ubicacion)
                        VALUES (?,?,?,?,?,?)";
                $pdo->prepare($sql)->execute([
                    $id_modulo4,
                    $id_ficha,
                    $cct,
                    $amenaza,
                    'si',
                    $ubic
                ]);
            }
        }
    }

    // Marcar módulo 4 como capturado
    $pdo->prepare("UPDATE fichas SET m4 = 1 WHERE id_ficha = ?")->execute([$id_ficha]);

    $pdo->commit();
    echo json_encode(['success' => true, 'message' => 'Datos de Módulo 4 guardados correctamente.']);
    exit;
} catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo json_encode(['success' => false, 'message' => 'Error SQL: ' . $e->getMessage()]);
    exit;
} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    exit;
}
