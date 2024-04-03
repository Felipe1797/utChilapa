<?php
    session_start();

    if ( $_SESSION['usuario_cargo'] == "Super Usuario" ) {
        //header("Location:../superusuario");
    } else if ( $_SESSION['usuario_cargo'] == "Administrador" ) {
        header("Location:../administrador");
    } else if ($_SESSION['usuario_cargo'] == "Servicios Escolares") {
        header("Location:../consultatitulo");
    } else if ($_SESSION['usuario_cargo'] == "Personal") {
        header("Location:../personal");
    } else {
        header("Location:../logout.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>UT Administración</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        
        <script type="text/javascript" src="superusuarios.js"></script>

    </head>
    <body onload="cinicial('');">
       <div class="page-container">
            <?php
                $pageActive = "superusuario";
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
                                <h5>Lista de Acciones en la página UT Chilapa. <i>Modificiones, Registros, Eliminaciones.</i></h5>
                                <br>
                                <div id="respuestaTabla"></div>
                                
                            </div>
                            <div class="panel-footer">
                                <div class='btn-toolbar'>
                                    <div class='btn-group pull-right'>
                                        <button class='btn btn-danger' onclick="eliminar();">Eliminar seleccionado(s)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="mdConfirEliminar" class="modal fade" role="dialog" data-sound="alert">
            <div class="modal-dialog" style="width: 100%;top: 35%; padding: 0px; margin: 0px;">
                <div class="modal-content" style="border: 0px;">
                    <div class="modal-header" style="background: rgba(254, 162, 35, 0.9); border-radius: 0px; border-bottom: 0px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div style="min-height: 60px;">
                            <div class="form-group">
                                <span class="xn-text"><br><label class="col-md-3 control-label"></label></span>
                                <div class="col-md-6">
                                    <div style="font-size: 31px;  font-weight: 400; color: white; "><span class="fa fa-times" style="color: white;"></span> ¡Alerta!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body" style="background: rgba(254, 162, 35, 0.9);">
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <p style="color: #FFF; font-size: 15px;">¿Esta deacuerdo con esta operación?.</p>
                            </div>
                        </div>
                    <div class="form-group" id="artEliminadoExitoso" style="margin-bottom: 0px; display: none;">
                        <div class="col-md-9 quitarPadding" style="padding-left: 26%; ">
                            <div class="alert alert-success" style="border-color:#59880b;">
                                <i class="fa fa-check-circle"></i><strong> Eliminado con exito.</strong>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer" style="background: rgba(254, 162, 35, 0.9); border-radius: 0px; border-top: 0px;">
                        <div class="form-group">
                            <div class="col-md-9">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-color: #000000;">Cancelar</button>
                                <button type="submit" class="btn btn-success" id="btnAcepDelet" onclick="delChoose();" style="border-color: #59880b;">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>