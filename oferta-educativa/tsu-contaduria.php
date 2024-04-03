<?php
$titulo = "Contaduría";
$pagina = "ofertaEdu";
require ($_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'); ?>

<?php
    $principal->consultabannerramdonConta();
?>

<section class="oferta-educativa">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
				<h1>Oferta Educativa</h1>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row ">
		    <center>
			<div class="col-md-12">
				<h2>Contaduría</h2>
				<hr />
			</div>
			</center>
			<br />
			<br /><br />
			
			<div class="col-md-8 col-md-offset-2">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				  <?php
                        $principal->consultaOfertaEducativaCONTA();
                   ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php require($_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'); ?>
