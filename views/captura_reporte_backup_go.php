<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../config/db.php';

redirigirSiNoLogeado();
$title = 'Captura de Reporte';
include __DIR__ . '/../templates/header.php';
?>
<style>
    .twitter-bs-wizard-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        margin-top: 100px;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: transparent !important;
    }

    /* OVERRIDE Bootstrap .nav-pills styling for the wizard nav */
    .twitter-bs-wizard-nav .nav-link.active .step-icon {
        background-color: #691C32 !important;
    }

    .twitter-bs-wizard-nav .nav-link.paso-completado .step-icon {
        background-color: #691C32 !important;
    }

    .twitter-bs-wizard-nav .step-icon {
        background-color: #ccc;
        transition: background-color 0.3s;
    }

    .twitter-bs-wizard-nav .nav-link:not(.active):not(.paso-completado):hover .step-icon {
        background-color: #9F2241;
    }

    .twitter-bs-wizard-nav::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #ccc;
        z-index: 0;
        transition: background 0.3s, background-color 0.3s;
    }

    /* Progress bar for wizard steps */
    .twitter-bs-wizard-nav.paso-1::before {
        background: linear-gradient(to right, #691C32 0%, #ccc 0%);
    }


    .twitter-bs-wizard-nav.paso-2::before {
        background: linear-gradient(to right, #691C32 0%, #691C32 50%, #ccc 50%, #ccc 100%);
    }

    .twitter-bs-wizard-nav.paso-3::before {
        background: linear-gradient(to right, #691C32 0%, #691C32 100%);
    }

    .twitter-bs-wizard-nav .nav-item {
        position: relative;
        z-index: 1;
        flex-grow: 1;
        text-align: center;
    }

    .twitter-bs-wizard-nav .nav-link {
        background: none;
        border: none;
        padding: 0;
    }

    .step-icon {
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        background-color: #ccc;
        color: white;
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        margin: 0 auto;
        transition: background-color 0.3s;
    }

    .nav-link.active .step-icon {
        background-color: #691C32;
    }

    .nav-link:hover .step-icon {
        background-color: #9F2241;
    }

    .btn-evidencia {
        background-color: #691C32;
        color: white;
        padding: 0.5em 1em;
        border-radius: 5px;
        display: inline-block;
        cursor: pointer;
        text-align: center;
    }

    .btn-evidencia:hover {
        background-color: #9F2241;
        color: white;
    }

    .btn-evidencia.disabled-label {
        opacity: 0.6;
        pointer-events: none;
    }
</style>




<style>
    .nav-pills .nav-link.paso-activo {
        background-color: transparent !important;
        color: #FFFFFF !important;
        text-decoration: none;
    }

    .btn-evidencia {
        background-color: #691C32;
        color: white;
        padding: 0.5em 1em;
        border-radius: 5px;
        display: inline-block;
        cursor: pointer;
        text-align: center;
    }

    .btn-evidencia:hover {
        background-color: #9F2241;
        color: white;
    }

    .btn-evidencia.disabled-label {
        opacity: 0.6;
        pointer-events: none;
    }
</style>

<!-- Nueva barra de navegación circular con tooltips e íconos -->
<ul class="twitter-bs-wizard-nav nav nav-pills nav-justified mb-4" role="tablist" style="margin-top: 40px; z-index: 999; position: relative;">
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link paso-nav paso-activo" id="navPaso1" onclick="mostrarSeccion(1)">
            <div class="step-icon" data-bs-toggle="tooltip" title="I. Descripción del Centro de Trabajo">I</div>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link paso-nav" id="navPaso2" onclick="mostrarSeccion(2)">
            <div class="step-icon" data-bs-toggle="tooltip" title="II. Mapa de Daños">II</div>
        </a>
    </li>

</ul>

<form id="formReporte" enctype="multipart/form-data" onsubmit="enviarFormulario(event)">
    <!-- Sección I -->
    <div id="seccion1">
        <h2 class="text-left mb-4" style="color: #691C32;">I. Descripción del Centro de Trabajo</h2>
        <div class="mb-3">
            <label for="cct" class="form-label">1. Clave del Centro de Trabajo (CCT)</label>
            <input type="text" name="cct" id="cct" class="form-control" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fecha_siniestro" class="form-label">1.1 Fecha del siniestro</label>
                <input type="date" name="fecha_siniestro" id="fecha_siniestro" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="hora_siniestro" class="form-label">Hora del siniestro</label>
                <input type="time" name="hora_siniestro" id="hora_siniestro" class="form-control" required>
            </div>
        </div>

        <!-- <div class="mb-4">
            <label class="form-label">1.2 Tipo de siniestro (elige uno)</label>
            <div class="row">
                <?php
                $tipos = [
                    'geológico' => 'Socavones, hundimientos, deslizamientos de tierra, actividad volcánica.',
                    'hidrometeorológico' => 'Huracanes, lluvias intensas, inundaciones, granizadas, nevadas atípicas, desbordamientos, vientos fuertes.',
                    'incendio' => 'Incendios forestales.',
                    'sísmico' => 'Temblores, micro-sismos, sismos, terremotos.',
                    'social' => 'Vandalismo, robo, toma de planteles, invasiones, disturbios comunitarios.',
                    'tecnológico' => 'Explosiones, cortocircuitos, fugas de gas, colapsos por falla estructural, derrames de materiales peligrosos.'
                ];
                foreach ($tipos as $key => $desc) {
                    echo "<div class='form-check col-12 col-md-6'>
                <input class='form-check-input tipo-siniestro' type='radio' name='tipo_siniestro' id='tipo_$key' value='$key' required>
                <label class='form-check-label' for='tipo_$key'><strong>" . ucfirst($key) . "</strong>: $desc</label>
              </div>";
                }
                ?>
            </div>
        </div> -->

        <div class="mb-4">
            <label class="form-label">1.2 Tipo de siniestro (elige uno)</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="list-group">
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                Geológico
                                <small class="d-block text-body-secondary">Socavones, hundimientos, deslizamientos de tierra, actividad volcánica.</small>
                            </span>
                            <input class="form-check-input" type="radio" name="tipo_siniestro" id="tipo_siniestro_geologico" value="geológico" checked>
                        </label>
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                Hidrometeorológico
                                <small class="d-block text-body-secondary">Huracanes, lluvias intensas, inundaciones, granizadas, nevadas atípicas, desbordamientos, vientos fuertes.</small>
                            </span>
                            <input class="form-check-input" type="radio" name="tipo_siniestro" id="tipo_siniestro_hidrometeorológico" value="hidrometeorológico">
                        </label>
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                Incendio
                                <small class="d-block text-body-secondary">Incendios forestales.</small>
                            </span>
                            <input class="form-check-input" type="radio" name="tipo_siniestro" id="tipo_siniestro_incendio" value="incendio">
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list-group">
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                Sísmico
                                <small class="d-block text-body-secondary">Temblores, micro-sismos, sismos, terremotos.</small>
                            </span>
                            <input class="form-check-input" type="radio" name="tipo_siniestro" id="tipo_siniestro_sismico" value="sísmico">
                        </label>
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                Social
                                <small class="d-block text-body-secondary">Vandalismo, robo, toma de planteles, invasiones, disturbios comunitarios.</small>
                            </span>
                            <input class="form-check-input" type="radio" name="tipo_siniestro" id="tipo_siniestro_social" value="social">
                        </label>
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                Tecnológico
                                <small class="d-block text-body-secondary">Explosiones, cortocircuitos, fugas de gas, colapsos por falla estructural, derrames de materiales peligrosos.</small>
                            </span>
                            <input class="form-check-input" type="radio" name="tipo_siniestro" id="tipo_siniestro_tecnologico" value="tecnológico">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">1.3 ¿Se activó algún protocolo de ayuda?</label>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="atencion_oficial" id="atencion_si" value="si" required>
                        <label class="form-check-label" for="atencion_si">Sí</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="atencion_oficial" id="atencion_no" value="no">
                        <label class="form-check-label" for="atencion_no">No</label>
                    </div>
                </div>
                <div id="nivel_atencion_container" class="mb-3" style="display:none;">
                    <label for="nivel_atencion" class="form-label">Selecciona nivel de atención</label>
                    <select name="nivel_atencion" id="nivel_atencion" class="form-select">
                        <option value="">Selecciona</option>
                        <option value="municipal">Municipal</option>
                        <option value="estatal">Estatal</option>
                        <option value="sedena">Plan DN-III-E (SEDENA)</option>
                        <option value="marina">Plan Marina (SEMAR)</option>
                        <option value="gna">Plan GN-A (Guardia Nacional)</option>
                        <option value="proteccion-civil">Comisión interna de Protección Civil</option>
                    </select>
                </div>
                <script>
                    document.querySelectorAll('input[name="atencion_oficial"]').forEach(input => {
                        input.addEventListener('change', function() {
                            const container = document.getElementById('nivel_atencion_container');
                            const select = document.getElementById('nivel_atencion');
                            const brigadas = document.getElementById('brigadas');
                            const brigadasContainer = document.getElementById('brigadas_container');
                            if (this.value === 'si') {
                                container.style.display = 'block';
                                select.removeAttribute('disabled');
                                select.setAttribute('required', 'true');
                                // Restaurar opciones normales si antes se había puesto "Sin atención"
                                select.innerHTML =
                                    '<option value="">Selecciona</option>' +
                                    '<option value="municipal">Municipal</option>' +
                                    '<option value="estatal">Estatal</option>' +
                                    '<option value="sedena">Plan DN-III-E (SEDENA)</option>' +
                                    '<option value="marina">Plan Marina (SEMAR)</option>' +
                                    '<option value="gna">Plan GN-A (Guardia Nacional)</option>' +
                                    '<option value="proteccion-civil">Comisión interna de Protección Civil</option>';
                                select.value = '';
                                select.name = "nivel_atencion";
                                document.getElementById('brigadas').selectedIndex = 0;
                            } else {
                                container.style.display = 'none';
                                select.innerHTML = '<option value="" selected>Sin atención</option>';
                                select.value = '';
                                select.setAttribute('disabled', 'true');
                                select.removeAttribute('required');
                                // Asegúrate que brigadas y nivel_atencion no se preseleccionen cuando es "no"
                                if (brigadas) {
                                    brigadas.value = '';
                                }
                                // Oculta el contenedor de brigadas y reinicia el valor del select de nivel de atención
                                if (brigadasContainer) {
                                    brigadasContainer.style.display = 'none';
                                }
                                select.value = '';
                                select.name = "nivel_atencion";
                                document.getElementById('brigadas').selectedIndex = 0;
                            }
                        });
                    });
                </script>
            </div>
            <div id="brigadas_container" style="display:none;">
                <div class="col-md-6">
                    <label for="brigadas" class="form-label">1.3.1 Selecciona la brigada de Protección Civil</label>
                    <select name="brigadas[]" id="brigadas" class="form-select">
                        <option value="">Selecciona una brigada</option>
                        <option value="multifuncional">Brigada multifuncional</option>
                        <option value="rescate">Búsqueda y rescate</option>
                        <option value="evacuacion">Evacuación</option>
                        <option value="incendios">Incendios</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="dashboard" class="btn btn-secondary me-2">Cancelar</a>
            <button type="button" id="btnContinuar" class="btn btn-primary" style="background-color: #691C32; border-color: #691C32;" onclick="validarSeccion1()">Continuar</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navegación progresiva con botones
            document.getElementById('navPaso1').addEventListener('click', function() {
                if (document.getElementById('seccion2').style.display === 'block' || document.getElementById('seccion3').style.display === 'block') {
                    document.getElementById('seccion1').style.display = 'block';
                    document.getElementById('seccion2').style.display = 'none';
                    document.getElementById('seccion3').style.display = 'none';
                    const navLinks = document.querySelectorAll('.nav-pills .nav-link');
                    navLinks.forEach(link => link.classList.remove('paso-activo', 'active'));
                    this.classList.add('paso-activo', 'active');
                }
            });
            document.getElementById('navPaso2').addEventListener('click', function() {
                if (document.getElementById('seccion1').style.display === 'block' || document.getElementById('seccion3').style.display === 'block') {
                    document.getElementById('seccion1').style.display = 'none';
                    document.getElementById('seccion2').style.display = 'block';
                    document.getElementById('seccion3').style.display = 'none';
                    const navLinks = document.querySelectorAll('.nav-pills .nav-link');
                    navLinks.forEach(link => link.classList.remove('paso-activo', 'active'));
                    this.classList.add('paso-activo', 'active');
                }
            });

            const cctInput = document.getElementById('cct');
            cctInput.addEventListener('input', () => cctInput.value = cctInput.value.toUpperCase());
            cctInput.addEventListener('blur', function() {
                const cct = cctInput.value.trim().toUpperCase();
                let isValid = true;
                let msg = '';
                const regex = /^([0-2][0-9]|3[0-3])[A-Z]{3}[0-9]{4}[A-Z]$/;

                if (!regex.test(cct)) {
                    isValid = false;
                    msg = 'El formato general del CCT no es correcto.';
                } else {
                    const entidad = parseInt(cct.substring(0, 2), 10);
                    const letrasServicio = cct.substring(3, 5);
                    const numeroCentro = cct.substring(5, 9);
                    const verificador = cct.charAt(9);

                    if (entidad < 1 || entidad > 33) {
                        isValid = false;
                        msg = 'Entidad no válida (01 a 33).';
                    } else if (!/^[A-Z]{2}$/.test(letrasServicio)) {
                        isValid = false;
                        msg = 'Caracteres 4 y 5 deben ser letras.';
                    } else if (!/^\d{4}$/.test(numeroCentro)) {
                        isValid = false;
                        msg = 'Caracteres 6 al 9 deben ser numéricos.';
                    } else if (!/^[A-Z]$/.test(verificador)) {
                        isValid = false;
                        msg = 'El último carácter debe ser letra.';
                    }
                }

                if (!isValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'CCT inválido',
                        text: msg
                    }).then(() => {
                        cctInput.focus(); // ✅ devuelve el foco al input
                        cctInput.select(); // ✅ opcional: selecciona el texto para facilitar corrección
                    });
                    cctInput.style.borderColor = 'red';
                } else {
                    cctInput.style.borderColor = 'green';
                }
            });

            // La validación y navegación de sección 1 ahora se realiza en validarSeccion1()

            document.getElementById('btnRegresar').addEventListener('click', function() {
                document.getElementById('seccion2').style.display = 'none';
                document.getElementById('seccion1').style.display = 'block';
                // restaurar paso activo
                const navLinks = document.querySelectorAll('.nav-pills .nav-link');
                navLinks.forEach(link => link.classList.remove('paso-activo', 'active'));
                document.getElementById('navPaso1').classList.add('paso-activo', 'active');
            });


            // --- Script para habilitar/deshabilitar campos según selección de "Grado de daño" ---
            document.querySelectorAll('.form-select[name$="[tipo]"]').forEach(select => {
                select.disabled = false; // Siempre habilitado

                select.addEventListener('change', function() {
                    const row = this.closest('tr');
                    const cantidad = row.querySelector('.cantidad-danio');
                    const evidencia = row.querySelector("input[type='file']");
                    const label = row.querySelector("label.btn-evidencia");

                    const tieneDanio = this.value !== '';

                    if (cantidad) cantidad.disabled = !tieneDanio;
                    if (evidencia) evidencia.disabled = !tieneDanio;
                    if (label) label.classList.toggle('disabled-label', !tieneDanio);
                });

                // Inicializar al cargar
                select.dispatchEvent(new Event('change'));
            });
        });
    </script>
    <script>
        // Mostrar brigadas_container cuando se selecciona Comisión interna de Protección Civil
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('nivel_atencion');
            const brigadasContainer = document.getElementById('brigadas_container');
            if (select && brigadasContainer) {
                select.addEventListener('change', function() {
                    const valor = this.value;
                    if (valor === 'proteccion-civil') {
                        brigadasContainer.style.display = 'block';
                    } else {
                        brigadasContainer.style.display = 'none';
                    }
                });
            }
        });
    </script>

    <!-- Sección II -->
    <div id="seccion2" style="display:none;">
        <h2 class="text-left my-5" style="color: #691C32;">II. Mapa de Daños</h2>


        <div id="tabla_areas_principales">
            <h4 class="mb-3" style="color: #691C32;">2.1 Identifique la(s) área(s) principal(es) dañado(s)</h4>
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle text-center">
                    <thead style="background-color:#E9E9E9;">
                        <tr>
                            <th style="background-color:#691C32; color:white; font-size: 1.25em;">Área</th>
                            <th style="background-color:#E9E9E9;">Grado de daño</th>
                            <th style="background-color:#E9E9E9;">Número dañado</th>
                            <th style="background-color:#E9E9E9;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once __DIR__ . '/../config/catalogos.php';
                        if (!defined('CATALOGO_AREAS_PRINCIPALES')) {
                            echo "<tr><td colspan='5' class='text-danger'>Error: catálogo no disponible</td></tr>";
                        } else {
                            foreach (CATALOGO_AREAS_PRINCIPALES as $area) {
                                echo "<tr>
                      <td>$area</td>
                       <td>
                        <select name='areas_principales[{$area}][tipo]' class='form-select' disabled>
                          <option value=''>Selecciona</option>
                          <option value='leve'>Leve</option>
                          <option value='moderado'>Moderado</option>
                          <option value='grave'>Grave</option>
                        </select>
                      </td>

                      <td><select class='form-select cantidad-danio' name='areas_principales[{$area}][cantidad]' required>
                        <option value=''>Selecciona</option> ";
                                for ($n = 1; $n <= 100; $n++) {
                                    echo "<option value='$n'>$n</option>";
                                }
                                echo "</select>
                     </td>                                   
                      <td>
                        <label class=\"btn btn-evidencia w-100 disabled-label\">
                          Agrega evidencia
                          <input type='file' name='areas_principales[{$area}][evidencia]' class='evidencia-input' style='display:none;' disabled>
                        </label>
                      </td>
                  </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Sección 2.2 Áreas adicionales -->
            <div id="tabla_areas_adicionales" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.2 Identifique la(s) área(s) adicional(es) dañado(s)</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Área</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Número dañado</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_AREAS_ADICIONALES as $area): ?>
                                <tr>
                                    <td><?= $area ?></td>
                                    <td>
                                        <select name='areas_adicionales[<?= $area ?>][tipo]' class='form-select' disabled>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='areas_adicionales[<?= $area ?>][cantidad]' required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>


                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='areas_adicionales[<?= $area ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Sección 2.3 Mobiliario -->
            <div id="tabla_mobiliario" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.3 Identifique el mobiliario dañado</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Mobiliario</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Número dañado</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_MOBILIARIO as $item): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td>
                                        <select name='mobiliario[<?= $item ?>][tipo]' class='form-select' disabled>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select class='form-select cantidad-danio' name='mobiliario[<?= $item ?>][cantidad]' required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>


                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='mobiliario[<?= $item ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Sección 2.4 Equipo dañado -->
            <div id="tabla_equipo" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.4 Identifique el equipo de cómputo dañado</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Equipo</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Número dañado</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_EQUIPO as $item): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td>
                                        <select name='equipo[<?= $item ?>][tipo]' class='form-select' disabled>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='equipo[<?= $item ?>][cantidad]' required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>


                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='equipo[<?= $item ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Sección 2.5 Áreas comunes   -->
            <div id="tabla_areas_comunes" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.5 Identifique la(s) área(s) comun(es) dañado(s)</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Área común</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Número dañado</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_AREAS_COMUNES as $item): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td>
                                        <select name='areas_comunes[<?= $item ?>][tipo]' class='form-select' disabled>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='areas_comunes[<?= $item ?>][cantidad]' required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>

                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='areas_comunes[<?= $item ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Sección 2.6 Elementos   -->
            <div id="tabla_elementos" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.6 Identifique los elementos dañados</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Elemento</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Número dañado</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_ELEMENTOS as $item): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td>
                                        <select name='elementos[<?= $item ?>][tipo]' class='form-select' disabled>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='elementos[<?= $item ?>][cantidad]' required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>

                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='elementos[<?= $item ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="button" id="btnRegresar" class="btn btn-secondary me-2">← Regresar a Descripción</button>
                <button type="submit" class="btn btn-primary" style="background-color: #691C32; border-color: #691C32;">
                    <i class="fas fa-paper-plane me-1"></i> Enviar Alerta
                </button>
            </div>
        </div>
    </div>

</form>


<script>
    // Función para validar y navegar de sección 1 a sección 2, manejando campos required ocultos
    function validarSeccion1() {
        // Desactivar temporalmente required de campos ocultos
        document.querySelectorAll('[required]').forEach(el => {
            if (el.offsetParent === null) {
                el.dataset.originalRequired = 'true';
                el.removeAttribute('required');
            }
        });

        const form = document.getElementById('formReporte');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Validación extra de CCT
        const cctInput = document.getElementById('cct');
        const regex = /^([0-2][0-9]|3[0-3])[A-Z]{3}[0-9]{4}[A-Z]$/;
        if (!regex.test(cctInput.value.trim().toUpperCase())) {
            Swal.fire({
                icon: 'error',
                title: 'CCT inválido',
                text: 'Verifica que el formato del CCT sea correcto antes de continuar.'
            });
            return;
        }

        // Ocultar Sección 1, mostrar Sección 2
        document.getElementById('seccion1').style.display = 'none';
        document.getElementById('seccion2').style.display = 'block';

        // Reactivar required en sección 2 visible
        document.querySelectorAll('#seccion2 select, #seccion2 input').forEach(el => {
            if (el.dataset.originalRequired === 'true') {
                el.setAttribute('required', 'true');
            }
        });

        // Actualizar navegación de pasos
        const navLinks = document.querySelectorAll('.nav-pills .nav-link');
        navLinks.forEach(link => link.classList.remove('paso-activo', 'active'));
        document.getElementById('navPaso2').classList.add('paso-activo', 'active');
        window.scrollTo(0, 0);
    }
</script>

<?php include __DIR__ . '/../templates/footer.php'; ?>

<script>
    // --- Evidencia: subir imagen AJAX ---
    document.querySelectorAll('.evidencia-input').forEach(input => {
        input.addEventListener('change', async function(e) {
            const file = this.files[0];
            if (!file) return;

            // Obtener datos necesarios
            const tr = this.closest('tr');
            const label = tr.children[0]?.textContent.trim();
            let tipoSeccion = '';
            let sectionDiv = tr.closest('div[id^="tabla_"]');
            if (sectionDiv) {
                if (sectionDiv.id === 'tabla_areas_principales') tipoSeccion = 'areas_principales';
                else if (sectionDiv.id === 'tabla_areas_adicionales') tipoSeccion = 'areas_adicionales';
                else if (sectionDiv.id === 'tabla_mobiliario') tipoSeccion = 'mobiliario';
                else if (sectionDiv.id === 'tabla_equipo') tipoSeccion = 'equipo';
                else if (sectionDiv.id === 'tabla_areas_comunes') tipoSeccion = 'areas_comunes';
                else if (sectionDiv.id === 'tabla_elementos') tipoSeccion = 'elementos';
            }
            const cct = document.getElementById('cct').value.trim();
            const fecha_siniestro = document.getElementById('fecha_siniestro').value;
            const tipoDanioSelect = tr.querySelector("select[name*='[tipo]']");
            const tipo_danio = tipoDanioSelect ? tipoDanioSelect.value : '';

            // Validaciones previas básicas
            if (!cct || !fecha_siniestro || !tipo_danio || !tipoSeccion || !label) {
                Swal.fire({
                    icon: 'error',
                    title: 'Datos faltantes',
                    text: 'Completa CCT, fecha, tipo de daño y selecciona la opción antes de subir la imagen.'
                });
                this.value = '';
                return;
            }

            const formData = new FormData();
            formData.append('evidencia', file);
            formData.append('cct', cct);
            formData.append('fecha_siniestro', fecha_siniestro);
            formData.append('tipo_danio', tipo_danio);
            formData.append('tipo_seccion', tipoSeccion);
            formData.append('elemento', label);
            // Incluir explícitamente el nombre del archivo a subir (nombre original)
            formData.append('nombre_archivo', file.name);

            // Feedback de carga
            const loadingSwal = Swal.fire({
                title: 'Subiendo evidencia...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const resp = await fetch('/controllers/subir_evidencia.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await resp.json();
                Swal.close();
                if (data.success) {
                    this.setAttribute('data-filename', data.filename);

                    const name = this.getAttribute('name');
                    const hiddenName = name.replace('[evidencia]', '[nombre_archivo]');
                    let hiddenInput = document.querySelector(`input[name="${hiddenName}"]`);
                    if (!hiddenInput) {
                        hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = hiddenName;
                        this.closest('form').appendChild(hiddenInput);
                    }
                    hiddenInput.value = data.filename;

                    const label = this.closest('label');
                    const existing = label.querySelector('img');
                    if (existing) label.removeChild(existing);

                    const preview = document.createElement('img');
                    preview.src = '/uploads/' + data.filename;
                    preview.alt = 'Vista previa';
                    preview.style.maxHeight = '60px';
                    preview.style.marginTop = '5px';
                    label.appendChild(preview);

                    Swal.fire({
                        icon: 'success',
                        title: 'Evidencia cargada',
                        text: 'La imagen fue cargada exitosamente.'
                    });
                } else {
                    this.value = '';
                    this.removeAttribute('data-filename');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'No se pudo subir la imagen.'
                    });
                }
            } catch (err) {
                Swal.close();
                this.value = '';
                this.removeAttribute('data-filename');
                Swal.fire({
                    icon: 'error',
                    title: 'Error de red',
                    text: 'No se pudo conectar con el servidor.'
                });
            }
        });
    });
</script>

<script>
    function enviarFormulario(event) {
        event.preventDefault(); // Evita que se recargue la página

        // Validar que cada select de tipo de daño con valor tenga los campos asociados completos
        let errores = [];
        const secciones = [{
                id: 'tabla_areas_principales',
                nombre: '2.1 Áreas principales'
            },
            {
                id: 'tabla_areas_adicionales',
                nombre: '2.2 Áreas adicionales'
            },
            {
                id: 'tabla_mobiliario',
                nombre: '2.3 Mobiliario'
            },
            {
                id: 'tabla_equipo',
                nombre: '2.4 Equipo'
            },
            {
                id: 'tabla_areas_comunes',
                nombre: '2.5 Áreas comunes'
            },
            {
                id: 'tabla_elementos',
                nombre: '2.6 Elementos'
            },
        ];

        secciones.forEach(seccion => {
            const tabla = document.getElementById(seccion.id);
            if (!tabla) return;

            const filas = tabla.querySelectorAll('tbody tr');
            filas.forEach(fila => {
                const tipo = fila.querySelector("select[name*='[tipo]']");
                const cantidad = fila.querySelector("select[name*='[cantidad]']");
                const evidencia = fila.querySelector("input[type='file']");
                const form = document.getElementById('formReporte');
                // Obtener el input de nombre de archivo asociado al input de evidencia
                const nombreArchivo = form.querySelector(`input[name="${evidencia?.name?.replace('[evidencia]', '[nombre_archivo]')}"]`);
                const labelArea = fila.children[0]?.textContent.trim();

                // Reset estilo previo
                fila.querySelectorAll("td").forEach(td => td.style.border = '');

                if (tipo && tipo.value !== '') {
                    let filaInvalida = false;
                    if (!cantidad || cantidad.value === '') filaInvalida = true;
                    if (!evidencia || evidencia.disabled || !nombreArchivo || !nombreArchivo.value) filaInvalida = true;

                    if (filaInvalida) {
                        fila.querySelectorAll("td").forEach(td => td.style.border = '2px solid red');
                        errores.push(`${seccion.nombre} → ${labelArea}`);
                    }
                }
            });
        });

        if (errores.length > 0) {
            // Llevar al usuario a la primera sección con error ANTES de mostrar Swal
            const idPrimera = secciones.find(s => errores[0].includes(s.nombre))?.id;
            if (idPrimera) {
                const sectionDiv = document.getElementById(idPrimera);
                if (sectionDiv) {
                    sectionDiv.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }

            Swal.fire({
                icon: 'error',
                title: 'Faltan datos por completar',
                html: '<b>No se puede enviar la alerta</b><br>Completa los siguientes campos:<br><ul style="text-align:left">' +
                    errores.map(e => `<li>${e}</li>`).join('') +
                    '</ul>'
            });
            return; // Detiene el envío
        }

        const form = document.getElementById('formReporte');
        const formData = new FormData(form);

        fetch('/controllers/guardar_reporte.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ficha de Diagnóstico enviado',
                        text: 'El reporte ha sido creado correctamente para el CCT: ' + formData.get('cct'),
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = '/dashboard';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Ocurrió un error al guardar el reporte.'
                    });
                }
            })
            .catch(error => {
                console.error('Error en el envío del formulario:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de red',
                    text: 'No se pudo conectar con el servidor.'
                });
            });
    }
</script>


<!-- // Navegación circular de secciones con barra de pasos -->
<script>
    function mostrarSeccion(n) {
        const secciones = [
            document.getElementById('seccion1'),
            document.getElementById('seccion2'),
            document.getElementById('seccion3')
        ];

        if (n === 2) {
            const form = document.getElementById('formReporte');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
        }

        if (n === 3) {
            const btnSeccion3 = document.getElementById('btnSeccion3');
            if (btnSeccion3) {
                btnSeccion3.click();
                return;
            }
        }

        secciones.forEach((sec, idx) => {
            if (sec) sec.style.display = (idx === n - 1) ? 'block' : 'none';
        });

        document.querySelectorAll('.twitter-bs-wizard-nav .nav-link').forEach((a, idx) => {
            a.classList.toggle('active', idx === n - 1);
        });

        // Add/Remove paso-completado class and update nav container class for progress bar
        const navLinks = document.querySelectorAll('.twitter-bs-wizard-nav .nav-link');
        navLinks.forEach((a, idx) => {
            a.classList.remove('paso-completado');
            if (idx < n - 1) {
                a.classList.add('paso-completado');
            }
        });
        const navContainer = document.querySelector('.twitter-bs-wizard-nav');
        if (navContainer) {
            navContainer.classList.remove('paso-1', 'paso-2', 'paso-3');
            if (n === 1) navContainer.classList.add('paso-1');
            if (n === 2) navContainer.classList.add('paso-2');
            if (n === 3) navContainer.classList.add('paso-3');
        }

        window.scrollTo(0, 0);
    }
</script>

<script>
    // Inicialización de tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>