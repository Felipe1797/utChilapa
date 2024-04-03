<?php
	include('modelAsignatura.php');
  	$asignatura = new modelAsignatura;
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
		$IdCuatrimestre = $_POST['IdCuatrimestreEdit'];
		$IdCuatrimestre = str_replace("'", "&apoxyz", $IdCuatrimestre);
		$IdCuatrimestre = str_replace('"', "&quoxyz", $IdCuatrimestre);

		$IdCarrera = $_POST['IdCarreraEdit'];
		$IdCarrera = str_replace("'", "&apoxyz", $IdCarrera);
		$IdCarrera = str_replace('"', "&quoxyz", $IdCarrera);

		if($_FILES["DocEdit"]["type"]==null) {
			$tempRutaDocName = explode("/", $RutaDocName);
			if ($Nivel == "TSU") {
				rename($RutaDocName, "../../doc/asignaturas/tsu/".end($tempRutaDocName));
				$rutanew = "../../doc/asignaturas/tsu/".end($tempRutaDocName);
			} else if ($Nivel == "ING") {
				rename($RutaDocName, "../../doc/asignaturas/ing/".end($tempRutaDocName));
				$rutanew = "../../doc/asignaturas/ing/".end($tempRutaDocName);
			}else if ($Nivel == "LIC") {
				rename($RutaDocName, "../../doc/asignaturas/lic/".end($tempRutaDocName));
				$rutanew = "../../doc/asignaturas/lic/".end($tempRutaDocName);
			}

			$act = "UPDATE ASIGNATURAS SET Nombre='".$Nombre."', RutaDoc='".$rutanew."', Tipo='".$Nivel."', IdCuatrimestre='".$IdCuatrimestre."',  IdCarrera='".$IdCarrera."' WHERE Id='".$IdRequisitosTitulacion."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act)) {
				$asignatura->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Asignaturas');
				echo "Bien";
			}
		} else if($_FILES["DocEdit"]["type"]!=null) {
			$sourcePath = $_FILES['DocEdit']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['DocEdit']['name']);
			$texto_cambiado = $IdRequisitosTitulacion."_".$texto_cambiado;
			if ($Nivel == "TSU") {
				$ruta = $targetPath = "../../doc/asignaturas/tsu/".$texto_cambiado;
			} else if ($Nivel == "ING") {
				$ruta = $targetPath = "../../doc/asignaturas/ing/".$texto_cambiado;
			}else if ($Nivel == "LIC") {
				$ruta = $targetPath = "../../doc/asignaturas/lic/".$texto_cambiado;
			}
			
			$act = "UPDATE ASIGNATURAS SET Nombre='".$Nombre."', RutaDoc='".$ruta."', Tipo='".$Nivel."', IdCuatrimestre='".$IdCuatrimestre."', IdCarrera='".$IdCarrera."' WHERE Id='".$IdRequisitosTitulacion."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaDocName)){}
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$asignatura->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Asignaturas');
					echo "Bien";
				}
			}
		}
	}

	if(isset($_FILES["DocAdd"]["type"])) {
		$consulta="SELECT * FROM ASIGNATURAS ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdRequisitosTitulacion = 0;
		if ($reg['Id']=="") { $IdRequisitosTitulacion = '1'; } else if ($reg['Id']!="") { $IdRequisitosTitulacion = (Float)$reg['Id'] + 1; }

		$Nombre = $_POST['NombreAdd'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$Nivel = $_POST['NivelAdd'];
		$IdCuatrimestre = $_POST['IdCuatrimestreAdd'];
		$IdCuatrimestre = str_replace("'", "&apoxyz", $IdCuatrimestre);
		$IdCuatrimestre = str_replace('"', "&quoxyz", $IdCuatrimestre);
		$IdCarrera = $_POST['IdCarreraAdd'];
		$IdCarrera = str_replace("'", "&apoxyz", $IdCarrera);
		$IdCarrera = str_replace('"', "&quoxyz", $IdCarrera);
		$IdUsuario = $_SESSION['usuario_id'];
		
		if ($_FILES["DocAdd"]["type"]!=null) {
			$sourcePath = $_FILES['DocAdd']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['DocAdd']['name']);
			$texto_cambiado = $IdRequisitosTitulacion."_".$texto_cambiado;
			if ($Nivel == "TSU") {
				$ruta = $targetPath = "../../doc/asignaturas/tsu/".$texto_cambiado;
			} else if ($Nivel == "ING") {
				$ruta = $targetPath = "../../doc/asignaturas/ing/".$texto_cambiado;
			} else if ($Nivel == "LIC") {
				$ruta = $targetPath = "../../doc/asignaturas/lic/".$texto_cambiado;
			}
		
			$act = "INSERT INTO ASIGNATURAS(Id, Nombre, RutaDoc, Creado, Tipo, IdCuatrimestre, IdCarrera, IdUsuario) VALUES (0,'".$Nombre."','".$ruta."', NOW(),'".$Nivel."', '".$IdCuatrimestre."', '".$IdCarrera."', '".$IdUsuario."')";

			$tildes = $conexion->query("SET NAMES 'utf8'");
		
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$asignatura->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Asignaturas');
					echo "Bien";
				}
			}
		}
	}	
?>