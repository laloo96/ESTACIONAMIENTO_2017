<?php

class Empleado
{
	//--------------------------------------------------------------------------------//
	//--ATRIBUTOS
		
		private $apellido;
		private $nombre;
		private $turno;
		private $estado; 
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

		public function SetEstado($valor)
		{
			$this->estado = $valor;
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
		/*public static function Guardar($obj)
		{
			$resultado = FALSE;
			
			//ABRO EL ARCHIVO
			$ar = fopen("archivos/productos.txt", "a");
			
			//ESCRIBO EN EL ARCHIVO
			$cant = fwrite($ar, $obj->ToString());
			
			if($cant > 0)
			{
				$resultado = TRUE;			
			}
			//CIERRO EL ARCHIVO
			fclose($ar);
			
			return $resultado;
		}

		public static function TraerTodosLosProductos()
		{

			$ListaDeProductosLeidos = array();

			//leo todos los productos del archivo
			$archivo=fopen("archivos/productos.txt", "r");
			
			while(!feof($archivo))
			{
				$archAux = fgets($archivo);
				$productos = explode(" - ", $archAux);
				//http://www.w3schools.com/php/func_string_explode.asp
				$productos[0] = trim($productos[0]);
				if($productos[0] != ""){
					$ListaDeProductosLeidos[] = new Producto($productos[0], $productos[1],$productos[2]);
				}
			}
			fclose($archivo);
			
			return $ListaDeProductosLeidos;
			
		}*/
	//--------------------------------------------------------------------------------//
}


?>

