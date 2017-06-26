<?php

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
			
			if ($respuestaLogin == "ok" && $respuestaRegistro == "ok") {
				
				session_start();						
				$_SESSION["user"] = $user;	
				$respuestaWS = "ok";	
			}
		}

	}
	else if($_POST["op"] == "logout")
	{	
		
		session_start();		
		$_SESSION["user"] = NULL;
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