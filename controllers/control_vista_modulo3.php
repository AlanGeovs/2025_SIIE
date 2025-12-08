<?php
error_reporting(E_ERROR );

$control=$_POST['control'];

//echo$control;

switch ($control) {
	case '1':
		// code...
	require "../models/modulo3.php";
	$idusu=$_POST['idusu'];
	$ne=$_POST['ne'];
	$nn=$_POST['nn'];
	$cct=$_POST['cct'];
	$ent=new EntEdificio(
	'',
	$ne,
	$nn,
	$idusu,
	$cct,
	'');
	$obj_m3 = new modulo3();
	
	echo $obj_m3->insertaEdificio($ent);
		break;
	case '2':
		// code...
	require "../models/modulo3.php";
	$idusu=$_POST['idusu'];
	$obj_m3 = new modulo3();
	$tabla=[];
	$tabla=$obj_m3->consultaEdificio($idusu);
	$datos=[];
	foreach ($tabla as $val) {
    $datos []=array('id'=>$val->getId(),'ne'=>$val->getNumeroEdificio(),'nn'=>$val->getNumeroNivel(),'idusu'=>$val->getIdUsuario());
    }
	echo json_encode($datos);
		break;

	case '3':
		// code...
	require "../models/modulo3.php";
	$id=$_POST['id'];
	$obj_m3 = new modulo3();
	echo$obj_m3->eliminaEdificio($id,1);
		break;

    case '4':
    	// code...consulta datos por edifico
    require "../models/modulo3.php";
    $idusuario=$_POST['idusuario'];
    $idarea=$_POST['idarea'];
    $obj_m3 = new modulo3();
    $tabla=[];
    $tabla= $obj_m3->consultaDatosEdificio($idusuario,$idarea);
  
    foreach ($tabla as $val) {
    
    $datos []=array(
    'id'=>$val->getId(),
    'articulo'=>$val->getNombreArticulo(),
    'exi'=>$val->getExistencia(),
    'tc'=>$val->getTipoC(),
    'canti'=>$val->getCantidad(),
    'eusu'=>$val->getEU(),
    'condi'=>$val->getCondicion(),
    'cde'=>$val->getCDE(),
    'cdi'=>$val->getCDI(),
    'oep'=>$val->getOp(),
    'to'=>$val->getTipoObra(),
    'recu'=>$val->getRecursos(),
    'rca'=>$val->getRCA(),
    'liga'=>$val->getLiga(),
    'idarticulo'=>$val->getIdDetalleArea(),
    'idedificio'=>$val->getidUsuario()
	);
    }
    echo json_encode($datos);

	break;

	
	case '5':
		// code...
	////datos del baño
	require "../models/modulo3.php";
	$obj_m3 = new modulo3();

	//datos formulario
	$idedi=$_POST['idedi'];
    $a1=$_POST['a1'];
    $a2=$_POST['a2'];
    $a3=$_POST['a3'];
    $a4=$_POST['a4'];
    $a5=$_POST['a5'];
    $a6=$_POST['a6'];
    $a7=$_POST['a7'];
    $a8=$_POST['a8'];
    $a9=$_POST['a9'];
    $a10=$_POST['a10'];
    $a11=$_POST['a11'];

    $ent=new EntDatosEdificio(
    $idedi,
    "vacio",	
    $a1,
    $a2,
    $a3,
    $a4,
    $a5,
    $a6,
    $a7,
    $a8,
    $a9,
    $a10,
    $a11,
    "liga",
    0,
    0
    );
    $obj_m3->updateDatosEdificio($ent);


   /* $archivo=$_POST['archivo'];
    $carpeta = __DIR__ .'/archivos/';
    $ruta = $carpeta . basename($_FILES[$archivo]['name']);
    if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $ruta)) {
      echo "¡se guardo archivo!\n";
	} else {
 	   echo "¡Posible ataque de subida de ficheros!\n";
	}*/
    


		break;	
	
	default:
		// code...
		break;
}





?>