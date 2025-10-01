<?php

require_once __DIR__ . '/../config/db.php';
global $pdo;
require_once __DIR__ . '/../templates/header.php';

session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: acceso");
    exit();
}


// Configuración de paginación
$porPagina = 50;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina * $porPagina) - $porPagina : 0;

// Contar total de registros
$stmtTotal = $pdo->query("SELECT COUNT(*) FROM siniestros");
$totalRegistros = $stmtTotal->fetchColumn();
$totalPaginas = ceil($totalRegistros / $porPagina);

// Obtener datos con JOIN
$stmt = $pdo->prepare("
    SELECT 
        s.id,
        s.cct,
        p.nombre,
        p.entidad,
        p.municipio,
        s.tipo_siniestro,
        s.creado
    FROM siniestros s
    LEFT JOIN planteles p ON s.cct = p.cct
    ORDER BY s.creado DESC
    LIMIT :inicio, :porPagina
");
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':porPagina', $porPagina, PDO::PARAM_INT);
$stmt->execute();
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold" style="color: #691C32;">Listado de Reportes </h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>CCT</th>
                    <th>Nombre Escuela</th>
                    <th>Entidad</th>
                    <th>Municipio</th>
                    <th>Tipo de Siniestro</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reportes as $reporte): ?>
                    <tr>
                        <td><?= $reporte['id'] ?></td>
                        <td><?= $reporte['cct'] ?></td>
                        <td><?= $reporte['nombre'] ?></td>
                        <td><?= $reporte['entidad'] ?></td>
                        <td><?= $reporte['municipio'] ?></td>
                        <td><?= $reporte['tipo_siniestro'] ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($reporte['creado'])) ?></td>
                        <td>
                            <a href="ver_reporte.php?id=<?= $reporte['id'] ?>" target="_blank" class="btn btn-sm btn-primary">Ver</a>
                            <?php if ($_SESSION['correo'] === 'admin@sia.mx'): ?>
                                <a href="../controllers/detalle_reporte_controller.php?action=eliminar&id=<?= $reporte['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este reporte?');">Eliminar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?= ($pagina === $i) ? 'active' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>