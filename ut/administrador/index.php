<?php 
    session_start();
    if ( $_SESSION['usuario_cargo'] == "Super Usuario" || $_SESSION['usuario_cargo'] == "Administrador" ) {
        //header("Location:../administrador");
    } else if ($_SESSION['usuario_cargo'] == "Servicios Escolares") {
        header("Location:../consultatitulo");
    } else {
        header("Location:../logout.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title>UT Administración</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" id="theme" href="../css/theme-default.css"/>

        <audio id="audio-alert" src="../audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="../audio/fail.mp3" preload="auto"></audio>
        
        <script type="text/javascript" src="../js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="../js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type='text/javascript' src='../js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="../js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="../js/plugins/knob/jquery.knob.min.js"></script>
        <script type="text/javascript" src="../js/plugins/owl/owl.carousel.min.js"></script>
        <script type="text/javascript" src="../js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="../js/settings.js"></script>
        <script type="text/javascript" src="../js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/plugins.js"></script>
        <script type="text/javascript" src="../js/actions.js"></script>

        <script type='text/javascript' src='../js/plugins/jquery-validation/jquery.validate.js'></script>
        <script type='text/javascript' src='../js/plugins/jquery-validation/localization/messages_es.js'></script>
        
    </head>
    <body>
       <div class="page-container">
            <?php
                $pageActive = "administrador";
                require '../inc/nav-cargo.php';
            ?>
            <div class="page-content">
                <?php require '../inc/nav-usuario.php'; ?>
                <div class="page-content-wrap">
                    <br>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Administración</h3>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="col-md-1"></div>
                                <div class="row">
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../banner">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="glyphicon glyphicon-th"></i></div>
                                          <div class="panel-footer">Banner</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../avisos">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-bell-o"></i></div>
                                          <div class="panel-footer">Avisos</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../notas">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-book"></i></div>
                                          <div class="panel-footer">Notas</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../calendarioescolar">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-calendar"></i></div>
                                          <div class="panel-footer">Calendario escolar</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../becasext">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-foursquare"></i></div>
                                          <div class="panel-footer">Becas</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../asignaturas">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-font"></i></div>
                                          <div class="panel-footer">Asignaturas</div>
                                        </div>
                                      </a>
                                    </div>
                                     <div class="col-md-2 col-lg-2">
                                      <a href="../carreras">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-graduation-cap"></i></div>
                                          <div class="panel-footer">Carreras</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../cuatrimestres">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-star"></i></div>
                                          <div class="panel-footer">Cuatrimestres</div>
                                        </div>
                                      </a>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="row">
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../requisitostitulacion">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-file-text-o"></i></div>
                                          <div class="panel-footer">Requisitos para titulación</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../estadia">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-files-o"></i></div>
                                          <div class="panel-footer">Documentos para estadia</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../visitasindustriales">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-plane"></i></div>
                                          <div class="panel-footer">Visitas Industriales</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../seguimientoaegresados">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="glyphicon glyphicon-transfer"></i></div>
                                          <div class="panel-footer">Seguimiento a egresados</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../movilidad">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="glyphicon glyphicon-share-alt"></i></div>
                                          <div class="panel-footer">Movilidad</div>
                                        </div>
                                      </a>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="row">
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../directorio">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-list-ol"></i></div>
                                          <div class="panel-footer">Directorio</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../universidad">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-university"></i></div>
                                          <div class="panel-footer">Nuestra Universidad</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../reglamentos">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-file-text"></i></div>
                                          <div class="panel-footer">Renglamentos</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../ofertaeducativa">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-pencil"></i></div>
                                          <div class="panel-footer">Oferta Educativa</div>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                      <a href="../ofertaeducativa">
                                        <div class="panel panel-default" style="text-align: center; text-decoration: none; color: black;">
                                          <div class="panel-body"><i style="font-size: 80px;" class="fa fa-paper-plane-o"></i></div>
                                          <div class="panel-footer">Estadia</div>
                                        </div>
                                      </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>