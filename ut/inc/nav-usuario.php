
<script type="text/javascript" src="../inc/cambiarcontrasena/cambiarContrasena.js"></script>

<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    
    <li class="pull-right">
        <a style="cursor: pointer;"><?php echo $_SESSION['usuario_cargo'].": ".$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'];?><span class="fa fa-sort-down"></span></a>
        <ul>
            <li><a class="mb-control" onclick="javascript: $('#mdCambiarContrasena').modal();" style="cursor: pointer;" ><span class="fa fa-rotate-right"></span>Cambiar contraseña</a></li>
            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span>Cerrar Sesión</a></li>
        </ul>
        
    </li>
</ul>

<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> ¿ Finalizar <strong>Sesión</strong> ?</div>
            <div class="mb-content">
                <p>¿Seguro que desea finalizar la sesión?</p>
                <p>Pulse No si desea continuar trabajo. Pulse Sí para cerrar la sesión de usuario actual.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="../logout.php" class="btn btn-success btn-lg">Sí</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="mdCambiarContrasena" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frmCambiarContrasena" role="form" class="form-horizontal" action="javascript:cambiarContrasena();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cambiar Contraseña</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="alert alert-danger" id="artErrorContrasena" style="display: none;">
                                    <i class="glyphicon glyphicon-remove-circle"></i> <strong>¡Alerta!</strong> La contraseña no coincide, por favor vuelva a intentarlo.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-success" style="border-color:#59880b; display: none;  text-align: justify" id="artBienContrasena">
                                    <i class="fa fa-check-circle"></i> <strong>¡Bien!</strong> Contraseña cambiada. Se cerrar la sessión.
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">* Contraseña Actual:</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="Contrasena" id="tfContrasena" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">* Nueva Contraseña:</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="ContrasenaNueva" id="tfContrasenaNueva" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">* Confirmar Nueva Contraseña:</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="ConfirContrasenaNueva" id="tfConfirContrasenaNueva" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label class="col-md-1"></label>
                        <div class="col-md-10">
                            <div class="alert alert-info" style="background-color: rgba(217, 237, 247, 0.4); color: #29b2e1; display: inline-block; text-align: justify;" id="artCamposVacios">
                                <strong>
                                    <i class="fa fa-info-circle"></i> Todos lo campos con ( * ) son obligatorios.
                                    <br>
                                    <i class="fa fa-info-circle"></i> Al actualizar la contraseña la sesión se cerrar y tendra que iniciar nuevamente, para poder acceder.
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="artContrasenaActualizada" style="margin-bottom: 0px; display: none;">
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
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>
