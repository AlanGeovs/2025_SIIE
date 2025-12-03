<div class="tab-pane" id="progress-contact-info">
    <div>

        <form id="form-modulo-2" class="needs-validation" novalidate>
            <div class="card-header mb-4">
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

                /* Consistent disabled button style for evidencias */
                button.btn[disabled] {
                    background-color: #6c757d !important;
                    border-color: #6c757d !important;
                }
            </style>
            <div class="row no-margin"> <!-- Contenedor principal -->
                <div class="col-sm-12">
                    <div class="mb-2">
                        <label for="accesibilidad">2. Nivel de accesibilidad del Centro de Trabajo.<span style="color: red;">*</span></label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-2">
                        <div class="list-group">
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="accesibilidad-total" name="accesibilidad" value="TOTAL" required>
                                <span>
                                    Accesibilidad total
                                    <small class="d-block text-body-secondary">
                                        Cuenta con infraestructura idónea (andadores, rampas, pasamanos y barandales); ofrece el adecuado ingreso al inmueble; permite el desplazamiento en todas las áreas principales (salones, sanitarios y dirección), comunes (plaza cívica, canchas deportivas, domo y áreas de juegos), y/o adicionales (subdirección, administración, biblioteca, laboratorios, talleres, aula de usos múltiples y comedor) con que cuenta el inmueble.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="accesibilidad-minima" name="accesibilidad" value="MINIMA" required>
                                <span>
                                    Accesibilidad mínima
                                    <small class="d-block text-body-secondary">
                                        Cuenta con infraestructura suficiente para el ingreso al inmueble; permite el desplazamiento tan solo en las áreas principales existentes.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="accesibilidad-nula" name="accesibilidad" value="NULA" required>
                                <div class="invalid-feedback">
                                    Selecciona el nivel de accesibilidad del Centro de Trabajo.
                                </div>
                                <span>
                                    Accesibilidad nula
                                    <small class="d-block text-body-secondary">
                                        Sin infraestructura para el ingreso al inmueble; con desplazamiento limitado en las áreas existentes.
                                    </small>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>


            </div>


            <!-- Red hidraulica  -->
            <div class="col-lg-12">
                <br>
                <br>
                <div class="row mb-12">
                    <div class="col-md-4">
                        <label>2.1 ¿Existe red hidráulica?<span style="color: red;">*</span></label>
                        <input type="radio" id="red_hidraulica_si" name="red_hidraulica" value="SI" style="margin-left: 10px;" required>
                        <label for="red_hidraulica_si">Sí</label>
                        <input type="radio" id="red_hidraulica_no" name="red_hidraulica" value="NO" required>
                        <label for="red_hidraulica_no">No</label>
                        <div class="invalid-feedback">
                            Selecciona si existe red hidráulica.
                        </div>
                    </div>
                    <div class="col-md-12" id="condicionesRed" style="display: none;">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="condicion_red_hidraulica">2.1.1 ¿En qué condiciones se encuentra?</label>
                            </div>
                            <div class="col-md-5">
                                <div class="list-group">
                                    <label class="list-group-item d-flex gap-2">
                                        <input class="form-check-input flex-shrink-0" type="radio" id="condicion_red_hidraulica_buena" name="condicion_red_hidraulica" value="BUENA" required>
                                        <span>
                                            Buena
                                            <small class="d-block text-body-secondary">
                                                Funciona correctamente y cumple con su propósito.
                                            </small>
                                        </span>
                                    </label>
                                    <label class="list-group-item d-flex gap-2">
                                        <input class="form-check-input flex-shrink-0" type="radio" id="condicion_red_hidraulica_regular" name="condicion_red_hidraulica" value="REGULAR" required>
                                        <span>
                                            Regular
                                            <small class="d-block text-body-secondary">
                                                Presenta pequeñas fallas o signos de desgaste.
                                            </small>
                                        </span>
                                    </label>
                                    <label class="list-group-item d-flex gap-2">
                                        <input class="form-check-input flex-shrink-0" type="radio" id="condicion_red_hidraulica_mala" name="condicion_red_hidraulica" value="MALA" required>
                                        <div class="invalid-feedback">
                                            Selecciona la condición de la red hidráulica.
                                        </div>
                                        <span>
                                            Mala
                                            <small class="d-block text-body-secondary">
                                                Tiene daños visibles o funcionales que lo hacen casi inservible.
                                            </small>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-start pt-2">
                                <label class="btn btn-evidencia w-100">
                                    Agregar evidencia
                                    <input type="file" class="evidencia-input" data-modulo="2-1" style="display:none;">
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- Script para mostrar/ocultar condicionesRed según selección de red hidráulica -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var redSi = document.getElementById('red_hidraulica_si');
                            var redNo = document.getElementById('red_hidraulica_no');
                            var condicionesRed = document.getElementById('condicionesRed');

                            function limpiarRadiosDentro(div) {
                                var radios = div.querySelectorAll('input[type="radio"]');
                                radios.forEach(function(r) {
                                    r.checked = false;
                                });
                            }

                            function actualizarCondicionesRed() {
                                if (redSi.checked) {
                                    condicionesRed.style.display = 'block';
                                } else if (redNo.checked) {
                                    condicionesRed.style.display = 'none';
                                    limpiarRadiosDentro(condicionesRed);
                                }
                            }
                            if (redSi && redNo && condicionesRed) {
                                redSi.addEventListener('change', actualizarCondicionesRed);
                                redNo.addEventListener('change', actualizarCondicionesRed);
                                // Inicializar visibilidad al cargar
                                actualizarCondicionesRed();
                            }
                        });
                    </script>

                </div>

                <!-- Red hidraulica Interna -->
                <div class="col-lg-12 mt-3">

                    <div class="row mb-4">
                        <div class="col-md-12 mt-3">
                            <label>2.2 ¿Existe red hidráulica interna?<span style="color: red;">*</span></label>
                            <input type="radio" id="red_hidraulica_int_si" name="red_hidraulica_int" value="SI" style="margin-left: 10px;" required>
                            <label for="red_hidraulica_int_si">Sí</label>
                            <input type="radio" id="red_hidraulica_int_no" name="red_hidraulica_int" value="NO" required>
                            <label for="red_hidraulica_int_no">No</label>
                            <div class="invalid-feedback">
                                Selecciona si existe red hidráulica interna.
                            </div>
                        </div>
                        <div class="col-md-12" id="condicionesRedInt" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="condicion_red_interna">2.2.1 ¿En qué condiciones se encuentra?</label>
                                </div>
                                <div class="col-md-5">
                                    <div class="list-group">
                                        <label class="list-group-item d-flex gap-2">
                                            <input class="form-check-input flex-shrink-0" type="radio" id="condicion_red_interna_buena" name="condicion_red_interna" value="BUENA" required>
                                            <span>
                                                Buena
                                                <small class="d-block text-body-secondary">
                                                    Funciona correctamente y cumple con su propósito.
                                                </small>
                                            </span>
                                        </label>
                                        <label class="list-group-item d-flex gap-2">
                                            <input class="form-check-input flex-shrink-0" type="radio" id="condicion_red_interna_regular" name="condicion_red_interna" value="REGULAR" required>
                                            <span>
                                                Regular
                                                <small class="d-block text-body-secondary">
                                                    Presenta pequeñas fallas o signos de desgaste.
                                                </small>
                                            </span>
                                        </label>
                                        <label class="list-group-item d-flex gap-2">
                                            <input class="form-check-input flex-shrink-0" type="radio" id="condicion_red_interna_mala" name="condicion_red_interna" value="MALA" required>
                                            <div class="invalid-feedback">
                                                Selecciona la condición de la red hidráulica interna.
                                            </div>
                                            <span>
                                                Mala
                                                <small class="d-block text-body-secondary">
                                                    Tiene daños visibles o funcionales que lo hacen casi inservible.
                                                </small>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3 d-flex align-items-start pt-2">
                                    <label class="btn btn-evidencia w-100">
                                        Agregar evidencia
                                        <input type="file" class="evidencia-input" data-modulo="2-2-int" style="display:none;">
                                    </label>
                                </div>


                            </div>
                        </div>
                        <!-- Script para mostrar/ocultar condicionesRedInt según selección de red hidráulica interna -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var redIntSi = document.getElementById('red_hidraulica_int_si');
                                var redIntNo = document.getElementById('red_hidraulica_int_no');
                                var condicionesRedInt = document.getElementById('condicionesRedInt');

                                function limpiarRadiosDentro(div) {
                                    var radios = div.querySelectorAll('input[type="radio"]');
                                    radios.forEach(function(r) {
                                        r.checked = false;
                                    });
                                }

                                function actualizarCondicionesRedInt() {
                                    if (redIntSi.checked) {
                                        condicionesRedInt.style.display = 'block';
                                    } else if (redIntNo.checked) {
                                        condicionesRedInt.style.display = 'none';
                                        limpiarRadiosDentro(condicionesRedInt);
                                    }
                                }
                                if (redIntSi && redIntNo && condicionesRedInt) {
                                    redIntSi.addEventListener('change', actualizarCondicionesRedInt);
                                    redIntNo.addEventListener('change', actualizarCondicionesRedInt);
                                    // Inicializar visibilidad al cargar
                                    actualizarCondicionesRedInt();
                                }
                            });
                        </script>
                    </div>

                </div>

                <!-- Tipo de servicio y suministro de agua -->
                <div class="row mt-3"> <!-- Contenedor principal -->
                    <div class="col-sm-12"> <!-- Fila 1: Label que ocupa el ancho completo -->
                        <div>

                            <label for="tipo_suministro_agua">2.3. Tipo de servicio y suministro de agua<span style="color: red;">*</span></label>
                        </div>
                    </div>


                    <div class="col-sm-4 mt-2"> <!-- Fila 2: Columna 1 - Tipo de Suministro -->
                        <div>
                            <select class="form-control" id="tipo_suministro_agua" name="tipo_suministro_agua" style="background-color: white; color: rgb(0, 0, 0); border: 1px solid rgba(0, 0, 0, 0.411);" required>
                                <div class="invalid-feedback">
                                    Selecciona el tipo de servicio y suministro de agua.
                                </div>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="ACARREO">Acarreo</option>
                                <option value="CAPTACION_PLUVIAL">Captación pluvial</option>
                                <option value="CUERPO_AGUA">Cuerpo de agua</option>
                                <option value="PIPA">Pipa</option>
                                <option value="POZO">Pozo</option>
                                <option value="RED_MUNICIPAL">Red municipal</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 mt-2"> <!-- Fila 2: Columna 2 - Botón -->
                        <div class="mb-2">
                            <label class="btn btn-evidencia w-100">
                                Agregar evidencia
                                <input type="file" class="evidencia-input" data-modulo="2-3" style="display:none;">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-3">
                    <div class="mb-7">
                        <label>2.4 ¿Existe algún tipo de almacenamiento de agua?<span style="color: red;">*</span></label>
                        <div>
                            <input type="radio" id="almacenamiento_agua_si" name="almacenamiento_agua_existencia" value="SI" required>
                            <label for="almacenamiento_agua_si">Sí</label>
                            <input type="radio" id="almacenamiento_agua_no" name="almacenamiento_agua_existencia" value="NO" required>
                            <label for="almacenamiento_agua_no">No</label>
                            <div class="invalid-feedback">
                                Selecciona si existe algún tipo de almacenamiento de agua.
                            </div>
                        </div>
                    </div>

                    <br>

                    <div id="water-storage-table" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm align-middle text-center" id="storageTable">
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
                                            <input type="radio" id="almacenamiento_cisterna_existencia_si" name="almacenamiento_cisterna_existencia" value="SI" class="existencia-si" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_cisterna_existencia_si">Sí</label>
                                            <input type="radio" id="almacenamiento_cisterna_existencia_no" name="almacenamiento_cisterna_existencia" value="NO" class="existencia-no" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_cisterna_existencia_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_cisterna_cantidad" name="almacenamiento_cisterna_cantidad" onchange="updateRows(this)">
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
                                            <input type="radio" id="almacenamiento_cisterna_uso_si" name="almacenamiento_cisterna_uso" value="SI" class="en-uso-si" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_cisterna_uso_si">Sí</label>
                                            <input type="radio" id="almacenamiento_cisterna_uso_no" name="almacenamiento_cisterna_uso" value="NO" class="en-uso-no" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_cisterna_uso_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_cisterna_condicion" name="almacenamiento_cisterna_condicion">
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label class="btn btn-evidencia w-100">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-4-cisterna" style="display:none;">
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pileta</td>
                                        <td>
                                            <input type="radio" id="almacenamiento_pileta_existencia_si" name="almacenamiento_pileta_existencia" value="SI" class="existencia-si" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_pileta_existencia_si">Sí</label>
                                            <input type="radio" id="almacenamiento_pileta_existencia_no" name="almacenamiento_pileta_existencia" value="NO" class="existencia-no" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_pileta_existencia_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_pileta_cantidad" name="almacenamiento_pileta_cantidad" onchange="updateRows(this)">
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
                                            <input type="radio" id="almacenamiento_pileta_uso_si" name="almacenamiento_pileta_uso" value="SI" class="en-uso-si" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_pileta_uso_si">Sí</label>
                                            <input type="radio" id="almacenamiento_pileta_uso_no" name="almacenamiento_pileta_uso" value="NO" class="en-uso-no" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_pileta_uso_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_pileta_condicion" name="almacenamiento_pileta_condicion">
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label class="btn btn-evidencia w-100">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-4-pileta" style="display:none;">
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanque elevado</td>
                                        <td>
                                            <input type="radio" id="almacenamiento_tanque_existencia_si" name="almacenamiento_tanque_existencia" value="SI" class="existencia-si" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_tanque_existencia_si">Sí</label>
                                            <input type="radio" id="almacenamiento_tanque_existencia_no" name="almacenamiento_tanque_existencia" value="NO" class="existencia-no" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_tanque_existencia_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_tanque_cantidad" name="almacenamiento_tanque_cantidad" onchange="updateRows(this)">
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
                                            <input type="radio" id="almacenamiento_tanque_uso_si" name="almacenamiento_tanque_uso" value="SI" class="en-uso-si" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_tanque_uso_si">Sí</label>
                                            <input type="radio" id="almacenamiento_tanque_uso_no" name="almacenamiento_tanque_uso" value="NO" class="en-uso-no" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_tanque_uso_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_tanque_condicion" name="almacenamiento_tanque_condicion">
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label class="btn btn-evidencia w-100">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-4-tanque" style="display:none;">
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tambo</td>
                                        <td>
                                            <input type="radio" id="almacenamiento_tambo_existencia_si" name="almacenamiento_tambo_existencia" value="SI" class="existencia-si" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_tambo_existencia_si">Sí</label>
                                            <input type="radio" id="almacenamiento_tambo_existencia_no" name="almacenamiento_tambo_existencia" value="NO" class="existencia-no" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_tambo_existencia_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_tambo_cantidad" name="almacenamiento_tambo_cantidad" onchange="updateRows(this)">
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
                                            <input type="radio" id="almacenamiento_tambo_uso_si" name="almacenamiento_tambo_uso" value="SI" class="en-uso-si" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_tambo_uso_si">Sí</label>
                                            <input type="radio" id="almacenamiento_tambo_uso_no" name="almacenamiento_tambo_uso" value="NO" class="en-uso-no" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_tambo_uso_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_tambo_condicion" name="almacenamiento_tambo_condicion">
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label class="btn btn-evidencia w-100">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-4-tambo" style="display:none;">
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tinaco</td>
                                        <td>
                                            <input type="radio" id="almacenamiento_tinaco_existencia_si" name="almacenamiento_tinaco_existencia" value="SI" class="existencia-si" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_tinaco_existencia_si">Sí</label>
                                            <input type="radio" id="almacenamiento_tinaco_existencia_no" name="almacenamiento_tinaco_existencia" value="NO" class="existencia-no" onchange="handleExistenciaCheckbox(this)">
                                            <label for="almacenamiento_tinaco_existencia_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_tinaco_cantidad" name="almacenamiento_tinaco_cantidad" onchange="updateRows(this)">
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
                                            <input type="radio" id="almacenamiento_tinaco_uso_si" name="almacenamiento_tinaco_uso" value="SI" class="en-uso-si" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_tinaco_uso_si">Sí</label>
                                            <input type="radio" id="almacenamiento_tinaco_uso_no" name="almacenamiento_tinaco_uso" value="NO" class="en-uso-no" onchange="handleEnUsoCheckbox(this)">
                                            <label for="almacenamiento_tinaco_uso_no">No</label>
                                        </td>
                                        <td>
                                            <select class="form-control" id="almacenamiento_tinaco_condicion" name="almacenamiento_tinaco_condicion">
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label class="btn btn-evidencia w-100">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-4-tinaco" style="display:none;">
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('almacenamiento_agua_si').addEventListener('change', function() {
                        if (this.checked) {
                            document.getElementById('almacenamiento_agua_no').checked = false;
                            document.getElementById('water-storage-table').style.display = 'block';
                        }
                    });
                    document.getElementById('almacenamiento_agua_no').addEventListener('change', function() {
                        if (this.checked) {
                            document.getElementById('almacenamiento_agua_si').checked = false;
                            document.getElementById('water-storage-table').style.display = 'none';
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
<option value="" disabled selected>Selecciona una opción</option>
<option value="bueno">Buena</option>
<option value="regular">Regular</option>
<option value="malo">Mala</option>
</select>
</td>
<td>
<button type="button" class="btn btn-evidencia" onclick="handleAgregarEvidencia('${storageType.toLowerCase()}')">Agregar evidencia</button>
</td>
`;
                            tableBody.insertBefore(newRow, row.nextSibling); // Insertar fila justo después de la fila original
                        }
                    }

                    // Evidencia buttons for almacenamiento - usar función centralizada
                    function handleAgregarEvidencia(modulo) {
                        // Esta función debe estar definida globalmente, o aquí puedes enlazar la lógica centralizada de dashboard.php
                        // Por ejemplo, mostrar el dropzone correspondiente:
                        var dropzoneContainer = document.getElementById('dropzone-container-' + modulo);
                        if (dropzoneContainer) {
                            dropzoneContainer.style.display = dropzoneContainer.style.display === 'none' ? 'block' : 'none';
                        }
                        // Si tienes una lógica centralizada más compleja, reemplaza este bloque por la llamada adecuada.
                    }
                </script>

                <!-- 2.5 Servicios de drenaje y tipo de descarga sanitaria -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="descarga_sanitaria" class="mb-2">2.5. Servicios de drenaje y tipo de descarga sanitaria <span style="color: red;">*</span></label>
                    </div>
                </div>
                <div class="row mb-4 align-items-start">
                    <div class="col-md-4 mb-2">
                        <select class="form-control" id="descarga_sanitaria" name="descarga_sanitaria" required>
                            <div class="invalid-feedback">
                                Selecciona el tipo de descarga sanitaria.
                            </div>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="CIELO_ABIERTO">A cielo abierto</option>
                            <option value="BIODIGESTOR">Biodigestor</option>
                            <option value="COLECTOR_MUNICIPAL">Colector municipal</option>
                            <option value="FOSA_SEPTICA">Fosa séptica</option>
                            <option value="LETRINA">Letrina</option>
                            <option value="PLANTA_TRATAMIENTO">Planta de tratamiento</option>
                        </select>
                    </div>
                    <div class="col-md-5 mb-2">
                        <div class="list-group">
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_descarga_sanitaria_buena" name="condicion_descarga_sanitaria" value="BUENA" required>
                                <span>
                                    Buena
                                    <small class="d-block text-body-secondary">
                                        Funciona correctamente y cumple con su propósito.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_descarga_sanitaria_regular" name="condicion_descarga_sanitaria" value="REGULAR" required>
                                <span>
                                    Regular
                                    <small class="d-block text-body-secondary">
                                        Presenta pequeñas fallas o signos de desgaste.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_descarga_sanitaria_mala" name="condicion_descarga_sanitaria" value="MALA" required>
                                <div class="invalid-feedback">
                                    Selecciona la condición de la descarga sanitaria.
                                </div>
                                <span>
                                    Mala
                                    <small class="d-block text-body-secondary">
                                        Tiene daños visibles o funcionales que lo hacen casi inservible.
                                    </small>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-start pt-2">
                        <label class="btn btn-evidencia w-100">
                            Agregar evidencia
                            <input type="file" class="evidencia-input" data-modulo="2-5" style="display:none;">
                        </label>
                    </div>
                </div>



                <!-- 2.6 Servicios de recolección y gestión de la basura -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="gestion_basura" class="mb-2">2.6. Servicios de recolección y tipo de gestión de la basura <span style="color: red;">*</span></label>
                    </div>
                </div>
                <div class="row mb-4 align-items-start">
                    <div class="col-md-4 mb-2">
                        <select class="form-control" id="gestion_basura" name="gestion_basura" required>
                            <div class="invalid-feedback">
                                Selecciona el tipo de gestión de la basura.
                            </div>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="SERVICIO_PUBLICO">Recolección por servicio público</option>
                            <option value="SERVICIO_PRIVADO">Recolección por servicio privado</option>
                            <option value="RELLENO_SANITARIO">Relleno sanitario</option>
                            <option value="TRATAMIENTO_HOLISTICO">Tratamiento holístico</option>
                            <option value="VERTEDERO">Vertedero</option>
                        </select>
                    </div>
                    <div class="col-md-5 mb-2">
                        <div class="list-group">
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_gestion_basura_buena" name="condicion_gestion_basura" value="BUENA" required>
                                <span>
                                    Buena
                                    <small class="d-block text-body-secondary">
                                        Funciona correctamente y cumple con su propósito.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_gestion_basura_regular" name="condicion_gestion_basura" value="REGULAR" required>
                                <span>
                                    Regular
                                    <small class="d-block text-body-secondary">
                                        Presenta pequeñas fallas o signos de desgaste.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_gestion_basura_mala" name="condicion_gestion_basura" value="MALA" required>
                                <div class="invalid-feedback">
                                    Selecciona la condición de la gestión de basura.
                                </div>
                                <span>
                                    Mala
                                    <small class="d-block text-body-secondary">
                                        Tiene daños visibles o funcionales que lo hacen casi inservible.
                                    </small>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end pt-2">
                        <label class="btn btn-evidencia w-100">
                            Agregar evidencia
                            <input type="file" class="evidencia-input" data-modulo="2-6" style="display:none;">
                        </label>
                    </div>
                </div>


                <!-- 2.7 Servicio y tipo de suministro de energía -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="suministro_energia" class="mb-2">2.7. Servicio y tipo de suministro de energía <span style="color: red;">*</span></label>
                    </div>
                </div>
                <div class="row mb-4 align-items-start">
                    <div class="col-md-4 mb-2">
                        <select class="form-control" id="suministro_energia" name="suministro_energia" required>
                            <div class="invalid-feedback">
                                Selecciona el tipo de suministro de energía.
                            </div>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="RED_CONTRATO">Conexión a la red con contrato</option>
                            <option value="RED_SIN_CONTRATO">Conexión a la red sin contrato</option>
                            <option value="LUZ_NATURAL">Luz natural</option>
                            <option value="PANEL_SOLAR">Panel solar</option>
                            <option value="PLANTA_LUZ">Planta de luz</option>
                        </select>
                    </div>
                    <div class="col-md-5 mb-2">
                        <div class="list-group">
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_suministro_energia_buena" name="condicion_suministro_energia" value="BUENA" required>
                                <span>
                                    Buena
                                    <small class="d-block text-body-secondary">
                                        Funciona correctamente y cumple con su propósito.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_suministro_energia_regular" name="condicion_suministro_energia" value="REGULAR" required>
                                <span>
                                    Regular
                                    <small class="d-block text-body-secondary">
                                        Presenta pequeñas fallas o signos de desgaste.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_suministro_energia_mala" name="condicion_suministro_energia" value="MALA" required>
                                <div class="invalid-feedback">
                                    Selecciona la condición del suministro de energía.
                                </div>
                                <span>
                                    Mala
                                    <small class="d-block text-body-secondary">
                                        Tiene daños visibles o funcionales que lo hacen casi inservible.
                                    </small>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end pt-2">
                        <label class="btn btn-evidencia w-100">
                            Agregar evidencia
                            <input type="file" class="evidencia-input" data-modulo="2-7" style="display:none;">
                        </label>
                    </div>
                </div>

                <div class="row mb-4 align-items-start">
                    <!-- Columna 1: label de la pregunta y ambos selects -->
                    <div class="col-md-4">
                        <label for="suministro_gas" class="mb-2">2.8. Servicios y tipo de suministro de gas <span style="color: red;">*</span></label>
                        <select class="form-control mb-2" id="suministro_gas" name="suministro_gas" required>
                            <div class="invalid-feedback">
                                Selecciona el tipo de suministro de gas.
                            </div>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="GAS_LP">Gas licuado de petróleo</option>
                            <option value="GAS_NATURAL">Gas natural</option>
                        </select>
                        <label for="tipo_almacenamiento_gas" class="mb-2 mt-2">Tipo de almacenamiento <span style="color: red;">*</span></label>
                        <select class="form-control" id="tipo_almacenamiento_gas" name="tipo_almacenamiento_gas" required>
                            <div class="invalid-feedback">
                                Selecciona el tipo de almacenamiento de gas.
                            </div>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="CILINDRO">Cilindro</option>
                            <option value="ESTACIONARIO">Estacionario</option>
                            <option value="SUMINISTRO_PUBLICO">Suministro público</option>
                        </select>
                    </div>
                    <!-- Columna 2: label vacío y list-group -->
                    <div class="col-md-5">
                        <label for="condicion_suministro_gas" class="mb-2">&nbsp;</label>
                        <div class="list-group">
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_suministro_gas_buena" name="condicion_suministro_gas" value="BUENA" required>
                                <span>
                                    Buena
                                    <small class="d-block text-body-secondary">
                                        Funciona correctamente y cumple con su propósito.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_suministro_gas_regular" name="condicion_suministro_gas" value="REGULAR" required>
                                <span>
                                    Regular
                                    <small class="d-block text-body-secondary">
                                        Presenta pequeñas fallas o signos de desgaste.
                                    </small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-2">
                                <input class="form-check-input flex-shrink-0" type="radio" id="condicion_suministro_gas_mala" name="condicion_suministro_gas" value="MALA" required>
                                <div class="invalid-feedback">
                                    Selecciona la condición del suministro de gas.
                                </div>
                                <span>
                                    Mala
                                    <small class="d-block text-body-secondary">
                                        Tiene daños visibles o funcionales que lo hacen casi inservible.
                                    </small>
                                </span>
                            </label>
                        </div>
                    </div>
                    <!-- Columna 3: solo el botón agregar evidencia -->
                    <div class="col-md-3 d-flex align-items-end pt-2">
                        <label class="btn btn-evidencia w-100">
                            Agregar evidencia
                            <input type="file" class="evidencia-input" data-modulo="2-9" style="display:none;">
                        </label>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <label for="tics_antena_existencia" class="mb-2">2.9. Servicios y tipo de Tecnologías de la Información y Comunicaciones (TIC’s)<span style="color: red;">*</span></label>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Modalidad de servicio TI</th>
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
                                            <input type="radio" id="tics_antena_existencia_si" name="tics_antena_existencia" value="SI" class="existencia-radio" data-target="antena">
                                            <label for="tics_antena_existencia_si">Sí</label>
                                            <input type="radio" id="tics_antena_existencia_no" name="tics_antena_existencia" value="NO" class="existencia-radio" data-target="antena">
                                            <label for="tics_antena_existencia_no">No</label>
                                        </td>
                                        <td data-group="antena">
                                            <select class="form-control" id="tics_antena_cantidad" name="tics_antena_cantidad" disabled>
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
                                        <td data-group="antena">
                                            <input type="radio" id="tics_antena_uso_si" name="tics_antena_uso" value="SI" disabled>
                                            <label for="tics_antena_uso_si">Sí</label>
                                            <input type="radio" id="tics_antena_uso_no" name="tics_antena_uso" value="NO" disabled>
                                            <label for="tics_antena_uso_no">No</label>
                                        </td>
                                        <td data-group="antena">
                                            <select class="form-control" id="tics_antena_condicion" name="tics_antena_condicion" disabled>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td data-group="antena">
                                            <label class="btn btn-secondary w-100 mb-0">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-10-antena" style="display:none;" disabled>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Instalación de red de telecomunicaciones</td>
                                        <td>
                                            <input type="radio" id="tics_red_existencia_si" name="tics_red_existencia" value="SI" class="existencia-radio" data-target="red">
                                            <label for="tics_red_existencia_si">Sí</label>
                                            <input type="radio" id="tics_red_existencia_no" name="tics_red_existencia" value="NO" class="existencia-radio" data-target="red">
                                            <label for="tics_red_existencia_no">No</label>
                                        </td>
                                        <td data-group="red">
                                            <select class="form-control" id="tics_red_cantidad" name="tics_red_cantidad" disabled>
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
                                        <td data-group="red">
                                            <input type="radio" id="tics_red_uso_si" name="tics_red_uso" value="SI" disabled>
                                            <label for="tics_red_uso_si">Sí</label>
                                            <input type="radio" id="tics_red_uso_no" name="tics_red_uso" value="NO" disabled>
                                            <label for="tics_red_uso_no">No</label>
                                        </td>
                                        <td data-group="red">
                                            <select class="form-control" id="tics_red_condicion" name="tics_red_condicion" disabled>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td data-group="red">
                                            <label class="btn btn-secondary w-100 mb-0">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-10-red" style="display:none;" disabled>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Red de telefonía celular</td>
                                        <td>
                                            <input type="radio" id="tics_celular_existencia_si" name="tics_celular_existencia" value="SI" class="existencia-radio" data-target="celular">
                                            <label for="tics_celular_existencia_si">Sí</label>
                                            <input type="radio" id="tics_celular_existencia_no" name="tics_celular_existencia" value="NO" class="existencia-radio" data-target="celular">
                                            <label for="tics_celular_existencia_no">No</label>
                                        </td>
                                        <td data-group="celular">
                                            <select class="form-control" id="tics_celular_cantidad" name="tics_celular_cantidad" disabled>
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
                                        <td data-group="celular">
                                            <input type="radio" id="tics_celular_uso_si" name="tics_celular_uso" value="SI" disabled>
                                            <label for="tics_celular_uso_si">Sí</label>
                                            <input type="radio" id="tics_celular_uso_no" name="tics_celular_uso" value="NO" disabled>
                                            <label for="tics_celular_uso_no">No</label>
                                        </td>
                                        <td data-group="celular">
                                            <select class="form-control" id="tics_celular_condicion" name="tics_celular_condicion" disabled>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td data-group="celular">
                                            <label class="btn btn-secondary w-100 mb-0">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-10-celular" style="display:none;" disabled>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Internet</td>
                                        <td>
                                            <input type="radio" id="tics_internet_existencia_si" name="tics_internet_existencia" value="SI" class="existencia-radio" data-target="internet">
                                            <label for="tics_internet_existencia_si">Sí</label>
                                            <input type="radio" id="tics_internet_existencia_no" name="tics_internet_existencia" value="NO" class="existencia-radio" data-target="internet">
                                            <label for="tics_internet_existencia_no">No</label>
                                        </td>
                                        <td data-group="internet">
                                            <select class="form-control" id="tics_internet_cantidad" name="tics_internet_cantidad" disabled>
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
                                        <td data-group="internet">
                                            <input type="radio" id="tics_internet_uso_si" name="tics_internet_uso" value="SI" disabled>
                                            <label for="tics_internet_uso_si">Sí</label>
                                            <input type="radio" id="tics_internet_uso_no" name="tics_internet_uso" value="NO" disabled>
                                            <label for="tics_internet_uso_no">No</label>
                                        </td>
                                        <td data-group="internet">
                                            <select class="form-control" id="tics_internet_condicion" name="tics_internet_condicion" disabled>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td data-group="internet">
                                            <label class="btn btn-secondary w-100 mb-0">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-10-internet" style="display:none;" disabled>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telefonía fija</td>
                                        <td>
                                            <input type="radio" id="tics_telefonia_existencia_si" name="tics_telefonia_existencia" value="SI" class="existencia-radio" data-target="telefonia">
                                            <label for="tics_telefonia_existencia_si">Sí</label>
                                            <input type="radio" id="tics_telefonia_existencia_no" name="tics_telefonia_existencia" value="NO" class="existencia-radio" data-target="telefonia">
                                            <label for="tics_telefonia_existencia_no">No</label>
                                        </td>
                                        <td data-group="telefonia">
                                            <select class="form-control" id="tics_telefonia_cantidad" name="tics_telefonia_cantidad" disabled>
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
                                        <td data-group="telefonia">
                                            <input type="radio" id="tics_telefonia_uso_si" name="tics_telefonia_uso" value="SI" disabled>
                                            <label for="tics_telefonia_uso_si">Sí</label>
                                            <input type="radio" id="tics_telefonia_uso_no" name="tics_telefonia_uso" value="NO" disabled>
                                            <label for="tics_telefonia_uso_no">No</label>
                                        </td>
                                        <td data-group="telefonia">
                                            <select class="form-control" id="tics_telefonia_condicion" name="tics_telefonia_condicion" disabled>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="BUENA">Buena</option>
                                                <option value="REGULAR">Regular</option>
                                                <option value="MALA">Mala</option>
                                            </select>
                                        </td>
                                        <td data-group="telefonia">
                                            <label class="btn btn-secondary w-100 mb-0">
                                                Agregar evidencia
                                                <input type="file" class="evidencia-input" data-modulo="2-10-telefonia" style="display:none;" disabled>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <script>
                    // TIC's tabla: dependencias de existencia
                    document.addEventListener('DOMContentLoaded', function() {
                        function setTicGroupEnabled(group, enabled) {
                            const elements = document.querySelectorAll('[data-group="' + group + '"] select, [data-group="' + group + '"] input, [data-group="' + group + '"] button');
                            elements.forEach(function(el) {
                                if (enabled) {
                                    el.disabled = false;
                                } else {
                                    el.disabled = true;
                                    // Reset value for selects and radios
                                    if (el.tagName === 'SELECT') {
                                        el.selectedIndex = 0;
                                    }
                                    if (el.type === 'radio') {
                                        el.checked = false;
                                    }
                                }
                            });
                        }
                        // Initially disable all groups
                        ['antena', 'red', 'celular', 'internet', 'telefonia'].forEach(function(group) {
                            setTicGroupEnabled(group, false);
                        });
                        // Event delegation for existencia radios
                        document.querySelectorAll('.existencia-radio').forEach(function(radio) {
                            radio.addEventListener('change', function() {
                                const group = this.getAttribute('data-target');
                                if (this.value === "SI" && this.checked) {
                                    setTicGroupEnabled(group, true);
                                } else if (this.value === "NO" && this.checked) {
                                    setTicGroupEnabled(group, false);
                                }
                            });
                        });
                    });
                </script>






        </form>




        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-success" form="form-modulo-2">
                Guardar Módulo 2 <i class="fas fa-save"></i>
            </button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('form-modulo-2');
                if (!form) return;

                // Bootstrap validation + custom feedback
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    let valid = true;
                    let firstInvalid = null;

                    // Limpiar clases previas
                    form.querySelectorAll('.is-invalid, .is-valid').forEach(function(el) {
                        el.classList.remove('is-invalid', 'is-valid');
                    });

                    // Validar campos requeridos (radios y selects)
                    // Radios: agrupar por name
                    const radioNames = new Set();
                    form.querySelectorAll('input[type="radio"][required]').forEach(function(radio) {
                        radioNames.add(radio.name);
                    });
                    radioNames.forEach(function(name) {
                        const radios = form.querySelectorAll('input[type="radio"][name="' + name + '"]');
                        const checked = form.querySelector('input[type="radio"][name="' + name + '"]:checked');
                        radios.forEach(function(radio) {
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
                    form.querySelectorAll('select[required]').forEach(function(sel) {
                        if (!sel.value) {
                            sel.classList.add('is-invalid');
                            if (!firstInvalid) firstInvalid = sel;
                            valid = false;
                        } else {
                            sel.classList.add('is-valid');
                        }
                    });

                    // Otros inputs requeridos (no radios ni selects)
                    form.querySelectorAll('input[required]:not([type="radio"]):not([type="checkbox"])').forEach(function(inp) {
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
                            text: 'Por favor completa todos los campos obligatorios del módulo 2 antes de continuar.',
                            confirmButtonColor: '#611232'
                        });
                        if (firstInvalid && typeof firstInvalid.focus === 'function') {
                            setTimeout(() => firstInvalid.focus(), 400);
                        }
                        return;
                    }

                    // Enviar datos por fetch
                    const formData = new FormData(form);
                    fetch('../controllers/enviadatos_modulo_2.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Datos guardados!',
                                    text: 'El Módulo "II. Accesibilidad y servicios básicos del Centro de Trabajo" se guardó correctamente',
                                    confirmButtonColor: '#611232'
                                }).then(() => {
                                    // Crear y enviar formulario oculto para redirigir a módulo 3
                                    const redirectForm = document.createElement('form');
                                    redirectForm.method = 'POST';
                                    redirectForm.action = 'dashboard';
                                    const input = document.createElement('input');
                                    input.type = 'hidden';
                                    input.name = 'modulo';
                                    input.value = '3';
                                    redirectForm.appendChild(input);
                                    document.body.appendChild(redirectForm);
                                    redirectForm.submit();
                                    // Limpiar formulario actual
                                    form.reset();
                                    form.classList.remove('was-validated');
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data && data.message ? data.message : 'Ocurrió un error al guardar el Módulo 2.',
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

                // Quitar is-invalid al cambiar valor
                form.querySelectorAll('input, select').forEach(function(el) {
                    el.addEventListener('change', function() {
                        if (el.type === 'radio') {
                            // Todos los radios del grupo
                            const radios = form.querySelectorAll('input[type="radio"][name="' + el.name + '"]');
                            radios.forEach(function(radio) {
                                radio.classList.remove('is-invalid');
                            });
                            if (el.checked) {
                                radios.forEach(function(radio) {
                                    radio.classList.add('is-valid');
                                });
                            }
                        } else if (el.tagName === 'SELECT') {
                            el.classList.remove('is-invalid', 'is-valid');
                            if (el.value) {
                                el.classList.add('is-valid');
                            }
                        } else {
                            el.classList.remove('is-invalid', 'is-valid');
                            if (el.value) {
                                el.classList.add('is-valid');
                            }
                        }
                    });
                });
            });
        </script>