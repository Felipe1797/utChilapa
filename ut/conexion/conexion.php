<?php
	class conexion
	{
		var $conexion;
		function Conexion()
		{
			$conection['server']="localhost";
			$conection['user']="root";
			$conection['pass']="";
			$conection['bd']="comparacion";
			$this->conexion = new mysqli($conection['server'],$conection['user'],$conection['pass'],$conection['bd']);
		}
		function getConexion()
		{
			return $this->conexion;
		}
		function close()
		{
			$this->conexion->close();
		}
	}
?>