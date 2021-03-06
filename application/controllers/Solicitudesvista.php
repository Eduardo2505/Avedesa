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
    $datoiniciar = $this->session->userdata('Nombre');

        if (strlen($datoiniciar) == 0) {


            redirect('', 'refresh');
        }    

    $this->load->model('models_tipo_avaluo');
    $this->load->model('models_objetivo_avaluo');
    $this->load->model('models_empleado');
    $this->load->model('models_registro');
    $this->load->model('models_c_entidades_municipios');
    $this->load->model('models_tipoinmueble');
    $this->load->model('models_intermediariofinanciero');
    $this->load->model('models_registro_consulta');
  }

  public function index() {

    $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
    $datax['nombre'] = $nombrez;
    $datax['puesto'] = $this->session->userdata('puesto');
   // $datax['menusolicitudes'] = "active";
    $datax['menucatalogos'] = "x";
    $datax['menuadmin'] = "x";
    $datax['solictudesbus'] = "x";
    $datax['solictudesnuevo'] = "active";
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
    $data['nombre'] = $nombrez;
    $data['idcapturista'] = $this->session->userdata('idempleado');
    $datax['menusolicitudesver'] = "active";


        $pila = $this->session->userdata('listpuesto');
        $clave = array_search('8',$pila); 

        $boolenVer=0;;
        if($clave!=''){
         $boolenVer=1;
       }
    $datax['verSolicitudesBusqueda']=$boolenVer;


    $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
    $data['tipo_avaluo'] = $this->models_tipo_avaluo->getWebservice();
    $data['objetivo_avaluo'] = $this->models_objetivo_avaluo->getWebservice();
    $data['empleados'] = $this->models_empleado->getInspector();
    $data['asigno'] = $this->models_empleado->getAsignador();
    $data['entidades'] = $this->models_c_entidades_municipios->getEstados();
    $data['tipoInmueble'] = $this->models_tipoinmueble->get();
    $data['intemediarios'] = $this->models_intermediariofinanciero->get();

    $this->load->view('solicitudes/registroBuscarVista', $data);
  }
public function buscarP() {


    $filtro=$this->session->userdata('filtro');

    $fecha_de_inspeccion_inicial = $filtro->fecha_de_inspeccion_inicio;
    $fecha_de_inspeccion_final =$filtro->fecha_de_inspeccion_final;
    $fecha_de_entrega_inicial = $filtro->fecha_de_entrega_inicial;
    $fecha_de_entrega_finali = $filtro->fecha_de_entrega_finali;
    $fecha_asigancion_inicia = $filtro->fecha_asigancion_inicial;
    $fecha_asigancion_finali = $filtro->fecha_asigancion_finali; 
    $fecha_captura_inicial =$filtro->fecha_captura_inicial;
    $fecha_captura_finali = $filtro->fecha_captura_finali;
    $fecha_cierre_inicial = $filtro->fecha_cierre_inicial;
    $fecha_cierre_finali = $filtro->fecha_cierre_finali;
    $registro_inicial_inicial = $filtro->registro_inicial_inicial;
    $registro_inicial_finali = $filtro->registro_inicial_finali;
    $hora_de_inspeccion = $filtro->hora_de_inspeccion;

    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
      $offset = 0;
    }


//=====================INICIO===============
    $registros=$this->models_registro_consulta->mostrar($filtro,$offset, $this->limite);
    $totalrow = $this->models_registro_consulta->mostrarcount($filtro);


    $data['totalrow'] = $totalrow;
    $config['base_url'] = base_url() . 'solicitudesvista/buscarP';
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
       //$StrinSQl = $this->models_registro->mostrarcountString($numava, $fecha_de_entrega_inicial, $fecha_de_entrega_finali, $numExpediente, $folio, $nomRefer, $telefono, $email, $tipo_avaluo, $objetivoAvaluo, $otros, $ubicacion, $costo, $fecha_de_inspeccion_inicial, $fecha_de_inspeccion_final, $hora_de_inspeccion, $idempleado, $monto_credito, $monto_venta, $intermediario, $idcapturista, $observaciones, $estado_registro, $fecha_asigancion_inicia, $fecha_asigancion_finali, $fecha_captura_inicial, $fecha_captura_finali, $fecha_cierre_inicial, $fecha_cierre_finali, $registro_inicial_inicial, $registro_inicial_finali);

        //echo $StrinSQl;
      // $data['url'] = $this->config->item('urlarchivos');
       //$encrypted_string = $this->encrypt->encode($StrinSQl);
       //$this->session->set_tempdata('StrinSQl', $encrypted_string, 600);

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

  public function buscarS() {


    $vowels = array(",", "$",".00");
    $fecha_de_inspeccion_inicial = "";
    $fecha_de_inspeccion_final = "";

    if ($this->input->post('fecha_de_inspeccion_inicio') != "") {
      $date1 = date_create($this->input->post('fecha_de_inspeccion_inicio'));
      $fecha_de_inspeccion_inicial = date_format($date1, 'Y-m-d');
      $date2 = date_create($this->input->post('fecha_de_inspeccion_final'));
      $fecha_de_inspeccion_final = date_format($date2, 'Y-m-d');
    }

    $fecha_de_entrega_inicial = "";
    $fecha_de_entrega_finali = "";
    if ($this->input->post('fecha_de_entrega_inicial') != "") {
      $date3 = date_create($this->input->post('fecha_de_entrega_inicial'));
      $fecha_de_entrega_inicial = date_format($date3, 'Y-m-d');
      $date4 = date_create($this->input->post('fecha_de_entrega_finali'));
      $fecha_de_entrega_finali = date_format($date4, 'Y-m-d');
    }


    $fecha_asigancion_inicia = "";
    $fecha_asigancion_finali = "";
    if ($this->input->post('fecha_asigancion_inicial') != "") {
      $date5 = date_create($this->input->post('fecha_asigancion_inicial'));
      $fecha_asigancion_inicia = date_format($date5, 'Y-m-d');
      $date6 = date_create($this->input->post('fecha_asigancion_finali'));
      $fecha_asigancion_finali = date_format($date6, 'Y-m-d');
    }

    $fecha_captura_inicial = "";
    $fecha_captura_finali = "";
    if ($this->input->post('fecha_captura_inicial') != "") {
      $date7 = date_create($this->input->post('fecha_captura_inicial'));
      $fecha_captura_inicial = date_format($date7, 'Y-m-d');
      $date8 = date_create($this->input->post('fecha_captura_finali'));
      $fecha_captura_finali = date_format($date8, 'Y-m-d');
    }

    $fecha_cierre_inicial = "";
    $fecha_cierre_finali = "";
    if ($this->input->post('fecha_cierre_inicial') != "") {
      $date9 = date_create($this->input->post('fecha_cierre_inicial'));
      $fecha_cierre_inicial = date_format($date9, 'Y-m-d');
      $date10 = date_create($this->input->post('fecha_cierre_finali'));
      $fecha_cierre_finali = date_format($date10, 'Y-m-d');
    }

    $registro_inicial_inicial = "";
    $registro_inicial_finali = "";
    if ($this->input->post('registro_inicial_inicial') != "") {
      $date11 = date_create($this->input->post('registro_inicial_inicial') . ' 00:00:00');
      $registro_inicial_inicial = date_format($date11, 'Y-m-d H:i:s');
      $date12 = date_create($this->input->post('registro_inicial_finali') . ' 23:59:00');
      $registro_inicial_finali = date_format($date12, 'Y-m-d H:i:s');
    }

    $hora_de_inspeccion = "";
    if ($this->input->post('hora_de_inspeccion') != "") {
      $date2 = date_create($this->input->post('hora_de_inspeccion'));
      $hora_de_inspeccion = date_format($date2, 'H:i:s');
    }



    $filtro =(object) array(
      'tipoSnc' => $this->input->post('tipoSnc'),
      'id' => $this->input->post('id'),
      'numExpediente' => $this->input->post('numExpediente'),
      'folio_cliente' => $this->input->post('folio_cliente'),
      'costo' => str_replace($vowels, "", $this->input->post('costo')),
      'idOperador' => $this->input->post('idOperador'),
      'idInsepctor' => $this->input->post('idInsepctor'),
      'idEjecutivo' => $this->input->post('idEjecutivo'),
      'objetivoAvaluo' => $this->input->post('objetivoAvaluo'),
      'idtipo_avaluo' => $this->input->post('idtipo_avaluo'),
      'reporteTesoreria' => $this->input->post('reporteTesoreria'),
      'idIntemediario' => $this->input->post('idIntemediario'),
      'otro_intermediario' => $this->input->post('otro_intermediario'),
      'otros' => $this->input->post('otros'),
      'nomRefer' => $this->input->post('nomRefer'),
      'fecha_visita' => $this->input->post('fecha_visita'),
      'hora_de_inspeccion' => $this->input->post('hora_de_inspeccion'),
      'visita_exitosa' => $this->input->post('visita_exitosa'),
      'telefono_v' => $this->input->post('telefono_v'),
      'telefono_v2' => $this->input->post('telefono_v2'),
      'email_v' => $this->input->post('email_v'),
      'monto_credito' => str_replace($vowels, "", $this->input->post('monto_credito')),
      'monto_venta' => str_replace($vowels, "", $this->input->post('monto_venta')),
      'observaciones' => $this->input->post('observaciones'),
      'usuario_entrega' => $this->input->post('usuario_entrega'),
      'nombre_s' => $this->input->post('nombre_s'),
      'p_apellido_s' => $this->input->post('p_apellido_s'),
      's_apellido_s' => $this->input->post('s_apellido_s'),
      'tipo_persona_s' => $this->input->post('tipo_persona_s'),
      'rfc_s' => $this->input->post('rfc_s'),
      'nss_s' => $this->input->post('nss_s'),
      'cp_s' => $this->input->post('cp_s'),
      'col_s' => $this->input->post('col_s'),
      'idEntidad_s' => $this->input->post('idEntidad_s'),
      'id_muni_s' => $this->input->post('id_muni_s'),
      'calle_s' => $this->input->post('calle_s'),
      'num_ext_s' => $this->input->post('num_ext_s'),
      'num_int_s' => $this->input->post('num_int_s'),
      'telefono_s' => $this->input->post('telefono_s'),
      'email_s' => $this->input->post('email_s'),
      'idtipo_avaluo_i' => $this->input->post('idtipo_avaluo_i'),
      'cp_i' => $this->input->post('cp_i'),
      'idEntidad_i' => $this->input->post('idEntidad_i'),
      'id_muni_i' => $this->input->post('id_muni_i'),
      'col_i' => $this->input->post('col_i'),
      'calle_i' => $this->input->post('calle_i'),
      'num_int_i' => $this->input->post('num_int_i'),
      'num_ex_i' => $this->input->post('num_ex_i'),
      'mz_i' => $this->input->post('mz_i'),
      'lt_i' => $this->input->post('lt_i'),
      'condominio_i' => $this->input->post('condominio_i'),
      'entrada_i' => $this->input->post('entrada_i'),
      'edificio_i' => $this->input->post('edificio_i'),
      'depto_i' => $this->input->post('depto_i'),
      'entre_calle_i' => $this->input->post('entre_calle_i'),
      'yCalle_i' => $this->input->post('yCalle_i'),
      'ciudad_i' => $this->input->post('ciudad_i'),
      'fecha_de_inspeccion_inicio' => $fecha_de_inspeccion_inicial,
      'fecha_de_inspeccion_final' =>$fecha_de_inspeccion_final,
      'fecha_de_entrega_inicial' => $fecha_de_entrega_inicial,
      'fecha_de_entrega_finali' => $fecha_de_entrega_finali,
      'fecha_asigancion_inicial' => $fecha_asigancion_inicia,
      'fecha_asigancion_finali' => $fecha_asigancion_finali,
      'fecha_captura_inicial' => $fecha_captura_inicial,
      'fecha_captura_finali' => $fecha_captura_finali,
      'fecha_cierre_inicial' => $fecha_cierre_inicial,
      'fecha_cierre_finali' =>  $fecha_cierre_finali,
      'registro_inicial_inicial' => $registro_inicial_inicial,
      'registro_inicial_finali' => $registro_inicial_finali

    );
//echo '<pre>'; print_r($filtro); echo '</pre>';

    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
      $offset = 0;
    }


//=====================INICIO===============
    $this->session->set_userdata('filtro',$filtro);
    $registros=$this->models_registro_consulta->mostrar($filtro,$offset, $this->limite);
    $totalrow = $this->models_registro_consulta->mostrarcount($filtro);


    $data['totalrow'] = $totalrow;
    $config['base_url'] = base_url() . 'solicitudesvista/buscarP';
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
       //$StrinSQl = $this->models_registro->mostrarcountString($numava, $fecha_de_entrega_inicial, $fecha_de_entrega_finali, $numExpediente, $folio, $nomRefer, $telefono, $email, $tipo_avaluo, $objetivoAvaluo, $otros, $ubicacion, $costo, $fecha_de_inspeccion_inicial, $fecha_de_inspeccion_final, $hora_de_inspeccion, $idempleado, $monto_credito, $monto_venta, $intermediario, $idcapturista, $observaciones, $estado_registro, $fecha_asigancion_inicia, $fecha_asigancion_finali, $fecha_captura_inicial, $fecha_captura_finali, $fecha_cierre_inicial, $fecha_cierre_finali, $registro_inicial_inicial, $registro_inicial_finali);

        //echo $StrinSQl;
      // $data['url'] = $this->config->item('urlarchivos');
       //$encrypted_string = $this->encrypt->encode($StrinSQl);
       //$this->session->set_tempdata('StrinSQl', $encrypted_string, 600);

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
