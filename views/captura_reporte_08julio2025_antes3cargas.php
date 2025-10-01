<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../config/db.php';

//redirigirSiNoLogeado();
$title = 'Captura de Reporte';
include __DIR__ . '/../templates/header.php';
?>
<div class="container mt-4 mb-5">
    <div class="border rounded p-3 shadow-sm bg-light ">
        <div class="d-flex flex-wrap gap-3 align-items-baseline  ">
            <span class="fw-semibold text-dark"><strong>Entidad:</strong> <?= $_SESSION['entidad'] ?? 'Entidad' ?></span> |
            <span class="fw-semibold text-dark"><strong>CCT:</strong> <?= $_SESSION['cct'] ?? 'CCT' ?></span>
        </div>
        <div class="d-flex flex-wrap gap-1 align-items-baseline  ">
            <span class="fw-semibold text-dark"><strong>Municipio:</strong> <?= $_SESSION['municipio'] ?? 'Municipio' ?></span> |
            <span class="fw-semibold text-dark"><strong>Nombre del plantel:</strong> <?= $_SESSION['nombre'] ?? 'Usuario' ?></span> |
            <span class="fw-semibold text-dark"><strong>Nivel educativo:</strong> <?= $_SESSION['nivel_educativo'] ?? 'Nivel' ?></span> |
            <span class="fw-semibold text-dark"><strong>Turno:</strong> <?= $_SESSION['turno'] ?? 'Turno' ?></span> |
            <span class="fw-semibold text-dark"><strong>Dirección:</strong> <?= $_SESSION['domicilio'] ?? '' ?> <?= $_SESSION['n_ext'] ?? '' ?></span>
        </div>
    </div>
</div>
<?php
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


<form id="formReporte" enctype="multipart/form-data" onsubmit="enviarFormulario(event)">
    <!-- Sección I -->
    <div id="seccion1">
        <h2 class="text-left mb-4" style="color: #691C32;">I. Descripción del Centro de Trabajo</h2>

        <div class="mb-4">
            <label class="form-label">1. Tipo de siniestro </label>
            <div class="row">
                <div class="col-md-6">
                    <div class="border p-3 mb-3 rounded shadow-sm">
                        <h5 class="mb-3">Geológico</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <?php
                            $geologico = ['Socavón', 'Hundimiento', 'Deslizamiento de tierra', 'Actividad volcánica'];
                            foreach ($geologico as $idx => $item): ?>
                                <label class="form-check-label border rounded p-2 d-flex align-items-center gap-2" for="tipo_siniestro_geologico_<?= $idx ?>">
                                    <input class="form-check-input me-2" type="checkbox" name="tipo_siniestro[]" value="<?= strtolower($item) ?>" id="tipo_siniestro_geologico_<?= $idx ?>">
                                    <?= $item ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="border p-3 mb-3 rounded shadow-sm">
                        <h5 class="mb-3">Hidrometeorológico</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <?php
                            $hidro = ['Huracán', 'Lluvia intensas', 'Inundación', 'Granizada', 'Nevada atípica', 'Desbordamiento', 'Viento fuerte'];
                            foreach ($hidro as $idx => $item): ?>
                                <label class="form-check-label border rounded p-2 d-flex align-items-center gap-2" for="tipo_siniestro_hidro_<?= $idx ?>">
                                    <input class="form-check-input me-2" type="checkbox" name="tipo_siniestro[]" value="<?= strtolower($item) ?>" id="tipo_siniestro_hidro_<?= $idx ?>">
                                    <?= $item ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="border p-3 mb-3 rounded shadow-sm">
                        <h5 class="mb-3">Incendio</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <label class="form-check-label border rounded p-2 d-flex align-items-center gap-2" for="tipo_siniestro_incendio_0">
                                <input class="form-check-input me-2" type="checkbox" name="tipo_siniestro[]" value="incendio forestal" id="tipo_siniestro_incendio_0">
                                Incendio forestal
                            </label>
                            <label class="form-check-label border rounded p-2 d-flex align-items-center gap-2" for="tipo_siniestro_incendio_1">
                                <input class="form-check-input me-2" type="checkbox" name="tipo_siniestro[]" value="incendio por explosión" id="tipo_siniestro_incendio_1">
                                Incendio por explosión
                            </label>
                            <label class="form-check-label border rounded p-2 d-flex align-items-center gap-2" for="tipo_siniestro_incendio_2">
                                <input class="form-check-input me-2" type="checkbox" name="tipo_siniestro[]" value="incendio por derrame de sustancias peligrosas" id="tipo_siniestro_incendio_2">
                                Incendio por derrame de sustancias peligrosas
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border p-3 mb-3 rounded shadow-sm">
                        <h5 class="mb-3">Sísmico</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <?php
                            $sismico = ['Micro-sismo', 'Sismo', 'Terremoto'];
                            foreach ($sismico as $idx => $item): ?>
                                <label class="form-check-label border rounded p-2 d-flex align-items-center gap-2" for="tipo_siniestro_sismico_<?= $idx ?>">
                                    <input class="form-check-input me-2" type="checkbox" name="tipo_siniestro[]" value="<?= strtolower($item) ?>" id="tipo_siniestro_sismico_<?= $idx ?>">
                                    <?= $item ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="border p-3 mb-3 rounded shadow-sm">
                        <h5 class="mb-3">Social</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <?php
                            $social = ['Vandalismo', 'Robo', 'Toma de planteles', 'Invasiones', 'Disturbios comunitarios'];
                            foreach ($social as $idx => $item): ?>
                                <label class="form-check-label border rounded p-2 d-flex align-items-center gap-2" for="tipo_siniestro_social_<?= $idx ?>">
                                    <input class="form-check-input me-2" type="checkbox" name="tipo_siniestro[]" value="<?= strtolower($item) ?>" id="tipo_siniestro_social_<?= $idx ?>">
                                    <?= $item ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="border p-3 mb-3 rounded shadow-sm">
                        <h5 class="mb-3">Químico - Tecnológico</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <?php
                            $tecno = ['Explosión', 'Cortocircuito', 'Fuga de gas'];
                            foreach ($tecno as $idx => $item): ?>
                                <label class="form-check-label border rounded p-2 d-flex align-items-center gap-2" for="tipo_siniestro_tecno_<?= $idx ?>">
                                    <input class="form-check-input me-2" type="checkbox" name="tipo_siniestro[]" value="<?= strtolower($item) ?>" id="tipo_siniestro_tecno_<?= $idx ?>">
                                    <?= $item ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">1.1 ¿Se activó algún protocolo de ayuda?</label>
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
                    <!-- <label for="brigadas" class="form-label"> Selecciona la brigada de Protección Civil</label> -->
                    <select name="brigadas[]" id="brigadas" class="form-select">
                        <option value="">Selecciona una brigada de Protección Civil</option>
                        <option value="multifuncional">Brigada multifuncional</option>
                        <option value="rescate">Búsqueda y rescate</option>
                        <option value="evacuacion">Evacuación</option>
                        <option value="incendios">Incendios</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Eliminados botones Cancelar y Continuar -->
    </div>

    <!-- Eliminado script de navegación entre secciones y botones -->
    <script>
        // --- Script para habilitar/deshabilitar campos según selección de "Grado de daño" ---
        document.addEventListener('DOMContentLoaded', function() {
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
    <div id="seccion2">
        <h2 class="text-left my-5" style="color: #691C32;">II. Mapa de Daños</h2>

        <div id="tabla_areas_principales">
            <h4 class="mb-3" style="color: #691C32;">2.1 Identifica la(s) área(s) principal(es) dañada(s)</h4>
            <p>Áreas esenciales para el funcionamiento académico-administrativo del plantel y núcleo de las actividades escolares cotidianas.</p>
            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; background-color: #c0392b; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                    Grave
                </span> Afectación estructural que representa un riesgo para la integridad de la comunidad educativa (colapso, grietas o fisuras).
                <br><span style="display: inline-block; background-color: #e67e22; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                    Moderado
                </span> Deterioro funcional que no afecta la operación.
                <br> <span style="display: inline-block; background-color: #f1c40f; color: black; padding: 5px 10px; border-radius: 5px;">
                    Leve
                </span> Evidencia que muestra la naturaleza del siniestro, sin consecuencia grave o moderada.
            </div>
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle text-center">
                    <thead style="background-color:#E9E9E9;">
                        <tr>
                            <th style="background-color:#691C32; color:white; font-size: 1.25em;">Áreas principales</th>
                            <th style="background-color:#E9E9E9;">Grado de daño

                            </th>
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
                            // Lista de áreas restringidas
                            $areas_restringidas = [
                                "Dirección",
                                "Casa del conserje",
                                "Casa del maestro",
                                "Intendencia",
                                "Subdirección"
                            ];
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
                      <td>";
                                if (in_array($area, $areas_restringidas)) {
                                    echo "<select class='form-select cantidad-danio' name='areas_principales[{$area}][cantidad]' required>
                                            <option value='1' selected>1</option>
                                          </select>";
                                } else {
                                    echo "<select class='form-select cantidad-danio' name='areas_principales[{$area}][cantidad]' required>
                                            <option value=''>Selecciona</option>";
                                    for ($n = 1; $n <= 100; $n++) {
                                        echo "<option value='$n'>$n</option>";
                                    }
                                    echo "</select>";
                                }
                                echo "</td>                                   
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
                <h4 class="mb-3" style="color: #691C32;">2.2 Identifica la(s) área(s) adicional(es) dañada(s)</h4>
                <p>Zonas complementarias que enriquecen los servicios del plantel, ya que brindan soporte educativo, logístico y formativo.</p>
                <div style="margin-bottom: 10px;">
                    <span style="display: inline-block; background-color: #c0392b; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Grave
                    </span> Afectación estructural que representa un riesgo para la integridad de la comunidad educativa (colapso, grietas o fisuras).
                    <br><span style="display: inline-block; background-color: #e67e22; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Moderado
                    </span> Deterioro funcional que no afecta la operación.
                    <br> <span style="display: inline-block; background-color: #f1c40f; color: black; padding: 5px 10px; border-radius: 5px;">
                        Leve
                    </span> Evidencia que muestra la naturaleza del siniestro, sin consecuencia grave o moderada.
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Áreas adicionales</th>
                                <th style="background-color:#E9E9E9;">Grado de daño

                                </th>
                                <th style="background-color:#E9E9E9;">Número dañado</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Reutilizar lista de áreas restringidas
                            $areas_restringidas = [
                                "Dirección",
                                "Casa del conserje",
                                "Casa del maestro",
                                "Intendencia",
                                "Subdirección"
                            ];
                            foreach (CATALOGO_AREAS_ADICIONALES as $area): ?>
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
                                        <?php if (in_array($area, $areas_restringidas)): ?>
                                            <select class='form-select cantidad-danio' name='areas_adicionales[<?= $area ?>][cantidad]' required>
                                                <option value='1' selected>1</option>
                                            </select>
                                        <?php else: ?>
                                            <select class='form-select cantidad-danio' name='areas_adicionales[<?= $area ?>][cantidad]' required>
                                                <option value=''>Selecciona</option>
                                                <?php for ($i = 1; $i <= 100; $i++): ?>
                                                    <option value='<?= $i ?>'><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        <?php endif; ?>
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
            <!-- Sección 2.3 Áreas comunes   -->
            <div id="tabla_areas_comunes" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.3 Identifica la(s) área(s) común(es) dañada(s)</h4>
                <p>Espacios compartidos diseñados para desarrollar actividades físicas, recreativas, sociales y ambientales que fomentar la convivencia escolar y el desarrollo integral de los alumnos.</p>
                <div style="margin-bottom: 10px;">
                    <span style="display: inline-block; background-color: #c0392b; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Grave
                    </span> Afectación estructural que representa un riesgo para la integridad de la comunidad educativa (colapso, grietas o fisuras).
                    <br><span style="display: inline-block; background-color: #e67e22; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Moderado
                    </span> Deterioro funcional que no afecta la operación.
                    <br> <span style="display: inline-block; background-color: #f1c40f; color: black; padding: 5px 10px; border-radius: 5px;">
                        Leve
                    </span> Evidencia que muestra la naturaleza del siniestro, sin consecuencia grave o moderada.
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Áreas comúnes</th>
                                <th style="background-color:#E9E9E9;">Grado de daño

                                </th>
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
            <!-- Sección 2.4 Mobiliario -->
            <div id="tabla_mobiliario" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.4 Identifica el mobiliario dañado</h4>
                <p>Componentes físicos que facilitan el desarrollo de todas actividades, su presencia y estado influyen directamente en la comodidad, organización y funcionalidad del espacio escolar.</p>
                <div style="margin-bottom: 10px;">
                    <span style="display: inline-block; background-color: #c0392b; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Grave
                    </span> Efecto que hace inservible el mobiliario o equipo.

                    <br><span style="display: inline-block; background-color: #e67e22; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Moderado
                    </span> Deterioro funcional del mobiliario o equipo.

                    <br> <span style="display: inline-block; background-color: #f1c40f; color: black; padding: 5px 10px; border-radius: 5px;">
                        Leve
                    </span> Evidencia que muestra la naturaleza del siniestro, sin consecuencia grave o moderada.
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Mobiliario</th>
                                <th style="background-color:#E9E9E9;">Grado de daño

                                </th>
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
            <!-- Sección 2.5 Equipo dañado -->
            <div id="tabla_equipo" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.5 Identifica el equipo de cómputo dañado</h4>
                <p>Dispositivos tecnológicos y herramientas que apoyan los procesos educativos, administrativos y de comunicación dentro del plantel.</p>
                <div style="margin-bottom: 10px;">
                    <span style="display: inline-block; background-color: #c0392b; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Grave
                    </span> Efecto que hace inservible el mobiliario o equipo.

                    <br><span style="display: inline-block; background-color: #e67e22; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Moderado
                    </span> Deterioro funcional del mobiliario o equipo.

                    <br> <span style="display: inline-block; background-color: #f1c40f; color: black; padding: 5px 10px; border-radius: 5px;">
                        Leve
                    </span> Evidencia que muestra la naturaleza del siniestro, sin consecuencia grave o moderada.
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Equipo</th>
                                <th style="background-color:#E9E9E9;">Grado de daño

                                </th>
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
            <!-- Sección 2.6 Elementos   -->
            <div id="tabla_elementos" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.6 Identifica los elementos dañados</h4>
                <p>Infraestructura que complementa las áreas comunes del plantel facilitando su operación accesible y funcional.</p>
                <div style="margin-bottom: 10px;">
                    <span style="display: inline-block; background-color: #c0392b; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Grave
                    </span> Afectación estructural que representa un riesgo para la integridad de la comunidad educativa (colapso, grietas o fisuras).
                    <br><span style="display: inline-block; background-color: #e67e22; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 10px;">
                        Moderado
                    </span> Deterioro funcional que no afecta la operación.
                    <br> <span style="display: inline-block; background-color: #f1c40f; color: black; padding: 5px 10px; border-radius: 5px;">
                        Leve
                    </span> Evidencia que muestra la naturaleza del siniestro, sin consecuencia grave o moderada.
                </div>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Elementos</th>
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
            <!-- 3. Breve descripción del siniestro -->
            <div class="mt-4">
                <h4 class="mb-3" style="color: #691C32;">3. Descripción</h4>
                <label for="descripcion_siniestro" class="form-label ">Escribe brevemente el siniestro <span class="text-muted">(máx. 400 caracteres)</span></label>
                <textarea id="descripcion_siniestro" name="descripcion" class="form-control" maxlength="400" rows="4" oninput="contarCaracteres(this)" required></textarea>
                <small id="contadorCaracteres" class="form-text text-muted">400 caracteres restantes</small>
            </div>
            <div class="text-center mt-4">
                <!-- Botones de envío y descarga dentro de un contenedor -->
                <div id="contenedorBotones">
                    <button type="submit" id="btnEnviarAlerta" class="btn btn-success" style="background-color: #691C32; border-color: #691C32;">
                        <i class=" fas fa-paper-plane me-1"></i> Enviar alerta
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>


<!-- Script de validación y navegación de secciones eliminado -->

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
            const cct = "<?= $_SESSION['cct'] ?? '' ?>";
            const fecha_siniestro = new Date().toISOString();
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
        // Validar que al menos un tipo de siniestro esté seleccionado
        const tipoSiniestroCheckboxes = document.querySelectorAll('input[name="tipo_siniestro[]"]');
        let checkedTipoSiniestro = false;
        tipoSiniestroCheckboxes.forEach(chk => {
            if (chk.checked) checkedTipoSiniestro = true;
        });
        if (!checkedTipoSiniestro) {
            errores.push('1. Tipo de siniestro');
        }

        // Validación de 1.1 ¿Se activó algún protocolo de ayuda?
        const atencionOficialRadios = document.querySelectorAll('input[name="atencion_oficial"]');
        let checkedAtencion = false;
        atencionOficialRadios.forEach(radio => {
            if (radio.checked) checkedAtencion = true;
        });
        if (!checkedAtencion) {
            errores.push('1.1 ¿Se activó algún protocolo de ayuda?');
        }

        // Validación: al menos una opción seleccionada entre 2.1 a 2.6 (campos con clase .mapa-dano)
        // Consideramos seleccionados si algún select de tipo de daño (en cualquier sección 2.1 a 2.6) tiene un valor distinto de vacío
        const selectsTipoDanio = document.querySelectorAll(
            "#tabla_areas_principales select[name*='[tipo]'],\
            #tabla_areas_adicionales select[name*='[tipo]'],\
            #tabla_areas_comunes select[name*='[tipo]'],\
            #tabla_mobiliario select[name*='[tipo]'],\
            #tabla_equipo select[name*='[tipo]'],\
            #tabla_elementos select[name*='[tipo]']"
        );
        let algunMapaDanioSeleccionado = false;
        selectsTipoDanio.forEach(sel => {
            if (sel.value && sel.value !== '') {
                algunMapaDanioSeleccionado = true;
            }
        });
        if (!algunMapaDanioSeleccionado) {
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Debes seleccionar al menos una opción en el apartado II. Mapa de Daños.',
                confirmButtonColor: '#f8bb86'
            });
            return;
        }

        const secciones = [{
                id: 'tabla_areas_principales',
                nombre: '2.1 Áreas principales'
            },
            {
                id: 'tabla_areas_adicionales',
                nombre: '2.2 Áreas adicionales'
            },
            {
                id: 'tabla_areas_comunes',
                nombre: '2.3 Áreas comunes'
            },
            {
                id: 'tabla_mobiliario',
                nombre: '2.4 Mobiliario'
            },
            {
                id: 'tabla_equipo',
                nombre: '2.5 Equipo'
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
            if (errores[0] === '1. Tipo de siniestro') {
                // Scroll to tipo de siniestro
                const tipoDiv = document.querySelector('label.form-label');
                if (tipoDiv) {
                    tipoDiv.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            } else {
                const idPrimera = secciones.find(s => errores[0].includes(s.nombre))?.id;
                if (idPrimera) {
                    const sectionDiv = document.getElementById(idPrimera);
                    if (sectionDiv) {
                        sectionDiv.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
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
                    // Desactivar el botón de enviar y mostrar mensaje
                    const btnEnviar = document.getElementById("btnEnviarAlerta");
                    if (btnEnviar) btnEnviar.style.display = "none";

                    // Crear mensaje de éxito y botón para descargar
                    const contenedorBotones = document.getElementById("contenedorBotones");
                    if (contenedorBotones) {
                        const mensaje = document.createElement("p");
                        mensaje.innerText = "Reporte enviado correctamente.";
                        mensaje.style.color = "#28a745";
                        mensaje.style.fontWeight = "bold";
                        mensaje.style.marginTop = "1rem";

                        const btnDescargar = document.createElement("button");
                        btnDescargar.innerText = "Descargar Reporte";
                        btnDescargar.className = "btn btn-warning";
                        btnDescargar.style.marginTop = "1rem";
                        const idInsertado = data.id_reporte;
                        btnDescargar.onclick = () => {
                            window.open(`views/ver_reporte.php?id=${idInsertado}`, "_self");
                        };

                        contenedorBotones.appendChild(mensaje);
                        contenedorBotones.appendChild(btnDescargar);
                    }

                    // SweetAlert y redirección automática
                    const idInsertado = data.id_reporte;
                    Swal.fire({
                        icon: "success",
                        title: "Reporte enviado",
                        text: "Puedes descargar el reporte en PDF",
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.open(`views/ver_reporte.php?id=${idInsertado}`, "_self");
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


<!-- Eliminada navegación circular de secciones con barra de pasos -->

<script>
    // Inicialización de tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<!-- Tootltip -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<!-- // Contador de caracteres para descripción del siniestro -->
</script>
<script>
    function contarCaracteres(textarea) {
        const max = 400;
        const contador = document.getElementById('contadorCaracteres');
        const restante = max - textarea.value.length;
        contador.textContent = `${restante} caracteres restantes`;
    }
</script>