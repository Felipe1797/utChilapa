<!DOCTYPE html>
<html class="body-full-height">
<head>
	<title>UT Chilapa. Esta en mantenimiento</title>
	<link rel="icon" href="favicon2.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" id="theme" href="ut/css/theme-default.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>

	<div class="login-container">
        
            <div class="login-box animated fadeInDown">
                
                <img class="login-message" src="img/sliders/logos/utwhite1.png"  style="display: table; margin: 0 auto;" width="235">
                <br>
                <br>
                <div class="login-body">
                    <div class="login-title" style="text-align: justify;">
                    	<br>
                    	Bienvenido a la <strong>Unidad Académica en la Región de la Montaña,</strong> Estamos en el proceso de mantenimiento de la página.
                    	<br><br><strong>Por favor sea paciente y vuelva más tarde.</strong>
                    </div>
                </div>
                <div class="login-footer">
                    <?php
                    	session_start();

						if (isset($_SESSION['usuario_cargo'])) {
							header("Location:index2.php");
						}
                    ?>
                </div>
            </div>
        </div>
</body>
</html>