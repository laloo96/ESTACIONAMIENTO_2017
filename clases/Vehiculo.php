<?php
require_once('../php/AccesoDatos.php');

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

	public function GetEntrada($valor)
	{
		return $this->entrada;
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

	/*
	* Ingresa un auto en la chochera.
	*//*
	public static function IngresarAuto()
    {

    }
*/
	/*
	*	Remuve el auto de los estacionados y lo registra en la tabla de autos egresados.
	*/
    public static function EgresarAuto($id){	
		
		if (isset($id)) {	

			$respuesta = "error";

			$vehiculoaegresar = Vehiculo::DameUnAuto($id);

			echo"ME DIO ESTE AUTO";
			var_dump($vehiculoaegresar);
			
        	$conexion = AccesoDatos::dameUnObjetoAcceso();
			$statement = $conexion->RetornarConsulta("DELETE FROM cocheralive WHERE id=?");

			$statement->bindParam(1,$id);
			
			if($statement->execute()){   

				echo"ESTOY POR REGISTRAR SALIDA YA LO ELIMINE";
				var_dump($vehiculoaegresar);
				
				if (Vehiculo::RegistrarSalida($vehiculoaegresar) === TRUE) {
					$respuesta = "ok";
				}
			}	
		}
		
		return $respuesta;
    }

	public static function RegistrarSalida($autoaegresar)
	{	
			$conexion = AccesoDatos::dameUnObjetoAcceso();

			$statement = $conexion->RetornarConsulta("INSERT INTO `egresos`(`color`, `patente`, `marca`, `entrada`, `salida`) VALUES (?,?,?,?,NOW())");  

			$statement->bindParam(1,$autoaegresar['color']);
			$statement->bindParam(2,$autoaegresar['patente']);
			$statement->bindParam(3,$autoaegresar['marca']);
			$statement->bindParam(4,$autoaegresar['entrada']);

			if ($statement->execute()) {
				return TRUE;
			}
			else
				return FALSE;
	}

	/*
	* Retorna el auto estacionado segun el id pasado.
	*/
	public static function DameUnAuto($id)
	{	
		$vehiculo = "nada";	

		echo "aca esta el aidi en functiones".$id;

		$conexion = AccesoDatos::dameUnObjetoAcceso();
		$statement = $conexion->RetornarConsulta("SELECT * FROM cocheralive WHERE id=?");  

		$statement->bindParam(1,$id);
		
		if($statement->execute()){   
			$vehiculo = $statement->fetchall(); 
			var_dump($vehiculo);
		}
		else
			echo "error";

		return $vehiculo;	
	}

	/*          FUNCIONANDO!!
	* Devuelvue todos los autos estacionados en este momento.
	*/
	public static function TraerTodos()
	{
		$conexion = AccesoDatos::dameUnObjetoAcceso();
		$statement = $conexion->RetornarConsulta("SELECT * FROM cocheralive WHERE 1");
		
		if($statement->execute()){       
			
			$autoslive = $statement->fetchall();

		}

		return $autoslive;
	}

//--------------------------------------------------------------------------------//
}

?>