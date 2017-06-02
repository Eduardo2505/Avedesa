<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    ///public $pila = array();

    function __construct() {

        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $datoiniciar = $this->session->userdata('Nombre');
        if (strlen($datoiniciar) == 0) {

            redirect('', 'refresh');
        }

        $this->load->model('models_menu');
    }


    public function index() {

        $idempleado = $this->session->userdata('idempleado');

        $resultados=$this->models_menu->get($idempleado);
        $cantidad=$resultados->num_rows();
        $data['colTam']=12/$cantidad;
        $data['resultados']=$resultados;

        $this->load->view('menuLogin',$data);
    }


}
