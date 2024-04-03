<?php 
session_start();
if($_POST){
    
	$output = [];
    require 'config.php';

    spl_autoload_register( function ($clase){
        require_once "$clase.php";
    });
    extract($_POST, EXTR_OVERWRITE);

    if(empty($email) and empty($pass)){

    	$output = ["error" => true, "tipoError" => "Los campos no pueden estar vacios"];
    }

    if($email && $pass){

    	$db = new database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    	$validarEmail = $db->validarDatos('email', 'usuarios', $email);

		$expreg = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		if(preg_match($expreg, $email)){

			if ($validarEmail != 0){
				$db->preparar("SELECT id, CONCAT(nombre,' ',apellidos) AS nombrecompleto, email, pass FROM usuarios WHERE email = '$email'");
				$db->ejecutar();
                $db->prep()->bind_result($dbid, $dbnombrecompleto, $dbemail, $dbpass);
                $db->resultado();

                if($email == $dbemail){

                	$hasher = new PasswordHash(8, false);

                	if($hasher->CheckPassword($pass, $dbpass)){

                		$_SESSION['id'] = $dbid;
                        $_SESSION['nombre'] = $dbnombrecompleto;
                        $caduca = time()+360*24*60;
                        extract($_POST, EXTR_OVERWRITE);
                        $recordar = null;
                        if($recordar == 'activo'){
                            setcookie('id', $_SESSION['id'], $caduca);
                            setcookie('nombre', $_SESSION['nombre'], $caduca);
                        }
                        $db->cerrar();
                	}else{
                		$output = ["error" => true, "tipoError" => "La contraseña o el email no son válidos, intente de nuevo"];
                	}
                }
			}else{
				$output = ["error" => true, "tipoError" => "La contraseña o el email no son válidos, intente de nuevo"];
			}
		}else{
			$output = ["error" => true, "tipoError" => "Email no válido, ingrese un email válido"];
		}
    }
    $json = json_encode($output);
    echo $json;
}
?>