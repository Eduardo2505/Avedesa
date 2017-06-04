<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Antecedentesa extends CI_Controller {

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

//HOls
        $this->load->model('models_grpave');

    }

    public function index() {


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
        $datax['catalogose'] = "active";
        $datax['catalogosp'] = "x";
        $datax['catalogosem'] = "x";
        $datax['catalogoemp'] = "x";
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";
        $datax['menuantecedentes'] = "active";
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['usuarios'] = $this->models_grpave->getUsuario();
        $pila = $this->session->userdata('listpuesto');
        $clave = array_search('8',$pila); 

        $boolenVer=0;;
        if($clave!=''){
           $boolenVer=1;
       }
       $datax['verSolicitudesBusqueda']=$boolenVer;
       $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
       $this->load->view('antecedentes/busquedaa', $data);
   }



   public function mostrar() {


    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }

    $id = trim($this->input->get('idGrpAve'));
    $calle = trim($this->input->get('calle'));
    $colonia = trim($this->input->get('colonia'));
    $cp = trim($this->input->get('cp'));
    $delegacion = trim($this->input->get('delegacion'));
    $entidad = trim($this->input->get('entidad'));
    $fecha = trim($this->input->get('fecha'));
    $tipo = trim($this->input->get('tipo'));

    $usuario= trim($this->input->get('usuario'));
    $inicio = trim($this->input->get('inicio'));
    $final = trim($this->input->get('final'));

    $data['registros'] = $this->models_grpave->mostrar($usuario,$inicio,$final,$id,$calle,$colonia,$cp,$delegacion,$entidad,$fecha,$tipo, $offset, $this->limite);
    $config['base_url'] = base_url() . 'antecedentesa/mostrar?idGrpAve=' . $id.'&calle='.$calle.'&colonia='.$colonia.'&cp='.$cp.'&delegacion='.$delegacion.'&entidad='.$entidad.'&fecha='.$fecha.'&tipo='.$tipo.'&usuario='.$usuario.'&inicio='.$inicio.'&final='.$final;
    $tt = $this->models_grpave->mostrarcount($usuario,$inicio,$final,$id,$calle,$colonia,$cp,$delegacion,$entidad,$fecha,$tipo);
    $config['total_rows']= $tt;
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
        $datax['menuadmin'] = "x";
        $datax['solictudesbus'] = "x";
        $datax['solictudesnuevo'] = "x";
        $datax['solictudesver'] = "x";
        $datax['catalogost'] = "x";
        $datax['catalogoso'] = "x";
        $datax['catalogose'] = "active";
        $datax['catalogosp'] = "x";
        $datax['catalogosem'] = "x";
        $datax['catalogoemp'] = "x";
        $datax['adminq'] = "x";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";
        $datax['menuantecedentes'] = "active";
        $data['nombre'] = $nombrez;
        $data['total'] =  $tt;
        $data['idcapturista'] = $this->session->userdata('idempleado');

        $pila = $this->session->userdata('listpuesto');
        $clave = array_search('8',$pila); 

        $boolenVer=0;;
        if($clave!=''){
           $boolenVer=1;
       }
       $datax['verSolicitudesBusqueda']=$boolenVer;

       $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
       $this->load->view('antecedentes/listara', $data);
   }




}
