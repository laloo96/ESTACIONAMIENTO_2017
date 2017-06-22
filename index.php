<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require_once __DIR__ . '\clases\Vehiculo.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers-Allow-Origin: X-Requested-With, Content-Type, Accept");
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\app(["settings" => $config]);

session_start();


$app->get('/', function (Request $request,Response $response) {
    return $response->withRedirect("/miPagina.html");
});

/*
*   Ingresa un auto a la cochera.
*/
$app->POST('/ingresarAuto', function(Request $request, Response $response)  {

    $autoIngresando = $request->getParsedBody();

    if (isset($autoIngresando)) {
        $respuesta = Vehiculo::IngresarAuto($autoIngresando);
    }
    else
        $respuesta =  "error";

    echo $respuesta;    
});


/*                       FUNCIONANDO!!!
* Retorna JSON con tabla de autos estacionados en este momento.
*/ 
$app->get('/autosLive', function(Request$request, Response$response){

    $autoslive = Vehiculo::TraerTodos();
    
    $response->getBody()->write(json_encode($autoslive));
});

/*
*   Remuve un auto de acuerdo al id pasado.
*/
$app->delete('/egresar/{id}', function(Request $request, Response $response){
        
        $respuesta = "errorenapi";      
        $id = $request->getAttribute('id');
       
        if (isset($id)) {
             $respuesta = Vehiculo::EgresarAuto($id);
        }

        $response->getBody()->write($respuesta);
});

$app->run();

?>