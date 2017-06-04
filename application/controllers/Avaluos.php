<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Avaluos extends CI_Controller {

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
        /*$idpuesto = $this->session->userdata('idcat_puesto');
        if ($idpuesto != 1&&$idpuesto != 6) {

           redirect('registro', 'refresh');
        }*/

        $this->load->model('models_avaluos');
        $this->load->model('models_empleado');
        $this->load->model('models_quincena');
    }

    public function index() {

        $data['msn'] = -1;
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
        $datax['admina'] = "active";
        
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $data['empleados'] = $this->models_empleado->get();
        $data['quincenas'] = $this->models_quincena->getactivos();
        $this->load->view('avaluos/registro', $data);
    }

    public function registro() {


        $valor = $this->models_avaluos->BuscarExistencia($this->input->post('avaluo'), $this->input->post('idEmpleado'));

        if ($valor == "-") {
            $data = array(
                'idempleado' => $this->input->post('idEmpleado'),
                'idquincena' => $this->input->post('idquincena'),
                'tipo' => $this->input->post('tipo'),
                'numero' => $this->input->post('avaluo'));

            $this->models_avaluos->insertar($data);
            echo '<div class="block"><div class="alert alert-success"><h1> <b>Registro!</b> Se registro correctamente!</h1> <button type="button" class="close" data-dismiss="alert">×</button></div></div>';
        } else {

            echo '<div class="block"><div class="alert alert-danger"><h1> <b>Error!</b> Ya está registrado este avaluó al empleado ' . $valor->Nombre . ' ' . $valor->apellidos . '</h1><button type="button" class="close" data-dismiss="alert">×</button></div></div>';
        }
    }

    public function mostrar() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }

        $nombre = trim($this->input->get('nombre'));
        $empleado = trim($this->input->get('empleado'));
        $data['registros'] = $this->models_avaluos->mostrar($nombre,$empleado, $offset, $this->limite);
        $total = $this->models_avaluos->mostrarcount($nombre,$empleado);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'avaluos/mostrar?nombre=' . $nombre.'&empleado='.$empleado;
        $config['total_rows'] = $total;
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
        $datax['admina'] = "active";
        
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('avaluos/listar', $data);
    }

    public function eliminar() {
        $idregistro = $this->input->get('idavaluos');
        $this->models_avaluos->eliminar($idregistro);

        //redirect('avaluos/mostrar', 'refresh');
    }

}
