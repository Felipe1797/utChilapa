<?php
	session_start();
	include("../conexion/conexion.php");
	class modelLogin {
		var $IdUsuario;
		var $Nombres;
		var $Apellidos;
		var $NombreUsuario;
		var $EMail;
		var $Contrasena;
		var $Activo;
		var $Creado;
		var $contador;

		function modelLogin() {
			$this->conexion=new Conexion();
		}

		function iniciarSesion($NombreUsuario, $Contrasena) {
			$sql = "SELECT * FROM USUARIOS WHERE (EMail='".$NombreUsuario."' OR NombreUsuario='".$NombreUsuario."') AND Contrasena='".sha1($Contrasena)."' AND Activo=true";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			while($row = $this->resultados->fetch_array()) {
				$_SESSION['usuario_id'] = $row['Id'];
				$_SESSION['usuario_nombres'] = $row['Nombres'];
				$_SESSION['usuario_apellidos'] = $row['Apellidos'];
				$_SESSION['usuario_activo'] = $row['Activo'];
				$_SESSION['usuario_cargo'] = $row['Cargo'];
				$salida ="Si";
			}
			
			if ($salida=="Si") {
				$sql = "SELECT * FROM ACCESOS WHERE Id='".$_SESSION['usuario_id']."'";
				$this->conexion->conexion->set_charset('utf8');
				$this->resultados = $this->conexion->getConexion()->query($sql);
				$row = $this->resultados->fetch_array();

				$_SESSION['usuario_accesos'] = array($row['Avisos'], $row['Notas'], $row['Calendarios'], $row['Becas'], $row['Requisitos'], $row['Documentos'], $row['Visitas'], $row['Seguimientos'], $row['Movilidades'], $row['Directorios'], $row['Titulos'], $row['Banner']);
			}

			echo "$salida";
		}
	}
?>