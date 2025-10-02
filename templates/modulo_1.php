<div class="tab-pane" id="progress-personal-info">
    <form id="form-modulo-1" class="needs-validation" novalidate>
        <div class="card-header mb-4">
            <h4 class="card-title" style="color:#611232; font-size: 22px; font-weight:bold;">
                I. DATOS DEL CENTRO DE TRABAJO
            </h4>
        </div>


        <!-- CCT asociado -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label">1. ¿El Centro de Trabajo cuenta con un CCT asociado a otro turno?<span class="text-danger">*</span></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="cct-yes" name="cct_asociado" value="si" onclick="toggleOptions(true)" required>
                    <label class="form-check-label" for="cct-yes">Sí</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="cct-no" name="cct_asociado" value="no" onclick="toggleOptions(false)" checked>
                    <label class="form-check-label" for="cct-no">No</label>
                </div>
            </div>
        </div>

        <!-- Turnos asociados -->
        <div class="row mb-3" id="options" style="display:none;">
            <div class="col-md-12">
                <label class="form-label">1.1 Turno <span class="text-muted">(selecciona uno o varios)</span>:</label>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="turnos_asociados[]" value="Matutino"><label class="form-check-label">Matutino 8:00 a 12:30</label></div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="turnos_asociados[]" value="Vespertino"><label class="form-check-label">Vespertino 14:00 a 16:30</label></div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="turnos_asociados[]" value="Nocturno"><label class="form-check-label">Nocturno 19:00 a 21:00</label></div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="turnos_asociados[]" value="Jornada Ampliada"><label class="form-check-label">Jornada ampliada 8:00 a 14:30</label></div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="turnos_asociados[]" value="Continuo"><label class="form-check-label">Continuo 8:00 a 16:00</label></div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="turnos_asociados[]" value="Discontinuo"><label class="form-check-label">Discontinuo (2 turnos mismo día)</label></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nombre del plantel -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nombre del plantel:<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="nombre_plantel" required>
                <div class="invalid-feedback">Ingrese el nombre del plantel.</div>
            </div>
        </div>

        <!-- Domicilio -->
        <div class="row mb-2">
            <div class="col-12"><label class="form-label">Domicilio:</label></div>
            <div class="col-md-4 mb-2">
                <label class="form-label">Calle:<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" placeholder="Ingresa Calle" name="calle" required>
                <div class="invalid-feedback">Ingrese la calle.</div>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-label">No. Int:<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" placeholder="No. Int" name="n_int" required>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-label">No. Ext:<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" placeholder="No. Ext" name="n_ext" required>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label">Entidad:<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" placeholder="Entidad federativa" name="entidad" required>
                <div class="invalid-feedback">Ingrese la entidad.</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-2">
                <label class="form-label">Municipio:<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" placeholder="Municipio" name="municipio" required>
                <div class="invalid-feedback">Ingrese el municipio.</div>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Colonia:<span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" placeholder="Colonia" name="colonia" required>
                <div class="invalid-feedback">Ingrese la colonia.</div>
            </div>
        </div>

        <!-- Otros datos -->
        <div class="row mb-3">
            <div class="col-md-2 mb-2">
                <label class="form-label">Número de salones:<span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-sm" placeholder="Ej: 5" name="n_salones" min="0" required>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-label">Número de alumnos:<span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-sm" placeholder="Ej: 30" name="n_alumnos" min="0" required>
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">Nivel escolar:<span class="text-danger">*</span></label>
                <select class="form-select form-select-sm" name="nivel_escolar" required>
                    <option value="">Nivel escolar</option>
                    <option>Inicial</option>
                    <option>Preescolar</option>
                    <option>Primaria</option>
                    <option>Secundaria</option>
                    <option>Bachillerato</option>
                    <option>Licenciatura</option>
                    <option>Posgrado</option>
                </select>
                <div class="invalid-feedback">Seleccione el nivel escolar.</div>
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">Turno:<span class="text-danger">*</span></label>
                <select class="form-select form-select-sm" name="turno" required>
                    <option value="">Turno</option>
                    <option>Continuo 8:00 a 16:00</option>
                    <option>Discontinuo 2 turnos</option>
                    <option>Jornada ampliada 8:00 a 14:30</option>
                    <option>Matutino 8:00 a 12:30</option>
                    <option>Nocturno 19:00 a 21:00</option>
                    <option>Vespertino 14:00 a 16:30</option>
                </select>
                <div class="invalid-feedback">Seleccione el turno.</div>
            </div>
        </div>

        <!-- Antigüedad -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">1.2 Antigüedad aproximada del inmueble:<span class="text-danger">*</span></label>
                <select class="form-select form-select-sm" name="antiguedad_inmueble" required>
                    <option value="">Seleccione</option>
                    <option value="10">0 a 10 años</option>
                    <option value="20">11 a 20 años</option>
                    <option value="30">21 a 30 años</option>
                    <option value="40">31 a 40 años</option>
                    <option value="50">41 a 50 años</option>
                    <option value="51">Más de 51 años</option>
                </select>
                <div class="invalid-feedback">Seleccione la antigüedad del inmueble.</div>
            </div>
            <div class="col-md-4 d-flex align-items-end pt-2"> <!-- Mantiene alineación -->
                <label class="btn btn-evidencia w-100">
                    Agregar evidencia
                    <input type="file" class="evidencia-input" data-modulo="1" style="display:none;">
                </label>
            </div>
        </div>

        <!-- Catalogación -->
        <div class="row mb-3">
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
                    <!-- Columna 2: Radios estilo Bootstrap -->
                    <div class="col-md-6">
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="catalogado-checkbox" name="catalogado" value="SI" required>
                                <label class="form-check-label" for="catalogado-checkbox">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="no-catalogado-checkbox" name="catalogado" value="NO">
                                <label class="form-check-label" for="no-catalogado-checkbox">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fila 2 -->
                <div class="row align-items-center" id="fila-opciones" style="display:none;">
                    <!-- Columna 1: Select -->
                    <div class="col-md-4">
                        <select id="opcionarqueolo-select" class="form-control" name="opcion_arqueolo" style="display:none;">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="INBAL">INBAL</option>
                            <option value="INAH">INAH</option>
                            <option value="AMBOS">AMBOS</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center pt-2">
                            <label class="btn btn-evidencia w-100" id="toggle-dropzone" style="margin-left: 0px; display:none;">
                                Agregar evidencia
                                <input type="file" class="evidencia-input" data-modulo="1" style="display:none;">
                            </label>
                        </div>
                        <div id="dropzone-container" style="display:none;">
                            <div class="dropzone" id="myDropzone">
                                <small class="form-text text-muted">Arrastre y suelte la imagen aquí o haga clic para seleccionar</small>
                                <div class="fallback">
                                    <input type="file" name="file" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <!-- Guardar -->
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success" form="form-modulo-1">
                Guardar Módulo 1 <i class="fas fa-save"></i>
            </button>
        </div>
    </form>
</div>




<script>
    function toggleOptions(isVisible) {
        const optionsDiv = document.getElementById('options');
        optionsDiv.style.display = isVisible ? 'block' : 'none';
        if (!isVisible) {
            // Limpiar selecciones de turnos si se oculta
            document.querySelectorAll('input[name="turnos_asociados[]"]').forEach(cb => cb.checked = false);
        }
    }
</script>

<!-- Script -->
<script>
    const catalogadoCheckbox = document.getElementById('catalogado-checkbox');
    const noCatalogadoCheckbox = document.getElementById('no-catalogado-checkbox');
    const filaOpciones = document.getElementById('fila-opciones');
    const dropzoneContainer = document.getElementById('dropzone-container');
    const toggleDropzoneBtn = document.getElementById('toggle-dropzone');
    const opcionArqueoloSelect = document.getElementById('opcionarqueolo-select');

    // Evidence button and select are initially hidden (handled by HTML)
    // When "Sí" is selected
    catalogadoCheckbox.addEventListener('change', () => {
        if (catalogadoCheckbox.checked) {
            noCatalogadoCheckbox.checked = false;
            filaOpciones.style.display = 'flex';
            opcionArqueoloSelect.style.display = '';
            toggleDropzoneBtn.style.display = '';
            dropzoneContainer.style.display = 'none';
        }
    });

    // When "No" is selected
    noCatalogadoCheckbox.addEventListener('change', () => {
        if (noCatalogadoCheckbox.checked) {
            catalogadoCheckbox.checked = false;
            filaOpciones.style.display = 'none';
            opcionArqueoloSelect.style.display = 'none';
            toggleDropzoneBtn.style.display = 'none';
            dropzoneContainer.style.display = 'none';
        }
    });

    toggleDropzoneBtn.addEventListener('click', () => {
        dropzoneContainer.style.display =
            dropzoneContainer.style.display === 'none' ? 'block' : 'none';
    });
</script>

<script>
    if (window.Dropzone) {
        Dropzone.autoDiscover = false;
    }
</script>


<!-- Uppercase conversion for nombre_plantel, calle, colonia -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Helper to force uppercase on input fields
        function enforceUppercase(input) {
            input.addEventListener('input', function() {
                // Only update if value is not already uppercase to avoid moving cursor
                if (this.value !== this.value.toUpperCase()) {
                    this.value = this.value.toUpperCase();
                }
            });
        }
        // Get the inputs by name
        const nombrePlantel = document.querySelector('input[name="nombre_plantel"]');
        const calle = document.querySelector('input[name="calle"]');
        const colonia = document.querySelector('input[name="colonia"]');
        if (nombrePlantel) enforceUppercase(nombrePlantel);
        if (calle) enforceUppercase(calle);
        if (colonia) enforceUppercase(colonia);
    });
</script>

<!-- ENvía Módulo 1 -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form-modulo-1');
        if (!form) return; // Ensure form exists before attaching listener

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Activar estilos de validación de Bootstrap
            form.classList.add('was-validated');

            // --- Custom validation for CCT asociado and turnos asociados ---
            // 1. Get value of radios cct_asociado
            const cctAsociadoRadios = form.querySelectorAll('input[name="cct_asociado"]');
            let cctAsociadoValue = null;
            cctAsociadoRadios.forEach(radio => {
                if (radio.checked) cctAsociadoValue = radio.value;
            });
            if (cctAsociadoValue === 'si') {
                // 2. If "si" is selected, check if at least one checkbox in turnos_asociados[] is checked
                const turnosChecked = form.querySelectorAll('input[name="turnos_asociados[]"]:checked');
                if (turnosChecked.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo obligatorio',
                        text: 'Debe seleccionar al menos un turno asociado cuando el CCT está asociado a otro turno.'
                    });
                    return;
                }
            }
            // --- End custom validation ---

            // --- Enhanced validation & UI feedback for catalogado ---
            // Get radio buttons and select
            const catalogadoRadios = form.querySelectorAll('input[name="catalogado"]');
            const catalogadoCheckbox = document.getElementById('catalogado-checkbox');
            const noCatalogadoCheckbox = document.getElementById('no-catalogado-checkbox');
            const opcionSelect = document.getElementById('opcionarqueolo-select');

            let catalogadoValue = null;
            catalogadoRadios.forEach(radio => {
                if (radio.checked) catalogadoValue = radio.value;
            });

            // Remove manual border styling and use Bootstrap validation classes
            // If no radio selected, show alert and stop
            if (!catalogadoValue) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campo obligatorio',
                    text: 'Debe seleccionar si el inmueble está catalogado.'
                });
                return;
            }

            // If "SI" is selected, ensure opcionarqueolo-select has a value
            if (catalogadoValue === "SI") {
                if (!opcionSelect || !opcionSelect.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo obligatorio',
                        text: 'Debe seleccionar una opción de catalogación (INBAL, INAH o AMBOS).'
                    });
                    return;
                }
            }
            // --- End enhanced validation ---

            if (!form.checkValidity()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos incompletos',
                    text: 'Por favor complete todos los campos obligatorios antes de continuar.'
                });
                return;
            }

            const formData = new FormData(form);
            // Agregar id_ficha y cct desde la sesión PHP
            formData.append('id_ficha', "<?= $_SESSION['id_ficha'] ?? '' ?>");
            formData.append('cct', "<?= $_SESSION['cct'] ?? '' ?>");

            try {
                const response = await fetch('../controllers/enviadatos_modulo_1.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result && result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: result.message || 'Los datos se guardaron correctamente.'
                    }).then(() => {
                        const redirectForm = document.createElement('form');
                        redirectForm.method = 'POST';
                        redirectForm.action = 'dashboard';
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'modulo';
                        input.value = '2';
                        redirectForm.appendChild(input);
                        document.body.appendChild(redirectForm);
                        redirectForm.submit();
                    });
                    form.reset();
                    form.classList.remove('was-validated');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: (result && result.message) ? result.message : 'Hubo un problema al guardar los datos.'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo contactar al servidor. Intenta nuevamente.'
                });
            }
        });
    });
</script>