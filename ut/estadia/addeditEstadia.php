<?php
	include('modelEstadia.php');
  	$estadia = new modelEstadia;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["DocEdit"]["type"])) {
		$IdEstadia = $_POST['IdEdit'];
		$Nivel = $_POST['NivelEdit'];
		$TipoFormato = $_POST['TipoFormatoEdit'];
		$Nombre = $_POST['NombreEdit'];
		$RutaDocName = $_POST['DocEditName'];
		$RutaDocName = explode("?", $RutaDocName);
		$RutaDocName = $RutaDocName[0];
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["DocEdit"]["type"]==null) {
			$tempRutaDocName = explode("/", $RutaDocName);
			if ($Nivel == "TSU") {
				rename($RutaDocName, "../../doc/estadia/tsu/".end($tempRutaDocName));
				$rutanew = "../../doc/estadia/tsu/".end($tempRutaDocName);
			} else if ($Nivel == "ING") {
				rename($RutaDocName, "../../doc/estadia/ing/".end($tempRutaDocName));
				$rutanew = "../../doc/estadia/ing/".end($tempRutaDocName);
			}

			$act = "UPDATE FORMATOSESTADIAS SET Nivel='".$Nivel."', TipoFormato='".$TipoFormato."', Nombre='".$Nombre."', RutaDoc='".$rutanew."', Activo=".$Activo." WHERE Id='".$IdEstadia."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act)) {
				$estadia->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Requisitos para estadia');
				echo "Bien";
			}
		} else if($_FILES["DocEdit"]["type"]!=null) {
			$sourcePath = $_FILES['DocEdit']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['DocEdit']['name']);
			$texto_cambiado = $IdEstadia."_".$texto_cambiado;
			if ($Nivel == "TSU") {
				$ruta = $targetPath = "../../doc/estadia/tsu/".$texto_cambiado;
			} else if ($Nivel == "ING") {
				$ruta = $targetPath = "../../doc/estadia/ing/".$texto_cambiado;
			}
			
			$act = "UPDATE FORMATOSESTADIAS SET Nivel='".$Nivel."', TipoFormato='".$TipoFormato."', Nombre='".$Nombre."', RutaDoc='".$ruta."', Activo=".$Activo." WHERE Id='".$IdEstadia."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaDocName)){}
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$estadia->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Requisitos para estadia');
					echo "Bien";
				}
			}
		}
	}

	if(isset($_FILES["DocAdd"]["type"])) {
		$consulta="SELECT * FROM FORMATOSESTADIAS ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdEstadia = 0;
		if ($reg['Id']=="") { $IdEstadia = '1'; } else if ($reg['Id']!="") { $IdEstadia = (Float)$reg['Id'] + 1; }

		$IdUsuario = $_SESSION['usuario_id'];
		$Nombre = $_POST['NombreAdd'];
		$Nivel = $_POST['NivelAdd'];
		$TipoFormato = $_POST['TipoFormatoAdd'];
		
		if ($_FILES["DocAdd"]["type"]!=null) {
			$sourcePath = $_FILES['DocAdd']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['DocAdd']['name']);
			$texto_cambiado = $IdEstadia."_".$texto_cambiado;
			if ($Nivel == "TSU") {
				$ruta = $targetPath = "../../doc/estadia/tsu/".$texto_cambiado;
			} else if ($Nivel == "ING") {
				$ruta = $targetPath = "../../doc/estadia/ing/".$texto_cambiado;
			}
		
			$act = "INSERT INTO FORMATOSESTADIAS(Id, Nivel, TipoFormato, Nombre, RutaDoc, Activo, Creado, IdUsuario) VALUES (0,'".$Nivel."','".$TipoFormato."','".$Nombre."','".$ruta."', true, NOW(),'".$IdUsuario."')";

			$tildes = $conexion->query("SET NAMES 'utf8'");
		
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$estadia->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Requisitos para estadia');
					echo "Bien";
				}
			}
		}
	}	
?>