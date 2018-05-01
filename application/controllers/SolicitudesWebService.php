<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SolicitudesWebService extends CI_Controller {

  private $limite = 10;
    //solicidos manderas

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



    $this->load->model('models_tipo_avaluo');
    $this->load->model('models_objetivo_avaluo');
    $this->load->model('models_empleado');
    $this->load->model('models_c_entidades_municipios');
    $this->load->model('models_tipoinmueble');
    $this->load->model('models_registro');
    $this->load->model('models_intermediariofinanciero');
    $this->load->model('models_estado_empleado');
    $this->load->model('models_visita');
    $this->load->model('models_solicitante');
    $this->load->model('models_inmueble');
  }

  public function index() {

    $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');



    if (!empty($this->input->get('ms'))) { 
      $data['msn'] = 1;
    } else {
     $data['msn'] = 0;
   }


   $datax['nombre'] = $nombrez;
   $datax['puesto'] = $this->session->userdata('puesto');
   $datax['menusolicitudes'] = "active";
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
   $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
   $data['tipo_avaluo'] = $this->models_tipo_avaluo->getWebservice();
   $data['objetivo_avaluo'] = $this->models_objetivo_avaluo->getWebservice();
   $data['empleados'] = $this->models_empleado->getInspector();
   $data['asigno'] = $this->models_empleado->getAsignador();
   $data['entidades'] = $this->models_c_entidades_municipios->getEstados();
   $data['tipoInmueble'] = $this->models_tipoinmueble->get();
   $data['intemediarios'] = $this->models_intermediariofinanciero->get();

   $this->load->view('solicitudes/registroNuevo', $data);
 }


 public function getMunicipios() {

  $idEstado= $this->input->get('idEntidad_i');


  $municipios= $this->models_c_entidades_municipios->getMunicipios($idEstado);

  $combo='<option value="-1">Seleccione</option>';

  if (isset($municipios)) {
    foreach ($municipios->result() as $rowx) {

     $combo.=' <option value="'.$rowx->idMunicipio.'">'.$rowx->municipio.'</option>';



   }
 }

 echo $combo;



}



//
public function registro() {



  $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');  
  $numexpediente="";
  $fecha_de_inspeccion=$this->input->post('fecha_visita');
  $idInsepctor=$this->input->post('idInsepctor');
  $objetivoAvaluo=$this->input->post('objetivoAvaluo');
  $idtipo_avaluo=$this->input->post('idtipo_avaluo');
  $nomRefer=$this->input->post('nomRefer');
  $idIntemediario=$this->input->post('idIntemediario');
  $nombre_s=$this->input->post('nombre_s');
  $p_apellido_s=$this->input->post('p_apellido_s');
  $s_apellido_s=$this->input->post('s_apellido_s');
  $tipo_persona_s=$this->input->post('tipo_persona_s');
  $nss_s=$this->input->post('nss_s');
  $rfc_s=$this->input->post('rfc_s');
  $cp_s=$this->input->post('cp_s');
  $col_s=$this->input->post('col_s');
  $idEntidad_s=$this->input->post('idEntidad_s');
  $idMunicipio_s=$this->input->post('id_muni_s');
  $calle_s=$this->input->post('calle_s');
  $num_int_s=$this->input->post('num_int_s');
  $num_ext_s=$this->input->post('num_ext_s');
  $telefono_s=$this->input->post('telefono_s');
  $email_s=$this->input->post('email_s');
  $visita_exitosa=$this->input->post('visita_exitosa');

  $nombreEstado="";
  $nombreMuni="";
  if($idEntidad_s!=-1){
    $nombreEstado=$this->models_c_entidades_municipios->getNombreEstado($idEntidad_s);
  }
  if($idMunicipio_s!=-1){
    $nombreMuni=$this->models_c_entidades_municipios->getNombreMunicipio($idEntidad_s);
  }

  $ubicacion=$calle_s." ,Num. Ext. ".$num_ext_s." ,Num. Int.".$num_int_s." ,Col.".$col_s." ,C.P.".$cp_s." , Mpio. ".$nombreMuni." ,".$nombreEstado;


  $idestado_registro=2;

  if ($fecha_de_inspeccion != ""&&$idInsepctor != "") {

    $idempleadobuscar =$this->models_empleado->Buscar($idInsepctor);
    $row = $idempleadobuscar->row();
    $count = $this->models_registro->countFolio($fecha_de_inspeccion,$idInsepctor);
    $sum=$count+1;
    $fechax=date("dmy", strtotime($fecha_de_inspeccion));
    $numexpediente=$fechax."".$row->iniciales."".$sum;

  }else{
   $numexpediente="";
 }



 $resultadoFinal = array();
 $resultadoFinal["referencia"] = $nomRefer;
 $resultadoFinal["num_expediente"] = $numexpediente;
 $resultadoFinal["num_avaluo"] = $this->input->post('folio_cliente');
 $resultadoFinal["id_asigno"] = $this->input->post('idEjecutivo');
 $resultadoFinal["telefono"] = $this->input->post('telefono_v');   
 $resultadoFinal["email"]= $this->input->post('email_v');
 $resultadoFinal["idtipo_avaluo"]= $idtipo_avaluo;
 $resultadoFinal["otros"]= $this->input->post('otros');
 $resultadoFinal["ubicacion"]= strtoupper($ubicacion);
 $resultadoFinal["costo"]= str_replace(".", "", $this->input->post('costo'));
 $resultadoFinal["registro_inicial"]= $this->models_registro->Horafecha();
 $resultadoFinal["monto_venta"]= str_replace(".", "", $this->input->post('monto_venta'));
 $resultadoFinal["monto_credito"]= str_replace(".", "", $this->input->post('monto_credito'));
 $resultadoFinal["idcapturista"]= $this->session->userdata('idempleado');
 $resultadoFinal["observaciones"]= $this->input->post('observaciones');
 $resultadoFinal["adelanto_pago"]= 0;
 $resultadoFinal["usuario_update"]= $nombrez;
 $resultadoFinal["idestado_registro"]= $idestado_registro;
 $resultadoFinal["tipoRegistro"]= 1;
 $resultadoFinal["idOperador"]= $this->input->post('idOperador');
 $resultadoFinal["reporteTesoreria"]= $this->input->post('reporteTesoreria');
 $resultadoFinal["usuario_entrega"]= $this->input->post('usuario_entrega');

 if ($fecha_de_inspeccion != "") {
   $fechasc=$this->calcularfechas($fecha_de_inspeccion);        
   $resultadoFinal["fecha_de_inspeccion"]= date_format($fechasc->fecha_de_inspeccion, 'Y-m-d');
   $resultadoFinal["hora_de_inspeccion"]= $this->input->post('hora_de_inspeccion');
   $resultadoFinal["fecha_de_entrega"]= date_format($fechasc->fecha_de_entrega, 'Y-m-d');
   $resultadoFinal["fecha_captura"]= date_format($fechasc->fecha_captura, 'Y-m-d');
   $resultadoFinal["fecha_cierre"]= date_format($fechasc->fecha_cierre, 'Y-m-d');
   $resultadoFinal["fecha_final"]= date_format($fechasc->fecha_final, 'Y-m-d');
   $resultadoFinal["fecha_asigancion"]= date_format($fechasc->fecha_asigancion, 'Y-m-d');
 }

 if ($objetivoAvaluo != "") {
   $resultadoFinal["idobjetivo_avaluo"]= $objetivoAvaluo;
 }else{
   $resultadoFinal["idobjetivo_avaluo"]=0;
 }

 if ($idInsepctor != "") {
  $resultadoFinal["idempleado"]= $idInsepctor;
}else{
 $resultadoFinal["idempleado"]=0;
}

$intermediario=$this->input->post('idIntemediario');
if ($intermediario != "") {

 if($intermediario==-1) {

  $resultadoFinal["intermediario"]=$this->input->post('otro_intermediario');
}else{

 $resultadoFinal["intermediario"]= $this->models_intermediariofinanciero->buscardescripcion($intermediario);
 $resultadoFinal["clave"]= $intermediario;
}

}else{
  $resultadoFinal["intermediario"]="";
}   

$valor = $this->models_registro->insertar($resultadoFinal);

if ($fecha_de_inspeccion != ""&&$idInsepctor != "") {


 $this->asignarInspecion($idInsepctor,$valor);


}
// se van insertar en las nuevas tablas
//================ visita ====================== 
$vistar = array();
if ($fecha_de_inspeccion != "") {
  $fechaHora=$fecha_de_inspeccion." ".$this->input->post('hora_de_inspeccion').":00";
   // echo $fechaHora;
  $vistar["FechaVisita"] = $fechaHora;
}

if($visita_exitosa!=-1){

 $vistar["VisitaExitosa"] = $visita_exitosa;
}
$vistar["ContactoVisita"] = $nomRefer;
$vistar["Telefono"] = $this->input->post('telefono_v');
$vistar["idregistro"] = $valor;

$this->models_visita->insertar($vistar);
//================ Solicitante ====================== 

$solicitanter = array();
$solicitanter["Nombre"] = $nombre_s;
$solicitanter["ApellidoPaterno"] = $p_apellido_s;
$solicitanter["ApellidoMaterno"] = $s_apellido_s;
$solicitanter["PersonaMoral"] = $tipo_persona_s;
$solicitanter["Rfc"] = $rfc_s;
$solicitanter["Nss"] = $nss_s;
if ($cp_s != "") {
 $solicitanter["CodigoPostal"] = $cp_s;
}
$solicitanter["ClaveEntidad"] = $idEntidad_s;
$solicitanter["ClaveMunicipio"] = $idMunicipio_s;
$solicitanter["Colonia"] = $col_s;
$solicitanter["Calle"] = $calle_s;
$solicitanter["NumeroExterior"] = $num_ext_s;
$solicitanter["NumeroInterior"] = $num_int_s;
$solicitanter["Telefono"] = $telefono_s;
$solicitanter["CorreoElectronico"] = $email_s;
$solicitanter["idregistro"] = $valor;
$this->models_solicitante->insertar($solicitanter);

//===================Inmueble ==============
$idtipo_avaluo_i=$this->input->post('idtipo_avaluo_i');
$cp_i=$this->input->post('cp_i');
$idEntidad_i=$this->input->post('idEntidad_i');
$id_muni_i=$this->input->post('id_muni_i');
$col_i=$this->input->post('col_i');
$calle_i=$this->input->post('calle_i');
$num_int_i=$this->input->post('num_int_i');
$num_ex_i=$this->input->post('num_ex_i');
$mz_i=$this->input->post('mz_i');
$lt_i=$this->input->post('lt_i');
$condominio_i=$this->input->post('condominio_i');
$entrada_i=$this->input->post('entrada_i');
$edificio_i=$this->input->post('edificio_i');
$depto_i=$this->input->post('depto_i');
$entre_calle_i=$this->input->post('entre_calle_i');
$yCalle_i=$this->input->post('yCalle_i');
$ciudad_i=$this->input->post('ciudad_i');
$latitud_i=$this->input->post('latitud_i');
$longitud_i=$this->input->post('longitud_i');
$altitud_i=$this->input->post('altitud_i');

$inmuebleArray = array();
$inmuebleArray["CodigoPostal"] = $cp_i;
$inmuebleArray["ClaveEntidad"] = $idEntidad_i;
$inmuebleArray["ClaveMunicipio"] = $id_muni_i;
$inmuebleArray["Colonia"] = $col_i;
$inmuebleArray["Calle"] = $calle_i;
$inmuebleArray["NumeroExterior"] = $num_ex_i;
$inmuebleArray["NumeroInterior"] = $num_int_i;
    //$inmuebleArray["SuperManzana"] = $mz_i;
$inmuebleArray["Manzana"] = $mz_i;
$inmuebleArray["Lote"] = $lt_i;
$inmuebleArray["Condominio"] = $condominio_i;
$inmuebleArray["Entrada"] = $entrada_i;
$inmuebleArray["Edificio"] = $edificio_i;
$inmuebleArray["Departamento"] = $depto_i;
$inmuebleArray["EntreCalle"] = $entre_calle_i;
$inmuebleArray["YCalle"] = $yCalle_i;
$inmuebleArray["Ciudad"] = $ciudad_i;
$inmuebleArray["Latitud"] = $latitud_i;
$inmuebleArray["Longitud"] = $longitud_i;
$inmuebleArray["Altitud"] = $altitud_i;
$inmuebleArray["idregistro"] = $valor;
$inmuebleArray["idtipoInmueble"] = $idtipo_avaluo_i;

$this->models_inmueble->insertar($inmuebleArray);

redirect('solicitudesWebService/index?ms=1', 'refresh');


}

public function asignarInspecion($idInsepctor,$idRegistro) {

  $datac = array(
    'idestado_registro' => 2,
    'idregistro' => $idRegistro,
    'idempleado' => $idInsepctor,
    'estado' => 0);

  $this->models_estado_empleado->insertar($datac);

       //=============================== SE ASIGNA AUTOMATICAMENTE ENTEGA DE VISITA===========================
        //=============================================================================================
      //  =============================================================================================
  $idEmpleadoGlobal = $this->config->item('idEmpleado');
  $datav = array(
    'idestado_registro' => 3,
    'idregistro' => $idRegistro,
    'idempleado' => $idEmpleadoGlobal,
    'estado' => 0);

  $this->models_estado_empleado->insertar($datav);


}

public function calcularfechas($fecha_de_inspeccion) {


  $f1 = $fecha_de_inspeccion;
  $date1 = date_create($f1);
  $contadorvisita = 1;
  $lim = 2;
  $lim3 = 0;
  for ($i = 1; $i <= 5; $i++) {
    $nuevafor = strtotime('+' . $i . ' day', strtotime(date_format($date1, 'Y-m-d')));
    $nuevafor = date('Y-m-d', $nuevafor);
    if (date('w', strtotime($nuevafor)) == 0) {

      $lim3 = 1;
    }
    $li = $lim + $lim3;
    if ($contadorvisita == $li) {
      break;
    }
    $contadorvisita++;
  }


  $nuevafecha = strtotime('+' . $contadorvisita . ' day', strtotime(date_format($date1, 'Y-m-d')));
  $nuevafecha = date('Y-m-d', $nuevafecha);
//fecha de visita
  $f3 = $nuevafecha;

                //calcular asigancion
  $dateasignar = date_create($f3);
  $contadorasignar = 1;
  $limasignar = 2;
  $lim3asignar = 0;
  for ($i = 1; $i <= 5; $i++) {
    $nuevafor = strtotime('+' . $i . ' day', strtotime($nuevafecha));
    $nuevafor = date('Y-m-d', $nuevafor);
    if (date('w', strtotime($nuevafor)) == 0) {
      $lim3asignar = 1;
    }
    $liasignar = $limasignar + $lim3asignar;
    if ($contadorasignar == $liasignar) {
      break;
    }

    $contadorasignar++;
  }

  $nuevafechaasignar = strtotime('+' . $contadorasignar . ' day', strtotime(date_format($dateasignar, 'Y-m-d')));
  $nuevafechaasignar = date('Y-m-d', $nuevafechaasignar);

  $f2 = $nuevafechaasignar;

                // calcular captura

  $datecaptura = date_create($f2);
  $contadorcaptura = 1;
  $limcaptura = 2;
  $lim3captura = 0;
  for ($i = 1; $i <= 5; $i++) {
    $nuevafor = strtotime('+' . $i . ' day', strtotime($nuevafechaasignar));
    $nuevafor = date('Y-m-d', $nuevafor);
    if (date('w', strtotime($nuevafor)) == 0) {
      $lim3captura = 1;
    }
    $licaptura = $limcaptura + $lim3captura;
    if ($contadorcaptura == $licaptura) {
      break;
    }

    $contadorcaptura++;
  }

  $nuevafechacaptura = strtotime('+' . $contadorcaptura . ' day', strtotime(date_format($datecaptura, 'Y-m-d')));
  $nuevafechacaptura = date('Y-m-d', $nuevafechacaptura);

  $f4 = $nuevafechacaptura;

                //*******
                //calcular cierre

  $datecierre = date_create($f4);
  $contadorcierre = 1;
  $limcierre = 2;
  $lim3cierre = 0;
  for ($i = 1; $i <= 5; $i++) {
    $nuevafor = strtotime('+' . $i . ' day', strtotime($nuevafechacaptura));
    $nuevafor = date('Y-m-d', $nuevafor);
    if (date('w', strtotime($nuevafor)) == 0) {
      $lim3cierre = 1;
    }
    $licierre = $limcierre + $lim3cierre;
    if ($contadorcierre == $licierre) {
      break;
    }

    $contadorcierre++;
  }

  $nuevafechacierre = strtotime('+' . $contadorcierre . ' day', strtotime(date_format($datecierre, 'Y-m-d')));
  $nuevafechacierre = date('Y-m-d', $nuevafechacierre);

  $f5 = $nuevafechacierre;

        //calcular el fin

  $datefinal = date_create($f5);
  $contadorfinal = 1;
  $limfinal = 2;
  $lim3final = 0;
  for ($i = 1; $i <= 5; $i++) {
    $nuevafor = strtotime('+' . $i . ' day', strtotime($nuevafechacierre));
    $nuevafor = date('Y-m-d', $nuevafor);
    if (date('w', strtotime($nuevafor)) == 0) {
      $lim3final = 1;
    }
    $lifinal = $limfinal + $lim3final;
    if ($contadorfinal == $lifinal) {
      break;
    }

    $contadorfinal++;
  }

  $nuevafechafinal = strtotime('+' . $contadorfinal . ' day', strtotime(date_format($datefinal, 'Y-m-d')));
  $nuevafechafinal = date('Y-m-d',  $nuevafechafinal);

  $f6 = $nuevafechafinal;

  $date1 = date_create($f1);
  $date3 = date_create($f2);
  $date4 = date_create($f3);
  $date5 = date_create($f4);
  $date6 = date_create($f5);
  $date7 = date_create($f6);

  $datav =(object) array(
    'fecha_de_inspeccion' => $date1,
    'fecha_asigancion' => $date3,
    'fecha_de_entrega' =>$date4,
    'fecha_captura' => $date5,
    'fecha_cierre' => $date6,
    'fecha_final' => $date7);

  return $datav;


}

public function editar() {

 $idregistro = $this->input->get('idregistro');
 $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');



 $datax['nombre'] = $nombrez;
 $datax['puesto'] = $this->session->userdata('puesto');
 $datax['menusolicitudes'] = "active";
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
 $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
 $data['tipo_avaluo'] = $this->models_tipo_avaluo->getWebservice();
 $data['objetivo_avaluo'] = $this->models_objetivo_avaluo->getWebservice();
 $data['empleados'] = $this->models_empleado->getInspector();
 $data['asigno'] = $this->models_empleado->getAsignador();
 $data['entidades'] = $this->models_c_entidades_municipios->getEstados();
 $data['tipoInmueble'] = $this->models_tipoinmueble->get();
 $data['intemediarios'] = $this->models_intermediariofinanciero->get();

     //buscar 
 $data['obj_registro'] = $this->models_registro->buscarObj($idregistro);
 $solicitanteobj=$this->models_solicitante->buscarObj($idregistro);
 $data['obj_solicitante'] = $solicitanteobj;
 $data['obj_vista'] = $this->models_visita->buscarObj($idregistro);
 $data['municipios']= $this->models_c_entidades_municipios->getMunicipios($solicitanteobj->ClaveEntidad);
 $obj_inmueble=$this->models_inmueble->buscarObj($idregistro);
 $data['obj_inmueble'] = $obj_inmueble;
 $data['municipios_i']= $this->models_c_entidades_municipios->getMunicipios($obj_inmueble->ClaveEntidad);

 $data['idregistro'] = $idregistro;



 $this->load->view('solicitudes/registroEditarGYS', $data);


}
public function editarCaptura() {

  $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');  
  $numexpediente="";
  $fecha_de_inspeccion=$this->input->post('fecha_visita');      
  $idInsepctor=$this->input->post('idInsepctor');
  $objetivoAvaluo=$this->input->post('objetivoAvaluo');
  $idtipo_avaluo=$this->input->post('idtipo_avaluo');
  $nomRefer=$this->input->post('nomRefer');
  $idIntemediario=$this->input->post('idIntemediario');
  $nombre_s=$this->input->post('nombre_s');
  $p_apellido_s=$this->input->post('p_apellido_s');
  $s_apellido_s=$this->input->post('s_apellido_s');
  $tipo_persona_s=$this->input->post('tipo_persona_s');
  $nss_s=$this->input->post('nss_s');
  $rfc_s=$this->input->post('rfc_s');
  $cp_s=$this->input->post('cp_s');
  $col_s=$this->input->post('col_s');
  $idEntidad_s=$this->input->post('idEntidad_s');
  $idMunicipio_s=$this->input->post('id_muni_s');
  $calle_s=$this->input->post('calle_s');
  $num_int_s=$this->input->post('num_int_s');
  $num_ext_s=$this->input->post('num_ext_s');
  $telefono_s=$this->input->post('telefono_s');
  $email_s=$this->input->post('email_s');
  $visita_exitosa=$this->input->post('visita_exitosa');

      // se agrego para editar 
  $idregistro=$this->input->post('idregistro');
      ///

  $nombreEstado="";
  $nombreMuni="";
  if($idEntidad_s!=-1){
    $nombreEstado=$this->models_c_entidades_municipios->getNombreEstado($idEntidad_s);
  }
  if($idMunicipio_s!=-1){
    $nombreMuni=$this->models_c_entidades_municipios->getNombreMunicipio($idEntidad_s);
  }

  $ubicacion=$calle_s." ,Num. Ext. ".$num_ext_s." ,Num. Int.".$num_int_s." ,Col.".$col_s." ,C.P.".$cp_s." , Mpio. ".$nombreMuni." ,".$nombreEstado;


  $idestado_registro=2;

  if ($fecha_de_inspeccion != ""&&$idInsepctor != "") {

    $idempleadobuscar =$this->models_empleado->Buscar($idInsepctor);
    $row = $idempleadobuscar->row();
    $count = $this->models_registro->countFolio($fecha_de_inspeccion,$idInsepctor);
    $sum=$count+1;
    $fechax=date("dmy", strtotime($fecha_de_inspeccion));
    $numexpediente=$fechax."".$row->iniciales."".$sum;

  }else{
   $numexpediente="";
 }



 $resultadoFinal = array();
 $resultadoFinal["referencia"] = $nomRefer;
 $resultadoFinal["num_expediente"] = $numexpediente;
 $resultadoFinal["num_avaluo"] = $this->input->post('folio_cliente');
 $resultadoFinal["id_asigno"] = $this->input->post('idEjecutivo');
 $resultadoFinal["telefono"] = $this->input->post('telefono_v');   
 $resultadoFinal["email"]= $this->input->post('email_v');
 $resultadoFinal["idtipo_avaluo"]= $idtipo_avaluo;
 $resultadoFinal["otros"]= $this->input->post('otros');
 $resultadoFinal["ubicacion"]= strtoupper($ubicacion);
 $resultadoFinal["costo"]= str_replace(".", "", $this->input->post('costo'));
 $resultadoFinal["registro_inicial"]= $this->models_registro->Horafecha();
 $resultadoFinal["monto_venta"]= str_replace(".", "", $this->input->post('monto_venta'));
 $resultadoFinal["monto_credito"]= str_replace(".", "", $this->input->post('monto_credito'));
 $resultadoFinal["idcapturista"]= $this->session->userdata('idempleado');
 $resultadoFinal["observaciones"]= $this->input->post('observaciones');
 $resultadoFinal["adelanto_pago"]= 0;
 $resultadoFinal["usuario_update"]= $nombrez;
 $resultadoFinal["idestado_registro"]= $idestado_registro;
 $resultadoFinal["tipoRegistro"]= 1;
 $resultadoFinal["idOperador"]= $this->input->post('idOperador');
 $resultadoFinal["reporteTesoreria"]= $this->input->post('reporteTesoreria');
 $resultadoFinal["usuario_entrega"]= $this->input->post('usuario_entrega');

 if ($fecha_de_inspeccion != "") {
   $fechasc=$this->calcularfechas($fecha_de_inspeccion);        
   $resultadoFinal["fecha_de_inspeccion"]= date_format($fechasc->fecha_de_inspeccion, 'Y-m-d');
   $resultadoFinal["hora_de_inspeccion"]= $this->input->post('hora_de_inspeccion');
   $resultadoFinal["fecha_de_entrega"]= date_format($fechasc->fecha_de_entrega, 'Y-m-d');
   $resultadoFinal["fecha_captura"]= date_format($fechasc->fecha_captura, 'Y-m-d');
   $resultadoFinal["fecha_cierre"]= date_format($fechasc->fecha_cierre, 'Y-m-d');
   $resultadoFinal["fecha_final"]= date_format($fechasc->fecha_final, 'Y-m-d');
   $resultadoFinal["fecha_asigancion"]= date_format($fechasc->fecha_asigancion, 'Y-m-d');
 }

 if ($objetivoAvaluo != "") {
   $resultadoFinal["idobjetivo_avaluo"]= $objetivoAvaluo;
 }else{
   $resultadoFinal["idobjetivo_avaluo"]=0;
 }

 if ($idInsepctor != "") {
  $resultadoFinal["idempleado"]= $idInsepctor;
}else{
 $resultadoFinal["idempleado"]=0;
}

$intermediario=$this->input->post('idIntemediario');
if ($intermediario != "") {

 if($intermediario==-1) {

  $resultadoFinal["intermediario"]=$this->input->post('otro_intermediario');
}else{

 $resultadoFinal["intermediario"]= $this->models_intermediariofinanciero->buscardescripcion($intermediario);
 $resultadoFinal["clave"]= $intermediario;
}

}else{
  $resultadoFinal["intermediario"]="";
}   


$this->models_registro->update($idregistro,$resultadoFinal);

if ($fecha_de_inspeccion != ""&&$idInsepctor != "") {


 $this->asignarInspecion($idInsepctor,$idregistro);


}
    // se van insertar en las nuevas tablas
    //================ visita ====================== 
$vistar = array();
if ($fecha_de_inspeccion != "") {
  $fechaHora=$fecha_de_inspeccion." ".$this->input->post('hora_de_inspeccion').":00";
       // echo $fechaHora;
  $vistar["FechaVisita"] = $fechaHora;
}

if($visita_exitosa!=-1){

 $vistar["VisitaExitosa"] = $visita_exitosa;
}
$vistar["ContactoVisita"] = $nomRefer;
$vistar["Telefono"] = $this->input->post('telefono_v');
    //$vistar["idregistro"] = $idregistro;

$this->models_visita->update($idregistro,$vistar);
    //================ Solicitante ====================== 

$solicitanter = array();
$solicitanter["Nombre"] = $nombre_s;
$solicitanter["ApellidoPaterno"] = $p_apellido_s;
$solicitanter["ApellidoMaterno"] = $s_apellido_s;
$solicitanter["PersonaMoral"] = $tipo_persona_s;
$solicitanter["Rfc"] = $rfc_s;
$solicitanter["Nss"] = $nss_s;
if ($cp_s != "") {
 $solicitanter["CodigoPostal"] = $cp_s;
}
$solicitanter["ClaveEntidad"] = $idEntidad_s;
$solicitanter["ClaveMunicipio"] = $idMunicipio_s;
$solicitanter["Colonia"] = $col_s;
$solicitanter["Calle"] = $calle_s;
$solicitanter["NumeroExterior"] = $num_ext_s;
$solicitanter["NumeroInterior"] = $num_int_s;
$solicitanter["Telefono"] = $telefono_s;
$solicitanter["CorreoElectronico"] = $email_s;
   // $solicitanter["idregistro"] = $valor;
$this->models_solicitante->update($idregistro,$solicitanter);

    //===================Inmueble ==============
$idtipo_avaluo_i=$this->input->post('idtipo_avaluo_i');
$cp_i=$this->input->post('cp_i');
$idEntidad_i=$this->input->post('idEntidad_i');
$id_muni_i=$this->input->post('id_muni_i');
$col_i=$this->input->post('col_i');
$calle_i=$this->input->post('calle_i');
$num_int_i=$this->input->post('num_int_i');
$num_ex_i=$this->input->post('num_ex_i');
$mz_i=$this->input->post('mz_i');
$lt_i=$this->input->post('lt_i');
$condominio_i=$this->input->post('condominio_i');
$entrada_i=$this->input->post('entrada_i');
$edificio_i=$this->input->post('edificio_i');
$depto_i=$this->input->post('depto_i');
$entre_calle_i=$this->input->post('entre_calle_i');
$yCalle_i=$this->input->post('yCalle_i');
$ciudad_i=$this->input->post('ciudad_i');
$latitud_i=$this->input->post('latitud_i');
$longitud_i=$this->input->post('longitud_i');
$altitud_i=$this->input->post('altitud_i');

$inmuebleArray = array();
$inmuebleArray["CodigoPostal"] = $cp_i;
$inmuebleArray["ClaveEntidad"] = $idEntidad_i;
$inmuebleArray["ClaveMunicipio"] = $id_muni_i;
$inmuebleArray["Colonia"] = $col_i;
$inmuebleArray["Calle"] = $calle_i;
$inmuebleArray["NumeroExterior"] = $num_ex_i;
$inmuebleArray["NumeroInterior"] = $num_int_i;
        //$inmuebleArray["SuperManzana"] = $mz_i;
$inmuebleArray["Manzana"] = $mz_i;
$inmuebleArray["Lote"] = $lt_i;
$inmuebleArray["Condominio"] = $condominio_i;
$inmuebleArray["Entrada"] = $entrada_i;
$inmuebleArray["Edificio"] = $edificio_i;
$inmuebleArray["Departamento"] = $depto_i;
$inmuebleArray["EntreCalle"] = $entre_calle_i;
$inmuebleArray["YCalle"] = $yCalle_i;
$inmuebleArray["Ciudad"] = $ciudad_i;
$inmuebleArray["Latitud"] = $latitud_i;
$inmuebleArray["Longitud"] = $longitud_i;
$inmuebleArray["Altitud"] = $altitud_i;
   // $inmuebleArray["idregistro"] = $valor;
$inmuebleArray["idtipoInmueble"] = $idtipo_avaluo_i;

$this->models_inmueble->update($idregistro,$inmuebleArray);


$gys=$this->input->post('gys');

if($gys==1){

  $this->enviarWebService($idregistro);
  
  redirect('solicitudesWebService/enviarGYS?idregistro='.$idregistro, 'refresh');
}else{

   redirect('solicitudesWebService/editar?idregistro='.$idregistro, 'refresh');

}





}


public function enviarGYS() {

 $idregistro = $this->input->get('idregistro');
 $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');



 $datax['nombre'] = $nombrez;
 $datax['puesto'] = $this->session->userdata('puesto');
 $datax['menusolicitudes'] = "active";
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
 $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
 $data['tipo_avaluo'] = $this->models_tipo_avaluo->getWebservice();
 $data['objetivo_avaluo'] = $this->models_objetivo_avaluo->getWebservice();
 $data['empleados'] = $this->models_empleado->getInspector();
 $data['asigno'] = $this->models_empleado->getAsignador();
 $data['entidades'] = $this->models_c_entidades_municipios->getEstados();
 $data['tipoInmueble'] = $this->models_tipoinmueble->get();
 $data['intemediarios'] = $this->models_intermediariofinanciero->get();

     //buscar 
 $data['obj_registro'] = $this->models_registro->buscarObj($idregistro);
 $solicitanteobj=$this->models_solicitante->buscarObj($idregistro);
 $data['obj_solicitante'] = $solicitanteobj;
 $data['obj_vista'] = $this->models_visita->buscarObj($idregistro);
 $data['municipios']= $this->models_c_entidades_municipios->getMunicipios($solicitanteobj->ClaveEntidad);
 $obj_inmueble=$this->models_inmueble->buscarObj($idregistro);
 $data['obj_inmueble'] = $obj_inmueble;
 $data['municipios_i']= $this->models_c_entidades_municipios->getMunicipios($obj_inmueble->ClaveEntidad);

 $data['idregistro'] = $idregistro;



 $this->load->view('solicitudes/registroEnviarGYS', $data);




}


public function enviarWebService($idRegistro) {

  $this->load->model('models_webservice');
  $obj_inmueble=$this->models_inmueble->buscarObj($idRegistro);
  $inmueble =(object) array("ClaveTipoInmueble" => $obj_inmueble->idtipoInmueble, 
    "CodigoPostal" => $obj_inmueble->CodigoPostal, 
    "ClaveEntidad" =>  $obj_inmueble->ClaveEntidad,
    "ClaveMunicipio" => $obj_inmueble->ClaveMunicipio,
    "Colonia" => $this->replace_null($obj_inmueble->Colonia,""),
    "Calle" => $this->replace_null($obj_inmueble->Calle,""),
    "NumeroExterior" => $this->replace_null($obj_inmueble->NumeroExterior,""),
    "NumeroInterior" => $this->replace_null($obj_inmueble->NumeroInterior,""),
    "SuperManzana" => "-",
    "Manzana" => $this->replace_null($obj_inmueble->Manzana,""),
    "Lote" => $this->replace_null($obj_inmueble->Lote,""),
    "Condominio" => $this->replace_null($obj_inmueble->Condominio,""),
    "Entrada" => $this->replace_null($obj_inmueble->Entrada,""),
    "Edificio" => $this->replace_null($obj_inmueble->Edificio,""),
    "Departamento" => $this->replace_null($obj_inmueble->Departamento,""),
    "EntreCalle" => $this->replace_null($obj_inmueble->EntreCalle,""),
    "YCalle" => $this->replace_null($obj_inmueble->YCalle,""),
    "Ciudad" => $this->replace_null($obj_inmueble->Ciudad,""),
    "Latitud" => $obj_inmueble->Latitud,
    "Longitud" => $obj_inmueble->Longitud,
    "Altitud" => $obj_inmueble->Altitud);


  $solicitanteobj=$this->models_solicitante->buscarObj($idRegistro);

  $person=$solicitanteobj->PersonaMoral;

  $tipoPersonas=false;

  if($person==='Moral'){

   $tipoPersonas=true;
 }

 $solicitante = (object) array("Nombre" => $solicitanteobj->Nombre,
  "ApellidoPaterno" => $solicitanteobj->ApellidoPaterno,
  "ApellidoMaterno" => $this->replace_null($solicitanteobj->ApellidoMaterno,""),
  "PersonaMoral" => $tipoPersonas,
  "Rfc" => $this->replace_null($solicitanteobj->Rfc,""),
  "Nss" => $this->replace_null($solicitanteobj->Nss,""),
  "CodigoPostal" => $solicitanteobj->CodigoPostal,
  "ClaveEntidad" => $solicitanteobj->ClaveEntidad,
  "ClaveMunicipio" => $solicitanteobj->ClaveMunicipio,
  "Colonia" => $this->replace_null($solicitanteobj->Colonia,""),
  "Calle" => $this->replace_null($solicitanteobj->Calle,""),
  "NumeroExterior" => $this->replace_null($solicitanteobj->NumeroExterior,""),
  "NumeroInterior" => $this->replace_null($solicitanteobj->NumeroInterior,""),
  "Telefono" => $this->replace_null($solicitanteobj->Telefono,""),
  "CorreoElectronico" => $this->replace_null($solicitanteobj->CorreoElectronico,""));

 $objetVistas=$this->models_visita->buscarObj($idRegistro);

 $FechaVisita = date("c", strtotime($objetVistas->FechaVisita));

 $vistaExi=$objetVistas->VisitaExitosa;
 $vistaExitova=false;
 if($vistaExi==1){

   $vistaExitova=true;

 }


 $visita = (object) array("FechaVisita" => $FechaVisita,
  "VisitaExitosa" =>$vistaExitova,
  "ContactoVisita" => $this->replace_null($objetVistas->ContactoVisita,""),
  "Telefono" =>$this->replace_null($objetVistas->Telefono,""));



 $objetoRegistro=$this->models_registro->buscarObjv2($idRegistro);
 $reporteTe=$objetoRegistro->reporteTesoreria;
 $reporteTesoreria=false;

 if($reporteTe==1){

   $reporteTesoreria=true;
 }


 $dateEntrega = date("c", strtotime($objetoRegistro->fecha_de_entrega));
 $dateSolicitud = date("c", strtotime($objetoRegistro->registro));
 $configuracion = (object) array("FechaCompromisoEntrega" => $dateEntrega,
  "FechaSolicitado" => $dateSolicitud,
  "FolioCliente" => $objetoRegistro->num_expediente,
   "ClaveOperador" => 694,
                     "ClaveVisitador" => 694,
                     "ClaveEjecutivo" => 694,
                     "ClaveProducto" => 2173, // tabla ADMIN objetivo_avaluo
                     "ClavePropositoAvaluo" => 2,  // tabla ADMIN tipo_avaluo

  /*"ClaveOperador" => $objetoRegistro->idOperador,
  "ClaveVisitador" => $objetoRegistro->ClaveVisitador,
  "ClaveEjecutivo" => $objetoRegistro->ClaveEjecutivo,
                     "ClaveProducto" => $objetoRegistro->ClaveProducto, // tabla ADMIN objetivo_avaluo
                     "ClavePropositoAvaluo" => $objetoRegistro->ClavePropositoAvaluo,  // tabla ADMIN tipo_avaluo*/
                     "ReportaTesoreriaCDMX" => $reporteTesoreria,
                     "ClaveIntermediarioFinanciero" => "030002",
                     "ClaveSociedadTesoreria" => 2);


 $respuesta=$this->models_webservice->conectar($inmueble,$solicitante,$visita,$configuracion);

 $valorex=0;
 if($respuesta->Exito==true){
  $valorex=1;
}



//echo $respuesta->Exito."<br>";
//echo $respuesta->Mensaje."<br>";

$resultado = str_replace("Servicio registrado exitosamente con el folio", "", $respuesta->Mensaje);

//echo $resultado;


$datosUpdate = array("estatusGY" => $valorex,
  "folio" =>$resultado);
$objetoRegistro=$this->models_registro->update($idRegistro,$datosUpdate);



}

function replace_null($value, $replace) {
  if (is_null($value)) return $replace;
  return $value;
}

}
