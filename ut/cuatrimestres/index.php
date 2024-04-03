<?php 
    session_start();

    if ( $_SESSION['usuario_cargo'] == "Super Usuario" || $_SESSION['usuario_cargo'] == "Administrador" || ($_SESSION['usuario_cargo'] == "Personal" && $_SESSION['usuario_accesos'][7]==1)) {
        //header("Location:../administrador");
    } else if ($_SESSION['usuario_cargo'] == "Servicios Escolares") {
        header("Location:../consultatitulo");
    } else {
        if (in_array("1", $_SESSION['usuario_accesos'])) {
            header("Location:../personal");
        } else {
            header("Location:../logout.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="es-MX">
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

        <script type="text/javascript" src="../js/plugins/fileinput/fileinput.js"></script>
        <script type="text/javascript" src="../js/plugins/fileinput/locales/es.js"></script>

        <script type="text/javascript" src="cuatrimestres.js"></script>
        <style type="text/css">
            @media (max-width:991px) { .quitarPadding {padding-left: 15px!important}}
            .img-file-preview {
                border-radius: 0px;
                border: 1px solid #ddd;
                padding: 5px;
                width: 100%;
                margin-bottom: 5px;
                overflow-x: auto;
            }
            .img-file-preview-frame {
                display: table;
                margin: 10px;
                height: 160px;
                border: 1px solid #d5d5d5;
                box-shadow: 0px 1px 1px 0 rgba(0, 0, 0, 0.1);
                padding: 3px;
                float: left;
                text-align: center;
            }
            .img-file-preview-frame:hover { background-color: #F5F5F5; }

        </style>
    </head>
    <body onload="cinicial('');">
        <div class="page-container">
            <?php
                $pageActive = "cuatrimestres";
                require '../inc/nav-cargo.php';
            ?>
            <div class="page-content">
                <?php require '../inc/nav-usuario.php'; ?>
                <div class="page-content-wrap">
                    <br>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Cuatrimestres</h3>
                                <button class="btn btn-default pull-right" onclick="nuevo();"><i class="fa fa-star"></i>Agregar Cuatrimestre</button>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div id="respuestaTabla">Listado</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="mdAgregar" class="modal fade" role="dialog" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmAgregar" role="form" class="form-horizontal" action="javascript:agregar();" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Agregar Cuatrimestre</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body">

                                 <div class="form-group">
                                    <label class="col-md-3 control-label">* Cuatrimestre:</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="CuatrimestreAdd" id="tfCuatrimestreAdd">
                                            <option value="">Seleccione una opción</option>
                                            <option value="1° Cuatrimestre">1° Cuatrimestre</option>
                                            <option value="2° Cuatrimestre">2° Cuatrimestre</option>
                                            <option value="3° Cuatrimestre">3° Cuatrimestre</option>
                                            <option value="4° Cuatrimestre">4° Cuatrimestre</option>
                                            <option value="5° Cuatrimestre">5° Cuatrimestre</option>
                                            <option value="6° Cuatrimestre">6° Cuatrimestre</option>
                                            <option value="7° Cuatrimestre">7° Cuatrimestre</option>
                                            <option value="8° Cuatrimestre">8° Cuatrimestre</option>
                                            <option value="9° Cuatrimestre">9° Cuatrimestre</option>
                                            <option value="10° Cuatrimestre">10° Cuatrimestre</option>
                                            <option value="11° Cuatrimestre">11° Cuatrimestre</option>
                                            <option value="12° Cuatrimestre">12° Cuatrimestre</option>
                                            <option value="13° Cuatrimestre">13° Cuatrimestre</option>
                                            <option value="14° Cuatrimestre">14° Cuatrimestre</option>
                                            
                                        </select>
                                        <span class="form-control-feedback"><i class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </div>
                                </div>
                                <?php
                            	  $mysqli = new mysqli('localhost', 'root', '', 'comparacion');
                        	    ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">* IdCarrera:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="IdCarrreraAdd" id="tfIdCarreraAdd">
                                                <option value="">Seleccione una opción</option>
                                                <?php
                            			          $query = $mysqli -> query ("SELECT * FROM CARRERAS");
                            			          while ($valores = mysqli_fetch_array($query)) {
                            			            echo '<option value="'.$valores[Id].'">'.$valores[Id].'  -  '.$valores[Nombre].'</option>';
                            			          }
                            			        ?>
                                            </select>
                                            <span class="form-control-feedback"><i class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                 	</div>
                                 </div>
                               
                            </div>
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label class="col-md-1"></label>
                                <div class="col-md-10">
                                    <div class="alert alert-info" style="background-color: rgba(217, 237, 247, 0.4); color: #29b2e1; display: inline-block;" id="artCamposVacios">
                                       <i class="fa fa-info-circle"></i><strong> Todos lo campos con ( * ) son obligatorios.</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="artAgregadoExitoso" style="margin-bottom: 0px; display: none;">
                                <label class="col-md-1"></label>
                                <div class="col-md-10">
                                    <div class="alert alert-success">
                                       <i class="fa fa-check-circle"></i><strong> Agregado con exito.</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success" id="btnAcepAdd">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="mdEditar" class="modal fade" role="dialog" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmEditar" role="form" class="form-horizontal" action="javascript:modificar();">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Editar Cuatrimestre</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body">                                    
                                <div class="form-group">
                                    <label class="col-md-3 control-label">* Cuatrimestre:</label>
                                    <div class="col-md-8">
                                        <input type="hidden" class="form-control" name="IdEdit" id="tfIdEdit" />
                                        <input type="text" class="form-control" name="CuatrimestreEdit" id="tfCuatrimestreEdit" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">* IdCarrera:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="IdCarrreraEdit" id="tfIdCarreraEdit">
                                                <option value="">Seleccione una opción</option>
                                                <?php
                            			          $query = $mysqli -> query ("SELECT * FROM CARRERAS");
                            			          while ($valores = mysqli_fetch_array($query)) {
                            			            echo '<option value="'.$valores[Id].'">'.$valores[Id].'  -  '.$valores[Nombre].'</option>';
                            			          }
                            			        ?>
                                            </select>
                                            <span class="form-control-feedback"><i class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                 	</div>
                                 </div>
                                
                                
                            </div>
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label class="col-md-1"></label>
                                <div class="col-md-10">
                                    <div class="alert alert-info" style="background-color: rgba(217, 237, 247, 0.4); color: #29b2e1; display: inline-block;" id="artCamposVacios">
                                       <i class="fa fa-info-circle"></i><strong> Todos lo campos con ( * ) son obligatorios.</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="artEditadoExitoso" style="margin-bottom: 0px; display: none;">
                                <label class="col-md-1"></label>
                                <div class="col-md-10">
                                    <div class="alert alert-success">
                                       <i class="fa fa-check-circle"></i><strong> Editado con exito.</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success" id="btnAcepEdit">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="mdVerImg" class="file-zoom-dialog modal fade" tabindex="-1" aria-labelledby="kvFileinputModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="kv-zoom-actions pull-right">
                            <button type="button" class="btn btn-default btn-close" title="Cerrar vista detallada" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></button>
                        </div>
                        <h3 class="modal-title">Vista detallada</h3>
                    </div>
                    <div class="modal-body">
                        <div class="floating-buttons"></div>
                        <div class="kv-zoom-body file-zoom-content">
                            <img id="imgDetail" class="file-preview-image kv-preview-data file-zoom-detail" style="width: auto; height: auto; max-width: 100%; max-height: 100%;">
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
                                <button type="submit" class="btn btn-success" id="btnAcepDelet" onclick="confirEliminar();" style="border-color: #59880b;">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>