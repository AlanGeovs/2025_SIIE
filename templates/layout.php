<?php
// layout.php – para incluir en todas las vistas
$title = $title ?? 'Sistema de Infraestructura Educativa (SIIE)';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SIA - INIFED</a>
      <span class="navbar-text text-white d-none d-sm-inline">
        <?= $_SESSION['nombre'] ?? 'Usuario' ?>
      </span>
    </div>
  </nav>

  <main class="container my-4 flex-fill">


  </main>

  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <small>INIFED &copy; <?= date('Y') ?>. Todos los derechos reservados.</small>
  </footer>

</body>

</html>