<?php
	include('modelNotas.php');
  $notas = new modelNotas;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["ImgEdit"]["type"])) {
		$IdNota = $_POST['IdEdit'];
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
		$RutaNota = $_POST['URLNotaEdit'];
		$Activo = 'false';
		if (isset($_POST['ActivoEdit'])) {
			$Activo = 'true';
		}

		if($_FILES["ImgEdit"]["type"]==null) {
			$act = "UPDATE NOTAS SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', RutaNota='".$RutaNota."', Activo=".$Activo." WHERE Id='".$IdNota."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act))
			{
				$notas->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Noticias');
				echo "Bien";
			}
		} else if($_FILES["ImgEdit"]["type"]!=null) {
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["ImgEdit"]["name"]);
			$file_extension = strtolower(end($temporary));
			
			if ((($_FILES["ImgEdit"]["type"] == "image/png") || ($_FILES["ImgEdit"]["type"] == "image/jpg") || ($_FILES["ImgEdit"]["type"] == "image/jpeg")) && ($_FILES["ImgEdit"]["size"] < 1572864) && in_array($file_extension, $validextensions)) {
				if ($_FILES["ImgEdit"]["error"] > 0) {
					echo "Return Code: " . $_FILES["ImgEdit"]["error"] . "<br/><br/>";
				} else {
					/* if (file_exists("imagesUsers/" . $_FILES["ImgEdit"]["name"]))
					{
						echo $_FILES["ImgEdit"]["name"] . " <span id='invalid'><b>El la imagen existe.</b></span> ";
					}
					else
					{ */
					$sourcePath = $_FILES['ImgEdit']['tmp_name']; // Storing source path of the file in a variable
					$texto_cambiado = str_replace(" ", "_", $_FILES['ImgEdit']['name']);
					
					$texto_cambiado = $IdNota."_".$texto_cambiado;

					$ruta = $targetPath = "../../img/notas/".$texto_cambiado; // Target path where file is to be stored
					
					$act = "UPDATE NOTAS SET Nombre='".$Nombre."', Descripcion='".$Descripcion."', RutaImg='".$ruta."', RutaNota='".$RutaNota."', Activo=".$Activo." WHERE Id='".$IdNota."'";
					
					$tildes = $conexion->query("SET NAMES 'utf8'"); //Para que se muestren las tildes

					if(@unlink($RutaImgName)){}
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePath,$targetPath)) {
							$notas->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Noticias');
							echo "Bien";
						}
					}
				}
			} else {
				echo "<span id='invalid'>***Tamaño de archivo no válido no debe de ser mayor a 1.5 MB o el tipo de archivo***<span>";
			}
		}
	}

	if(isset($_FILES["ImgAdd"]["type"])) {
		$consulta="SELECT * FROM  NOTAS ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdNota = 0;
		if ($reg['Id']=="") { $IdNota = '1'; } else if ($reg['Id']!="") { $IdNota = (Float)$reg['Id'] + 1; }

		$Nombre = $_POST['NombreAdd'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$Descripcion = $_POST["DescripcionAdd"];
		$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
		$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
		$Descripcion = preg_replace("/\r\n|\r/", "<br>", $Descripcion);
		$RutaNota=$_POST['URLNotaAdd'];
		$IdUsuario = $_SESSION['usuario_id'];
		
		if ($_FILES["ImgAdd"]["type"]!=null) {
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["ImgAdd"]["name"]);
			$file_extension = strtolower(end($temporary));
			if ((($_FILES["ImgAdd"]["type"] == "image/png") || ($_FILES["ImgAdd"]["type"] == "image/jpg") || ($_FILES["ImgAdd"]["type"] == "image/jpeg")) && ($_FILES["ImgAdd"]["size"] < 1048576) && in_array($file_extension, $validextensions)) {
				if ($_FILES["ImgAdd"]["error"] > 0) {
					echo "Return Code: " . $_FILES["ImgAdd"]["error"] . "<br/><br/>";
				} else {
					$sourcePath = $_FILES['ImgAdd']['tmp_name'];
					$texto_cambiado = str_replace(" ", "_", $_FILES['ImgAdd']['name']);
					$texto_cambiado = $IdNota."_".$texto_cambiado;
					$ruta = $targetPath = "../../img/notas/".$texto_cambiado;
				
					$act = "INSERT INTO NOTAS(Id, Nombre, Descripcion, RutaImg, RutaNota, Creado, IdUsuario, Activo) VALUES (0,'".$Nombre."','".$Descripcion."','".$ruta."','".$RutaNota."', NOW(),'".$IdUsuario."', true)";

					$tildes = $conexion->query("SET NAMES 'utf8'");
				
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePath,$targetPath)) {
							$notas->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Noticias');
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

	if(isset($_FILES["ImgAddPromo"]["type"])) {
		$consulta="SELECT * FROM  PROMOCIONES ORDER BY Id DESC LIMIT 0,1";
		$conexion->set_charset('utf8');
		$resultados=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		$IdNota = 0;
		if ($reg['Id']=="") { $IdNota = '1'; } else if ($reg['Id']!="") { $IdNota = (Float)$reg['Id'] + 1; }

		$Tipo = $_POST['TipoPromo'];
		$Nombre = $_POST['NombreAddPromo'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$URL = $_POST["URLAddPromo"];
		$URL = str_replace("'", "&apoxyz", $URL);
		$URL = str_replace('"', "&quoxyz", $URL);
		
		if ($_FILES["ImgAddPromo"]["type"]!=null) {
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["ImgAddPromo"]["name"]);
			$file_extension = strtolower(end($temporary));
			if ((($_FILES["ImgAddPromo"]["type"] == "image/png") || ($_FILES["ImgAddPromo"]["type"] == "image/jpg") || ($_FILES["ImgAddPromo"]["type"] == "image/jpeg")) && ($_FILES["ImgAddPromo"]["size"] < 1048576) && in_array($file_extension, $validextensions)) {
				if ($_FILES["ImgAddPromo"]["error"] > 0) {
					echo "Return Code: " . $_FILES["ImgAddPromo"]["error"] . "<br/><br/>";
				} else {
					$sourcePath = $_FILES['ImgAddPromo']['tmp_name'];
					$texto_cambiado = str_replace(" ", "_", $_FILES['ImgAddPromo']['name']);
					$texto_cambiado = $IdNota."_".$texto_cambiado;
					$ruta = $targetPath = "../../img/promociones/".$texto_cambiado;
				
					$act = "INSERT INTO PROMOCIONES(Id, Tipo, Nombre, URL, RutaImg, Activo, Creado) VALUES (0,'".$Tipo."','".$Nombre."','".$URL."','".$ruta."',true,NOW())";

					$tildes = $conexion->query("SET NAMES 'utf8'");
				
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePath,$targetPath)) {
							$notas->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Promociones');
							echo "Bien";
						}
					}
				}
			}
			else
			{
				echo "<span id='invalid'>***Tamaño de archivo no válido no debe de ser mayor a 1.5 MB o el tipo de archivo***<span>";
			}
		} else {
			$act = "INSERT INTO PROMOCIONES(Id, Tipo, Nombre, URL, RutaImg, Activo, Creado) VALUES (0,'".$Tipo."','".$Nombre."','".$URL."','',true,NOW())";

			$tildes = $conexion->query("SET NAMES 'utf8'");
		
			if (@mysqli_query($conexion,$act)) {
				$notas->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Promociones');
				echo "Bien";
			}
		}
	}

	if(isset($_FILES["ImgEditPromo"]["type"])) {
		$Id = $_POST['IdEditPromo'];
		$Tipo = $_POST['TipoEditPromo'];
		$Nombre = $_POST['NombreEditPromo'];
		$Nombre = str_replace("'", "&apoxyz", $Nombre);
		$Nombre = str_replace('"', "&quoxyz", $Nombre);
		$URL = $_POST["URLEditPromo"];
		$URL = str_replace("'", "&apoxyz", $URL);
		$URL = str_replace('"', "&quoxyz", $URL);
		$RutaImgName = $_POST['ImgEditNamePromo'];
		$RutaImgName = explode("?", $RutaImgName);
		$RutaImgName = $RutaImgName[0];
		$Activo = 'false';
		if (isset($_POST['ActivoEditPromo'])) {
			$Activo = 'true';
		}

		if($_FILES["ImgEditPromo"]["type"]==null) {
			$act = "UPDATE PROMOCIONES SET Tipo='".$Tipo."', Nombre='".$Nombre."', URL='".$URL."', Activo=".$Activo." WHERE Id='".$Id."'";
			$tildes = $conexion->query("SET NAMES 'utf8'");
			if(@mysqli_query($conexion,$act)) {
				$notas->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Promociones');
				echo "Bien";
			}
		} else if($_FILES["ImgEditPromo"]["type"]!=null) {
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["ImgEditPromo"]["name"]);
			$file_extension = strtolower(end($temporary));
			
			if ((($_FILES["ImgEditPromo"]["type"] == "image/png") || ($_FILES["ImgEditPromo"]["type"] == "image/jpg") || ($_FILES["ImgEditPromo"]["type"] == "image/jpeg")) && ($_FILES["ImgEditPromo"]["size"] < 1572864) && in_array($file_extension, $validextensions)) {
				if ($_FILES["ImgEditPromo"]["error"] > 0) {
					echo "Return Code: " . $_FILES["ImgEditPromo"]["error"] . "<br/><br/>";
				} else {
					$sourcePath = $_FILES['ImgEditPromo']['tmp_name']; // Storing source path of the file in a variable
					$texto_cambiado = str_replace(" ", "_", $_FILES['ImgEditPromo']['name']);
					
					$texto_cambiado = $Id."_".$texto_cambiado;

					$ruta = $targetPath = "../../img/promociones/".$texto_cambiado; // Target path where file is to be stored
					
					$act = "UPDATE PROMOCIONES SET Tipo='".$Tipo."', Nombre='".$Nombre."', URL='".$URL."', Activo=".$Activo.", RutaImg='".$ruta."' WHERE Id='".$Id."'";
					
					$tildes = $conexion->query("SET NAMES 'utf8'"); //Para que se muestren las tildes

					if(@unlink($RutaImgName)){}
					if (@mysqli_query($conexion,$act)) {
						if (@move_uploaded_file($sourcePath,$targetPath)) {
							$notas->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Promociones');
							echo "Bien";
						}
					}
				}
			} else {
				echo "<span id='invalid'>***Tamaño de archivo no válido no debe de ser mayor a 1.5 MB o el tipo de archivo***<span>";
			}
		}
	}
?>