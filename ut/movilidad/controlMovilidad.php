<?php
	include("modelMovilidad.php");
	$movilidad = new modelMovilidad();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$movilidad->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$movilidad->eliminar($_POST['IdNota'], $_POST['RutaImg'], $_POST['RutaDoc']);
			break;
	}
?>
