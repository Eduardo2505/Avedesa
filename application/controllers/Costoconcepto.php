<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Costoconcepto extends CI_Controller {

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


        $this->load->model('models_costo_concepto');
        $this->load->model('models_concepto');
        $this->load->model('models_empleado');
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
        $datax['admincc'] = "active";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);

        $data['conceptos'] = $this->models_concepto->get();
        $data['empleados'] = $this->models_empleado->get();
        $this->load->view('costoconcepto/registro', $data);
    }

    public function registro() {




        $data = array(
            'idconcepto' => $this->input->post('idconcepto'),
            'idempleado' => $this->input->post('idempleado'),
            'costo' => $this->input->post('costo'));

        $valor = $this->models_costo_concepto->insertar($data);



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
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "active";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('costoconcepto/registro', $data);
    }

    public function mostrar() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }

        $concepto = trim($this->input->get('concepto'));
        $empleado = trim($this->input->get('empelado'));
        $data['registros'] = $this->models_costo_concepto->mostrar($concepto, $empleado, $offset, $this->limite);

        $config['base_url'] = base_url() . 'costoconcepto/mostrar?concepto=' . $concepto . '&empleado=' . $empleado;
        $config['total_rows'] = $this->models_costo_concepto->mostrarcount($concepto, $empleado);
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
        $datax['admincc'] = "active";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('costoconcepto/listar', $data);
    }

    public function eliminar() {

        $idregistro = $this->input->get('id');
        $this->models_costo_concepto->eliminar($idregistro);
        // redirect('costoconcepto/mostrar', 'refresh');
    }

    public function actualizar() {





        $idregistro = $this->input->get('idtipo');

        $data = array(
            'idconcepto' => $this->input->get('idconcepto'),
            'idempleado' => $this->input->get('idempleado'),
            'costo' => $this->input->get('costo'));

        $valor = $this->models_costo_concepto->update($idregistro, $data);

        echo '<br><br>
                                    <div class="alert alert-warning">
                                        <h1> Se actualizo correctamente!</h1> 
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                    </div>';
    }

    public function editar() {


        $idregistro = $this->input->get('id');
        $data['conceptos'] = $this->models_concepto->get();
        $data['empleados'] = $this->models_empleado->get();
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
        $datax['admincc'] = "active";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $data['query'] = $this->models_costo_concepto->Buscar($idregistro);

        $this->load->view('costoconcepto/editar', $data);
    }

}
