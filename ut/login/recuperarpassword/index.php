<?php 
    session_start();
    if (isset($_SESSION['usuario_cargo'])) {
        if ( $_SESSION['usuario_cargo'] == "Super Usuario" ) {
            header("Location:../../superusuario");
        } else if ( $_SESSION['usuario_cargo'] == "Administrador" ) {
            header("Location:../../administrador");
        } else if ($_SESSION['usuario_cargo'] == "Servicios Escolares") {
            header("Location:../serviciosescolares");
        } else {
            header("Location:../../logout.php");
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
        
        <link rel="icon" href="../../img/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" id="theme" href="../../css/theme-default.css"/>

        <script type="text/javascript" src="../../js/plugins/jquery/jquery.min.js"></script>
        <script src="recuperarPass.js"> </script>

    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-message"><i><strong>UT</strong> Administración</i></div>
                <br>
                <br>
                <div class="login-body">
                    <div class="login-title"><strong>Restablecer tu contraseña</strong></div>
                    <!--<form action="index.html" class="form-horizontal" method="post">-->
                    <div style="color: white; text-align: justify;">
                        UT Administración te enviará un correo electronico, a tu dirección de correro electronico con tu nueva contraseña.
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <br>
                            <div class="alert alert-info" style="background-color: #29b2e1; display: none;" id="artVerificar">
                               <i class="glyphicon glyphicon-info-sign"></i> <strong>¡Verificando!</strong> ...
                            </div>
                            <div class="alert alert-success" style="border-color:#59880b; display: none;  text-align: justify" id="artDatosBien">
                                <i class="fa fa-check-circle"></i> <strong>¡Bien!</strong> Contraseña enviada. Comprueba tu búzon de correo electronico. Una vez recibido el correo procede a logearte con tu email y nueva contraseña.
                            </div>
                            <div class="alert alert-warning" style="background-color: #fe9e19; display: none;" id="artFaltanDatos">
                                <i class="glyphicon glyphicon-warning-sign"></i> <strong>¡Alerta!</strong> Debe llenar todos los campos.
                            </div>
                            <div class="alert alert-danger" id="artNoExiste" style="display: none;">
                                <i class="glyphicon glyphicon-remove-circle"></i> <strong>¡Alerta!</strong> El correo electronico no existe o esta mal escrito.
                            </div>
                            <div class="alert alert-danger" id="artErrorEMail" style="display: none;">
                                <i class="glyphicon glyphicon-remove-circle"></i> <strong>¡Alerta!</strong> Error al enviar el correo diríjase con el administrador.
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="frmgrpCambioBien">
                        <div class="col-md-12">
                            <input type="email" class="form-control" placeholder="EMail" id="tfEMail" onkeyup="inputsVacios();" />
                            <br>
                        </div>
                    </div>
                    <div class="form-group" id="frmgrpCambioPassBien">
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block" onclick="recuperarPass();">Aceptar</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-danger btn-block" onclick="cancelar();">Cancelar</button>
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