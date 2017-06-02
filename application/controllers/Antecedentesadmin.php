<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Antecedentesadmin extends CI_Controller {

  private $limite = 10;

  function __construct() {

    parent::__construct();
    $this->load->library('session');
    $this->load->library('encrypt');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('pagination');
    $this->load->library('form_validation');


//HOls
    $this->load->model('models_ave_avaluos_usuario');
    $this->load->model('models_grpave');

  }

  public function index() {


   $data['cadena'] = "";
   $this->load->view('loginAdmin', $data);
 }



 public function login() {

  $usuario = $this->input->post('usuario');
  $pass = $this->input->post('pass');
  $valor = $this->models_ave_avaluos_usuario->login($usuario, $pass);


  if ($valor->num_rows() != 0) {

    $row = $valor->row();
    $newdata = array(
      'nombre' => $row->nombre.' '.$row->apellido,
      'mail' => $row->mail,
      'idusuario' => $row->idusuario
      );

    $this->session->set_userdata($newdata);
    redirect('antecedentesadmin/captura', 'refresh');

  } else {
    $data['cadena'] = "error";

    $this->load->view('loginAdmin', $data);
  }
}


public function captura() {

  $data['msn'] = -1;
  $nombrez = $this->session->userdata('nombre');
  $datax['nombre'] = $nombrez;
  $datax['munocaptura'] = "active";
  $datax['menuConsulta'] = "x";
  $data['nombre'] = $nombrez;
  $data['idusuario'] = $this->session->userdata('idusuario');
  $data['menu'] = $this->load->view('plantillaantecendentesadmin/menu', $datax, true);
  $this->load->view('antecedentesadmin/registro', $data);
}

function registro() {

  if(!isset($_POST['calle'])) { 
   redirect(base_url().'antecedentesadmin/captura', 'refresh');
 }

 $new_nameAux =$_FILES['mi_archivo']['name'];
 $new_name=$this->normaliza($new_nameAux);
 $vowels = array(".pdf", ".PDF");
 $resultado = str_replace($vowels,"", $new_name);

 $countver = $this->models_grpave->getCountidGrpAve($resultado);

 if($countver==1){
  $data['msnError'] = 'El avalúo ya Existe';
  $data['msn'] = 0;
}else{

 $clusters = $this->config->item('clusters');
 $mi_archivo = 'mi_archivo';
 $config['upload_path'] = $clusters."avaluos/";
 $config['allowed_types'] = "pdf|PDF";
 $config['max_size'] = "50000";
 $config['overwrite'] = true;
 $config['file_name'] = $new_name;



 $this->load->library('upload', $config);

 if (!$this->upload->do_upload($mi_archivo)) {



   $file_type = $_FILES['mi_archivo']['type'];
   $allowed = array("application/pdf");
   if(!in_array($file_type, $allowed)) {

    $data['msnError'] = 'Formato de archivo no valido, al tratar de leer un pdf.';
  }

  $data['msn'] = 0;



}else{

    // Se debe de guardar los archivos 

  $calle = $this->input->post('calle');
  $colonia = $this->input->post('colonia');
  $cp = $this->input->post('cp');
  $delegacion = $this->input->post('delegacion');
  $entidad = $this->input->post('entidad');
  $ano = $this->input->post('ano');
  $tipo = $this->input->post('tipo');

  $data['msn'] = 1;

  $upload_data = $this->upload->data();

  $file_name = $upload_data['file_name'];


  $dataResults= array(
    'idGrpAve' =>$resultado,
    'calle' =>$calle,
    'colonia' =>$colonia,
    'cp' =>$cp,
    'delegacion' =>$delegacion,
    'entidad' =>$entidad,
    'fecha' =>$ano,
    'tipo' =>$tipo,
    'archivo' =>$file_name,
    'estado'=>'Capturado',
    'idusuario'=>$this->session->userdata('idusuario'));

  $valor = $this->models_grpave->insertar($dataResults);



   // echo $file_name;
}

}

$nombrez = $this->session->userdata('nombre');
$datax['nombre'] = $nombrez;
$datax['munocaptura'] = "active";
$datax['menuConsulta'] = "x";
$data['nombre'] = $nombrez;
$data['idusuario'] = $this->session->userdata('idusuario');
$data['menu'] = $this->load->view('plantillaantecendentesadmin/menu', $datax, true);
$this->load->view('antecedentesadmin/registro', $data);
}

function normaliza($cadena){
  $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
  ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
  $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
  bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
  $cadena = utf8_decode($cadena);
  $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
  $cadena = strtolower($cadena);
  return utf8_encode($cadena);
}

public function consulta() {


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
  $config['base_url'] = base_url() . 'antecedentesadmin/consulta?idGrpAve=' . $id.'&calle='.$calle.'&colonia='.$colonia.'&cp='.$cp.'&delegacion='.$delegacion.'&entidad='.$entidad.'&fecha='.$fecha.'&tipo='.$tipo.'&usuario='.$usuario.'&inicio='.$inicio.'&final='.$final;
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
        $nombrez = $this->session->userdata('nombre');
        $datax['nombre'] = $nombrez;
        $datax['munocaptura'] = "x";
        $datax['menuConsulta'] = "active";
        $data['nombre'] = $nombrez;
        $data['total'] =  $tt;
        $data['idusuario'] = $this->session->userdata('idusuario');

        $data['menu'] = $this->load->view('plantillaantecendentesadmin/menu', $datax, true);
        $this->load->view('antecedentesadmin/listar', $data);
      }


      public function busqueda() {



        $nombrez = $this->session->userdata('nombre');
        $datax['nombre'] = $nombrez;
        $datax['munocaptura'] = "x";
        $datax['menuConsulta'] = "active";
        $data['nombre'] = $nombrez;
        $data['idusuario'] = $this->session->userdata('idusuario');
        $data['usuarios'] = $this->models_grpave->getUsuario();

        $data['menu'] = $this->load->view('plantillaantecendentesadmin/menu', $datax, true);
        $this->load->view('antecedentesadmin/busqueda', $data);
      }


      public function editar() {


        $id = trim($this->input->get('idGrpAve'));

        if (isset($_GET['op']) && !empty($_GET['op'])) {
          $data['msn'] = 0;
          $data['msnError'] = 'Formato de archivo no valido, al tratar de leer un pdf.';
        }else{
         $data['msn'] = -1;
       }
       $nombrez = $this->session->userdata('nombre');
       $datax['nombre'] = $nombrez;
       $datax['munocaptura'] = "x";
       $datax['menuConsulta'] = "active";
       $data['nombre'] = $nombrez;
       $data['idGrpAve'] = $id;
       $data['idusuario'] = $this->session->userdata('idusuario');
       $data['usuarios'] = $this->models_grpave->getUsuario();
       $data['query'] = $this->models_grpave->Buscar($id);

       $data['menu'] = $this->load->view('plantillaantecendentesadmin/menu', $datax, true);
       $this->load->view('antecedentesadmin/editar', $data);
     }

     public function actualizar() {


      $idGrpAve = $this->input->post('idGrpAve');






      if (isset($_FILES['mi_archivo']['name']) && !empty($_FILES['mi_archivo']['name'])) {





        $new_nameAux =$_FILES['mi_archivo']['name'];
        $new_name=$this->normaliza($new_nameAux);

        $clusters = $this->config->item('clusters');
        $mi_archivo = 'mi_archivo';
        $config['upload_path'] = $clusters."avaluos/";
        $config['allowed_types'] = "pdf|PDF";
        $config['max_size'] = "50000";
        $config['overwrite'] = true;
        $config['file_name'] = $new_name;



        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($mi_archivo)) {



         $file_type = $_FILES['mi_archivo']['type'];
         $allowed = array("application/pdf");
         if(!in_array($file_type, $allowed)) {



          redirect('antecedentesadmin/editar?idGrpAve='.$idGrpAve.'&op=error', 'refresh');
        }





      }else{


       $upload_data = $this->upload->data();

       $file_name = $upload_data['file_name'];


       $dataResults= array(
        'archivo' =>$file_name,
        'dropbox'=>0,
        'urlDropbox'=>null);

       $valor = $this->models_grpave->update($idGrpAve ,$dataResults);

     }


   }



   $calle = $this->input->post('calle');
   $colonia = $this->input->post('colonia');
   $cp = $this->input->post('cp');
   $delegacion = $this->input->post('delegacion');
   $entidad = $this->input->post('entidad');
   $ano = $this->input->post('ano');
   $tipo = $this->input->post('tipo');


   $dataResultsx= array(
    'calle' =>$calle,
    'colonia' =>$colonia,
    'cp' =>$cp,
    'delegacion' =>$delegacion,
    'entidad' =>$entidad,
    'fecha' =>$ano,
    'tipo' =>$tipo,
    'estado'=>'Capturado',
    'idusuario'=>$this->session->userdata('idusuario'));

   $valor = $this->models_grpave->update($idGrpAve,$dataResultsx);
   

   redirect('antecedentesadmin/consulta', 'refresh');

 }

 public function eliminar() {

  $hoy = date("Ymd");   
  $id = trim($this->input->get('idGrpAve'));
  $dataResultsx= array(
    'idGrpAve' =>$id.'-'.$hoy,
    'estado'=>'Eliminar',
    'idusuario'=>$this->session->userdata('idusuario'));
  $valor = $this->models_grpave->update($id,$dataResultsx);

  redirect('antecedentesadmin/consulta', 'refresh');

}


}
