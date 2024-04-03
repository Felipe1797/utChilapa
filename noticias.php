<?php 
	$titulo = "Noticias";
	$pagina = "noticias";
?>
<?php
	require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc';
	require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc';
?>

<?php
    $principal->consultabannerramdon();
?>

<div class="container" style="padding: 0px; background-color: #fff; margin-bottom: 20px; margin-top: 20px;">
	<?php
		if (!isset($_GET['op'])) {
			$principal->consultanoticias("");
		} else if (isset($_GET['op'])) {
			$principal->consultanoticia();
		}
	?>
	</div>

</div>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>