<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpagos extends CI_Controller {

    private $limite = 20;

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

        if ($idpuesto != 9&&$idpuesto !=1) {

          redirect('registro', 'refresh');
      }*/



      $this->load->model('models_pagosadmin');
  }

  public function buscarpago() {

    $this->load->model('models_pagos');
    $idpago = $this->input->get('idpago');

    $query = $this->models_pagos->Buscarfull($idpago);
    $row = $query->row();
    echo '<tr id="'.$row->idpagos.'">
    <td><input type="checkbox" class="case" title="'.$row->anticipo.'"  name="pagos[]" value="'.$row->idpagos.'"></td>
    <td>'.$row->num_expediente.'</td>
    <td>'.number_format($row->anticipo, 2, '.', ',').'</td>
    <td>'.$row->descripcion.'</td>
    <td>'.$row->registro.'</td>
    <td>'.$row->usuario.'</td>
    <tr>';


    }

    public function eliminarTicket() {
       $this->load->model('models_pagos');

       $idpago = $this->input->get('idpago');
       $idempleado = $this->session->userdata('idempleado');

       $data = array(
        'estado' => 1);
       $this->models_pagos->update($idpago, $data);

       $data['registros'] = $this->models_pagosadmin->mostrarSolotiket($idempleado);
       $plantilla = $this->load->view('adminpagos/tiket', $data, true);
       echo $plantilla ;
   }

   public function agregarComanda() {

    $this->load->model('models_pagos');

    $idempleado = $this->session->userdata('idempleado');

    if (!empty($_POST['pagos'])) {
       $total=count($_POST['pagos']);

       for($i=0;$i<$total;$i++) { 
        $data = array(
            'estado' => 3,
            'idadministrador' =>$idempleado);
        $idPago=$_POST['pagos'][$i];
        $this->models_pagos->update($idPago, $data);
    }  
}


$data['registros'] = $this->models_pagosadmin->mostrarSolotiket($idempleado);
$plantilla = $this->load->view('adminpagos/tiket', $data, true);
echo $plantilla ;

}

public function mostraranticipos() {


    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }

    $nombre = trim($this->input->get('nombre'));
    $data['registros'] = $this->models_pagosadmin->mostrapag($nombre, $offset, $this->limite);


    $config['base_url'] = base_url() . 'adminpagos/mostraranticipos?nombre=' . $nombre;
    $totalres = $this->models_pagosadmin->mostrarcount($nombre);
    $config['total_rows'] = $totalres;
    $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
    $config['num_links'] = 5; //Número de links mostrados en la paginación
    $config['page_query_string'] = true;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['first_tag_open'] = '<li>';
    $config['first_link'] = 'Primera'; //primer link
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_link'] = 'Última'; //último link
    $config['last_tag_close'] = '</li>';
    $config["uri_segment"] = $uri_segment; //el segmento de la paginación
    $config['next_tag_open'] = '<li>';
    $config['next_link'] = 'Siguiente'; //siguiente link
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_link'] = 'Anterior'; //anterior link
    $config['prev_tag_close'] = '</li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        
        $data["pagination"] = $this->pagination->create_links();
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menuanticipos'] = "active";

        $datax['menusinanticipos'] = "x";
        
        $data['nombre'] = $nombrez;
        $data['total'] = $totalres;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menupagos', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $data['totalSuma'] = $this->models_pagosadmin->mostrapagsuma($nombre);
        
        $this->load->view('adminpagos/listar', $data);
    }

    public function mostrarsinanticipos() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }

        $nombre = trim($this->input->get('nombre'));
        $data['registros'] = $this->models_pagosadmin->mostrapagsin($nombre, $offset, $this->limite);

        $config['base_url'] = base_url() . 'adminpagos/mostrarsinanticipos?nombre=' . $nombre;
        $totalres=$this->models_pagosadmin->mostrarcountsin($nombre);
        $config['total_rows'] = $totalres;
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['page_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = 'Primera'; //primer link
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Última'; //último link
        $config['last_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment; //el segmento de la paginación
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = 'Anterior'; //anterior link
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        
        $data["pagination"] = $this->pagination->create_links();
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menuanticipos'] = "x";
        $datax['menusinanticipos'] = "active";
        
        $data['nombre'] = $nombrez;
        $data['total'] = $totalres;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menupagos', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('adminpagos/listarsin', $data);
    }

    public function mostrarpagos() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }

        $numexpediente = trim($this->input->get('numexpediente'));
        $inicior = trim($this->input->get('inicior'));
        $finalr = trim($this->input->get('finalr'));
        $inicioa = trim($this->input->get('inicioa'));
        $finala = trim($this->input->get('finala'));
        $usuario = trim($this->input->get('usuario'));
        $autorizado = trim($this->input->get('autorizado'));



        $data['registros'] = $this->models_pagosadmin->mostrarpagos($numexpediente,$inicior,$finalr,$inicioa,$finala,$usuario,$autorizado,$offset, $this->limite);

        $config['base_url'] = base_url() . 'adminpagos/mostrarpagos?numexpediente='.$numexpediente.'&inicior='.$inicior.'&finalr='.$finalr.'&inicioa='.$inicioa.'&finala='.$finala.'&usuario='.$usuario.'&autorizado='.$autorizado;
        $totalres=$this->models_pagosadmin->countpagos($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$autorizado);
        
        $config['total_rows'] = $totalres;
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['page_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = 'Primera'; //primer link
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Última'; //último link
        $config['last_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment; //el segmento de la paginación
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = 'Anterior'; //anterior link
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        
        $data["pagination"] = $this->pagination->create_links();
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menuanticipos'] = "x";
        $datax['menusinanticipos'] = "x";
        $datax['menuanticipospago'] = "active";
        
        $data['nombre'] = $nombrez;
        $data['total'] = $totalres;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menupagos', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);

        $data['pagosEliminados']=$this->models_pagosadmin->mostrarpagosEliminados($numexpediente,$inicior,$finalr,$inicioa,$finala,$usuario,$offset, $this->limite);
        $configx['base_url'] = base_url() . 'adminpagos/mostrarpagos?numexpediente='.$numexpediente.'&inicior='.$inicior.'&finalr='.$finalr.'&inicioa='.$inicioa.'&finala='.$finala.'&usuario='.$usuario;
        $totalresx=$this->models_pagosadmin->countpagosEliminados($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$autorizado);
        $configx['total_rows'] = $totalresx;
        $data['totalx'] = $totalresx;
        $configx['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $configx['num_links'] = 5; //Número de links mostrados en la paginación
        $configx['page_query_string'] = true;
        $configx['full_tag_open'] = '<ul class="pagination">';
        $configx['first_tag_open'] = '<li>';
        $configx['first_link'] = 'Primera'; //primer link
        $configx['first_tag_close'] = '</li>';
        $configx['last_tag_open'] = '<li>';
        $configx['last_link'] = 'Última'; //último link
        $configx['last_tag_close'] = '</li>';
        $configx["uri_segment"] = $uri_segment; //el segmento de la paginación
        $configx['next_tag_open'] = '<li>';
        $configx['next_link'] = 'Siguiente'; //siguiente link
        $configx['next_tag_close'] = '</li>';
        $configx['prev_tag_open'] = '<li>';
        $configx['prev_link'] = 'Anterior'; //anterior link
        $configx['prev_tag_close'] = '</li>';
        $configx['num_tag_open'] = '<li>';
        $configx['num_tag_close'] = '</li>';
        $configx['cur_tag_open'] = '<li class="active"><a href="#">';
        $configx['cur_tag_close'] = '</a></li>';
        $configx['full_tag_close'] = '</ul>';


        $this->pagination->initialize($configx); //inicializamos la paginación        
        $data["paginationx"] = $this->pagination->create_links();

        $data['usuarios'] = $this->models_pagosadmin->mostraUsuarios();
        $data['totalSuma'] = $this->models_pagosadmin->mostrarpagosSuma($numexpediente,$inicior,$finalr,$inicioa,$finala,$usuario,$autorizado);
        $this->load->view('adminpagos/listarpagos', $data);
    }

    public function mostrarpagosdetalles() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }

        $numexpediente = trim($this->input->get('numexpediente'));
        $inicior = "";
        $finalr = "";
        $inicioa ="";
        $finala = "";
        $usuario = "";
        $autorizado = "";
        $data['registros'] = $this->models_pagosadmin->mostrarpagos($numexpediente,$inicior,$finalr,$inicioa,$finala,$usuario,$autorizado, $offset, $this->limite);

        $config['base_url'] = base_url() . 'adminpagos/mostrarpagosdetalles?numexpediente='.$numexpediente;
        $totalres=$this->models_pagosadmin->countpagos($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario, $autorizado);
        $config['total_rows'] = $totalres;
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['page_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = 'Primera'; //primer link
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Última'; //último link
        $config['last_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment; //el segmento de la paginación
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = 'Anterior'; //anterior link
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        
        $data["pagination"] = $this->pagination->create_links();
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menuanticipos'] = "active";
        $datax['menusinanticipos'] = "x";
        $datax['menuanticipospago'] = "x";
        
        $data['nombre'] = $nombrez;
        $data['total'] = $totalres;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menupagos', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);

        $data['pagosEliminados']=$this->models_pagosadmin->mostrarpagosEliminados($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$offset, $this->limite);
        $configx['base_url'] = base_url() . 'adminpagos/mostrarpagosdetalles?numexpediente='.$numexpediente;
        $totalresx=$this->models_pagosadmin->countpagosEliminados($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario);
        $configx['total_rows'] = $totalresx;
        $data['totalx'] = $totalresx;
        $configx['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $configx['num_links'] = 5; //Número de links mostrados en la paginación
        $configx['page_query_string'] = true;
        $configx['full_tag_open'] = '<ul class="pagination">';
        $configx['first_tag_open'] = '<li>';
        $configx['first_link'] = 'Primera'; //primer link
        $configx['first_tag_close'] = '</li>';
        $configx['last_tag_open'] = '<li>';
        $configx['last_link'] = 'Última'; //último link
        $configx['last_tag_close'] = '</li>';
        $configx["uri_segment"] = $uri_segment; //el segmento de la paginación
        $configx['next_tag_open'] = '<li>';
        $configx['next_link'] = 'Siguiente'; //siguiente link
        $configx['next_tag_close'] = '</li>';
        $configx['prev_tag_open'] = '<li>';
        $configx['prev_link'] = 'Anterior'; //anterior link
        $configx['prev_tag_close'] = '</li>';
        $configx['num_tag_open'] = '<li>';
        $configx['num_tag_close'] = '</li>';
        $configx['cur_tag_open'] = '<li class="active"><a href="#">';
        $configx['cur_tag_close'] = '</a></li>';
        $configx['full_tag_close'] = '</ul>';


        $this->pagination->initialize($configx); //inicializamos la paginación        
        $data["paginationx"] = $this->pagination->create_links();
        $data['totalSuma'] = $this->models_pagosadmin->mostrarpagosSuma($numexpediente,$inicior,$finalr,$inicioa,$finala,$usuario,$autorizado);
        $this->load->view('adminpagos/listarpagosdetalles', $data);
    }

    // Admin
    public function mostrarpagosadmin() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }

        $numexpediente = trim($this->input->get('numexpediente'));
        $inicior = trim($this->input->get('inicior'));
        $finalr = trim($this->input->get('finalr'));
        $usuario = trim($this->input->get('usuario'));

        $data['registros'] = $this->models_pagosadmin->mostrarSoloPagos($numexpediente,$inicior,$finalr,$usuario,1,$offset, $this->limite);

        $config['base_url'] = base_url() . 'adminpagos/mostrarpagosadmin?numexpediente='.$numexpediente.'&inicior='.$inicior.'&finalr='.$finalr.'&usuario='.$usuario;
        $totalres=$this->models_pagosadmin->mostrarSoloPagosCount($numexpediente,$inicior,$finalr, $usuario,1);
        $config['total_rows'] = $totalres;
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['page_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = 'Primera'; //primer link
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Última'; //último link
        $config['last_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment; //el segmento de la paginación
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = 'Anterior'; //anterior link
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        
        $data["pagination"] = $this->pagination->create_links();
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menusolicitudes'] = "x";
        $datax['menucatalogos'] = "x";
        $datax['menuadmin'] = "active";
        $datax['solictudesbus'] = "x";
        $datax['solictudesnuevo'] = "x";
        $datax['solictudesver'] = "x";
        $datax['catalogost'] = "x";
        $datax['catalogoso'] = "x";
        $datax['catalogose'] = "x";
        $datax['catalogosp'] = "x";
        $datax['catalogosem'] = "x";
        $datax['catalogoemp'] = "x";
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";
        $datax['adminapag'] = "active";
        $datax['pagosPendiente'] = "active";
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['nombre'] = $nombrez;
        $data['total'] = $totalres;
        $idcapturista = $this->session->userdata('idempleado');
        $data['idcapturista'] = $idcapturista;
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $data['usuarios'] = $this->models_pagosadmin->mostraUsuarios();
        $data['totalSuma'] = $this->models_pagosadmin->mostrarSoloPagosSum($numexpediente,$inicior,$finalr, $usuario,1);
        $data['registrosTiket'] = $this->models_pagosadmin->mostrarSolotiket($idcapturista);
        $this->load->view('adminpagos/listarpagosadmin', $data);


    }
    public function imprimirTiket() {

        $idempleado = $this->session->userdata('idempleado');
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        $data['nombre'] = $nombrez;

        $registros= $this->models_pagosadmin->mostrarSolotiket($idempleado);

        $folio= date("YmdHis");  

        if (isset($registros)) {

            foreach ($registros->result() as $rowx) {

                $datosInsertar = array(
                    'idpagos' => $rowx->idpagos,
                    'tiket' => $folio,
                    'usuario' => $nombrez);

                $datosupdate = array(
                    'estado' => 2);
                $return=  $this->models_pagosadmin->updatePagos($rowx->idpagos,$datosupdate);


                $return=  $this->models_pagosadmin->insertarPagos($datosInsertar);

            }
            redirect('adminpagos/imprimirTiketTiket?folio='.$folio, 'refresh');


        }else{
            redirect('adminpagos/mostrarpagosadmin', 'refresh');

        }




    }
    public function imprimirTiketTiket() {

       $folio = trim($this->input->get('folio'));
       $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
       $data['nombre'] = $nombrez;
       $data['urlredi'] = site_url('')."adminpagos/mostrarpagosadmin";
       $data["registros"]=$this->models_pagosadmin->mostrarpagosticketAceptar($folio);
       $this->load->view('adminpagos/imprimir_viewer', $data);

   }



   public function contrasena() {

    $data['msn'] = -1;
    $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');

    $datax['nombre'] = $nombrez;
    $datax['puesto'] = $this->session->userdata('puesto');
    $datax['menusolicitudes'] = "x";
    $datax['menucatalogos'] = "x";
    $datax['menuadmin'] = "x";
    $datax['solictudesbus'] = "x";
    $datax['solictudesnuevo'] = "x";
    $datax['solictudesver'] = "x";
    $datax['catalogost'] = "x";
    $datax['catalogoso'] = "x";
    $datax['catalogose'] = "x";
    $datax['catalogosp'] = "x";
    $datax['catalogosem'] = "x";
    $datax['catalogoemp'] = "x";
    $datax['adminq'] = "x";
    $datax['adminc'] = "x";
    $datax['admincc'] = "x";
    $datax['admina'] = "x";
    $datax['adminapag'] = "x";
    $datax['munupass'] = "active";

    $data['nombre'] = $nombrez;
    $data['idcapturista'] = $this->session->userdata('idempleado');
    $data['menu'] = $this->load->view('plantilla/menupagos', $datax, true);
    $data['head'] = $this->load->view('plantilla/head', true);
    $this->load->view('empleado/contrasena', $data);
}




public function getapa() {


    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }

    $numexpediente = trim($this->input->get('numexpediente'));
    $inicior = trim($this->input->get('inicior'));
    $finalr = trim($this->input->get('finalr'));
    $inicioa = trim($this->input->get('inicioa'));
    $finala = trim($this->input->get('finala'));
    $usuario = trim($this->input->get('usuario'));
    $autorizado = trim($this->input->get('autorizado'));



    $data['registros'] = $this->models_pagosadmin->getapa($numexpediente,$inicior,$finalr,$inicioa,$finala,$usuario,$autorizado,$offset, $this->limite);

    $config['base_url'] = base_url() . 'adminpagos/getapa?numexpediente='.$numexpediente.'&inicior='.$inicior.'&finalr='.$finalr.'&inicioa='.$inicioa.'&finala='.$finala.'&usuario='.$usuario.'&autorizado='.$autorizado;
    $totalres=$this->models_pagosadmin->getapacount($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$autorizado);

    $config['total_rows'] = $totalres;
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['page_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = 'Primera'; //primer link
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Última'; //último link
        $config['last_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment; //el segmento de la paginación
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = 'Anterior'; //anterior link
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        
        $data["pagination"] = $this->pagination->create_links();
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menusolicitudes'] = "x";
        $datax['menucatalogos'] = "x";
        $datax['menuadmin'] = "active";
        $datax['solictudesbus'] = "x";
        $datax['solictudesnuevo'] = "x";
        $datax['solictudesver'] = "x";
        $datax['catalogost'] = "x";
        $datax['catalogoso'] = "x";
        $datax['catalogose'] = "x";
        $datax['catalogosp'] = "x";
        $datax['catalogosem'] = "x";
        $datax['catalogoemp'] = "x";
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";
        $datax['adminapag'] = "active";
        $datax['pagosPendiente'] = "x";
        $datax['pagosAceptados'] = "active";
        
        
        $data['total'] = $totalres;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);

        $data['pagosEliminados']=$this->models_pagosadmin->mostrarpagosEliminados($numexpediente,$inicior,$finalr,$inicioa,$finala,$usuario,$offset, $this->limite);
        $configx['base_url'] = base_url() . 'adminpagos/getapa?numexpediente='.$numexpediente.'&inicior='.$inicior.'&finalr='.$finalr.'&inicioa='.$inicioa.'&finala='.$finala.'&usuario='.$usuario;
        $totalresx=$this->models_pagosadmin->countpagosEliminados($numexpediente,$inicior,$finalr,$inicioa,$finala, $usuario,$autorizado);
        $configx['total_rows'] = $totalresx;
        $data['totalx'] = $totalresx;
        $configx['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $configx['num_links'] = 5; //Número de links mostrados en la paginación
        $configx['page_query_string'] = true;
        $configx['full_tag_open'] = '<ul class="pagination">';
        $configx['first_tag_open'] = '<li>';
        $configx['first_link'] = 'Primera'; //primer link
        $configx['first_tag_close'] = '</li>';
        $configx['last_tag_open'] = '<li>';
        $configx['last_link'] = 'Última'; //último link
        $configx['last_tag_close'] = '</li>';
        $configx["uri_segment"] = $uri_segment; //el segmento de la paginación
        $configx['next_tag_open'] = '<li>';
        $configx['next_link'] = 'Siguiente'; //siguiente link
        $configx['next_tag_close'] = '</li>';
        $configx['prev_tag_open'] = '<li>';
        $configx['prev_link'] = 'Anterior'; //anterior link
        $configx['prev_tag_close'] = '</li>';
        $configx['num_tag_open'] = '<li>';
        $configx['num_tag_close'] = '</li>';
        $configx['cur_tag_open'] = '<li class="active"><a href="#">';
        $configx['cur_tag_close'] = '</a></li>';
        $configx['full_tag_close'] = '</ul>';


        $this->pagination->initialize($configx); //inicializamos la paginación        
        $data["paginationx"] = $this->pagination->create_links();

        $data['usuarios'] = $this->models_pagosadmin->mostraUsuarios();
        $data['totalSuma'] = $this->models_pagosadmin->mostrarpagosSuma($numexpediente,$inicior,$finalr,$inicioa,$finala,$usuario,$autorizado);
        $this->load->view('adminpagos/listarpagos_admin', $data);
    }


}
