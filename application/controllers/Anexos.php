<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Anexos extends CI_Controller {

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
//somos expertos dos en dos


        $this->load->model('models_archivos');
        $this->load->model('models_comentario');
    }

    public function eliminararchivo() {

        if (!isset($_SESSION)) {
            session_start();
        }
        $tipo = $this->input->get('tipo');
       // 
        $idarchivo= $this->input->get('idarchivo');
        $query=$this->models_archivos->Buscar($idarchivo);
        $row = $query->row();
        $file = 'subir/server/php/files/'.$row->url;
        if (file_exists($file)) {
            if (!unlink($file)) {
               echo ("Error deleting $file");
           }
       }

       $dataxx = array('estado' => 0);

       $this->models_archivos->update($idarchivo,$dataxx);


        if($tipo==1){

            redirect('anexos/acreditado?idregistro=' . $_SESSION["idregistro"], 'refresh');
        }
        if($tipo==2){

            redirect('anexos/predial?idregistro=' . $_SESSION["idregistro"], 'refresh');
        }
        if($tipo==3){

            redirect('anexos/escritura?idregistro=' . $_SESSION["idregistro"], 'refresh');
        }
        if($tipo==4){

            redirect('anexos/plano?idregistro=' . $_SESSION["idregistro"], 'refresh');
        }
        if($tipo==5){

            redirect('anexos/vendedor?idregistro=' . $_SESSION["idregistro"], 'refresh');
        }
        if($tipo==6){

            redirect('anexos/boletaagua?idregistro=' . $_SESSION["idregistro"], 'refresh');
        }
        if($tipo==7){

            redirect('anexos/licencia?idregistro=' . $_SESSION["idregistro"], 'refresh');
        }
        if($tipo==8){

            redirect('anexos/fotos?idregistro=' . $_SESSION["idregistro"], 'refresh');
        }





    }



    public function update() {


        if (!isset($_SESSION)) {
            session_start();
        }
        try {

           /// inicia trasaccion 
           $tipo = $this->input->post('tipo');
           $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
           $name_array = array();
           $count = count($_FILES['userfile']['size']);



           foreach ($_FILES as $key => $value){
            for ($s = 0; $s <= $count - 1; $s++) {
                $valor = $this->models_archivos->limpiar($value['name'][$s]);
                $_FILES['userfile']['name'] = $tipo . '_' . $_SESSION["idregistro"] . '_' . $valor;
                $_FILES['userfile']['type'] = $value['type'][$s];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['userfile']['error'] = $value['error'][$s];
                $_FILES['userfile']['size'] = $value['size'][$s];
                $config['upload_path'] = './';
                $config['allowed_types'] = 'gif|jpg|png|pdf|PDF|xls|xlsx|xlsm|dwg';
                $config['max_size'] = '10000';
               /* $config['max_width'] = '2000';
               $config['max_height'] = '2000';*/

               $this->load->library('upload', $config);
               if (!$this->upload->do_upload()) {
                $data_error = array('msg' => $this->upload->display_errors());

// Error al subir archivo
                echo "".$data_error;

            } else {
                $data = $this->upload->data();

                $name_array[] = $data['file_name'];

                if (file_exists('dropbox/vendor/autoload.php')) {
                    require 'dropbox/vendor/autoload.php';
                    require 'dropbox/backup.php';

                //set access token
                    $token = 'SdvpGtPWBpMAAAAAAAAAjjhjIpmgi3CdcC6L9IrXLdrKc0E3cgLB06DUhYKJ6V1v';
                    $project = 'Ave/archivos';
                    $projectFolder = 'anexos';


                    foreach ($name_array as $valor) {
                    // echo "Valor: $valor<br />\n";
                        $bk = new Backup($token, $project, $projectFolder);
                        $bk->upload($valor);
                    //$bk->eliminar('nuva');
                        $file = './' . $valor;
                    //echo $file;
                    //$file = "test.txt";
                        if (!unlink($file)) {
                        //   echo ("Error deleting $file");
                        } else {


                            $dataxx = array(
                                'url' => $valor,
                                'descripcion' => $valor,
                                'idregistro' => $_SESSION["idregistro"],
                                'usuario' => $nombrez,
                                'tipo' => $tipo);

                            $this->models_archivos->insertar($dataxx);


// redirecionar 
                            if ($tipo == 1) {
                                redirect('anexos/acreditado?idregistro=' . $_SESSION["idregistro"], 'refresh');
                            }if ($tipo == 2) {
                                redirect('anexos/predial?idregistro=' . $_SESSION["idregistro"], 'refresh');
                            }
                            if ($tipo == 3) {
                                redirect('anexos/escritura?idregistro=' . $_SESSION["idregistro"], 'refresh');
                            }
                            if ($tipo == 4) {
                                redirect('anexos/plano?idregistro=' . $_SESSION["idregistro"], 'refresh');
                            }
                            if ($tipo == 5) {
                                redirect('anexos/vendedor?idregistro=' . $_SESSION["idregistro"], 'refresh');
                            }
                            if ($tipo == 6) {
                                redirect('anexos/boletaagua?idregistro=' . $_SESSION["idregistro"], 'refresh');
                            }
                            if ($tipo == 7) {
                                redirect('anexos/licencia?idregistro=' . $_SESSION["idregistro"], 'refresh');
                            }
                            if ($tipo == 8) {
                                redirect('anexos/fotos?idregistro=' . $_SESSION["idregistro"], 'refresh');
                            }




                        //echo ("Deleted $file");
                        }
                    }




                }







            }
        }
    }



} catch (Exception $e) {

  foreach ($name_array as $valorc) {

    $filec = './' . $valorc;
    if (!unlink($filec)) {
           // echo ("Error deleting $filec");
    } else {

    }
}

echo "Elimino correctamente el archivo";
}


}

public function acreditado() {

    if (!isset($_SESSION)) {
        session_start();
    }


    $offset = $this->input->get('per_page');
    $idregistro = $this->input->get('idregistro');
    $tipo = 1;
        $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_archivos->mostrar($nombre, $idregistro, $tipo, $offset, $this->limite);
        $total = $this->models_archivos->mostrarcount($nombre, $idregistro, $tipo);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/acreditado?nombre=' . $nombre . '&idregistro=' . $idregistro;
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

        $data['linkarchivo'] = 'usuario='.str_replace(" ", "_", $nombrez)."&idregistro=".$idregistro ;

        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['tipoarchivo'] = $tipo;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;


        $this->load->view('anexos/listar', $data);
    }

    public function predial() {

        if (!isset($_SESSION)) {
            session_start();
        }


        $offset = $this->input->get('per_page');
        $idregistro = $this->input->get('idregistro');
        $tipo = 2;
        $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_archivos->mostrar($nombre, $idregistro, $tipo, $offset, $this->limite);
        $total = $this->models_archivos->mostrarcount($nombre, $idregistro, $tipo);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/predial?nombre=' . $nombre . '&idregistro=' . $idregistro;
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
        $data['linkarchivo'] = 'usuario='.str_replace(" ", "_", $nombrez)."&idregistro=".$idregistro ;
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['tipoarchivo'] = $tipo;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;
        $this->load->view('anexos/predial', $data);
    }

    public function escritura() {

        if (!isset($_SESSION)) {
            session_start();
        }


        $offset = $this->input->get('per_page');
        $idregistro = $this->input->get('idregistro');
        $tipo = 3;
        $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_archivos->mostrar($nombre, $idregistro, $tipo, $offset, $this->limite);
        $total = $this->models_archivos->mostrarcount($nombre, $idregistro, $tipo);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/escritura?nombre=' . $nombre . '&idregistro=' . $idregistro;
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
        $data['linkarchivo'] = 'usuario='.str_replace(" ", "_", $nombrez)."&idregistro=".$idregistro ;
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['tipoarchivo'] = $tipo;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;
        $this->load->view('anexos/escritura', $data);
    }

    public function plano() {

        if (!isset($_SESSION)) {
            session_start();
        }


        $offset = $this->input->get('per_page');
        $idregistro = $this->input->get('idregistro');
        $tipo = 4;
        $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_archivos->mostrar($nombre, $idregistro, $tipo, $offset, $this->limite);
        $total = $this->models_archivos->mostrarcount($nombre, $idregistro, $tipo);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/plano?nombre=' . $nombre . '&idregistro=' . $idregistro;
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
        $data['linkarchivo'] = 'usuario='.str_replace(" ", "_", $nombrez)."&idregistro=".$idregistro ;
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['tipoarchivo'] = $tipo;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;
        $this->load->view('anexos/plano', $data);
    }

    public function vendedor() {

        if (!isset($_SESSION)) {
            session_start();
        }


        $offset = $this->input->get('per_page');
        $idregistro = $this->input->get('idregistro');
        $tipo = 5;
        $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_archivos->mostrar($nombre, $idregistro, $tipo, $offset, $this->limite);
        $total = $this->models_archivos->mostrarcount($nombre, $idregistro, $tipo);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/vendedor?nombre=' . $nombre . '&idregistro=' . $idregistro;
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
        $data['linkarchivo'] = 'usuario='.str_replace(" ", "_", $nombrez)."&idregistro=".$idregistro ;
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['tipoarchivo'] = $tipo;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;
        $this->load->view('anexos/vendedor', $data);
    }

    public function boletaagua() {

        if (!isset($_SESSION)) {
            session_start();
        }


        $offset = $this->input->get('per_page');
        $idregistro = $this->input->get('idregistro');
        $tipo = 6;
        $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_archivos->mostrar($nombre, $idregistro, $tipo, $offset, $this->limite);
        $total = $this->models_archivos->mostrarcount($nombre, $idregistro, $tipo);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/boletaagua?nombre=' . $nombre . '&idregistro=' . $idregistro;
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
        $data['linkarchivo'] = 'usuario='.str_replace(" ", "_", $nombrez)."&idregistro=".$idregistro ;
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['tipoarchivo'] = $tipo;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;
        $this->load->view('anexos/boletaagua', $data);
    }

    public function licencia() {

        if (!isset($_SESSION)) {
            session_start();
        }


        $offset = $this->input->get('per_page');
        $idregistro = $this->input->get('idregistro');
        $tipo = 7;
        $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_archivos->mostrar($nombre, $idregistro, $tipo, $offset, $this->limite);
        $total = $this->models_archivos->mostrarcount($nombre, $idregistro, $tipo);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/licencia?nombre=' . $nombre . '&idregistro=' . $idregistro;
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
        $data['linkarchivo'] = 'usuario='.str_replace(" ", "_", $nombrez)."&idregistro=".$idregistro ;
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['tipoarchivo'] = $tipo;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;
        $this->load->view('anexos/licencia', $data);
    }


    public function fotos() {

        if (!isset($_SESSION)) {
            session_start();
        }


        $offset = $this->input->get('per_page');
        $idregistro = $this->input->get('idregistro');
        $tipo = 8;
        $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_archivos->mostrar($nombre, $idregistro, $tipo, $offset, $this->limite);
        $total = $this->models_archivos->mostrarcount($nombre, $idregistro, $tipo);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/fotos?nombre=' . $nombre . '&idregistro=' . $idregistro;
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
        $data['linkarchivo'] = 'usuario='.str_replace(" ", "_", $nombrez)."&idregistro=".$idregistro ;
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['tipoarchivo'] = $tipo;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;
        $this->load->view('anexos/fotos', $data);
    }

    public function comentario() {

        if (!isset($_SESSION)) {
            session_start();
        }


        $offset = $this->input->get('per_page');
        $idregistro = $this->input->get('idregistro');

        // $_SESSION["idregistro"] = $idregistro; // se va asesion
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idempleado = $this->session->userdata('idempleado');
        $nombre = trim($this->input->get('buscar'));
        $data['registros'] = $this->models_comentario->mostrar($nombre, $idregistro, $offset, $this->limite);
        $total = $this->models_comentario->mostrarcount($nombre, $idregistro);
        $data['total'] = $total;
        $config['base_url'] = base_url() . 'anexos/comentario?nombre=' . $nombre . '&idregistro=' . $idregistro;
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
        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $idempleado;
        $data['idregistro'] = $idregistro;
        $data['puesto'] = $this->session->userdata('puesto');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $consulta=$this->models_archivos->countArchivos($idregistro);
        $arrayArchivoscount = array();
        if (isset($consulta)) {
            foreach ($consulta->result() as $rowx) {
                $arrayArchivoscount["tipo_".$rowx->tipo]=$rowx->num;
                
                

            }
        }
        $data['arryCount'] = $arrayArchivoscount;
        $this->load->view('anexos/comentarios', $data);
    }

    public function guaradarcomentario() {
        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        $idregistro = $this->input->post('idregistro');
        $valor = $this->input->post('valor');
        $dataxx = array('idregistro' => $idregistro,
            'comentario' => $valor,
            'usuario' => $nombrez);
        $this->models_comentario->insertar($dataxx);
        redirect('anexos/comentario?idregistro=' . $_SESSION["idregistro"], 'refresh');
    }

    public function actualizarDropbox() {

       $consulta=$this->models_archivos->carSer();

       if (isset($consulta)) {
        foreach ($consulta->result() as $rowx) {
            $idarcg=$rowx->idarchivos;
           // echo $idarcg;
            $dataxx = array(
                'dropbox' => 1);

            $this->models_archivos->update($idarcg,$dataxx);

        }
        echo "Finalizo";
    }
}

}

