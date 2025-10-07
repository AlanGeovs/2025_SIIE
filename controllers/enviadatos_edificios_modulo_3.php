<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php'; // Debe exponer $pdo (PDO)


// Recuperar variables de sesión
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
$id_ficha = isset($_SESSION['id_ficha']) ? $_SESSION['id_ficha'] : null;
$cct = isset($_SESSION['cct']) ? $_SESSION['cct'] : null;

// Recuperar datos del formulario
$cantidad_edificios = isset($_POST['numEdificaciones']) ? intval($_POST['numEdificaciones']) : 0;
$edificio_nums = isset($_POST['edificio_num']) ? $_POST['edificio_num'] : [];
$edificio_niveles = isset($_POST['edificio_niveles']) ? $_POST['edificio_niveles'] : [];

if ($cantidad_edificios < 1) {
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió la cantidad de edificios o es inválida.'
    ]);
    exit;
}

if (!is_array($edificio_nums) || !is_array($edificio_niveles)) {
    echo json_encode([
        'success' => false,
        'message' => 'Los datos de edificios no están en el formato esperado.'
    ]);
    exit;
}

if (count($edificio_nums) !== $cantidad_edificios || count($edificio_niveles) !== $cantidad_edificios) {
    echo json_encode([
        'success' => false,
        'message' => 'La cantidad de edificios no coincide con los datos enviados.'
    ]);
    exit;
}

try {
    $pdo->beginTransaction();

    // Insertar o actualizar en modulo_3
    // Buscar si ya existe un registro para esta ficha y cct
    $sql_buscar = "SELECT id_modulo3 FROM modulo_3 WHERE id_ficha = ? AND cct = ?";
    $stmt_buscar = $pdo->prepare($sql_buscar);
    $stmt_buscar->execute([$id_ficha, $cct]);
    $row = $stmt_buscar->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Actualizar registro existente
        $id_modulo3 = $row['id_modulo3'];
        $sql_update = "UPDATE modulo_3 SET num_edificaciones = ?, id_usuario = ? WHERE id_modulo3 = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([$cantidad_edificios, $usuario_id, $id_modulo3]);
    } else {
        // Insertar nuevo registro
        $sql_insert = "INSERT INTO modulo_3 (id_ficha, cct, num_edificaciones, id_usuario) VALUES (?, ?, ?, ?)";
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->execute([$id_ficha, $cct, $cantidad_edificios, $usuario_id]);
        $id_modulo3 = $pdo->lastInsertId();
    }

    // Eliminar registros anteriores de modulo_3_edificaciones para este id_modulo3
    $sql_delete = "DELETE FROM modulo_3_edificaciones WHERE id_modulo3 = ?";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->execute([$id_modulo3]);

    // Insertar los edificios
    $sql_insert_edif = "INSERT INTO modulo_3_edificaciones (id_modulo3, id_ficha, cct, edificio_num, nivel, areas_principales, areas_adicionales, mobiliario, equipo)
                        VALUES (?, ?, ?, ?, ?, 0, 0, 0, 0)";
    $stmt_edif = $pdo->prepare($sql_insert_edif);

    for ($i = 0; $i < $cantidad_edificios; $i++) {
        $edificio_num = isset($edificio_nums[$i]) ? intval($edificio_nums[$i]) : null;
        $nivel = isset($edificio_niveles[$i]) ? intval($edificio_niveles[$i]) : 1;
        if ($nivel < 1 || $nivel > 4) {
            $nivel = 1;
        }
        if ($edificio_num === null) {
            // Si no se recibe número de edificio válido, asignar el índice + 1
            $edificio_num = $i + 1;
        }
        for ($n = 1; $n <= $nivel; $n++) {
            $stmt_edif->execute([$id_modulo3, $id_ficha, $cct, $edificio_num, $n]);
        }
    }

    $pdo->commit();
    echo json_encode([
        'success' => true,
        'message' => 'Datos guardados correctamente'
    ]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
