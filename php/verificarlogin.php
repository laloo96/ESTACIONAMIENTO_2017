<?php

require_once('AccesoDatos.php');

if ($_POST["op"] == "login") {	

	$letLogin = FALSE;
	
	$user = $_POST["usuario"] ? $_POST["usuario"] : NULL;
	$pass = $_POST["password"] ? $_POST["password"] : NULL;

	if (isset($user) && isset($pass)) {

		$conexion = AccesoDatos::dameUnObjetoAcceso();
	    $statement = $conexion->RetornarConsulta("SELECT * FROM `usuarios` WHERE 1");

		if ($statement->execute()) {	

			$data = $statement->fetchall();

			foreach ($data as $value) {		
				
				if ($value["usuario"] == $user && $value["password"] == $pass) {
					$letLogin = TRUE;
					break;
				}
			}

			if($letLogin === TRUE){
				
				session_start();			
				$_SESSION["user"] = $user;
				
				echo "ok";
			}
			else{
				echo "error";
			}
		}
		else{	
			echo "error";
		}

	}	
	
}
else if($_POST["op"] == "logout")
{	
	session_start();
	
	$_SESSION["user"] = NULL;

	session_destroy();

	echo "ok";
}


/*
require_once('AccesoDatos.php');
require_once('../nusoap-0.9.5/lib/nusoap.php'); 

$server = new nusoap_server();

$server->configureWSDL('login service', 'urn:verificarLogin');


$server->register('Sumar',                								// METODO
				array('usuario' => 'xsd:string','password' => 'xsd:string'),  		// PARAMETROS D ENTRADA
				array('return' => 'xsd:bool'),    							// PARAMETROS DE SALIDA
				'urn:verificarLogin',                								// NAMESPACE
				'urn:verificarLogin#LetLogin',               							// ACCION SOAP
				'rpc',                        								// ESTILO
				'encoded',                    								// CODIFICADO
				'deja logear si el usuario esta registrado'    										// DOCUMENTACION
				);


public function LetLogin($usuario,$contraseña)
{
	if(Usuario::ExisteUsuario($usuario,$contaseña) === TRUE){


			session_start();			
			$_SESSION["user"] = $user;		
			echo "ok";
		}
		else
			echo "error";
		
	}		
}





*/



?>