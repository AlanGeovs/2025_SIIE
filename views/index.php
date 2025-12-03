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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Alerta de Daños - INIFED</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <meta name="msapplication-TileImage" content="../public/assets/img/logo-inifed-sia.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Sistema de Infraestructura Educativa (SIIE) - Ficha de Diagnóstico .....">
    <meta name="keywords" content="SIIE, Infraestructura Educativa, INIFED, Ficha de Diagnóstico, Centros de Trabajo, Planteles Educativos, CCT">
    <meta name="author" content="INIFED">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Sistema de Infraestructura Educativa - INIFED">
    <meta property="og:description" content="Sistema de Infraestructura Educativa (SIIE) - Ficha de Diagnóstico ..... ">
    <meta property="og:image" content="https://siie2.inifed.mx/public/assets/img/portadaSIIE.png" />

    <meta property="og:image:width" content="750">
    <meta property="og:image:height" content="375">
    <meta property="og:url" content="https://siie2.inifed.mx">

    <style>

    </style>
</head>


<body>
    <header class=" d-flex justify-content-center border-bottom py-2 bg-white">
        <div class="container d-none d-md-flex justify-content-between align-items-center flex-wrap" style="max-width: 1200px;">
            <div class="d-flex align-items-center justify-content-start" style="flex: 0 0 40%;">
                <img src="../public/assets/img/logosep.png" alt="SEP" class="header-logo me-2" style="max-height: 60px;">
                <img src="../public/assets/img/logo-inifed.png" alt="INIFED" class="header-logo" style="max-height: 60px;">
            </div>

            <div class="text-center d-flex flex-column align-items-center justify-content-center" style="flex: 0 0 40%;">
                <h1 class="header-title h5 m-0">Sistema de Infraestructura Educativa (SIIE)</h1>
                <span class="subTitle">Ficha de Diagnóstico</span>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="flex: 0 0 20%;">
                <img src="../public/assets/img/gobmujer.png" alt="Gobierno Mujer" class="header-logo" style="max-height: 60px;">
            </div>
        </div>
        <!-- Mobile header actualizado -->
        <div class="d-flex d-md-none justify-content-between align-items-center px-3 py-2 border-bottom bg-white" style="background-color: white;">
            <div class="d-flex align-items-center">
                <img src="../public/assets/img/logo-inifed.png" alt="INIFED" style="height: 60px;">
            </div>
            <button class="navbar-toggler border-0" style="background-color: white; color: #691c32;" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbar" aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars fa-lg" style="color: #691c32;"></i>
            </button>
        </div>

        <div class="collapse d-md-none" id="mobileNavbar" style="background-color: #f8f9fa;">
            <div class="px-3 py-2 border-top" style="background-color: white;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="login"><i class="fas fa-sign-in-alt me-2"></i>Ficha de Diagnóstico</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>


    <!-- Floating Sistema de Alerta de Daños -->
    <!-- Versión móvil: botón flotante inferior -->
    <a href="https://sia.inifed.mx" target="_blank" class="btn-alerta-danos d-md-none"
        style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
        <i class="fas fa-exclamation-triangle me-2"></i>Sistema de Alerta de Daños
    </a>

    <!-- 🔴 Imagen flotante (solo escritorio) -->
    <a href="https://sia.inifed.mx" target="_blank" class="d-none d-md-block"
        style="position: fixed; top: 85px; right: 25px; z-index: 1050; transition: transform 0.3s ease, box-shadow 0.3s ease;">
        <img src="../public/assets/img/sia-min.png"
            alt="Sistema de Alerta de Daños"
            style="width: 140px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); transition: transform 0.3s ease, box-shadow 0.3s ease;">
    </a>

    <style>
        @keyframes pulse-glow-desktop {
            0% {
                transform: scale(1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, .3);
            }

            50% {
                transform: scale(1.08);
                box-shadow: 0 0 25px rgba(105, 28, 50, .7);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, .3);
            }
        }

        .d-md-block:hover img {
            animation: pulse-glow-desktop 1.2s ease-in-out;
        }
    </style>



    <!-- Sección principal -->
    <section class="hero">
        <div class="container px-3 px-md-4" style="max-width: 1200px;">
            <div class="row justify-content-start">
                <div class="col-md-6 mt-5 text-start hero-content">
                    <div class="text-start">
                        <h2>Sistema de Infraestructura Educativa (SIIE)</h2>
                        <h3>Ficha de Diagnóstico</h3>
                        <p>
                            Si participaste en la muestra realizada para las entidades de la
                            Cuenca Balsas - Pacífico Sur (Guerrero, Jalisco, Estado de México,
                            Michoacán, Morelos, Oaxaca, Puebla y Tlaxcala) con el correo
                            electrónico y contraseña que te registraste:
                        </p>
                        <div class="text-center">
                            <div class="button-container my-3">
                                <a href="/login" class="btn btn-sia-rojo" style="padding-left: 35px; padding-right: 35px">
                                    Inicia sesión
                                </a>
                            </div>
                            <p style="margin-top: 15px; text-align: center">
                                De lo contrario realiza un nuevo registro
                            </p>
                            <div class="button-container mt-3">
                                <a href="/registro" class="btn btn-sia-blanco" style="padding-left: 35px; padding-right: 35px">
                                    Nuevo registro
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Sección de soporte -->
    <section class="section-support">
        <h3 style="color:#691c32; font-weight: bold; margin-bottom: 2rem;">¿Tienes alguna consulta?</h3>
        <div class="container">
            <div class="row justify-content-center g-4">
                <div class="col-md-8">
                    <div class="support-card h-100">
                        <div class="  justify-content-center gap-2 mb-3">
                            <i class="fas fa-phone-alt fa-2x" style="color: #691c32;"></i>
                            <h3 class="mb-0" style="font-size: 1.3em; color: #691c32;">Centro de Atención Telefónica</h3>
                        </div>
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <div class="border rounded p-3 h-100">
                                    <h4 style="font-size: 1em; color: #691c32;">Región <span style="font-weight: 900; font-size: 1.2em;">1</span></h4>
                                    <a href="tel:5554804711">55 5480 4711</a>
                                    <p class="mb-0 small text-muted">Baja California, Baja California Sur, Chihuahua, Durango, Jalisco, Nayarit, Sinaloa, Sonora.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="border rounded p-3 h-100">
                                    <h4 style="font-size: 1em; color: #691c32;">Región <span style="font-weight: 900; font-size: 1.2em;">2</span></h4>
                                    <a href="tel:5554804779">55 5480 4779</a>
                                    <p class="mb-0 small text-muted">Aguascalientes, Coahuila, Guanajuato, Nuevo León, San Luis Potosí, Tamaulipas, Zacatecas.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="border rounded p-3 h-100">
                                    <h4 style="font-size: 1em; color: #691c32;">Región <span style="font-weight: 900; font-size: 1.2em;">3</span></h4>
                                    <a href="tel:5554804775">55 5480 4775</a>
                                    <p class="mb-0 small text-muted">Campeche, Chiapas, Oaxaca, Quintana Roo, Tabasco, Yucatán.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="border rounded p-3 h-100">
                                    <h4 style="font-size: 1em; color: #691c32;">Región <span style="font-weight: 900; font-size: 1.2em;">4</span></h4>
                                    <a href="tel:5554804792">55 5480 4792</a>
                                    <p class="mb-0 small text-muted">CDMX, Guerrero, Hidalgo, Morelos, Puebla, Tlaxcala.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="border rounded p-3 h-100">
                                    <h4 style="font-size: 1em; color: #691c32;">Región <span style="font-weight: 900; font-size: 1.2em;">5</span></h4>
                                    <a href="tel:5554804714">55 5480 4714</a>
                                    <p class="mb-0 small text-muted">Colima, Estado de México, Michoacán de Ocampo, Querétaro, Veracruz.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="support-card h-100">
                        <div class=" justify-content-center gap-2 mb-3">
                            <i class="fas fa-envelope fa-2x" style="color: #691c32;"></i>
                            <h3 class="mb-0" style="font-size: 1.3em; color: #691c32;">O, envíanos un correo electrónico a:</h3>
                        </div>
                        <a href="mailto:atencion@inifed.gob.mx" style="font-size: 1.15em;">atencion@inifed.gob.mx</a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- <div class="d-none d-md-block">
        <div style="position: relative; height: 180px; background-image: radial-gradient(at top center, #F2F6FEB3 0%, #FFFFFF 50%), url('../public/assets/img/bg_pattern_2.png'); background-repeat: repeat; background-size: 30px 30px;">
            <div class="elementor-background-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255,255,255,0.75);"></div>
            <img src="../public/assets/img/plecaSEP_INIFED.png" alt="Pleca INIFED" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-height: 120px;">
        </div>
    </div> -->
    <div class="d-block d-md-none text-center py-4" style="background-color: white;">
        <img src="../public/assets/img/logosep.png" alt="SEP" style="max-height: 60px; margin: 1em 10px;"><br>

        <img src="../public/assets/img/gobmujer.png" alt="Gobierno Mujer" style="max-height: 80px; margin: 1em 10px;">
    </div>

    <footer class="text-center py-3  p-2" style="background-color:#691c32; color:white; font-size: 0.9rem;">
        Sistema de Infraestructura Educativa (SIIE) - v1.0 - INIFED &copy; <?= date('Y') ?> | Desarrollado por la Gerencia del Sistema Nacional de Información
    </footer>
</body>

</html>