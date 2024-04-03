<?php 
    session_start();
    if (isset($_SESSION['usuario_cargo'])) {
        if ( $_SESSION['usuario_cargo'] == "Super Usuario" ) {
            header("Location:../superusuario");
        } else if ( $_SESSION['usuario_cargo'] == "Administrador" ) {
            header("Location:../administrador");
        } else if ($_SESSION['usuario_cargo'] == "Servicios Escolares") {
            header("Location:../consultatitulo");
        } else {
            header("Location:../logout.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="es-MX" class="body-full-height">
    <head>        
        <title>UT Administración</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" id="theme" href="../css/theme-default.css"/>

        <script type="text/javascript" src="../js/plugins/jquery/jquery.min.js"></script>
        <script src="login.js"> </script>

    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-message"><i><strong>UT</strong> Administración</i></div>
                <br>
                <br>
                <div class="login-body">
                    <div class="login-title"><strong>Iniciar Sesión</strong></div>
                    <!--<form action="index.html" class="form-horizontal" method="post">-->

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="alert alert-info" style="background-color: #29b2e1; display: none;" id="artVerificar">
                               <i class="glyphicon glyphicon-info-sign"></i> <strong>¡Verificando!</strong> ...
                            </div>
                            <div class="alert alert-warning" style="background-color: #fe9e19; display: none;" id="artFaltanDatos">
                                <i class="glyphicon glyphicon-warning-sign"></i> <strong>¡Alerta!</strong> Debe llenar todos los campos.
                            </div>
                            <div class="alert alert-danger" id="artDatosIncorectros" style="display: none;">
                                <i class="glyphicon glyphicon-remove-circle"></i> <strong>¡Alerta!</strong> El nombre de usuario y/o contraseña son incorectos o usuario no esta activado.
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Nombre de usuario o EMail" id="tfNombreUsuario" />
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Contraseña" id="tfContrasena" />
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block" onclick="iniciarSesion();">Iniciar sesión</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-danger btn-block" onclick="cancelar();">Cancelar</button>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="pull-right">
                                <a href="recuperarpassword" class="btn btn-link btn-block">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                    </div>
                    <!--</form>-->
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>