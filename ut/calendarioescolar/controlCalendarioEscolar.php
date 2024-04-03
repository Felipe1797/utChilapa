<?php
	include("modelCalendarioEscolar.php");
	$calendarioescolar = new modelCalendarioEscolar();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$calendarioescolar->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$calendarioescolar->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
