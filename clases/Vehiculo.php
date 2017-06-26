<?php

require_once('./php/AccesoDatos.php');

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

	/*  FUNCIONAAA!!
	* Ingresa un auto en la chochera.
	*/
	public static function IngresarAuto($autoIngresando)
    {	
		$conexion = AccesoDatos::dameUnObjetoAcceso();
        $statement = $conexion->RetornarConsulta("INSERT INTO cocheralive (`patente`, `color`, `marca`, `entrada`) VALUES (?,?,?,NOW())");

        $statement->bindParam(1,$autoIngresando["patente"]);
        $statement->bindParam(2,$autoIngresando["color"]);
        $statement->bindParam(3,$autoIngresando["marca"]);
 
        if ($statement->execute()) {
            $rta = "echo ejecuto bien";
        }
        else
            $rta =  "error al ejecutar query";

		return $rta;
    }

	
	/*     FUNCIONAAA!!
	*	Remuve el auto de los estacionados y lo registra en la tabla de autos egresados.
	*/
    public static function EgresarAuto($id){	
		
		$succes = FALSE;
		
		if (isset($id)) {	
			
			$vehiculoaegresar = Vehiculo::DameUnAuto($id);
			
			if ($vehiculoaegresar !== NULL) {
				
				$conexion = AccesoDatos::dameUnObjetoAcceso();
				$statement = $conexion->RetornarConsulta("DELETE FROM cocheralive WHERE id=?");

				$statement->bindParam(1,$id);
				
				if($statement->execute()){   
				
					if (Vehiculo::RegistrarSalida($vehiculoaegresar) === TRUE) {
						$succes = TRUE;
					}
				}	
			}
		}
		
		return $succes;
    }

	/*					FUNCIONA!!!
	*	Registra el auto que aca de salir en la tabla de los egresos.
	*/
	public static function RegistrarSalida($auto)
	{	
			$conexion = AccesoDatos::dameUnObjetoAcceso();

			$statement = $conexion->RetornarConsulta("INSERT INTO egresos (`color`, `patente`, `marca`, `entrada`, `salida`) VALUES (:color,:patente,:marca,:entrada,NOW())");  

			$statement->bindParam(':color',$auto[0]['color']);
			$statement->bindParam(':patente',$auto[0]['patente']);
			$statement->bindParam(':marca',$auto[0]['marca']);
			$statement->bindParam(':entrada',$auto[0]['entrada']);

			if ($statement->execute()) {
				return TRUE;
			}
			else
				return FALSE;
	}

	/*     FUNCIONA!!!
	* Retorna el auto estacionado segun el id pasado.
	*/
	public static function DameUnAuto($id)
	{	
		$vehiculo = NULL;	
		
		$conexion = AccesoDatos::dameUnObjetoAcceso();
		$statement = $conexion->RetornarConsulta("SELECT * FROM cocheralive WHERE id=?");  

		$statement->bindParam(1,$id);
		
		if($statement->execute()){   
			$vehiculo = $statement->fetchall();
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