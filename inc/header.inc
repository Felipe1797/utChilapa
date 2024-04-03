<?php
    $conx = $_SERVER["DOCUMENT_ROOT"].'/ut/conexion/conexion.php';
    require $_SERVER["DOCUMENT_ROOT"].'/ut/principal/modelPrincipal.php';
    $principal = new modelPrincipal;
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <meta name="author" content="" />
    <title><?php echo $titulo; ?></title>
    <link rel="shortcut icon" href="/favicon2.ico"  />
    <link rel="stylesheet" href="/css/menu.css" />
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/css/fonts2.css" />
    <link rel="stylesheet" href="/css/estilos.css" />
    <link rel="stylesheet" href="/css/responsiveslides.css" />
    <link rel="stylesheet" href="/css/animate.css" />
    <link rel="stylesheet" href="/css/slick.css" />
    <link rel="stylesheet" href="/css/swipebox.css" />
    <link rel="stylesheet" href="/css/Newanimaciones.css" />
    
    <link rel="stylesheet" type="text/css" id="theme" href="/ut/css/custom.css"/>

    <script src="/js/jquery-2.2.4.min.js"></script>
    

</head>
<body>