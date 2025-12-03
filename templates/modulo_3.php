<?php
require_once __DIR__ . '/../config/db.php';

$id_ficha = $_SESSION['id_ficha'] ?? 0;

$id_modulo3 = null;
$numEdificaciones = 0;

if ($id_ficha) {
    $stmt = $pdo->prepare("SELECT id_modulo3, num_edificaciones FROM modulo_3 WHERE id_ficha = :id_ficha LIMIT 1");
    $stmt->execute(['id_ficha' => $id_ficha]);
    $modulo3 = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($modulo3) {
        $id_modulo3 = $modulo3['id_modulo3'];
        $numEdificaciones = (int)$modulo3['num_edificaciones'];
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="card-header">
    <h4 class="card-title mb-0" style="color: #611232; font-size: 24px; font-weight: bold;">
        III. DESCRIPCIÓN DE LA INFRAESTRUCTURA DEL CENTRO DE TRABAJO
    </h4>
</div>

<div class="card-body">
    <ul class="nav nav-tabs mb-3" id="infraTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-interna" data-bs-toggle="tab" data-bs-target="#panel-interna" type="button" role="tab" aria-controls="panel-interna" aria-selected="true">
                3.1 Análisis de infraestructura interna
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-externa" data-bs-toggle="tab" data-bs-target="#panel-externa" type="button" role="tab" aria-controls="panel-externa" aria-selected="false">
                3.2 Análisis de infraestructura externa
            </button>
        </li>
    </ul>
    <div class="tab-content" id="infraTabsContent">
        <div class="tab-pane fade show active" id="panel-interna" role="tabpanel" aria-labelledby="tab-interna">
            <!-- Infra Interna -->

            <?php if (empty($id_modulo3)): ?>
                <form id="form-edificaciones-modulo3">
                    <div class="mb-3 row align-items-center">
                        <label for="numEdificaciones" class="col-sm-4 col-form-label fw-bold">Número de edificaciones:</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="numEdificaciones" name="numEdificaciones">
                                <option value="" selected disabled>Seleccione...</option>
                                <?php for ($i = 1; $i <= 50; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>


                    <div id="tablaEdificacionesContainer" style="display:none;">
                        <div class="bd-callout bd-callout-danger d-flex align-items-start mt-2 p-3" id="mensajeEdificios" style="display:none;">
                            <i class="bi bi-exclamation-triangle-fill me-2 flex-shrink-0" style="font-size: 1.2rem; margin-top: 2px; color: #842029;"></i>
                            <div>
                                Asigna un <b>número a cada edificio</b>, empezando por el de mayor tamaño o uso -e importancia-, y concluyendo con el menor.
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0" id="tablaEdificaciones">
                                <thead class="table-light">
                                    <tr>
                                        <th style="min-width: 180px;">Número de edificio</th>
                                        <th style="min-width: 180px;">Número de niveles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows generated dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Guardar número de Edificio y niveles</button>
                </form>
            <?php elseif ($numEdificaciones > 0): ?>
                <?php
                // Consultar modulo_3_edificaciones para el id_ficha actual
                $stmtEdificios = $pdo->prepare("SELECT edificio_num, MAX(nivel) AS max_nivel FROM modulo_3_edificaciones WHERE id_ficha = :id_ficha GROUP BY edificio_num");
                $stmtEdificios->execute(['id_ficha' => $id_ficha]);
                $edificacionesData = $stmtEdificios->fetchAll(PDO::FETCH_ASSOC);

                // Crear un arreglo asociativo para acceso rápido: edificio_num => max_nivel
                $maxNivelesPorEdificio = [];
                foreach ($edificacionesData as $edificio) {
                    $maxNivelesPorEdificio[(int)$edificio['edificio_num']] = (int)$edificio['max_nivel'];
                }

                // Obtener estatus de areas_principales, areas_adicionales, mobiliario y equipo por edificio/nivel
                $stmtStatus = $pdo->prepare("
                    SELECT edificio_num, nivel, areas_principales, areas_adicionales, mobiliario, equipo
                    FROM modulo_3_edificaciones
                    WHERE id_ficha = :id_ficha
                ");
                $stmtStatus->execute(['id_ficha' => $id_ficha]);
                $statusData = $stmtStatus->fetchAll(PDO::FETCH_ASSOC);
                $statusMap = [];
                foreach ($statusData as $row) {
                    $statusMap[$row['edificio_num']][$row['nivel']] = [
                        'areas_principales' => (int)$row['areas_principales'],
                        'areas_adicionales' => (int)$row['areas_adicionales'],
                        'mobiliario' => (int)$row['mobiliario'],
                        'equipo' => (int)$row['equipo']
                    ];
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nivel 1</th>
                                <th>Nivel 2</th>
                                <th>Nivel 3</th>
                                <th>Nivel 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($edificio = 1; $edificio <= $numEdificaciones; $edificio++): ?>
                                <tr>
                                    <td><?php echo "Edificio $edificio"; ?></td>
                                    <?php
                                    $maxNivel = $maxNivelesPorEdificio[$edificio] ?? 0;
                                    for ($nivel = 1; $nivel <= 4; $nivel++):
                                        if ($nivel <= $maxNivel):
                                            // Obtener el estatus de cada botón
                                            $status = $statusMap[$edificio][$nivel] ?? [
                                                'areas_principales' => 0,
                                                'areas_adicionales' => 0,
                                                'mobiliario' => 0,
                                                'equipo' => 0
                                            ];
                                    ?>
                                            <td>
                                                <button class="btn <?php echo $status['areas_principales'] ? 'btn-secondary' : 'btn-danger'; ?> btn-sm m-1"
                                                    <?php echo $status['areas_principales'] ? 'disabled' : ''; ?>
                                                    data-edificio="<?php echo $edificio; ?>"
                                                    data-nivel="<?php echo $nivel; ?>"
                                                    data-form="areas_principales"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-title="Áreas principales">
                                                    <i class="bi bi-building"></i>
                                                </button>
                                                <button class="btn <?php echo $status['areas_adicionales'] ? 'btn-secondary' : 'btn-danger'; ?> btn-sm m-1"
                                                    <?php echo $status['areas_adicionales'] ? 'disabled' : ''; ?>
                                                    data-edificio="<?php echo $edificio; ?>"
                                                    data-nivel="<?php echo $nivel; ?>"
                                                    data-form="areas_adicionales"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-title="Áreas adicionales">
                                                    <i class="bi bi-plus-circle"></i>
                                                </button>
                                                <button class="btn <?php echo $status['mobiliario'] ? 'btn-secondary' : 'btn-danger'; ?> btn-sm m-1"
                                                    <?php echo $status['mobiliario'] ? 'disabled' : ''; ?>
                                                    data-edificio="<?php echo $edificio; ?>"
                                                    data-nivel="<?php echo $nivel; ?>"
                                                    data-form="mobiliario"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-title="Mobiliario">
                                                    <i class="bi bi-easel2"></i>
                                                </button>
                                                <button class="btn <?php echo $status['equipo'] ? 'btn-secondary' : 'btn-danger'; ?> btn-sm m-1"
                                                    <?php echo $status['equipo'] ? 'disabled' : ''; ?>
                                                    data-edificio="<?php echo $edificio; ?>"
                                                    data-nivel="<?php echo $nivel; ?>"
                                                    data-form="equipo"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-title="Equipo">
                                                    <i class="bi bi-laptop"></i>
                                                </button>
                                            </td>
                                        <?php else: ?>
                                            <td class="text-center">-</td>
                                    <?php endif;
                                    endfor;
                                    ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="panel-externa" role="tabpanel" aria-labelledby="tab-externa">
            <!--  Infraestructura Externa -->
            <div class="mt-3">
                <span class="fw-bold">3.2.1 ¿Cuántas áreas comunes tiene el inmueble?</span>
                <br><br>
                <select id="cantidad_areas_comunes" class="form-control mb-3" onchange="generateAreasTable()">
                    <option value="0">Selecciona una opción</option>
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

                <div class="mt-3 mb-3 d-flex gap-3">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_areas_comunes">
                        <i class="bi bi-tree-fill me-2"></i> Áreas comunes
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_elementos">
                        <i class="bi bi-lightbulb-fill me-2"></i> Elementos
                    </button>
                </div>

                <div id="tabla_areas_comunes_container" style="display:none;">
                    <div class="bd-callout bd-callout-primary d-flex align-items-start mt-2 p-3" id="mensajeAreas" style="display:none;">
                        <i class="bi bi-info-circle-fill me-2 flex-shrink-0" style="font-size: 1.2rem; margin-top: 2px; color: #2563eb;"></i>
                        <div>
                            Asigna una <b>letra a las áreas comunes</b> existentes, empezando por la mayor y de más uso (e importancia), y concluyendo con la de menor tamaño.
                        </div>
                    </div>
                    <!-- Aquí se podrá generar dinámicamente la tabla de áreas comunes -->
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Eliminado CSS personalizado para list-group-checkable */
    .bd-callout.bd-callout-danger {
        border-left: 4px solid #dc3545;
        background-color: #f8d7da;
        padding: 1rem 1rem;
        border-radius: 0.375rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        color: #842029;
    }

    .bd-callout.bd-callout-danger i {
        margin-top: 0.2rem;
        color: #842029;
    }

    .bd-callout.bd-callout-primary {
        border-left: 4px solid #2563eb;
        background-color: #dbeafe;
        padding: 1rem 1rem;
        border-radius: 0.375rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        color: #1e40af;
    }

    .bd-callout.bd-callout-primary i {
        color: #2563eb;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const numEdificaciones = document.getElementById('numEdificaciones');
        const tablaBody = document.querySelector('#tablaEdificaciones tbody');
        const tablaContainer = document.getElementById('tablaEdificacionesContainer');
        const mensajeEdificios = document.getElementById('mensajeEdificios');
        const formEdificaciones = document.getElementById('form-edificaciones-modulo3');

        /**
         * Construye un select Bootstrap con opciones para seleccionar niveles (1 a 4).
         * nameAttr: nombre del select (único por fila)
         */
        function buildNivelesList(nameAttr, rowIdx) {
            return `
                <select class="form-select" name="${nameAttr}" id="niveles_${rowIdx}">
                    <option value="" selected disabled>Seleccione...</option>
                    <option value="1">1 nivel — Planta baja.</option>
                    <option value="2">2 niveles — Planta baja y 1er piso.</option>
                    <option value="3">3 niveles — Planta baja, 1er y 2do piso.</option>
                    <option value="4">4 niveles — Planta baja, 1er, 2do y 3er piso.</option>
                </select>
            `;
        }

        /**
         * Genera las filas de la tabla en función del total de edificaciones seleccionado.
         * Columna 1: select de número de edificio (sin duplicados).
         * Columna 2: select para número de niveles (1 a 4).
         */
        function createEdificacionesRows(total) {
            tablaBody.innerHTML = '';

            for (let i = 0; i < total; i++) {
                const tr = document.createElement('tr');

                // --- Columna: Número de edificio (select) ---
                const tdNum = document.createElement('td');
                const selectNum = document.createElement('select');
                selectNum.className = 'form-select edificio-num';
                selectNum.name = `edificio_num[${i}]`;
                selectNum.setAttribute('data-row', String(i));
                selectNum.innerHTML = '<option value="" selected disabled>Seleccione...</option>';
                for (let j = 1; j <= total; j++) {
                    const opt = document.createElement('option');
                    opt.value = String(j);
                    opt.textContent = String(j);
                    selectNum.appendChild(opt);
                }
                tdNum.appendChild(selectNum);

                // --- Columna: Número de niveles (select) --- 
                const tdNivel = document.createElement('td');
                tdNivel.innerHTML = buildNivelesList(`edificio_niveles[${i}]`, i);

                tr.appendChild(tdNum);
                tr.appendChild(tdNivel);
                tablaBody.appendChild(tr);
            }

            // Después de construir todas las filas, enganchar listeners para controlar duplicados
            setTimeout(attachNoDuplicateHandlers, 0);
        }

        /**
         * Deshabilita en cada select las opciones que ya están elegidas en otros selects.
         * Permite conservar la opción actual del propio select.
         */
        function updateEdificioOptions() {
            const selects = Array.from(document.querySelectorAll('.edificio-num'));
            const used = selects
                .map(sel => sel.value)
                .filter(val => val !== null && val !== '');

            selects.forEach(sel => {
                const current = sel.value;
                Array.from(sel.options).forEach(opt => {
                    if (!opt.value) return; // saltar placeholder
                    // Deshabilitar si está usada en otro select distinto a éste
                    if (used.includes(opt.value) && opt.value !== current) {
                        opt.disabled = true;
                    } else {
                        opt.disabled = false;
                    }
                });
            });
        }

        /**
         * Conecta change handlers a todos los selects de número de edificio para
         * mantener la restricción de no-duplicados actualizada.
         */
        function attachNoDuplicateHandlers() {
            document.querySelectorAll('.edificio-num').forEach(sel => {
                sel.addEventListener('change', updateEdificioOptions);
            });
            // Llamada inicial por si el usuario ya seleccionó algo
            updateEdificioOptions();
        }

        // Evento principal: cambia el número total de edificaciones
        if (numEdificaciones) {
            numEdificaciones.addEventListener('change', function() {
                const total = parseInt(this.value, 10);
                if (!isNaN(total) && total > 0) {
                    createEdificacionesRows(total);
                    tablaContainer.style.display = 'block';
                    mensajeEdificios.style.display = 'block';
                } else {
                    tablaBody.innerHTML = '';
                    tablaContainer.style.display = 'none';
                    mensajeEdificios.style.display = 'none';
                }
            });
        }

        // Manejador submit para enviar datos via fetch
        if (formEdificaciones) {
            formEdificaciones.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(formEdificaciones);

                fetch('../controllers/enviadatos_edificios_modulo_3.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.text();
                        } else {
                            throw new Error('Error en la respuesta del servidor');
                        }
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Datos guardados',
                            text: 'La información de edificios y niveles se ha guardado correctamente.',
                            confirmButtonText: 'Aceptar'
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error al guardar los datos. Intente nuevamente.',
                            confirmButtonText: 'Aceptar'
                        });
                    });
            });
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
    });
</script>

<!-- Modales de captura por tipo de área -->
<?php
$modales = [
    'areas_principales' => 'Áreas principales',
    'areas_adicionales' => 'Áreas adicionales',
    'mobiliario' => 'Mobiliario',
    'equipo' => 'Equipo'
];
foreach ($modales as $key => $title):
?>
    <div class="modal fade" id="modal_<?php echo $key; ?>" tabindex="-1" aria-labelledby="label_<?php echo $key; ?>" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-scrollable" style="max-width: 95%;">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #691c32;">
                    <h5 class="modal-title" id="label_<?php echo $key; ?>">
                        <?php echo $title; ?> — <span id="modalEdificio_<?php echo $key; ?>"></span> / <span id="modalNivel_<?php echo $key; ?>"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-0">
                    <?php include __DIR__ . "/m3_{$key}.php"; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="modal_areas_comunes" tabindex="-1" aria-labelledby="label_areas_comunes" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-scrollable" style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #691c32;">
                <h5 class="modal-title" id="label_areas_comunes">Áreas comunes</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <?php include __DIR__ . "/m3_areas_comunes.php"; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_elementos" tabindex="-1" aria-labelledby="label_elementos" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-scrollable" style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #691c32;">
                <h5 class="modal-title" id="label_elementos">Elementos</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <?php include __DIR__ . "/m3_elementos.php"; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Escuchar clics en los botones de cada celda y abrir el modal correspondiente 
    document.addEventListener('click', function(e) {
        if (e.target.closest('button[data-form]')) {
            const btn = e.target.closest('button[data-form]');
            const tipo = btn.dataset.form;
            const edificio = btn.dataset.edificio;
            const nivel = btn.dataset.nivel;

            // Asignar datos dinámicos en encabezado del modal
            document.getElementById(`modalEdificio_${tipo}`).textContent = `Edificio ${edificio}`;
            document.getElementById(`modalNivel_${tipo}`).textContent = `Nivel ${nivel}`;

            // Mostrar modal correspondiente
            const modal = new bootstrap.Modal(document.getElementById(`modal_${tipo}`));
            modal.show();
        }
    });
</script>