<?php 
$titulo = "Promocion y Difusion";
$pagina = "promocion";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdon();
?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-center">
				<h1 class="text-center borde-bottum">Nuestras Carreras</h1>
				<br />
			</div>
	

		</div>
	</div>
	
    <div class="trip">
<img src="img/tripticodigital-01.png" alt="" width="170" height="100">
		</div>
</section>


<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>