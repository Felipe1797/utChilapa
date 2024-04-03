<?php 
	if ( isset($_SESSION['usuario_cargo']) ) {
		if ( isset($_SESSION['usuario_activo']) ) {
			if ( $_SESSION['usuario_activo'] == "1" ) {
				if ( $_SESSION['usuario_cargo'] == "Super Usuario" ) {
					require '../inc/nav-menu-superusuario.php';
				} else if ( $_SESSION['usuario_cargo'] == "Administrador" ) {
					require '../inc/nav-menu-administrador.php';
				} else if ($_SESSION['usuario_cargo'] == "Servicios Escolares") {
					require '../inc/nav-menu-serviciosescolares.php';
				} else if ($_SESSION['usuario_cargo'] == "Personal") {
					require '../inc/nav-menu-personal.php';
				} else {
					header("Location:../logout.php");
				}
			} else {
				header("Location:../logout.php");
			}
		} else{
			header("Location:../logout.php");
		}	
	} else {
		header("Location:../logout.php");
	}
?>