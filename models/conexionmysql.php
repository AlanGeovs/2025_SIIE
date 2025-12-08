<?php
require "confmysql.php";

class conexion
{
	public $conexion;
	public $db;
	function conectar()
	{
		$this->conexion = mysqli_connect(servername, username, password) or die("No se ha podido conectar al servidor de Base de datos");
		//echo 'Connected successfully';
		//echo "la base de datos esta conectada";
		$this->db = mysqli_select_db($this->conexion, database) or die('No se pudo seleccionar la base de datos');

		return $this->conexion;
	}
	function consulta($sql)
	{
		$this->conexion = mysqli_connect(servername, username, password) or die("No se ha podido conectar al servidor de Base de datos");
		//echo 'Connected successfully';
		//echo "la base de datos esta conectada";
		$this->db = mysqli_select_db($this->conexion, database) or die('No se pudo seleccionar la base de datos');
		$resultado = mysqli_query($this->conexion, $sql) or die("Algo ha ido mal en la consulta a la base de datos");

		return $resultado;
		//mysql_close($this->$conexion);
	}


	function desconectar()
	{
		// if ($this->conectar->conexion) { 
		// 	mysql_close($this->$conexion);
		// }
		if ($this->conexion) {
			$this->conexion->close();
		}
	}
}
