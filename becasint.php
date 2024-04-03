<?php 
$titulo = "Becas";
$pagina = "becas";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; ?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdon();
?>

<section class="oferta-educativa">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <h1>Becas</h1>
      </div>
    </div>
  </div>
</section>
<section>
    <div class="container">
    <div class="row">
      <div class="col-lg-4">
      </div>
    </div>
      <div class="row">
        <div class="col-center col-lg-12 col-md-12 col-center">
          <?php 
            $principal->consultabecas();
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>