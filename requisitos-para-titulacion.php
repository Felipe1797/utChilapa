<?php 
$titulo = "REQUISITOS PARA LA EXPEDICIÓN";
$pagina = "requisitos";
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; ?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdon();
?>

  <section>
    <div class="container">
      <div class="row">  
        <div class="col-lg-12 titulacion wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
          <h2 class="text-center wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="350ms">REQUISITOS PARA LA EXPEDICIÓN Y TRÁMITE DE CERTIFICADO,  
        TÍTULO Y CÉDULA PROFESIONAL.</h2>
          <br />
          <div class="list">
            <h3 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="450ms">Requisitos y pasos para el trámite </h3>
            <hr />
            <?php 
                $principal->consultatitulacion1();
            ?>
            
            <?php 
                $principal->consultatitulacion2();
            ?>
        
          </div>        
  </section>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>