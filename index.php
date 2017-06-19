<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
include_once '/clases/Vehiculo.php';
include_once '/php/AccesoDatos.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\app(["settings" => $config]);

session_start();


$app->get('/damealgo', function($request,$response)
{
    return "tedoyalgo";
});

$app->get('/', function ($request,$response) {
    return $response->withRedirect("./principal.html");
});

/*
*   Ingresa un auto a la cochera.
*/
$app->POST('/POST/ingresarAuto', function($request,$response)  {

    $patente = $_POST["patente"] ?: NULL;
    $color   = $_POST["color"]   ?: NULL;
    $marca   = $_POST["marca"]   ?: NULL;

    if (isset($patente) && isset($color) && isset($marca)) {
        
        $conexion = AccesoDatos::dameUnObjetoAcceso();
        $statement = $conexion->RetornarConsulta("INSERT INTO cocheralive (`patente`, `color`, `marca`, `entrada`) VALUES (?,?,?,NOW())");

        $statement->bindParam(1,$patente);
        $statement->bindParam(2,$color);
        $statement->bindParam(3,$marca);
 
        if ($statement->execute()) {
            echo "ok";
        }
        else
            echo "error";
    }
    else
        echo "error";

});


/*                       FUNCIONANDO!!!
* Retorna JSON con tabla de autos estacionados en este momento.
*/ 
$app->get('/get/autosLive', function(Request $request, Response $response){

    $autoslive = Vehiculo::TraerTodos();
    // Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
    $response->getBody()->write(json_encode($autoslive));
});

/*
*   Remuve un auto de acuerdo al id pasado.
*/
$app->delete('/auto/{id}', function(Request $request, Response $response, $args){

        $id = $args['id'];
        $respuesta = "errorenapi";

        if (isset($id)) {
             $respuesta = Vehiculo::DameUnAuto($id);
        }

        $response->getBody()->write("pepe piola");
});

$app->run();