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
			else
			{
				echo "error";
			}
		}
		else
		{	
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



?>