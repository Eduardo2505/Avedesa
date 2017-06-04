<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado extends CI_Controller {

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


        $this->load->model('models_empleado');
        $this->load->model('models_empresa');
        $this->load->model('models_cat_puesto');
        $this->load->model('models_asig_puesto');
    }

    public function nuevo() {

        $data['msn'] = -1;
        $data['empresas'] = $this->models_empresa->get();
        $data['puestox'] = $this->models_cat_puesto->get();
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');

        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menusolicitudes'] = "x";
        $datax['menucatalogos'] = "active";
        $datax['menuadmin'] = "x";
        $datax['solictudesbus'] = "x";
        $datax['solictudesnuevo'] = "x";
        $datax['solictudesver'] = "x";
        $datax['catalogost'] = "x";
        $datax['catalogoso'] = "x";
        $datax['catalogose'] = "x";
        $datax['catalogosp'] = "x";
        $datax['catalogosem'] = "X";
        $datax['catalogoemp'] = "active";
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        //$data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('empleado/registro', $data);
    }

    public function registro() {

        $num = $this->input->post('Nombre');

        if (!empty($num)) {




            $data = array(
                'Nombre' => $this->input->post('Nombre'),
                'apellidos' => $this->input->post('apellidos'),
                'iniciales' => $this->input->post('iniciales'),
                'email' => $this->input->post('email'),
                'pass' => "123",
                'estado' => $this->input->post('estado'),
                'color' => $this->input->post('color'),
                'idempresa' => $this->input->post('idempresa'));


            $numero = $this->input->post('numero');

            $valor = $this->models_empleado->insertar($data, $numero);

            $data['msn'] = 1;
        } else {
            $data['msn'] = -1;
        }
        $data['empresas'] = $this->models_empresa->get();
        $data['puestox'] = $this->models_cat_puesto->get();
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');

        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menusolicitudes'] = "x";
        $datax['menucatalogos'] = "active";
        $datax['menuadmin'] = "x";
        $datax['solictudesbus'] = "x";
        $datax['solictudesnuevo'] = "x";
        $datax['solictudesver'] = "x";
        $datax['catalogost'] = "x";
        $datax['catalogoso'] = "x";
        $datax['catalogose'] = "x";
        $datax['catalogosp'] = "x";
        $datax['catalogosem'] = "X";
        $datax['catalogoemp'] = "active";
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        ////$data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('empleado/registro', $data);
    }

    public function mostrar() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }

        $nombre = trim($this->input->get('nombre'));
        $data['registros'] = $this->models_empleado->mostrar($nombre,"estado in(1,0)", $offset, $this->limite);

        $config['base_url'] = base_url() . 'empleado/mostrar?nombre=' . $nombre;
        $config['total_rows'] = $this->models_empleado->mostrarcount($nombre,"estado in(1,0)");
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
        $datax['menucatalogos'] = "active";
        $datax['menuadmin'] = "x";
        $datax['solictudesbus'] = "x";
        $datax['solictudesnuevo'] = "x";
        $datax['solictudesver'] = "x";
        $datax['catalogost'] = "x";
        $datax['catalogoso'] = "x";
        $datax['catalogose'] = "x";
        $datax['catalogosp'] = "x";
        $datax['catalogosem'] = "X";
        $datax['catalogoemp'] = "active";
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        //$data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('empleado/listar', $data);
    }

    public function actualizar() {





        $idregistro = $this->input->get('idEmpleado');



        if ($this->input->get('pass') == 1) {

            $data = array(
                'Nombre' => $this->input->get('Nombre'),
                'apellidos' => $this->input->get('apellidos'),
                'iniciales' => $this->input->get('iniciales'),
                'pass' => "123",
                'email' => $this->input->get('email'),
                'color' => $this->input->get('color'),
                'estado' => $this->input->get('estado'),
                'idempresa' => $this->input->get('idempresa'));
        } else {
            $data = array(
                'Nombre' => $this->input->get('Nombre'),
                'apellidos' => $this->input->get('apellidos'),
                'iniciales' => $this->input->get('iniciales'),
                'email' => $this->input->get('email'),
                'estado' => $this->input->get('estado'),
                'color' => $this->input->get('color'),
                'idempresa' => $this->input->get('idempresa'));
        }


        $numero = $this->input->get('numero');

        $valor = $this->models_empleado->update($idregistro, $data, $numero);

        echo '<br><br>
                                    <div class="alert alert-warning">
                                        <h1> Se actualizo correctamente!</h1> 
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                    </div>';
    }

    public function editar() {


        $idregistro = $this->input->get('idregistro');

        //echo $idregistro;
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');

        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $datax['menusolicitudes'] = "x";
        $datax['menucatalogos'] = "active";
        $datax['menuadmin'] = "x";
        $datax['solictudesbus'] = "x";
        $datax['solictudesnuevo'] = "x";
        $datax['solictudesver'] = "x";
        $datax['catalogost'] = "x";
        $datax['catalogoso'] = "x";
        $datax['catalogose'] = "x";
        $datax['catalogosp'] = "x";
        $datax['catalogosem'] = "X";
        $datax['catalogoemp'] = "active";
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        //$data['head'] = $this->load->view('plantilla/head', true);
        $data['empresas'] = $this->models_empresa->get();
        $data['puestox'] = $this->models_cat_puesto->get();
        $datInfo = $this->models_empleado->puestoEmpleados($idregistro);
        $pila = array();
        if (isset($datInfo)) {
            foreach ($datInfo->result() as $row) {
                array_push($pila, $row->idcat_puesto);
            }
        }

        $data['idpuestos'] = $pila;
        $data['query'] = $this->models_empleado->Buscar($idregistro);

        $this->load->view('empleado/editar', $data);
    }

    public function privilegios() {
        $idempleado = $this->input->get('idempleado');
        $data['priviledios'] = $this->models_empleado->puestoEmpleados($idempleado);
        $info = $this->load->view('empleado/privilegios', $data, true);

        echo $info;
    }

}
