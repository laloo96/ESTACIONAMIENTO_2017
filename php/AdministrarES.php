<?php
require_once("AccesoDatos.php");

header("Access-Control-Allow-Origin: *");

require_once "../vendor/autoload.php";

$app = new \Slim\Slim();

session_start();

/*
*   Ingresa un auto a la cochera.
*/
$app->POST('/ingresarAuto', function() use($app) {

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


/*
* Retorna JSON con tabla de autos estacionados en este momento.
*/ 
$app->GET('/autosLive', function() use($app) {

    $conexion = AccesoDatos::dameUnObjetoAcceso();
    $statement = $conexion->RetornarConsulta("SELECT * FROM cocheralive WHERE 1");
    
    if($statement->execute()){       
        
        $autosLive = $statement->fetchall();
    }
    // Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($autosLive));
});

/*
*   Remuve un auto de acuerdo al id pasado.
*/
$app->DELETE('/retirarAuto', function($id) use($app) {
        
    if (isset($id)) {
       
        $conexion = AccesoDatos::dameUnObjetoAcceso();
        $statement = $conexion->RetornarConsulta("DELETE FROM cocheralive WHERE id=?");    
        
        $statement->bindParam(1,$_POST["id"]);

        if($statement->execute()){                 
            echo "ok";
        }
        else
            echo "error";

    }
    else
        echo "error";
});

/*
if ($_POST["op"] == "RemoverAuto" && isset($_POST["id"])) {

        $conexion = AccesoDatos::dameUnObjetoAcceso();
        $statement = $conexion->RetornarConsulta("DELETE FROM cocheralive WHERE id=?");

        $statement->bindParam(1,$_POST["id"]);

        if ($statement->execute())
            echo "ok";
        else
            echo "error";
}

*/
$app->run();

?>