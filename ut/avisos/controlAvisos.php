<?php
	include("modelAvisos.php");
	$avisos = new modelAvisos();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$avisos->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$avisos->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
