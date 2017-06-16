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
        

	//--------------------------------------------------------------------------------//    
 
}


?>