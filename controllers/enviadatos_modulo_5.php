<?php
session_start();
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido");
    }

    if (!isset($_SESSION['usuario_id'], $_SESSION['cct'], $_SESSION['id_ficha'])) {
        throw new Exception("Sesión inválida");
    }


    $cct =          $_SESSION['cct'] ?? '';
    $id_usuario =   $_SESSION['usuario_id'] ?? 0;
    $id_ficha =     $_SESSION['id_ficha'] ?? 0;

    $years = range(2017, 2025);
    $insertados = 0;

    // Normaliza el valor principal (si/no)
    $respPrincipal = isset($_POST['recursos_publicos']) ? strtolower(trim($_POST['recursos_publicos'])) : null;

    if ($respPrincipal === 'si') {
        foreach ($years as $year) {
            // Detectar checkbox marcado ya sea con name="year-YYYY" o name="year[YYYY]"
            $huboRecurso = 0;
            if (isset($_POST["year-$year"])) {
                $huboRecurso = 1;
            } elseif (isset($_POST['year']) && is_array($_POST['year']) && isset($_POST['year'][$year])) {
                $huboRecurso = 1;
            }
            if ($huboRecurso === 0) {
                continue; // no marcado, no se guarda
            }

            // Obtener monto desde monto-YYYY o monto[YYYY]
            $monto = null;
            if (isset($_POST["monto-$year"])) {
                $monto = $_POST["monto-$year"];
            } elseif (isset($_POST['monto']) && is_array($_POST['monto']) && isset($_POST['monto'][$year])) {
                $monto = $_POST['monto'][$year];
            }

            // Obtener tipo_recurso desde tipo_recurso-YYYY o tipo_recurso[YYYY]
            $tipoRecurso = null;
            if (isset($_POST["tipo_recurso-$year"])) {
                $tipoRecurso = $_POST["tipo_recurso-$year"];
            } elseif (isset($_POST['tipo_recurso']) && is_array($_POST['tipo_recurso']) && isset($_POST['tipo_recurso'][$year])) {
                $tipoRecurso = $_POST['tipo_recurso'][$year];
            }

            // Insert para el año marcado
            $ins = $pdo->prepare("INSERT INTO modulo5 (id_ficha, cct, anio, hubo_recurso, monto, tipo_recurso, id_usuario) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?)");
            $ins->execute([$id_ficha, $cct, $year, 1, $monto, $tipoRecurso, $id_usuario]);
            $insertados++;
        }
    } elseif ($respPrincipal === 'no') {
        // Registrar un único renglón que indique que NO hubo recursos
        $ins = $pdo->prepare("INSERT INTO modulo5 (id_ficha, cct, anio, hubo_recurso, monto, tipo_recurso, id_usuario) 
                              VALUES (?, ?, NULL, 0, NULL, NULL, ?)");
        $ins->execute([$id_ficha, $cct, $id_usuario]);
        $insertados++;
    }

    // Marcar módulo 5 capturado si se insertó algo (si lo prefieres, puedes marcarlo siempre tras intentar guardar)
    if ($insertados > 0) {
        $stmt = $pdo->prepare("UPDATE fichas SET m5 = 1 WHERE id_ficha = :id_ficha");
        $stmt->execute([':id_ficha' => $id_ficha]);
    }

    echo json_encode(["success" => true, "message" => "Datos de Módulo 5 guardados correctamente"]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
