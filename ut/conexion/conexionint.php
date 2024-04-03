<?php
	class conexion
	{
		var $conexion;
		function Conexion()
		{
			$conection['server']="localhost";
			$conection['user']="utchilap_becaint";
			$conection['pass']="B.ecaint18%";
			$conection['bd']="utchilap_becaint";
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