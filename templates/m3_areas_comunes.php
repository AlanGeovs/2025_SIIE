<div class="bd-callout bd-callout-primary" style="border-left: 4px solid #2563eb; background-color: #f0f7ff; padding: 1rem; border-radius: 0.25rem; margin-bottom: 1rem;">
    <p class="mb-0" style="color: #2563eb;">

        <i class="bi bi-info-circle-fill"></i>
        <strong>Asigna una letra a las áreas comunes</strong>, empezando por la de mayor tamaño o uso -e importancia-, y concluyendo con la de menor.
    </p>
</div>
<!-- Áreas comunes - tabla visual homogénea optimizada -->
<form id="formAreasComunes">
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-sm align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th style="background-color: #2563eb; color: #fff;">Letra</th>
                    <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Áreas comunes</th>
                    <th>Existencia</th>
                    <th>Cantidad</th>
                    <th>Está en uso</th>
                    <th>Condición</th>
                    <th>Daño estructural</th>
                    <th>Daño instalación</th>
                    <th>Obra en proceso</th>
                    <th>Construcción adicional</th>
                    <th style="background-color:#fff;"></th>
                </tr>
            </thead>
            <tbody id="tablaAreasComunes2"></tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-4 mb-3">
        <button type="submit" class="btn text-white" style="background-color:#691c32;">
            <i class="bi bi-save"></i> Guardar información
        </button>
    </div>
</form>

<style>
    .btn-evidencia {
        background-color: #691c32 !important;
        color: #fff !important;
        border: none;
        padding: 0.32rem 0.8rem;
        font-size: 0.95em;
        border-radius: 0.3rem;
        transition: background 0.2s;
    }

    .btn-evidencia:hover,
    .btn-evidencia:focus {
        background-color: #611232 !important;
        color: #fff !important;
    }
</style>

<script>
    const comunes = [{
            id_articulo: 60,
            nombre: 'Alberca'
        },
        {
            id_articulo: 61,
            nombre: 'Área de juegos infantiles'
        },
        {
            id_articulo: 62,
            nombre: 'Área verde'
        },
        {
            id_articulo: 63,
            nombre: 'Arenero'
        },
        {
            id_articulo: 64,
            nombre: 'Auditorio'
        },
        {
            id_articulo: 65,
            nombre: 'Cancha deportiva'
        },
        {
            id_articulo: 66,
            nombre: 'Chapoteadero'
        },
        {
            id_articulo: 67,
            nombre: 'Estacionamiento'
        },
        {
            id_articulo: 68,
            nombre: 'Gimnasio'
        },
        {
            id_articulo: 69,
            nombre: 'Gradas'
        },
        {
            id_articulo: 70,
            nombre: 'Invernadero'
        },
        {
            id_articulo: 71,
            nombre: 'Kiosco'
        },
        {
            id_articulo: 72,
            nombre: 'Parcela de cultivo'
        },
        {
            id_articulo: 73,
            nombre: 'Plaza cívica'
        }
    ];

    function selectDanioEstructural() {
        const danios = [
            "Exposición de varillas", "Filtraciones en techo", "Fisuras en columnas", "Fisuras en muros", "Flexiones en techo",
            "Humedad en muros", "Hundimiento de pisos", "Inclinación en muros", "Movimiento en muros", "Vibración excesiva"
        ];
        return `<select class="form-select form-select-sm" data-field="danio_estructural"><option value=''>Selecciona</option>${danios.map(d => `<option>${d}</option>`).join('')}</select>`;
    }

    function selectDanioInstalacion() {
        const danios = [
            "Desperfectos en cancelería", "Desprendimiento de acabados", "Falta de impermeabilizante", "Falta de luminarias",
            "Falta de ventiladores", "Pintura general", "Pisos fisurados"
        ];
        return `<select class="form-select form-select-sm" data-field="danio_instalacion"><option value=''>Selecciona</option>${danios.map(d => `<option>${d}</option>`).join('')}</select>`;
    }

    function selectConstruccionAdicional(areaIndex) {
        return `
      <select class="form-select form-select-sm requiere-construccion" data-area="${areaIndex}" data-field="construccion_adicional">
        <option value="">¿Requiere construcción?</option>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
      <select class="form-select form-select-sm mt-1 cantidad-construccion" data-area="${areaIndex}" data-field="cantidad_construccion" disabled>
        <option value="">Cantidad</option>
        ${[...Array(10).keys()].map(i => `<option>${i+1}</option>`).join('')}
      </select>`;
    }

    function obraEnProcesoTemplate(norm) {
        return `
      <div>
        <label><input type="radio" name="obra_${norm}" value="si" data-field="obra_proceso" onchange="toggleObraEnProceso('${norm}', true)"> Sí</label>
        <label><input type="radio" name="obra_${norm}" value="no" data-field="obra_proceso" onchange="toggleObraEnProceso('${norm}', false)"> No</label>
        <select id="tipo-obra-${norm}" class="form-select form-select-sm mt-1" data-field="tipo_obra" disabled>
          <option value="">Tipo</option>
          <option value="Albañilería">Albañilería</option>
          <option value="Pintura">Pintura</option>
          <option value="Reforzamiento">Reforzamiento</option>
          <option value="Plomería">Plomería</option>
          <option value="Red eléctrica">Red eléctrica</option>
        </select>
        <select id="recurso-obra-${norm}" class="form-select form-select-sm mt-1" data-field="recurso_obra" disabled>
          <option value="">Recurso</option>
          <option value="Federal">Federal</option>
          <option value="Estatal">Estatal</option>
          <option value="Municipal">Municipal</option>
        </select>
      </div>`;
    }

    function crearFilaComun(comun, index) {
        const norm = comun.id_articulo.toString().replace(/\s+/g, '_');
        const fila = `
      <tr data-id-articulo="${comun.id_articulo}">
        <td>
          <select class="form-select form-select-sm" data-field="letra">
            ${[...Array(26).keys()].map(i => `<option>${String.fromCharCode(65+i)}</option>`).join('')}
          </select>
        </td>
        <td>${comun.nombre}</td>
        <td><label><input type="radio" name="existencia_${comun.id_articulo}" value="si" data-field="existencia">Sí</label> 
            <label><input type="radio" name="existencia_${comun.id_articulo}" value="no" data-field="existencia">No</label></td>
        <td><select class="form-select form-select-sm" data-field="cantidad">${[...Array(10).keys()].map(i => `<option>${i+1}</option>`).join('')}</select></td>
        <td><label><input type="radio" name="uso_${comun.id_articulo}" value="si" data-field="uso">Sí</label> 
            <label><input type="radio" name="uso_${comun.id_articulo}" value="no" data-field="uso">No</label></td> 
        <td>
          <select class="form-select form-select-sm" data-field="condicion">
            <option value="">Selecciona</option>
            <option>Buena</option>
            <option>Regular</option>
            <option>Mala</option>
          </select>
        </td>
        <td>${selectDanioEstructural()}</td>
        <td>${selectDanioInstalacion()}</td>
        <td>${obraEnProcesoTemplate(norm)}</td> 
        <td>${selectConstruccionAdicional(comun.id_articulo)}</td>
        <td>
          <label class="btn btn-evidencia btn-sm mb-0">
            Agregar evidencia
            <input type="file" class="evidencia-input d-none" data-modulo="m3_areas_comunes">
          </label>
        </td>
      </tr>`;
        document.getElementById("tablaAreasComunes2").insertAdjacentHTML("beforeend", fila);
    }

    document.addEventListener("DOMContentLoaded", () => {
        comunes.forEach((c, i) => crearFilaComun(c, i));
        document.addEventListener("change", e => {
            if (e.target.classList.contains("requiere-construccion")) {
                const area = e.target.dataset.area;
                const cantidadSelect = document.querySelector(`.cantidad-construccion[data-area="${area}"]`);
                cantidadSelect.disabled = (e.target.value !== "si");
            }
        });
    });

    function toggleObraEnProceso(norm, enabled) {
        const tipo = document.getElementById('tipo-obra-' + norm);
        const recurso = document.getElementById('recurso-obra-' + norm);
        if (tipo && recurso) {
            tipo.disabled = !enabled;
            recurso.disabled = !enabled;
            if (!enabled) {
                tipo.value = "";
                recurso.value = "";
            }
        }
    }

    function recolectarDatosAreasComunes() {
        const rows = document.querySelectorAll('#tablaAreasComunes2 tr');
        const datos = [];
        rows.forEach(row => {
            const id_articulo = parseInt(row.getAttribute('data-id-articulo'));
            const nombre = row.querySelector('td:nth-child(2)').textContent.trim();
            // Existencia radios
            let existencia = "";
            const existenciaRadios = row.querySelectorAll('input[type="radio"][data-field="existencia"]');
            existenciaRadios.forEach(radio => {
                if (radio.checked) existencia = radio.value;
            });
            // Cantidad select
            const cantidadSelect = row.querySelector('[data-field="cantidad"]');
            const cantidad = cantidadSelect ? cantidadSelect.value : "";
            // Uso radios
            let uso = "";
            const usoRadios = row.querySelectorAll('input[type="radio"][data-field="uso"]');
            usoRadios.forEach(radio => {
                if (radio.checked) uso = radio.value;
            });
            // Condicion select
            const condicionSelect = row.querySelector('[data-field="condicion"]');
            const condicion = condicionSelect ? condicionSelect.value : "";
            // Daño estructural select
            const danioEstructuralSelect = row.querySelector('[data-field="danio_estructural"]');
            const danio_estructural = danioEstructuralSelect ? danioEstructuralSelect.value : "";
            // Daño instalación select
            const danioInstalacionSelect = row.querySelector('[data-field="danio_instalacion"]');
            const danio_instalacion = danioInstalacionSelect ? danioInstalacionSelect.value : "";
            // Obra en proceso radios
            let obra_en_proceso = "";
            const obraRadios = row.querySelectorAll('input[type="radio"][data-field="obra_proceso"]');
            obraRadios.forEach(radio => {
                if (radio.checked) obra_en_proceso = radio.value;
            });
            // Tipo obra select
            const tipoObraSelect = row.querySelector('[data-field="tipo_obra"]');
            const tipo_obra = tipoObraSelect ? tipoObraSelect.value : "";
            // Recurso obra select
            const recursoObraSelect = row.querySelector('[data-field="recurso_obra"]');
            const recurso_obra = recursoObraSelect ? recursoObraSelect.value : "";
            // Construccion adicional select
            const construccionAdicionalSelect = row.querySelector('[data-field="construccion_adicional"]');
            const construccion_adicional = construccionAdicionalSelect ? construccionAdicionalSelect.value : "";
            // Cantidad construccion select
            const cantidadConstruccionSelect = row.querySelector('[data-field="cantidad_construccion"]');
            const cantidad_construccion = cantidadConstruccionSelect ? cantidadConstruccionSelect.value : "";

            datos.push({
                letra: row.querySelector('[data-field="letra"]') ? row.querySelector('[data-field="letra"]').value : "",
                nombre,
                id_articulo,
                existencia,
                cantidad,
                uso,
                condicion,
                danio_estructural,
                danio_instalacion,
                obra_en_proceso,
                tipo_obra,
                recurso_obra,
                construccion_adicional,
                cantidad_construccion
            });
        });
        return datos;
    }

    document.getElementById('formAreasComunes').addEventListener('submit', function(e) {
        e.preventDefault();
        const data = recolectarDatosAreasComunes();
        fetch('/controllers/guardar_areascomunes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Error en la respuesta');
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Información guardada correctamente.'
                    }).then(() => {
                        const modalEl = document.getElementById('modalAreasComunes');
                        if (modalEl) {
                            const modalInstance = bootstrap.Modal.getInstance(modalEl) || bootstrap.Modal.getOrCreateInstance(modalEl);
                            modalInstance.hide();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message || 'Error al guardar la información.'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al guardar la información.'
                });
                console.error(error);
            });
    });
</script>