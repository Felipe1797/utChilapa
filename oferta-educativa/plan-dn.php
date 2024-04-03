<?php 
$titulo = "TSU Desarrollo de Negocios ";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdonDesarrolloDeNegocios();
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
                <h2 class="text-center">TSU en Desarrollo de Negocios</h2>
            </div>
            <div class="col-md-12">
                <section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-red">
				<p>1° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                 $principal->consultaAsignaturasTSUdesarrollodenegociosCuatri1();
             ?>
			
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-gren">
				<p>2° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                 $principal->consultaAsignaturasTSUdesarrollodenegociosCuatri2();
             ?>
			
		     <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-blue">
				<p>3° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                 $principal->consultaAsignaturasTSUdesarrollodenegociosCuatri3();
             ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-purple">
				<p>4° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                 $principal->consultaAsignaturasTSUdesarrollodenegociosCuatri4();
             ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-yelow">
				<p>5° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                 $principal->consultaAsignaturasTSUdesarrollodenegociosCuatri5();
             ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-otro">
				<p>6° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
			<?php
                 $principal->consultaAsignaturasTSUdesarrollodenegociosCuatri6();
             ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
	</section>
            </div>
        </div>
    </div>
</section>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>