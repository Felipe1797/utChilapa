<?php

spl_autoload_register( function ($clase){
                    require_once "lib/$clase.php";
                });

$hasher = new PasswordHash(8, false);

$pass = '123456Y';
$has = $hasher->HashPassword($pass);

echo "este es:  $has";

?>