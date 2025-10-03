<div class="tab-pane" id="progress-order-summary">
    <div>
        <form id="formModulo5" class="needs-validation" novalidate>
            <div class="card-header">
                <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">
                    V. INVERSIÓN PÚBLICA
                </h4>
            </div>

            <div class="row mt-3">
                <div class="col-lg-8">
                    <label>
                        5. ¿El Centro de Trabajo fue beneficiado con recursos públicos para obra nueva de
                        <strong>rehabilitación o mantenimiento</strong>? <span style="color: red;">*</span>
                    </label><br>
                    <div>
                        <input type="radio" name="recursos_publicos" id="recursos-si" value="si" required onclick="manejarRecursosCheck()">
                        <label for="recursos-si">Sí</label>
                        <input type="radio" name="recursos_publicos" id="recursos-no" value="no" required onclick="manejarRecursosCheck()">
                        <label for="recursos-no">No</label>
                        <div class="invalid-feedback">Seleccione una opción.</div>
                    </div>
                </div>
            </div>

            <!-- Tabla de años -->
            <div id="anoOptions" style="display:none;" class="mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle" style="max-width: 800px;">
                        <thead class="table-light">
                            <tr>
                                <th>Año</th>
                                <th>¿Hubo recurso?</th>
                                <th>Monto (MXN)</th>
                                <th>Tipo de recurso</th>
                            </tr>
                        </thead>
                        <tbody id="tablaRecursosBody"></tbody>
                    </table>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success">
                    Guardar Módulo 5 <i class="fas fa-save"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function manejarRecursosCheck() {
        const siCheckbox = document.getElementById("recursos-si");
        const anoOptions = document.getElementById("anoOptions");
        if (siCheckbox.checked) {
            anoOptions.style.display = "block";
            generarTablaRecursos();
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

        const tiposRecurso = [
            "Federal",
            "Estatal",
            "Municipal"
        ];

        for (let year = 2017; year <= 2025; year++) {
            let fila = `
                <tr>
                    <td>${year}</td>
                    <td>
                        <input type="checkbox" name="year[${year}]" id="year-${year}" onclick="manejarYearSelection(${year})">
                    </td>
                    <td>
                        <select id="monto-${year}" name="monto[${year}]" class="form-select form-select-sm" disabled>
                            <option value="">Selecciona un rango</option>
                            ${montos.map(m => `<option value="${m}">${m}</option>`).join("")}
                        </select>
                    </td>
                    <td>
                        <select id="tipo-recurso-${year}" name="tipo_recurso[${year}]" class="form-select form-select-sm" disabled>
                            <option value="">Selecciona tipo</option>
                            ${tiposRecurso.map(t => `<option value="${t}">${t}</option>`).join("")}
                        </select>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML("beforeend", fila);
        }
    }

    function manejarYearSelection(year) {
        const montoSelect = document.getElementById(`monto-${year}`);
        const tipoRecursoSelect = document.getElementById(`tipo-recurso-${year}`);
        if (document.getElementById(`year-${year}`).checked) {
            montoSelect.disabled = false;
            tipoRecursoSelect.disabled = false;
        } else {
            montoSelect.value = "";
            montoSelect.disabled = true;
            tipoRecursoSelect.value = "";
            tipoRecursoSelect.disabled = true;
        }
    }

    // --- Envío con fetch ---
    document.getElementById("formModulo5").addEventListener("submit", async function(e) {
        e.preventDefault();
        e.stopPropagation();
        const form = e.target;
        if (!form.checkValidity()) {
            form.classList.add("was-validated");
            return;
        }

        const formData = new FormData(form);
        formData.append("id_ficha", "<?= $_SESSION['id_ficha'] ?? 0 ?>");
        formData.append("cct", "<?= $_SESSION['cct'] ?? '' ?>");
        formData.append("id_usuario", "<?= $_SESSION['usuario_id'] ?? 0 ?>");

        try {
            const resp = await fetch("../controllers/enviadatos_modulo_5.php", {
                method: "POST",
                body: formData
            });
            const data = await resp.json();
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "¡Éxito!",
                    text: "Módulo 5 guardado correctamente."
                }).then(() => {
                    // Redirigir al módulo 6
                    const formPost = document.createElement("form");
                    formPost.method = "POST";
                    formPost.action = "dashboard";
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "modulo";
                    input.value = 6;
                    formPost.appendChild(input);
                    document.body.appendChild(formPost);
                    formPost.submit();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.message || "No se pudo guardar la información."
                });
            }
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Error de conexión con el servidor."
            });
        }
    });
</script>