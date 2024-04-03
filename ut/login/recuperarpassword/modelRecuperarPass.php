<?php
	session_start();
	include("../../conexion/conexion.php");
	class modelRecuperarPass {
		var $EMail;
		var $Contrasena;
		var $Cadena;
		var $Logintud;

		function modelRecuperarPass() {
			$this->conexion=new Conexion();
			$this->Cadena='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$Contrasena="";
		}

		function getContrasena(){return $this->Contrasena;}

		function setContrasena($Contrasena){$this->Contrasena=$Contrasena;}

		function recuperarPass($EMail) {
			$log = 40;
			$sql = "SELECT * FROM USUARIOS WHERE EMail='".strtolower($EMail)."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";

			if(mysqli_num_rows($this->resultados) > 0) {
				$lng_cadena = strlen($this->Cadena);
				$this->Logintud = $log;

				for ($i=1; $i <= $this->Logintud ; $i++) { 
					$aleatorio = mt_rand(0,$lng_cadena-1);
					$this->Contrasena .= substr($this->Cadena, $aleatorio,1);
				}

				$mensaje="Estimado usuario hemos realizado el cambio de tu contraseña.\r\n\r\n"
					."Tu nueva contraseña es: ".$this->Contrasena."\r\n\r\n"
					."Ingesa tu Nombre de usuario o EMail junto a tu nueva contraseña al momento de inicar sesión.\r\n\r\n"
					."Un consejo cambia tu contraseña por una nueva.";

				if (mail(strtolower($EMail), utf8_decode('Cambio de contraseña'), $mensaje)) {
					$salida = "Bien";

					$this->Contrasena = sha1($this->Contrasena);

					$sqlModificar = "UPDATE USUARIOS SET Contrasena='".$this->Contrasena."' WHERE EMail='".strtolower($EMail)."'";
					$this->conexion->conexion->set_charset('utf8');
					$this->conexion->getConexion()->query($sqlModificar);

				} else {
					$salida = "ErrorEMail";
				}
			} else {
				$salida = "NoExiste";
			}

			echo "$salida";
		}
	}
?>