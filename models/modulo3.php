<?php
require "../entidades/EntEdificio.php";
require "../entidades/EntDatosEdificio.php";
require "conexionmysql.php";


class modulo3
{

	private EntTablaM3 $entg;
	public function __construct() {}
	function muestraDetalleAreaDatos()
	{
		$con = new conexion();
	}
	function insertaEdificio(EntEdificio $ent)
	{
		$con = new conexion();
		$rows = $con->consulta("call altaEdificio('" . $ent->getNumeroEdificio() . "','" . $ent->getNumeroNivel() . "','" . $ent->getIdUsuario() . "','" . $ent->getCct() . "','0')");
		$retorno = 0;
		while ($r = mysqli_fetch_array($rows)) {
			$retorno = $r['retorno'];
		}
		return $retorno;
	}
	function eliminaEdificio($id, $estatus)
	{
		$con = new conexion();
		$rows = $con->consulta("call eliminaEdificio('" . $id . "','" . $estatus . "')");
		if ($rows == 1) {
			return 0;
		} else {
			return -1;
		}
	}

	function consultaEdificio($idusuario)
	{

		$con = new conexion();
		$consulta = "call consultaEdificio('" . $idusuario . "')";
		$rows = $con->consulta($consulta);
		$tabla = [];
		if ($rows == 0) {
			return -1;
		} else {
			while ($r = mysqli_fetch_array($rows)) {
				$tabla[] = new EntEdificio(
					$r['id'],
					$r['numero_edificio'],
					$r['numero_nivel'],
					$r['idusuario'],
					$r['cct'],
					$r['estatus']

				);
			}

			$con->desconectar();

			return $tabla;
		}
	}

	function consultaDatosEdificio($idusuario, $idarea)
	{


		$con = new conexion();
		$consulta = "call consultaDatosEdificio('" . $idusuario . "','" . $idarea . "')";
		$rows = $con->consulta($consulta);


		$tabla = [];

		if ($rows == 0) {

			return -1;
		} else {

			while ($r = mysqli_fetch_array($rows)) {

				$tabla[] = new EntDatosEdificio(
					$r['id'],
					$r['articulo'],
					$r['existencia'],
					$r['tipo_construccion'],
					$r['cantidad'],
					$r['en_usu'],
					$r['condicion'],
					$r['con_dano_estructural'],
					$r['con_dano_instalacion'],
					$r['obra_en_proceso'],
					$r['tipo_obra'],
					$r['recursos'],
					$r['requiere_ca'],
					$r['liga'],
					$r['id_articulo'],
					$r['id_edificio']
				);
			}

			$con->desconectar();

			return $tabla;
		}
	}
	function updateDatosEdificio(EntDatosEdificio $ent)
	{
		$con = new conexion();
		$consulta = "call updateDatosEdificio(";
		$consulta .= "" . $ent->getId() . ",";
		$consulta .= "" . $ent->getExistencia() . ",";
		$consulta .= "'" . $ent->getTipoC() . "',";
		$consulta .= "" . $ent->getCantidad() . ",";
		$consulta .= "" . $ent->getEU() . ",";
		$consulta .= "'" . $ent->getCondicion() . "',";
		$consulta .= "" . $ent->getCDE() . ",";
		$consulta .= "" . $ent->getCDI() . ",";
		$consulta .= "" . $ent->getOp() . ",";
		$consulta .= "'" . $ent->getTipoObra() . "',";
		$consulta .= "'" . $ent->getRecursos() . "',";
		$consulta .= "" . $ent->getRCA() . ",";
		$consulta .= "'" . $ent->getLiga() . "',";
		$consulta .= "" . $ent->getIdDetalleArea() . ",";
		$consulta .= "" . $ent->getidUsuario() . ")";

		$rows = $con->consulta($consulta);
	}
}
