<?php 
$titulo = "Licenciatura en Contaduría";
$pagina = "plan-Lic-Conta";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdonIFF();
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
                <h2 class="text-center">Licenciatura en Contaduría</h2>
            </div>
            <div class="col-md-12">
                <section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-red">
				<p>7° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasLicContaCuatri7();
            ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-gren">
				<p>8° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasLicContaCuatri8();
            ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-blue">
				<p>9° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasLicContaCuatri9();
            ?>
			 <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-purple">
				<p>10° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasLicContaCuatri10();
            ?>
			<!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
       <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-otro">
				<p>11° Cuatrimestre</p>
			</div> <!-- cd-timeline-img -->
            <?php
                $principal->consultaAsignaturasLicContaCuatri11();
            ?>
			<!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
	</section>
            </div>
        </div>
    </div>
</section>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>