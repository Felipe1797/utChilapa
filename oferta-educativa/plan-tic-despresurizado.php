<?php 
$titulo = "TIC TSU Despresurizado";
$pagina = "ticdespre";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdon();
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
                <h2 class="text-center">TSU en Tecnologías de la Información y Comunicación</h2>
            </div>
            <div class="col-md-12">
                <section id="cd-timeline" class="cd-container">
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-red">
            				<p>1° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri1();
                        ?> 
            			 <!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-gren">
            				<p>2° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri2();
                        ?>
            			 <!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-blue">
            				<p>3° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri3();
                        ?>
            			<!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-gren">
            				<p>4° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri4();
                        ?>
            		     <!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-purple">
            				<p>5° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri5();
                        ?>
            			 <!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-yelow">
            				<p>6° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri6();
                        ?>
            			<!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            		
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-purple">
            				<p>7° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri7();
                        ?>
            			 <!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            		
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-yelow">
            				<p>8° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri8();
                        ?>
            			<!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            
            		<div class="cd-timeline-block wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            			<div class="cd-timeline-img cd-otro">
            				<p>9° Cuatrimestre</p>
            			</div> <!-- cd-timeline-img -->
                        <?php
                             $principal->consultaAsignaturasTSUticDespresurizadoCuatri9();
                        ?>
                        <!-- cd-timeline-content -->
            		</div> <!-- cd-timeline-block -->
            	</section>
            </div>
        </div>
    </div>
</section>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>