<?php
require_once("../php/AccesoDatos.php");

class Empleado
{
	//--------------------------------------------------------------------------------//
	//--ATRIBUTOS
		
		private $apellido;
		private $nombre;
		private $turno;
		private $estado; 
		private static $cantOperaciones;
	//--------------------------------------------------------------------------------//

	//--------------------------------------------------------------------------------//
	//--GETTERS Y SETTERS
		public function GetApellido()
		{
			return $this->apellido;
		}
		public function GetNombre()
		{
			return $this->nombre;
		}
		public function GetTurno()
		{
			return $this->turno;
		}

		public function GetEstado($valor)
		{
			return $this->estado;
		}

		
		public function SetApellido($valor)
		{
			$this->apellido = $valor;
		}
		public function SetNombre($valor)
		{
			$this->nombre = $valor;
		}
		public function SetTurno($valor)
		{
			$this->turno = $valor;
		}
		public function SetEstado($valor)
		{
			$this->estado = $valor;
		}
	//--------------------------------------------------------------------------------//
	//--CONSTRUCTOR
		public function __construct($apellido=NULL, $nombre=NULL, $turno=NULL, $estado = NULL)
		{
			if($apellido !== NULL && $nombre !== NULL && $turno !== NULL && $turno !== NULL){
				$this->apellido = $apellido;
				$this->nombre = $nombre;
				$this->turno = $turno;
				$this->estado = $estado;
			}
		}

	//--------------------------------------------------------------------------------//
	//--TOSTRING	
		public function ToString()
		{
			return $this->apellido." - ".$this->nombre." - ".$this->turno."-".$this->estado.  "\r\n";
		}
	//--------------------------------------------------------------------------------//

	//--------------------------------------------------------------------------------//
	//--METODOS DE CLASE
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

