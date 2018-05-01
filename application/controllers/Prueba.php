<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {



	function __construct() {
		parent::__construct();

	}


	public function index() {
		$this->load->model('models_registro');


		$conceptos = $this->models_registro->getEliminarfecha('fecha_de_entrega');
		if (isset($conceptos)) {
			foreach ($conceptos->result() as $rowxc) {

				

				 $newdata = array('fecha_de_entrega' => NULL);

				$this->models_registro->update($rowxc->idregistro,$newdata);

			}
		}


		$conceptosx = $this->models_registro->getEliminarfecha('fecha_de_inspeccion');
		if (isset($conceptosx)) {
			foreach ($conceptosx->result() as $rowxc) {

				

				 $newdata = array('fecha_de_inspeccion' => NULL);

				$this->models_registro->update($rowxc->idregistro,$newdata);

			}
		}


		$conceptosxy = $this->models_registro->getEliminarfecha('fecha_asigancion');
		if (isset($conceptosxy)) {
			foreach ($conceptosxy->result() as $rowxc) {

				

				 $newdata = array('fecha_asigancion' => NULL);

				$this->models_registro->update($rowxc->idregistro,$newdata);

			}
		}


		$conceptosxyg = $this->models_registro->getEliminarfecha('fecha_captura');
		if (isset($conceptosxyg)) {
			foreach ($conceptosxyg->result() as $rowxc) {

				

				 $newdata = array('fecha_captura' => NULL);

				$this->models_registro->update($rowxc->idregistro,$newdata);

			}
		}



		$vvvv = $this->models_registro->getEliminarfecha('fecha_cierre');
		if (isset($vvvv)) {
			foreach ($vvvv->result() as $rowxc) {

				

				 $newdata = array('fecha_cierre' => NULL);

				$this->models_registro->update($rowxc->idregistro,$newdata);

			}
		}


		$xxx = $this->models_registro->getEliminarfecha('fecha_final');
		if (isset($xxx)) {
			foreach ($xxx->result() as $rowxc) {

				

				 $newdata = array('fecha_final' => NULL);

				$this->models_registro->update($rowxc->idregistro,$newdata);

			}
		}





	}



}