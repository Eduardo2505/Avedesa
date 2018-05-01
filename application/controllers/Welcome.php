<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    ///public $pila = array();

    function __construct() {

        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $datoiniciar = $this->session->userdata('Nombre');
        if (!empty($datoiniciar)) {
            redirect('menu', 'refresh');
        }
    }

    public function index() {
        $data['cadena'] = "";
        $this->load->view('login', $data);
    }

    public function login() {
        $this->load->model('models_empleado');
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $valor = $this->models_empleado->login($email, $pass);
        $cantidad=$valor->num_rows() ;
        if ($cantidad!= 0) {

            $row = $valor->row();
            $pila = array();
            foreach ($valor->result() as $rowx) {

             array_push($pila, $rowx->idcat_puesto);
         }



         $newdata = array(
            'idcat_puesto' => $row->idcat_puesto,
            'puesto' => $row->puesto,
            'idempleado' => $row->idempleado,
            'Nombre' => $row->Nombre,
            'apellidos' => $row->apellidos,
            'iniciales' => $row->iniciales,
            'email' => $row->email,
            'listpuesto' => $pila,
            'pass' => $row->pass
            );
           // echo $row->Nombre;
         $this->session->set_userdata($newdata);


         redirect('menu', 'refresh');

    } else {
        $data['cadena'] = "error";

        $this->load->view('login', $data);
    }
}



}
