<form id="formMobiliario" class="p-3">
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-sm align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Mobiliario</th>
                    <th>Existencia</th>
                    <th>Cantidad</th>
                    <th>En uso</th>
                    <th>Condición</th>
                    <th style="background-color: #fff;"></th>
                </tr>
            </thead>
            <tbody id="tablaMobiliario"></tbody>
        </table>
    </div>

    <div class="text-end">
        <button type="submit" class="btn text-white" style="background-color:#691c32;">
            <i class="bi bi-save"></i> Guardar información
        </button>
    </div>
</form>

<script>
    const mobiliario = [
        "Archivero", "Banca en vestidores", "Banco", "Butaca", "Butacas para zurdos", "Casillero",
        "Cesto de basura", "Escritorio", "Escritorio para maestro", "Estante", "Mesa", "Mesa binaria",
        "Mesa de laboratorio", "Mesa-banco", "Mesa-banco-binario", "Pizarrón", "Pintarrón", "Silla",
        "Silla con paleta", "Silla para maestro"
    ];

    function generarFila(nombre, tipo) {
        const id = `${tipo}-${nombre.replace(/\s+/g, '-')}`;
        const selectCantidad = `
            <select class="form-select form-select-sm" name="${id}-cantidad">
                <option value="">Selecciona cantidad</option>
                ${[...Array(10)].map((_, i) => `<option value="${i+1}">${i+1}</option>`).join('')}
            </select>`;

        const selectCondicion = `
            <select class="form-select form-select-sm" name="${id}-condicion">
                <option value="">Selecciona condición</option>
                <option value="BUENA">Buena</option>
                <option value="REGULAR">Regular</option>
                <option value="MALA">Mala</option>
            </select>`;

        return `
        <tr>
            <td>${nombre}</td>
            <td>
                <div class="d-inline-flex gap-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input exclusiva" type="radio" name="${id}-existencia" value="SI"> Sí
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input exclusiva" type="radio" name="${id}-existencia" value="NO"> No
                    </div>
                </div>
            </td>
            <td>${selectCantidad}</td>
            <td>
                <div class="d-inline-flex gap-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input exclusiva" type="radio" name="${id}-uso" value="SI"> Sí
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input exclusiva" type="radio" name="${id}-uso" value="NO"> No
                    </div>
                </div>
            </td>
            <td>${selectCondicion}</td>
            <td>
                <label class="btn btn-evidencia btn-sm w-100" style="background-color:#691c32; color:#fff;">
                    Agregar evidencia
                    <input type="file" class="evidencia-input" data-modulo="3-mobiliario-${nombre.replace(/\s+/g, '-').toLowerCase()}" style="display:none;">
                </label>
            </td>
        </tr>`;
    }

    document.addEventListener("DOMContentLoaded", () => {
        const tbodyMobiliario = document.getElementById("tablaMobiliario");
        mobiliario.forEach(item => tbodyMobiliario.insertAdjacentHTML("beforeend", generarFila(item, "mobiliario")));

        // Exclusividad de radios
        document.addEventListener("change", (e) => {
            if (e.target.classList.contains("exclusiva")) {
                const group = e.target.name;
                document.querySelectorAll(`input[name="${group}"]`).forEach(el => {
                    if (el !== e.target) el.checked = false;
                });
            }
        });
    });
</script>