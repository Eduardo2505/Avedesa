<?php

class Configuracion{

	protected   $fechaCompromisoEntrega;
	protected   $fechaSolicitado;

	public function __construct()
	{
		$this->fechaCompromisoEntrega = "25/05/05";
		$this->fechaSolicitado = "25/05/05";
	}

	public function getFechaCompromisoEntrega()
	{
		return $this->fechaCompromisoEntrega;
	}

	public function getfechaSolicitado()
	{
		return $this->fechaSolicitado;
	}

	public function setFechaCompromisoEntrega($fechaCompromisoEntrega)
	{
		$this->fechaCompromisoEntrega = $fechaCompromisoEntrega;
	}

	public function setFechaSolicitado($fechaSolicitado)
	{
		$this->fechaSolicitado = $fechaSolicitado;
	}
}

class SolicitudIndividual{

    // Atributos
	protected $configuracion;

	public function __construct()
	{
		$this->configuracion = new Configuracion();

	}

	public function getConfiguracion()
	{
		return $this->configuracion;
	}

	public function setConfiguracion($configuracion)
	{
		$this->configuracion = $configuracion;
	}

}

