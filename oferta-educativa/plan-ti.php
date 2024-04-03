<?php 
$titulo = "TIC  Ingenieria";
$pagina = "planti";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdonITI();
?>
<section class="oferta-educativa">
	<div class="container">
	</div>
</section>
<section id="timeline-oferta">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Planes y Programas de Estudios</h2>
                <h2 class="text-center">Ingeniería  en Tecnologías de la Información</h2>
            </div>
            <div class="col-md-12">
                <section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-red">
				<p>7° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
			<?php
                $principal->consultaAsignaturasINGtiCuatri7();
            ?>

			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-gren">
				<p>8° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasINGtiCuatri8();
            ?>
		     <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-blue">
				<p>9° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasINGtiCuatri9();
            ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-purple">
				<p>10° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasINGtiCuatri10();
            ?>
			<!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
       <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-otro">
				<p>11° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasINGtiCuatri11();
            ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
	</section>
            </div>
        </div>
    </div>
</section>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>