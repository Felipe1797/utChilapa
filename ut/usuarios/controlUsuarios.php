<?php
	include("modelUsuarios.php");
	$usuarios = new modelUsuarios();
	switch($_POST['opcion']) {
		case 'cinicial':
			$usuarios->cinicial($_POST['vals']);
			break;
		case 'agregar':
			$usuarios->agregar($_POST['IdUsuario'], $_POST['Nombres'], $_POST['Apellidos'], $_POST['NombreUsuario'], $_POST['EMail'], $_POST['Contrasena'], $_POST['Activo'], $_POST['Cargo']);
			break;
		case 'modificar':
			$usuarios->modificar($_POST['IdUsuario'], $_POST['Nombres'], $_POST['Apellidos'], $_POST['NombreUsuario'], $_POST['EMail'], $_POST['Contrasena'], $_POST['Activo'], $_POST['Cargo']);
			break;
		case 'modificarAcceso':
			$usuarios->modificarAcceso($_POST['Id'], $_POST['Avisos'], $_POST['Notas'], $_POST['Calendarios'], $_POST['Becas'], $_POST['Requisitos'], $_POST['Documentos'], $_POST['Visitas'], $_POST['Seguimientos'], $_POST['Movilidades'], $_POST['Directorios'], $_POST['Titulos'], $_POST['Banner']);
			break;
		case 'validarEliminar':
			$usuarios->validarEliminar($_POST['IdUsuario']);
			break;
		case 'eliminar':
			$usuarios->eliminar($_POST['IdUsuario']);
			break;
	}
?>
