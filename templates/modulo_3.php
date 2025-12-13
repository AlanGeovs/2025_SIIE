<script type="text/javascript" src="../js/jquery.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<script>
    function agregaEdificio(idusuario, cct) {
        var ne = document.getElementsByName("nem3")[0].value;
        var nn = document.getElementsByName("nnm3")[0].value;
        var data = {
            "control": 1,
            "idusu": idusuario,
            "cct": cct,
            "ne": ne,
            "nn": nn
        }
        $.ajax({
            type: 'POST',
            url: "../controllers/control_vista_modulo3.php",
            data: data,
            beforeSend: function() {

            },
            success: function(response) {

                muestraEdificio(idusuario);


            },
        });
    }

    function muestraEdificio(idusuario) {
        var data = {
            "control": 2,
            "idusu": idusuario
        }
        $.ajax({
            type: 'POST',
            url: "../controllers/control_vista_modulo3.php",
            data: data,
            beforeSend: function() {
                $("div#contenedor1M3").html("<img src='../public/assets/cargando.gif'>");

            },
            success: function(response) {

                var html = "<table>";
                html += "<tr>";
                html += "<th>Edificio</th>";
                html += "<th>Nivel</th>";
                html += "<th>Áreas Principales</th>";
                html += "<th>Áreas Adicionales</th>";
                html += "<th>Mobiliario</th>";
                html += "<th>Equipo</th>";
                html += "<th> </th>";
                html += "</tr>";

                var res = JSON.parse(response);
                for (i = 0; i < res.length; i++) {
                    html += "<tr>";
                    html += "<td style=\"text-align: center;\">Edificio " + res[i].ne + "</td>";
                    html += "<td>Nivel " + res[i].nn + "</td>";
                    html += "<td style=\"text-align: center;\">";
                    html += "<button onclick=\"muestra_nodal1('" + res[i].id + "')\" class=\"btn btn-danger btn-sm m-1\" data-form=\"areas_principales\"";
                    html += "data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"Áreas principales\">";
                    html += "<i class=\"bi bi-building\"></i>";
                    html += "</button>";
                    html += "</td>";
                    html += "<td  style=\"text-align: center;\">";
                    html += "<button onclick=\"muestra_nodal2('" + res[i].id + "')\" class=\"btn btn-danger btn-sm m-1\" data-form=\"areas_adicionales\" ";
                    html += "data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"Áreas adicionales\">";
                    html += "<i class=\"bi bi-plus-circle\"></i>";
                    html += "</button>";
                    html += "</td>";
                    html += "<td  style=\"text-align: center;\">";
                    html += "<button onclick=\"muestra_nodal3('" + res[i].id + "')\" class=\"btn btn-danger btn-sm m-1\" data-form=\"mobiliario\" ";
                    html += "data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"Mobiliario\">";
                    html += "<i class=\"bi bi-easel2\"></i>";
                    html += "</button>";
                    html += "</td>";
                    html += "<td  style=\"text-align: center;\">";
                    html += "<button onclick=\"muestra_nodal4('" + res[i].id + "')\" class=\"btn btn-danger btn-sm m-1\" data-form=\"equipo\" ";
                    html += "data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"Equipo\">";
                    html += "<i class=\"bi bi-laptop\"></i>";
                    html += "</button>";
                    html += "</td>";
                    html += "<td  style=\"text-align: center;\"><button onclick=\"eliminaTM3(\'" + res[i].idusu + "\',\'" + res[i].id + "\')\">-</button></td>";
                    html += "</tr>";

                }
                html += " </table>";
                $("div#contenedor1M3").html(html);
            },
        });
    }

    function eliminaTM3(idusuario, id) {
        var data = {
            "control": 3,
            "id": id
        }
        $.ajax({
            type: 'POST',
            url: "../controllers/control_vista_modulo3.php",
            data: data,
            beforeSend: function() {


            },
            success: function(response) {


                muestraTM3(idusuario);

            },
        });
    }
    muestraEdificio('<?php echo $_SESSION['usuario_id'] ?? 0; ?>');
</script>
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
    <div id="principalm3">
        <div>
            <table style="width:100%">
                <tr>
                    <td style="width:20%">Numero de Edificio:</td>

                    <div class="bd-callout bd-callout-primary" style="border-left: 4px solid #691c32; background-color: #f0f7ff; padding: 1rem; border-radius: 0.25rem; margin-bottom: 1rem;">
                        <p class="mb-0" style="color: #691c32;">

                            <i class="bi bi-info-circle-fill"></i>
                            Asigna un <strong>número a cada edificio</strong>, comenzando por la de mayor tamaño o uso -e importancia-, y concluyendo con la de menor.
                        </p>
                    </div>

                    <td style="width:20%">
                        <select id="nem3" name="nem3" class="form-select form-select-sm mt-1">
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
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>

                        </select>
                    </td>

                    <td style="width:10%">Nivel:</td>
                    <td style="width:20%">
                        <select id="nnm3" name="nnm3" class="form-select form-select-sm mt-1">
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
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>

                        </select>
                    </td>
                    <td>
                        <button onclick="agregaEdificio('1','cct')" class="btn text-white" style="background-color:#691c32;">
                            <i class="bi bi-save"></i> Agregar
                        </button>

                    </td>
                </tr>
            </table>
        </div>
        <div id="contenedor1M3">
            <table>
                <tr>
                    <th>Edificio</th>
                    <th>Nivel</th>
                    <th>Detalles</th>
                </tr>

            </table>
        </div>
    </div>
    <div id="secundariom3">

    </div>
    <div class="tab-pane fade" id="panel-externa" role="tabpanel" aria-labelledby="tab-externa">
        <!--  Infraestructura Externa -->
        <div class="mt-3"> 
            <h4>Infraestructura externa </h4>
            <!-- <span class="fw-bold">3.2.1 ¿Cuántas áreas comunes tiene el inmueble?</span>
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
            </select> -->

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
                    <input type="text" name="idEdificio1" id="idEdificio1" disabled style="display: none;">
                    <input type="text" name="idEdificio2" id="idEdificio2" disabled style="display: none;">
                    <input type="text" name="idEdificio3" id="idEdificio3" disabled style="display: none;">
                    <input type="text" name="idEdificio4" id="idEdificio4" disabled style="display: none;">


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
    function muestra_nodal1(idedi) {
        const modal = new bootstrap.Modal(document.getElementById('modal_areas_principales'));
        $("input#idEdificio1").val(idedi);
        modal.show();
        muestraArea1();

    }

    function muestra_nodal2(idedi) {
        const modal = new bootstrap.Modal(document.getElementById('modal_areas_adicionales'));
        $("input#idEdificio2").val(idedi);
        modal.show();
        muestraArea2();

    }

    function muestra_nodal3(idedi) {
        const modal = new bootstrap.Modal(document.getElementById('modal_mobiliario'));
        $("input#idEdificio3").val(idedi);
        modal.show();
        muestraArea3();

    }

    function muestra_nodal4(idedi) {
        const modal = new bootstrap.Modal(document.getElementById('modal_equipo'));
        $("input#idEdificio4").val(idedi);
        modal.show();
        muestraArea4();

    }
</script>