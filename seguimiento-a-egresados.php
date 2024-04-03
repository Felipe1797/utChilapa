<?php 
$titulo = "Seguimiento a egresados";
$pagina = "seguimiento";
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
				<h1 class="text-center borde-bottum">Seguimiento a egresados</h1>
				<br />
			</div>
			<div class="col-md-12" style='text-align: justify;'>
				<p>Es el procedimiento para conocer el desempeño de los egresados y la satisfacción de los empleadores, durante un periodo de 5 años. También se trata de dar seguimiento a los egresados que continúan sus estudios y de ofrecer a los egresados cursos o talleres de los cuales ellos planteen sus necesidades académicas.</p>
				<h2 class="borde-left">Testimonios</h2>
				<ul>
					<?php 
						$principal->consultaegresados();
					?>
				</ul>
			</div>
		</div>
	</div>
</section>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>