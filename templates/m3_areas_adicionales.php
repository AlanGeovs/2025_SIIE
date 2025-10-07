<form id="formAreasAdicionales" class="p-3">
<style>
  /* Resalta filas específicas de la tabla (sobrescribe estilos de Bootstrap en celdas) */
  .fila-resaltada > td {
    background-color: #f2f2f2 !important;
  }
</style>


    <!-- Áreas adicionales -->
    <div class="table-responsive mb-4">
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
                    <th>Obra en proceso</th>
                    <th>Requiere construcción adicional</th>
                    <th>Evidencia</th>
                </tr>
            </thead>
            <tbody id="tablaAreasAdicionales"></tbody>
        </table>
    </div>

    <div class="text-end">
        <button type="submit" class="btn text-white" style="background-color:#691c32;">
            <i class="bi bi-save"></i> Guardar información
        </button>
    </div>

</form>

<script>
    // === Configuración de áreas adicionales ===
    const areasAdicionales = [
        "Administrativa", "Biblioteca", "Bodega", "Casa del conserje", "Casa del maestro",
        "Centro de cómputo", "Cocina", "Comedor", "Dormitorio", "Intendencia", "Laboratorio",
        "Pórtico", "Sala de usos múltiples", "Subdirección", "Taller", "Vestidor"
    ];

    // Utilidad para generar un "slug" sin acentos/espacios para usar en name/id
    function slugify(text) {
        return text
            .toString()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // quitar acentos
            .replace(/\s+/g, '_') // espacios por guión bajo
            .replace(/[^\w\-]+/g, '') // quitar no alfanumérico
            .toLowerCase();
    }

    // --- Helpers HTML ---
    function selectTipoConstruccion(nameAttr) {
        return `
        <select class="form-select form-select-sm" name="${nameAttr}">
            <option value="">Selecciona tipo</option>
            <option value="LIGERA">Ligera</option>
            <option value="TRADICIONAL">Tradicional</option>
            <option value="MIXTA">Mixta</option>
        </select>`;
    }

    function selectCantidad(nameAttr, max = 10) {
        return `
        <select class="form-select form-select-sm" name="${nameAttr}">
            <option value="">Selecciona cantidad</option>
            ${[...Array(max)].map((_, i) => `<option value="${i+1}">${i+1}</option>`).join('')}
        </select>`;
    }

    function radiosSiNo(nameAttr) {
        const idBase = nameAttr.replace(/\W+/g, '_');
        return `
        <div class="d-inline-flex gap-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="${idBase}_si" name="${nameAttr}" value="SI">
                <label class="form-check-label" for="${idBase}_si">Sí</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="${idBase}_no" name="${nameAttr}" value="NO">
                <label class="form-check-label" for="${idBase}_no">No</label>
            </div>
        </div>`;
    }

    function selectCondicion(nameAttr) {
        return `
        <select class="form-select form-select-sm" name="${nameAttr}">
            <option value="">Selecciona condición</option>
            <option value="BUENA">Buena</option>
            <option value="REGULAR">Regular</option>
            <option value="MALA">Mala</option>
        </select>`;
    }

    function obraEnProcesoBlock(slug) {
        // name/id consistentes
        const nameObra = `aa_obra_${slug}`;
        const idBase = `aa_obra_${slug}`;
        const tipoObraId = `tipo-obra-${slug}`;
        const recursoObraId = `recurso-obra-${slug}`;
        const nameTipoObra = `aa_tipo_obra_${slug}`;
        const nameRecursoObra = `aa_recurso_obra_${slug}`;

        return `
        <div>
            <div class="d-inline-flex gap-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input obra-toggle" type="radio" id="${idBase}_si" name="${nameObra}" value="SI" data-slug="${slug}">
                    <label class="form-check-label" for="${idBase}_si">Sí</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input obra-toggle" type="radio" id="${idBase}_no" name="${nameObra}" value="NO" data-slug="${slug}">
                    <label class="form-check-label" for="${idBase}_no">No</label>
                </div>
            </div>
            <div class="mt-1">
                <select id="${tipoObraId}" name="${nameTipoObra}" class="form-select form-select-sm mt-1" disabled>
                    <option value="">Tipo de obra</option>
                    <option value="Albañileria">Albañilería</option>
                    <option value="Pintura y acabados">Pintura y acabados</option>
                    <option value="Reforzamiento de estructuras">Reforzamiento de estructuras</option>
                    <option value="Herreria">Herrería</option>
                    <option value="Plomeria">Plomería</option>
                    <option value="Impermeabilizacion">Impermeabilización</option>
                    <option value="Red electrica">Red eléctrica</option>
                    <option value="Red hidraulica">Red hidráulica</option>
                    <option value="Carpinteria">Carpintería</option>
                    <option value="Urbanismo">Urbanismo</option>
                </select>
                <select id="${recursoObraId}" name="${nameRecursoObra}" class="form-select form-select-sm mt-1" disabled>
                    <option value="">Recurso</option>
                    <option value="Federal">Federal</option>
                    <option value="Estatal">Estatal</option>
                    <option value="Municipal">Municipal</option>
                </select>
            </div>
        </div>`;
    }

    function evidenciaButton(slug) {
        return `
        <label class="btn btn-evidencia btn-sm w-100">
            Agregar evidencia
            <input type="file" class="evidencia-input" data-modulo="3-areas-adicionales-${slug}" style="display:none;">
        </label>`;
    }

    // Construye una fila para un área adicional
    function crearFilaAreaAdicional(area) {
        const slug = slugify(area);
        const rowClass = (area === "Casa del conserje" || area === "Casa del maestro") ? ' class="fila-resaltada"' : '';
        return `
        <tr${rowClass}>
            <td class="text-start">${area}</td>
            <td>${radiosSiNo('aa_existe_' + slug)}</td>
            <td>${selectTipoConstruccion('aa_tipo_construccion_' + slug)}</td>
            <td>${selectCantidad('aa_cantidad_' + slug)}</td>
            <td>${radiosSiNo('aa_uso_' + slug)}</td>
            <td>${selectCondicion('aa_condicion_' + slug)}</td>
            <td>${radiosSiNo('aa_danio_estructural_' + slug)}</td>
            <td>${radiosSiNo('aa_danio_instalacion_' + slug)}</td>
            <td>${obraEnProcesoBlock(slug)}</td>
            <td>${radiosSiNo('aa_construccion_adicional_' + slug)}</td>  
            <td>${evidenciaButton(slug)}</td>
        </tr>`;
    }

    // Render de tabla (solo áreas adicionales)
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("tablaAreasAdicionales");
        tbody.innerHTML = "";
        areasAdicionales.forEach(area => {
            tbody.insertAdjacentHTML("beforeend", crearFilaAreaAdicional(area));
        });

        // Habilitar/Deshabilitar selects de obra en proceso
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('obra-toggle')) {
                const slug = e.target.dataset.slug;
                const enable = (e.target.value === 'SI');
                const tipo = document.getElementById('tipo-obra-' + slug);
                const recurso = document.getElementById('recurso-obra-' + slug);
                if (tipo && recurso) {
                    tipo.disabled = !enable;
                    recurso.disabled = !enable;
                    if (!enable) {
                        tipo.value = "";
                        recurso.value = "";
                    }
                }
            }
        });
    });
</script>