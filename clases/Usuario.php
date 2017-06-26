<?php

class Usuario
{
    //--------------------------------------------------------------------------------//
	//--ATRIBUTOS
		
		private $usuario;
		private $password;

	//--------------------------------------------------------------------------------//

	//--------------------------------------------------------------------------------//
	//--GETTERS Y SETTERS
		public function GetUsuario()
		{
			return $this->usuario;
		}
		public function GetPass()
		{
			return $this->pass;
		}
		public function SetUsuario($valor)
		{
			$this->usuario = $valor;
		}

		public function SetPass($valor)
		{
			$this->password = $valor;
		}
    //--------------------------------------------------------------------------------//
	//--CONSTRUCTOR
		public function __construct($usuario=NULL, $password=NULL)
		{
			if($usuario !== NULL && $password !== NULL){
				$this->usuario = $usuario;
				$this->$password = $password;
			}
		}
    //--------------------------------------------------------------------------------//
	//--TOSTRING	
		public function ToString()
		{
			return $this->usuario." - ".$this->password."\r\n";
		}
	//--------------------------------------------------------------------------------//

	//--------------------------------------------------------------------------------//
	//--METODOS DE CLASE
        public static function ExisteUsuario($user,$pass)
		{	
			$letLogin = FALSE;
			$retorno  = FALSE;

			$usuarios = Usuario::TraerTodosLosUsuarios();

			if ($usuarios !== FALSE) {
				foreach ($usuarios as $value) {		

					if ($value["usuario"] == $user && $value["password"] == $pass) {				
						$letLogin = TRUE;
						break;
					}
				}

				if($letLogin === TRUE){
					$retorno = TRUE;
				}
			}

			return $retorno;
		}


		public static function TraerTodosLosUsuarios()
		{
			$todoslosusuarios = FALSE;

			$conexion = AccesoDatos::dameUnObjetoAcceso();
			$statement = $conexion->RetornarConsulta("SELECT * FROM `usuarios` WHERE 1");

			if ($statement->execute()) {	

				$todoslosusuarios = $statement->fetchall();
			}
			
			return $todoslosusuarios;
		}

		public static function SeLogeo($user)
		{
			$conexion = AccesoDatos::dameUnObjetoAcceso();
    		$statement = $conexion->RetornarConsulta("INSERT INTO estadisticaslogin (`usuario`, `horalogin`) VALUES (?,NOW())");

			$statement->bindParam(1,$user);

			if ($statement->execute()) {
				return TRUE;
			}	
			else
				return FALSE;
		}

	//--------------------------------------------------------------------------------//    
 
}


?>