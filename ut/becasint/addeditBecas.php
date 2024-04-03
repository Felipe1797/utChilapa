<?php
	include('modelBecas.php');
	$becas = new modelBecas;
	require_once('../conexion/conexionValidacion1.php');

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
		$RutaDocName = $_POST['DocEditName'];
		$RutaDocName = explode("?", $RutaDocName);
		$RutaDocName = $RutaDocName[0];
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["ImgEdit"]["type"] != null && $_FILES["DocEdit"]["type"] != null) {
			$sourcePathImg = $_FILES['ImgEdit']['tmp_name'];
			$texto_cambiadoImg = str_replace(" ", "_", $_FILES['ImgEdit']['name']);
			$texto_cambiadoImg = $IdBeca."_".$texto_cambiadoImg;
			$rutaImg = $targetPathImg = "../../img/becas/".$texto_cambiadoImg;

			$sourcePathDoc = $_FILES['DocEdit']['tmp_name'];
			$texto_cambiadoDoc = str_replace(" ", "_", $_FILES['DocEdit']['name']);
			$texto_cambiadoDoc = $IdBeca."_".$texto_cambiadoDoc;
			$rutaDoc = $targetPathDoc = "../../doc/becas/".$texto_cambiadoDoc;
			
			$act = "UPDATE BECAS SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', RutaImg='".$rutaImg."', RutaDoc='".$rutaDoc."', Activo=".$Activo." WHERE Id='".$IdBeca."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaImgName)){}
			if(@unlink($RutaDocName)){}

			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePathImg,$targetPathImg)) {
					if (@move_uploaded_file($sourcePathDoc,$targetPathDoc)) {
						$becas->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Becas');
						echo "Bien";
					}
				}
			}
		} else if($_FILES["ImgEdit"]["type"] != null) {
			$sourcePathImg = $_FILES['ImgEdit']['tmp_name'];
			$texto_cambiadoImg = str_replace(" ", "_", $_FILES['ImgEdit']['name']);
			$texto_cambiadoImg = $IdBeca."_".$texto_cambiadoImg;
			$rutaImg = $targetPathImg = "../../img/becas/".$texto_cambiadoImg;
			
			$act = "UPDATE BECAS SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', RutaImg='".$rutaImg."', Activo=".$Activo." WHERE Id='".$IdBeca."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");

			if(@unlink($RutaImgName)){}
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePathImg,$targetPathImg)) {
					$becas->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Becas');
					echo "Bien";
				}
			}
		} else if($_FILES["DocEdit"]["type"] != null) {
			$sourcePathDoc = $_FILES['DocEdit']['tmp_name'];
			$texto_cambiadoDoc = str_replace(" ", "_", $_FILES['DocEdit']['name']);
			$texto_cambiadoDoc = $IdBeca."_".$texto_cambiadoDoc;
			$rutaDoc = $targetPathDoc = "../../doc/becas/".$texto_cambiadoDoc;
			
			$act = "UPDATE BECAS SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', RutaDoc='".$rutaDoc."', Activo=".$Activo." WHERE Id='".$IdBeca."'";
			
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@unlink($RutaDocName)){}
			if (@mysqli_query($conexion,$act)) {
				if (@move_uploaded_file($sourcePathDoc,$targetPathDoc)) {
					$becas->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Becas');
					echo "Bien";
				}
			}
		} else {
			$act = "UPDATE BECAS SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', Activo=".$Activo." WHERE Id='".$IdBeca."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act))
			{
				$becas->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Becas');
				echo "Bien";
			}
		}
	}

	if(isset($_FILES["ImgAdd"]["type"])) {
		$consulta="SELECT * FROM  BECAS ORDER BY Id DESC LIMIT 0,1";
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
		$IdUsuario = $_SESSION['usuario_id'];
		
		if ($_FILES["ImgAdd"]["type"]!=null && $_FILES["DocAdd"]["type"]!=null ) {
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
					$rutaImg = $targetPathImg = "../../img/becas/".$texto_cambiadoImg;
					
					$sourcePathDoc = $_FILES['DocAdd']['tmp_name'];
					$texto_cambiadoDoc = str_replace(" ", "_", $_FILES['DocAdd']['name']);
					$texto_cambiadoDoc = $IdBeca."_".$texto_cambiadoDoc;
					$rutaDoc = $targetPathDoc = "../../doc/becas/".$texto_cambiadoDoc;

					$act = "INSERT INTO BECAS(Id, Nombre, Descripcion, RutaImg, RutaDoc, Activo, Creado, IdUsuario) VALUES (0,'".$Nombre."','".$Descripcion."','".$rutaImg."','".$rutaDoc."', true, NOW(),'".$IdUsuario."')";

					$tildes = $conexion->query("SET NAMES 'utf8'");
				
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePathImg,$targetPathImg)) {
							if (@move_uploaded_file($sourcePathDoc,$targetPathDoc)) {
								$becas->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Becas');
								echo "Bien";
							}
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