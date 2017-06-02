<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

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


        $this->load->model('models_quincena');
        $this->load->model('models_recibo');
        $this->load->model('models_cantidad_conceptos');
        $this->load->model('models_avaluos');
        $this->load->model('models_estado_registro');
        $this->load->model('models_estado_empleado');
        $this->load->model('models_empleado');

        
    }

    public function index() {


        $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
        $datax['nombre'] = $nombrez;
        $datax['puesto'] = $this->session->userdata('puesto');
        $data['nombre'] = $nombrez;
        $datax['menuantecedentes'] = 'x';
        
        $pila = $this->session->userdata('listpuesto');
        $clave = array_search('8',$pila); 

        $boolenVer=0;;
        if($clave!=''){
           $boolenVer=1;
       }
       $datax['verSolicitudesBusqueda']=$boolenVer;

       $datax['solicitudes'] = 'x';
       $datax['menuquincena'] = "active";


       $data['idcapturista'] = $this->session->userdata('idempleado');
       $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
       $data['head'] = $this->load->view('plantilla/head', true);
       $data['registros'] = $this->models_quincena->getactivos();
       $this->load->view('registro/registro', $data);
   }

   public function trabajar() {

    $idquince = $this->input->get('idquincena');
    $idempleado = $this->session->userdata('idempleado');


    $idregistro = $this->models_recibo->Buscarquin($idquince, $idempleado);

    $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
    $datax['nombre'] = $nombrez;
    $datax['puesto'] = $this->session->userdata('puesto');
    $data['nombre'] = $nombrez;
    $data['idcapturista'] = $idempleado;
    $data['idquincena'] = $idquince;
    $datax['menuantecedentes'] = 'x';
    $datax['solicitudes'] = 'x';
    $datax['menuquincena'] = "active";
    $pila = $this->session->userdata('listpuesto');
    $clave = array_search('8',$pila); 

    $boolenVer=0;;
    if($clave!=''){
       $boolenVer=1;
   }
   $datax['verSolicitudesBusqueda']=$boolenVer;
   $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
   $data['head'] = $this->load->view('plantilla/head', true);


   $squery = $this->models_recibo->Buscar($idregistro);


   if ($squery->num_rows() == 0) {
    redirect('registro', 'refresh');
            //echo "no hay registro";
} else {
    $rowx = $squery->row();
            //echo $rowx->reestado;
    if ($rowx->reestado == 'ACTIVO') {
        $conceptos = $this->models_recibo->conceptos($rowx->idempleado, 1);

        $suma = 0;
        $html = '';
        if (isset($conceptos)) {
            foreach ($conceptos->result() as $rowxc) {

                $res = $this->models_cantidad_conceptos->Buscarcapturadocantidad($rowxc->idcosto_concepto, $idregistro);
                if ($res == 0) {
                    $html.= ' <tr>
                    <td>' . $rowxc->nombre . '</td>
                    <td> $ ' . $rowxc->costo . '</td>
                    <td><input value="0" class="form-control input-circle" type="text" id="can_' . $rowxc->idcosto_concepto . '"></td>
                    <td><label id="subtotal_' . $rowxc->idcosto_concepto . '">$ 0</label></td>
                    <td><a href="#add"  name="' . $rowxc->costo . '" title="' . $rowxc->idcosto_concepto . '" class="btn default btn-xs actualizarbtn">ACTUALIZAR</a>

                    </td>


                </tr>';
            } else {

                $sub = $rowxc->costo * $res;
                $suma+=$sub;
                $html.= ' <tr>
                <td>' . $rowxc->nombre . '</td>
                <td> $ ' . $rowxc->costo . '</td>
                <td><input class="form-control input-circle" type="text" value="' . $res . '" id="can_' . $rowxc->idcosto_concepto . '"></td>
                <td><label id="subtotal_' . $rowxc->idcosto_concepto . '"> $ ' . $sub . '</label></td>
                <td><a href="#add"  name="' . $rowxc->costo . '" title="' . $rowxc->idcosto_concepto . '" class="btn default btn-xs actualizarbtn">ACTUALIZAR</a>

                </td>


            </tr>';
        }
    }
}
$otros = $this->models_recibo->conceptosotros($idquince, $idempleado);
if (isset($otros)) {
    foreach ($otros->result() as $rowot) {
        $subx = $rowot->costo * $rowot->cantidad;
        $suma+=$subx;
        $html.= ' <tr>
        <td>' . $rowot->tipo.'</td>
        <td> $ ' . $rowot->costo . '</td>
        <td><label> ' . $rowot->cantidad . '</label></td>
        <td><label> $ ' . $subx . '</label></td>
        <td>

        </td>


    </tr>';
}
}



$data['sub'] = $suma;
$data['conceptos'] = $html;
$data['conceptoscalotros'] = $this->models_recibo->conceptos($rowx->idempleado, 2);
$data['conceptosAvaluos'] = $this->models_recibo->conceptos($rowx->idempleado, 3);

$data['idrecibo'] = $idregistro;
$data['query'] = $squery;



$this->load->view('registro/editar', $data);
} else {
                //  echo "no hay registro abajo";
    redirect('registro', 'refresh');
}
}
}

public function registro() {


    $valor = $this->models_avaluos->BuscarExistencia($this->input->post('avaluo'), $this->input->post('tipo'));

    if ($valor == "-") {
        $tipo = "";
        $observacion=$this->input->post('observacion');
        $costo = 0;
        if ($this->input->post('idtipo') == 2) {
            list($tipox, $costox) = explode("-", $this->input->post('tipo'));
            $tipo = $tipox;
            $costo = $costox;
        }else if($this->input->post('idtipo') ==3){

           list($tipox, $costox) = explode("-", $this->input->post('tipoConce'));
           $observacion = $tipox;
           $tipo= $tipox;
           $costo = $costox;

       } else {

        $costo = $this->input->post('costo');
    }
////REVISIONES EXTERNAS
////Correcciones
/////Avalúos
    $costoPersonalizado= $this->input->post('costoPersonalizado');
    $observacionPersonalizado= $this->input->post('observacionPersonalizado');
    if (empty($costoPersonalizado)){
        $data = array(
            'idempleado' => $this->input->post('idEmpleado'),
            'idquincena' => $this->input->post('idquincena'),
            'tipo' => $tipo,
            'costo' => $costo,
            'observacion' => $observacion,
            'idtipo' => $this->input->post('idtipo'),
            'numero' => $this->input->post('avaluo'));

        $this->models_avaluos->insertar($data);



    }else{

        $data = array(
            'idempleado' => $this->input->post('idEmpleado'),
            'idquincena' => $this->input->post('idquincena'),
            'tipo' =>  $observacionPersonalizado,
            'costo' => $costoPersonalizado,
            'observacion' =>  $observacionPersonalizado,
            'idtipo' => $this->input->post('idtipo'),
            'numero' => $this->input->post('avaluo'));

        $this->models_avaluos->insertar($data);
    }



    echo '<div class="block"><div class="alert alert-success"><h1> <b>Registro!</b> Se registro correctamente!</h1> <button type="button" class="close" data-dismiss="alert">×</button></div></div>';
} else {

    echo '<div class="block"><div class="alert alert-danger"><h1> <b>Error!</b> Ya está registrado este avaluó al empleado ' . $valor->Nombre . ' ' . $valor->apellidos . '</h1><button type="button" class="close" data-dismiss="alert">×</button></div></div>';
}
}

public function actualizarconceptos() {





    $idcosto_concepto = $this->input->get('idcosto_concepto');
    $cantidad = $this->input->get('cantidad');
    $costo = $this->input->get('costo');
    $idrecibo = $this->input->get('idrecibo');


    $res = $this->models_cantidad_conceptos->Buscarcapturado($idcosto_concepto, $idrecibo);
    $resco = 0;
    if ($res == 0) {
        $resco = $cantidad * $costo;
        $data = array(
            'idcosto_concepto' => $idcosto_concepto,
            'cantidad' => $cantidad,
            'idrecibo' => $idrecibo,
            'costo' => $costo);

        $this->models_cantidad_conceptos->insertar($data);
    } else {
        $resco = $cantidad * $costo;
        $data = array(
            'cantidad' => $cantidad,
            'costo' => $costo);

        $this->models_cantidad_conceptos->update($res, $data);
    }
    echo '$ ' . $resco;
}

public function actulizarsubto() {

    $idrecibo = $this->input->get('idrecibo');
    $idempleado = $this->session->userdata('idempleado');
    $idquince = $this->input->get('idquince');

    $suma = $this->models_cantidad_conceptos->sum($idrecibo);
    $otros = $this->models_recibo->conceptosotros($idquince, $idempleado);
    if (isset($otros)) {
        foreach ($otros->result() as $rowot) {
            $subx = $rowot->costo * $rowot->cantidad;
            $suma+=$subx;
        }
    }

    echo $res = '$ ' . $suma;
}

public function mostrar() {


    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }
    $idempleado = $this->session->userdata('idempleado');
    $nombre = trim($this->input->get('nombre'));
    $data['registros'] = $this->models_avaluos->mostrarem($nombre, $idempleado, $offset, $this->limite);
    $total = $this->models_avaluos->mostrarcountem($nombre, $idempleado);
    $data['total'] = $total;
    $config['base_url'] = base_url() . 'registro/mostrar?nombre=' . $nombre;
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

        $pila = $this->session->userdata('listpuesto');
        $clave = array_search('8',$pila); 

        $boolenVer=0;;
        if($clave!=''){
           $boolenVer=1;
       }
       $datax['verSolicitudesBusqueda']=$boolenVer;
       $datax['menuquincena'] = "active";

       $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
       $data['head'] = $this->load->view('plantilla/head', true);
       $this->load->view('registro/listar', $data);
   }

   public function eliminar() {

    $idregistro = $this->input->get('idavaluos');
    $this->models_avaluos->eliminar($idregistro);
    redirect('registro/mostrar', 'refresh');
}

    //actualizacion de los datos 
public function contrasena() {

    $data['msn'] = -1;
    $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');

    $datax['nombre'] = $nombrez;
    $datax['puesto'] = $this->session->userdata('puesto');
    $datax['munupass'] = "Active";


    $data['nombre'] = $nombrez;
    $pila = $this->session->userdata('listpuesto');
    $clave = array_search('8',$pila); 

    $boolenVer=0;;
    if($clave!=''){
       $boolenVer=1;
   }
   $datax['verSolicitudesBusqueda']=$boolenVer;
   $data['idcapturista'] = $this->session->userdata('idempleado');
   $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
   $data['head'] = $this->load->view('plantilla/head', true);
   $this->load->view('empleado/contrasena', $data);
}

public function actualizar() {


    $this->load->model('models_empleado');
    $idregistro = $this->session->userdata('idempleado');
    $pass = $this->input->post('pass');




    $data = array(
        'pass' => $pass);

    $this->models_empleado->updatepass($idregistro, $data);

    redirect('registro/contrasena', 'refresh');
}

public function actualizestado() {




    $idestado_empleado = $this->input->get('idestado_empleado');
    $this->load->model('models_estado_empleado');



    $data = array(
        'registro' => $this->models_estado_empleado->Horafecha(),
        'estado' => 1);

    $this->models_estado_empleado->update($idestado_empleado, $data);

    redirect('registro/mostrarsolicitudes', 'refresh');
}







// estos son solictides
public function aprobados() {
    $this->load->model('models_estado_empleado');
    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }

    $nombre = trim($this->input->get('buscar'));
    $data['registros'] = $this->models_estado_empleado->listar($nombre, "1", $this->session->userdata('idempleado'), $offset, $this->limite);

    $config['base_url'] = base_url() . 'registro/aprobados?buscar=' . $nombre;
    $ttt = $this->models_estado_empleado->listarcount($nombre, "1", $this->session->userdata('idempleado'));
    $config['total_rows'] = $ttt;
    $data['totalrow'] = $ttt;
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
        $datax['menusolicitudes'] = "active";
        $datax['menucatalogos'] = "x";
        $datax['menuadmin'] = "x";
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
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;

        $data['idcapturista'] = $this->session->userdata('idempleado');
        $datax['menuantecedentes'] = 'x';
        $datax['solicitudes'] = 'active';

        $pila = $this->session->userdata('listpuesto');
        $clave = array_search('8',$pila); 

        $boolenVer=0;;
        if($clave!=''){
           $boolenVer=1;
       }
       $datax['verSolicitudesBusqueda']=$boolenVer;

       $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
       $data['head'] = $this->load->view('plantilla/head', true);

        // usuario
       $data['url'] = $this->config->item('urlarchivos');
       $this->load->view('registro/listar_solicitudes_aprobados', $data);
   }

   public function mostrarsolicitudes() {
    $this->load->model('models_estado_empleado');
    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }

    $nombre = trim($this->input->get('buscar'));
    $data['registros'] = $this->models_estado_empleado->listar($nombre, "0", $this->session->userdata('idempleado'), $offset, $this->limite);

    $config['base_url'] = base_url() . 'registro/mostrarsolicitudes?buscar=' . $nombre;
    $ttt = $this->models_estado_empleado->listarcount($nombre, "0", $this->session->userdata('idempleado'));
    $config['total_rows'] = $ttt;
    $data['totalrow'] = $ttt;
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
        $datax['menusolicitudes'] = "active";
        

        $data['nombre'] = $nombrez;
        $datax['menuantecedentes'] = 'x';
        $datax['solicitudes'] = 'active';
        $data['idcapturista'] = $this->session->userdata('idempleado');

        $pila = $this->session->userdata('listpuesto');
        $clave = array_search('8',$pila); 

        $boolenVer=0;;
        if($clave!=''){
           $boolenVer=1;
       }
       $datax['verSolicitudesBusqueda']=$boolenVer;

       $data['menu'] = $this->load->view('plantilla/menudos', $datax, true);
       // $data['head'] = $this->load->view('plantilla/head', true);

        // usuario
       $data['url'] = $this->config->item('urlarchivos');
       $this->load->view('registro/listar_solicitudes', $data);



   }

   public function actualizarFecha() {

    $this->load->model('models_registro');
    $idregistro = $this->input->get('idregistro');
//calular fechas

    $hoy = $this->models_registro->fecha();

//calcular asigancion
    $dateasignar = date_create($hoy);
    $contadorasignar = 1;
    $limasignar = 2;
    $lim3asignar = 0;
    for ($i = 1; $i <= 5; $i++) {
        $nuevafor = strtotime('+' . $i . ' day', strtotime($hoy));
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
    $limcaptura = 3;
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
    $limcierre = 3;
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



//        //echo $idregistro;
//        echo $hoy . "<br>";
//        echo $f2 . "<br>";
//        echo $f4 . "<br>";
//        echo $f5 . "<br>";
    $data = array(
        'estado_fecha' => "cerrado",
        'fecha_de_entrega' => $hoy,
        'fecha_asigancion' => $f2,
        'fecha_captura' => $f4,
        'fecha_cierre' => $f5);

    $this->models_registro->update($idregistro, $data);

        //echo ">>>>>>>>>".$idregistro;
    redirect('registro/mostrarsolicitudes', 'refresh');
}


public function asignarIndividual() {


    $idregistro = $this->input->get('idregistro'); 
    $idestado_empleado = $this->input->get('idestado_empleado');          
    $data['estados'] = $this->models_estado_registro->get();
    $data['registros'] = $this->models_estado_empleado->mostrarRegistro($idregistro);       
    $data['empleados'] = $this->models_empleado->get();
    $data['idregistro'] = $idregistro;
    $data['idestado_empleado'] = $idestado_empleado;
    $ver=$this->load->view('asignar/registroindividualver', $data,true);
    echo $ver;



}

public function actualizestadoYasigar() {




    $idestado_empleado = $this->input->get('idestado_empleado');       

    $this->load->model('models_registro');
    $datax = array(
        'registro' => $this->models_estado_empleado->Horafecha(),
        'estado' => 1);
    $this->models_estado_empleado->update($idestado_empleado, $datax);

        //asigar
    $idregistro = $this->input->get('idregistro');
    $idempleado = $this->input->get('idempleado');
    $idestado_registro = $this->input->get('idestado_registro');

    $data = array(
        'idestado_registro' => $idestado_registro,
        'idregistro' => $idregistro,
        'idempleado' => $idempleado,
        'estado' => 0);

    $this->models_estado_empleado->insertar($data);

    $datay = array(
        'fecha_cierre' => $this->models_registro->fechaCierreUpdate());

    $this->models_registro->update($idregistro,$datay);

    redirect('registro/aprobados', 'refresh');
}




}
