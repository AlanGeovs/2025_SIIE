<div class="tab-pane" id="progress-payment-details">
    <div>
        <form id="form-modulo-4">

            <div class="card-header">
                <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">IV. PROTECCIÓN CIVIL Y SEGURIDAD ESTRUCTURAL</h4>
            </div>


            <!-- MODULO DE Proteccion Civil -->
            <div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label>4. ¿Se ha realizado alguna verificación de Protección Civil?</label>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="verificacion" value="si" id="verificacion_si" onchange="toggleVerificacion(true)">
                                    <label class="form-check-label" for="verificacion_si">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="verificacion" value="no" id="verificacion_no" onchange="toggleVerificacion(false)">
                                    <label class="form-check-label" for="verificacion_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Contenedor para campos dependientes -->
                        <div id="verificacion-detalle" class="mt-3" style="display: none;">
                            <label>En qué fecha</label>
                            <input type="date" class="form-control mt-2" name="fecha_verificacion">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="organismo-detalle" class="mt-3" style="display: none;">
                            <label>Qué organismo la realizó</label>
                            <select class="form-select mt-2" name="organismo_verificador">
                                <option value="">Selecciona una opción</option>
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
                    <div class="col-md-6">
                        <label>4.1 ¿El Centro de Trabajo cuenta con un Programa Interno de Protección Civil?</label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="programa" id="programa_si" value="si" onchange="togglePrograma(true)">
                                <label class="form-check-label" for="programa_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="programa" id="programa_no" value="no" onchange="togglePrograma(false)">
                                <label class="form-check-label" for="programa_no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- Formato + Evidencia -->
                    <div class="col-md-6" id="formato-programa-container" style="display: none;">
                        <label>¿En qué formato está disponible?</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-select mt-2">
                                    <option value="">Selecciona una opción</option>
                                    <option value="digital">Digital</option>
                                    <option value="fisico">Físico</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-2 mt-md-0">
                                <label class="btn btn-evidencia w-100 mt-2 mt-md-0">
                                    Agregar evidencia
                                    <input type="file" class="evidencia-input" data-modulo="4-programa" style="display:none;">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4.1.1 Documentos que acompañan al Programa Interno -->
                <div class="row mt-3" id="documentos-programa-container" style="display: none;">
                    <div class="col-md-12">
                        <label>4.1.1 Documentos que acompañan al Programa Interno</label>
                        <span style="color: #8f9092;">(selecciona la o las opciones)</span>:
                        <div id="documentos-grid" class="mt-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 10px;"></div>
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
<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" id="${id}" name="documentos_programa[]" value="${doc}">
<label class="form-check-label" for="${id}">${doc}</label>
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
                    <div class="col-12">
                        <label>4.1.2 ¿Cuenta con elementos de protección civil?</label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="elementos_pc" id="elementos_pc_si" value="si" onchange="toggleTablaElementosPC(true)">
                                <label class="form-check-label" for="elementos_pc_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="elementos_pc" id="elementos_pc_no" value="no" onchange="toggleTablaElementosPC(false)">
                                <label class="form-check-label" for="elementos_pc_no">No</label>
                            </div>
                        </div>
                        <!-- Tabla de elementos de protección civil -->
                        <div class="table-responsive mt-3" id="tablaElementosProteccionCivilContainer" style="display: none; overflow-x:auto;">
                            <table class="table table-bordered table-sm text-center align-middle w-100">
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
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="pc_existe_${index}" id="pc_existe_si_${index}" value="si" onchange="toggleElementosPCRow(${index}, true)">
        <label class="form-check-label" for="pc_existe_si_${index}">Sí</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="pc_existe_${index}" id="pc_existe_no_${index}" value="no" onchange="toggleElementosPCRow(${index}, false)">
        <label class="form-check-label" for="pc_existe_no_${index}">No</label>
    </div>
</td>
<td>
    <select class="form-select form-select-sm" name="pc_cantidad_${index}" disabled>
        <option value="">Selecciona una opción</option>
        ${[...Array(10)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("")}
    </select>
</td>
<td>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="pc_enuso_${index}" id="pc_enuso_si_${index}" value="si" disabled>
        <label class="form-check-label" for="pc_enuso_si_${index}">Sí</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="pc_enuso_${index}" id="pc_enuso_no_${index}" value="no" disabled>
        <label class="form-check-label" for="pc_enuso_no_${index}">No</label>
    </div>
</td>
<td>
    <select class="form-select form-select-sm" name="pc_condicion_${index}" disabled>
        <option value="">Selecciona una opción</option>
        <option value="bueno">Buena</option>
        <option value="regular">Regular</option>
        <option value="malo">Mala</option>
    </select>
</td>
<td>
    <label class="btn btn-evidencia w-100" id="pc_evidencia_${index}">
        Agregar evidencia
        <input type="file" class="evidencia-input" data-modulo="4-pc_${index}" style="display:none;" disabled>
    </label>
</td>
</tr>
`;
                                tbody.insertAdjacentHTML("beforeend", fila);
                            });
                        }
                    }
                    // Nueva función para habilitar/deshabilitar los campos de la fila de elementos de protección civil
                    function toggleElementosPCRow(index, enable) {
                        // Cantidad select
                        const cantidad = document.querySelector(`select[name="pc_cantidad_${index}"]`);
                        if (cantidad) cantidad.disabled = !enable;
                        // En uso radios
                        const enuso = document.querySelectorAll(`input[name="pc_enuso_${index}"]`);
                        enuso.forEach(radio => {
                            radio.disabled = !enable;
                            if (!enable) radio.checked = false;
                        });
                        // Condición select
                        const condicion = document.querySelector(`select[name="pc_condicion_${index}"]`);
                        // Por defecto, deshabilitar Condición
                        if (condicion) condicion.disabled = true;
                        // Evidencia button
                        const evidenciaBtn = document.getElementById(`pc_evidencia_${index}`);
                        if (evidenciaBtn) evidenciaBtn.disabled = !enable;

                        // Si se habilitan los radios de En uso, añadir event listeners para controlar Condición
                        if (enable) {
                            // Al cambiar el radio de En uso, habilitar/deshabilitar Condición
                            const enUsoSi = document.getElementById(`pc_enuso_si_${index}`);
                            const enUsoNo = document.getElementById(`pc_enuso_no_${index}`);
                            // Quitar listeners previos si existen
                            if (enUsoSi) enUsoSi.onchange = null;
                            if (enUsoNo) enUsoNo.onchange = null;

                            function handleEnUsoChange() {
                                if (enUsoSi && enUsoSi.checked) {
                                    if (condicion) condicion.disabled = false;
                                } else {
                                    if (condicion) {
                                        condicion.disabled = true;
                                        condicion.value = "";
                                    }
                                }
                            }
                            if (enUsoSi) enUsoSi.addEventListener('change', handleEnUsoChange);
                            if (enUsoNo) enUsoNo.addEventListener('change', handleEnUsoChange);
                            // Lógica inicial: si ya está seleccionado "sí" en En uso, habilita condición
                            handleEnUsoChange();
                        } else {
                            // Si deshabilitamos toda la fila, asegurarnos que Condición está deshabilitado y limpio
                            if (condicion) {
                                condicion.disabled = true;
                                condicion.value = "";
                            }
                        }
                    }
                </script>



                <hr>

                <!-- Datos del responsable de protección civil interno -->
                <div class="col-md-12">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label>4.2 Datos del responsable de Protección Civil Interno:</label>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="progresspill-firstname-input">Nombre <span style="color: red">*</span></label>
                            <input type="text"
                                class="form-control"
                                id="progresspill-firstname-input"
                                placeholder="Ejemplo: Juan"
                                required />
                        </div>
                        <div class="col-md-4">
                            <label for="progresspill-lastname-input">Apellido paterno <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="progresspill-lastname-input" placeholder="Ejemplo: Flores" required />
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <label for="progresspill-phoneno-input">Teléfono fijo: <span style="color: red">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                id="progresspill-phoneno-input"
                                placeholder="Ejemplo: 55 4587 4458" />
                        </div>
                        <div class="col-md-4">
                            <label for="progresspill-email-input">Teléfono móvil:<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="progresspill-email-input" placeholder="Ejemplo: 311 1003" />
                        </div>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-12">
                        <label>4.2.1 ¿El responsable de Protección Civil Interno tiene algún tipo de capacitación?</label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="capacitacion_responsable" id="capacitacion_responsable_si" value="si" onclick="toggleCapacitacion(true)">
                                <label class="form-check-label" for="capacitacion_responsable_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="capacitacion_responsable" id="capacitacion_responsable_no" value="no" onclick="toggleCapacitacion(false)">
                                <label class="form-check-label" for="capacitacion_responsable_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Select oculto inicialmente -->
                <div class="row mt-2" id="capacitacion-select-container" style="display: none;">
                    <div class="col-md-6">
                        <label for="capacitacion_tipo">Tipo de capacitación:</label>
                        <select id="capacitacion_tipo" class="form-select">
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

                    <div class="row mt-3">

                        <!-- 4.3 Tipo de brigadas organizadas -->
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-12">
                                <label>4.3 Tipo de brigadas organizadas</label>
                                <span style="color: #8f9092;">(selecciona la o las opciones)</span>

                                <div class="mt-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 10px;">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="brigada-multifuncional" name="brigadas[]" value="Brigada multifuncional">
                                        <label class="form-check-label" for="brigada-multifuncional">Brigada multifuncional</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="brigada-rescate" name="brigadas[]" value="Búsqueda y rescate">
                                        <label class="form-check-label" for="brigada-rescate">Búsqueda y rescate</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="brigada-evacuacion" name="brigadas[]" value="Evacuación">
                                        <label class="form-check-label" for="brigada-evacuacion">Evacuación</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="brigada-incendios" name="brigadas[]" value="Incendios">
                                        <label class="form-check-label" for="brigada-incendios">Incendios</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="brigada-primeros-auxilios" name="brigadas[]" value="Primeros auxilios">
                                        <label class="form-check-label" for="brigada-primeros-auxilios">Primeros auxilios</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>






                    <hr>




                    <!-- 4.4 tipo de señalamientos -->
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label>4.4 Tipo de señalamientos</label><br>
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

                        // Nueva función para tabla 4.4: igual que tablaElementosProteccionCivil
                        function toggleTablaSenalamientos(show) {
                            const contenedor = document.getElementById("tablaSenalamientosContainer");
                            const tbody = document.getElementById("tablaSenalamientos");

                            tbody.innerHTML = ""; // Limpiar contenido previo
                            contenedor.style.display = show ? "block" : "none";

                            if (show) {
                                senalamientos.forEach((tipo, index) => {
                                    const fila = `
<tr>
<td class="text-start">${tipo}</td>
<td>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="senalamiento_existe_${index}" id="senalamiento_existe_si_${index}" value="si" onchange="toggleSenalamientosRow(${index}, true)">
        <label class="form-check-label" for="senalamiento_existe_si_${index}">Sí</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="senalamiento_existe_${index}" id="senalamiento_existe_no_${index}" value="no" onchange="toggleSenalamientosRow(${index}, false)">
        <label class="form-check-label" for="senalamiento_existe_no_${index}">No</label>
    </div>
</td>
<td>
    <select class="form-select form-select-sm" name="senalamiento_cantidad_${index}" disabled>
        <option value="">Selecciona una opción</option>
        ${[...Array(10)].map((_, i) => `<option value="${i + 1}">${i + 1}</option>`).join("")}
    </select>
</td>
<td>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="senalamiento_enuso_${index}" id="senalamiento_enuso_si_${index}" value="si" disabled>
        <label class="form-check-label" for="senalamiento_enuso_si_${index}">Sí</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="senalamiento_enuso_${index}" id="senalamiento_enuso_no_${index}" value="no" disabled>
        <label class="form-check-label" for="senalamiento_enuso_no_${index}">No</label>
    </div>
</td>
<td>
    <select class="form-select form-select-sm" name="senalamiento_condicion_${index}" disabled>
        <option value="">Selecciona una opción</option>
        <option value="bueno">Buena</option>
        <option value="regular">Regular</option>
        <option value="malo">Mala</option>
    </select>
</td>
<td>
    <label class="btn btn-evidencia w-100" id="senalamiento_evidencia_${index}">
        Agregar evidencia
        <input type="file" class="evidencia-input" data-modulo="4-senalamiento_${index}" style="display:none;" disabled>
    </label>
</td>
</tr>
`;
                                    tbody.insertAdjacentHTML("beforeend", fila);
                                });
                            }
                        }

                        // Lógica de habilitar/deshabilitar campos de cada fila de señalamientos (igual a toggleElementosPCRow)
                        function toggleSenalamientosRow(index, enable) {
                            // Cantidad select
                            const cantidad = document.querySelector(`select[name="senalamiento_cantidad_${index}"]`);
                            if (cantidad) cantidad.disabled = !enable;
                            // En uso radios
                            const enuso = document.querySelectorAll(`input[name="senalamiento_enuso_${index}"]`);
                            enuso.forEach(radio => {
                                radio.disabled = !enable;
                                if (!enable) radio.checked = false;
                            });
                            // Condición select
                            const condicion = document.querySelector(`select[name="senalamiento_condicion_${index}"]`);
                            // Por defecto, deshabilitar Condición
                            if (condicion) condicion.disabled = true;
                            // Evidencia button
                            const evidenciaBtn = document.getElementById(`senalamiento_evidencia_${index}`);
                            if (evidenciaBtn) evidenciaBtn.disabled = !enable;

                            // Si se habilitan los radios de En uso, añadir event listeners para controlar Condición
                            if (enable) {
                                // Al cambiar el radio de En uso, habilitar/deshabilitar Condición
                                const enUsoSi = document.getElementById(`senalamiento_enuso_si_${index}`);
                                const enUsoNo = document.getElementById(`senalamiento_enuso_no_${index}`);
                                // Quitar listeners previos si existen
                                if (enUsoSi) enUsoSi.onchange = null;
                                if (enUsoNo) enUsoNo.onchange = null;

                                function handleEnUsoChange() {
                                    if (enUsoSi && enUsoSi.checked) {
                                        if (condicion) condicion.disabled = false;
                                    } else {
                                        if (condicion) {
                                            condicion.disabled = true;
                                            condicion.value = "";
                                        }
                                    }
                                }
                                if (enUsoSi) enUsoSi.addEventListener('change', handleEnUsoChange);
                                if (enUsoNo) enUsoNo.addEventListener('change', handleEnUsoChange);
                                // Lógica inicial: si ya está seleccionado "sí" en En uso, habilita condición
                                handleEnUsoChange();
                            } else {
                                // Si deshabilitamos toda la fila, asegurarnos que Condición está deshabilitado y limpio
                                if (condicion) {
                                    condicion.disabled = true;
                                    condicion.value = "";
                                }
                            }
                        }

                        // Inicializar tabla (mostrarla siempre como la de elementos pc)
                        toggleTablaSenalamientos(true);
                    </script>


                    <!-- 4.4.1 ¿Simulacros? -->
                    <div class="row mt-3 mb-3">
                        <div class="col-lg-6">
                            <label>4.4.1 ¿Se realizan simulacros en el plantel?</label><br>
                            <input type="radio" name="simulacros" value="si" onchange="toggleSimulacros(true)"> Sí
                            <input type="radio" name="simulacros" value="no" onchange="toggleSimulacros(false)"> No
                        </div>
                    </div>

                    <!-- Opciones de periodicidad en formato de grid -->
                    <div class="row mt-3 mb-3" id="gridSimulacrosContainer" style="display: none;">
                        <div class="col-lg-12">
                            <label>4.4.1.1 Periodicidad de simulacros</label>
                            <span style="color: #8f9092;">(selecciona la opción)</span>
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
                            <label>4.5 ¿Se lleva un registro o bitácora de mantenimiento?</label><br>
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
                            <label class="btn btn-evidencia w-100">
                                Agregar evidencia
                                <input type="file" class="evidencia-input" data-modulo="4-bitacora" style="display:none;">
                            </label>
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
                            <label>4.6 ¿Cuenta con algún programa especial de seguridad?</label> <span style="color: red;">*</span><br>
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
<label>
  <input type="radio" name="programa_${index}" value="si" onchange="toggleProgramasSeguridadRow(${index}, true)"> Sí
</label>
<label class="ms-2">
  <input type="radio" name="programa_${index}" value="no" onchange="toggleProgramasSeguridadRow(${index}, false)"> No
</label>
</td>
<td>
<label class="btn btn-evidencia w-100" id="programa_seguridad_evidencia_${index}" style="border: 1px solid #aaa; color: #888; background: none;">
    Agregar evidencia
    <input type="file" class="evidencia-input" data-modulo="4-programa_seguridad_${index}" style="display:none;" disabled>
</label>
</td>
</tr>
`;
                                    tbody.insertAdjacentHTML("beforeend", fila);
                                });
                            }
                        }

                        // Nueva función similar a toggleSenalamientosRow
                        function toggleProgramasSeguridadRow(index, enable) {
                            const btn = document.getElementById(`programa_seguridad_evidencia_${index}`);
                            if (!btn) return;
                            if (enable) {
                                btn.disabled = false;
                                btn.classList.add("btn-evidencia");
                                btn.classList.remove("btn-secondary");
                                btn.style.border = "";
                                btn.style.color = "";
                                btn.style.background = "";
                            } else {
                                btn.disabled = true;
                                btn.classList.remove("btn-evidencia");
                                btn.classList.remove("btn-secondary");
                                btn.style.border = "1px solid #aaa";
                                btn.style.color = "#888";
                                btn.style.background = "none";
                            }
                        }
                    </script>
                    <hr>


                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <label>4.7 ¿El inmueble guarda materiales que pueden ser peligrosos?</label><br>
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
<td>
    <label class="btn btn-evidencia w-100" id="material_evidencia_${index}" style="border: 1px solid #aaa; color: #888; background: none;">
        Agregar evidencia
        <input type="file" class="evidencia-input" data-modulo="4-material_${index}" style="display:none;" disabled>
    </label>
</td>
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

                            const evidenciaBtn = document.getElementById(`material_evidencia_${index}`);
                            if (evidenciaBtn) {
                                if (enabled) {
                                    evidenciaBtn.disabled = false;
                                    evidenciaBtn.classList.add("btn-evidencia");
                                    evidenciaBtn.style.border = "";
                                    evidenciaBtn.style.color = "";
                                    evidenciaBtn.style.background = "";
                                } else {
                                    evidenciaBtn.disabled = true;
                                    evidenciaBtn.classList.remove("btn-evidencia");
                                    evidenciaBtn.style.border = "1px solid #aaa";
                                    evidenciaBtn.style.color = "#888";
                                    evidenciaBtn.style.background = "none";
                                }
                            }
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
            <div class="row mt-4">
                <div class="col-md-12">
                    <label>4.8 ¿El Centro de Trabajo cuenta con dictamen de seguridad estructural?</label>
                    <div class="mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dictamen_estructural" id="dictamen_estructural_si" value="si" onchange="toggleDictamen(true)">
                            <label class="form-check-label" for="dictamen_estructural_si">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="dictamen_estructural" id="dictamen_estructural_no" value="no" onchange="toggleDictamen(false)">
                            <label class="form-check-label" for="dictamen_estructural_no">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Campos adicionales dependientes -->
            <div class="row mt-3 align-items-end" id="bloqueDictamen" style="display: none;">
                <div class="col-md-4 mb-3">
                    <label for="fecha_emision">Fecha de emisión</label>
                    <select id="fecha_emision" class="form-select">
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
                <div class="col-md-5 mb-3">
                    <label for="quien_emitio">¿Quién lo emitió?</label>
                    <select id="quien_emitio" class="form-select">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="DRO">Director Responsable de Obra (DRO) acreditado</option>
                        <option value="Instituto_Local">Instituto Local a través de un DRO acreditado</option>
                        <option value="Proteccion_Civil_Municipal">Protección Civil Municipal</option>
                        <option value="Proteccion_Civil_Estatal">Protección Civil Estatal</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="invisible" style="display:block;">Evidencia</label>
                    <label class="btn btn-evidencia w-100">
                        Agregar evidencia
                        <input type="file" class="evidencia-input" data-modulo="4-dictamen" style="display:none;">
                    </label>
                </div>
            </div>

            <!-- Script -->
            <script>
                function toggleDictamen(show) {
                    const bloque = document.getElementById("bloqueDictamen");
                    bloque.style.display = show ? "flex" : "none";
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
            <!-- Eliminado <br> innecesario -->



            <!-- Pregunta 4.8.1 -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <label for="naturales">4.8.1 ¿El Centro de Trabajo cuenta con amenaza o riesgo por condición natural?</label><span style="color: red;">*</span><br>
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
                            // Normalizar el id eliminando acentos y caracteres especiales
                            const id = nombre
                                .normalize("NFD")
                                .replace(/[\u0300-\u036f]/g, "")
                                .toLowerCase()
                                .replace(/[\s()]/g, "_");
                            // Generar fila con select y botón deshabilitados por defecto, radios con onchange
                            const fila = `
<tr>
<td class="text-start">${nombre}</td>
<td>
<label><input type="radio" name="existencia_${id}" value="si" onchange="toggleAmenazaRow(${index}, true, '${id}')"> Sí</label>
<label class="ms-2"><input type="radio" name="existencia_${id}" value="no" onchange="toggleAmenazaRow(${index}, false, '${id}')"> No</label>
</td>
<td>
<select class="form-select form-select-sm" name="ubicacion_${id}" id="ubicacion_${id}" disabled>
<option value="">Selecciona</option>
<option value="edificio_1">Edificio 1</option>
<option value="area_comun_a">Área común "A"</option>
</select>
</td>
<td>
<label class="btn btn-evidencia w-100" id="evidencia_amenaza_${id}" style="border: 1px solid #aaa; color: #888; background: none;">
    Agregar evidencia
    <input type="file" class="evidencia-input" data-modulo="4-amenaza_${id}" style="display:none;" disabled>
</label>
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
                    <label>4.8.2 ¿El Centro de Trabajo cuenta con amenaza o riesgo por causa externa?</label><span style="color: red;">*</span><br>
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
                            // Normalizar el id eliminando acentos y caracteres especiales
                            const id = nombre
                                .normalize("NFD")
                                .replace(/[\u0300-\u036f]/g, "")
                                .toLowerCase()
                                .replace(/[\s()]/g, "_");
                            // Generar fila con select y botón deshabilitados por defecto, radios con onchange
                            const fila = `
<tr> 
<td class="text-start">${nombre}</td> 
<td>
<label><input type="radio" name="existencia_externo_${id}" value="si" onchange="toggleExternoRow(${index}, true, '${id}')"> Sí</label>
<label class="ms-2"><input type="radio" name="existencia_externo_${id}" value="no" onchange="toggleExternoRow(${index}, false, '${id}')"> No</label>
</td>
<td>
<select class="form-select form-select-sm" name="ubicacion_externo_${id}" id="ubicacion_externo_${id}" disabled>
<option value="">Selecciona</option>
<option value="edificio_1">Edificio "1"</option>
<option value="area_comun_a">Área común "A"</option>
</select>
</td>
<td>
<label class="btn btn-evidencia w-100" id="evidencia_externo_${id}" style="border: 1px solid #aaa; color: #888; background: none;">
    Agregar evidencia
    <input type="file" class="evidencia-input" data-modulo="4-externo_${id}" style="display:none;" disabled>
</label>
</td>
</tr>
`;
                            tbody.insertAdjacentHTML("beforeend", fila);
                        });
                    }
                }
            </script>

            <!-- Funciones toggleAmenazaRow y toggleExternoRow -->
            <script>
                // index: para posible uso futuro, id: string identificador único
                function toggleAmenazaRow(index, enabled, id) {
                    // Zona de ubicación (select)
                    const select = document.getElementById(`ubicacion_${id}`);
                    if (select) select.disabled = !enabled;
                    // Evidencia (botón)
                    const btn = document.getElementById(`evidencia_amenaza_${id}`);
                    if (btn) {
                        btn.disabled = !enabled;
                        if (enabled) {
                            btn.classList.add("btn-evidencia");
                            btn.classList.remove("btn-secondary");
                            btn.style.border = "";
                            btn.style.color = "";
                            btn.style.background = "";
                        } else {
                            btn.classList.remove("btn-evidencia");
                            btn.classList.remove("btn-secondary");
                            btn.style.border = "1px solid #aaa";
                            btn.style.color = "#888";
                            btn.style.background = "none";
                        }
                    }
                }

                function toggleExternoRow(index, enabled, id) {
                    // Zona de ubicación (select)
                    const select = document.getElementById(`ubicacion_externo_${id}`);
                    if (select) select.disabled = !enabled;
                    // Evidencia (botón)
                    const btn = document.getElementById(`evidencia_externo_${id}`);
                    if (btn) {
                        btn.disabled = !enabled;
                        if (enabled) {
                            btn.classList.add("btn-evidencia");
                            btn.classList.remove("btn-secondary");
                            btn.style.border = "";
                            btn.style.color = "";
                            btn.style.background = "";
                        } else {
                            btn.classList.remove("btn-evidencia");
                            btn.classList.remove("btn-secondary");
                            btn.style.border = "1px solid #aaa";
                            btn.style.color = "#888";
                            btn.style.background = "none";
                        }
                    }
                }
            </script>







        </form>







        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-success" form="form-modulo-4">
                Guardar Módulo 4 <i class="fas fa-save"></i>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form-modulo-4');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            let valid = true;
            let firstInvalid = null;

            form.querySelectorAll('.is-invalid, .is-valid').forEach(el => {
                el.classList.remove('is-invalid', 'is-valid');
            });

            // Radios
            const radioNames = new Set();
            form.querySelectorAll('input[type="radio"][required]').forEach(radio => {
                radioNames.add(radio.name);
            });
            radioNames.forEach(name => {
                const radios = form.querySelectorAll(`input[type="radio"][name="${name}"]`);
                const checked = form.querySelector(`input[type="radio"][name="${name}"]:checked`);
                radios.forEach(radio => {
                    if (!checked) {
                        radio.classList.add('is-invalid');
                        if (!firstInvalid) firstInvalid = radio;
                        valid = false;
                    } else {
                        radio.classList.add('is-valid');
                    }
                });
            });

            // Selects
            form.querySelectorAll('select[required]').forEach(sel => {
                if (!sel.value) {
                    sel.classList.add('is-invalid');
                    if (!firstInvalid) firstInvalid = sel;
                    valid = false;
                } else {
                    sel.classList.add('is-valid');
                }
            });

            // Inputs
            form.querySelectorAll('input[required]:not([type="radio"]):not([type="checkbox"])').forEach(inp => {
                if (!inp.value) {
                    inp.classList.add('is-invalid');
                    if (!firstInvalid) firstInvalid = inp;
                    valid = false;
                } else {
                    inp.classList.add('is-valid');
                }
            });

            form.classList.add('was-validated');

            if (!valid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos incompletos',
                    text: 'Por favor completa todos los campos obligatorios del módulo 4 antes de continuar.',
                    confirmButtonColor: '#611232'
                });
                if (firstInvalid && typeof firstInvalid.focus === 'function') {
                    setTimeout(() => firstInvalid.focus(), 400);
                }
                return;
            }

            const formData = new FormData(form);
            fetch('../controllers/enviadatos_modulo_4.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data && data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Datos guardados!',
                            text: 'El Módulo "IV. Protección civil y seguridad estructural" se guardó correctamente',
                            confirmButtonColor: '#611232'
                        }).then(() => {
                            const redirectForm = document.createElement('form');
                            redirectForm.method = 'POST';
                            redirectForm.action = 'dashboard';
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'modulo';
                            input.value = '5';
                            redirectForm.appendChild(input);
                            document.body.appendChild(redirectForm);
                            redirectForm.submit();
                            form.reset();
                            form.classList.remove('was-validated');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data && data.message ? data.message : 'Ocurrió un error al guardar el Módulo 4.',
                            confirmButtonColor: '#611232'
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo enviar el formulario. Intenta de nuevo.',
                        confirmButtonColor: '#611232'
                    });
                });
        });

        form.querySelectorAll('input, select').forEach(el => {
            el.addEventListener('change', () => {
                if (el.type === 'radio') {
                    const radios = form.querySelectorAll(`input[type="radio"][name="${el.name}"]`);
                    radios.forEach(radio => radio.classList.remove('is-invalid', 'is-valid'));
                    if (el.checked) {
                        radios.forEach(radio => radio.classList.add('is-valid'));
                    }
                } else if (el.tagName === 'SELECT') {
                    el.classList.remove('is-invalid', 'is-valid');
                    if (el.value) el.classList.add('is-valid');
                } else {
                    el.classList.remove('is-invalid', 'is-valid');
                    if (el.value) el.classList.add('is-valid');
                }
            });
        });
    });
</script>