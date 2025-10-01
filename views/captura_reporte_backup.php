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

<!-- Nueva barra de navegación circular con tooltips e íconos -->
<ul class="twitter-bs-wizard-nav nav nav-pills nav-justified" style="margin-top: 100px; z-index: 999; position: relative;" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link active" data-toggle="tab" aria-selected="true" role="tab" onclick="mostrarSeccion(1)">
            <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="I. Descripción del Centro de Trabajo">I</div>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link" data-toggle="tab" aria-selected="false" role="tab" onclick="mostrarSeccion(2)">
            <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="II. Mapa de daños">II</div>
        </a>
    </li>
</ul>

<form id="formReporte" enctype="multipart/form-data">
    <!-- Sección I -->
    <div id="seccion1">
        <h2 class="text-left my-5 mb-4" style="color: #691C32;">I. Descripción del Centro de Trabajo</h2>
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

        <div class="mb-4">
            <label class="form-label">1.2 Tipo de siniestro (elige uno)</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="list-group">
                        <label class="list-group-item d-flex gap-2">
                            <input class="form-check-input flex-shrink-0" type="radio" name="tipo_siniestro" id="tipo_siniestro_geologico" value="geológico" checked>
                            <span>
                                Geológico
                                <small class="d-block text-body-secondary">Socavones, hundimientos, deslizamientos de tierra, actividad volcánica.</small>
                            </span>
                        </label>
                        <label class="list-group-item d-flex gap-2">
                            <input class="form-check-input flex-shrink-0" type="radio" name="tipo_siniestro" id="tipo_siniestro_hidrometeorológico" value="hidrometeorológico">
                            <span>
                                Hidrometeorológico
                                <small class="d-block text-body-secondary">Huracanes, lluvias intensas, inundaciones, granizadas, nevadas atípicas, desbordamientos, vientos fuertes.</small>
                            </span>
                        </label>
                        <label class="list-group-item d-flex gap-2">
                            <input class="form-check-input flex-shrink-0" type="radio" name="tipo_siniestro" id="tipo_siniestro_incendio" value="incendio">
                            <span>
                                Incendio
                                <small class="d-block text-body-secondary">Incendios forestales.</small>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list-group">
                        <label class="list-group-item d-flex gap-2">
                            <input class="form-check-input flex-shrink-0" type="radio" name="tipo_siniestro" id="tipo_siniestro_sismico" value="sísmico">
                            <span>
                                Sísmico
                                <small class="d-block text-body-secondary">Temblores, micro-sismos, sismos, terremotos.</small>
                            </span>
                        </label>
                        <label class="list-group-item d-flex gap-2">
                            <input class="form-check-input flex-shrink-0" type="radio" name="tipo_siniestro" id="tipo_siniestro_social" value="social">
                            <span>
                                Social
                                <small class="d-block text-body-secondary">Vandalismo, robo, toma de planteles, invasiones, disturbios comunitarios.</small>
                            </span>
                        </label>
                        <label class="list-group-item d-flex gap-2">
                            <input class="form-check-input flex-shrink-0" type="radio" name="tipo_siniestro" id="tipo_siniestro_tecnologico" value="tecnológico">
                            <span>
                                Tecnológico
                                <small class="d-block text-body-secondary">Explosiones, cortocircuitos, fugas de gas, colapsos por falla estructural, derrames de materiales peligrosos.</small>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nivel_atencion" class="form-label">1.3 Nivel de atención oficial</label>
                <select name="nivel_atencion[]" id="nivel_atencion" class="form-select" multiple required>
                    <option value="ninguna">Sin atención</option>
                    <option value="municipal">Atención Municipal</option>
                    <option value="estatal">Atención Estatal</option>
                    <option value="sedena">Plan DN-III-E (SEDENA)</option>
                    <option value="marina">Plan Marina (SEMAR)</option>
                    <option value="gna">Plan GN-A (Guardia Nacional)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="brigadas" class="form-label">1.4 Brigadas activadas</label>
                <select name="brigadas[]" id="brigadas" class="form-select" multiple required>
                    <option value="multifuncional">Brigada multifuncional</option>
                    <option value="rescate">Búsqueda y rescate</option>
                    <option value="evacuacion">Evacuación</option>
                    <option value="incendios">Incendios</option>
                </select>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="dashboard" class="btn btn-secondary me-2">Cancelar</a>
            <button type="button" id="btnContinuar" class="btn btn-primary" style="background-color: #691C32; border-color: #691C32;" onclick="validarSeccion1()">Continuar</button>
        </div>
    </div>

    <script>
        // Navegación circular de secciones con barra de pasos
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

        document.addEventListener('DOMContentLoaded', function() {
            // (Resto de la lógica de validaciones, inputs y eventos existentes)
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
                document.querySelectorAll('.twitter-bs-wizard-nav .nav-link').forEach((a, idx) => {
                    a.classList.toggle('active', idx === 0);
                });
            });

            // Script corregido para habilitar cantidad y evidencia al seleccionar tipo de daño
            document.addEventListener('change', function(e) {
                if (e.target.matches('select.tipo-danio')) {
                    const row = e.target.closest('tr');
                    if (!row) return;

                    const cantidad = row.querySelector('.cantidad-danio');
                    const evidencia = row.querySelector('.evidencia-input');
                    const label = row.querySelector('label.btn-evidencia');

                    const tipoSeleccionado = e.target.value;

                    const habilitar = tipoSeleccionado !== '';

                    if (cantidad) {
                        cantidad.disabled = !habilitar;
                        if (habilitar && cantidad.hasAttribute('data-original-required')) {
                            cantidad.setAttribute('required', 'true');
                        }
                    }

                    if (evidencia) evidencia.disabled = !habilitar;
                    if (label) label.classList.toggle('disabled-label', !habilitar);
                }
            });

            // Disparar el evento de cambio manualmente en todos los selects de tipo de daño al cargar la página
            document.querySelectorAll('select.tipo-danio').forEach(select => {
                select.dispatchEvent(new Event('change'));
            });




            // --- Script para habilitar/deshabilitar zona, tipo de daño y evidencia según cantidad ---
            // document.querySelectorAll("select.cantidad-danio").forEach(input => {
            //     input.addEventListener('change', function() {
            //         const row = this.closest('tr');
            //         const cantidad = parseInt(this.value);
            //         const zona = row.querySelector('.zona-select');
            //         const tipo = row.querySelector("select[name*='[tipo]']");
            //         const evidencia = row.querySelector("input[type='file']");
            //         const label = row.querySelector("label.btn-evidencia");

            //         const habilitar = !isNaN(cantidad) && cantidad > 0;

            //         if (zona) zona.disabled = !habilitar;
            //         if (tipo) tipo.disabled = !habilitar;
            //         if (evidencia) evidencia.disabled = !habilitar;
            //         if (label) label.classList.toggle('disabled-label', !habilitar);
            //     });

            //     // Inicializar en carga
            //     input.dispatchEvent(new Event('change'));
            // });




        });
    </script>
    <!-- Inicialización de tooltips Bootstrap para los íconos circulares -->
    <script>
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <!-- Sección II -->
    <div id="seccion2" style="display:none;">
        <h2 class="text-left my-5" style="color: #691C32;">II. Mapa de Daños</h2>

        <!-- <div class="mb-4">
            <label for="cantidad_edificios" class="form-label" style="color:#691C32;"><strong>¿Cuántos edificios tiene el plantel?</strong></label>
            <select id="cantidad_edificios" name="cantidad_edificios" class="form-select" required>
                <option value="">Selecciona...</option>
                <?php for ($i = 1; $i <= 100; $i++): ?>
                    <option value="<?= $i ?>"> <?= $i ?> </option>
                <?php endfor; ?>
            </select>
        </div> -->

        <!-- <div id="tabla_areas_principales" style="display:none;"> -->
        <div id="tabla_areas_principales">
            <h4 class="mb-3" style="color: #691C32;">2.1 Identifique las áreas principales dañados</h4>
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle text-center">
                    <thead style="background-color:#E9E9E9;">
                        <tr>
                            <th style="background-color:#691C32; color:white; font-size: 1.25em;">Área</th>
                            <th style="background-color:#E9E9E9;">Grado de daño</th>
                            <th style="background-color:#E9E9E9;">Cálculo de daño</th>
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
                        <select name='areas_principales[{$area}][tipo]' class='form-select tipo-danio' >
                          <option value=''>Selecciona</option>
                          <option value='leve'>Leve</option>
                          <option value='moderado'>Moderado</option>
                          <option value='grave'>Grave</option>
                        </select>
                      </td>
                      <td><select class='form-select cantidad-danio' name='areas_principales[{$area}][cantidad]' disabled required>
                        <option value=''>Selecciona</option>  ";
                                for ($n = 1; $n <= 100; $n++) {
                                    echo "<option value='$n'>$n</option>";
                                }
                                echo "</select></td>
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





            <!-- quite puntos 2.2 a 2.6  -->






            <div class="text-center mt-4">
                <button type="submit" id="btnEnviarReporte" class="btn btn-primary" style="background-color: #691C32; border-color: #691C32;">📤 Envío de Alerta</button>
            </div>
        </div>
    </div>

</form>

<script>
    // Enviar formulario vía fetch al dar click en Envío de Alerta
    document.getElementById('formReporte').addEventListener('submit', function(e) {
        e.preventDefault();

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
                        title: '¡Reporte guardado!',
                        text: 'El reporte se registró correctamente.'
                    }).then(() => {
                        window.location.href = 'dashboard';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al guardar',
                        text: data.message || 'Ocurrió un error al guardar el reporte.'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de red',
                    text: 'No se pudo conectar con el servidor.'
                });
                console.error(error);
            });
    });
</script>

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

<!-- Bootstrap 5.3 CSS inclusion (ensure it's present in the <head>) -->
<?php /* Si ya está incluido, puedes omitir esta línea. Si no, agregarla en el <head>: */ ?>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->