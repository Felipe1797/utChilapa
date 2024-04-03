<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_utchilapa = "localhost";
$database_utchilapa = "utchilap_titulados";
$username_utchilapa = "utchilap_admon";
$password_utchilapa = "Ventanilla10";
$utchilapa = mysql_pconnect($hostname_utchilapa, $username_utchilapa, $password_utchilapa) or trigger_error(mysql_error(),E_USER_ERROR); 
?>