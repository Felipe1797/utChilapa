<?php
	include('modelReglamento.php');
  	$reglamento = new modelReglamento;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["DocEdit"]["type"])) {
		$IdReglamento = $_POST['IdEdit'];
		$Nombre = $_POST['NombreEdit'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$RutaDocName = $_POST['DocEditName'];
		$RutaDocName = explode("?", $RutaDocName);
		$RutaDocName = $RutaDocName[0];
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["DocEdit"]["type"]==null) {
			$act = "UPDATE REGLAMENTOS SET Nombre='".$Nombre."', Activo=".$Activo." WHERE Id='".$IdReglamento."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act)) {
				$reglamento->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Reglamento');
				echo "Bien";
			}
		} else if($_FILES["DocEdit"]["type"]!=null) {
			$validextensions = array("pdf");
			$temporary = explode(".", $_FILES["DocEdit"]["name"]);
			$file_extension = strtolower(end($temporary));
			
			if (($_FILES["DocEdit"]["type"] == "application/pdf") && in_array($file_extension, $validextensions)) {
				if ($_FILES["DocEdit"]["error"] > 0) {
					echo "Return Code: " . $_FILES["DocEdit"]["error"] . "<br/><br/>";
				} else {
					$sourcePath = $_FILES['DocEdit']['tmp_name'];
					$texto_cambiado = str_replace(" ", "_", $_FILES['DocEdit']['name']);
					
					$texto_cambiado = $IdReglamento."_".$texto_cambiado;

					$ruta = $targetPath = "../../doc/reglamentos/".$texto_cambiado;
					
					$act = "UPDATE REGLAMENTOS SET Nombre='".$Nombre."', RutaDoc='".$ruta."', Activo=".$Activo." WHERE Id='".$IdReglamento."'";
					
					$tildes = $conexion->query("SET NAMES 'utf8'");

					if(@unlink($RutaDocName)){}
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePath,$targetPath)) {
							$reglamento->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Reglamento');
							echo "Bien";
						}
					}
				}
			} else {
				echo "<span id='invalid'>***Tamaño de archivo no válido no debe de ser mayor a 1.5 MB o el tipo de archivo***<span>";
			}
		}
	}

	if(isset($_FILES["DocAdd"]["type"])) {
		$consulta="SELECT * FROM  REGLAMENTOS ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdReglamento = 0;
		if ($reg['Id']=="") { $IdReglamento = '1'; } else if ($reg['Id']!="") { $IdReglamento = (Float)$reg['Id'] + 1; }

		$Nombre = $_POST['NombreAdd'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$IdUsuario = $_SESSION['usuario_id'];
		
		if ($_FILES["DocAdd"]["type"]!=null) {
			$validextensions = array("pdf");
			$temporary = explode(".", $_FILES["DocAdd"]["name"]);
			$file_extension = strtolower(end($temporary));
			if (($_FILES["DocAdd"]["type"] == "application/pdf") && in_array($file_extension, $validextensions)) {
				if ($_FILES["DocAdd"]["error"] > 0) {
					echo "Return Code: " . $_FILES["DocAdd"]["error"] . "<br/><br/>";
				} else {
					$sourcePath = $_FILES['DocAdd']['tmp_name'];
					$texto_cambiado = str_replace(" ", "_", $_FILES['DocAdd']['name']);
					$texto_cambiado = $IdReglamento."_".$texto_cambiado;
					$ruta = $targetPath = "../../doc/reglamentos/".$texto_cambiado;
				
					$act = "INSERT INTO REGLAMENTOS(Id, Nombre, RutaDoc, Activo, Creado, IdUsuario) VALUES (0,'".$Nombre."','".$ruta."', true, NOW(),'".$IdUsuario."')";

					$tildes = $conexion->query("SET NAMES 'utf8'");
				
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePath,$targetPath)) {
							$reglamento->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Reglamento');
							echo "Bien";
						}
					}
				}
			}
			else
			{
				echo "<span id='invalid'>***Tamaño de archivo no válido no debe de ser mayor a 1.5 MB o el tipo de archivo***<span>";
			}
		}
	}	
?>