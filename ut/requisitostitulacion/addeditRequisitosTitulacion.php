<?php
	include('modelRequisitosTitulacion.php');
  	$requisitostitulacion = new modelRequisitosTitulacion;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["DocEdit"]["type"])) {
		$IdRequisitosTitulacion = $_POST['IdEdit'];
		$Nombre = $_POST['NombreEdit'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$Nivel = $_POST['NivelEdit'];
		$RutaDocName = $_POST['DocEditName'];
		$RutaDocName = explode("?", $RutaDocName);
		$RutaDocName = $RutaDocName[0];
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["DocEdit"]["type"]==null) {
			$tempRutaDocName = explode("/", $RutaDocName);
			if ($Nivel == "General") {
				rename($RutaDocName, "../../doc/titulacion/".end($tempRutaDocName));
				$rutanew = "../../doc/titulacion/".end($tempRutaDocName);
			} else if ($Nivel == "TSU") {
				rename($RutaDocName, "../../doc/titulacion/tsu/".end($tempRutaDocName));
				$rutanew = "../../doc/titulacion/tsu/".end($tempRutaDocName);
			} else if ($Nivel == "ING") {
				rename($RutaDocName, "../../doc/titulacion/ing/".end($tempRutaDocName));
				$rutanew = "../../doc/titulacion/ing/".end($tempRutaDocName);
			}

			$act = "UPDATE REQUSITOSTITULOS SET NombreFormato='".$Nombre."', Nivel='".$Nivel."', RutaDoc='".$rutanew."', Activo=".$Activo." WHERE Id='".$IdRequisitosTitulacion."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act)) {
				$requisitostitulacion->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Requisitos para titulación');
				echo "Bien";
			}
		} else if($_FILES["DocEdit"]["type"]!=null) {
			$sourcePath = $_FILES['DocEdit']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['DocEdit']['name']);
			$texto_cambiado = $IdRequisitosTitulacion."_".$texto_cambiado;
			if ($Nivel == "General") {
				$ruta = $targetPath = "../../doc/titulacion/".$texto_cambiado;
			} else if ($Nivel == "TSU") {
				$ruta = $targetPath = "../../doc/titulacion/tsu/".$texto_cambiado;
			} else if ($Nivel == "ING") {
				$ruta = $targetPath = "../../doc/titulacion/ing/".$texto_cambiado;
			}
			
			$act = "UPDATE REQUSITOSTITULOS SET NombreFormato='".$Nombre."', Nivel='".$Nivel."', RutaDoc='".$ruta."', Activo=".$Activo." WHERE Id='".$IdRequisitosTitulacion."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaDocName)){}
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$requisitostitulacion->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Requisitos para titulación');
					echo "Bien";
				}
			}
		}
	}

	if(isset($_FILES["DocAdd"]["type"])) {
		$consulta="SELECT * FROM REQUSITOSTITULOS ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdRequisitosTitulacion = 0;
		if ($reg['Id']=="") { $IdRequisitosTitulacion = '1'; } else if ($reg['Id']!="") { $IdRequisitosTitulacion = (Float)$reg['Id'] + 1; }

		$Nombre = $_POST['NombreAdd'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$Nivel = $_POST['NivelAdd'];
		$IdUsuario = $_SESSION['usuario_id'];
		
		if ($_FILES["DocAdd"]["type"]!=null) {
			$sourcePath = $_FILES['DocAdd']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['DocAdd']['name']);
			$texto_cambiado = $IdRequisitosTitulacion."_".$texto_cambiado;
			if ($Nivel == "General") {
				$ruta = $targetPath = "../../doc/titulacion/".$texto_cambiado;
			} else if ($Nivel == "TSU") {
				$ruta = $targetPath = "../../doc/titulacion/tsu/".$texto_cambiado;
			} else if ($Nivel == "ING") {
				$ruta = $targetPath = "../../doc/titulacion/ing/".$texto_cambiado;
			}
		
			$act = "INSERT INTO REQUSITOSTITULOS(Id, NombreFormato, Nivel, RutaDoc, Activo, Creado, IdUsuario) VALUES (0,'".$Nombre."','".$Nivel."','".$ruta."', true, NOW(),'".$IdUsuario."')";

			$tildes = $conexion->query("SET NAMES 'utf8'");
		
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$requisitostitulacion->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Requisitos para titulación');
					echo "Bien";
				}
			}
		}
	}	
?>