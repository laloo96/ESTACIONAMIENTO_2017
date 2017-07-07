<?php
session_start();	
require_once('../lib/nusoap.php');

$host = 'http://localhost:8080/TP_ESTACIONAMIENTO2017/php/loginWS.php';

$client = new nusoap_client($host . '?wsdl');

$err = $client->getError();

$respuestaWS = "error";

if ($err) {
	echo "error contructor WS.";
	die();
}
else{
	
	if ($_POST["op"] == "login") {	

		$letLogin = FALSE;
		
		$user = $_POST["usuario"]  ? $_POST["usuario"]  : NULL;
		$pass = $_POST["password"] ? $_POST["password"] : NULL;

		if (isset($user) && isset($pass)) {

			$respuestaLogin    = $client->call('LetLogin',array($user,$pass));
			$respuestaRegistro = $client->call('RegistrarLogin',array($user));

			//0 refiere a error.
			if ($respuestaLogin !== 0 && $respuestaRegistro == "ok") {
				
				//Si es igual a 1 es porque es usuario si es 2 es admin.
				if ($respuestaLogin == 1) {
					$_SESSION["user"] = $user;	
				}
				else
					$_SESSION["admin"] = $user;	
				
				$respuestaWS = "ok";	
			}
		}

	}
	else
	{	
		session_unset();	
		session_destroy();

		$respuestaWS = "ok";
	}

	if ($client->fault) {
		print_r($respuestaWS);
	} 

	$err = $client->getError();
	
	if ($err) {
		print_r($err);
	} 
	else {
		print_r($respuestaWS);
	}

}

?>