<?php 
$titulo ="Estadia";
$pagina = "estadia";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; ?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdon();
?>
<section class="oferta-educativa">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center animated rotateIn">
				<h1>Estadía</h1>
			</div>
		</div>
	</div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="con-esta border">
          <h3 class="borde-left animated tada">¿Qué es la estadía?</h3>
          <hr />
          <p class="text-justify animated fadeInDown">Es el periodo en el cual el alumno, que cursa el sexto cuatrimestre de TSU, permanece en una empresa o en una organización pública o privada, bajo la tutela de uno de sus integrantes (asesor empresarial), y contando con la asesoría de la Universidad (asesor académico) desarrollará un proyecto de investigación tecnológica que se traduzca en una aportación de la misma. Al continuar la ingeniería en el onceavo cautrimestre el alumno nuevamente realiza la estadía, desarrollando algun proyecto en la empresa donde fue aceptado.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="con-esta border">
          <h3 class="borde-left animated tada">¿Cuál es el propósito?</h3>
          <hr />
          <p class="text-justify animated fadeInDown"> Que el alumno ponga en práctica los conocimientos teórico - prácticos que adquirió durante los primeros cinco cuatrimestres cursados en la Universidad.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="con-esta border">
          <h3 class="borde-left animated tada">Objetivo</h3>
          <hr />
            <ul>
             <li class="animated fadeInRight">Que ayude a la resolución de un problema real de la empresa.</li>
              <li class="animated fadeInRight">Que signifique experiencia para el alumno.</li>
              <li class="animated fadeInRight">Que sea acorde de la carrera del alumno.</li>
              <li class="animated fadeInRight">Que involucre aspectos de calidad total, mejora continua y cuidado del ambiente.</li>
            </ul>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
        <div class="con-estadia border">
          <div class="row">
            <h2 class="text-center animated rotateInUpLeft">Descargar formatos para nivel TSU</h2>
            <?php 
              $principal->consultaestadiatsucalendario();
              $principal->consultaestadiatsuformatos();
              $principal->consultaestadiatsuencuestas();
            ?>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
        <div class="con-esta border">
          <h2 class="text-center animated fadeInUpBig">Descargar formatos para nivel Ingenería</h2>
          <div class="row">
            <?php 
              $principal->consultaestadiaingcalendario();
              $principal->consultaestadiaingformatos();
              $principal->consultaestadiaingencuestas();
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>