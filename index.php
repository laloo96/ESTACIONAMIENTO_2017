<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require_once __DIR__ . '\clases\Vehiculo.php';
require_once __DIR__ . '\clases\Empleado.php';
//require_once __DIR__ . '\clases\Estacionamiento.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers-Allow-Origin: X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,UPDATE,OPTIONS");
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

/*                       POR AHORA NO SE COMO SALIR DE AJAX.
* Calcula el importe.
*/ /*
$app->get('/calcularimporte', function(Request$request, Response$response){

        $horas    =  $_GET['horas']   ?: NULL;
        $minutos  =  $_GET['minutos'] ?: NULL;

        echo(Estacionamiento::CalcularImporte($horas,$minutos));
         
});*/

/*
*   Remuve un auto de acuerdo al id pasado.
*/
$app->delete('/egresar/{id}', function(Request $request, Response $response){
        
        $respuesta = "error";     
        $id = $request->getAttribute('id');

        
        if (isset($id)) {
             if (Vehiculo::EgresarAuto($id)) {
                 $respuesta = "ok";
             }
        }

         $response->getBody()->write(json_encode($respuesta));
});

/*
*   Agrega un nuevo empleado.
*/
$app->post('/nuevoempleado',function(Request $request, Response $response){
        
        $nuevoempleado = $request->getParsedBody();

        $respuesta = "error";     
             
        if (isset($nuevoempleado)) {
             
             if (Empleado::NuevoEmpleado($nuevoempleado)) {
                 $respuesta = "ok";
             }
        }

        $response->getBody()->write(json_encode($respuesta));
});

/*
*   Agrega un nuevo empleado.
*//*
$app->post('/nuevoempleado',function(Request $request, Response $response){
        
        $nuevoempleado = $request->getParsedBody();

        $respuesta = "error";     
             
        if (isset($nuevoempleado)) {
             
             if (Empleado::NuevoEmpleado($nuevoempleado)) {
                 $respuesta = "ok";
             }
        }

        $response->getBody()->write(json_encode($respuesta));
});*/

/*
*   Remuve un auto de acuerdo al id pasado.
*/
$app->get('/dameXempleado', function(Request $request, Response $response){
        
        $respuesta = "error";     
        $nombre   = $_GET['nombre'];
        $apellido = $_GET['apellido'];
      
        if (isset($nombre) && isset($apellido)) {
            $response->getBody()->write(json_encode(Empleado::DameEsteEmpleado($nombre,$apellido)));
        }
});

/*
*
*/
$app->get('/traertodoslosempleados', function(Request $request, Response $response){

    $response->getBody()->write(json_encode(Empleado::TraerToodosLosEmpleados()));
        
});

$app->put('/actualizarestado', function(Request $request, Response $response){
   
        $usuario = $_GET['usuario'];
        $estado  = $_GET['estado'];
        
        if (isset($usuario) && isset($estado)) {
            $response->getBody()->write(json_encode(Empleado::ActualizarEstado($usuario,$estado)));
        }
});

$app->delete('/eliminarempleado', function(Request $request, Response $response){
   
        $nombre    = $_GET['nombre'];
        $apellido  = $_GET['apellido'];
        
        if (isset($nombre) && isset($apellido)) {
            $response->getBody()->write(json_encode(Empleado::EliminarEmpleado($nombre,$apellido)));
        }
});




$app->run();

?>