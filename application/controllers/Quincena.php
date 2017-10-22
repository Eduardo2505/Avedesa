<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quincena extends CI_Controller {

    private $limite = 10;

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
       /* $idpuesto = $this->session->userdata('idcat_puesto');
        if ($idpuesto != 1&&$idpuesto != 6) {

           redirect('registro', 'refresh');
       }*/


       $this->load->model('models_quincena');
   }

   public function index() {

    $data['msn'] = -2;
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
    $datax['adminq'] = "active";
    $datax['adminc'] = "x";
    $datax['admincc'] = "x";
    $datax['admina'] = "x";

    $data['nombre'] = $nombrez;
    $data['idcapturista'] = $this->session->userdata('idempleado');
    $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
    $data['head'] = $this->load->view('plantilla/head', true);
    $this->load->view('quincena/registro', $data);
}

public function registro() {



    if(empty($this->input->post('pagada'))!=1){



        $f1 = "0000-00-00";
        if ($this->input->post('pagada') != "") {
            $f1 = $this->input->post('pagada');
        }
        $date1 = date_create($f1);

        $date2 = date_create($this->input->post('inicio'));
        $date3 = date_create($this->input->post('final'));
        $estatus="";
        $verificarEsta=$this->models_quincena->getBuscarActivos();
        if($verificarEsta==0){
           $estatus="Activo";
       }else{
           $estatus="Inactivo";
       }


       $data = array(
        'inicio' => date_format($date2, 'Y-m-d'),
        'final' => date_format($date3, 'Y-m-d'),
        'estado' => $estatus,
        'pagada' => date_format($date1, 'Y-m-d'));

       $valor = $this->models_quincena->insertar($data);
       $this->load->model('models_recibo');
       $this->load->model('models_empleado');


      //  echo $valor;

       $datInfo = $this->models_empleado->get();

       if (isset($datInfo)) {
        foreach ($datInfo->result() as $row) {


         $data = array(
            'idquincena' => $valor,
            'estado' => 'ACTIVO',
            'idempleado' => $row->idempleado);
         $this->models_recibo->insertar($data);
     }


 }





 $data['msn'] = $valor;

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
 $datax['adminq'] = "active";
 $datax['adminc'] = "x";
 $datax['admincc'] = "x";
 $datax['admina'] = "x";
 $data['nombre'] = $nombrez;
 $data['idcapturista'] = $this->session->userdata('idempleado');
 $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
 $data['head'] = $this->load->view('plantilla/head', true);
 $this->load->view('quincena/registro', $data);

}else{
   redirect('quincena', 'refresh');
}
}

public function mostrar() {


    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }

    $inicio = trim($this->input->get('inicial'));
    $final = trim($this->input->get('finali'));
    $date1 = date_create($inicio);
    $date2 = date_create($final);

    if ($inicio == "") {
        $data['registros'] = $this->models_quincena->mostrar($inicio, $final, $offset, $this->limite);
        $config['base_url'] = base_url() . 'quincena/mostrar?inicial=' . $inicio . '&finali=' . $final;
        $config['total_rows'] = $this->models_quincena->mostrarcount($inicio, $final);
    } else {
        $data['registros'] = $this->models_quincena->mostrar(date_format($date1, 'Y-m-d'), date_format($date2, 'Y-m-d'), $offset, $this->limite);
        $config['base_url'] = base_url() . 'quincena/mostrar?inicial=' . date_format($date1, 'Y-m-d') . '&finali=' . date_format($date2, 'Y-m-d');
        $config['total_rows'] = $this->models_quincena->mostrarcount(date_format($date1, 'Y-m-d'), date_format($date2, 'Y-m-d'));
    }



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
        $datax['adminq'] = "active";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('quincena/listar', $data);
    }

    public function actualizar() {





        $idregistro = $this->input->get('idtipo');


        $f1 = "0000-00-00";
        if ($this->input->get('pagada') != "") {
            $f1 = $this->input->get('pagada');
        }
        $date1 = date_create($f1);

        $date2 = date_create($this->input->get('inicio'));
        $date3 = date_create($this->input->get('final'));


        $data = array(
            'inicio' => date_format($date2, 'Y-m-d'),
            'final' => date_format($date3, 'Y-m-d'),
            'pagada' => date_format($date1, 'Y-m-d'));

        $valor = $this->models_quincena->update($idregistro, $data);

        echo '<br><br>
        <div class="alert alert-warning">
        <h1> Se actualizo correctamente!</h1> 
        <button type="button" class="close" data-dismiss="alert">×</button>
        </div>';
    }

    public function editar() {


        $idregistro = $this->input->get('idquincena');
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
        $datax['adminq'] = "active";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $data['query'] = $this->models_quincena->Buscar($idregistro);

        $this->load->view('quincena/editar', $data);
    }

    public function actualizarestado() {

        $verificarEsta=$this->models_quincena->getBuscarActivos();
        $estado = $this->input->get('estado');
        if($verificarEsta==0||strcmp($estado,'Inactivo')== 0){
          $idregistro = $this->input->get('idquincena');
          $data = array(
            'estado' => $estado);

          $this->models_quincena->update($idregistro, $data);

          echo 1;

      }else{

        
       echo 0;
   }


    // redirect('quincena/mostrar', 'refresh');
}

}
