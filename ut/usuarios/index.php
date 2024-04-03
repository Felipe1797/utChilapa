<?php 
    session_start();

    if ( $_SESSION['usuario_cargo'] == "Super Usuario" ) {
        //header("Location:../superusuario");
    } else if ( $_SESSION['usuario_cargo'] == "Administrador" ) {
        header("Location:../administrador");
    } else if ($_SESSION['usuario_cargo'] == "Servicios Escolares") {
        header("Location:../consultatitulo");
    } else {
        header("Location:../logout.php");
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

        <script type="text/javascript" src="usuarios.js"></script>
        <style type="text/css">
            @media (max-width:991px) { .quitarPadding {padding-left: 15px!important}}
        </style>
    </head>
    <body onload="cinicial('');">
        <div class="page-container">
            <?php
                $pageActive = "usuarios";
                require '../inc/nav-cargo.php';
            ?>
            <div class="page-content">
                <?php require '../inc/nav-usuario.php'; ?>
                <div class="page-content-wrap">
                    <br>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Usuarios</h3>
                                <button class="btn btn-default pull-right" onclick="nuevoUsuario();"><i class="fa fa-user"></i>Nuevo usuario</button>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div id="respuestaTabla">Lista de Usuarios</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="mdAgregar" class="modal fade" role="dialog" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmAgregar" role="form" class="form-horizontal" action="javascript:agregar();">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Agregar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body">                                    
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* Nombres:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="NombresAdd" id="tfNombresAdd" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* Apellidos:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="ApellidosAdd" id="tfApellidosAdd" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* Nombre de usuario:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="NombreUsuarioAdd" id="tfNombreUsuarioAdd" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* E-mail:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="EMailAdd" id="tfEMailAdd" onkeyup="javascript: this.value = this.value.toLowerCase();" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* Contraseña:</label>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="ContrasenaAdd" id="tfContrasenaAdd" value="12345678" />
                                        <span class="help-block">La contraseña por defecto es: 12345678</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* Cargo:</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="CargoAdd" id="slcCargoAdd" >
                                            <option value="">Seleccione una opción</option>
                                            <option value="Super Usuario">Super Usuario</option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Servicios Escolares">Servicios Escolares</option>
                                            <option value="Personal">Personal</option>
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
                            <h4 class="modal-title">Editar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body">                                    
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* Nombres:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="NombresEdit" id="tfNombresEdit" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* Apellidos:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="ApellidosEdit" id="tfApellidosEdit" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* Nombre de usuario:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="NombreUsuarioEdit" id="tfNombreUsuarioEdit" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">* E-mail:</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="EMailEdit" id="tfEMailEdit" onkeyup="javascript: this.value = this.value.toLowerCase();" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Contraseña:</label>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="ContrasenaEdit" id="tfContrasenaEdit" />
                                        <span class="help-block">La contraseña solo se modificara si escribe algo, en caso contrario no se modifica</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Activo:</label>
                                    <div class="col-md-7">
                                        <label class="check"><input type="checkbox" style="font-size: 34px;" name="ActivoEdit" id="chkActivoEdit" /> Activar</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Cargo:</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="CargoEdit" id="slcCargoEdit" >
                                            <option value="Super Usuario">Super Usuario</option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Servicios Escolares">Servicios Escolares</option>
                                            <option value="Personal">Personal</option>
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

        <div id="mdEditarAcceso" class="modal fade" role="dialog" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="frmEditarAcceso" role="form" class="form-horizontal" action="javascript:modificarAcceso();">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Permisos y acceso de los usuarios</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body">                                    
                                <p><strong>Active o desactive las cajas debajo para permitir el acceso o denegación a los módulos</strong></p>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Banner" id="chBanner" type="checkbox"><strong>&nbsp;Banner:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Avisos" id="chAvisos" type="checkbox"><strong>&nbsp;Avisos:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Notas" id="chNotas" type="checkbox"><strong>&nbsp;Noticias:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Calendario" id="chCalendarios" type="checkbox"><strong>&nbsp;Calendario escolar:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Becas" id="chBecas" type="checkbox"><strong>&nbsp;Becas:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Requisitos" id="chRequisitos" type="checkbox"><strong>&nbsp;Requisitos para titulación:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Documentos" id="chDocumentos" type="checkbox"><strong>&nbsp;Documentos para estadia:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Visitas" id="chVisitas" type="checkbox"><strong>&nbsp;Visitas industriales:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Seguimientos" id="chSeguimientos" type="checkbox"><strong>&nbsp;Seguimiento a egresados:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Movilidades" id="chMovilidades" type="checkbox"><strong>&nbsp;Movilidad:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Directorios" id="chDirectorios" type="checkbox"><strong>&nbsp;Directorio:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                    <li class="list-group-item">
                                        <label style="font-weight: normal; cursor: pointer;"><input name="Titulos" id="chTitulos" type="checkbox"><strong>&nbsp;Títulos:&nbsp;</strong><em>Agregar, Actualizar, Borrar y Buscar</em></label>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group" id="artEditadoAccesoExitoso" style="margin-bottom: 0px; display: none;">
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
                            <button type="submit" class="btn btn-success" id="btnAcepEditAcceso">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="mdErrorEliminar" class="modal fade" role="dialog" data-sound="fail">
            <div class="modal-dialog" style="width: 100%;top: 35%; padding: 0px; margin: 0px;">
              <div class="modal-content" style="border: 0px;">
                <div class="modal-header" style="background: rgba(182, 70, 69, 1); border-radius: 0px; border-bottom: 0px;">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <div style="min-height: 60px;">
                    <div class="form-group">
                        <br>
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <div style="font-size: 31px;  font-weight: 400; color: white; "><span class="fa fa-times" style="color: white;"></span> ¡Alerta!</div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-body" style="background: rgba(182, 70, 69, 1);">
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <p style="color: #FFF;">Usted no se puede elimiar a si mismo.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: rgba(182, 70, 69, 1); border-radius: 0px; border-top: 0px;">
                    <div class="form-group">
                        <div class="col-md-9">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
                                <button type="submit" class="btn btn-success" id="btnAcepDelet" onclick="confirEliminar();" style="border-color: #59880b;">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>