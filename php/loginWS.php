<?php 

require_once('../nusoap-0.9.5/lib/nusoap.php'); 
require_once('../clases/Usuario.php');
require_once('../php/AccesoDatos.php');

$server = new nusoap_server();

$server->configureWSDL('login service', 'urn:verificarLogin');


$server->register('LetLogin',                									// METODO
				array('usuario' => 'xsd:string','password' => 'xsd:string'),  	// PARAMETROS D ENTRADA
				array('return' => 'xsd:string'),    							 // PARAMETROS DE SALIDA
				'urn:verificarLogin',                							// NAMESPACE
				'urn:verificarLogin#LetLogin',               					// ACCION SOAP
				'rpc',                        								    // ESTILO
				'encoded',                    								    // CODIFICADO
				'deja logear si el usuario esta registrado'    					// DOCUMENTACION
				);


function LetLogin($usuario,$password)
{	
	$retorno = "errorenWS";

	if(Usuario::ExisteUsuario($usuario,$password) === TRUE){

			session_start();			
			$_SESSION["user"] = $usuario;		
			$retorno =  "ok";
	}

	return $retorno;	
}

$HTTP_RAW_POST_DATA = file_get_contents("php://input");
		
$server->service($HTTP_RAW_POST_DATA);

?>