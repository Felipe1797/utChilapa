<?php
	include("modelRecuperarPass.php");
	$login = new modelRecuperarPass();
	switch($_POST['opcion'])
	{
		case "recuperarPass":
			$login->recuperarPass($_POST['EMail']);
			break;
	}
?>
