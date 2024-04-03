<?php 
$titulo = "TSU Conta";
$pagina = "planconta";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdonConta();
?>
<section class="oferta-educativa">
	<div class="container">
    </div>
</section>
<section id="timeline-oferta">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Planes y Programas de Estudios </h2>
                <h2 class="text-center">TSU en Contaduría</h2>
            </div>
            <div class="col-md-12">
                <section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-red">
				<p>1° Cuatrimestre</p>
			</div>

			<?php
                 $principal->consultaAsignaturasTSUcontaCuatri1();
             ?> 
		</div> 

		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-gren">
				<p>2° Cuatrimestre</p>
			</div>
            <?php
                 $principal->consultaAsignaturasTSUcontaCuatri2();
            ?>
			
		</div> 

		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-blue">
				<p>3° Cuatrimestre</p>
			</div> 

			<?php
                    $principal->consultaAsignaturasTSUcontaCuatri3();
             ?> 
		</div> 

		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-purple">
				<p>4° Cuatrimestre</p>
			</div> 

			<?php
                    $principal->consultaAsignaturasTSUcontaCuatri4();
             ?> 
		</div>

		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-yelow">
				<p>5° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->

			<?php
                    $principal->consultaAsignaturasTSUcontaCuatri5();
             ?> 
		</div>

		<div class="cd-timeline-block wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
			<div class="cd-timeline-img cd-otro">
				<p>6° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->

			<?php
                    $principal->consultaAsignaturasTSUcontaCuatri6();
             ?> 
		</div> 
	</section>
            </div>
        </div>
    </div>
</section>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>