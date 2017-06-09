<?php
require_once("AccesoDatos.php");

session_start();


if($_POST["op"] == "ingreso")
{
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


            return "ok";
        }
        else
            return "error";
    }

}

if($_POST["op"] == "salida")
{
        $conexion = AccesoDatos::dameUnObjetoAcceso();
        $statement = $conexion->RetornarConsulta("SELECT * FROM cocheralive WHERE 1");
       
        if($statement->execute()){       
            
            $data = $statement->fetchall();
            
            echo json_encode($data);
        }
}


if ($_POST["op"] == "RemoverAuto" && isset($_POST["id"])) {

        $conexion = AccesoDatos::dameUnObjetoAcceso();
        $statement = $conexion->RetornarConsulta("DELETE FROM cocheralive WHERE id=?");

        $statement->bindParam(1,$_POST["id"]);

        if ($statement->execute())
            echo "ok";
        else
            echo "error";
}


?>