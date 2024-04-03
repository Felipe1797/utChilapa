<?php
	include('modelMovilidad.php');
	$movilidad = new modelMovilidad;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["ImgEdit"]["type"])) {
		$IdBeca = $_POST['IdEdit'];
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
		$Movilidad = $_POST['MovilidadEdit'];
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["ImgEdit"]["type"] != null) {
			$sourcePathImg = $_FILES['ImgEdit']['tmp_name'];
			$texto_cambiadoImg = str_replace(" ", "_", $_FILES['ImgEdit']['name']);
			$texto_cambiadoImg = $IdBeca."_".$texto_cambiadoImg;
			$rutaImg = $targetPathImg = "../../img/movilidad/".$texto_cambiadoImg;
			
			$act = "UPDATE MOVILIDADES SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', RutaImg='".$rutaImg."', RutaDoc='".$Movilidad."', Activo=".$Activo." WHERE Id='".$IdBeca."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaImgName)){}

			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePathImg,$targetPathImg)) {
					$movilidad->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Movilidad');
					echo "Bien";
				}
			}
		} else {
			$act = "UPDATE MOVILIDADES SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', RutaDoc='".$Movilidad."',  Activo=".$Activo." WHERE Id='".$IdBeca."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act))
			{
				$movilidad->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Movilidad');
				echo "Bien";
			}
		}
	}

	if(isset($_FILES["ImgAdd"]["type"])) {
		$consulta="SELECT * FROM  MOVILIDADES ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdBeca = 0;
		if ($reg['Id']=="") { $IdBeca = '1'; } else if ($reg['Id']!="") { $IdBeca = (Float)$reg['Id'] + 1; }

		$Nombre = $_POST['NombreAdd'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$Descripcion = $_POST["DescripcionAdd"];
		$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
		$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
		$Descripcion = preg_replace("/\r\n|\r/", "<br>", $Descripcion);
		$Movilidad = $_POST['MovilidadAdd'];
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
					$rutaImg = $targetPathImg = "../../img/movilidad/".$texto_cambiadoImg;

					$act = "INSERT INTO MOVILIDADES(Id, Nombre, Descripcion, RutaImg, RutaDoc, Activo, Creado, IdUsuario) VALUES (0,'".$Nombre."','".$Descripcion."','".$rutaImg."','".$Movilidad."', true, NOW(),'".$IdUsuario."')";

					$tildes = $conexion->query("SET NAMES 'utf8'");
				
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePathImg,$targetPathImg)) {
							$movilidad->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Movilidad');
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