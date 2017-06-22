<?php

require_once('../nusoap-0.9.5/lib/nusoap.php');

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

			$respuestaWS = $client->call('LetLogin',array($user,$pass));				
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