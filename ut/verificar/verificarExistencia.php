<?php
	session_start();
	require_once('../conexion/conexionValidacion.php');

	if(isset($_POST['EMailAdd']))
	{
		$consulta = "SELECT * FROM USUARIOS WHERE EMail='".$_POST['EMailAdd']."'";
		$resultados = mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		if (mysqli_num_rows($resultados)>0) {
			echo "false";
		} else {
			echo "true";
		}
	}

	if(isset($_POST['NombreUsuarioAdd']))
	{
		$consulta = "SELECT * FROM USUARIOS WHERE NombreUsuario='".$_POST['NombreUsuarioAdd']."'";
		$resultados = mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
		$reg=mysqli_fetch_array($resultados);
		if (mysqli_num_rows($resultados)>0) {
			echo "false";
		} else {
			echo "true";
		}
	}

?>
