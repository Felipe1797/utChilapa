<?php
	include("modelBanner.php");
	$banner = new modelBanner();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$banner->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$banner->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
