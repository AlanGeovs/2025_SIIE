<!-- Elementos de infraestructura exterior - tabla visual homogénea optimizada -->
<div class="table-responsive mt-4">
    <table class="table table-bordered table-sm align-middle text-center">
        <thead class="table-light">
            <tr>
                <th class="tituloTablaDestacado" style="background-color: #611232; color: #fff;">Elementos</th>
                <th>Existencia</th>
                <th>Cantidad</th>
                <th>En uso</th>
                <th>Condición</th>
                <th>Daño estructural</th>
                <th>Daño instalación</th>
                <th>Obra en proceso</th>
                <th>Construcción adicional</th>
                <th style="background-color:#fff;"></th>
            </tr>
        </thead>
        <tbody id="tablaElementosExterior"></tbody>
    </table>
</div>
<div class="d-flex justify-content-end mt-4 mb-3">
    <button type="submit" class="btn text-white" style="background-color:#691c32;">
        <i class="bi bi-save"></i> Guardar información
    </button>
</div>

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
    const infraestructuraExterior = [{
            nombre: 'Acceso principal',
            id: 'acceso_principal'
        },
        {
            nombre: 'Alumbrado',
            id: 'alumbrado_exterior'
        },
        {
            nombre: 'Andador',
            id: 'andadores'
        },
        {
            nombre: 'Asta bandera',
            id: 'asta_bandera'
        },
        {
            nombre: 'Barda perimetral',
            id: 'barda_perimetral'
        },
        {
            nombre: 'Bebedero',
            id: 'bebederos'
        },
        {
            nombre: 'Cerco perimetral',
            id: 'cerco_perimetral'
        },
        {
            nombre: 'Contenedor',
            id: 'contenedores'
        },
        {
            nombre: 'Cubo de tinacos',
            id: 'cubo_tinacos'
        },
        {
            nombre: 'Escalera de emergencia',
            id: 'escaleras_emergencia'
        },
        {
            nombre: 'Malla sombra',
            id: 'malla_sombra'
        },
        {
            nombre: 'Mesa con bancas de concreto',
            id: 'mesas_bancas_concreto'
        },
        {
            nombre: 'Muro de acometida',
            id: 'muro_acometida'
        },
        {
            nombre: 'Muro de contención',
            id: 'muro_contencion'
        },
        {
            nombre: 'Pasamanos',
            id: 'pasamanos'
        },
        {
            nombre: 'Rampa',
            id: 'rampas'
        },
        {
            nombre: 'Reja perimetral',
            id: 'reja_perimetral'
        },
        {
            nombre: 'Techumbre',
            id: 'techumbre_canchas'
        }
    ];

    function selectDanioEstructural() {
        const danios = [
            "Exposición de varillas", "Filtraciones en techo", "Fisuras en columnas", "Fisuras en muros", "Flexiones en techo",
            "Humedad en muros", "Hundimiento de pisos", "Inclinación en muros", "Movimiento en muros", "Vibración excesiva"
        ];
        return `<select class="form-select form-select-sm"><option value=''>Selecciona</option>${danios.map(d => `<option>${d}</option>`).join('')}</select>`;
    }

    function selectDanioInstalacion() {
        const danios = [
            "Desperfectos en cancelería", "Desprendimiento de acabados", "Falta de impermeabilizante", "Falta de luminarias",
            "Falta de ventiladores", "Pintura general", "Pisos fisurados"
        ];
        return `<select class="form-select form-select-sm"><option value=''>Selecciona</option>${danios.map(d => `<option>${d}</option>`).join('')}</select>`;
    }

    function selectConstruccionAdicional(areaIndex) {
        return `
      <select class="form-select form-select-sm requiere-construccion" data-area="${areaIndex}">
        <option value="">¿Requiere construcción?</option>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
      <select class="form-select form-select-sm mt-1 cantidad-construccion" data-area="${areaIndex}" disabled>
        <option value="">Cantidad</option>
        ${[...Array(10).keys()].map(i => `<option>${i+1}</option>`).join('')}
      </select>`;
    }

    function obraEnProcesoTemplate(norm) {
        return `
      <div>
        <label><input type="radio" name="obra_${norm}" value="si" onchange="toggleObraEnProceso('${norm}', true)"> Sí</label>
        <label><input type="radio" name="obra_${norm}" value="no" onchange="toggleObraEnProceso('${norm}', false)"> No</label>
        <select id="tipo-obra-${norm}" class="form-select form-select-sm mt-1" disabled>
          <option value="">Tipo</option>
          <option value="Albañilería">Albañilería</option>
          <option value="Pintura">Pintura</option>
          <option value="Reforzamiento">Reforzamiento</option>
          <option value="Plomería">Plomería</option>
          <option value="Red eléctrica">Red eléctrica</option>
        </select>
        <select id="recurso-obra-${norm}" class="form-select form-select-sm mt-1" disabled>
          <option value="">Recurso</option>
          <option value="Federal">Federal</option>
          <option value="Estatal">Estatal</option>
          <option value="Municipal">Municipal</option>
        </select>
      </div>`;
    }

    function crearFilaElemento(elemento) {
        const norm = elemento.id.replace(/\s+/g, '_');
        const fila = `
      <tr>
        <td>${elemento.nombre}</td>
        <td><label><input type="radio" name="existencia_${elemento.id}" value="si"> Sí</label> 
            <label><input type="radio" name="existencia_${elemento.id}" value="no"> No</label></td>
        <td><select class="form-select form-select-sm">${[...Array(10).keys()].map(i => `<option>${i+1}</option>`).join('')}</select></td>
        <td><label><input type="radio" name="uso_${elemento.id}" value="si"> Sí</label> 
            <label><input type="radio" name="uso_${elemento.id}" value="no"> No</label></td>
        <td>
          <select class="form-select form-select-sm">
            <option value="">Selecciona</option>
            <option>Buena</option> 
            <option>Regular</option>
            <option>Mala</option>
          </select>
        </td>
        <td>${selectDanioEstructural()}</td>
        <td>${selectDanioInstalacion()}</td>
        <td>${obraEnProcesoTemplate(norm)}</td>
        <td>${selectConstruccionAdicional(elemento.id)}</td>
        <td><button type="button" class="btn btn-evidencia btn-sm">Agregar evidencia</button></td>
      </tr>`;
        document.getElementById("tablaElementosExterior").insertAdjacentHTML("beforeend", fila);
    }

    document.addEventListener("DOMContentLoaded", () => {
        infraestructuraExterior.forEach(c => crearFilaElemento(c));
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
</script>