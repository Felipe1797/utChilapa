<?php if($pagina == 'inicio') : ?>
    <div class="modal fade" tabindex="-1" role="modal" aria-labelledby="gridSystemModalLabel" id="info-m">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title text-center" id="gridSystemModalLabel">!Aviso!!!</h3>
          </div>
          <div class="modal-body">
           <div class="col-md-4 col-center">
               <img src="/img/avisos/ceneval.png" class="img-responsive" alt="Ceneval" />
           </div>
            <div class="col-md-11 col-center">
               <h4 class="text-center">El examen (CENEVAL) de diagnóstico será el 24 de agosto del año en curso.</h4>
               <h3 class="text-center">!Inscríbete ya!!!</h3>
               <hr />
                <h5>Lleva lo siguiente:</h5>
               <ul>
                   <li>Lapíz del número 3 ó 2<code>1/2</code></li>
                   <li>Sacapuntas</li>
                   <li>Borrador</li>
                   <li>Bolígrafo</li>
               </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php endif; ?>



    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title text-center" id="gridSystemModalLabel">Buzón de quejas</h3>
          </div>
          <div class="modal-body">
            <form action="" method="POST" role="form">
                <h4>Queremos saber tu opinion</h4>
                <div class="formulario-group">
                    <input type="text" required="required" />
                    <label for="input" class="control-label">Nombre <span class="impor-rojo">*</span></label><i class="bar"></i>
                </div>
                <div class="formulario-group">
                    <input type="text" required="required" />
                    <label for="input" class="control-label">Apellidos <span class="impor-rojo">*</span></label><i class="bar"></i>
                </div>
                <div class="formulario-group">
                    <input type="text" placeholder="Teléfono" />
                    <label for="input" class="control-label">Teléfono</label><i class="bar"></i>
                </div>
                <div class="formulario-group">
                    <input type="email" required="required" />
                    <label for="input" class="control-label">E-mail <span class="impor-rojo">*</span></label><i class="bar"></i>
                </div>
                <div class="formulario-group">
                    <textarea required="required" /></textarea>
                    <label for="textarea" class="control-label">Mensaje <span class="impor-rojo">*</span></label><i class="bar"></i>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn-m"><span>Enviar</span></button>
                </div>
            </form>
            
            <div class="alert alert-warning" role="alert">Nota: todos los campos marcados con (<span class="impor-rojo">*</span>) son obligatorios</div>
            </div>
        </div>
      </div>
    </div>
    <span id="top-link-block" class="hidden">
        <a href="#top" class="top-btn"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
            <i class="glyphicon glyphicon-chevron-up"></i>
        </a>
    </span>
    <footer class="footer-ut">
      <div class="container">
        <div class="row">
          <div class="col-md-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
            <h2>Contáctanos</h2>
            <div class="direciones">
              <p><span class="s-footer">Dirección:</span> Carretera Chilapa-Zitlala desviación a Tecoyutla S/N, Chilapa de Álvarez</p>
              <?php if($pagina != 'directorio') : ?>
                <p><span class="s-footer">Teléfono:</span> 7561040944 y 7561040945</p>
              <?php endif; ?>
              <p><span class="s-footer">E-mail:</span> buzon_uarm@utrng.edu.mx</p>
            </div>
          </div>
          <div class="col-md-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
            <h2 class="text-center">Síguenos</h2>
            <div class="redes-sociales jo">
              <a href="https://www.facebook.com/se.uarm" target="_blank" class="icon-hv icon-facebook" data-tooltipp="tooltip" data-placement="top" title="Facebook"></a>
              <a href="https://twitter.com/ut_chilapa" target="_blank" class="icon-hv icon-twitter" data-tooltipp="tooltip" data-placement="top" title="Twitter"></a>
              <a href="http://www.youtube.com/channel/UC2tS2jqRAyPKTNoGNZ9nQ8w/videos" target="_blank" class="icon-hv icon-youtube" data-tooltipp="tooltip" data-placement="top" title="Youtube"></a>
              <a href="#" class="icon-hv icon-mail" data-tooltipp="tooltip" data-toggle="modal" data-placement="top" title="Buzón de quejas" data-target=".bs-example-modal-lg"></a>
            </div>
          </div>
          <div class="col-md-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
            <h3 class="text-center">Unidad Académica en la Región de la Montaña</h3>
            <div class="row">
              <div class="col-center">
                <img src="/img/sliders/logos/logowhite.png" alt="UT chilapa logo" />
                <img src="/img/footer/ISO90012015.png" alt="UT Iso" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="fds text-center wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="300ms"><p>Derechos reservados &copy; UT Chilapa</p></div>

      <div class="modal fade" tabindex="-1" role="modal" aria-labelledby="gridSystemModalLabel" id="mdVideo">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <div id="divVideo"></div>
            </div>
          </div>
        </div>
      </div>
   </footer>
   <script src="/js/jquery-2.2.4.min.js"></script>
   <script src="/js/bootstrap.min.js"></script>
   <script src="/js/jquery.swipebox.js"></script>
   <script src="/js/wow.min.js"></script>
   <script src="/js/jquery.stellar.js"></script>
<?php if($pagina == 'inicio') : ?>
   <script src="/js/responsiveslides.min.js"></script>
   <script src="/js/slick.min.js"></script>
   <script type="application/javascript">
       $(document).ready(function(){
        $("#slider2").responsiveSlides({
          auto: true,
          pager: true,
          nav: true,
          speed: 900,
          namespace: "centered-btns"
        });

        $(".carrusel-noti").slick({
          dots: true,
          infinite: true,
          autoplay: true,
          autoplaySpeed: 3000,
          pauseOnHover: true,
          centerMode: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          fade: true,
          cssEase: 'linear',
          responsive: [{
            breakpoint: 768,
            settings: {
              arrows: false,
              slidesToShow: 1,
              autoplaySpeed: 5000,
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              slidesToShow: 1,
              autoplaySpeed: 5000
            }
          }]
        });
        //$('#info-m').modal('show');
    });
   </script>
    <?php 
        $principal->consultaavisos();
    ?>
<?php endif; ?>
  <script src="/js/ut.js"></script>
  <script src="/ut/js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src='/ut/js/plugins/jquery-validation/jquery.validate.js'></script>
  <script src='/ut/js/plugins/jquery-validation/localization/messages_es.js'></script>
</body>
</html>