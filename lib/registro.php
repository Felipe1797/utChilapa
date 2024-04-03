<?php 

if($_POST){

	$output = [];
	require 'config.php';

	spl_autoload_register( function ($clase){
	    require_once  "$clase.php";
	});
	extract($_POST, EXTR_OVERWRITE);

	if($nombre && $apellidos && $email && $pass && $confirpass && $cargo && $tel){

		$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		$expreg = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

		if(preg_match($expreg, $email)){

			if(strlen($pass) > 6){

				$validarEmail = $db->validarDatos('email', 'usuarios', $email);
				
				if($validarEmail == 0){

	                switch ($sexo) {
	                	case 'hombre':
	                		$perfil = "img/users/default/hombre.png";
	                		break;
	                	case 'mujer':
	                		$perfil = "img/users/default/mujer.png";
	                		break;
	        			case 'otro':
	                		$perfil = "img/users/default/mujer.png";
	                		break;
	                	default:
	                		$perfil = "img/users/default/hombre.png";
	                		break;
	                }
	                $hasher = new PasswordHash(8, false);
	                $has = $hasher->HashPassword($pass);

	                if($db->preparar("INSERT INTO usuarios VALUES ( NULL, '$nombre', '$apellidos', '$email', '$has', '$perfil', '$tipou', '$cargo', '$sexo', '$tel')")){

	                	$db->ejecutar();
	                	$db->cerrar();

	                	$output = ["success" => true, "tipo" => "Usuario registrado"];
	                }
				}else{
					$output = ["error" => true, "tipoError" => "El email ya esta registrado, intente con otro"];
				}
			}else{
				$output = ["error" => true, "tipoError" => "La contrtaseña debe de ser mas de 6 caracteres"];
			}
		}else{
			$output = ["error" => true, "tipoError" => "Email no válido, porfavor ingrese uno válido"];
		}
	}
	$json = json_encode($output);
	echo $json;
}
?>