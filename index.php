<?php 
$titulo = "Ut Chilapa";
$pagina = "inicio";
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc';?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<header>
  <div class="cont-slider">
    <ul class="rslides" id="slider2">
      <?php
        $principal->consultabanner();
      ?>
    </ul>
  </div>
</header>
<body>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
<div class="clearfix"></div>
  <div class="container" style="background-color: #fff;">
    <br />
    <h2 class="widget-title wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"><span>Unidad Académica en la Región de la Montaña</span></h2>
    <div class="row">
      <div class="col-xs-12 col-md-3 col-sm-6 text-center wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="conte-prin">
          <a href="nuestra-universidad/">
            <div class="conten-icon">
              <span class="icono-prin icon-office"></span>
            </div>
          </a>
          <div class="tex-prin">
            <h3 class="text-center">Nuestra Universidad</h3>
            <hr />
            <p class="text-justify">Somos una institución comprometida con la formación de profesionales capaces de promover el desarrollo de la región a través de la aplicación del conocimiento.</p>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-3 col-sm-6 text-center wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="450ms">
        <div class="conte-prin">
          <a href="becas/">
            <div class="conten-icon">
              <span class="icono-prin icon-book"></span>
            </div>
          </a>
          <div class="tex-prin">
            <h3 class="text-center">Becas</h3>
            <hr />
            <p class="text-justify">Becas para la comunidad estudiantil.</p>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-3 col-sm-6 text-center wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="550ms">
        <div class="conte-prin">
          <a href="calendario/">
            <div class="conten-icon">
              <span class="icono-prin icon-calendar"></span>
            </div>
          </a>
          <div class="tex-prin">
            <h3 class="text-center">Calendario Escolar</h3>
            <hr />
            <p class="text-justify">Calendario escolar.</p>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-3 col-sm-6 text-center wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="650ms">
        <div class="conte-prin">
          <a href="reglamentos/">
            <div class="conten-icon">
              <span class="icono-prin icon-file-text2"></span>
            </div>
          </a>
          <div class="tex-prin">
            <h3 >Reglamentos</h3>
            <hr />
            <p class="text-justify">Reglamentos, conoce tus derechos y obligaciones a través de los reglamentos.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container" style="background-color: #fff;">
  <hr>
  <br>
  <div class="row">
    <div class="col-sm-9 col-md-9">
      <h3 class="widget-title wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"><span>Noticias</span></h3>
      <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <?php 
          $principal->consultaindex();
        ?>
      </div>
      <a class="leermas" href="/noticias/" target="_blank"><h4 class="col-md-4">[Leer más noticias]</h4></a>
    </div>
    <div class="col-sm-3 col-md-3" style="max-height: 1150px; overflow-y: scroll;">
      <div class="fb-page" data-href="https://www.facebook.com/Unidad-Acad&#xe9;mica-en-la-Regi&#xf3;n-de-la-Monta&#xf1;a-491613584338212/" data-tabs="timeline" data-width="262" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/Unidad-Acad&#xe9;mica-en-la-Regi&#xf3;n-de-la-Monta&#xf1;a-491613584338212/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Unidad-Acad&#xe9;mica-en-la-Regi&#xf3;n-de-la-Monta&#xf1;a-491613584338212/">Unidad Académica en la Región de la Montaña</a></blockquote></div>
      <?php
        $principal->consultapromociones();
      ?>
    </div>
  </div>
</div>
<div class="container" style="background-color: #fff; padding-bottom: 50px; margin-bottom:50px;">
  <hr>
  <br>
  <h3 class="widget-title wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms"><span>Nuestras carreras</span></h3>
  <div class="row">
    <div class="col-xs-6 col-sm-4 col-md-4">
      <div class="cont-carreras tsu-tic wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <a href="../oferta-educativa/tsu-tic/">
         <img src="img/carreras/Logotic.png" alt="TIC">   
         
          <h4>TSU en Tecnologías de la Información: área Desarrollo de Software Multiplataforma</h4>
        </a>
      </div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-4">
      <div class="cont-carreras tsu-conta wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="450ms">
        <a href="../oferta-educativa/tsu-contaduria/">
          <img src="img/carreras/contaduria.png" alt="Contaduria">
          <h4>TSU en Contaduría</h4>
        </a>
      </div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-4">
      <div class="cont-carreras tsu-dn wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="550ms">
        <a href="../oferta-educativa/tsu-desarollodenegocios/">
          <img src="img/carreras/desarrollo_de_negicios2.png" alt="Desarrollo de Negocios">
          <h4>TSU en Desarrollo de negocios; área Mercadotecnia</h4>
        </a>
      </div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-4">
      <div class="cont-carreras ing-tic wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="650ms">
        <a href="../oferta-educativa/ing-ti/">
          <span class="icon-carreras icon-embed2"></span>
          <h4>Ingeniería en Tecnologías de la Información</h4>
        </a>
      </div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-4">
      <div class="cont-carreras ing-fif wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="750ms">
        <a href="../oferta-educativa/ing-iff/">
          <img src="img/carreras/finaciera_fiscal.png" alt="">
          <h4>Ingeniería Financiera y Fiscal</h4>
        </a>
      </div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-4">
      <div class="cont-carreras wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="850ms" style="border: #bdb8b8 3px solid;">
        <a href="../oferta-educativa/ing-die/">
          <img src="img/carreras/Logo_IDIE_copia1_1.png" alt="Desarrollo de Negocios" style="width: 150px;">
          <h4 style="color: #737373;">Ingeniería en Desarrollo e Innovación Empresarial</h4>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="colo-direc">
</div>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>
<script>
  $("#mdVideo").on('hidden.bs.modal', function () { $("#divVideo").html(""); }); 
  function abrirMD(video) {
    $("#mdVideo").modal();
    $("#divVideo").html(video);
  }
</script>