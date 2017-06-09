<?php

class Vehiculo
{
    //--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $patente;
 	private $color;
  	private $marca;
	private $entrada; 
    private $salida;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetPatente()
	{
		return $this->patente;
	}
	public function GetColor()
	{
		return $this->color;
	}
	public function GetMarca()
	{
		return $this->marca;
	}

    public function GetSalida()
	{
		return $this->saldia;
	}

	public function SetEntrada($valor)
	{
		$this->entrada = $valor;
	}

	public function SetPatente($valor)
	{
		$this->patente = $valor;
	}
	public function Setcolor($valor)
	{
		$this->color = $valor;
	}
	public function SetMarca($valor)
	{
		$this->marca = $valor;
	}

	public function SetEntrada($valor)
	{
		$this->entrada = $valor;
	}

    public function SetSalida($valor)
	{
		$this->salida = $valor;
	}
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($patente=NULL, $color=NULL, $marca=NULL, $entrada = NULL, $salida = NULL)
	{
		if($patente !== NULL && $color !== NULL && $marca !== NULL && $entrada !== NULL && $salida !== NULL){
			
            $this->patente = $patente;
			$this->color = $color;
			$this->marca = $marca;
			$this->entrada = $entrada;
            $this->salida = $salida;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->patente." - ".$this->color." - ".$this->marca."-".$this->entrada."-".$this->salida."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
	public function RegistrarEntrada()
    {

    }
    
    public function RegistrarSalida()
    {

    }
    
    
    
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