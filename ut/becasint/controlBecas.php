<?php
	include("modelBecas.php");
	$becas = new modelBecas();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$becas->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$becas->eliminar($_POST['IdNota'], $_POST['RutaImg'], $_POST['RutaDoc']);
			break;
	}
?>
