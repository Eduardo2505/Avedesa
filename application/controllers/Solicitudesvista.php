<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudesvista extends CI_Controller {

  private $limite = 10;

  function __construct() {

    parent::__construct();
    $this->load->library('session');       
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('encrypt');
    $this->load->library('pagination');       

    $this->load->model('models_tipo_avaluo');
    $this->load->model('models_objetivo_avaluo');
    $this->load->model('models_empleado');
    $this->load->model('models_estado_registro');
    $this->load->model('models_registro');
    $this->load->model('models_log');
    $this->load->model('models_estado_empleado');
  }

  public function index() {

    $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
    $datax['nombre'] = $nombrez;
    $datax['puesto'] = $this->session->userdata('puesto');

    $datax['menusolicitudesver'] = "active";


    $data['nombre'] = $nombrez;
    $data['idcapturista'] = $this->session->userdata('idempleado');
    $pila = $this->session->userdata('listpuesto');
    $clave = array_search('8',$pila); 

    $boolenVer=0;;
    if($clave!=''){
     $boolenVer=1;
   }
   $datax['verSolicitudesBusqueda']=$boolenVer;

   $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);

   $data['tipo_avaluo'] = $this->models_tipo_avaluo->get();
   $data['objetivo_avaluo'] = $this->models_objetivo_avaluo->get();
   $data['empleados'] = $this->models_empleado->getInspector();
   $data['capturista'] = $this->models_empleado->capturista();

   $data['urlBusqueda'] ="".site_url('')."solicitudesvista/mostrar";

   $data['titulos'] = '<li>
   <i class="fa fa-home"></i>
   <a href="'.site_url('').'solicitudesvista">NUEVA BUSQUEDA</a>
   <i class="fa fa-angle-right"></i>
 </li>                            
 <li>
  <a href="'.site_url('').'solicitudesvista/mostrar">VER SOLICITUDES</a>
</li>';


$data['estado_registro'] = $this->models_estado_registro->get();

$this->load->view('welcome_message', $data);
}


public function mostrar() {


  $offset = $this->input->get('per_page');
  $uri_segment = 0;
  if ($offset == "") {
    $offset = 0;
  }



  $folio = $this->input->get('folio');
  $numava = $this->input->get('numavaluo');
  $numExpediente = $this->input->get('numExpediente');
  $nomRefer = $this->input->get('nomRefer');
  $telefono = $this->input->get('telefono');
  $email = $this->input->get('email');
  $tipo_avaluo = $this->input->get('tipo_avaluo');
  $objetivoAvaluo = $this->input->get('objetivoAvaluo');
  $otros = $this->input->get('otros');
  $ubicacion = $this->input->get('ubicacion');

  $costo = str_replace(".", "", $this->input->get('costo'));


  $fecha_de_inspeccion_inicial = "";
  $fecha_de_inspeccion_final = "";

  if ($this->input->get('fecha_de_inspeccion_inicio') != "") {
    $date1 = date_create($this->input->get('fecha_de_inspeccion_inicio'));
    $fecha_de_inspeccion_inicial = date_format($date1, 'Y-m-d');
    $date2 = date_create($this->input->get('fecha_de_inspeccion_final'));
    $fecha_de_inspeccion_final = date_format($date2, 'Y-m-d');
  }

  $fecha_de_entrega_inicial = "";
  $fecha_de_entrega_finali = "";
  if ($this->input->get('fecha_de_entrega_inicial') != "") {
    $date3 = date_create($this->input->get('fecha_de_entrega_inicial'));
    $fecha_de_entrega_inicial = date_format($date3, 'Y-m-d');
    $date4 = date_create($this->input->get('fecha_de_entrega_finali'));
    $fecha_de_entrega_finali = date_format($date4, 'Y-m-d');
  }


  $fecha_asigancion_inicia = "";
  $fecha_asigancion_finali = "";
  if ($this->input->get('fecha_asigancion_inicial') != "") {
    $date5 = date_create($this->input->get('fecha_asigancion_inicial'));
    $fecha_asigancion_inicia = date_format($date5, 'Y-m-d');
    $date6 = date_create($this->input->get('fecha_asigancion_finali'));
    $fecha_asigancion_finali = date_format($date6, 'Y-m-d');
  }

  $fecha_captura_inicial = "";
  $fecha_captura_finali = "";
  if ($this->input->get('fecha_captura_inicial') != "") {
    $date7 = date_create($this->input->get('fecha_captura_inicial'));
    $fecha_captura_inicial = date_format($date7, 'Y-m-d');
    $date8 = date_create($this->input->get('fecha_captura_finali'));
    $fecha_captura_finali = date_format($date8, 'Y-m-d');
  }

  $fecha_cierre_inicial = "";
  $fecha_cierre_finali = "";
  if ($this->input->get('fecha_cierre_inicial') != "") {
    $date9 = date_create($this->input->get('fecha_cierre_inicial'));
    $fecha_cierre_inicial = date_format($date9, 'Y-m-d');
    $date10 = date_create($this->input->get('fecha_cierre_finali'));
    $fecha_cierre_finali = date_format($date10, 'Y-m-d');
  }

  $registro_inicial_inicial = "";
  $registro_inicial_finali = "";
  if ($this->input->get('registro_inicial_inicial') != "") {
    $date11 = date_create($this->input->get('registro_inicial_inicial') . ' 00:00:00');
    $registro_inicial_inicial = date_format($date11, 'Y-m-d H:i:s');
    $date12 = date_create($this->input->get('registro_inicial_finali') . ' 23:59:00');
    $registro_inicial_finali = date_format($date12, 'Y-m-d H:i:s');
  }









  $hora_de_inspeccion = "";
  if ($this->input->get('hora_de_inspeccion') != "") {
    $date2 = date_create($this->input->get('hora_de_inspeccion'));
    $hora_de_inspeccion = date_format($date2, 'H:i:s');
  }


  $idempleado = $this->input->get('idempleado');
  $monto_credito = str_replace(".", "", $this->input->get('monto_credito'));
  $monto_venta = str_replace(".", "", $this->input->get('monto_venta'));
  $intermediario = $this->input->get('intermediario');
        $idcapturista = $this->input->get('idcapturista'); /// verificar si es capuritsa
        $observaciones = $this->input->get('observaciones');
        $estado_registro = $this->input->get('estado_registro');

        $registros= $this->models_registro->mostrar("", $numava, $fecha_de_entrega_inicial, $fecha_de_entrega_finali, $numExpediente, $folio, $nomRefer, $telefono, $email, $tipo_avaluo, $objetivoAvaluo, $otros, $ubicacion, $costo, $fecha_de_inspeccion_inicial, $fecha_de_inspeccion_final, $hora_de_inspeccion, $idempleado, $monto_credito, $monto_venta, $intermediario, $idcapturista, $observaciones, $estado_registro, $fecha_asigancion_inicia, $fecha_asigancion_finali, $fecha_captura_inicial, $fecha_captura_finali, $fecha_cierre_inicial, $fecha_cierre_finali, $registro_inicial_inicial, $registro_inicial_finali, $offset, $this->limite);

        $totalrow = $this->models_registro->mostrarcount("", $numava, $fecha_de_entrega_inicial, $fecha_de_entrega_finali, $numExpediente, $folio, $nomRefer, $telefono, $email, $tipo_avaluo, $objetivoAvaluo, $otros, $ubicacion, $costo, $fecha_de_inspeccion_inicial, $fecha_de_inspeccion_final, $hora_de_inspeccion, $idempleado, $monto_credito, $monto_venta, $intermediario, $idcapturista, $observaciones, $estado_registro, $fecha_asigancion_inicia, $fecha_asigancion_finali, $fecha_captura_inicial, $fecha_captura_finali, $fecha_cierre_inicial, $fecha_cierre_finali, $registro_inicial_inicial, $registro_inicial_finali);
        $data['totalrow'] = $totalrow;
        $config['base_url'] = base_url() . 'solicitudes/mostrar?numavaluo=' . $numava . '&fecha_de_entrega_inicial=' . $fecha_de_entrega_inicial . '&fecha_de_entrega_finali=' . $fecha_de_entrega_finali . '&numExpediente=' . $numExpediente . '&folio=' . $folio . '&nomRefer=' . $nomRefer . '&telefono=' . $telefono . '&email=' . $email . '&tipo_avaluo=' . $tipo_avaluo . '&objetivoAvaluo=' . $objetivoAvaluo . '&otros=' . $otros . '&ubicacion=' . $ubicacion . '&costo=' . $costo . '&fecha_de_inspeccion_inicio=' . $fecha_de_inspeccion_inicial . '&fecha_de_inspeccion_final=' . $fecha_de_inspeccion_final . '&hora_de_inspeccion=' . $hora_de_inspeccion . '&idempleado=' . $idempleado . '&monto_credito=' . $monto_credito . '&monto_venta=' . $monto_venta . '&intermediario=' . $intermediario . '&idcapturista=' . $idcapturista . '&observaciones=' . $observaciones . '&estado_registro=' . $estado_registro . '&fecha_asigancion_inicial=' . $fecha_asigancion_inicia . '&fecha_asigancion_finali=' . $fecha_asigancion_finali . '&fecha_captura_inicial=' . $fecha_captura_inicial . '&fecha_captura_finali=' . $fecha_captura_finali . '&fecha_cierre_inicial=' . $fecha_cierre_inicial . '&fecha_cierre_finali=' . $fecha_cierre_finali . '&registro_inicial_inicial=' . $registro_inicial_inicial . '&registro_inicial_finali=' . $registro_inicial_finali;
        $config['total_rows'] = $totalrow;
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
        $datax['menusolicitudesver'] = "active";


        $pila = $this->session->userdata('listpuesto');
        $clave = array_search('8',$pila); 

        $boolenVer=0;;
        if($clave!=''){
         $boolenVer=1;
       }
       $datax['verSolicitudesBusqueda']=$boolenVer;


       $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
        //$data['head'] = $this->load->view('plantilla/head', true);
        // Aqui se genera el excel
       $StrinSQl = $this->models_registro->mostrarcountString($numava, $fecha_de_entrega_inicial, $fecha_de_entrega_finali, $numExpediente, $folio, $nomRefer, $telefono, $email, $tipo_avaluo, $objetivoAvaluo, $otros, $ubicacion, $costo, $fecha_de_inspeccion_inicial, $fecha_de_inspeccion_final, $hora_de_inspeccion, $idempleado, $monto_credito, $monto_venta, $intermediario, $idcapturista, $observaciones, $estado_registro, $fecha_asigancion_inicia, $fecha_asigancion_finali, $fecha_captura_inicial, $fecha_captura_finali, $fecha_cierre_inicial, $fecha_cierre_finali, $registro_inicial_inicial, $registro_inicial_finali);

        //echo $StrinSQl;
       $data['url'] = $this->config->item('urlarchivos');
       $encrypted_string = $this->encrypt->encode($StrinSQl);
       $this->session->set_tempdata('StrinSQl', $encrypted_string, 600);

// ========================================================================
       $registroConsulta='';
       if (isset($registros)) {

        foreach ($registros->result() as $rowx) {

          $color_uno = "";
          $color_dos = "";
          $color_tres = "";
          $color_cuatro = "";

          $fecha_de_inspeccion = $rowx->fecha_de_inspeccion;
          $fecha_de_entrega = $rowx->fecha_de_entrega;
          $fecha_asigancion = $rowx->fecha_asigancion;
          $fecha_captura = $rowx->fecha_captura;
          $fecha_cierre = $rowx->fecha_cierre;
          $fecha_final = $rowx->fecha_final;

          $dias_uno = 0;
          $dias_dos = 0;
          $dias_tres = 0;
          $dias_cuatro = 0;


          
                //======================================== Fecha de Inspeccion =================================
                // =============================================================================================
                // =============================================================================================

          $veri = $this->models_registro->verificarDias($rowx->idregistro,2);

          $hoy ="";                                                                        
          if ($veri->num_rows()!=0) {
           $row = $veri->row();
           $date = date_create($row->registro);

           $hoy =date_format($date, 'Y-m-d');


         }else{
          $hoy = date("Y-m-d");

        }

        $cantidad = (strtotime($fecha_de_entrega) - strtotime($hoy));
        $cantidaddi = $cantidad / 86400;
        $dias_uno = abs($cantidaddi);
             // $cantidaddi  = $dias_uno;
        $mensajeVer="";
        $mensaje2 ="";
        if($cantidaddi<0){
          $mensajeVer="Retraso de ";
          if($dias_uno==1){
            $mensaje2 ="Día";
          }else{
            $mensaje2 ="Días";
          }

        }
        if ($veri->num_rows()!=0) {

         $row = $veri->row();
         $estado=$row->estado;
         if($estado==1){

          if ($cantidaddi < 0) {
            $color_uno = "badge-danger";
          } else {
            $color_uno = "badge-success";

          }

        }else{
          $color_uno = "";
        }




      }else{

        $color_uno = "badge-warning";

      }
      $cantidaddi = $mensajeVer." ".$dias_uno." ".$mensaje2;

              //===================================== Fecha de Entrega de Visita ===============================
                // =============================================================================================
                // =============================================================================================

      $veri2 = $this->models_registro->verificarDias($rowx->idregistro,3);
      $hoy2 ="";                                                                           
      if ($veri2->num_rows()!=0) {

        $row = $veri2->row();
        $date = date_create($row->registro);
        $hoy2 =date_format($date, 'Y-m-d');

      }else{

        $hoy2 = date("Y-m-d");
      }

      $cantidadb = (strtotime($fecha_asigancion) - strtotime($hoy2));
      $cantidadbd = $cantidadb / 86400;
      $dias_dos = abs($cantidadbd);

      $mensajeVer3="";
      $mensaje23 ="";
      if($cantidadbd<0){
        $mensajeVer3="Retraso de ";
        if($dias_dos==1){
          $mensaje23 ="Día";
        }else{
          $mensaje23 ="Días";
        }

      }



      if ($veri2->num_rows()!=0) {

       $row = $veri2->row();
       $estado=$row->estado;
       if($estado==1){

        if ($cantidadbd < 0) {


         $color_dos = "badge-danger";
       } else {
         $color_dos = "badge-success";
       }
     }else{
      $color_dos = "";

    }


  }else{

    $color_dos = "badge-warning";

  }

  $cantidadbd = $mensajeVer3." ".$dias_dos." ".$mensaje23;

                //===================================== Verificar Asigcion ====================================
                // =============================================================================================
                // =============================================================================================


  $veri3 = $this->models_registro->verificarDias($rowx->idregistro,4);
  $hoy21 = "";                                                                        
  if ($veri3->num_rows()!=0) {
    $row = $veri3->row();
    $date = date_create($row->registro);

    $hoy21 =date_format($date, 'Y-m-d');

  }else{
   $hoy21 = date("Y-m-d");
 }

 $cantidadc = (strtotime($fecha_captura) - strtotime($hoy21));
 $cantidadcd = $cantidadc / 86400;
 $dias_tres = abs($cantidadcd);
//$cantidadcd = floor($dias_tres);


 $mensajeVer4="";
 $mensaje24 ="";
 if($cantidadcd<0){
  $mensajeVer4="Retraso de ";
  if($dias_tres==1){
    $mensaje24 ="Día";
  }else{
    $mensaje24 ="Días";
  }

}
if ($veri3->num_rows()!=0) {

  $row = $veri3->row();
  $estado=$row->estado;
  if($estado==1){

    if ($cantidadcd < 0) {
      $color_tres = "badge-danger";
    } else {
      $color_tres = "badge-success";

    }
  }else{
    $color_tres = "";

  }

}else{
  $color_tres = "badge-warning";

}
$cantidadcd = $mensajeVer4." ".$dias_tres." ".$mensaje24;

//===================================== Verificar Captura ====================================
// =============================================================================================
// =============================================================================================

$veri4 = $this->models_registro->verificarDias($rowx->idregistro,5);
$hoy3="";                                                                        
if ($veri4->num_rows()!=0) {

 $row = $veri4->row();
 $date = date_create($row->registro);


 $hoy3 =date_format($date, 'Y-m-d');

}else{
 $hoy3 = date("Y-m-d");
}
                                                                    // echo $fecha_cierre;
$cantidadd = (strtotime($fecha_cierre) - strtotime($hoy3));
$cantidaddd = $cantidadd / 86400;
$dias_cuatro = abs($cantidaddd);
//$cantidaddd = floor($dias_cuatro);

$mensajeVer5="";
$mensaje25 ="";
if($cantidaddd<0){
  $mensajeVer5="Retraso de ";
  if($dias_cuatro==1){
    $mensaje25 ="Día";
  }else{
    $mensaje25 ="Días";
  }

}


if ($veri4->num_rows()!=0) {

 $row = $veri4->row();
 $estado=$row->estado;
 if($estado==1){

  if ($cantidaddd < 0) {

    $color_cuatro = "badge-danger";
  } else {
    $color_cuatro = "badge-success";
  }

}else{
 $color_cuatro = "";

}
}else{
  $color_cuatro = "badge-warning";

}

$cantidaddd = $mensajeVer5." ".$dias_cuatro." ".$mensaje25;
//===================================== Verificar Cierre ====================================
// =============================================================================================
// =============================================================================================


$veri5 = $this->models_registro->verificarDias($rowx->idregistro,6);
$hoy4 ="";                                                                        
if ($veri5->num_rows()!=0) {


 $row = $veri5->row();
 $date = date_create($row->registro);

 $hoy4 =date_format($date, 'Y-m-d');

}else{
  $hoy4 = date("Y-m-d");
}


$cantidaCierre = (strtotime($fecha_final) - strtotime($hoy4));
$cantidaCierred = $cantidaCierre / 86400;

$diasCierre = abs($cantidaCierred);

//$cantidaCierred = ">>>>>>>>>>>>> ".$fecha_final;

$mensajeVer6="";
$mensaje26 ="";
if($cantidaCierred<0){
  $mensajeVer6="Retraso de ";
  if($diasCierre==1){
    $mensaje26 ="Día";
  }else{
    $mensaje26 ="Días";
  }

}


if ($veri5->num_rows()!=0) {

 $row = $veri5->row();
 $estado=$row->estado;
 if($estado==1){

  if ($cantidaCierred < 0) {

    $color_quinto = "badge-danger";
  } else {
   $color_quinto = "badge-success";
 }
}else{
  $color_quinto = "";

}
}else{
 $color_quinto = "badge-warning";
}
$cantidaCierred = $mensajeVer6." ".$diasCierre." ".$mensaje26;

//========================================= FIN ================================================
// =============================================================================================
// =============================================================================================
$registroConsulta.= '

<tr>
  <td style="font-size:12px;width: 5%">'.str_pad($rowx->idregistro, 5, "0", STR_PAD_LEFT).'</td>
  <td style="font-size:12px;width: 7%">'.$rowx->num_expediente.'</td>
  <td style="font-size:12px;width: 10%">'.$rowx->referencia.'</td>
  <td style="font-size:12px;width: 7%">'.$rowx->nomobjetivo.'</td>
  <td style="font-size:12px;width:20%">'.$rowx->ubicacion.'</td>
  <td style="font-size:12px"> $ '.number_format($rowx->costo).'</td>  
  <td style="font-size:12px;background-color: '.$rowx->color.'"><strong>'.$rowx->inspector.'</strong></td>
  <td style="width: 13%;">

   <div class="btn-group-vertical margin-right-10">


    <a href="#" >
      <span class="badge '.$color_uno.'">
        Inspección  ( '.$cantidaddi.' )</span>

      </a>    <br>      <br>                
      <a href="#" >                                


       <span class="badge '.$color_dos.'">
        Entrega de visita ( '.$cantidadbd.')</span>



      </a><br> <br> 
      <a href="#" >                                



        <span class="badge '.$color_tres.'">
         Asiganción ( '.$cantidadcd.' )</span>

       </a><br> <br> 
       <a href="#">                                


         <span class="badge '.$color_cuatro.'">
           Captura ( '.$cantidaddd.' )</span>
         </a>
       </a><br> <br> 
       <a href="#">                                


         <span class="badge '.$color_quinto.'">
          Cierre ( '.$cantidaCierred.' )</span>
        </a>

      </div>

    </td>
    <td style="width:10%">


      <div class="btn-group-vertical margin-right-10">


        <a href="'.site_url('').'solicitudesvista/detalles?idregistro='.$rowx->idregistro.'" class="btn default btn-xs  optenerID"><i class="fa fa-edit"></i> DETALLES </a> <br>
        <a href="'.site_url('').'anexossolicitudes/acreditado?idregistro='.$rowx->idregistro.'" class="btn default btn-xs optenerID"><i class="fa fa-file-o"></i> ARCHIVOS </a>





      </div>

    </td>
  </tr>';


}

}

$data['tabla']=$registroConsulta;
$this->load->view('solicitudes/listarvista', $data);
}


public function detalles() {


//$row = $query->row();
//$row->descripcion
  $idregistro = $this->input->get('idregistro');
  $dtoestado = $this->input->get('estado');

  if (!empty($dtoestado)) {

    $data['msn'] = $this->input->get('estado');
  } else {
    $data['msn'] = -1;
  }

  $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
  $datax['nombre'] = $nombrez;
  $datax['puesto'] = $this->session->userdata('puesto');
  $datax['menusolicitudesver'] = "active";

  $data['nombre'] = $nombrez;
  $data['idcapturista'] = $this->session->userdata('idempleado');
  $pila = $this->session->userdata('listpuesto');
  $clave = array_search('8',$pila); 

  $boolenVer=0;;
  if($clave!=''){
   $boolenVer=1;
 }
 $datax['verSolicitudesBusqueda']=$boolenVer;
 
 $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
        //$data['head'] = $this->load->view('plantilla/head', true);
 $data['tipo_avaluo'] = $this->models_tipo_avaluo->get();
 $data['objetivo_avaluo'] = $this->models_objetivo_avaluo->get();
 $data['empleados'] = $this->models_empleado->getInspector();
 $data['asigno'] = $this->models_empleado->getAsignador();
 $data['capturista'] = $this->models_empleado->capturista();
 $data['query'] = $this->models_registro->buscar($idregistro);

 $consulta=$this->models_estado_registro->consultarfechas($idregistro);

 $arrayFechas= array();
 foreach ($consulta->result()  as $rowx)
 {
  $date = date_create($rowx->registro);

  $arrayFechas["idRegistro_".$rowx->idestado_registro]=$rowx->idestado_registro;
  $arrayFechas["registro_".$rowx->idestado_registro]=date_format($date, 'Y-m-d H:i:s');
  $arrayFechas["nombre_".$rowx->idestado_registro]=$rowx->nombre;

  



}

$data['arryCount'] = $arrayFechas;
$this->load->view('solicitudes/detalles', $data);
}


}
