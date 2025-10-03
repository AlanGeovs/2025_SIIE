<!-- Módulo 6 - Datos legales -->
<div class="tab-pane" id="progress-confirmation">
    <form id="form-modulo-6" novalidate>
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
                    <input type="radio" id="documento-propiedad-si" name="documento-propiedad" value="si" onclick="manejarDocumentoPropiedadCheck()" required>
                    <label for="documento-propiedad-si">Sí</label>

                    <input type="radio" id="documento-propiedad-no" name="documento-propiedad" value="no" onclick="manejarDocumentoPropiedadCheck()" required>
                    <label for="documento-propiedad-no">No</label>
                </div>
            </div>
        </div>

        <!-- Si responde "Sí", mostrar opciones -->
        <div id="documento-propiedad-opciones" class="row align-items-center mt-3" style="display: none;">
            <div class="col-md-6 mb-2">
                <label for="tipo-documento" class="form-label">Selecciona el tipo de documento:</label>
                <select class="form-select" id="tipo-documento" name="tipo-documento" required>
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
                <label class="btn btn-evidencia">
                    Agregar evidencia
                    <input type="file" class="evidencia-input" data-modulo="6_documento_propiedad" style="display:none;">
                </label>
            </div>


        </div>

        <!-- Pregunta 6.1 -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <label class="form-label d-block"><strong>6.1 Tipo de plano del inmueble</strong></label>
            </div>
        </div>

        <div id="tabla-planos-container" class="row mt-2">
            <div class="col-lg-12">
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

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success">
                Guardar Módulo 6 <i class="fas fa-save"></i>
            </button>
        </div>
    </form>

    <!-- Scripts -->
    <script>
        function manejarDocumentoPropiedadCheck() {
            const siChecked = document.getElementById("documento-propiedad-si").checked;
            const opciones = document.getElementById("documento-propiedad-opciones");
            const tipoDocumentoSelect = document.getElementById("tipo-documento");
            opciones.style.display = siChecked ? "flex" : "none";
            if (siChecked) {
                tipoDocumentoSelect.setAttribute("required", "required");
            } else {
                tipoDocumentoSelect.removeAttribute("required");
                tipoDocumentoSelect.value = "";
            }
        }

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

            // Mapeo de tiposPlanos a keys esperados por el backend
            const planoKeys = [
                "plano_arquitectonico",
                "plano_estructural",
                "plano_instalacion",
                "plano_proteccion_civil",
                "plano_topografico",
                "plano_accesibilidad",
                "plano_senalizacion",
                "plano_areas_verdes",
                "plano_mobiliario_equipamiento",
                "plano_zonificacion_uso_espacios"
            ];

            tiposPlanos.forEach((tipo, index) => {
                const key = planoKeys[index] || `plano_otro_${index}`;
                const fila = `
                    <tr>
                        <td class="text-start">${tipo}</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input plano-radio" name="${key}" id="${key}_si" value="si" data-key="${key}">
                                <label class="form-check-label" for="${key}_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input plano-radio" name="${key}" id="${key}_no" value="no" data-key="${key}"> 
                                <label class="form-check-label" for="${key}_no">No</label>
                            </div>
                        </td>
                        <td>
                            <label class="btn btn-evidencia">
                                Agregar evidencia
                                <input type="file" class="evidencia-input" data-modulo="6_${key}" style="display:none;" disabled>
                            </label>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML("beforeend", fila);
            });

            // Add event listeners to radio buttons to enable/disable file inputs
            const radios = document.querySelectorAll(".plano-radio");
            radios.forEach(radio => {
                radio.addEventListener("change", function() {
                    const key = this.getAttribute("data-key");
                    const fileInput = document.querySelector(`input.evidencia-input[data-modulo="6_${key}"]`);
                    if (this.value === "si") {
                        fileInput.disabled = false;
                    } else {
                        fileInput.value = "";
                        fileInput.disabled = true;
                    }
                });
            });
        }

        document.addEventListener("DOMContentLoaded", cargarTablaPlanos);
    </script>

    <script>
        document.getElementById('form-modulo-6').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = this;

            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                Swal.fire({
                    icon: 'error',
                    title: 'Campos obligatorios',
                    text: 'Por favor completa los campos marcados con *'
                });
                return;
            }

            const formData = new FormData(form);
            formData.append('modulo', 6);

            try {
                const resp = await fetch('../controllers/enviadatos_modulo_6.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await resp.json();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Módulo "VI. DATOS LEGALES DEL CENTRO DE TRABAJO" guardado correctamente'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'No se pudo guardar la información'
                    });
                }
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor'
                });
            }
        });
    </script>
</div>