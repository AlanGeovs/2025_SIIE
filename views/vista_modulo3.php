
 <script type="text/javascript" src="../js/jquery.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<script>
function agregaTM3(idusuario,cct){
var ne=document.getElementsByName("nem3")[0].value;
var nn=document.getElementsByName("nnm3")[0].value;    
var data={
    "control":1,
    "idusu":idusuario,  
    "cct":cct,
    "ne":ne,
    "nn":nn
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
function muestraTM3(idusuario){  
var data={
    "control":2,
    "idusu":idusuario
    }
  $.ajax({
            type: 'POST',
            url: "../controllers/control_vista_modulo3.php",
            data: data,
            beforeSend: function() {
            $("div#contenedor1M3").html("<img src='../public/assets/cargando.gif'>");

            },
             success: function(response) {   
              var html="<table>"; 
                  html+="<tr>";
                  html+="<th>Edificio</th>";
                  html+="<th>Nivel</th>";
                  html+="<th>Areas Principales</th>";
                  html+="<th>Areas Adicionales</th>";
                  html+="<th>Mobiliario</th>";
                  html+="<th>Equipo</th>";
                  html+="<th>Acciones</th>";
                  html+="</tr>";
                
              var res = JSON.parse(response); 
              for (i = 0; i < res.length; i++) {
              html+="<tr>";  
              html+="<td style=\"text-align: center;\">Edificio "+res[i].ne+"</td>";
              html+="<td>Nivel "+res[i].nn+"</td>";              
              html+="<td style=\"text-align: center;\">"; 
              html+="<button class=\"btn btn-sm m-1\">";
              html+="<i class=\"bi bi-building\"></i>";
              html+="</button>"; 
              html+="</td>";
              html+="<td  style=\"text-align: center;\">";
              html+="<button class=\"btn btn-sm m-1\">";
              html+="<i class=\"bi bi-plus-circle\"></i>";
              html+="</button>"; 
              html+="</td>";
              html+="<td  style=\"text-align: center;\">"; 
              html+="<button class=\"btn btn-sm m-1\">";
              html+="<i class=\"bi bi-easel2\"></i>";
              html+="</button>"; 
              html+="</td>";
              html+="<td  style=\"text-align: center;\">"; 
              html+="<button class=\"btn btn-sm m-1\">";
              html+="<i class=\"bi bi-laptop\"></i>";
              html+="</button>"; 
              html+="</td>"; 
              html+="<td  style=\"text-align: center;\"><button onclick=\"eliminaTM3(\'"+res[i].idusu+"\',\'"+res[i].id+"\')\">-</button></td>"; 
              html+="</tr>";  
            
              }   
              html+=" </table>";
              $("div#contenedor1M3").html(html);
            },
      });
}
function eliminaTM3(idusuario,id){  
var data={
    "control":3,
    "id":id
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
muestraTM3('1');
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
            <table>
                <tr>
                    <td>Numero de Edificio:</td>
                    <td>
                        <select id="nem3" name="nem3">
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
                
                    <td>Nivel:</td>
                    <td>
                        <select id="nnm3" name="nnm3">
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
                        <button onclick="agregaTM3('1','cct')">Agregar</button>
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
    
</div>
