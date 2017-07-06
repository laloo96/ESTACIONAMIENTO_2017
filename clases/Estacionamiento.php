<?php

class Estacionamiento
{
	//--------------------------------------------------------------------------------//
	//--ATRIBUTOS
		private $parcelas;
	//--------------------------------------------------------------------------------//

	//--------------------------------------------------------------------------------//
	//--GETTERS Y SETTERS
		public function Getparcelas()
		{
			return $this->parcelas;
		}

		public function SetParcelas($valor)
		{
			$this->parcelas = $valor;
		}

	//--------------------------------------------------------------------------------//
	//--CONSTRUCTOR
		public function __construct($parcelas=NULL)
		{
			if($parcelas !== NULL ){
				$this->parcelas[3][6] = $parcelas;
			}
		}

	//--------------------------------------------------------------------------------//
	//--TOSTRING	
		/*public function ToString()
		{
			return $this->parcelas." - ".$this->nombre." - ".$this->pathFoto."\r\n";
		}*/
	//--------------------------------------------------------------------------------//

	//--------------------------------------------------------------------------------//
	//--METODOS DE CLASE
	/*
	public static function CalcularImporte($horas,$minutos)
	{
	
	}*/

	//--------------------------------------------------------------------------------//
}






?>