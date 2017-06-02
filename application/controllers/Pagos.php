<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends CI_Controller {



  function __construct() {

    parent::__construct();
    $this->load->library('session');
    $this->load->library('encrypt');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('pagination');
    $datoiniciar = $this->session->userdata('Nombre');
    if (strlen($datoiniciar) == 0) {


      redirect('', 'refresh');
    }
    /*$idpuesto = $this->session->userdata('idcat_puesto');

    if ($idpuesto != 1&&$idpuesto != 6&&$idpuesto != 2) {

     redirect('registro', 'refresh');
   }*/


   $this->load->model('models_pagos');
   $this->load->model('models_pagoseliminados');
   
 }



 public function registro() {
   $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');

   $id = $this->input->get('id');
   $valorr = $this->input->get('anticipo');
   $descripcion = $this->input->get('descripcion');
   $op = $this->input->get('op');
   

   if (!empty($valorr)) {

    $data = array(
      'usuario' => $nombrez,
      'anticipo' => $valorr,
      'descripcion' =>  $descripcion,
      'idempleado' =>  $this->session->userdata('idempleado'),
      'idregistro' => $id);

    $valor = $this->models_pagos->insertar($data);


    redirect('pagos/registro?id='.$id.'&op=1', 'refresh');


  } else {
    $data['msn'] = -1;
  }

  if (!empty($op)) {
    $data['msn'] = $op;
  }

  

  $datax['nombre'] = $nombrez;
  $datax['puesto'] = $this->session->userdata('puesto');
  $datax['menusolicitudes'] = "active";
  $datax['menucatalogos'] = "x";
  $datax['menuadmin'] = "x";
  $datax['solictudesbus'] = "x";
  $datax['solictudesnuevo'] = "x";
  $datax['solictudesver'] = "active";
  $datax['catalogost'] = "x";
  $datax['catalogoso'] = "x";
  $datax['catalogose'] = "x";
  $datax['catalogosp'] = "x";
  $datax['catalogosem'] = "active";
  $datax['catalogoemp'] = "x";
  $datax['adminq'] = "x";
  $datax['adminc'] = "x";
  $datax['admincc'] = "x";
  $datax['admina'] = "x";
  $datax['solicitudes'] = "active";
  $data['id'] = $id;
  $data['nombre'] = $nombrez;
  $idpuesto = $this->session->userdata('idcat_puesto');
  if($idpuesto==1||$idpuesto==6||$idpuesto==9){
    $data['registros'] = $this->models_pagos->Buscar($id);
   }else{
     $data['registros'] = $this->models_pagos->getPagosUsuario($this->session->userdata('idempleado'),$id);
   }

  $data['registrosEliminados'] = $this->models_pagos->mostrarEliminados($id);
  $data['idcapturista'] = $this->session->userdata('idempleado');
  $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
  $data['head'] = $this->load->view('plantilla/head', true);
  $this->load->view('pagos/registro', $data);
}



public function eliminar() {

  $idregistro = $this->input->get('idregistro');
  $idpagos = $this->input->get('idpagos');
  $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
  $data = array(
    'estado' => 0);
  $datax = array(
    'idpagos' => $idpagos,
    'usuario' => $nombrez);

  $valorx = $this->models_pagoseliminados->insertar($datax);

  $valor = $this->models_pagos->update($idpagos,$data);

  redirect('pagos/registro?id='.$idregistro, 'refresh');

}

public function QR() {

 $this->load->library('ciqrcode');

 $params['data'] = 'This is a text to encode become QR Code';
 $params['level'] = 'H';
 $params['size'] = 1;
 $params['savename'] = FCPATH.'tes.png';
 $this->ciqrcode->generate($params);

 echo '<img src="'.base_url().'tes.png" />';
}



}
