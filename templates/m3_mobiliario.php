
<script>
    function areas_principales_area(idarticulo,idedificio){
    var formData = new FormData(document.getElementById("archivoa12"+idarticulo));

    const inputArchivo = document.getElementById('a12'+idarticulo);
   /* if (inputArchivo.files.length === 0) {
    alert("archivo vacio");
    return false;
    }    */


    formData.append("dato", "valor");
    formData.append("idedi",idedificio);
    
    var ck;
    ck=document.getElementsByName('a1'+idarticulo)[0].checked;
    var exi;
    if(ck){
     exi="1";
    }else{
     exi="0";
    }
    formData.append("a1",exi);
    var tc=document.getElementsByName('a2'+idarticulo)[0].value;
    formData.append("a2",tc);
    var canti=document.getElementsByName('a3'+idarticulo)[0].value;
    formData.append("a3",canti);
    ck=document.getElementsByName('a4'+idarticulo)[0].checked;
    var euso;
    if(ck){
     euso="1";
    }else{
     euso="0";
    }
    formData.append("a4",euso);
    var condi=document.getElementsByName('a5'+idarticulo)[0].value;
    formData.append("a5",condi);
    ck=document.getElementsByName('a6'+idarticulo)[0].checked;
    var danoe;
    if(ck){
     danoe="1";
    }else{
     danoe="0";
    }
    formData.append("a6",danoe);
   
    ck=document.getElementsByName('a7'+idarticulo)[0].checked;
    var danoi;
    if(ck){
     danoi="1";
    }else{
     danoi="0";
    }
    formData.append("a7",danoi);
    
    ck=document.getElementsByName('a8'+idarticulo)[0].checked;
    var obrap;
    if(ck){
     obrap="1";
    }else{
     obrap="0";
    }
    formData.append("a8",obrap);


    if(obrap==1){
    var tipoo=document.getElementsByName('a9'+idarticulo)[0].value;
    var recu=document.getElementsByName('a10'+idarticulo)[0].value;
    formData.append("a9",tipoo);
    formData.append("a10",recu);
    }else{
    formData.append("a9","0");
    formData.append("a10","0");
    }

    
    ck=document.getElementsByName('a11'+idarticulo)[0].checked;
    var rca;
    if(ck){
     rca="1";
    }else{
     rca="0";
    }
    formData.append("a11",rca);
    formData.append("control",5);
    formData.append("archivo",'a12'+idarticulo);
   // formData.append("area",idarea);
                $.ajax({
                url: "../controllers/control_vista_modulo3.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
          
                },
                success: function(response) {
             
                 
                },
      
      
    });





    }







function muestra(id){
var ck1=document.getElementsByName(id+"8")[0].checked;
if(ck1){
  var val="1";
}else{
   var val="0";
}

if(val==1){
$("select#"+id+"9").attr('disabled',false);
$("select#"+id+"10").attr('disabled',false);
}else{
$("select#"+id+"9").attr('disabled', true);
$("select#"+id+"10").attr('disabled', true);
}

}




function muestraArea3(){  
    var idEdificio=document.getElementsByName("idEdificio3")[0].value;
  
var data={
    "control":4,
    "idusuario":idEdificio,
    "idarea":3
   
    }
  $.ajax({
            type: 'POST',
            url: "../controllers/control_vista_modulo3.php",
            data: data,
            beforeSend: function() {
            

            },
             success: function(response) {  
            var res = JSON.parse(response); 


              
              var html="<table class=\"table table-bordered table-sm align-middle text-center\">"; 
                  html+="<thead class=\"table-light\"><tr>";
                  html+="<th>Areas Principales</th>";
                  html+="<th>Existencia</th>";
                  html+="<th>Tipo de construcción</th>";
                  html+="<th>Cantidad</th>";
                  html+="<th>En uso</th>";
                  html+="<th>Condición</th>";
                  html+="<th>Con daño estructural</th>";
                  html+="<th>Con daño de instalación</th>";
                  html+="<th>Obra en proceso</th>";
                  html+="<th>Requiere construcción adicional</th>";
                  html+="<th>Evidencia</th>";
                  html+="</tr></thead>";
              var  script="<script>function guardar(){";
              
               for (i = 0; i < res.length; i++) {
               script+="areas_principales_area(\""+res[i].idarticulo+"\",\""+res[i].id+"\");";

               html+="<tr>";
               html+="<td>"+res[i].articulo+"</td>";


               if(res[i].exi==0){
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a1"+res[i].idarticulo+"\" name=\"a1"+res[i].idarticulo+"\"  value=\"1\"  >";
                html+="No<input type=\"radio\" id=\"a1"+res[i].idarticulo+"\" name=\"a1"+res[i].idarticulo+"\" value=\"0\" checked>";
                html+="</td>";
               }else{
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a1"+res[i].idarticulo+"\" name=\"a1"+res[i].idarticulo+"\"  value=\"1\" checked>";
                html+="No<input type=\"radio\" id=\"a1"+res[i].idarticulo+"\" name=\"a1"+res[i].idarticulo+"\"  value=\"0\"  >";
                html+="</td>";
               }
               
               html+="<td><select class=\"form-select form-select-sm\" id=\"a2"+res[i].idarticulo+"\" name=\"a2"+res[i].idarticulo+"\">";
               if(res[i].tc==0){
               html+="<option  value=\""+res[i].tc+"\" selected='true'>Selecciona tipo</option>"; 
               }else{
               html+="<option value=\""+res[i].tc+"\">\""+res[i].tc+"\"</option>";
               }
               
               html+="<option value=\"LIGERA\">Ligera</option>";
               html+="<option value=\"TRADICIONAL\">Tradicional</option>";
               html+="<option value=\"MIXTA\">Mixta</option>";
               html+="</select>";
               html+="</td>";


               html+="<td><select class=\"form-select form-select-sm\" id=\"a3"+res[i].idarticulo+"\" name=\"a3"+res[i].idarticulo+"\">";
               if(res[i].canti==0){
               html+="<option  value=\""+res[i].canti+"\" selected='true'>Selecciona cantidad</option>"; 
               }else{
               html+="<option value=\""+res[i].canti+"\">\""+res[i].canti+"\"</option>";
               }
               html+="<option value=\"1\">1</option>";
               html+="<option value=\"2\">2</option>";
               html+="<option value=\"3\">3</option>";
               html+="<option value=\"4\">4</option>";
               html+="<option value=\"5\">5</option>";
               html+="<option value=\"6\">6</option>";
               html+="<option value=\"7\">7</option>";
               html+="<option value=\"8\">8</option>";
               html+="<option value=\"9\">9</option>";
               html+="<option value=\"10\">10</option> </select>";
               html+="</td> ";

               if(res[i].eusu.localeCompare('1')){
                 html+="<td>";
                html+="Si<input type=\"radio\" id=\"a4"+res[i].idarticulo+"\" name=\"a4"+res[i].idarticulo+"\"  value=\"1\"  >";
                html+="No<input type=\"radio\" id=\"a4"+res[i].idarticulo+"\" name=\"a4"+res[i].idarticulo+"\" value=\"0\" checked>";
                html+="</td>";
               }else{
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a4"+res[i].idarticulo+"\" name=\"a4"+res[i].idarticulo+"\"  value=\"1\" checked>";
                html+="No<input type=\"radio\" id=\"a4"+res[i].idarticulo+"\" name=\"a4"+res[i].idarticulo+"\"  value=\"0\"  >";
                html+="</td>";
               }

               


               html+="<td><select class=\"form-select form-select-sm\" id=\"a5"+res[i].idarticulo+"\" name=\"a5"+res[i].idarticulo+"\">";
               if(res[i].condi==0){
               html+="<option  value=\""+res[i].condi+"\" selected='true'>Selecciona condición</option>"; 
               }else{
               html+="<option value=\""+res[i].condi+"\">\""+res[i].condi+"\"</option>";
               }
         

               html+="<option value=\"BUENA\">Buena</option>";
               html+="<option value=\"REGULAR\">Regular</option>";
               html+="<option value=\"MALA\">Mala</option>";
               html+="</select></td>";

                if(res[i].cde.localeCompare('1')){
                 html+="<td>";
                html+="Si<input type=\"radio\" id=\"a6"+res[i].idarticulo+"\" name=\"a6"+res[i].idarticulo+"\"  value=\"1\"  >";
                html+="No<input type=\"radio\" id=\"a6"+res[i].idarticulo+"\" name=\"a6"+res[i].idarticulo+"\"  value=\"0\" checked>";
                html+="</td>";
               }else{
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a6"+res[i].idarticulo+"\" name=\"a6"+res[i].idarticulo+"\"  value=\"1\" checked>";
                html+="No<input type=\"radio\" id=\"a6"+res[i].idarticulo+"\" name=\"a6"+res[i].idarticulo+"\"  value=\"0\"  >";
                html+="</td>";
               }


                if(res[i].cdi.localeCompare('1')){
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a7"+res[i].idarticulo+"\" name=\"a7"+res[i].idarticulo+"\"  value=\"1\"  >";
                html+="No<input type=\"radio\" id=\"a7"+res[i].idarticulo+"\" name=\"a7"+res[i].idarticulo+"\" value=\"0\" checked>";
                html+="</td>";
                }else{
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a7"+res[i].idarticulo+"\" name=\"a7"+res[i].idarticulo+"\"  value=\"1\" checked>";
                html+="No<input type=\"radio\" id=\"a7"+res[i].idarticulo+"\" name=\"a7"+res[i].idarticulo+"\"  value=\"0\"  >";
                html+="</td>";
                }
               





               

                if(res[i].oep.localeCompare('1')){
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a8"+res[i].idarticulo+"\" name=\"a8"+res[i].idarticulo+"\"  value=\"1\"  >";
                html+="No<input type=\"radio\" id=\"a8"+res[i].idarticulo+"\" name=\"a8"+res[i].idarticulo+"\" value=\"0\" checked>";
                
                }else{
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a8"+res[i].idarticulo+"\" name=\"a8"+res[i].idarticulo+"\"  value=\"1\" checked>";
                html+="No<input type=\"radio\" id=\"a8"+res[i].idarticulo+"\" name=\"a8"+res[i].idarticulo+"\"  value=\"0\"  >";
               
                }
               
               html+=" <div class=\"mt-1\">";
               html+=" <select id=\"a9"+res[i].idarticulo+"\" name=\"a9"+res[i].idarticulo+"\" class=\"form-select form-select-sm mt-1\" disabled>";
               if(res[i].to==0){
               html+="<option  value=\"0\" selected='true'>Tipo de obra</option>"; 
               }else{
               html+="<option value=\""+res[i].to+"\">\""+res[i].to+"\"</option>";
               }
               
               html+="<option value=\"Albañileria\">Albañilería</option>";
               html+="<option value=\"Pintura y acabados\">Pintura y acabados</option>";
               html+="<option value=\"Reforzamiento de estructuras\">Reforzamiento de estructuras</option>";
               html+=" <option value=\"Herreria\">Herrería</option>";
               html+="<option value=\"Plomeria\">Plomería</option>";
               html+="<option value=\"Impermeabilizacion\">Impermeabilización</option>";
               html+=" <option value=\"Red electrica\">Red eléctrica</option>";
               html+="<option value=\"Red hidraulica\">Red hidráulica</option>";
               html+="<option value=\"Carpinteria\">Carpintería</option>";
               html+="<option value=\"Urbanismo\">Urbanismo</option>";
               html+="</select>";
               html+="<select id=\"a10"+res[i].idarticulo+"\" name=\"a10"+res[i].idarticulo+"\" class=\"form-select form-select-sm mt-1\" disabled>";
               if(res[i].recu==0){
               html+="<option  value=\"0\" selected='true'>Recurso</option>"; 
               }else{
               html+="<option value=\""+res[i].recu+"\">\""+res[i].recu+"\"</option>";
               }
              
               html+="<option value=\"Federal\">Federal</option>";
               html+="<option value=\"Estatal\">Estatal</option>";
               html+="<option value=\"Municipal\">Municipal</option>";
               html+="</select>";
               html+="</div></td>";

                if(res[i].rca.localeCompare('1')){
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a11"+res[i].idarticulo+"\" name=\"a11"+res[i].idarticulo+"\"  value=\"1\"  >";
                html+="No<input type=\"radio\" id=\"a11"+res[i].idarticulo+"\" name=\"a11"+res[i].idarticulo+"\" value=\"0\"checked>";
                html+="</td>";
               }else{
                html+="<td>";
                html+="Si<input type=\"radio\" id=\"a11"+res[i].idarticulo+"\" name=\"a11"+res[i].idarticulo+"\"  value=\"1\" checked>";
                html+="No<input type=\"radio\" id=\"a11"+res[i].idarticulo+"\" name=\"a11"+res[i].idarticulo+"\"  value=\"0\"  >";
                html+="</td>";
                }
               
               html+="<td>";
               html+="<form enctype=\"multipart/form-data\" id=\"archivoa12"+res[i].idarticulo+"\" method=\"post\"> ";
               html+="<input type=\"file\" id=\"a12"+res[i].idarticulo+"\" name=\"a12"+res[i].idarticulo+"\" />";
               html+="</form>";
               html+=" </td>";

               html+="</tr>";
            
            
              }   
              script+="}";
              html+=" </table>";
              $("div#mobi").html(html+script);
            },
      });
}











</script>

    <!-- Áreas principales -->
    <div class="table-responsive mb-4" id="mobi">
     
    </div>
<!-------------------------------------------------------------------------------------->
    <div class="text-end">
        <button onclick="guardar()" class="btn text-white" style="background-color:#691c32;">
            <i class="bi bi-save"></i> Guardar información
        </button>
    </div>



