<?php 
session_start();
$caduca = time () - 95369;
if(isset($_COOKIE['nombre'])){
    setcookie('id', $_SESSION['id'], $caduca);
    setcookie('nombre', $_SESSION['nombre'], $caduca);
}
session_unset();
session_destroy();
?>