<?php
	session_start();
	include("../../conexion/conexion.php");
	class modelCambiarContrasena {
		var $EMail;
		var $Contrasena;
		var $ContrasenaNueva;
		var $ConfirContrasenaNueva;
		var $Cadena;
		var $Logintud;

		function modelCambiarContrasena() {
			$this->conexion=new Conexion();
			$Contrasena = "";
			$ContrasenaNueva = "";
			$ConfirContrasenaNueva = "";
		}

		function getContrasena(){return $this->Contrasena;}
		function getContrasenaNueva(){return $this->ContrasenaNueva;}
		function getConfirContrasenaNueva(){return $this->ConfirContrasenaNueva;}

		function setContrasena($Contrasena){$this->Contrasena=$Contrasena;}
		function setContrasenaNueva($ContrasenaNueva){$this->ContrasenaNueva=$ContrasenaNueva;}
		function setConfirContrasenaNueva($ConfirContrasenaNueva){$this->ConfirContrasenaNueva=$ConfirContrasenaNueva;}

		function cambiarContrasena($Contrasena, $ContrasenaNueva, $ConfirContrasenaNueva) {
			$sql = "SELECT * FROM USUARIOS WHERE Id='".$_SESSION['usuario_id']."' AND Contrasena='".sha1($Contrasena)."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";

			if(mysqli_num_rows($this->resultados) > 0) {
				$salida = "Bien";

				$sqlModificar = "UPDATE USUARIOS SET Contrasena='".sha1($ConfirContrasenaNueva)."' WHERE Id='".$_SESSION['usuario_id']."'";
				$this->conexion->conexion->set_charset('utf8');
				$this->conexion->getConexion()->query($sqlModificar);
			} else {
				$salida = "NoExiste";
			}

			echo "$salida";
		}
	}
?>