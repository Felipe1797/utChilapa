<?php 
$titulo = "TI ING Despresurizado";
$pagina = "tictsuesoc";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php  require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdonITI();
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
	                <h2 class="text-center">Ingeniería  en Tecnologías de la Información</h2>
	            </div>
	            <div class="col-md-12">
	                <section id="cd-timeline" class="cd-container">
						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-red">
								<p>1° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri1();
                             ?>
							 <!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-gren">
								<p>2° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri2();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-blue">
								<p>3° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri3();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-purple">
								<p>4° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri4();
                             ?>
							 <!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-yelow">
								<p>5° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri5();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-otro">
								<p>6° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri6();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-red">
								<p>7° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri7();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-gren">
								<p>8° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri8();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-blue">
								<p>9° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri9();
                             ?>
						    <!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-purple">
								<p>10° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri10();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-blue">
								<p>11° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri11();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

						<div class="cd-timeline-block">
							<div class="cd-timeline-img cd-gren">
								<p>12° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri12();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->

				        <div class="cd-timeline-block">
							<div class="cd-timeline-img cd-otro">
								<p>13° Cuatrimestre</p>
							</div> <!-- cd-timeline-img -->
                            <?php
                                 $principal->consultaAsignaturasINGtiDespresurizadoCuatri13();
                             ?>
							<!-- cd-timeline-content -->
						</div> <!-- cd-timeline-block -->
					</section>
	            </div>
	        </div>
	    </div>
</section>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>