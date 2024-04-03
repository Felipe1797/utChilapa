<?php 
$titulo = "TIC TSU Escolarizado";
$pagina = "tictsuesoc";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdonTIC();
?>
<section class="oferta-educativa">
	<div class="container">
	</div>
</section>
<section id="timeline-oferta" class="conta-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Planes y Programas de Estudios</h2>
                <h2 class="text-center">TSU en Tecnologías de la Información de la Comunicación</h2>
            </div>
            <div class="col-md-12">
                <section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-red">
				<p>1° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
                <?php
                    $principal->consultaAsignaturasTSUticCuatri1();
                ?>
			
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-gren">
				<p>2° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
                <?php
                    $principal->consultaAsignaturasTSUticCuatri2();
                ?>
		    
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-blue">
				<p>3° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->

			<?php
                    $principal->consultaAsignaturasTSUticCuatri3();
            ?>
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-purple">
				<p>4° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
                <?php
                    $principal->consultaAsignaturasTSUticCuatri4();
                ?>
		    <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-yelow">
				<p>5° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
                <?php
                    $principal->consultaAsignaturasTSUticCuatri5();
                ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-otro">
				<p>6° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
                <?php
                    $principal->consultaAsignaturasTSUticCuatri6();
                ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
	</section>
            </div>
        </div>
    </div>
</section>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>