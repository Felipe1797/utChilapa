<?php
	include('modelVisitasIndustriales.php');
  	$visitasindustriales = new modelVisitasIndustriales;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["ImgEdit"]["type"])) {
		$Idvisitasindustriales = $_POST['IdEdit'];
		$Nombre = $_POST['NombreEdit'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$Descripcion = $_POST["DescripcionEdit"];
		$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
		$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
		$Descripcion = preg_replace("/\r\n|\r/", "<br>", $Descripcion);
		$RutaImgName = $_POST['ImgEditName'];
		$RutaImgName = explode("?", $RutaImgName);
		$RutaImgName = $RutaImgName[0];
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["ImgEdit"]["type"]==null) {
			$act = "UPDATE VISITASINDUSTRIALES SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', Activo=".$Activo." WHERE Id='".$Idvisitasindustriales."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act)) {
				$visitasindustriales->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Visitas industriales');
				echo "Bien";
			}
		} else if($_FILES["ImgEdit"]["type"]!=null) {
			$sourcePath = $_FILES['ImgEdit']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['ImgEdit']['name']);
			$texto_cambiado = $Idvisitasindustriales."_".$texto_cambiado;
			$ruta = $targetPath = "../../img/visitasindustriales/".$texto_cambiado;
			
			$act = "UPDATE VISITASINDUSTRIALES SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', RutaImg='".$ruta."', Activo=".$Activo." WHERE Id='".$Idvisitasindustriales."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaImgName)){}
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$visitasindustriales->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Visitas industriales');
					echo "Bien";
				}
			}
		}
	}

	if(isset($_FILES["ImgAdd"]["type"])) {
		$consulta="SELECT * FROM  VISITASINDUSTRIALES ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$Idvisitasindustriales = 0;
		if ($reg['Id']=="") { $Idvisitasindustriales = '1'; } else if ($reg['Id']!="") { $Idvisitasindustriales = (Float)$reg['Id'] + 1; }

		$Nombre = $_POST['NombreAdd'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$Descripcion = $_POST["DescripcionAdd"];
		$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
		$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
		$Descripcion = preg_replace("/\r\n|\r/", "<br>", $Descripcion);
		$IdUsuario = $_SESSION['usuario_id'];
		
		if ($_FILES["ImgAdd"]["type"]!=null) {
			$sourcePath = $_FILES['ImgAdd']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['ImgAdd']['name']);
			$texto_cambiado = $Idvisitasindustriales."_".$texto_cambiado;
			$ruta = $targetPath = "../../img/visitasindustriales/".$texto_cambiado;
		
			$act = "INSERT INTO VISITASINDUSTRIALES(Id, Nombre, Descripcion, RutaImg, Activo, Creado, IdUsuario) VALUES (0,'".$Nombre."','".$Descripcion."','".$ruta."', true, NOW(),'".$IdUsuario."')";

			$tildes = $conexion->query("SET NAMES 'utf8'");
		
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$visitasindustriales->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Visitas industriales');
					echo "Bien";
				}
			}
		}
	}	
?>