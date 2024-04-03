<?php
	include('modelAvisos.php');
  	$avisos = new modelAvisos;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["ImgEdit"]["type"])) {
		$IdAvisos = $_POST['IdEdit'];
		$RutaImgName = $_POST['ImgEditName'];
		$RutaImgName = explode("?", $RutaImgName);
		$RutaImgName = $RutaImgName[0];
		$Descripcion = $_POST['DescripcionEdit'];
		$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
		$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["ImgEdit"]["type"]==null) {
			$act = "UPDATE AVISOS SET Descripcion='".$Descripcion."', Activo=".$Activo." WHERE Id='".$IdAvisos."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act)) {
				$avisos->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Avisos');
				echo "Bien";
			}
		} else if($_FILES["ImgEdit"]["type"]!=null) {
			$sourcePath = $_FILES['ImgEdit']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['ImgEdit']['name']);
			$texto_cambiado = $IdAvisos."_".$texto_cambiado;
			$ruta = $targetPath = "../../img/avisos/".$texto_cambiado;
			
			$act = "UPDATE AVISOS SET RutaImg='".$ruta."', Descripcion='".$Descripcion."', Activo=".$Activo." WHERE Id='".$IdAvisos."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaImgName)){}
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$avisos->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Avisos');
					echo "Bien";
				}
			}
		}
	}

	if(isset($_FILES["ImgAdd"]["type"])) {
		$consulta="SELECT * FROM  AVISOS ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdAvisos = 0;
		if ($reg['Id']=="") { $IdAvisos = '1'; } else if ($reg['Id']!="") { $IdAvisos = (Float)$reg['Id'] + 1; }

		$Descripcion = $_POST['DescripcionAdd'];
		$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
		$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
		$IdUsuario = $_SESSION['usuario_id'];
		
		if($_FILES["ImgAdd"]["type"]==null) {
			$act = "INSERT INTO AVISOS(Id, RutaImg, Descripcion, Activo, Creado, IdUsuario) VALUES (0,'','".$Descripcion."', true, NOW(),'".$IdUsuario."')";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act)) {
				$avisos->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Avisos');
				echo "Bien";
			}
		} else if ($_FILES["ImgAdd"]["type"]!=null) {
			$sourcePath = $_FILES['ImgAdd']['tmp_name'];
			$texto_cambiado = str_replace(" ", "_", $_FILES['ImgAdd']['name']);
			$texto_cambiado = $IdAvisos."_".$texto_cambiado;
			$ruta = $targetPath = "../../img/avisos/".$texto_cambiado;
		
			$act = "INSERT INTO AVISOS(Id, RutaImg, Descripcion, Activo, Creado, IdUsuario) VALUES (".$IdAvisos.",'".$ruta."','".$Descripcion."', true, NOW(),'".$IdUsuario."')";

			$tildes = $conexion->query("SET NAMES 'utf8'");
		
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePath,$targetPath)) {
					$avisos->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Avisos');
					echo "Bien";
				}
			}
		}
	}	
?>