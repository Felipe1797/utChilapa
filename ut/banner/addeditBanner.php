<?php
	include('modelBanner.php');
	$movilidad = new modelBanner;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["ImgEdit"]["type"])) {
		$IdBeca = $_POST['IdEdit'];
		$Nombre = $_POST['NombreEdit'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$RutaImgName = $_POST['ImgEditName'];
		$RutaImgName = explode("?", $RutaImgName);
		$RutaImgName = $RutaImgName[0];
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["ImgEdit"]["type"] != null) {
			$sourcePathImg = $_FILES['ImgEdit']['tmp_name'];
			$texto_cambiadoImg = str_replace(" ", "_", $_FILES['ImgEdit']['name']);
			$texto_cambiadoImg = $IdBeca."_".$texto_cambiadoImg;
			$rutaImg = $targetPathImg = "../../img/banner/".$texto_cambiadoImg;
			
			$act = "UPDATE BANNER SET Nombre='".$Nombre."', RutaImg='".$rutaImg."', Activo=".$Activo." WHERE Id='".$IdBeca."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaImgName)){}

			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePathImg,$targetPathImg)) {
					$movilidad->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Banner');
					echo "Bien";
				}
			}
		} else {
			$act = "UPDATE BANNER SET Nombre='".$Nombre."', Activo=".$Activo." WHERE Id='".$IdBeca."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act))
			{
				$movilidad->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Banner');
				echo "Bien";
			}
		}
	}

	if(isset($_FILES["ImgAdd"]["type"])) {
		$consulta="SELECT * FROM  BANNER ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdBeca = 0;
		if ($reg['Id']=="") { $IdBeca = '1'; } else if ($reg['Id']!="") { $IdBeca = (Float)$reg['Id'] + 1; }

		$Nombre = $_POST['NombreAdd'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$IdUsuario = $_SESSION['usuario_id'];
		
		if ($_FILES["ImgAdd"]["type"]!=null) {
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["ImgAdd"]["name"]);
			$file_extension = strtolower(end($temporary));
			if ((($_FILES["ImgAdd"]["type"] == "image/png") || ($_FILES["ImgAdd"]["type"] == "image/jpg") || ($_FILES["ImgAdd"]["type"] == "image/jpeg")) && ($_FILES["ImgAdd"]["size"] < 1048576) && in_array($file_extension, $validextensions)){
				if ($_FILES["ImgAdd"]["error"] > 0) {
					echo "Return Code: " . $_FILES["ImgAdd"]["error"] . "<br/><br/>";
				} else {
					$sourcePathImg = $_FILES['ImgAdd']['tmp_name'];
					$texto_cambiadoImg = str_replace(" ", "_", $_FILES['ImgAdd']['name']);
					$texto_cambiadoImg = $IdBeca."_".$texto_cambiadoImg;
					$rutaImg = $targetPathImg = "../../img/banner/".$texto_cambiadoImg;

					$act = "INSERT INTO BANNER(Id, Nombre, RutaImg, Activo, Creado) VALUES (0,'".$Nombre."','".$rutaImg."', true, NOW())";

					$tildes = $conexion->query("SET NAMES 'utf8'");
				
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePathImg,$targetPathImg)) {
							$movilidad->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Banner');
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