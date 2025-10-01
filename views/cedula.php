<!doctype html>
<html lang="en">

<style>
    .custom-dropdown {
        position: relative;
        max-width: 320px;
        margin: 0px 0;
        width: 100%;
    }

    .custom-dropdown .dropdown-toggle {
        background-color: #fff;
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        cursor: pointer;
        font-size: 14px;
        width: 100%;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .custom-dropdown .dropdown-toggle:after {
        content: '▾';
        font-size: 12px;
        color: #6b7280;
    }

    .custom-dropdown .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #fff;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        margin-top: 5px;
        z-index: 100;
        display: none;
    }

    .custom-dropdown .radio-group {
        padding: 8px;
    }

    .custom-dropdown .radio-option {
        display: block;
        border: 2px solid transparent;
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 8px;
        background-color: #fff;
        cursor: pointer;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .custom-dropdown .radio-option:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .custom-dropdown .radio-option.selected {
        border-color: #2563eb;
    }

    .custom-dropdown .radio-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .custom-dropdown .radio-text h4 {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 3px;
    }

    .custom-dropdown .radio-text p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    .custom-dropdown .radio-content input[type="radio"] {
        margin-top: 4px;
        width: 16px;
        height: 16px;
        accent-color: #2563eb;
    }

    #barra {
        width: 200px;
        padding: 10px;
        border-right: 1px solid #ccc;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .forma {
        width: 50px;
        height: 50px;
        margin: 10px;
        cursor: grab;
        position: relative;
        /* Necesario para el triángulo */
    }

    .cuadrado {
        background-color: red;
    }

    .circulo {
        background-color: blue;
        border-radius: 50%;
    }

    .rectangulo {
        background-color: green;
        height: 30px;
    }

    #zonaDibujo {
        flex-grow: 1;
        position: relative;
        border: 1px solid #000;
        height: 500px;
        cursor: crosshair;
    }

    .elemento {
        position: absolute;
        cursor: grab;
    }

    #lapiz {
        margin-top: 10px;
        padding: 5px;
        background-color: lightblue;
        cursor: pointer;
    }

    #goma {
        margin-top: 10px;
        padding: 5px;
        background-color: lightcoral;
        cursor: pointer;
    }

    .linea {
        position: absolute;
        background-color: black;
        height: 5px;
        /* Grosor de la línea (pluma) */
        transform-origin: 0 50%;
        /* Para rotar desde un extremo */
    }

    /* Desplegable de  DropDwn*/
    .custom-dropdown .dropdown-toggle {
        width: 150%;
    }

    .custom-dropdown .dropdown-menu {
        position: absolute;
        width: 150%;
    }

    .titulo-enfatico {
        font-size: 1.3rem;
        /* Tamaño de letra más grande */
        font-weight: 700;
        /* Asegura que sea bold */
        letter-spacing: 0.07em;
        /* Espaciado entre letras */
        line-height: 1.3;
        /* Mejora la legibilidad en 2 líneas */
        color: #611232;
        /* Color oscuro legible */
    }


    .tituloTablaDestacado {
        background-color: #611232;
        font-size: 1.3em;
        font-weight: 900;
        color: #d1d5db;
    }
</style>

<head>

    <meta charset="utf-8" />
    <title>Sistema de Infraestructura Educativa - SIIE</title>
    <link
        rel="manifest"
        href="https://sia.inifed.mx/public/assets/img/favicon/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage"
        content="https://sia.inifed.mx/public/assets/img/logo-inifed.png"">
    <meta name=" theme-color" content="#ffffff" />
    <meta
        name="description"
        content="Sistema de Infraestructura Educativa (SIIE) - Ficha de Diagnóstico ....." />
    <meta
        name="keywords"
        content="SIIE, Alerta de Daños, INIFED, Reporte de Siniestro, Centros de Trabajo, Planteles Educativos, CCT" />
    <meta name="author" content="INIFED" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="index, follow" />
    <meta property="og:type" content="website" />
    <meta
        property="og:title"
        content="Sistema de Infraestructura Educativa (SIIE) - INIFED" />
    <meta
        property="og:description"
        content="Sistema de Infraestructura Educativa (SIIE) - Ficha de Diagnóstico ..... " />
    <meta
        property="og:image"
        content="https://sia.inifed.mx/public/assets/img/logo-inifed.png" />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap"
        rel="stylesheet" />
    <meta content="Alan G Velázquez - Sistema Nacional de Información - INIFED" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/inif.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="assets/libs/twitter-bootstrap-wizard/prettify.css">

    <!-- preloader css -->
    <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header" style="background-color: white; z-index: 9999; position: fixed; top: 0; left: 0; width: 100%;">
                <div class="d-flex flex-wrap justify-content-between align-items-center w-100 p-3">
                    <div class="d-flex align-items-center">
                        <span class="ms-3 me-5">
                            <img src="assets/images/logoInifed.svg" alt="Logo" height="44">
                        </span>

                        <!-- Agrupamos los encabezados para que se acomoden en columna -->
                        <div class="d-flex flex-column">
                            <h1 class="text-dark mb-0" style="font-size: 1.6em; font-weight: bold;">Sistema de Infraestructura Educativa (SIIE) </h4>
                                <h2 class="titulo-enfatico">Ficha de Diagnóstico</h5>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <span class="me-5 d-none d-md-inline">
                            <strong>CCT:</strong> 15EJN4255J
                        </span>
                        <span class="me-5 d-none d-md-inline">
                            <strong>Entidad:</strong> Estado de México
                        </span>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="assets/images/users/avatarmaestro.jpg" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-3 fw-medium">
                                    Mtro. Rafael Estrada
                                </span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <style>
            @media (max-width: 768px) {
                .navbar-header {
                    flex-direction: column;
                    /* Cambiar a columna en pantallas pequeñas */
                    text-align: center;
                    /* Centrar el texto */
                }

                .app-search {
                    flex-direction: column;
                    /* Cambiar a columna para el formulario en móviles */
                }

                .h5,
                .me-4 {
                    margin: 10px 0;
                    /* Agregar espacio entre elementos en móviles */
                }
            }

            /* Asegurar que la barra de navegación sea responsiva */
            .navbar-header {
                padding: 20px;
                /* Aumentar padding para mayor espacio interno */
            }

            .app-search {
                flex: 1;
                /* Permitir que la barra de búsqueda use el espacio disponible */
            }

            .d-flex.flex-wrap {
                flex-wrap: wrap;
                /* Permitir que los elementos se envuelvan */
            }
        </style>
        <!-- ========== Left Sidebar Start ========== -->

        <!-- Left Sidebar End -->

        <style>
            .container-fullwidth {
                width: 100%;
                /* Ocupa el 100% del ancho de la pantalla */
                padding: 0;
                /* Elimina el padding si lo tiene */
                margin: 0;
                /* Elimina el margin si lo tiene */
                box-sizing: border-box;
                /* Asegura que el padding y border se incluyan en el ancho total */
            }

            /* Asegúrate que otros elementos no limiten el ancho */
            .main-content,
            .page-content {
                width: 100%;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
        </style>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <div id="progrss-wizard" class="twitter-bs-wizard">
                                        <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified" style="margin-top: 100px; z-index: 999; position: relative;">
                                            <li class="nav-item">
                                                <a href="#progress-personal-info" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="I. Descripción del Centro de Trabajo">
                                                        I
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#progress-contact-info" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="II. Accesibilidad y servicios básicos">
                                                        II
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#progress-shipping-address" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="III. Descripción de la infraestructura del inmueble">
                                                        III
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#progress-payment-details" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="IV. Áreas comunes">
                                                        IV
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#progress-order-summary" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="V. Inversión social">
                                                        V
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#progress-confirmation" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="VI. Datos legales del Centro de Trabajo">
                                                        VI
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- HTML -->
                                        <div id="bar" class="progress mt-4">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-wine"></div>
                                        </div>

                                        <!-- CSS -->
                                        <style>
                                            .bg-wine {
                                                background-color: #611232;
                                                /* Color vino oscuro especificado */
                                            }
                                        </style>
                                        <div class="tab-content twitter-bs-wizard-tab-content">
                                            <div class="tab-pane" id="progress-personal-info">
                                                <form>
                                                    <div class="card-header">
                                                        <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">I. DATOS DEL CENTRO DE TRABAJO</h4>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label for="cct-checkbox">1. Registra la Clave del Centro de Trabajo (CCT):</label>

                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <form id="cct-form">
                                                                        <div class="mb-3">
                                                                            <input placeholder="Escribe la Clave del Centro de Trabajo: ejemplo (15EJN4255J)" type="text" maxlength="10" class="form-control" required>
                                                                            <div class="form-text"></div>
                                                                        </div>
                                                                </div>

                                                            </div>
                                                            <br>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label for="cct-checkbox">1.1 ¿Tu Centro de Trabajo cuenta con un CCT asociado a otro turno?:
                                                                        <span style="color: red;">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <input type="radio" id="cct-yes" name="cct" value="yes" onclick="toggleOptions(true)">
                                                                    <label for="cct-yes">Sí</label>
                                                                    <input type="radio" id="cct-no" name="cct" value="no" onclick="toggleOptions(false)" checked>
                                                                    <label for="cct-no">No</label>
                                                                </div>



                                                            </div>
                                                            <div class="col-lg-12 margin-left-3">
                                                                <div id="options" style="display: none;" class="col-lg-12">
                                                                    <br>
                                                                    <label>1.1.1 Turno <span style="color: #8f9092;">(selecciona el o los turnos)</span>:</label><br>
                                                                    <p></p>
                                                                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                                                                        <div>
                                                                            <input type="checkbox" id="turno-matutino" value="Matutino" onchange="updateSelectedTurns()">
                                                                            <label for="turno-matutino">Matutino 8:00 a 12:30</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox" id="turno-vespertino" value="Vespertino" onchange="updateSelectedTurns()">
                                                                            <label for="turno-vespertino">Vespertino 14:00 a 16:30</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox" id="turno-nocturno" value="Nocturno" onchange="updateSelectedTurns()">
                                                                            <label for="turno-nocturno">Nocturno 19:00 a 21:00</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox" id="turno-jornada-ampliada" value="Jornada Ampliada" onchange="updateSelectedTurns()">
                                                                            <label for="turno-jornada-ampliada">Jornada ampliada 8:00 a 14:30</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox" id="turno-continuo" value="Continuo" onchange="updateSelectedTurns()">
                                                                            <label for="turno-continuo">Continuo 8:00 a 16:00</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox" id="turno-discontinuo" value="Discontinuo" onchange="updateSelectedTurns()">
                                                                            <label for="turno-discontinuo">Discontinuo 2 turnos en un mismo día</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        function toggleOptions(isVisible) {
                                                            const optionsDiv = document.getElementById('options');
                                                            optionsDiv.style.display = isVisible ? 'block' : 'none';
                                                            document.getElementById('selected-turns').innerHTML = ''; // Limpiar selecciones previas
                                                        }
                                                    </script>


                                                    <div class="row">
                                                        <br>
                                                        <br>
                                                        <div class="col-lg-4">
                                                            <br>

                                                            <div class="mb-3">
                                                                <label for="progresspill-firstname-input">Nombre del plantel:<span style="color: red;">*</span></label>
                                                                <input type="text" class="form-control" id="progresspill-firstname-input" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label>Domicilio:</label>
                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="progresspill-firstname-input">Calle:<span style="color: red;">*</span></label>
                                                                <input type="text" class="form-control" id="progresspill-firstname-input" placeholder="Ingresa Calle">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="progresspill-lastname-input">No. Int:<span style="color: red;">*</span></label>
                                                                <input type="text" class="form-control" id="progresspill-lastname-input" placeholder="No. Int">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="progresspill-lastname-input">No. Ext:<span style="color: red;">*</span></label>
                                                                <input type="text" class="form-control" id="progresspill-lastname-input" placeholder="No. Ext">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="progresspill-lastname-input">Municipio: <span style="color: red;">*</span></label>
                                                                <input type="text" class="form-control" id="progresspill-lastname-input" placeholder="Municipio">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="progresspill-lastname-input">Colonia:<span style="color: red;">*</span></label>
                                                                <input type="text" class="form-control" id="progresspill-lastname-input" placeholder="Colonia">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">


                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="progresspill-firstname-input">Número de salones:<span style="color: red;">*</span></label>
                                                                <input type="text" class="form-control" id="progresspill-firstname-input" placeholder="Ej: 5">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="progresspill-lastname-input">Número de alumnos:<span style="color: red;">*</span></label>
                                                                <input type="number" class="form-control" id="progresspill-lastname-input" placeholder="Ej: 30" min="0" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="cargo-select">Nivel escolar:<span style="color: red;">*</span></label>
                                                                <select class="form-control" id="cargo-select">
                                                                    <option value="" disabled selected> Nivel escolar</option>

                                                                    <option value="inicial">Inicial</option>
                                                                    <option value="preescolar">Preescolar</option>
                                                                    <option value="primaria">Primaria</option>
                                                                    <option value="secundaria">Secundaria</option>
                                                                    <option value="bachillerato">Bachillerato</option>
                                                                    <option value="licenciatura">Licenciatura</option>
                                                                    <option value="posgrado">Posgrado</option>
                                                                    <option value="formacion_trabajo">Formación para el trabajo</option>
                                                                    <option value="centro_atencion_multiple">Centro de Atención Múltiple (CAM)</option>
                                                                    <option value="profesional">Profesional</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="mb-2">
                                                                <label for="cargo-select">Turno:<span style="color: red;">*</span></label>
                                                                <select class="form-control" id="cargo-select">
                                                                    <option value="" disabled selected>Turno</option>
                                                                    <option value="continuo">Continuoㅤㅤㅤㅤㅤㅤㅤ 8:00 a 16:00</option>
                                                                    <option value="discontinuo">Discontinuoㅤㅤ ㅤ ㅤ ㅤ 2 turnos en un mismo día</option>
                                                                    <option value="jornada">Jornada ampliada ㅤㅤㅤ8:00 a 14:30</option>
                                                                    <option value="matutino">Matutino ㅤㅤㅤㅤㅤㅤㅤ8:00 a 12:30</option>
                                                                    <option value="nocturno">Nocturno ㅤ ㅤㅤ ㅤ ㅤㅤ19:00 a 21:00</option>
                                                                    <option value="vespertino">Vespertino ㅤ ㅤ ㅤ ㅤ ㅤ14:00 a 16:30</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="row mt-4">

                                                            <label for="cargo-select">1.2 Antigüedad aproximada del inmueble:<span style="color: red;">*</span></label>
                                                            <div class="col-md-4"> <!-- Columna para el select -->


                                                                <select class="form-control" id="cargo-select" style="max-width: 250px;">
                                                                    <option value="" disabled selected></option>
                                                                    <option value="ceroadiez">Cero a 10 años</option>
                                                                    <option value="oncemas">De 11 a 20 años</option>
                                                                    <option value="veintiunomas">De 21 a 30 años</option>
                                                                    <option value="treintaunomas">De 31 a 40 años</option>
                                                                    <option value="cuarentaunomas">De 41 a 50 años</option>
                                                                    <option value="ciencuentaunomas">Más de 51 años</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2 ">

                                                                <div class="  "> <!-- Mantiene alineación -->
                                                                    <button type="button" class="btn btn-primary w-100" id="toggle-dropzone" style="margin-left: -100px;">
                                                                        Agrega evidencia
                                                                    </button>
                                                                </div>
                                                                <div id="dropzone-container" class="mt-2" style="display:none;">
                                                                    <form action="/upload" class="dropzone" id="myDropzone">
                                                                        <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                        <div class="fallback">
                                                                            <input type="file" name="file" />
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <row>



                                                                <div class="col-lg-8">
                                                                    <div class="mb-4">
                                                                        <!-- Fila 1 -->
                                                                        <div class="row align-items-center mb-3">
                                                                            <!-- Columna 1: Label -->
                                                                            <div class="col-md-6">
                                                                                <br>
                                                                                <label class="form-label">
                                                                                    1.3 ¿El inmueble está catalogado por su valor artístico, arqueológico, histórico y/o antropológico?
                                                                                    <span style="color: red;">*</span>
                                                                                </label>
                                                                            </div>

                                                                            <!-- Columna 2: Checkboxes -->
                                                                            <div class="col-md-6">
                                                                                <div class="d-flex gap-4">
                                                                                    <label class="d-flex align-items-center gap-1">
                                                                                        Sí <input type="radio" id="catalogado-checkbox" value="SI">
                                                                                    </label>
                                                                                    <label class="d-flex align-items-center gap-1">
                                                                                        No <input type="radio" id="no-catalogado-checkbox" value="NO">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Fila 2 -->
                                                                        <div class="row align-items-center" id="fila-opciones" style="display:none;">
                                                                            <!-- Columna 1: Select -->
                                                                            <div class="col-md-4">
                                                                                <select id="opcionarqueolo-select" class="form-control">
                                                                                    <option value=""></option>
                                                                                    <option value="INBAL">INBAL</option>
                                                                                    <option value="INAH">INAH</option>
                                                                                    <option value="AMBOS">AMBOS</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-lg-3">


                                                                                <div class="d-flex align-items-center"> <!-- Mantiene alineación -->
                                                                                    <button type="button" class="btn btn-primary w-100" id="toggle-dropzone" style="margin-left: 0px;">
                                                                                        Agrega evidencia
                                                                                    </button>
                                                                                </div>
                                                                                <div id="dropzone-container" style="display:none;">
                                                                                    <form action="/upload" class="dropzone" id="myDropzone">
                                                                                        <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                                        <div class="fallback">
                                                                                            <input type="file" name="file" />
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <!-- Script -->
                                                                        <script>
                                                                            const noCheckbox = document.getElementById('catalogado-checkbox');
                                                                            const siCheckbox = document.getElementById('no-catalogado-checkbox');
                                                                            const filaOpciones = document.getElementById('fila-opciones');
                                                                            const dropzoneContainer = document.getElementById('dropzone-container2');
                                                                            const toggleDropzoneBtn = document.getElementById('toggle-dropzone2');

                                                                            siCheckbox.addEventListener('change', () => {
                                                                                if (siCheckbox.checked) {
                                                                                    noCheckbox.checked = false;
                                                                                    filaOpciones.style.display = 'none';
                                                                                    dropzoneContainer.style.display = 'none';
                                                                                }
                                                                            });

                                                                            noCheckbox.addEventListener('change', () => {
                                                                                if (noCheckbox.checked) {
                                                                                    siCheckbox.checked = false;
                                                                                    filaOpciones.style.display = 'flex';
                                                                                } else {
                                                                                    filaOpciones.style.display = 'none';
                                                                                    dropzoneContainer.style.display = 'none';
                                                                                }
                                                                            });

                                                                            toggleDropzoneBtn.addEventListener('click', () => {
                                                                                dropzoneContainer.style.display =
                                                                                    dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                            });
                                                                        </script>
                                                                    </div>
                                                                </div>

                                                        </div>

                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link mt-4" style="list-style-type: none; padding: 0; display: flex; align-items: center;">


                                                    <li class="next" style="display: inline-block; background-color: #007bff; color: white; border-radius: 5px; overflow: hidden;">
                                                        <a href="javascript: void(0);" class="btn" style="color: white; border: none; border-radius: 5px; padding: 10px 15px; text-decoration: none; display: block;">
                                                            Guardar Módulo 1 <i class="fas fa-save"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" id="progress-contact-info">
                                                <div>
                                                    <form>
                                                        <div class="card-header">
                                                            <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">II. ACCESIBILIDAD Y SERVICIOS BÁSICOS DEL CENTRO DE TRABAJO</h4>
                                                        </div>

                                                        <style>
                                                            .no-gutter {
                                                                padding-left: 0;
                                                                padding-right: 0;
                                                            }

                                                            .column-space {
                                                                padding: 0 !important;
                                                                /* Eliminando el espacio alrededor de las columnas */
                                                            }
                                                        </style>
                                                        <div class="row no-margin"> <!-- Contenedor principal -->
                                                            <div class="col-sm-12"> <!-- Fila 1: Label que ocupa el ancho completo -->
                                                                <div class="mb-2">
                                                                    <label for="nivel-accesibilidad">2. Nivel de accesibilidad del Centro de Trabajo.<span style="color: red;">*</span></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6"> <!-- Fila 2: Columna 1 - Select -->
                                                                <div class="mb-2">
                                                                    <div class="dropdown custom-dropdown" data-dropdown>
                                                                        <div class="dropdown-toggle" data-toggle>
                                                                            <!-- Puedes adicionar texto aquí si es necesario, por ejemplo "Selecciona una opción" -->
                                                                        </div>
                                                                        <div class="dropdown-menu" data-menu>
                                                                            <div class="radio-group">
                                                                                <label class="radio-option selected" data-label="Accesibilidad total">
                                                                                    <div class="radio-content">
                                                                                        <div class="radio-text">
                                                                                            <h4>Accesibilidad total</h4>
                                                                                            <p>Cuenta con infraestructura idónea (andadores, rampas, pasamanos y barandales); ofrece el adecuado ingreso al inmueble; permite el desplazamiento en todas las áreas principales (salones, sanitarios y dirección), comunes (plaza cívica, canchas deportivas, domo y áreas de juegos), y/o adicionales (subdirección, administración, biblioteca, laboratorios, talleres, aula de usos múltiples y comedor) con que cuenta el inmueble.

                                                                                            </p>
                                                                                        </div>
                                                                                        <input type="radio" name="accesibilidad-1" checked>
                                                                                    </div>
                                                                                </label>



                                                                                <label class="radio-option" data-label="Accesibilidad mínima">
                                                                                    <div class="radio-content">
                                                                                        <div class="radio-text">
                                                                                            <h4>Accesibilidad mínima</h4>
                                                                                            <p>Cuenta con infraestructura suficiente para el ingreso al inmueble; permite el desplazamiento tan solo en las áreas principales existentes.</p>
                                                                                        </div>
                                                                                        <input type="radio" name="accesibilidad-1">
                                                                                    </div>
                                                                                </label>
                                                                                <label class="radio-option" data-label="Accesibilidad nula">
                                                                                    <div class="radio-content">
                                                                                        <div class="radio-text">
                                                                                            <h4>Accesibilidad nula</h4>
                                                                                            <p>Sin infraestructura para el ingreso al inmueble; con desplazamiento limitado en las áreas existentes.</p>
                                                                                        </div>
                                                                                        <input type="radio" name="accesibilidad-1">
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>


                                                        <!-- Red hidraulica  -->
                                                        <div class="col-lg-12">
                                                            <br>
                                                            <br>
                                                            <div class="row mb-4">
                                                                <div class="col-md-2">
                                                                    <label>
                                                                        2.1 ¿Existe red hidráulica?<span style="color: red;">*</span>
                                                                    </label>
                                                                    <input type="radio" id="redHidraulicaSi" value="SI" style="margin-left: 10px;"> Sí
                                                                    <input type="radio" id="redHidraulicaNo" value="NO"> No
                                                                </div>

                                                                <div class="col-md-6" id="condicionesRed" style="display: none;">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <label>2.1.1 ¿En qué condiciones se encuentra?</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="dropdown custom-dropdown" data-dropdown>
                                                                                <div class="dropdown-toggle" data-toggle></div>
                                                                                <div class="dropdown-menu" data-menu>
                                                                                    <div class="radio-group">
                                                                                        <label class="radio-option selected" data-label="Bueno">
                                                                                            <div class="radio-content">
                                                                                                <div class="radio-text">
                                                                                                    <h4>Buena</h4>
                                                                                                    <p>Funciona correctamente y cumple con su propósito.</p>
                                                                                                </div>
                                                                                                <input type="radio" name="grupo2" checked>
                                                                                            </div>
                                                                                        </label>
                                                                                        <label class="radio-option" data-label="Regular">
                                                                                            <div class="radio-content">
                                                                                                <div class="radio-text">
                                                                                                    <h4>Regular</h4>
                                                                                                    <p>Presenta pequeñas fallas o signos de desgaste.</p>
                                                                                                </div>
                                                                                                <input type="radio" name="grupo2">
                                                                                            </div>
                                                                                        </label>
                                                                                        <label class="radio-option" data-label="Malo">
                                                                                            <div class="radio-content">
                                                                                                <div class="radio-text">
                                                                                                    <h4>Mala</h4>
                                                                                                    <p>Tiene daños visibles o funcionales que lo hacen casi inservible.</p>
                                                                                                </div>
                                                                                                <input type="radio" name="grupo2">
                                                                                            </div>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Nueva columna para el botón "Agregar evidencia" -->
                                                                <div class="col-md-4" id="botonEvidenciaCol" style="display: none;">
                                                                    <button type="button" class="btn btn-primary" id="toggle-dropzone">
                                                                        Agregar evidencia
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div id="dropzone-container" class="mt-2" style="display:none;">
                                                                <form action="/upload" class="dropzone" id="myDropzone">
                                                                    <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                    <div class="fallback">
                                                                        <input type="file" name="file" />
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <script>
                                                                document.getElementById('redHidraulicaSi').addEventListener('change', function() {
                                                                    if (this.checked) {
                                                                        document.getElementById('condicionesRed').style.display = 'block';
                                                                        document.getElementById('redHidraulicaNo').checked = false; // Desmarcar "NO"
                                                                        document.getElementById('botonEvidenciaCol').style.display = 'block'; // Mostrar botón
                                                                    }
                                                                });

                                                                document.getElementById('redHidraulicaNo').addEventListener('change', function() {
                                                                    if (this.checked) {
                                                                        document.getElementById('condicionesRed').style.display = 'none';
                                                                        document.getElementById('redHidraulicaSi').checked = false; // Desmarcar "SI"
                                                                        document.getElementById('botonEvidenciaCol').style.display = 'none'; // Ocultar botón
                                                                    }
                                                                });

                                                                // Ocultar el botón de agregar evidencia inicialmente
                                                                document.getElementById('botonEvidenciaCol').style.display = 'none';

                                                                document.getElementById('toggle-dropzone').addEventListener('click', function() {
                                                                    const dropzoneContainer = document.getElementById('dropzone-container');
                                                                    dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                });
                                                            </script>
                                                        </div>

                                                        <!-- Red hidraulica Interna -->
                                                        <div class="col-lg-12">
                                                            <br>
                                                            <br>
                                                            <div class="row mb-4">
                                                                <div class="col-md-2">
                                                                    <label>
                                                                        2.2 ¿Existe red hidráulica interna?<span style="color: red;">*</span>
                                                                    </label>
                                                                    <input type="radio" id="redHidraulicaSiInt" value="SI" style="margin-left: 10px;"> Sí
                                                                    <input type="radio" id="redHidraulicaNoInt" value="NO"> No
                                                                </div>

                                                                <div class="col-md-6" id="condicionesRedInt" style="display: none;">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <label>2.2.1 ¿En qué condiciones se encuentra?</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="dropdown custom-dropdown" data-dropdown>
                                                                                <div class="dropdown-toggle" data-toggle></div>
                                                                                <div class="dropdown-menu" data-menu>
                                                                                    <div class="radio-group">
                                                                                        <label class="radio-option selected" data-label="Bueno">
                                                                                            <div class="radio-content">
                                                                                                <div class="radio-text">
                                                                                                    <h4>Buena</h4>
                                                                                                    <p>Funciona correctamente y cumple con su propósito.</p>
                                                                                                </div>
                                                                                                <input type="radio" name="grupo2" checked>
                                                                                            </div>
                                                                                        </label>
                                                                                        <label class="radio-option" data-label="Regular">
                                                                                            <div class="radio-content">
                                                                                                <div class="radio-text">
                                                                                                    <h4>Regular</h4>
                                                                                                    <p>Presenta pequeñas fallas o signos de desgaste.</p>
                                                                                                </div>
                                                                                                <input type="radio" name="grupo2">
                                                                                            </div>
                                                                                        </label>
                                                                                        <label class="radio-option" data-label="Malo">
                                                                                            <div class="radio-content">
                                                                                                <div class="radio-text">
                                                                                                    <h4>Mala</h4>
                                                                                                    <p>Tiene daños visibles o funcionales que lo hacen casi inservible.</p>
                                                                                                </div>
                                                                                                <input type="radio" name="grupo2">
                                                                                            </div>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Nueva columna para el botón "Agregar evidencia" -->
                                                                <div class="col-md-4" id="botonEvidenciaColInt" style="display: none;">
                                                                    <button type="button" class="btn btn-primary" id="toggle-dropzone">
                                                                        Agregar evidencia
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div id="dropzone-container" class="mt-2" style="display:none;">
                                                                <form action="/upload" class="dropzone" id="myDropzone">
                                                                    <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                    <div class="fallback">
                                                                        <input type="file" name="file" />
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <script>
                                                                document.getElementById('redHidraulicaSiInt').addEventListener('change', function() {
                                                                    if (this.checked) {
                                                                        document.getElementById('condicionesRedInt').style.display = 'block';
                                                                        document.getElementById('redHidraulicaNoInt').checked = false; // Desmarcar "NO"
                                                                        document.getElementById('botonEvidenciaColInt').style.display = 'block'; // Mostrar botón
                                                                    }
                                                                });

                                                                document.getElementById('redHidraulicaNoInt').addEventListener('change', function() {
                                                                    if (this.checked) {
                                                                        document.getElementById('condicionesRedInt').style.display = 'none';
                                                                        document.getElementById('redHidraulicaSiInt').checked = false; // Desmarcar "SI"
                                                                        document.getElementById('botonEvidenciaColInt').style.display = 'none'; // Ocultar botón
                                                                    }
                                                                });

                                                                // Ocultar el botón de agregar evidencia inicialmente
                                                                document.getElementById('botonEvidenciaColInt').style.display = 'none';

                                                                document.getElementById('toggle-dropzone').addEventListener('click', function() {
                                                                    const dropzoneContainer = document.getElementById('dropzone-container');
                                                                    dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                });
                                                            </script>
                                                        </div>

                                                        <!-- Tipo de servicio y suministro de agua -->
                                                        <div class="row mt-2"> <!-- Contenedor principal -->
                                                            <div class="col-sm-12"> <!-- Fila 1: Label que ocupa el ancho completo -->
                                                                <div>
                                                                    <br>
                                                                    <label for="tipo-suministro">2.3. Tipo de servicio y suministro de agua<span style="color: red;">*</span></label>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-2 "> <!-- Fila 2: Columna 1 - Tipo de Suministro -->
                                                                <div>
                                                                    <select class="form-control" id="cargo-select" style="background-color: white; color: rgb(0, 0, 0); border: 1px solid rgba(0, 0, 0, 0.411);">
                                                                        <option value="" disabled selected></option>
                                                                        <option value="acarreo">Acarreo</option>
                                                                        <option value="captación">Captación pluvial</option>
                                                                        <option value="cuerpo">Cuerpo de agua</option>
                                                                        <option value="pipa">Pipa</option>
                                                                        <option value="pozo">Pozo</option>
                                                                        <option value="red">Red municipal</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2"> <!-- Fila 2: Columna 2 - Botón -->
                                                                <div class="mb-2">
                                                                    <button type="button" class="btn btn-primary" id="toggle-dropzone4">
                                                                        Agregar evidencia
                                                                    </button>

                                                                    <div id="dropzone-container4" class="mt-2" style="display:none;">
                                                                        <form action="/upload" class="dropzone" id="myDropzone4">
                                                                            <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                            <div class="fallback">
                                                                                <input type="file" name="file" />
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                    <script>
                                                                        document.getElementById('toggle-dropzone4').addEventListener('click', function() {
                                                                            const dropzoneContainer = document.getElementById('dropzone-container4');
                                                                            dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                        });
                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-8">
                                                            <br>
                                                            <br>
                                                            <div class="mb-7">
                                                                <label>2.4 ¿Existe algún tipo de almacenamiento de agua?<span style="color: red;">*</span></label>
                                                                <div>
                                                                    <label>
                                                                        <input type="radio" id="existencia-si"> Sí
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" id="existencia-no"> No
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <br>

                                                            <div id="water-storage-table" style="display: none;">
                                                                <table class="table table-bordered table-sm align-middle text-center">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Tipo de Almacenamiento</th>
                                                                            <th>Existencia</th>
                                                                            <th>Cantidad</th>
                                                                            <th>En Uso</th>
                                                                            <th>Condición</th>
                                                                            <th style="background-color: #fff;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Cisterna</td>
                                                                            <td>
                                                                                <label><input type="radio" class="existencia-sí" onchange="handleExistenciaCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="existencia-no" onchange="handleExistenciaCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" onchange="updateRows(this)">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="10">10</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <label><input type="radio" class="en-uso-sí" onchange="handleEnUsoCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="en-uso-no" onchange="handleEnUsoCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control">
                                                                                    <option value="buen"></option>
                                                                                    <option value="bueno">Buena</option>
                                                                                    <option value="regular">Regular</option>
                                                                                    <option value="malo">Mala</option>
                                                                                </select>
                                                                            </td>

                                                                            <td>
                                                                                <button type="button" class="btn btn-primary" onclick="handleAgregarEvidencia('cisterna')">Agregar evidencia</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pileta</td>
                                                                            <td>
                                                                                <label><input type="radio" class="existencia-sí" onchange="handleExistenciaCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="existencia-no" onchange="handleExistenciaCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" onchange="updateRows(this)">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="10">10</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <label><input type="radio" class="en-uso-sí" onchange="handleEnUsoCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="en-uso-no" onchange="handleEnUsoCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control">
                                                                                    <option value="buen"></option>

                                                                                    <option value="bueno">Buena</option>
                                                                                    <option value="regular">Regular</option>
                                                                                    <option value="malo">Mala</option>
                                                                                </select>
                                                                            </td>

                                                                            <td>
                                                                                <button type="button" class="btn btn-primary" onclick="handleAgregarEvidencia('pileta')">Agregar evidencia</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tanque elevado</td>
                                                                            <td>
                                                                                <label><input type="radio" class="existencia-sí" onchange="handleExistenciaCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="existencia-no" onchange="handleExistenciaCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" onchange="updateRows(this)">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="10">10</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <label><input type="radio" class="en-uso-sí" onchange="handleEnUsoCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="en-uso-no" onchange="handleEnUsoCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control">
                                                                                    <option value="buen"></option>

                                                                                    <option value="bueno">Buena</option>
                                                                                    <option value="regular">Regular</option>
                                                                                    <option value="malo">Mala</option>
                                                                                </select>
                                                                            </td>

                                                                            <td>
                                                                                <button type="button" class="btn btn-primary" onclick="handleAgregarEvidencia('tanque elevado')">Agregar evidencia</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tambo</td>
                                                                            <td>
                                                                                <label><input type="radio" class="existencia-sí" onchange="handleExistenciaCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="existencia-no" onchange="handleExistenciaCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" onchange="updateRows(this)">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="10">10</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <label><input type="radio" class="en-uso-sí" onchange="handleEnUsoCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="en-uso-no" onchange="handleEnUsoCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control">
                                                                                    <option value="buen"></option>

                                                                                    <option value="bueno">Buena</option>
                                                                                    <option value="regular">Regular</option>
                                                                                    <option value="malo">Mala</option>
                                                                                </select>
                                                                            </td>

                                                                            <td>
                                                                                <button type="button" class="btn btn-primary" onclick="handleAgregarEvidencia('tambos')">Agregar evidencia</button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tinaco</td>
                                                                            <td>
                                                                                <label><input type="radio" class="existencia-sí" onchange="handleExistenciaCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="existencia-no" onchange="handleExistenciaCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" onchange="updateRows(this)">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="10">10</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <label><input type="radio" class="en-uso-sí" onchange="handleEnUsoCheckbox(this)"> Sí</label>
                                                                                <label><input type="radio" class="en-uso-no" onchange="handleEnUsoCheckbox(this)"> No</label>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control">
                                                                                    <option value="buen"></option>

                                                                                    <option value="bueno">Buena</option>
                                                                                    <option value="regular">Regular</option>
                                                                                    <option value="malo">Mala</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-primary" onclick="handleAgregarEvidencia('tinaco')">Agregar evidencia</button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            document.getElementById('existencia-si').addEventListener('change', function() {
                                                                if (this.checked) {
                                                                    document.getElementById('existencia-no').checked = false; // Desmarcar "No"
                                                                    document.getElementById('water-storage-table').style.display = 'block'; // Mostrar tabla
                                                                }
                                                            });

                                                            document.getElementById('existencia-no').addEventListener('change', function() {
                                                                if (this.checked) {
                                                                    document.getElementById('existencia-si').checked = false; // Desmarcar "Sí"
                                                                    document.getElementById('water-storage-table').style.display = 'none'; // Ocultar tabla
                                                                }
                                                            });

                                                            function handleExistenciaCheckbox(checkbox) {
                                                                const isChecked = checkbox.checked;
                                                                const otherCheckbox = (checkbox.classList.contains('existencia-sí')) ?
                                                                    document.querySelector('.existencia-no') :
                                                                    document.querySelector('.existencia-sí');

                                                                otherCheckbox.checked = !isChecked; // Desmarcar el checkbox opuesto
                                                            }

                                                            function handleEnUsoCheckbox(checkbox) {
                                                                const isChecked = checkbox.checked;
                                                                const otherCheckbox = (checkbox.classList.contains('en-uso-sí')) ?
                                                                    checkbox.closest('td').querySelector('.en-uso-no') :
                                                                    checkbox.closest('td').querySelector('.en-uso-sí');

                                                                otherCheckbox.checked = !isChecked; // Desmarcar el checkbox opuesto
                                                            }

                                                            function updateRows(selectElement) {
                                                                const quantity = parseInt(selectElement.value);
                                                                const row = selectElement.closest('tr');
                                                                const storageType = row.children[0].innerText; // Tipo de Almacenamiento

                                                                // Remover filas dinámicas previamente creadas
                                                                const rowsToRemove = Array.from(document.querySelectorAll(`.dynamic-row[data-type="${storageType}"]`));
                                                                rowsToRemove.forEach(row => row.remove());

                                                                // Crear nuevas filas según la cantidad seleccionada
                                                                if (quantity < 2) {
                                                                    return; // No se crean filas si la cantidad es menor a 2
                                                                }

                                                                const tableBody = document.getElementById('storageTable').querySelector('tbody');
                                                                for (let i = 1; i <= (quantity - 1); i++) { // Crear filas adicionales según la cantidad seleccionada
                                                                    const newRow = document.createElement('tr'); // Crear nueva fila
                                                                    newRow.classList.add('dynamic-row'); // Asignar clase para identificación
                                                                    newRow.setAttribute('data-type', storageType); // Guardar tipo para remover después

                                                                    newRow.innerHTML = `
                <td>${storageType} ${i+1}</td>
                <td><label><input type="radio" class="existencia-sí" checked> Sí</label></td> <!-- Cambiado a "Sí" -->
                <td></td> <!-- La celda de cantidad se deja vacía -->
                <td><label><input type="radio"> Sí </label><label><input type="radio"> No</label></td>
                <td>
                    <select class="form-control">
                                          
                        <option value="buen"></option>

                        <option value="bueno">Buena</option>
                        <option value="regular">Regular</option>
                        <option value="malo">Mala</option>
                    </select>
                </td>
                
                <td>
                    <button type="button" class="btn btn-primary" onclick="handleAgregarEvidencia('${storageType.toLowerCase()}')">Agregar evidencia</button>
                </td>
            `;
                                                                    tableBody.insertBefore(newRow, row.nextSibling); // Insertar fila justo después de la fila original
                                                                }
                                                            }

                                                            function handleAgregarEvidencia(tipo) {
                                                                alert("Agregar evidencia para: " + tipo);
                                                            }
                                                        </script>

                                                        <div class="row">
                                                            <h4 class="card-title mb-4">2.5. Servicios de drenaje y tipo de descarga sanitaria <span style="color: red;">*</span></h4>

                                                            <div class="col-lg-3">

                                                                <div class="mb-4">
                                                                    <br>
                                                                    <select class="form-control" id="cargo-select">
                                                                        <option value="" disabled selected></option>
                                                                        <option value="cielo">A cielo abierto</option>
                                                                        <option value="biodigestor">Biodigestor</option>
                                                                        <option value="colector">Colector municipal</option>
                                                                        <option value="fosa">Fosa séptica</option>
                                                                        <option value="letrina">Letrina</option>
                                                                        <option value="planta">Planta de tratamiento</option>
                                                                    </select>
                                                                    </select>



                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">

                                                                <div class="mb-4 row align-items-center">
                                                                    <div class="col-6">
                                                                        <label for="cargo-select">ㅤ</label>
                                                                        <div class="dropdown custom-dropdown" data-dropdown>
                                                                            <div class="dropdown-toggle" data-toggle>

                                                                            </div>
                                                                            <div class="dropdown-menu" data-menu>
                                                                                <div class="radio-group">
                                                                                    <label class="radio-option selected" data-label="Bueno">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Buena</h4>
                                                                                                <p>Funciona correctamente y cumple con su propósito.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2" checked>
                                                                                        </div>
                                                                                    </label>
                                                                                    <label class="radio-option" data-label="Regular">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Regular</h4>
                                                                                                <p>Presenta pequeñas fallas o signos de desgaste.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2">
                                                                                        </div>
                                                                                    </label>
                                                                                    <label class="radio-option" data-label="Malo">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Mala</h4>
                                                                                                <p>Tiene daños visibles o funcionales que lo hacen casi inservible.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2">
                                                                                        </div>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <button type="button" class="btn btn-primary mt-4" id="toggle-dropzone5"> <!-- Ajusta el margen superior aquí -->
                                                                            Agrega evidencia
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="dropzone-container5" class="mt-2" style="display:none;">
                                                                    <form action="/upload" class="dropzone" id="myDropzone5">
                                                                        <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                        <div class="fallback">
                                                                            <input type="file" name="file" />
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <script>
                                                                    document.getElementById('toggle-dropzone5').addEventListener('click', function() {
                                                                        const dropzoneContainer = document.getElementById('dropzone-container5');
                                                                        dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                    });
                                                                </script>
                                                            </div>



                                                        </div>



                                                        <div class="row">
                                                            <h4 class="card-title mb-0">2.6. Servicios de recolección y tipo de gestión de la basura<span style="color: red;">*</span></h4>
                                                            <br>
                                                            <div class="col-lg-3">
                                                                <br><br>
                                                                <div class="mb-4">
                                                                    <select class="form-control" id="cargo-select">
                                                                        <option value="" disabled selected></option>
                                                                        <option value="bueno">Recolección por servicio público</option>
                                                                        <option value="regular">Recolección por servicio privado</option>
                                                                        <option value="malo">Relleno sanitario</option>
                                                                        <option value="malo">Tratamiento holístico.</option>
                                                                        <option value="malo">Vertedero</option>
                                                                    </select>

                                                                    <script>
                                                                        document.getElementById('toggle-dropzone6').addEventListener('click', function() {
                                                                            const dropzoneContainer = document.getElementById('dropzone-container6');
                                                                            dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                        });
                                                                    </script>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <br>
                                                                <div class="mb-4 row align-items-center">
                                                                    <div class="col-6">
                                                                        <label for="cargo-select">ㅤ</label>
                                                                        <div class="dropdown custom-dropdown" data-dropdown>
                                                                            <div class="dropdown-toggle" data-toggle>
                                                                            </div>
                                                                            <div class="dropdown-menu" data-menu>
                                                                                <div class="radio-group">
                                                                                    <label class="radio-option selected" data-label="Bueno">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Buena</h4>
                                                                                                <p>Funciona correctamente y cumple con su propósito.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2" checked>
                                                                                        </div>
                                                                                    </label>
                                                                                    <label class="radio-option" data-label="Regular">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Regular</h4>
                                                                                                <p>Presenta pequeñas fallas o signos de desgaste.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2">
                                                                                        </div>
                                                                                    </label>
                                                                                    <label class="radio-option" data-label="Malo">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Mala</h4>
                                                                                                <p>Tiene daños visibles o funcionales que lo hacen casi inservible.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2">
                                                                                        </div>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <button type="button" class="btn btn-primary mt-3" id="toggle-dropzone6"> <!-- Ajusta el margen superior aquí -->
                                                                            Agrega evidencia
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="dropzone-container6" class="mt-2" style="display:none;">
                                                                    <form action="/upload" class="dropzone" id="myDropzone6">
                                                                        <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                        <div class="fallback">
                                                                            <input type="file" name="file" />
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <script>
                                                                    document.getElementById('toggle-dropzone6').addEventListener('click', function() {
                                                                        const dropzoneContainer = document.getElementById('dropzone-container6');
                                                                        dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <h4 class="card-title mb-0">2.7. Servicio y tipo de suministro de energía <span style="color: red;">*</span></h4>

                                                            <div class="col-lg-3">
                                                                <br><br>
                                                                <div class="mb-4">
                                                                    <select class="form-control" id="cargo-select">
                                                                        <option value="" disabled selected></option>
                                                                        <option value="bueno">Conexión a la red con contrato</option>
                                                                        <option value="regular">Conexión a la red sin contrato</option>
                                                                        <option value="regular">Luz natural</option>
                                                                        <option value="malo">Panel solar</option>
                                                                        <option value="malo">Planta de luz</option>
                                                                    </select>


                                                                    <script>
                                                                        document.getElementById('toggle-dropzone7').addEventListener('click', function() {
                                                                            const dropzoneContainer = document.getElementById('dropzone-container7');
                                                                            dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                        });
                                                                    </script>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <br>
                                                                <div class="mb-1 row align-items-center">
                                                                    <div class="col-6">
                                                                        <label for="cargo-select">ㅤ</label>
                                                                        <div class="dropdown custom-dropdown" data-dropdown>
                                                                            <div class="dropdown-toggle" data-toggle>
                                                                            </div>
                                                                            <div class="dropdown-menu" data-menu>
                                                                                <div class="radio-group">
                                                                                    <label class="radio-option selected" data-label="Bueno">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Buena</h4>
                                                                                                <p>Funciona correctamente y cumple con su propósito.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2" checked>
                                                                                        </div>
                                                                                    </label>
                                                                                    <label class="radio-option" data-label="Regular">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Regular</h4>
                                                                                                <p>Presenta pequeñas fallas o signos de desgaste.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2">
                                                                                        </div>
                                                                                    </label>
                                                                                    <label class="radio-option" data-label="Malo">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Mala</h4>
                                                                                                <p>Tiene daños visibles o funcionales que lo hacen casi inservible.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2">
                                                                                        </div>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <button type="button" class="btn btn-primary mt-3" id="toggle-dropzone7"> <!-- Ajusta el margen superior aquí -->
                                                                            Agrega evidencia
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="dropzone-container7" class="mt-2" style="display:none;">
                                                                    <form action="/upload" class="dropzone" id="myDropzone7">
                                                                        <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                        <div class="fallback">
                                                                            <input type="file" name="file" />
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <script>
                                                                    document.getElementById('toggle-dropzone7').addEventListener('click', function() {
                                                                        const dropzoneContainer = document.getElementById('dropzone-container7');
                                                                        dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <h4 class="card-title mb-0">2.8. Servicios y tipo de suministro de gas <span style="color: red;">*</span></h4>

                                                            <div class="col-lg-3">
                                                                <br>
                                                                <label for="cargo-select"> </label>
                                                                <div class="mb-4">
                                                                    <select class="form-control" id="cargo-select">
                                                                        <option value="" disabled selected></option>
                                                                        <option value="regular">Gas licuado de petróleo</option>
                                                                        <option value="bueno">Gas natural</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <br>

                                                                <div class="mb-4">
                                                                    <label for="cargo-select">Tipo de almacenamiento<span style="color: red;">*</span></label>
                                                                    <select class="form-control" id="cargo-select">
                                                                        <option value="" disabled selected></option>
                                                                        <option value="bueno">Cilindro</option>
                                                                        <option value="regular">Estacionario</option>
                                                                        <option value="malo">Suministro público</option>

                                                                    </select>

                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6">
                                                                <br>
                                                                <div class="mb-4 row align-items-center">
                                                                    <div class="col-8">
                                                                        <label for="cargo-select">ㅤ</label>
                                                                        <div class="dropdown custom-dropdown" data-dropdown>
                                                                            <div class="dropdown-toggle" data-toggle>
                                                                            </div>
                                                                            <div class="dropdown-menu" data-menu>
                                                                                <div class="radio-group">
                                                                                    <label class="radio-option selected" data-label="Bueno">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Buena</h4>
                                                                                                <p>Funciona correctamente y cumple con su propósito.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2" checked>
                                                                                        </div>
                                                                                    </label>
                                                                                    <label class="radio-option" data-label="Regular">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Regular</h4>
                                                                                                <p>Presenta pequeñas fallas o signos de desgaste.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2">
                                                                                        </div>
                                                                                    </label>
                                                                                    <label class="radio-option" data-label="Malo">
                                                                                        <div class="radio-content">
                                                                                            <div class="radio-text">
                                                                                                <h4>Mala</h4>
                                                                                                <p>Tiene daños visibles o funcionales que lo hacen casi inservible.</p>
                                                                                            </div>
                                                                                            <input type="radio" name="grupo2">
                                                                                        </div>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <button type="button" class="btn btn-primary mt-3" id="toggle-dropzone9"> <!-- Ajusta el margen superior aquí -->
                                                                            Agrega evidencia
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="dropzone-container9" class="mt-2" style="display:none;">
                                                                    <form action="/upload" class="dropzone" id="myDropzone9">
                                                                        <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                                                        <div class="fallback">
                                                                            <input type="file" name="file" />
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <script>
                                                                    document.getElementById('toggle-dropzone9').addEventListener('click', function() {
                                                                        const dropzoneContainer = document.getElementById('dropzone-container9');
                                                                        dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>




                                                        <div class="col-lg-9">
                                                            <h4 class="card-title mb-0">2.9. Servicios y tipo de Tecnologías de la Información y Comunicaciones (TIC’s)<span style="color: red;">*</span></h4>
                                                            <br>
                                                            <label for="cargo-select"> </label>

                                                            <div class="mb-6">
                                                                <br>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-sm align-middle text-center">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Modalidad de servicio TI:</th>
                                                                                <th style="width: 120px;">Existencia</th>
                                                                                <th style="width: 120px;">Cantidad</th>
                                                                                <th style="width: 200px;">En uso</th>
                                                                                <th style="width: 200px;">Condición</th>

                                                                                <th style="width: 200px; background-color: #fff;"></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Antena parabólica</td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="si">Sí</option>
                                                                                        <option value="no">No</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                        <option value="6">6</option>
                                                                                        <option value="7">7</option>
                                                                                        <option value="8">8</option>
                                                                                        <option value="9">9</option>
                                                                                        <option value="10">10</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <label><input type="radio" name="uso-1" value="si"> Sí</label>
                                                                                    <label><input type="radio" name="uso-1" value="no"> No</label>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="buen"></option>

                                                                                        <option value="buena">Buena</option>
                                                                                        <option value="regular">Regular</option>
                                                                                        <option value="mala">Mala</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-primary">Agregar evidencia</button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Instalación de red de telecomunicaciones</td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="si">Sí</option>
                                                                                        <option value="no">No</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                        <option value="6">6</option>
                                                                                        <option value="7">7</option>
                                                                                        <option value="8">8</option>
                                                                                        <option value="9">9</option>
                                                                                        <option value="10">10</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <label><input type="radio" name="uso-2" value="si"> Sí</label>
                                                                                    <label><input type="radio" name="uso-2" value="no"> No</label>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="buen"></option>

                                                                                        <option value="buena">Buena</option>
                                                                                        <option value="regular">Regular</option>
                                                                                        <option value="mala">Mala</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-primary">Agregar evidencia</button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Red de telefonía celular</td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="si">Sí</option>
                                                                                        <option value="no">No</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                        <option value="6">6</option>
                                                                                        <option value="7">7</option>
                                                                                        <option value="8">8</option>
                                                                                        <option value="9">9</option>
                                                                                        <option value="10">10</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <label><input type="radio" name="uso-3" value="si"> Sí</label>
                                                                                    <label><input type="radio" name="uso-3" value="no"> No</label>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="buen"></option>

                                                                                        <option value="buena">Buena</option>
                                                                                        <option value="regular">Regular</option>
                                                                                        <option value="mala">Mala</option>
                                                                                    </select>
                                                                                </td>

                                                                                <td>
                                                                                    <button type="button" class="btn btn-primary">Agregar evidencia</button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Internet</td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="si">Sí</option>
                                                                                        <option value="no">No</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                        <option value="6">6</option>
                                                                                        <option value="7">7</option>
                                                                                        <option value="8">8</option>
                                                                                        <option value="9">9</option>
                                                                                        <option value="10">10</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <label><input type="radio" name="uso-4" value="si"> Sí</label>
                                                                                    <label><input type="radio" name="uso-4" value="no"> No</label>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="buen"></option>

                                                                                        <option value="buena">Buena</option>
                                                                                        <option value="regular">Regular</option>
                                                                                        <option value="mala">Mala</option>
                                                                                    </select>
                                                                                </td>

                                                                                <td>
                                                                                    <button type="button" class="btn btn-primary">Agregar evidencia</button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Telefonía fija</td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="si">Sí</option>
                                                                                        <option value="no">No</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                        <option value="6">6</option>
                                                                                        <option value="7">7</option>
                                                                                        <option value="8">8</option>
                                                                                        <option value="9">9</option>
                                                                                        <option value="10">10</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <label><input type="radio" name="uso-5" value="si"> Sí</label>
                                                                                    <label><input type="radio" name="uso-5" value="no"> No</label>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control">
                                                                                        <option value="buen"></option>

                                                                                        <option value="buena">Buena</option>
                                                                                        <option value="regular">Regular</option>
                                                                                        <option value="mala">Mala</option>
                                                                                    </select>
                                                                                </td>

                                                                                <td>
                                                                                    <button type="button" class="btn btn-primary">Agregar evidencia</button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const existenciaSiCheckboxes = document.querySelectorAll('.existencia-si');
                                                                const existenciaNoCheckboxes = document.querySelectorAll('.existencia-no');

                                                                existenciaSiCheckboxes.forEach(checkbox => {
                                                                    checkbox.addEventListener('change', function() {
                                                                        const condicionId = this.getAttribute('data-condicion-id');
                                                                        const condicionSelect = document.getElementById(condicionId);

                                                                        if (this.checked) {
                                                                            condicionSelect.disabled = false; // Habilitar si el checkbox de "Sí" está marcado
                                                                            document.querySelector(`.existencia-no[data-condicion-id="${condicionId}"]`).checked = false; // Desmarcar "No"
                                                                        }
                                                                    });
                                                                });

                                                                existenciaNoCheckboxes.forEach(checkbox => {
                                                                    checkbox.addEventListener('change', function() {
                                                                        const condicionId = this.getAttribute('data-condicion-id');
                                                                        const condicionSelect = document.getElementById(condicionId);

                                                                        if (this.checked) {
                                                                            condicionSelect.disabled = true; // Deshabilitar si el checkbox de "No" está marcado
                                                                            condicionSelect.value = ''; // Resetear la selección de condición
                                                                            // Desmarcar el checkbox de "Sí" si se marcan "No"
                                                                            document.querySelector(`.existencia-si[data-condicion-id="${condicionId}"]`).checked = false;
                                                                        }
                                                                    });
                                                                });

                                                                document.querySelectorAll('.agregar-evidencia').forEach(button => {
                                                                    button.addEventListener('click', function() {
                                                                        const condicionId = this.getAttribute('data-condicion-id');
                                                                        // Aquí puedes agregar la lógica para manejar la adición de evidencias
                                                                        alert('Agregar evidencia para: ' + condicionId);
                                                                    });
                                                                });
                                                            });
                                                        </script>






                                                    </form>






                                                    <ul class="pager wizard twitter-bs-wizard-pager-link mt-4" style="list-style-type: none; padding: 0; display: flex;">


                                                        <li class="next" style="display: inline-block; background-color: #007bff; color: white; border-radius: 5px; overflow: hidden;">
                                                            <a href="javascript: void(0);" class="btn" style="color: white; border: none; border-radius: 5px; padding: 10px 15px; text-decoration: none; display: block;">
                                                                Guardar Módulo 2 <i class="fas fa-save"></i>
                                                            </a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="progress-shipping-address">
                                                <div>



                                                    <form>
                                                        <div class="card-header">
                                                            <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">III. DESCRIPCIÓN DE LA INFRAESTRUCTURA DEL CENTRO DE TRABAJO</h4>
                                                        </div>

                                                        <div class="row mt-4">


                                                            <!-- <div class="col-lg-4">
                                                                         <label for="form-label" class="form-label">3.1. Tipo de infraestructura aplicada en la construcción del inmueble</label><br>
                                                                             <select id="tipo_infra" class="form-control" onchange="generateBuildingTable()">
                                                                                    <option value="1">Construcción con concreto</option>
                                                                                    <option value="2">Construcción de mampostería</option>
                                                                                    <option value="3">Construcción con materiales naturales</option>
                                                                                    <option value="4">Construcción con estructuras prefabricadas o ligeras</option>
                                                                                </select>
                                                                                
                                                                        </div> -->


                                                            <!-- 3,1 Edificaciones  -->

                                                            <div class="col-lg-6 mt-2">
                                                                <label for="cantidad_edificios" class="form-label">
                                                                    3. ¿Cuántas edificaciones tiene el inmueble?
                                                                </label>
                                                                <select id="cantidad_edificios" class="form-select mb-3" onchange="generateBuildingTable()">
                                                                    <option value="0">Selecciona una opción</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                </select>

                                                                <div id="tabla_edificios_container" style="display:none;">
                                                                    <span style="color: #dc3545;">
                                                                        <p>
                                                                            Asigna un <b>número a cada edificio</b>, empezando por el de mayor tamaño o uso (e importancia), y concluyendo con el menor.
                                                                        </p>
                                                                    </span>
                                                                    <table class="table table-bordered table-sm">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th style="width: 30%;">Número de edificio</th>
                                                                                <th>Número de niveles</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="building_table_body">
                                                                            <!-- Filas generadas dinámicamente -->
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <style>
                                                                .custom-dropdown .dropdown-toggle {
                                                                    background-color: #f8f9fa;
                                                                    border: 1px solid #ced4da;
                                                                    width: 100%;
                                                                    text-align: left;
                                                                }

                                                                .radio-option {
                                                                    cursor: pointer;
                                                                    padding: 10px;
                                                                    border-bottom: 1px solid #eee;
                                                                }

                                                                .radio-option:last-child {
                                                                    border-bottom: none;
                                                                }

                                                                .radio-option:hover {
                                                                    background-color: #f1f1f1;
                                                                }

                                                                .radio-content {
                                                                    display: flex;
                                                                    justify-content: space-between;
                                                                    align-items: center;
                                                                }

                                                                .radio-text {
                                                                    flex: 1;
                                                                }
                                                            </style>

                                                            <script>
                                                                function generateBuildingTable() {
                                                                    const cantidad = parseInt(document.getElementById('cantidad_edificios').value, 10);
                                                                    const tableBody = document.getElementById('building_table_body');
                                                                    const tablaContainer = document.getElementById('tabla_edificios_container');

                                                                    tableBody.innerHTML = '';
                                                                    tablaContainer.style.display = cantidad > 0 ? 'block' : 'none';

                                                                    for (let i = 0; i < cantidad; i++) {
                                                                        const row = document.createElement('tr');

                                                                        // ✅ Select para número de edificio (1 al 20)
                                                                        const numCell = document.createElement('td');
                                                                        const select = document.createElement('select');
                                                                        select.classList.add('form-select');

                                                                        const placeholder = document.createElement('option');
                                                                        placeholder.textContent = 'Selecciona el número de edificio';
                                                                        placeholder.disabled = true;
                                                                        placeholder.selected = true;
                                                                        select.appendChild(placeholder);

                                                                        for (let j = 1; j <= 20; j++) {
                                                                            const opt = document.createElement('option');
                                                                            opt.value = j;
                                                                            opt.textContent = j;
                                                                            select.appendChild(opt);
                                                                        }
                                                                        numCell.appendChild(select);
                                                                        row.appendChild(numCell);

                                                                        // Cantidad de niveles - dropdown personalizado
                                                                        const nivelCell = document.createElement('td');
                                                                        const dropdownId = `dropdown-nivel-${i}`;
                                                                        const buttonId = `dropdown-button-${i}`;
                                                                        const name = `nivel-radio-${i}`;

                                                                        nivelCell.innerHTML = `
                                                                        <div class="dropdown custom-dropdown">
                                                                            <button class="btn dropdown-toggle" type="button" id="${buttonId}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Selecciona una opción
                                                                            </button>
                                                                            <div class="dropdown-menu w-100 p-2" aria-labelledby="${buttonId}">
                                                                            <div class="radio-group">
                                                                                <label class="radio-option" data-label="Planta baja">
                                                                                <div class="radio-content">
                                                                                    <div class="radio-text">
                                                                                    <h6>1 nivel</h6>
                                                                                    <p>Planta baja.</p>
                                                                                    </div>
                                                                                    <input type="radio" name="${name}" value="Planta baja">
                                                                                </div>
                                                                                </label>
                                                                                <label class="radio-option" data-label="2 niveles">
                                                                                <div class="radio-content">
                                                                                    <div class="radio-text">
                                                                                    <h6>2 niveles</h6>
                                                                                    <p>Planta baja y 1er piso.</p>
                                                                                    </div>
                                                                                    <input type="radio" name="${name}" value="2 niveles">
                                                                                </div>
                                                                                </label>
                                                                                <label class="radio-option" data-label="3 niveles">
                                                                                <div class="radio-content">
                                                                                    <div class="radio-text">
                                                                                    <h6>3 niveles</h6>
                                                                                    <p>Planta baja, 1er y 2do piso.</p>
                                                                                    </div>
                                                                                    <input type="radio" name="${name}" value="3 niveles">
                                                                                </div>
                                                                                </label>
                                                                                <label class="radio-option" data-label="4 niveles">
                                                                                <div class="radio-content">
                                                                                    <div class="radio-text">
                                                                                    <h6>4 niveles</h6>
                                                                                    <p>Planta baja, 1er,  2do y 3er piso.</p>
                                                                                    </div>
                                                                                    <input type="radio" name="${name}" value="4 niveles">
                                                                                </div>
                                                                                </label>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                        `;

                                                                        // Actualiza el texto del botón cuando se selecciona una opción
                                                                        setTimeout(() => {
                                                                            const radios = nivelCell.querySelectorAll(`input[name="${name}"]`);
                                                                            radios.forEach(radio => {
                                                                                radio.addEventListener('change', () => {
                                                                                    const label = radio.closest('.radio-option').getAttribute('data-label');
                                                                                    document.getElementById(buttonId).textContent = label;
                                                                                });
                                                                            });
                                                                        }, 0);

                                                                        row.appendChild(nivelCell);
                                                                        tableBody.appendChild(row);
                                                                    }
                                                                }
                                                            </script>





                                                        </div>














                                                        <!--       <div class="col-lg-4">
                                                                    <br>
                                                                    <label for="form-label" class="form-label">3.2. ¿El Centro de Trabajo cuenta con áreas comunes?</label><br>
                                                                    <label class="form-label">
                                                                        <input type="radio" name="areas_comunes" id="areas_comunes_si" value="si" onclick="toggleAreasComunes(true)"> Sí
                                                                    </label>
                                                                    <label class="form-label">
                                                                        <input type="radio" name="areas_comunes" id="areas_comunes_no" value="no" onclick="toggleAreasComunes(false)"> No
                                                                    </label>
                                                                    <br><br>
                                                        
                                                                    <div id="areas_comunes_inputs" style="display: none;">
                                                                    
                                                                        
                                                        
                                                                        <label for="areas_table" class="form-label">Áreas Comunes</label>
                                                                        <table id="areas_table" class="table table-bordered table-sm" style="display: none;">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Área</th>
                                                                                    <th>Letra</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="areas_table_body">
                                                                                  -- Las filas se generarán dinámicamente aquí  --
                                                                            </tbody>
                                                                        </table> 


                                                                    </div>
                                                                </div>
                                                        
                                                            <script>
                                                                function toggleAreasComunes(show) {
                                                                    const areasComunesInputs = document.getElementById('areas_comunes_inputs');
                                                                    areasComunesInputs.style.display = show ? 'block' : 'none';
                                                                    document.getElementById('areas_table').style.display = 'none'; // Ocultar la tabla cuando se oculta el div
                                                                    document.getElementById('areas_table_body').innerHTML = ''; // Limpiar filas previas
                                                                }
                                                        
                                                                function generateAreasTable() {
                                                                    const cantidad = parseInt(document.getElementById('cantidad_areas_comunes').value, 10);
                                                                    const tableBody = document.getElementById('areas_table_body');
                                                        
                                                                    // Limpiar filas previas
                                                                    tableBody.innerHTML = ''; 
                                                        
                                                                    for (let i = 1; i <= cantidad; i++) {
                                                                        const row = document.createElement('tr');
                                                        
                                                                        // Columna para el número de área
                                                                        const areaCell = document.createElement('td');
                                                                        areaCell.textContent = `Área ${i}`;
                                                                        row.appendChild(areaCell);
                                                        
                                                                        // Columna para la letra
                                                                        const letterSelect = document.createElement('select');
                                                                        letterSelect.classList.add('form-control');
                                                                        for (let char = 65; char <= 90; char++) {
                                                                            const option = document.createElement('option');
                                                                            option.value = String.fromCharCode(char);
                                                                            option.text = String.fromCharCode(char);
                                                                            letterSelect.appendChild(option);
                                                                        }
                                                        
                                                                        const letterCell = document.createElement('td');
                                                                        letterCell.appendChild(letterSelect);
                                                                        row.appendChild(letterCell);
                                                        
                                                                        tableBody.appendChild(row);
                                                                    }
                                                        
                                                                    // Mostrar la tabla
                                                                    document.getElementById('areas_table').style.display = 'table'; 
                                                                }
                                                            </script>
                                                            </div>-->


                                                        <div class="row mt-4">
                                                            <!-- <label for="cantidad_edificios" class="form-label">3.3 Dibuja un mapa con los edificios y las áreas comunes de tu Centro de Trabajo:</label><br> -->

                                                            <!-- <div class="col-lg-4">
                                                                    <div id="barra">
                                                                        <div class="forma cuadrado" draggable="true"></div>
                                                                        <div class="forma circulo" draggable="true"></div>
                                                                        <div class="forma rectangulo" draggable="true"></div>
                                                                        <div id="lapiz">Herramienta Lápiz</div>
                                                                        <div id="goma">Herramienta Goma</div>
                                                                    </div>
                                                                </div> -->
                                                            <!-- 
                                                                <div class="col-lg-8"> 
                                                                    <div class="alert alert-success" role="alert">
                                                                        <h5 class="alert-heading">Reglas: </h5>
                                                                        <ol class="mb-3">
                                                                            <li><b>Dibuja</b> el perímetro de tu Centro de Trabajo.</li>
                                                                            <li><b>Elige</b> la figura que asemeja a cada uno de los edificios y/o áreas comunes.</li>
                                                                            <li><b>Asigna</b> una letra a cada edificio o área común, empezando por el o la mayor y de más uso, y concluyendo con el o la de menor tamaño y uso.</li>
                                                                        </ol>
                                                                        <hr>
                                                                        <p class="mb-0"><b>Ejemplo:</b> Edificio “A”, “B”, “C”, …</p>
                                                                    </div>
                                                                </div> -->


                                                        </div>

                                                        <!-- <div id="zonaDibujo"></div> -->
                                                        <div class="text-end mt-3">
                                                            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal1">Guardar Mapa</button> -->
                                                            <!-- <button type="button" class="btn btn-danger" >Guardar Mapa</button> -->
                                                        </div>

                                                        <!-- Analisis por Edificio -->
                                                        <div class="col-12 analisis-edificio mt-2">
                                                            <span>3.1 Análisis de infraestructura interna</span>

                                                            <br><br>
                                                            <!-- Áreas principales -->
                                                            <span>3.1.1 Diagnóstico por edificio</span>
                                                            <br><br>

                                                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show col-4 mt-2" role="alert">
                                                                <i class="bx bx-building-house label-icon"></i>Edificio: <strong>1</strong> | Nivel: <b>Planta baja</b>
                                                            </div>



                                                            <div class="table-responsive mt-4">
                                                                <table class="table table-bordered table-sm align-middle text-center">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Áreas principales</th>
                                                                            <th>Existencia</th>
                                                                            <th>Tipo de construcción</th>
                                                                            <th>Cantidad</th>
                                                                            <th>En uso</th>
                                                                            <th>Condición</th>
                                                                            <th>Con daño estructural</th>
                                                                            <th>Con daño de instalación</th>
                                                                            <th>Obra en Proceso</th>
                                                                            <th>Requiere construcción adicional</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaAreasPrincipales"></tbody>
                                                                </table>
                                                            </div>

                                                            <!-- Áreas adicionales -->
                                                            <div class="table-responsive mt-4">
                                                                <table class="table table-bordered table-sm align-middle text-center">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Áreas adicionales</th>
                                                                            <th>Existencia</th>
                                                                            <th>Tipo de construcción</th>
                                                                            <th>Cantidad</th>
                                                                            <th>En uso</th>
                                                                            <th>Condición</th>
                                                                            <th>Con daño estructural</th>
                                                                            <th>Con daño de instalación</th>
                                                                            <th>Obra en Proceso</th>
                                                                            <th>Requiere construcción adicional</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaAreasAdicionales"></tbody>
                                                                </table>
                                                            </div>

                                                            <script>
                                                                const areasPrincipales = [
                                                                    "Baño", "Dirección", "Letrina", "Salón"
                                                                ];

                                                                const areasAdicionales = [
                                                                    "Administrativa", "Biblioteca", "Bodega", "Casa del conserje", "Casa del maestro", "Centro de cómputo", "Cocina", "Comedor",
                                                                    "Dormitorio", "Intendencia", "Laboratorio", "Pórtico", "Sala de usos múltiples", "Subdirección", "Taller", "Vestidor"
                                                                ];

                                                                function crearFilaModal1(area) {
                                                                    const selectCantidad = `<select class="form-select form-select-sm">
        ${[...Array(10)].map((_, i) => `<option>${i + 1}</option>`).join("")}
        </select>`;

                                                                    const selectCondicion = `
        <select class="form-select form-select-sm">
            <option value="">Selecciona condición</option>
            <option value="bueno">Buena</option>
            <option value="regular">Regular</option>
            <option value="malo">Mala</option>
        </select>`;

                                                                    // IDs normalizados para selects de Obra en Proceso
                                                                    const norm = area.replace(/\s+/g, '_');
                                                                    const obraId = `obra-proceso-${norm}`;
                                                                    const tipoObraId = `tipo-obra-${norm}`;
                                                                    const recursoObraId = `recurso-obra-${norm}`;

                                                                    const obraEnProceso = `
        <div>
            <label style="margin-right: 6px;">
                <input type="radio" name="${obraId}" value="si" onchange="toggleObraEnProceso('${norm}', true)"> Sí
            </label>
            <label>
                <input type="radio" name="${obraId}" value="no" onchange="toggleObraEnProceso('${norm}', false)"> No
            </label>
            <br>
            <select id="${tipoObraId}" class="form-select form-select-sm mt-1" disabled>
                <option value="">Tipo de obra</option>
                <option value="Albañilería">Albañilería</option>
                <option value="Pintura y acabados">Pintura y acabados</option>
                <option value="Reforzamiento de estructuras">Reforzamiento de estructuras</option>
                <option value="Herrería">Herrería</option>
                <option value="Plomería">Plomería</option>
                <option value="Impermeabilización">Impermeabilización</option>
                <option value="Red eléctrica">Red eléctrica</option>
                <option value="Red hidráulica">Red hidráulica</option>
                <option value="Carpintería">Carpintería</option>
                <option value="Urbanismo">Urbanismo</option>
            </select>
            <select id="${recursoObraId}" class="form-select form-select-sm mt-1" disabled>
                <option value="">Recurso</option>
                <option value="Federal">Federal</option>
                <option value="Estatal">Estatal</option>
                <option value="Municipal">Municipal</option>
            </select>
        </div>
        `;

                                                                    return `
        <tr> 
            <td>${area}</td>
            <td>
            <input type="radio" class="form-check-input exclusiva" data-group="existencia-${area}-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="existencia-${area}-no"> No
            </td>
            <td>${selectTipoConstruccion()}</td>
            <td>${selectCantidad}</td>
            <td>
            <input type="radio" class="form-check-input exclusiva" data-group="uso-${area}-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="uso-${area}-no"> No
            </td>
            <td>${selectCondicion}</td>
            <td>${selectDanioEstructural()}</td>
            <td>${selectDanioInstalacion()}</td>
            <td>${obraEnProceso}</td>
            <td>${selectConstruccionAdicional(area)}</td>
            <td><button class="btn btn-primary btn-sm">Agregar evidencia</button></td>
        </tr>
        `;
                                                                }

                                                                // Genera ambas tablas
                                                                document.addEventListener("DOMContentLoaded", () => {
                                                                    const tabla1 = document.getElementById("tablaAreasPrincipales");
                                                                    areasPrincipales.forEach(area => {
                                                                        tabla1.insertAdjacentHTML("beforeend", crearFilaModal1(area));
                                                                    });

                                                                    const tabla2 = document.getElementById("tablaAreasAdicionales");
                                                                    areasAdicionales.forEach(area => {
                                                                        tabla2.insertAdjacentHTML("beforeend", crearFilaModal1(area));
                                                                    });

                                                                    // Exclusividad de radios
                                                                    document.addEventListener("change", (e) => {
                                                                        if (e.target.classList.contains("exclusiva")) {
                                                                            const group = e.target.dataset.group.split("-").slice(0, -1).join("-");
                                                                            document.querySelectorAll(`input[data-group^="${group}-"]`).forEach(el => {
                                                                                if (el !== e.target) el.checked = false;
                                                                            });
                                                                        }
                                                                    });
                                                                });

                                                                // Habilita o deshabilita los selects de obra en proceso
                                                                function toggleObraEnProceso(norm, enabled) {
                                                                    const tipoObra = document.getElementById('tipo-obra-' + norm);
                                                                    const recursoObra = document.getElementById('recurso-obra-' + norm);
                                                                    if (tipoObra && recursoObra) {
                                                                        tipoObra.disabled = !enabled;
                                                                        recursoObra.disabled = !enabled;
                                                                        if (!enabled) {
                                                                            tipoObra.value = "";
                                                                            recursoObra.value = "";
                                                                        }
                                                                    }
                                                                }
                                                            </script>



                                                            <!-- <div class="mb-3">
            <h5>3.5 ¿Presenta daños estructurales?</h5>
            <input type="radio" class="form-check-input exclusiva" data-group="danio-estructural-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="danio-estructural-no"> No
          </div> -->

                                                            <!-- <div class="table-responsive mb-4">
            <h6 class="fw-bold">Tipo de daño estructural</h6>
            <table class="table table-bordered table-sm text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>Tipo de daño</th>
                  <th>Existencia<br></th>
                  <th style="background-color: #fff;" ></th>
                </tr>
              </thead>
              <tbody id="tablaDaniosEstructurales"></tbody>
            </table>
          </div> -->

                                                            <!-- <div class="mb-3">
            <h5>3.6 ¿Presenta daños en instalaciones?</h5>

            <input type="radio" class="form-check-input exclusiva" data-group="danio-instalacion-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="danio-instalacion-no"> No
          </div> -->

                                                            <!-- <div class="table-responsive">
            <h6 class="fw-bold">Tipo de daño en instalaciones</h6>
            <table class="table table-bordered table-sm text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>Tipo de daño</th>
                  <th>Existencia<br></th>
                  <th style="background-color: #fff;" ></th>
                </tr>
              </thead>
              <tbody id="tablaDaniosInstalaciones"></tbody>
            </table>
          </div> -->

                                                        </div>

                                                        <!-- Descrrioc+on de mobiliario-->
                                                        <div class="mt-4 col-8">

                                                            <div class="text-left">

                                                                <!-- <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show col-6" role="alert">
                <i class="bx bx-building-house label-icon"></i>Edificio: <strong>1</strong>  | Nivel: <b>Planta baja</b>             
            </div> -->



                                                            </div>


                                                            <div class="table-responsive mb-4">
                                                                <table class="table table-bordered table-sm text-center align-middle">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Mobiliario</th>
                                                                            <th>Existencia<br></th>
                                                                            <th>Cantidad</th>
                                                                            <th>En uso<br></th>
                                                                            <th>Condición<br></th>
                                                                            <th style="background-color: #fff;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaMobiliario"></tbody>
                                                                </table>
                                                            </div>


                                                            <div class="text-left">

                                                                <!-- <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show col-6" role="alert">
                <i class="bx bx-building-house label-icon"></i>Edificio: <strong>1</strong>  | Nivel: <b>Planta baja</b>             
            </div> -->


                                                                <br>
                                                            </div>

                                                            <div class="table-responsive mt-2">
                                                                <table class="table table-bordered table-sm text-center align-middle">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Equipo</th>
                                                                            <th>Existencia<br></th>
                                                                            <th>Cantidad</th>
                                                                            <th>En uso<br></th>
                                                                            <th>Condición<br></th>
                                                                            <th style="background-color: #fff;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaEquipo"></tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <!-- Crear boton de  guardar por edificio -->
                                                        <div class="text-md-begin mt-3">
                                                            <button type="button" class="btn btn-info">Guardar Edificios</button>
                                                        </div>



                                                        <!-- Fin de iteracion de edificios -->
                                                        <hr>

                                                        <!-- Áreas Comunes   -->

                                                        <div class="col-lg-12 mt-4">

                                                            <!-- 3.2 Áreas comunes -->
                                                            <div class="col-lg-6 mt-2">
                                                                <label for="cantidad_areas_comunes" class="form-label">3.2 Análisis de infraestructura externa</label>
                                                                <br><br>
                                                                <span class="mt-2">3.2.1 ¿Cuántas áreas comunes tiene el inmueble?</span>
                                                                <br><br>
                                                                <select id="cantidad_areas_comunes" class="form-control mb-3" onchange="generateAreasTable()">
                                                                    <option value="0">Selecciona una opción</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                </select>

                                                                <div id="tabla_areas_comunes_container" style="display:none;">

                                                                    <span style="color: #2563eb;">
                                                                        <p> Asigna una <b>letra a las áreas comunes</b> existentes, empezando por la mayor y de más uso (e importancia), y concluyendo con la de menor tamaño.
                                                                        </p>
                                                                    </span>
                                                                    <!-- <table class="table table-bordered table-sm">                
                <thead class="table-light">
                    <tr>
                       
                        <th>Letra del área común</th>
                    </tr>
                </thead>
                <tbody id="areas_table_body"> 
                </tbody>
            </table> -->
                                                                </div>
                                                            </div>

                                                            <script>
                                                                function generateAreasTable() {
                                                                    const cantidad = parseInt(document.getElementById('cantidad_areas_comunes').value, 10);
                                                                    const tableBody = document.getElementById('areas_table_body');
                                                                    const tablaContainer = document.getElementById('tabla_areas_comunes_container');

                                                                    // Mostrar u ocultar tabla
                                                                    if (cantidad > 0) {
                                                                        tablaContainer.style.display = 'block';
                                                                    } else {
                                                                        tablaContainer.style.display = 'none';
                                                                        return;
                                                                    }

                                                                    tableBody.innerHTML = ''; // Limpiar tabla previa

                                                                    for (let i = 0; i < cantidad; i++) {
                                                                        const row = document.createElement('tr');

                                                                        // Celda del nombre del área común
                                                                        // const areaCell = document.createElement('td');
                                                                        // areaCell.textContent = `Área común ${i + 1}`;
                                                                        // row.appendChild(areaCell);

                                                                        // Select con letras A-Z para prioridad
                                                                        const letraSelect = document.createElement('select');
                                                                        letraSelect.classList.add('form-control');
                                                                        for (let char = 65; char <= 90; char++) {
                                                                            const option = document.createElement('option');
                                                                            option.value = String.fromCharCode(char);
                                                                            option.textContent = String.fromCharCode(char);
                                                                            letraSelect.appendChild(option);
                                                                        }

                                                                        const letraCell = document.createElement('td');
                                                                        letraCell.appendChild(letraSelect);
                                                                        row.appendChild(letraCell);

                                                                        tableBody.appendChild(row);
                                                                    }
                                                                }
                                                            </script>

                                                            <!-- <span class="mt-2">3.2.1 Diagnóstico por área común</span>
    <div class="text-left col-4 mt-2">        
        <div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show" role="alert">
            <i class="mdi mdi-leaf label-icon"></i>Área común: <strong>A</strong>                     
        </div>         
    </div> -->

                                                            <div class="table-responsive mt-4">
                                                                <table class="table table-bordered table-sm text-center align-middle">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="background-color: #2563eb; color: #fff;">Asigna letra</th>
                                                                            <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Áreas comunes</th>
                                                                            <th>Existencia</th>
                                                                            <th>Cantidad</th>
                                                                            <th>En uso</th>
                                                                            <th>Condición</th>
                                                                            <th>Con daño estructural</th>
                                                                            <th>Con daño de instalación</th>
                                                                            <th>Obra en Proceso</th>
                                                                            <th>Requiere construcción adicional</th>
                                                                            <th style="background-color: #fff;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaAreasComunes2"></tbody>
                                                                </table>
                                                            </div>

                                                            <script>
                                                                const comunes = [{
                                                                        nombre: 'Alberca',
                                                                        id: 'alberca'
                                                                    },
                                                                    {
                                                                        nombre: 'Área de juegos infantiles',
                                                                        id: 'area_juegos'
                                                                    },
                                                                    {
                                                                        nombre: 'Área verde',
                                                                        id: 'areas_verdes'
                                                                    },
                                                                    {
                                                                        nombre: 'Arenero',
                                                                        id: 'arenero'
                                                                    },
                                                                    {
                                                                        nombre: 'Auditorio',
                                                                        id: 'auditorio'
                                                                    },
                                                                    {
                                                                        nombre: 'Cancha deportiva',
                                                                        id: 'cancha_voleibol'
                                                                    },
                                                                    {
                                                                        nombre: 'Chapoteadero',
                                                                        id: 'chapoteadero'
                                                                    },
                                                                    {
                                                                        nombre: 'Estacionamiento',
                                                                        id: 'estacionamiento'
                                                                    },
                                                                    {
                                                                        nombre: 'Gimnasio',
                                                                        id: 'gimnasio'
                                                                    },
                                                                    {
                                                                        nombre: 'Gradas',
                                                                        id: 'gradas'
                                                                    },
                                                                    {
                                                                        nombre: 'Invernadero',
                                                                        id: 'invernadero'
                                                                    },
                                                                    {
                                                                        nombre: 'Kiosco',
                                                                        id: 'kiosco'
                                                                    },
                                                                    {
                                                                        nombre: 'Parcela de cultivo',
                                                                        id: 'parcela_cultivo'
                                                                    },
                                                                    {
                                                                        nombre: 'Plaza cívica',
                                                                        id: 'plaza_civica'
                                                                    }
                                                                ];

                                                                // Select reutilizable de daños estructurales
                                                                function selectDanioEstructural() {
                                                                    const danios = [
                                                                        "Exposición de varillas en losas o columnas", "Filtraciones en techo", "Fisuras en columnas",
                                                                        "Fisuras en techos o muros", "Flexiones en techo", "Humedad en muros",
                                                                        "Hundimiento o inclinación de pisos", "Inclinación en muros", "Movimiento en muros",
                                                                        "Vibración excesiva en circulaciones, escaleras o techos"
                                                                    ];
                                                                    return `
      <select class="form-select form-select-sm">
        <option value="">Selecciona</option>
        ${danios.map(d => `<option value="${d}">${d}</option>`).join("")}
      </select>
    `;
                                                                }

                                                                // Select reutilizable de daños en instalaciones
                                                                function selectDanioInstalacion() {
                                                                    const danios = [
                                                                        "Desperfectos en cancelería", "Desprendimiento de acabados",
                                                                        "Falta de impermeabilizante", "Falta de luminarias", "Falta de ventiladores/aire acondicionado",
                                                                        "Pintura general", "Pisos fisurados"
                                                                    ];
                                                                    return `
      <select class="form-select form-select-sm">
        <option value="">Selecciona</option>
        ${danios.map(d => `<option value="${d}">${d}</option>`).join("")}
      </select>
    `;
                                                                }

                                                                // Select de construcción adicional
                                                                function selectConstruccionAdicional(areaIndex) {
                                                                    return `
      <select class="form-select form-select-sm requiere-construccion" data-area="${areaIndex}">
        <option value="">¿Requiere construcción?</option>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
      <select class="form-select form-select-sm mt-1 cantidad-construccion" data-area="${areaIndex}" disabled>
        <option value="">Cantidad</option>
        ${[...Array(10).keys()].map(i => `<option value="${i + 1}">${i + 1}</option>`).join("")}
      </select>
    `;
                                                                }

                                                                // Obra en Proceso (igual que en Áreas principales)
                                                                function obraEnProcesoTemplate(norm) {
                                                                    return `
      <div>
        <label style="margin-right: 6px;">
          <input type="radio" name="obra_${norm}" value="si" onchange="toggleObraEnProceso('${norm}', true)"> Sí
        </label>
        <label>
          <input type="radio" name="obra_${norm}" value="no" onchange="toggleObraEnProceso('${norm}', false)"> No
        </label>
        <br>
        <select id="tipo-obra-${norm}" class="form-select form-select-sm mt-1" disabled>
          <option value="">Tipo de obra</option>
          <option value="Albañilería">Albañilería</option>
          <option value="Pintura y acabados">Pintura y acabados</option>
          <option value="Reforzamiento de estructuras">Reforzamiento de estructuras</option>
          <option value="Herrería">Herrería</option>
          <option value="Plomería">Plomería</option>
          <option value="Impermeabilización">Impermeabilización</option>
          <option value="Red eléctrica">Red eléctrica</option>
          <option value="Red hidráulica">Red hidráulica</option>
          <option value="Carpintería">Carpintería</option>
          <option value="Urbanismo">Urbanismo</option>
        </select>
        <select id="recurso-obra-${norm}" class="form-select form-select-sm mt-1" disabled>
          <option value="">Recurso</option>
          <option value="Federal">Federal</option>
          <option value="Estatal">Estatal</option>
          <option value="Municipal">Municipal</option>
        </select>
      </div>
    `;
                                                                }

                                                                // Crear fila dinámica de Áreas comunes
                                                                function crearFilaComun(comun) {
                                                                    const norm = comun.id.replace(/\s+/g, '_');

                                                                    const filaHTML = `
      <tr>
        <!-- Campo para seleccionar letra -->
        <td>
          <select class="form-control">
            ${[...Array(26).keys()].map(i => `<option value="${String.fromCharCode(65 + i)}">${String.fromCharCode(65 + i)}</option>`).join('')}
          </select>
        </td>
        <td>${comun.nombre}</td>
        <td>
          <label><input type="radio" name="existencia_${comun.id}" value="si"> Sí</label>
          <label><input type="radio" name="existencia_${comun.id}" value="no"> No</label>
        </td>
        <td>
          <select name="cantidad_${comun.id}" class="form-control">
            ${[...Array(10).keys()].map(i => `<option value="${i + 1}">${i + 1}</option>`).join('')}
          </select>
        </td>  
        <td>
          <label><input type="radio" name="uso_${comun.id}" value="si"> Sí</label>
          <label><input type="radio" name="uso_${comun.id}" value="no"> No</label>
        </td>
        <td>
          <select name="condicion_${comun.id}" class="form-select form-select-sm">
            <option value="">Selecciona</option>
            <option value="bueno">Buena</option>
            <option value="regular">Regular</option>
            <option value="malo">Mala</option>
          </select>
        </td>
        <td>${selectDanioEstructural()}</td>
        <td>${selectDanioInstalacion()}</td>
        <td>${obraEnProcesoTemplate(norm)}</td>
        <td>${selectConstruccionAdicional(comun.id)}</td>
        <td><button class="btn btn-primary btn-sm">Agregar evidencia</button></td>
      </tr>
    `;
                                                                    document.getElementById('tablaAreasComunes2').insertAdjacentHTML('beforeend', filaHTML);
                                                                }

                                                                // Inicializar tabla al cargar
                                                                document.addEventListener("DOMContentLoaded", () => {
                                                                    comunes.forEach(comun => crearFilaComun(comun));

                                                                    // Activar/desactivar select de cantidad de construcción
                                                                    document.addEventListener("change", (e) => {
                                                                        if (e.target.classList.contains("requiere-construccion")) {
                                                                            const area = e.target.dataset.area;
                                                                            const cantidadSelect = document.querySelector(`select.cantidad-construccion[data-area="${area}"]`);
                                                                            cantidadSelect.disabled = (e.target.value !== "si");
                                                                        }
                                                                    });
                                                                });

                                                                // Función para habilitar/deshabilitar selects de obra en proceso
                                                                function toggleObraEnProceso(norm, enabled) {
                                                                    const tipoObra = document.getElementById('tipo-obra-' + norm);
                                                                    const recursoObra = document.getElementById('recurso-obra-' + norm);
                                                                    if (tipoObra && recursoObra) {
                                                                        tipoObra.disabled = !enabled;
                                                                        recursoObra.disabled = !enabled;
                                                                        if (!enabled) {
                                                                            tipoObra.value = "";
                                                                            recursoObra.value = "";
                                                                        }
                                                                    }
                                                                }
                                                            </script>



                                                        </div>


                                                        <!-- 3.5 Infraestructura física exterior -->


                                                        <div class="col-lg-12 mt-4">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-sm text-center align-middle">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Elementos</th>
                                                                            <th>Existencia</th>
                                                                            <th>Cantidad</th>
                                                                            <th>En uso</th>
                                                                            <th>Condición</th>
                                                                            <th>Con daño estructural</th>
                                                                            <th>Con daño de instalación</th>
                                                                            <th>Obra en Proceso</th>
                                                                            <th>Requiere construcción adicional</th>
                                                                            <th style="background-color: #fff;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaInfraestructuraExterior"></tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            const infraestructuraExterior = [{
                                                                    nombre: 'Acceso principal',
                                                                    id: 'acceso_principal'
                                                                },
                                                                {
                                                                    nombre: 'Alumbrado',
                                                                    id: 'alumbrado_exterior'
                                                                },
                                                                {
                                                                    nombre: 'Andador',
                                                                    id: 'andadores'
                                                                },
                                                                {
                                                                    nombre: 'Asta bandera',
                                                                    id: 'asta_bandera'
                                                                },
                                                                {
                                                                    nombre: 'Barda perimetral',
                                                                    id: 'barda_perimetral'
                                                                },
                                                                {
                                                                    nombre: 'Bebedero',
                                                                    id: 'bebederos'
                                                                },
                                                                {
                                                                    nombre: 'Cerco perimetral',
                                                                    id: 'cerco_perimetral'
                                                                },
                                                                {
                                                                    nombre: 'Contenedor',
                                                                    id: 'contenedores'
                                                                },
                                                                {
                                                                    nombre: 'Cubo de tinacos',
                                                                    id: 'cubo_tinacos'
                                                                },
                                                                {
                                                                    nombre: 'Escalera de emergencia',
                                                                    id: 'escaleras_emergencia'
                                                                },
                                                                {
                                                                    nombre: 'Malla sombra',
                                                                    id: 'malla_sombra'
                                                                },
                                                                {
                                                                    nombre: 'Mesa con bancas de concreto',
                                                                    id: 'mesas_bancas_concreto'
                                                                },
                                                                {
                                                                    nombre: 'Muro de acometida',
                                                                    id: 'muro_acometida'
                                                                },
                                                                {
                                                                    nombre: 'Muro de contención',
                                                                    id: 'muro_contencion'
                                                                },
                                                                {
                                                                    nombre: 'Pasamanos',
                                                                    id: 'pasamanos'
                                                                },
                                                                {
                                                                    nombre: 'Rampa',
                                                                    id: 'rampas'
                                                                },
                                                                {
                                                                    nombre: 'Reja perimetral',
                                                                    id: 'reja_perimetral'
                                                                },
                                                                {
                                                                    nombre: 'Techumbre',
                                                                    id: 'techumbre_canchas'
                                                                }
                                                            ];

                                                            // Select de daños estructurales
                                                            function selectDanioEstructural() {
                                                                const danios = [
                                                                    "Exposición de varillas en losas o columnas", "Filtraciones en techo", "Fisuras en columnas",
                                                                    "Fisuras en techos o muros", "Flexiones en techo", "Humedad en muros",
                                                                    "Hundimiento o inclinación de pisos", "Inclinación en muros", "Movimiento en muros",
                                                                    "Vibración excesiva en circulaciones, escaleras o techos"
                                                                ];
                                                                return `
      <select class="form-select form-select-sm">
        <option value="">Selecciona</option>
        ${danios.map(d => `<option value="${d}">${d}</option>`).join("")}
      </select>
    `;
                                                            }

                                                            // Select de daños en instalaciones
                                                            function selectDanioInstalacion() {
                                                                const danios = [
                                                                    "Desperfectos en cancelería", "Desprendimiento de acabados",
                                                                    "Falta de impermeabilizante", "Falta de luminarias", "Falta de ventiladores/aire acondicionado",
                                                                    "Pintura general", "Pisos fisurados"
                                                                ];
                                                                return `
      <select class="form-select form-select-sm">
        <option value="">Selecciona</option>
        ${danios.map(d => `<option value="${d}">${d}</option>`).join("")}
      </select>
    `;
                                                            }

                                                            // Select de construcción adicional
                                                            function selectConstruccionAdicional(areaIndex) {
                                                                return `
      <select class="form-select form-select-sm requiere-construccion" data-area="${areaIndex}">
        <option value="">¿Requiere construcción?</option>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
      <select class="form-select form-select-sm mt-1 cantidad-construccion" data-area="${areaIndex}" disabled>
        <option value="">Cantidad</option>
        ${[...Array(10).keys()].map(i => `<option value="${i + 1}">${i + 1}</option>`).join("")}
      </select>
    `;
                                                            }

                                                            // Obra en Proceso
                                                            function obraEnProcesoTemplate(norm) {
                                                                return `
      <div>
        <label style="margin-right: 6px;">
          <input type="radio" name="obra_${norm}" value="si" onchange="toggleObraEnProceso('${norm}', true)"> Sí
        </label>
        <label>
          <input type="radio" name="obra_${norm}" value="no" onchange="toggleObraEnProceso('${norm}', false)"> No
        </label>
        <br>
        <select id="tipo-obra-${norm}" class="form-select form-select-sm mt-1" disabled>
          <option value="">Tipo de obra</option>
          <option value="Albañilería">Albañilería</option>
          <option value="Pintura y acabados">Pintura y acabados</option>
          <option value="Reforzamiento de estructuras">Reforzamiento de estructuras</option>
          <option value="Herrería">Herrería</option>
          <option value="Plomería">Plomería</option>
          <option value="Impermeabilización">Impermeabilización</option>
          <option value="Red eléctrica">Red eléctrica</option>
          <option value="Red hidráulica">Red hidráulica</option>
          <option value="Carpintería">Carpintería</option>
          <option value="Urbanismo">Urbanismo</option>
        </select>
        <select id="recurso-obra-${norm}" class="form-select form-select-sm mt-1" disabled>
          <option value="">Recurso</option>
          <option value="Federal">Federal</option>
          <option value="Estatal">Estatal</option>
          <option value="Municipal">Municipal</option>
        </select>
      </div>
    `;
                                                            }

                                                            // Crear fila dinámica
                                                            function crearFilaExterior(elemento) {
                                                                const norm = elemento.id.replace(/\s+/g, '_');
                                                                const filaHTML = `
      <tr>
        <td>${elemento.nombre}</td>
        <td>
          <label><input type="radio" name="existencia_${elemento.id}" value="si"> Sí</label>
          <label><input type="radio" name="existencia_${elemento.id}" value="no"> No</label>
        </td>
        <td>
          <select name="cantidad_${elemento.id}" class="form-select form-select-sm">
            ${[...Array(10).keys()].map(i => `<option value="${i + 1}">${i + 1}</option>`).join("")}
          </select>
        </td>
        <td>
          <label><input type="radio" name="enuso_${elemento.id}" value="si"> Sí</label>
          <label><input type="radio" name="enuso_${elemento.id}" value="no"> No</label>
        </td>
        <td>
          <select name="condicion_${elemento.id}" class="form-select form-select-sm">
            <option value="">Selecciona</option>
            <option value="bueno">Buena</option>
            <option value="regular">Regular</option>
            <option value="malo">Mala</option>
          </select>
        </td>
        <td>${selectDanioEstructural()}</td>
        <td>${selectDanioInstalacion()}</td>
        <td>${obraEnProcesoTemplate(norm)}</td>
        <td>${selectConstruccionAdicional(elemento.id)}</td>
        <td><button class="btn btn-primary btn-sm">Agregar evidencia</button></td>
      </tr>
    `;
                                                                document.getElementById('tablaInfraestructuraExterior').insertAdjacentHTML('beforeend', filaHTML);
                                                            }

                                                            // Inicializar tabla
                                                            document.addEventListener("DOMContentLoaded", () => {
                                                                infraestructuraExterior.forEach(e => crearFilaExterior(e));

                                                                // Activar/desactivar select de cantidad de construcción
                                                                document.addEventListener("change", (e) => {
                                                                    if (e.target.classList.contains("requiere-construccion")) {
                                                                        const area = e.target.dataset.area;
                                                                        const cantidadSelect = document.querySelector(`select.cantidad-construccion[data-area="${area}"]`);
                                                                        cantidadSelect.disabled = (e.target.value !== "si");
                                                                    }
                                                                });
                                                            });

                                                            // Función para habilitar/deshabilitar selects de obra en proceso
                                                            function toggleObraEnProceso(norm, enabled) {
                                                                const tipoObra = document.getElementById('tipo-obra-' + norm);
                                                                const recursoObra = document.getElementById('recurso-obra-' + norm);
                                                                if (tipoObra && recursoObra) {
                                                                    tipoObra.disabled = !enabled;
                                                                    recursoObra.disabled = !enabled;
                                                                    if (!enabled) {
                                                                        tipoObra.value = "";
                                                                        recursoObra.value = "";
                                                                    }
                                                                }
                                                            }
                                                        </script>


                                                        <!-- Modal 1 -->
                                                        <!-- <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal1Label">Edificio "A"  Nivel:  "Planta Baja"</h5>

          <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>3.3 Análisis por edificio: </h5>

          <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle text-center">
              <thead class="table-light">
                <tr>
                  <th>Áreas principales</th>
                  <th>Existencia<br></th>
                  <th>Cantidad</th>
                  <th>En uso<br></th>
                  <th>Condición<br></th> 
                  <th style="background-color: #fff;" ></th>
                </tr>
              </thead>
              <tbody id="tablaAreasModal1"></tbody>
            </table>
          </div>


          <div class="mb-3">
            <h5>3.4 ¿Presenta daños estructurales?</h5>
            <input type="radio" class="form-check-input exclusiva" data-group="danio-estructural-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="danio-estructural-no"> No
          </div>
  
          <div class="table-responsive mb-4">
            <h6 class="fw-bold">Tipo de daño estructural</h6>
            <table class="table table-bordered table-sm text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>Tipo de daño</th>
                  <th>Existencia<br></th>
                  <th style="background-color: #fff;" ></th> 
                </tr>
              </thead>
              <tbody id="tablaDaniosEstructurales"></tbody>
            </table>
          </div>
  
          <div class="mb-3">
            <h5>3.6 ¿Presenta daños en instalaciones?</h5>

            <input type="radio" class="form-check-input exclusiva" data-group="danio-instalacion-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="danio-instalacion-no"> No
          </div>
  
          <div class="table-responsive">
            <h6 class="fw-bold">Tipo de daño en instalaciones</h6>
            <table class="table table-bordered table-sm text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>Tipo de daño</th>
                  <th>Existencia<br></th>
                  <th style="background-color: #fff;" ></th>
                </tr>
              </thead>
              <tbody id="tablaDaniosInstalaciones"></tbody>
            </table>
          </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2" data-dismiss="modal">Siguiente</button>
        </div>
      </div>
    </div>
  </div> -->

                                                        <!-- <script>
    const areasModal1 = [
      "Ádministrativa","Baños", "Biblioteca", "Bodega",
      "Centro de cómputo", "Comedor", "Dirección", "Dormitorios", "Intendencia", "Laboratorios", "Letrinas", "Sala de usos múltiples",
      "Salones", "Talleres", "Vestidores"
    ];

    const areasPrincipales1 = [
    "Baños", "Dirección", "Letrinas", "Salones"
    ];

    const areasAdicionales1 = [
      "Ádministrativa", "Biblioteca", "Bodega", "Centro de cómputo", "Comedor",  "Dormitorios", "Intendencia", "Laboratorios",  
      "Sala de usos múltiples", "Talleres", "Vestidores"
    ];

     

  function crearFilaModal1(area) {
    const selectCantidad = `<select class="form-select form-select-sm">
      ${[...Array(10)].map((_, i) => `<option>${i + 1}</option>`).join("")}
    </select>`;

    const selectCondicion = `
      <select class="form-select form-select-sm">
        <option value="">Selecciona condición</option>
        <option value="bueno">Buena</option>
        <option value="regular">Regular</option>
        <option value="malo">Mala</option>
      </select>`;

    return `
      <tr>
        <td>${area}</td>
        <td>
          <input type="radio" class="form-check-input exclusiva" data-group="existencia-${area}-si"> Sí
          <input type="radio" class="form-check-input exclusiva" data-group="existencia-${area}-no"> No
        </td>
        <td>${selectTipoConstruccion()}</td>
        <td>${selectCantidad}</td>
        <td>
          <input type="radio" class="form-check-input exclusiva" data-group="uso-${area}-si"> Sí
          <input type="radio" class="form-check-input exclusiva" data-group="uso-${area}-no"> No
        </td>
        <td>${selectCondicion}</td>
        <td>${selectDanioEstructural()}</td>
        <td>${selectDanioInstalacion()}</td>
        <td>${selectConstruccionAdicional(area)}</td>
        <td><button class="btn btn-primary btn-sm">Agregar evidencia</button></td>
      </tr>
    `;
  }

  // Genera ambas tablas por separado
  document.addEventListener("DOMContentLoaded", () => {
    const tabla1 = document.getElementById("tablaAreasPrincipales");
    areasPrincipales.forEach(area => {
      tabla1.insertAdjacentHTML("beforeend", crearFilaModal1(area));
    });

    const tabla2 = document.getElementById("tablaAreasAdicionales");
    areasAdicionales.forEach(area => {
      tabla2.insertAdjacentHTML("beforeend", crearFilaModal1(area));
    });

    // Exclusividad de radios
    document.addEventListener("change", (e) => {
      if (e.target.classList.contains("exclusiva")) {
        const group = e.target.dataset.group.split("-").slice(0, -1).join("-");
        document.querySelectorAll(`input[data-group^="${group}-"]`).forEach(el => {
          if (el !== e.target) el.checked = false;
        });
      }
    });
  });


</script> -->

                                                        <script>
                                                            //Selecto de tipo de contrucción usando la constante tiposConstruccion


                                                            // Select de tipo de construcción
                                                            function selectTipoConstruccion() {
                                                                return `
      <select class="form-select form-select-sm">
        <option value="">Selecciona tipo de construcción</option>
        ${tiposConstruccion.map(t => `<option>${t}</option>`).join("")}
      </select>
    `;
                                                            }

                                                            // Select de daños estructurales
                                                            function selectDanioEstructural() {
                                                                return `
    <select class="form-select form-select-sm">
      <option value="">Selecciona tipo de daño</option>
      ${daniosEstructurales.map(d => `<option>${d}</option>`).join("")}
    </select>
  `;
                                                            }

                                                            // Select de daños en instalaciones
                                                            function selectDanioInstalacion() {
                                                                return `
    <select class="form-select form-select-sm">
      <option value="">Selecciona tipo de daño</option>
      ${daniosInstalaciones.map(d => `<option>${d}</option>`).join("")}
    </select>
  `;
                                                            }

                                                            // Select de "Requiere construcción adicional"
                                                            function selectConstruccionAdicional(areaIndex) {
                                                                return `
    <select class="form-select form-select-sm requiere-construccion" data-area="${areaIndex}">
      <option value="">¿Requiere construcción?</option>
      <option value="no">No</option>
      <option value="si">Sí</option>
    </select>
    <select class="form-select form-select-sm mt-1 cantidad-construccion" data-area="${areaIndex}" disabled>
      <option value="">Cantidad</option>
      ${[...Array(10).keys()].map(i => `<option value="${i + 1}">${i + 1}</option>`).join("")}
    </select>
  `;
                                                            }


                                                            document.addEventListener("change", (e) => {
                                                                if (e.target.classList.contains("requiere-construccion")) {
                                                                    const area = e.target.dataset.area;
                                                                    const cantidadSelect = document.querySelector(`select.cantidad-construccion[data-area="${area}"]`);
                                                                    cantidadSelect.disabled = (e.target.value !== "si");
                                                                }
                                                            });
                                                        </script>

                                                        <script>
                                                            //Datos para tipo de construcción
                                                            const tiposConstruccion = [
                                                                "Construcción con concreto", "Construcción de mampostería", "Construcción con materiales naturales", "Construcción con estructuras prefabricadas"
                                                            ];

                                                            const daniosEstructurales = [
                                                                "Exposición de varillas en losas o columnas", "Filtraciones en techo", "Fisuras en columnas",
                                                                "Fisuras en techos o muros", "Flexiones en techo", "Humedad en muros",
                                                                "Hundimiento o inclinación de pisos", "Inclinación en muros", "Movimiento en muros",
                                                                "Vibración excesiva en circulaciones, escaleras o techos"
                                                            ];

                                                            const daniosInstalaciones = [
                                                                "Desperfectos en cancelería de puertas y/o de ventanas", "Desprendimiento de algún material de acabados en techo o columnas",
                                                                "Falta de impermeabilizante", "Falta de luminarias", "Falta de ventiladores/aire acondicionado",
                                                                "Pintura general", "Pisos fisurados"
                                                            ];

                                                            function generarFilaDanio(nombre, grupo) {
                                                                const id = `${grupo}-${nombre.replace(/\s+/g, '-')}`;
                                                                const pisos = ["Planta baja", "1er piso", "2do piso", "3er piso", "4to piso"]
                                                                    .map(p => `<option>${p}</option>`).join('');
                                                                return `
        <tr>
          <td>${nombre}</td>
          <td>
            <input type="radio" class="form-check-input exclusiva" data-group="${id}-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="${id}-no"> No
          </td>
 
          <td>
            <button class="btn btn-primary agregar-evidencia">Agregar evidencia</button>
          </td>
        </tr>
      `;
                                                            }

                                                            document.addEventListener("DOMContentLoaded", () => {
                                                                const tabla1 = document.getElementById("tablaDaniosEstructurales");
                                                                const tabla2 = document.getElementById("tablaDaniosInstalaciones");

                                                                daniosEstructurales.forEach(nombre => {
                                                                    tabla1.insertAdjacentHTML("beforeend", generarFilaDanio(nombre, "estructural"));
                                                                });

                                                                daniosInstalaciones.forEach(nombre => {
                                                                    tabla2.insertAdjacentHTML("beforeend", generarFilaDanio(nombre, "instalacion"));
                                                                });

                                                                // Exclusividad de checkboxes
                                                                document.addEventListener("change", (e) => {
                                                                    if (e.target.classList.contains("exclusiva")) {
                                                                        const group = e.target.dataset.group.split("-").slice(0, -1).join("-");
                                                                        document.querySelectorAll(`input[data-group^="${group}-"]`).forEach(el => {
                                                                            if (el !== e.target) el.checked = false;
                                                                        });
                                                                    }
                                                                });
                                                            });

                                                            function guardarCambios() {
                                                                alert("Cambios guardados exitosamente.");
                                                            }
                                                        </script>

                                                        <!-- Modal 2 -->
                                                        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modal2Label">Edificio "A" Nivel: "Planta Baja"
                                                                        </h5>
                                                                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <span><b>Descipción de mobiliario: </b></span>
                                                                        <div class="table-responsive mb-4">
                                                                            <table class="table table-bordered table-sm text-center align-middle">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Mobiliario</th>
                                                                                        <th>Existencia<br></th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>En uso<br></th>
                                                                                        <th>Condición<br></th>
                                                                                        <th style="background-color: #fff;"></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tablaMobiliario"></tbody>
                                                                            </table>
                                                                        </div>


                                                                        <span><b>Descipción de equipo: </b></span>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm text-center align-middle">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Equipo</th>
                                                                                        <th>Existencia<br></th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>En uso<br></th>
                                                                                        <th>Condición<br></th>
                                                                                        <th style="background-color: #fff;"></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tablaEquipo"></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal3" data-dismiss="modal">Siguiente</button>
                                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal1" data-dismiss="modal">Regresar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <script>
                                                            const mobiliario = [
                                                                "Archivero", "Banca en vestidores", "Banco", "Butaca", "Butacas para zurdos", "Casillero",
                                                                "Cesto de basura", "Escritorio", "Escritorio para maestro", "Estante", "Mesa", "Mesa binaria",
                                                                "Mesa de laboratorio", "Mesa-banco", "Mesa-banco-binario", "Pizarrón", "Pintarrón", "Silla",
                                                                "Silla con paleta", "Silla para maestro"
                                                            ];

                                                            const equipo = ["Aire acondicionado",
                                                                "Bocina para PC", "Computadora PC", "Computadora portátil", "Copiadora", "DVD",
                                                                "Equipo de sonido", "Estante", "Impresora", "Máquina de escribir", "Pantalla retráctil",
                                                                "Regulador", "Scanner", "Tableta", "Televisión", "Pantalla", "Proyector de video"
                                                            ];

                                                            function generarFila(nombre, tipo) {
                                                                const id = `${tipo}-${nombre.replace(/\s+/g, '-')}`;
                                                                const selectCantidad = `<select class="form-select form-select-sm">${[1, 2, 3, 4, 5, 6, 7, 8, 10].map(n => `<option>${n}</option>`).join('')}</select>`;

                                                                // Cambios realizados aquí en columna 5 y 6
                                                                const selectCondicion = `
        <select class="form-select form-select-sm" data-group="${id}-condicion">
                                    <option value="buen"></option>

          <option value="bueno">Buena</option>
          <option value="regular">Regular</option>
          <option value="malo">Mala</option>
        </select>`;

                                                                const selectMotivo = `
        <select class="form-select form-select-sm" data-group="${id}-motivo">
                                        <option value="danio"></option>

          <option value="daño">Daño estructural</option>
          <option value="uso">Uso distinto</option>
        </select>`;

                                                                return `
        <tr>
          <td>${nombre}</td>
          <td>
            <input type="radio" class="form-check-input exclusiva" data-group="${id}-existencia-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="${id}-existencia-no"> No
          </td>
          <td>${selectCantidad}</td>
          <td>
            <input type="radio" class="form-check-input exclusiva" data-group="${id}-uso-si"> Sí
            <input type="radio" class="form-check-input exclusiva" data-group="${id}-uso-no"> No
          </td>
          <td>${selectCondicion}</td>
           
          <td><button class="btn btn-primary agregar-evidencia">Agregar evidencia</button></td>
        </tr>
      `;
                                                            }

                                                            document.addEventListener("DOMContentLoaded", () => {
                                                                const tbodyMobiliario = document.getElementById("tablaMobiliario");
                                                                const tbodyEquipo = document.getElementById("tablaEquipo");

                                                                mobiliario.forEach(item => tbodyMobiliario.insertAdjacentHTML("beforeend", generarFila(item, "mobiliario")));
                                                                equipo.forEach(item => tbodyEquipo.insertAdjacentHTML("beforeend", generarFila(item, "equipo")));

                                                                // Exclusividad de checkboxes
                                                                document.addEventListener("change", (e) => {
                                                                    if (e.target.classList.contains("exclusiva")) {
                                                                        const group = e.target.dataset.group.split("-").slice(0, -1).join("-");
                                                                        document.querySelectorAll(`input[data-group^="${group}-"]`).forEach(el => {
                                                                            if (el !== e.target) el.checked = false;
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        </script>

                                                        <!-- Modal 3 -->
                                                        <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modal3Label">Edificio "A" Nivel: "Planta Baja"</h5>
                                                                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="table-responsive">
                                                                            <h5>3.8 ¿Existe la necesidad de construcción de algún espacio?</h5>
                                                                            <br>
                                                                            <label>
                                                                                <input type="radio" name="necesidad_construccion" value="SI" checked> Sí
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="necesidad_construccion" value="NO"> No
                                                                            </label>

                                                                            <table class="table table-bordered table-sm align-middle text-center">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Área</th>
                                                                                        <th>¿Necesita construcción?</th>
                                                                                        <th>Cantidad</th>
                                                                                        <th style="background-color: #fff;"></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tablaArea"></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <script>
                                                                        const areas = [{
                                                                                nombre: 'Área administrativa',
                                                                                id: 'administrativa'
                                                                            },
                                                                            {
                                                                                nombre: 'Área de intendencia',
                                                                                id: 'intendencia'
                                                                            },
                                                                            {
                                                                                nombre: 'Baño',
                                                                                id: 'banos'
                                                                            },
                                                                            {
                                                                                nombre: 'Biblioteca',
                                                                                id: 'biblioteca'
                                                                            },
                                                                            {
                                                                                nombre: 'Bodega',
                                                                                id: 'bodega'
                                                                            },
                                                                            {
                                                                                nombre: 'Centro de cómputo',
                                                                                id: 'centro_computo'
                                                                            },
                                                                            {
                                                                                nombre: 'Comedor',
                                                                                id: 'comedor'
                                                                            },
                                                                            {
                                                                                nombre: 'Dirección',
                                                                                id: 'direccion'
                                                                            },
                                                                            {
                                                                                nombre: 'Laboratorio',
                                                                                id: 'laboratorios'
                                                                            },
                                                                            {
                                                                                nombre: 'Letrina',
                                                                                id: 'letrinas'
                                                                            },
                                                                            {
                                                                                nombre: 'Sala de usos múltiples',
                                                                                id: 'salas'
                                                                            },
                                                                            {
                                                                                nombre: 'Salón',
                                                                                id: 'salones'
                                                                            },
                                                                            {
                                                                                nombre: 'Taller',
                                                                                id: 'talleres'
                                                                            },
                                                                            {
                                                                                nombre: 'Vestidor',
                                                                                id: 'vestidores'
                                                                            }
                                                                        ];

                                                                        function crearFila(area) {
                                                                            const filaHTML = `
                    <tr>
                        <td>${area.nombre}</td>
                        <td>
                            <label>
                                <input type="radio" name="necesidad_${area.id}" value="si" required> Sí
                            </label>
                            <label>
                                <input type="radio" name="necesidad_${area.id}" value="no" required> No
                            </label>
                        </td>
                        <td>
                            <select name="cantidad_${area.id}" class="form-control">
                                ${[...Array(10).keys()].map(i => `<option value="${i + 1}">${i + 1}</option>`).join('')}
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary">Agregar evidencia</button>
                        </td>
                    </tr>
                `;
                                                                            document.getElementById('tablaArea').insertAdjacentHTML('beforeend', filaHTML);
                                                                        }

                                                                        // Crear filas para áreas
                                                                        areas.forEach(area => crearFila(area));
                                                                    </script>






                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal4" data-dismiss="modal">Siguiente</button>
                                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal2" data-dismiss="modal">Regresar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>





                                                        <!-- Modal 4 -->
                                                        <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modal4Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modal4Label">ÁREAS COMUNES “B”</h5>
                                                                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">


                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-bordered table-sm text-center align-middle">
                                                                                    <thead class="table-light">
                                                                                        <tr>
                                                                                            <th>Áreas</th>
                                                                                            <th>Existencia</th>
                                                                                            <th>Cantidad</th>
                                                                                            <th>En uso</th>
                                                                                            <th>Condición</th>
                                                                                            <th>Agregar evidencia</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="tablaAreasComunes"></tbody>
                                                                                </table>
                                                                            </div>


                                                                            <div class="modal-body">
                                                                                <div class="table-responsive">
                                                                                    <h5>3.9 ¿Existe la necesidad de construcción de algún espacio?</h5>
                                                                                    <br>
                                                                                    <label>
                                                                                        <input type="radio" name="necesidad_construccion" value="SI" checked> Sí
                                                                                    </label>
                                                                                    <label>
                                                                                        <input type="radio" name="necesidad_construccion" value="NO"> No
                                                                                    </label>

                                                                                    <table class="table table-bordered table-sm align-middle text-center">
                                                                                        <thead class="table-light">
                                                                                            <tr>
                                                                                                <th>Zona</th>
                                                                                                <th>¿Necesita construcción?</th>
                                                                                                <th>Cantidad</th>
                                                                                                <th style="background-color: #fff;"></th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody id="tablaComunes"></tbody>
                                                                                    </table>

                                                                                    <!-- <script>
                    const comunes = [
                        { nombre: 'Andadores', id: 'andadores' },
                        { nombre: 'Asta bandera', id: 'asta_bandera' },
                        { nombre: 'Barda perimetral', id: 'barda_perimetral' },
                        { nombre: 'Bebederos', id: 'bebederos' },
                        { nombre: 'Cancha deportivas', id: 'cancha_deportivas' },
                        { nombre: 'Cerca de malla', id: 'cerca_de_malla' },
                        { nombre: 'Cubo de tinacos', id: 'cubo_de_tinacos' },
                        { nombre: 'Iluminación exterior', id: 'iluminacion_exterior' },
                        { nombre: 'Kiosco', id: 'kiosco' },
                        { nombre: 'Mesas y bancas de concreto', id: 'mesas_bancas_concreto' },
                        { nombre: 'Muro de acometida', id: 'muro_acometida' },
                        { nombre: 'Plaza cívica', id: 'plaza_civica' },
                        { nombre: 'Pórtico', id: 'portico' },
                        { nombre: 'Puerta de acceso', id: 'puerta_acceso' },
                        { nombre: 'Rampas', id: 'rampas' },
                        { nombre: 'Reja', id: 'reja' },
                        { nombre: 'Techumbre de canchas', id: 'techumbre_canchas' },
                        { nombre: 'Techumbre de plaza cívica', id: 'techumbre_plaza_civica' }
                    ];
        
                    function crearFilaComun(comun) {
                        const filaHTML = `
                            <tr>
                                <td>${comun.nombre}</td>
                                <td>
                                    <label>
                                        <input type="radio" name="necesidad_${comun.id}" value="si" required> Sí
                                    </label>
                                    <label>
                                        <input type="radio" name="necesidad_${comun.id}" value="no" required> No
                                    </label>
                                </td>
                                <td>
                                    <select name="cantidad_${comun.id}" class="form-control">
                                        ${[...Array(10).keys()].map(i => `<option value="${i + 1}">${i + 1}</option>`).join('')}
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-primary">Agregar evidencia</button>
                                </td>
                            </tr>
                        `;
                        document.getElementById('tablaComunes').insertAdjacentHTML('beforeend', filaHTML);
                    }
        
                    // Crear filas para áreas comunes
                    comunes.forEach(comun => crearFilaComun(comun));
                </script> -->
                                                                                </div>
                                                                            </div>

                                                                        </div>







                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal3" data-dismiss="modal">Regresar</button>
                                                                        <button type="button" class="btn btn-success" onclick="guardarCambios()">Guardar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            const areasComunes = [
                                                                "Andador", "Asta bandera", "Barda perimetral(es)", "Bebedero", "Cancha deportiva",
                                                                "Cerca de malla", "Cubo de tinacos", "Iluminación", "Kiosco", "Mesas y bancas de concreto",
                                                                "Muro de acometida", "Plaza cívica", "Pórtico", "Puerta de acceso", "Rampa", "Reja",
                                                                "Techumbre de canchas", "Techumbre de plaza cívica"
                                                            ];

                                                            function generarFilaAreas(nombre) {
                                                                const id = `areas-${nombre.replace(/\s+/g, '-')}`;
                                                                const cantidadSelect = `<select class="form-select form-select-sm cantidad" data-id="${id}">
            ${[1, 2, 3, 4, 5, 6, 7, 8, 10].map(n => `<option value="${n}">${n}</option>`).join('')}
        </select>`;

                                                                const condicionSelect = `<select class="form-select form-select-sm condicion" data-id="${id}">
            <option value=""></option>
            <option value="buena">Buena</option>
            <option value="regular">Regular</option>
            <option value="mala">Mala</option>
        </select>`;



                                                                return `
            <tr>
                <td>${nombre}</td>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input exclusiva existencia" type="radio" name="existencia_${id}" value="si" required> Sí
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input exclusiva existencia" type="radio" name="existencia_${id}" value="no" required> No
                    </div>
                </td>
                <td>${cantidadSelect}</td>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input exclusiva en_uso" type="radio" name="en_uso_${id}" value="si"> Sí
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input exclusiva en_uso" type="radio" name="en_uso_${id}" value="no"> No
                    </div>
                </td>
                <td>${condicionSelect}</td> 
                <td><button class="btn btn-primary agregar-evidencia" data-id="${id}">Agregar evidencia</button></td>
            </tr>
        `;
                                                            }

                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                const tbodyAreas = document.getElementById("tablaAreasComunes");

                                                                areasComunes.forEach(area => {
                                                                    tbodyAreas.insertAdjacentHTML("beforeend", generarFilaAreas(area));
                                                                });

                                                                // Manejo de exclusividad
                                                                document.addEventListener("change", (e) => {
                                                                    if (e.target.classList.contains("exclusiva")) {
                                                                        const nombreRadio = e.target.name;
                                                                        const radios = document.querySelectorAll(`input[name="${nombreRadio}"]`);

                                                                        radios.forEach(radio => {
                                                                            if (radio !== e.target && radio.checked) {
                                                                                radio.checked = false;
                                                                            }
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        </script>


                                                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                                                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                                                        <script>
                                                            function guardarCambios() {
                                                                alert('Cambios guardados con éxito.');
                                                                // Aquí puedes agregar tu lógica para guardar el mapa o realizar otra acción necesaria.
                                                                $('#modal4').modal('hide'); // Cerrar el modal 4 después de guardar
                                                            }
                                                        </script>




















                                                        <script>
                                                            const formas = document.querySelectorAll('.forma'); // Solo las formas restantes
                                                            const zonaDibujo = document.getElementById('zonaDibujo');
                                                            let isDrawing = false;
                                                            let usingEraser = false;
                                                            let startX, startY;

                                                            formas.forEach(forma => {
                                                                forma.addEventListener('dragstart', (e) => {
                                                                    e.dataTransfer.setData('text/plain', forma.className);
                                                                });
                                                            });

                                                            zonaDibujo.addEventListener('dragover', (e) => {
                                                                e.preventDefault();
                                                            });

                                                            zonaDibujo.addEventListener('drop', (e) => {
                                                                e.preventDefault();
                                                                const className = e.dataTransfer.getData('text/plain');
                                                                const elemento = document.createElement('div');
                                                                elemento.className = "elemento " + className;

                                                                // Determinar la posición donde se suelta
                                                                const rect = zonaDibujo.getBoundingClientRect();
                                                                const x = e.clientX - rect.left;
                                                                const y = e.clientY - rect.top;

                                                                elemento.style.left = `${x}px`;
                                                                elemento.style.top = `${y}px`;

                                                                zonaDibujo.appendChild(elemento);

                                                                // Hacer que los elementos sean arrastrables
                                                                elemento.draggable = true;

                                                                // Manejadores de eventos para permitir mover los elementos
                                                                elemento.addEventListener('dragstart', (e) => {
                                                                    e.dataTransfer.setData('text/plain', '');
                                                                    e.dataTransfer.setDragImage(elemento, 0, 0);
                                                                });

                                                                elemento.addEventListener('dragend', (e) => {
                                                                    const rect = zonaDibujo.getBoundingClientRect();
                                                                    const x = e.clientX - rect.left;
                                                                    const y = e.clientY - rect.top;

                                                                    elemento.style.left = `${x}px`;
                                                                    elemento.style.top = `${y}px`;
                                                                });

                                                                elemento.addEventListener('click', (event) => {
                                                                    event.stopPropagation(); // Evita que el evento burbujee

                                                                    // Pedir al usuario que ingrese una letra
                                                                    const letra = prompt("Ingrese una letra (A-Z):");
                                                                    if (letra && letra.length === 1 && /^[A-Za-z]$/.test(letra)) {
                                                                        const letraDiv = document.createElement('div');
                                                                        letraDiv.textContent = letra.toUpperCase(); // Asegura que esté en mayúsculas
                                                                        letraDiv.style.position = 'absolute';
                                                                        letraDiv.style.color = 'white';
                                                                        letraDiv.style.top = '5px';
                                                                        letraDiv.style.left = '5px';
                                                                        elemento.appendChild(letraDiv);
                                                                    } else {
                                                                        alert("Por favor, ingrese una única letra válida.");
                                                                    }
                                                                });
                                                            });

                                                            // Herramienta de lápiz
                                                            const lapiz = document.getElementById('lapiz');

                                                            lapiz.addEventListener('click', () => {
                                                                isDrawing = !isDrawing; // Alternar estado de dibujo
                                                                lapiz.style.backgroundColor = isDrawing ? 'lightgreen' : 'lightblue'; // Cambiar color para indicar estado
                                                            });

                                                            zonaDibujo.addEventListener('mousedown', (e) => {
                                                                if (isDrawing) {
                                                                    const rect = zonaDibujo.getBoundingClientRect();
                                                                    startX = e.clientX - rect.left;
                                                                    startY = e.clientY - rect.top;
                                                                }
                                                            });

                                                            zonaDibujo.addEventListener('mouseup', (e) => {
                                                                if (isDrawing) {
                                                                    const rect = zonaDibujo.getBoundingClientRect();
                                                                    const endX = e.clientX - rect.left;
                                                                    const endY = e.clientY - rect.top;

                                                                    // Dibujar la línea entre startX/startY y endX/endY
                                                                    const linea = document.createElement('div');
                                                                    const length = Math.sqrt(Math.pow(endX - startX, 2) + Math.pow(endY - startY, 2));
                                                                    const angle = Math.atan2(endY - startY, endX - startX) * (180 / Math.PI);

                                                                    linea.className = 'linea';
                                                                    linea.style.width = length + 'px';
                                                                    linea.style.left = startX + 'px';
                                                                    linea.style.top = startY + 'px';
                                                                    linea.style.transform = 'rotate(' + angle + 'deg)';

                                                                    zonaDibujo.appendChild(linea);
                                                                }
                                                            });

                                                            // Herramienta de goma
                                                            const goma = document.getElementById('goma');

                                                            goma.addEventListener('click', () => {
                                                                usingEraser = !usingEraser; // Alternar estado de la goma
                                                                goma.style.backgroundColor = usingEraser ? 'lightgreen' : 'lightcoral'; // Cambiar color para indicar estado
                                                            });

                                                            zonaDibujo.addEventListener('click', (event) => {
                                                                if (usingEraser) {
                                                                    const elements = document.elementsFromPoint(event.clientX, event.clientY);
                                                                    elements.forEach(el => {
                                                                        if (el.classList.contains('elemento') || el.classList.contains('linea')) {
                                                                            el.remove(); // Eliminar el elemento
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                        </script>











                                                    </form>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link mt-4" style="list-style-type: none; padding: 0; display: flex;">


                                                        <li class="next" style="display: inline-block; background-color: #007bff; color: white; border-radius: 5px; overflow: hidden;">
                                                            <a href="javascript: void(0);" class="btn" style="color: white; border: none; border-radius: 5px; padding: 10px 15px; text-decoration: none; display: block;">
                                                                Guardar Módulo 3 <i class="fas fa-save"></i>
                                                            </a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="progress-payment-details">
                                                <div>
                                                    <form>




                                                        <div class="card-header">
                                                            <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">IV. PROTECCIÓN CIVIL Y SEGURIDAD ESTRUCTURAL</h4>
                                                        </div>


                                                        <!-- MODULO DE Proteccion Civil -->
                                                        <div>
                                                            <div class="row mt-4">
                                                                <div class="col-lg-12">
                                                                    <label>4. ¿Se ha realizado alguna verificación de Protección Civil?</label><br>
                                                                    <input type="radio" name="verificacion" value="si" onchange="toggleVerificacion(true)"> Sí
                                                                    <input type="radio" name="verificacion" value="no" onchange="toggleVerificacion(false)"> No


                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <!-- Contenedor para campos dependientes -->
                                                                    <div id="verificacion-detalle" class="mt-2" style="display: none;">
                                                                        <label>En qué fecha</label>
                                                                        <input type="date" class="form-control mt-2" name="fecha_verificacion">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div id="organismo-detalle" class="mt-2" style="display: none;">
                                                                        <label>Qué organismo la realizó</label>
                                                                        <select class="form-control mt-2" name="organismo_verificador">
                                                                            <option value="">Selecciona</option>
                                                                            <option value="pc_sep">PC. SEP</option>
                                                                            <option value="gob_estatal">Gobierno Estatal</option>
                                                                            <option value="gob_municipal">Gobierno Municipal</option>
                                                                            <option value="gob_federal">Gobierno Federal</option>
                                                                            <option value="sindicato">Sindicato</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <script>
                                                                function toggleVerificacion(show) {
                                                                    document.getElementById('verificacion-detalle').style.display = show ? 'block' : 'none';
                                                                    document.getElementById('organismo-detalle').style.display = show ? 'block' : 'none';
                                                                }
                                                            </script>


                                                            <!-- 4.1 Programa Interno de Protección Civil -->
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6">
                                                                    <label>4.1 ¿El Centro de Trabajo cuenta con un Programa Interno de Protección Civil?</label><br>
                                                                    <input type="radio" name="programa" value="si" onchange="togglePrograma(true)"> Sí
                                                                    <input type="radio" name="programa" value="no" onchange="togglePrograma(false)"> No
                                                                </div>

                                                                <!-- Formato + Evidencia -->
                                                                <div class="col-lg-6" id="formato-programa-container" style="display: none;">
                                                                    <label>¿En qué formato está disponible?</label>
                                                                    <select class="form-control mt-2">
                                                                        <option value="">Selecciona</option>
                                                                        <option value="digital">Digital</option>
                                                                        <option value="fisico">Físico</option>
                                                                    </select>
                                                                    <button class="btn btn-primary mt-2" style="width: 40%;">Agregar evidencia</button>
                                                                </div>
                                                            </div>

                                                            <!-- 4.1.1 Documentos que acompañan al Programa Interno -->
                                                            <div class="row mt-3" id="documentos-programa-container" style="display: none;">
                                                                <div class="col-lg-12">
                                                                    <label><strong>4.1.1 Documentos que acompañan al Programa Interno</strong>
                                                                        <span style="color: #8f9092;">(selecciona la o las opciones)</span>:
                                                                    </label>


                                                                    <div id="documentos-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 10px;" class="mt-2"></div>
                                                                </div>
                                                            </div>

                                                            <script>
                                                                const documentosPrograma = [
                                                                    "Calendario de actividades de protección civil",
                                                                    "Censo de personas dentro del plantel",
                                                                    "Directorio de responsables en la escuela",
                                                                    "Directorio de apoyo externo",
                                                                    "Inventario de materiales de emergencia"
                                                                ];

                                                                function cargarGridDocumentosPrograma() {
                                                                    const grid = document.getElementById("documentos-grid");
                                                                    grid.innerHTML = "";

                                                                    documentosPrograma.forEach((doc, index) => {
                                                                        const id = `doc_prog_${index}`;
                                                                        const elemento = `
                                <div>
                                <input type="checkbox" id="${id}" name="documentos_programa[]" value="${doc}">
                                <label for="${id}">${doc}</label>
                                </div>
                            `;
                                                                        grid.insertAdjacentHTML("beforeend", elemento);
                                                                    });
                                                                }

                                                                function togglePrograma(show) {
                                                                    document.getElementById('formato-programa-container').style.display = show ? 'block' : 'none';
                                                                    document.getElementById('documentos-programa-container').style.display = show ? 'block' : 'none';

                                                                    if (show) cargarGridDocumentosPrograma();
                                                                }
                                                            </script>



                                                            <!-- 4.1.2 ¿Cuenta con elementos de protección civil? -->
                                                            <div class="row mt-4">
                                                                <div class="col-lg-8">
                                                                    <label><strong>4.1.2 ¿Cuenta con elementos de protección civil?</strong></label><br>
                                                                    <input type="radio" name="elementos_pc" value="si" onchange="toggleTablaElementosPC(true)"> Sí
                                                                    <input type="radio" name="elementos_pc" value="no" onchange="toggleTablaElementosPC(false)"> No

                                                                    <!-- Tabla de elementos de protección civil -->
                                                                    <div class="table-responsive mt-3" id="tablaElementosProteccionCivilContainer" style="display: none;">
                                                                        <table class="table table-bordered table-sm text-center align-middle">
                                                                            <thead class="table-light">
                                                                                <tr>
                                                                                    <th>Elemento de protección civil</th>
                                                                                    <th>Existencia</th>
                                                                                    <th>Cantidad</th>
                                                                                    <th>En uso</th>
                                                                                    <th>Condición</th>
                                                                                    <th>Evidencia</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tablaElementosProteccionCivil"></tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <script>
                                                                const elementosProteccionCivil = [
                                                                    "Alarma",
                                                                    "Alerta sísmica",
                                                                    "Botiquín de primeros auxilios",
                                                                    "Extintor"
                                                                ];

                                                                function toggleTablaElementosPC(show) {
                                                                    const contenedor = document.getElementById("tablaElementosProteccionCivilContainer");
                                                                    const tbody = document.getElementById("tablaElementosProteccionCivil");

                                                                    contenedor.style.display = show ? "block" : "none";
                                                                    tbody.innerHTML = "";

                                                                    if (show) {
                                                                        elementosProteccionCivil.forEach((elemento, index) => {
                                                                            const fila = `
                            <tr>
                                <td class="text-start">${elemento}</td>
                                <td>
                                <label><input type="radio" name="pc_existe_${index}" value="si"> Sí</label>
                                <label class="ms-2"><input type="radio" name="pc_existe_${index}" value="no"> No</label>
                                </td>
                                <td>
                                <select class="form-select form-select-sm" name="pc_cantidad_${index}">
                                    <option value="">Selecciona</option>
                                    ${[...Array(10)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("")}
                                </select>
                                </td>
                                <td>
                                <label><input type="radio" name="pc_enuso_${index}" value="si"> Sí</label>
                                <label class="ms-2"><input type="radio" name="pc_enuso_${index}" value="no"> No</label>
                                </td>
                                <td>
                                <select class="form-select form-select-sm" name="pc_condicion_${index}">
                                    <option value="">Selecciona</option>
                                    <option value="bueno">Buena</option>
                                    <option value="regular">Regular</option>
                                    <option value="malo">Mala</option>
                                </select>
                                </td>
                                <td>
                                <button type="button" class="btn btn-primary btn-sm">Agregar evidencia</button>
                                </td>
                            </tr>
                            `;
                                                                            tbody.insertAdjacentHTML("beforeend", fila);
                                                                        });
                                                                    }
                                                                }
                                                            </script>



                                                            <hr>

                                                            <!-- Datos del responsable de protección civil interno -->
                                                            <div class="col-sm-12">

                                                                <div class="row mt-4">
                                                                    <label>4.2 Datos del responsable de Protección Civil Interno:</label>
                                                                    <div class="col-lg-4">
                                                                        <label for="progresspill-firstname-input">Nombre <span style="color: red">*</span></label>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            id="progresspill-firstname-input"
                                                                            placeholder="Ejemplo: Juan"
                                                                            required />
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <label for="progresspill-lastname-input">Apellido paterno <span style="color: red">*</span></label>
                                                                        <input type="text" class="form-control" id="progresspill-lastname-input" placeholder="Ejemplo: Flores" required />
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <label for="progresspill-mother-lastname-input">Apellido materno <span style="color: red">*</span></label>
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            id="progresspill-mother-lastname-input"
                                                                            placeholder="Ejemplo: Fuentes"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-lg-4">
                                                                        <label for="progresspill-phoneno-input">Teléfono fijo: <span style="color: red">*</span></label>
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            id="progresspill-phoneno-input"
                                                                            placeholder="Ejemplo: 55 4587 4458" />
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <label for="progresspill-email-input">Teléfono móvil:<span style="color: red">*</span></label>
                                                                        <input type="text" class="form-control" id="progresspill-email-input" placeholder="Ejemplo: 311 1003" />
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row mt-3">
                                                                <div class="col-lg-12">
                                                                    <label>4.2.1 ¿El responsable de Protección Civil Interno tiene algún tipo de capacitación?</label><br>
                                                                    <input type="radio" name="capacitacion_responsable" value="si" onclick="toggleCapacitacion(true)"> Sí
                                                                    <input type="radio" name="capacitacion_responsable" value="no" onclick="toggleCapacitacion(false)"> No
                                                                </div>
                                                            </div>

                                                            <!-- Select oculto inicialmente -->
                                                            <div class="row mt-2" id="capacitacion-select-container" style="display: none;">
                                                                <div class="col-lg-6">
                                                                    <label for="capacitacion_tipo">Tipo de capacitación:</label>
                                                                    <select id="capacitacion_tipo" class="form-control">
                                                                        <option value="" selected disabled>Selecciona una opción</option>
                                                                        <option value="curso">Curso</option>
                                                                        <option value="taller">Taller</option>
                                                                        <option value="certificacion">Certificación</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <script>
                                                                function toggleCapacitacion(show) {
                                                                    const container = document.getElementById('capacitacion-select-container');
                                                                    const select = document.getElementById('capacitacion_tipo');

                                                                    if (show) {
                                                                        container.style.display = 'block';
                                                                    } else {
                                                                        container.style.display = 'none';
                                                                        select.value = ""; // Limpia selección previa si había
                                                                    }
                                                                }
                                                            </script>


                                                            <div class="row mt-4">
                                                                <hr>
                                                                <div class="row mt-3">


                                                                    <!-- 4.3 Tipo de brigadas organizadas -->
                                                                    <div class="row mt-3">
                                                                        <div class="col-lg-12">
                                                                            <label><strong>4.3 Tipo de brigadas organizadas</strong>
                                                                                <span style="color: #8f9092;">(selecciona la o las opciones)</span>
                                                                            </label>

                                                                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 10px;" class="mt-2">
                                                                                <div>
                                                                                    <input type="checkbox" id="brigada-multifuncional" name="brigadas[]" value="Brigada multifuncional">
                                                                                    <label for="brigada-multifuncional">Brigada multifuncional</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox" id="brigada-rescate" name="brigadas[]" value="Búsqueda y rescate">
                                                                                    <label for="brigada-rescate">Búsqueda y rescate</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox" id="brigada-evacuacion" name="brigadas[]" value="Evacuación">
                                                                                    <label for="brigada-evacuacion">Evacuación</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox" id="brigada-incendios" name="brigadas[]" value="Incendios">
                                                                                    <label for="brigada-incendios">Incendios</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox" id="brigada-primeros-auxilios" name="brigadas[]" value="Primeros auxilios">
                                                                                    <label for="brigada-primeros-auxilios">Primeros auxilios</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>






                                                                <hr>




                                                                <!-- 4.4 tipo de señalamientos -->
                                                                <div class="row mt-3">
                                                                    <div class="col-lg-12">
                                                                        <label><strong>4.4 Tipo de señalamientos</strong></label><br>
                                                                    </div>

                                                                    <div class="col-lg-12 mt-3" id="tablaSenalamientosContainer">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm text-center align-middle">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Tipos de señalamiento</th>
                                                                                        <th>Existencia</th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>En uso</th>
                                                                                        <th>Condición</th>
                                                                                        <th>Evidencia</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tablaSenalamientos"></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    const senalamientos = [
                                                                        "Extintor",
                                                                        "Punto de reunión",
                                                                        "Ruta de evacuación",
                                                                        "Salida de emergencia",
                                                                        "Zona de seguridad"
                                                                    ];

                                                                    function toggleTablaSenalamientos(show) {
                                                                        const contenedor = document.getElementById("tablaSenalamientosContainer");
                                                                        const tbody = document.getElementById("tablaSenalamientos");

                                                                        tbody.innerHTML = ""; // Limpiar contenido previo

                                                                        senalamientos.forEach((tipo, index) => {
                                                                            const fila = `
                                                <tr>
                                                <td class="text-start">${tipo}</td>
                                                <td>
                                                    <label><input type="radio" name="senalamiento_existe_${index}" value="si"> Sí</label>
                                                    <label class="ms-2"><input type="radio" name="senalamiento_existe_${index}" value="no"> No</label>
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm" name="senalamiento_cantidad_${index}">
                                                    <option value="">Selecciona</option>
                                                    ${[...Array(10)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("")}
                                                    </select>
                                                </td>
                                                <td>
                                                    <label><input type="radio" name="senalamiento_enuso_${index}" value="si"> Sí</label>
                                                    <label class="ms-2"><input type="radio" name="senalamiento_enuso_${index}" value="no"> No</label>
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm" name="senalamiento_condicion_${index}">
                                                    <option value="">Selecciona</option>
                                                    <option value="bueno">Buena</option>
                                                    <option value="regular">Regular</option>
                                                    <option value="malo">Mala</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm">Agregar evidencia</button>
                                                </td>
                                                </tr>
                                            `;
                                                                            tbody.insertAdjacentHTML("beforeend", fila);
                                                                        });
                                                                    }

                                                                    // Cargar tabla directamente
                                                                    toggleTablaSenalamientos(true);
                                                                </script>


                                                                <!-- 4.4.1 ¿Simulacros? -->
                                                                <div class="row mt-3 mb-3">
                                                                    <div class="col-lg-6">
                                                                        <label><strong>4.4.1 ¿Se realizan simulacros en el plantel?</strong></label><br>
                                                                        <input type="radio" name="simulacros" value="si" onchange="toggleSimulacros(true)"> Sí
                                                                        <input type="radio" name="simulacros" value="no" onchange="toggleSimulacros(false)"> No
                                                                    </div>
                                                                </div>

                                                                <!-- Opciones de periodicidad en formato de grid -->
                                                                <div class="row mt-3 mb-3" id="gridSimulacrosContainer" style="display: none;">
                                                                    <div class="col-lg-12">
                                                                        <label><strong>4.4.1.1 Periodicidad de simulacros</strong>
                                                                            <span style="color: #8f9092;">(selecciona la opción)</span>
                                                                        </label>
                                                                        <div id="simulacros-grid" class="mt-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 10px;"></div>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    const opcionesSimulacros = ["Bimestral", "Trimestral", "Semestral", "Anual"];

                                                                    function cargarGridSimulacros() {
                                                                        const grid = document.getElementById("simulacros-grid");
                                                                        grid.innerHTML = "";

                                                                        opcionesSimulacros.forEach((opcion, index) => {
                                                                            const id = `simulacro_${index}`;
                                                                            const item = `
                                                <div>
                                                <input type="checkbox" class="form-check-input check-periodicidad" id="${id}" name="simulacro_periodo" value="${opcion}">
                                                <label for="${id}">${opcion}</label>
                                                </div>
                                            `;
                                                                            grid.insertAdjacentHTML("beforeend", item);
                                                                        });
                                                                    }

                                                                    function toggleSimulacros(show) {
                                                                        const contenedor = document.getElementById("gridSimulacrosContainer");
                                                                        contenedor.style.display = show ? "block" : "none";
                                                                        if (show) cargarGridSimulacros();
                                                                    }

                                                                    // Solo permitir un checkbox activo (simular comportamiento tipo radio)
                                                                    document.addEventListener("change", function(e) {
                                                                        if (e.target.classList.contains("check-periodicidad")) {
                                                                            const checkboxes = document.querySelectorAll(".check-periodicidad");
                                                                            checkboxes.forEach(cb => {
                                                                                if (cb !== e.target) cb.checked = false;
                                                                            });
                                                                        }
                                                                    });
                                                                </script>




                                                                <hr>
                                                                <div class="row mt-3 mb-3 align-items-center">
                                                                    <div class="col-lg-4">
                                                                        <label><strong>4.5 ¿Se lleva un registro o bitácora de mantenimiento?</strong></label><br>
                                                                        <label class="me-2">
                                                                            <input type="radio" name="bitacora" value="si" onchange="toggleFechaRegistro(true)"> Sí
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="bitacora" value="no" onchange="toggleFechaRegistro(false)"> No
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-lg-4" id="fecha-registro-container" style="display: none;">
                                                                        <label>Fecha de registro</label>
                                                                        <input type="date" class="form-control" name="fecha_bitacora">
                                                                    </div>

                                                                    <div class="col-lg-4" id="evidencia-bitacora-container" style="display: none;">
                                                                        <label class="d-block invisible">Evidencia</label>
                                                                        <button type="button" class="btn btn-primary btn-sm w-100">Agregar evidencia</button>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    function toggleFechaRegistro(show) {
                                                                        const fechaContainer = document.getElementById('fecha-registro-container');
                                                                        const evidenciaContainer = document.getElementById('evidencia-bitacora-container');

                                                                        fechaContainer.style.display = show ? 'block' : 'none';
                                                                        evidenciaContainer.style.display = show ? 'block' : 'none';
                                                                    }
                                                                </script>



                                                                <hr>
                                                                <!-- 4.6 ¿Cuenta con algún programa especial de seguridad? -->
                                                                <div class="row mt-3 mb-3">
                                                                    <div class="col-lg-12">
                                                                        <label><strong>4.6 ¿Cuenta con algún programa especial de seguridad?</strong> <span style="color: red;">*</span></label><br>
                                                                        <input type="radio" name="tiene_programas_seguridad" value="si" onchange="toggleProgramasSeguridad(true)"> Sí
                                                                        <input type="radio" name="tiene_programas_seguridad" value="no" onchange="toggleProgramasSeguridad(false)"> No
                                                                    </div>

                                                                    <!-- Contenedor de los programas especiales de seguridad -->
                                                                    <div class="col-lg-12 mt-3" id="bloqueProgramasSeguridad" style="display: none;">
                                                                        <span style="color: #8f9092;">Selecciona la o las opciones:</span>
                                                                        <div class="table-responsive mt-2">
                                                                            <table class="table table-bordered table-sm text-center align-middle">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Programa especial de seguridad</th>
                                                                                        <th>¿Aplica?</th>
                                                                                        <th> </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tbodyProgramasSeguridad"></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    const programasSeguridad = [
                                                                        "Atención a personas con discapacidad",
                                                                        "Control de entrada con gafetes",
                                                                        "Restricción de acceso a áreas peligrosas",
                                                                        "Protocolo ante amenaza de bomba",
                                                                        "Reglas para personal de vigilancia",
                                                                        "Seguridad en cocinas y comedores",
                                                                        "Uso de estacionamiento escolar",
                                                                        "Uso adecuado de aparatos eléctricos"
                                                                    ];

                                                                    function toggleProgramasSeguridad(show) {
                                                                        const contenedor = document.getElementById("bloqueProgramasSeguridad");
                                                                        const tbody = document.getElementById("tbodyProgramasSeguridad");

                                                                        contenedor.style.display = show ? "block" : "none";
                                                                        tbody.innerHTML = "";

                                                                        if (show) {
                                                                            programasSeguridad.forEach((prog, index) => {
                                                                                const fila = `
        <tr>
          <td class="text-start">${prog}</td>
          <td>
            <label><input type="radio" name="programa_${index}" value="si"> Sí</label>
            <label class="ms-2"><input type="radio" name="programa_${index}" value="no"> No</label>
          </td>
          <td>
            <button type="button" class="btn btn-primary btn-sm">Agregar evidencia</button>
          </td>
        </tr>
      `;
                                                                                tbody.insertAdjacentHTML("beforeend", fila);
                                                                            });
                                                                        }
                                                                    }
                                                                </script>
                                                                <hr>


                                                                <div class="row mt-3">
                                                                    <div class="col-lg-12">
                                                                        <label><strong>4.7 ¿El inmueble guarda materiales que pueden ser peligrosos?</strong></label><br>
                                                                        <input type="radio" name="materiales" value="si" onchange="toggleMateriales(true)"> Sí
                                                                        <input type="radio" name="materiales" value="no" onchange="toggleMateriales(false)"> No
                                                                    </div>
                                                                </div>

                                                                <!-- Tabla de materiales peligrosos -->
                                                                <div class="row mt-3" id="tablaMaterialesContainer" style="display: none;">
                                                                    <div class="col-lg-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm text-center align-middle">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Material peligroso</th>
                                                                                        <th>¿Cuenta con este material?</th>
                                                                                        <th>¿Están almacenados correctamente?</th>
                                                                                        <th>¿Tienen señalamientos adecuados?</th>
                                                                                        <th>¿Se cuenta con hojas de seguridad?</th>
                                                                                        <th>¿Han recibido capacitación sobre cómo manejarlos?</th>
                                                                                        <th> </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tbodyMateriales"></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    const materialesPeligrosos = [
                                                                        "Ácido muriático",
                                                                        "Hipoclorito de sodio (cloro)",
                                                                        "Alcohol etílico",
                                                                        "Formol",
                                                                        "Sosa cáustica",
                                                                        "Detergente industrial",
                                                                        "Reactivos de laboratorio",
                                                                        "Solventes y thinner",
                                                                        "Gas LP",
                                                                        "Amoniaco"
                                                                    ];

                                                                    function toggleMateriales(show) {
                                                                        const contenedor = document.getElementById("tablaMaterialesContainer");
                                                                        const tbody = document.getElementById("tbodyMateriales");

                                                                        contenedor.style.display = show ? "block" : "none";
                                                                        tbody.innerHTML = "";

                                                                        if (show) {
                                                                            materialesPeligrosos.forEach((mat, index) => {
                                                                                const fila = `
                <tr>
                    <td class="text-start">${mat}</td>
                    <td>
                        <label><input type="radio" name="cuenta_${index}" value="si" onchange="toggleRowColumns(${index}, true)"> Sí</label>
                        <label class="ms-2"><input type="radio" name="cuenta_${index}" value="no" onchange="toggleRowColumns(${index}, false)"> No</label>
                    </td>
                    <td>
                        <label><input type="radio" name="almacenados_${index}" value="si" disabled> Sí</label>
                        <label class="ms-2"><input type="radio" name="almacenados_${index}" value="no" disabled> No</label>
                    </td>
                    <td>
                        <label><input type="radio" name="senalamientos_${index}" value="si" disabled> Sí</label>
                        <label class="ms-2"><input type="radio" name="senalamientos_${index}" value="no" disabled> No</label>
                    </td>
                    <td>
                        <label><input type="radio" name="hojas_${index}" value="si" disabled> Sí</label>
                        <label class="ms-2"><input type="radio" name="hojas_${index}" value="no" disabled> No</label>
                    </td>
                    <td>
                        <label><input type="radio" name="capacitacion_${index}" value="si" disabled> Sí</label>
                        <label class="ms-2"><input type="radio" name="capacitacion_${index}" value="no" disabled> No</label>
                    </td>
                    <td><button type="button" class="btn btn-primary btn-sm">Agregar evidencia</button></td>
                </tr>
            `;
                                                                                tbody.insertAdjacentHTML("beforeend", fila);
                                                                            });
                                                                        }
                                                                    }

                                                                    function toggleRowColumns(index, enabled) {
                                                                        const radios = document.querySelectorAll(
                                                                            `input[name="almacenados_${index}"], 
         input[name="senalamientos_${index}"], 
         input[name="hojas_${index}"], 
         input[name="capacitacion_${index}"]`
                                                                        );

                                                                        radios.forEach(radio => {
                                                                            radio.disabled = !enabled;
                                                                            if (!enabled) radio.checked = false;
                                                                        });
                                                                    }
                                                                </script>


                                                            </div>


                                                        </div>

                                                        <hr>


                                                        <!-- MODULO DE Sseguridad estructural -->


                                                        <script>
                                                            const areaComunes = document.getElementById('areaComunes');
                                                            const popupTable = document.getElementById('popupTable');

                                                            areaComunes.addEventListener('mouseover', (event) => {
                                                                const rect = areaComunes.getBoundingClientRect();
                                                                popupTable.style.display = 'block';
                                                                var textHeight2 = event.currentTarget.offsetHeight; // Altura del texto

                                                                // Ajustamos la posición superior para que esté más arriba y la posición izquierda para que esté más a la derecha
                                                                popupTable.style.top = (event.pageY - textHeight2 - popupTable.offsetHeight - 10) + 'px'; // Restamos 10px para subir el popup
                                                                popupTable.style.left = (event.pageX + 100) + 'px'; // Sumamos 10px para mover el popup hacia la derecha
                                                            });

                                                            areaComunes.addEventListener('mouseout', () => {
                                                                popupTable.style.display = 'none';
                                                            });
                                                        </script>





                                                        <!-- Pregunta 4.8 -->
                                                        <div class="form-group mt-4">
                                                            <label><strong>4.8 ¿El Centro de Trabajo cuenta con dictamen de seguridad estructural?</strong></label><br>
                                                            <label>
                                                                <input type="radio" name="dictamen_estructural" value="si" onchange="toggleDictamen(true)"> Sí
                                                            </label>
                                                            <label class="ms-3">
                                                                <input type="radio" name="dictamen_estructural" value="no" onchange="toggleDictamen(false)"> No
                                                            </label>
                                                        </div>

                                                        <!-- Campos adicionales dependientes -->
                                                        <div class="form-group row mt-3" id="bloqueDictamen" style="display: none;">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="fecha_emision"><strong>Fecha de emisión</strong></label>
                                                                <select id="fecha_emision" class="form-control form-select">
                                                                    <option value="" disabled selected>Selecciona el año</option>
                                                                    <option value="2019">2019</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2021">2021</option>
                                                                    <option value="2022">2022</option>
                                                                    <option value="2023">2023</option>
                                                                    <option value="2024">2024</option>
                                                                    <option value="2025">2025</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-8 mb-3">
                                                                <label for="quien_emitio"><strong>¿Quién lo emitió?</strong></label>
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    <select id="quien_emitio" class="form-control form-select me-2" style="flex: 1 1 60%;">
                                                                        <option value="" disabled selected>Selecciona una opción</option>
                                                                        <option value="DRO">Director Responsable de Obra (DRO) acreditado</option>
                                                                        <option value="Instituto_Local">Instituto Local a través de un DRO acreditado</option>
                                                                        <option value="Proteccion_Civil_Municipal">Protección Civil Municipal</option>
                                                                        <option value="Proteccion_Civil_Estatal">Protección Civil Estatal</option>
                                                                    </select>
                                                                    <button type="button" class="btn btn-primary" style="flex: 1 1 38%;">Agregar evidencia</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Script -->
                                                        <script>
                                                            function toggleDictamen(show) {
                                                                const bloque = document.getElementById("bloqueDictamen");
                                                                bloque.style.display = show ? "flex" : "none";
                                                                bloque.style.flexWrap = "wrap";
                                                            }
                                                        </script>




                                                        <style>
                                                            body {
                                                                margin: 20px;
                                                            }

                                                            .compact-table {
                                                                max-width: 400px;
                                                                /* Ajusta el ancho máximo de la tabla */
                                                            }

                                                            .table td {
                                                                white-space: nowrap;
                                                                /* Evita que el contenido de las celdas se ajuste a varias líneas */
                                                            }

                                                            .add-evidence-btn {
                                                                cursor: pointer;
                                                                /* Cambia el cursor a puntero para el botón */
                                                            }
                                                        </style>
                                                        <br>



                                                        <!-- Pregunta 4.8.1 -->
                                                        <div class="row mt-4">
                                                            <div class="col-lg-12">
                                                                <label for="naturales"><strong>4.8.1 ¿El Centro de Trabajo cuenta con amenaza o riesgo por condición natural?</strong><span style="color: red;">*</span></label><br>
                                                                <label><input type="radio" name="naturales" value="si" onchange="toggleTablaAmenazas(true)"> Sí</label>
                                                                <label class="ms-3"><input type="radio" name="naturales" value="no" onchange="toggleTablaAmenazas(false)"> No</label>
                                                            </div>
                                                        </div>

                                                        <!-- Tabla de amenazas naturales -->
                                                        <div class="row mt-3" id="tablaAmenazasContainer" style="display: none;">
                                                            <div class="col-lg-10">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-sm align-middle text-center">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Amenazas o riesgos</th>
                                                                                <th>Existencia</th>
                                                                                <th>Zona de ubicación</th>
                                                                                <th>Evidencia</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbodyAmenazasNaturales"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            const amenazas = [
                                                                "Arroyo",
                                                                "Barranca",
                                                                "Falla geológica",
                                                                "Hundimiento regional",
                                                                "Inundación",
                                                                "Ladera",
                                                                "Río",
                                                                "Talud"
                                                            ];

                                                            function toggleTablaAmenazas(show) {
                                                                const contenedor = document.getElementById("tablaAmenazasContainer");
                                                                const tbody = document.getElementById("tbodyAmenazasNaturales");

                                                                contenedor.style.display = show ? "block" : "none";
                                                                tbody.innerHTML = "";

                                                                if (show) {
                                                                    amenazas.forEach((nombre, index) => {
                                                                        const id = nombre.toLowerCase().replace(/[\s()]/g, "_");

                                                                        const fila = `
          <tr>
            <td class="text-start">${nombre}</td>
            <td>
              <label><input type="radio" name="existencia_${id}" value="si"> Sí</label>
              <label class="ms-2"><input type="radio" name="existencia_${id}" value="no"> No</label>
            </td>
            <td>
              <select class="form-select form-select-sm" name="ubicacion_${id}">
                <option value="">Selecciona</option>
                <option value="edificio_1">Edificio 1</option>
                <option value="area_comun_a">Área común "A"</option>
              </select>
            </td>
            <td>
              <button type="button" class="btn btn-primary btn-sm">Agregar evidencia</button>
            </td>
          </tr>
        `;
                                                                        tbody.insertAdjacentHTML("beforeend", fila);
                                                                    });
                                                                }
                                                            }
                                                        </script>





                                                        <!-- Pregunta 4.8.2 -->
                                                        <div class="row mt-3">
                                                            <div class="col-lg-12">
                                                                <label><strong>4.8.2 ¿El Centro de Trabajo cuenta con amenaza o riesgo por causa externa?</strong><span style="color: red;">*</span></label><br>
                                                                <label><input type="radio" name="externos" value="si" onchange="toggleTablaExternos(true)"> Sí</label>
                                                                <label class="ms-3"><input type="radio" name="externos" value="no" onchange="toggleTablaExternos(false)"> No</label>
                                                            </div>
                                                        </div>

                                                        <!-- Tabla de amenazas externas -->
                                                        <div class="row mt-3" id="tablaExternosContainer" style="display: none;">
                                                            <div class="col-lg-10">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-sm align-middle text-center">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Amenazas o riesgos</th>
                                                                                <th>Existencia</th>
                                                                                <th>Zona de ubicación</th>
                                                                                <th>Evidencia</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbodyAmenazasExternas"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            const amenazasExternas = [
                                                                "Amenaza vial",
                                                                "Causa social",
                                                                "Ducto de combustible o de gas",
                                                                "Gasera",
                                                                "Gasolinera"
                                                            ];

                                                            function toggleTablaExternos(show) {
                                                                const contenedor = document.getElementById("tablaExternosContainer");
                                                                const tbody = document.getElementById("tbodyAmenazasExternas");

                                                                contenedor.style.display = show ? "block" : "none";
                                                                tbody.innerHTML = "";

                                                                if (show) {
                                                                    amenazasExternas.forEach((nombre, index) => {
                                                                        const id = nombre.toLowerCase().replace(/[\s()]/g, "_");

                                                                        const fila = `
          <tr>
            <td class="text-start">${nombre}</td>
            <td>
              <label><input type="radio" name="existencia_externo_${id}" value="si"> Sí</label>
              <label class="ms-2"><input type="radio" name="existencia_externo_${id}" value="no"> No</label>
            </td>
            <td>
              <select class="form-select form-select-sm" name="ubicacion_externo_${id}">
                <option value="">Selecciona</option>
                <option value="edificio_1">Edificio "1"</option>
                <option value="area_comun_a">Área común "A"</option>
              </select>
            </td>
            <td>
              <button type="button" class="btn btn-primary btn-sm">Agregar evidencia</button>
            </td>
          </tr>
        `;
                                                                        tbody.insertAdjacentHTML("beforeend", fila);
                                                                    });
                                                                }
                                                            }
                                                        </script>







                                                    </form>







                                                    <ul class="pager wizard twitter-bs-wizard-pager-link mt-4" style="list-style-type: none; padding: 0; display: flex;">
                                                        <li class="next" style="display: inline-block; background-color: #007bff; color: white; border-radius: 5px; overflow: hidden;">
                                                            <a href="javascript: void(0);" class="btn" style="color: white; border: none; border-radius: 5px; padding: 10px 15px; text-decoration: none; display: block;">
                                                                Guardar Módulo 4 <i class="fas fa-save"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="progress-order-summary">
                                                <div>
                                                    <form>
                                                        <div class="card-header">
                                                            <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">V. INVERSIÓN PÚBLICA</h4>

                                                        </div>

                                                        <div class="row mt-9">
                                                            <br>

                                                            <div class="col-lg-8">
                                                                <br>
                                                                <label>
                                                                    5. ¿El Centro de Trabajo fue beneficiado con recursos públicos para obra nueva de <strong>rehabilitación o mantenimiento</strong>?<span style="color: red;">*</span>
                                                                </label> <br>
                                                                <div>
                                                                    <input type="radio" id="recursos-si" value="si" onclick="manejarRecursosCheck()">
                                                                    <label for="recursos-si">Sí</label>
                                                                    <input type="radio" id="recursos-no" value="no" onclick="manejarRecursosCheck()">
                                                                    <label for="recursos-no">No</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="anoOptions" style="display:none;" class="mt-3">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-sm text-center align-middle" style="width: 600px;">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Año</th>
                                                                            <th>¿Hubo recurso?</th>
                                                                            <th>Monto (MXN)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaRecursosBody"></tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            function manejarRecursosCheck() {
                                                                const siCheckbox = document.getElementById("recursos-si");
                                                                const noCheckbox = document.getElementById("recursos-no");
                                                                const anoOptions = document.getElementById("anoOptions");

                                                                if (siCheckbox.checked) {
                                                                    anoOptions.style.display = "block";
                                                                    noCheckbox.checked = false;
                                                                    generarTablaRecursos();
                                                                } else if (noCheckbox.checked) {
                                                                    anoOptions.style.display = "none";
                                                                    siCheckbox.checked = false;
                                                                } else {
                                                                    anoOptions.style.display = "none";
                                                                }
                                                            }

                                                            function generarTablaRecursos() {
                                                                const tbody = document.getElementById("tablaRecursosBody");
                                                                tbody.innerHTML = "";

                                                                const montos = [
                                                                    "$0 – $499,999",
                                                                    "$500,000 – $999,999",
                                                                    "$1,000,000 – $4,999,999",
                                                                    "$5,000,000 – $9,999,999",
                                                                    "$10,000,000 – $19,999,999",
                                                                    "$20,000,000 – $39,999,999",
                                                                    "$40,000,000 o más"
                                                                ];

                                                                for (let year = 2017; year <= 2025; year++) {
                                                                    let fila = `
            <tr>
                <td>${year}</td>
                <td>
                    <input type="checkbox" id="year-${year}" onclick="manejarYearSelection(${year})">
                </td>
                <td>
                    <select id="monto-${year}" class="form-select form-select-sm" disabled>
                        <option value="">Selecciona un rango</option>
                        ${montos.map(m => `<option value="${m}">${m}</option>`).join("")}
                    </select>
                </td>
            </tr>
        `;
                                                                    tbody.insertAdjacentHTML("beforeend", fila);
                                                                }
                                                            }

                                                            function manejarYearSelection(year) {
                                                                const montoSelect = document.getElementById(`monto-${year}`);
                                                                if (document.getElementById(`year-${year}`).checked) {
                                                                    montoSelect.disabled = false;
                                                                } else {
                                                                    montoSelect.value = "";
                                                                    montoSelect.disabled = true;
                                                                }
                                                            }
                                                        </script>








                                                    </form>

                                                    <ul class="pager wizard twitter-bs-wizard-pager-link mt-4" style="list-style-type: none; padding: 0; display: flex; align-items: center;">
                                                        <li class="next" style="display: inline-block; background-color: #007bff; color: white; border-radius: 5px; overflow: hidden;">
                                                            <a href="javascript: void(0);" class="btn" style="color: white; border: none; border-radius: 5px; padding: 10px 15px; text-decoration: none; display: block;">
                                                                Guardar Módulo 5 <i class="fas fa-save"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>




                                            <!-- Módulo 6 - Datos legales -->
                                            <div class="tab-pane" id="progress-confirmation">
                                                <form>
                                                    <div class="card-header">
                                                        <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">
                                                            VI. DATOS LEGALES DEL CENTRO DE TRABAJO
                                                        </h4>
                                                    </div>

                                                    <!-- Pregunta 6 -->
                                                    <div class="row mt-4">
                                                        <div class="col-lg-12">
                                                            <label>
                                                                6. ¿Cuenta con algún documento que acredite la propiedad o posesión del inmueble?
                                                                <span style="color: red;">*</span>
                                                            </label>
                                                            <div>
                                                                <input type="radio" id="documento-propiedad-si" name="documento-propiedad" value="si" onclick="manejarDocumentoPropiedadCheck()">
                                                                <label for="documento-propiedad-si">Sí</label>

                                                                <input type="radio" id="documento-propiedad-no" name="documento-propiedad" value="no" onclick="manejarDocumentoPropiedadCheck()">
                                                                <label for="documento-propiedad-no">No</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Si responde "Sí", mostrar opciones -->
                                                    <div id="documento-propiedad-opciones" class="row align-items-center mt-3" style="display: none;">
                                                        <div class="col-md-6 mb-2">
                                                            <label for="tipo-documento" class="form-label">Selecciona el tipo de documento:</label>
                                                            <select class="form-select" id="tipo-documento">
                                                                <option value="" disabled selected>Selecciona una opción</option>
                                                                <option value="acta_cabildo">Acta de cabildo</option>
                                                                <option value="acta_donacion">Acta de donación</option>
                                                                <option value="acta_ejidal">Acta ejidal</option>
                                                                <option value="certificado_parcelario">Certificado parcelario</option>
                                                                <option value="comodato">Comodato</option>
                                                                <option value="contrato_donacion">Contrato de donación</option>
                                                                <option value="copia_simple_escritura">Copia simple de la escritura</option>
                                                                <option value="documento_analogico">Documento análogo</option>
                                                                <option value="escritura_publica">Escritura pública</option>
                                                                <option value="oficio">Oficio autoridad educativa</option>
                                                                <option value="oficios_signados">Oficios signados por representantes del ayuntamiento</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4 mb-2 text-md-begin">
                                                            <label class="form-label d-block invisible">Botón</label>
                                                            <button type="button" class="btn btn-primary">Agregar evidencia</button>
                                                        </div>
                                                    </div>

                                                    <!-- Pregunta 6.1 -->
                                                    <div class="row mt-4">
                                                        <div class="col-lg-12">
                                                            <label class="form-label d-block"><strong>6.1 Tipo de plano del inmueble</strong></label>
                                                        </div>
                                                    </div>

                                                    <div id="tabla-planos-container" class="row mt-2">
                                                        <div class="col-lg-6">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-sm text-center align-middle">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Tipos de planos</th>
                                                                            <th>¿Existe?</th>
                                                                            <th style="background-color: #fff;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tabla-planos-body"></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- Botones inferiores -->
                                                <div style="display: flex; align-items: left;" class="mt-4">
                                                    <ul style="margin: 0; padding: 0;">
                                                        <li class="next" style="display: inline-block; background-color: #007bff; color: white; border-radius: 5px; overflow: hidden; margin-right: 10px;">
                                                            <a id="guardarModuloBtn" class="btn" style="color: white; border: none; border-radius: 5px; padding: 10px 15px; text-decoration: none; display: block;">
                                                                Guardar Módulo 6 <i class="fas fa-save"></i>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <button type="button" id="acuseBtn" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display:none;">
                                                        Acuse
                                                    </button>
                                                </div>

                                                <!-- Scripts -->
                                                <script>
                                                    function manejarDocumentoPropiedadCheck() {
                                                        const siChecked = document.getElementById("documento-propiedad-si").checked;
                                                        const opciones = document.getElementById("documento-propiedad-opciones");
                                                        opciones.style.display = siChecked ? "flex" : "none";
                                                    }

                                                    const guardarModuloBtn = document.getElementById("guardarModuloBtn");
                                                    const acuseBtn = document.getElementById("acuseBtn");

                                                    guardarModuloBtn.addEventListener("click", function() {
                                                        acuseBtn.style.display = "block";
                                                    });

                                                    const tiposPlanos = [
                                                        "Plano arquitectónico",
                                                        "Plano estructural",
                                                        "Plano de instalación",
                                                        "Plano de protección civil",
                                                        "Plano topográfico",
                                                        "Plano de accesibilidad",
                                                        "Plano de señalización",
                                                        "Plano de áreas verdes",
                                                        "Plano de mobiliario y equipamiento",
                                                        "Plano de zonificación de uso de espacios"
                                                    ];

                                                    function cargarTablaPlanos() {
                                                        const tbody = document.getElementById("tabla-planos-body");
                                                        tbody.innerHTML = "";

                                                        tiposPlanos.forEach((tipo, index) => {
                                                            const fila = `
                                                    <tr>
                                                        <td class="text-start">${tipo}</td>
                                                        <td>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" class="form-check-input" name="plano_existe_${index}" id="plano_${index}_si" value="si">
                                                            <label class="form-check-label" for="plano_${index}_si">Sí</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" class="form-check-input" name="plano_existe_${index}" id="plano_${index}_no" value="no">
                                                            <label class="form-check-label" for="plano_${index}_no">No</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <button class="btn btn-primary btn-sm" type="button">Agregar evidencia</button>
                                                        </td>
                                                    </tr>
                                                    `;
                                                            tbody.insertAdjacentHTML("beforeend", fila);
                                                        });
                                                    }

                                                    document.addEventListener("DOMContentLoaded", cargarTablaPlanos);
                                                </script>
                                            </div>



                                            <!-- Estilos -->
                                            <style>
                                                .modal-content {
                                                    background-color: #fff;
                                                    border-radius: 15px;
                                                    padding: 20px;
                                                    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
                                                }

                                                .modal-header {
                                                    color: white;
                                                    border-bottom: none;
                                                    text-align: center;
                                                }

                                                .modal-title {
                                                    font-size: 32px;
                                                    font-weight: bold;
                                                }

                                                .acuse {
                                                    border: 2px solid #007bff;
                                                    padding: 30px;
                                                    border-radius: 10px;
                                                    margin-top: 20px;
                                                    text-align: center;
                                                }

                                                .acuse p {
                                                    font-size: 24px;
                                                    margin: 10px 0;
                                                }

                                                .btn-download {
                                                    background-color: #28a745;
                                                    color: white;
                                                    font-size: 18px;
                                                }

                                                .btn-close {
                                                    background-color: #dc3545;
                                                    color: white;
                                                    font-size: 18px;
                                                }
                                            </style>

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document" style="max-width: 1220px;">
                                                    <div class="modal-content p-4">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title w-100 text-center" id="myModalLabel">Acuse de Registro</h5>
                                                        </div>
                                                        <div class="modal-body text-center acuse">
                                                            <canvas id="acuseCanvas" width="900" height="600"></canvas>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-primary" onclick="downloadImage()">Descargar Acuse</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Script QR & Descarga -->
                                            <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
                                            <script>
                                                function downloadImage() {
                                                    const canvas = document.getElementById("acuseCanvas");
                                                    const ctx = canvas.getContext("2d");

                                                    ctx.fillStyle = "#fff";
                                                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                                                    ctx.strokeStyle = "#999";
                                                    ctx.lineWidth = 1;

                                                    ctx.fillStyle = "#2c2c54";
                                                    ctx.font = "24px Arial";
                                                    ctx.textAlign = "center";
                                                    ctx.fillText("Sistema de Infraestructura Educativa (SIIE)", canvas.width / 2, 40);

                                                    ctx.fillStyle = "#000";
                                                    ctx.font = "20px Arial";
                                                    ctx.fillText("Acuse de Registro de Centro de Trabajo", canvas.width / 2, 70);

                                                    ctx.beginPath();
                                                    ctx.moveTo(40, 90);
                                                    ctx.lineTo(canvas.width - 40, 90);
                                                    ctx.stroke();

                                                    ctx.textAlign = "left";
                                                    ctx.font = "16px Arial";
                                                    const leftStart = 60;
                                                    const rightStart = canvas.width / 2 + 20;
                                                    let y = 130;

                                                    ctx.fillText("CCT: 15EJN4255J", leftStart, y);
                                                    ctx.fillText("Nombre del Plantel: Sec. Gral. Ignacio Zaragoza", leftStart, y + 30);
                                                    ctx.fillText("Municipio: Toluca", leftStart, y + 60);
                                                    ctx.fillText("Colonia: San Lorenzo", leftStart, y + 90);
                                                    ctx.fillText("Número de Salones: 12", leftStart, y + 120);

                                                    ctx.fillText("Nivel Escolar: Secundaria", rightStart, y);
                                                    ctx.fillText("Número de Alumnos: 345", rightStart, y + 30);
                                                    ctx.fillText("Turno: Matutino", rightStart, y + 60);
                                                    ctx.fillText("CCT asociado: No", rightStart, y + 90);
                                                    ctx.fillText("Fecha de Registro: 23/04/2025", rightStart, y + 120);

                                                    ctx.beginPath();
                                                    ctx.moveTo(40, y + 150);
                                                    ctx.lineTo(canvas.width - 40, y + 150);
                                                    ctx.stroke();

                                                    ctx.textAlign = "center";
                                                    ctx.fillStyle = "#2c3e50";
                                                    ctx.font = "20px Arial";
                                                    ctx.fillText("El Código de Identificación del Inmueble (CII) de tu Centro de Trabajo es:", canvas.width / 2, y + 190);

                                                    ctx.font = "50px bold Arial";
                                                    ctx.fillText("15 034 U 014", canvas.width / 2, y + 240);

                                                    ctx.beginPath();
                                                    ctx.moveTo(40, y + 260);
                                                    ctx.lineTo(canvas.width - 40, y + 260);
                                                    ctx.stroke();

                                                    const qr = new QRious({
                                                        value: "https://www.gob.mx/inifed",
                                                        size: 120
                                                    });
                                                    const img = new Image();
                                                    img.onload = function() {
                                                        ctx.drawImage(img, canvas.width - 160, canvas.height - 160, 100, 100);

                                                        canvas.toBlob(function(blob) {
                                                            const url = URL.createObjectURL(blob);
                                                            const a = document.createElement("a");
                                                            a.href = url;
                                                            a.download = "acuse_registro.png";
                                                            document.body.appendChild(a);
                                                            a.click();
                                                            document.body.removeChild(a);
                                                        });
                                                    };
                                                    img.src = qr.toDataURL();
                                                }
                                            </script>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    const nextBtnList = document.querySelectorAll('.pager.wizard .next a');
                    const prevBtnList = document.querySelectorAll('.pager.wizard .previous a');
                    const tabPaneList = document.querySelectorAll('.tab-pane');
                    const navLinkList = document.querySelectorAll('.twitter-bs-wizard-nav .nav-link');
                    const progressBar = document.querySelector('.progress-bar');

                    let currentTab = 0;

                    function updateProgressBar() {
                        const progress = ((currentTab) / (navLinkList.length - 1)) * 100;
                        progressBar.style.width = `${progress}%`;
                    }

                    function showTab(index) {
                        tabPaneList.forEach(pane => pane.classList.remove('show', 'active'));
                        navLinkList.forEach(link => link.classList.remove('active'));

                        tabPaneList[index].classList.add('show', 'active');
                        navLinkList[index].classList.add('active');
                        currentTab = index;
                        updateProgressBar();
                    }

                    nextBtnList.forEach(btn => {
                        btn.addEventListener('click', () => {
                            if (currentTab < navLinkList.length - 1) {
                                showTab(currentTab + 1);
                            }
                            // You can add validation logic before moving to the next tab
                        });
                    });

                    prevBtnList.forEach(btn => {
                        btn.addEventListener('click', () => {
                            if (currentTab > 0) {
                                showTab(currentTab - 1);
                            }
                        });
                    });

                    navLinkList.forEach((link, index) => {
                        link.addEventListener('click', (e) => {
                            e.preventDefault();
                            showTab(index);
                        });
                    });

                    // Initial tab
                    showTab(0);

                    // Example of updating summary tab (you'll need to expand this based on your form fields)
                    const nextToSummaryBtn = Array.from(nextBtnList).find((btn) => btn.closest('.tab-pane').id === 'progress-payment-details');
                    if (nextToSummaryBtn) {
                        nextToSummaryBtn.addEventListener('click', () => {
                            document.getElementById('summary-name').textContent = document.getElementById('progresspill-firstname-input').value + ' ' + document.getElementById('progresspill-lastname-input').value;
                            document.getElementById('summary-email').textContent = document.getElementById('progresspill-email-input').value;
                            document.getElementById('summary-address').textContent = document.getElementById('progresspill-address-input').value;
                            document.getElementById('summary-city').textContent = document.getElementById('progresspill-city-input').value;
                            document.getElementById('summary-zip').textContent = document.getElementById('progresspill-zip-input').value;
                            document.getElementById('summary-card-number').textContent = document.getElementById('progresspill-card-number-input').value.slice(-4).padStart(16, '*'); // Show last 4 digits
                        });
                    }
                </script>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <!-- Modal -->
        <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bx bx-check-circle display-4 text-success"></i>
                            </div>
                            <h5>Confirm Save Changes</h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary w-md" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
        <footer style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #f1f1f1;">
            <span>Copyright© 2025 INIFED - Gerencia del Sistema Nacional de Información</span>
            <a href="#" style="text-decoration: none; color: #000000;">Política de Privacidad</a>
        </footer>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center p-3">

                <h5 class="m-0 me-2">Theme Customizer</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="m-0" />

            <div class="p-4">
                <h6 class="mb-3">Layout</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout"
                        id="layout-vertical" value="vertical">
                    <label class="form-check-label" for="layout-vertical">Vertical</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout"
                        id="layout-horizontal" value="horizontal">
                    <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode"
                        id="layout-mode-light" value="light">
                    <label class="form-check-label" for="layout-mode-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode"
                        id="layout-mode-dark" value="dark">
                    <label class="form-check-label" for="layout-mode-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-width"
                        id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                    <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-width"
                        id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                    <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-position"
                        id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                    <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-position"
                        id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                    <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color"
                        id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                    <label class="form-check-label" for="topbar-color-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color"
                        id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size"
                        id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                    <label class="form-check-label" for="sidebar-size-default">Default</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size"
                        id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                    <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size"
                        id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                    <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color"
                        id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                    <label class="form-check-label" for="sidebar-color-light">Light</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color"
                        id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                    <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color"
                        id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                    <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-direction"
                        id="layout-direction-ltr" value="ltr">
                    <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-direction"
                        id="layout-direction-rtl" value="rtl">
                    <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                </div>

            </div>

        </div> <!-- end slimscroll-menu-->
    </div>

    <!-- /Right-bar -->
    <script>
        document.querySelectorAll('[data-dropdown]').forEach(dropdown => {
            const toggle = dropdown.querySelector('[data-toggle]');
            const menu = dropdown.querySelector('[data-menu]');
            const options = dropdown.querySelectorAll('.radio-option');

            toggle.addEventListener('click', () => {
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });

            options.forEach(option => {
                const radio = option.querySelector('input[type="radio"]');

                radio.addEventListener('change', () => {
                    options.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                    toggle.textContent = option.dataset.label;
                    menu.style.display = 'none';
                });

                option.addEventListener('click', () => {
                    radio.checked = true;
                    radio.dispatchEvent(new Event('change'));
                });
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('[data-dropdown]')) {
                    menu.style.display = 'none';
                }
            });
        });
    </script>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="assets/libs/pace-js/pace.min.js"></script>

    <!-- twitter-bootstrap-wizard js -->
    <script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

    <!-- form wizard init -->
    <script src="assets/js/pages/form-wizard.init.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>