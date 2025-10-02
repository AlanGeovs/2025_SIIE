<?php
$title = $title ?? 'Sistema de Infraestructura Educativa (SIIE)';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PKLQ7PBGYQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-PKLQ7PBGYQ');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Agrega style.css     -->
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="../public/assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../public/assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../public/assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../public/assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../public/assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../public/assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../public/assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../public/assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../public/assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../public/assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../public/assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../public/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../public/assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../public/assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <style>
        :root {
            --color-principal: #691C32;
        }

        body {
            font-family: 'Lato', sans-serif;
        }

        .navbar-sia {
            background-color: white;
            padding-top: 5px;
            padding-bottom: 5px;
            border-bottom: 3px solid var(--color-principal);
        }

        .navbar-sia .navbar-brand,
        .navbar-sia .navbar-text,
        .navbar-sia .nav-link {
            color: var(--color-principal);
            padding: 0.05rem 1rem;
        }

        .nav-link.active,
        .nav-link:focus,
        .nav-link:hover {
            color: var(--color-principal) !important;
            text-decoration: underline;
        }

        footer.bg-sia {
            background-color: var(--color-principal);
            color: white;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <header class="border-bottom bg-white py-2">
        <div class="container d-none d-md-flex justify-content-between align-items-center flex-wrap" style="max-width: 1200px;">
            <!-- Primer tercio: Logo SEP e INIFED -->
            <div class="d-flex align-items-center" style="flex: 1; justify-content: flex-start;">
                <img src="/public/assets/img/logosep.png" alt="SEP" class="me-2" style="max-height: 60px;">
                <img src="/public/assets/img/logo-inifed.png" alt="INIFED" style="max-height: 60px;">
            </div>

            <!-- Segundo tercio: Título -->
            <div class="text-center flex-grow-1" style="flex: 1;">
                <h1 class="header-title h5 m-0">Sistema de Infraestructura Educativa (SIIE)</h1>
                <span class="subTitle">Ficha de Diagnóstico</span>
            </div>

            <!-- Tercer tercio: Usuario y botón de salir -->
            <div class="d-flex align-items-center justify-content-end" style="flex: 1;">
                <!-- poner los datos del CCT, nombre, Turno, nivel -->
                <?php
                if (!isset($_SESSION['tipo_usuario']) || !in_array($_SESSION['tipo_usuario'], ['aseguradora', 'admin'], true)):
                    // Array de entidades federativas
                    $entidades = [
                        "01" => "Aguascalientes",
                        "02" => "Baja California",
                        "03" => "Baja California Sur",
                        "04" => "Campeche",
                        "05" => "Coahuila",
                        "06" => "Colima",
                        "07" => "Chiapas",
                        "08" => "Chihuahua",
                        "09" => "Ciudad de México",
                        "10" => "Durango",
                        "11" => "Guanajuato",
                        "12" => "Guerrero",
                        "13" => "Hidalgo",
                        "14" => "Jalisco",
                        "15" => "México",
                        "16" => "Michoacán",
                        "17" => "Morelos",
                        "18" => "Nayarit",
                        "19" => "Nuevo León",
                        "20" => "Oaxaca",
                        "21" => "Puebla",
                        "22" => "Querétaro",
                        "23" => "Quintana Roo",
                        "24" => "San Luis Potosí",
                        "25" => "Sinaloa",
                        "26" => "Sonora",
                        "27" => "Tabasco",
                        "28" => "Tamaulipas",
                        "29" => "Tlaxcala",
                        "30" => "Veracruz",
                        "31" => "Yucatán",
                        "32" => "Zacatecas"
                    ];
                    $cct = $_SESSION['cct'] ?? '';
                    $entidadCodigo = substr($cct, 0, 2);
                    $entidadNombre = $entidades[$entidadCodigo] ?? '';
                ?>
                    <div class="me-3 text-dark">
                        <div class="fw-semibold">CCT: <?= $cct ?: 'CCT' ?></div>
                        <?php if ($entidadNombre): ?>
                            <div class="text-muted small">Entidad: <?= htmlspecialchars($entidadNombre) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <a href="/logout" class="btn btn-sm text-white" style="background-color: var(--color-principal);">Salir</a>
            </div>
        </div>

        <!-- Versión móvil -->
        <div class="d-flex d-md-none justify-content-between align-items-center px-3 py-2 border-bottom bg-white">
            <div class="d-flex align-items-center">
                <img src="/public/assets/img/logo-inifed.png" alt="INIFED" style="height: 60px;">
            </div>
            <button class="navbar-toggler border-0" style="background-color: white; color: #691c32;" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbar" aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars fa-lg" style="color: #691c32;"></i>
            </button>
        </div>

        <div class="collapse d-md-none" id="mobileNavbar" style="background-color: #f8f9fa;">
            <div class="px-3 py-2 border-top bg-white">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/dashboard"><i class="fas fa-exclamation-circle me-2"></i>Ficha de Diagnóstico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <?php if (isset($_SESSION['tipo_usuario']) && in_array($_SESSION['tipo_usuario'], ['aseguradora', 'admin'], true)): ?>
        <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navMenu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?= (($_GET['url'] ?? '') === 'dashboard') ? 'active' : '' ?>" href="/dashboard">Dashboard</a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link <?= (($_GET['url'] ?? '') === 'captura-reporte') ? 'active' : '' ?>" href="/captura-reporte">Nuevo reporte</a>
                    </li> -->
                        <li class="nav-item">
                            <a class="nav-link <?= (($_GET['url'] ?? '') === 'reportes') ? 'active' : '' ?>" href="/reportes">Lista de reportes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (($_GET['url'] ?? '') === 'documentacion') ? 'active' : '' ?>" href="/documentacion">Documentación API</a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link <?= (($_GET['url'] ?? '') === 'estadisticas') ? 'active' : '' ?>" href="/estadisticas">Estadísticas</a> 
                    </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <main class="container my-4 flex-fill">