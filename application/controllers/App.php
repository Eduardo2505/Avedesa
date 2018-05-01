<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
//use Restserver\Libraries\REST_Controller;
class App extends REST_Controller {

	private $limite = 20;
	private $limiteinicio = 8;

	function __construct() {

		parent::__construct();

    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");

    $this->load->model('models_estado_registro');
    $this->load->model('models_empleado');
    $this->load->model('models_estado_empleado');
    $this->load->model('models_registro');
    $this->load->model('models_pagos');
    $this->load->model('models_pagoseliminados');
    $this->load->model('models_archivos');
		
  }



  public function login_post() {



    $data=$this->post();

    if(!isset($data['email']) OR !isset($data['password'])){

      $respuesta=array();
      $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
      return;
    }

    $email=$data['email'];
    $password=$data['password'];
    $nota=$this->models_empleado->login($email,$password);
    $this->response($nota->result());


  }


  public function mostraAnexos_get() {


    $idregistro = $this->input->get('idregistro');
    $buscar = $this->input->get('buscar');
    $tipo = $this->input->get('tipo');
    $offset= $this->input->get('offset');
    $registros=$this->models_archivos->mostrarapp($buscar, $idregistro, $tipo, $offset, $this->limite);
    $this->response($registros->result());

  }


  public function solicitudesPedientes_get() {


    $idempleado = $this->input->get('idempleado');
    $buscar = $this->input->get('buscar');
    $offset= $this->input->get('offset');
    $registros=$this->models_estado_empleado->listarApp($buscar, "0", $idempleado, $offset, $this->limite);
    $this->response($registros->result());

  }
  public function solicitudesInicio_get() {


    $idempleado = $this->input->get('idempleado');
    $buscar = $this->input->get('buscar');
    $offset= $this->input->get('offset');
    $registros=$this->models_estado_empleado->listarApp($buscar, "0", $idempleado, $offset, $this->limiteinicio);
    $this->response($registros->result());

  }
  public function solicitudesAprobados_get() {


    $idempleado = $this->input->get('idempleado');
    $buscar = $this->input->get('buscar');
    $offset= $this->input->get('offset');
    $registros=$this->models_estado_empleado->listarApp($buscar, "1", $idempleado, $offset, $this->limite);
    $this->response($registros->result());

  }

  public function buscar_get() {


    $idregistro = $this->input->get('idregistro');
    $registros=$this->models_registro->buscar($idregistro);
    $this->response($registros->result());

  }

  public function buscarconsultarfechas_get() {


    $idregistro = $this->input->get('idregistro');
    $registros=$this->models_estado_registro->consultarfechas($idregistro);
    $this->response($registros->result());

  }


  public function listaempleados_get() {

    $registros = $this->models_empleado->get();
    $this->response($registros->result());
  }
  public function estadosIndividuales_get() {

   $idregistro = $this->input->get('idregistro');
   $registros = $this->models_estado_empleado->mostrarRegistro($idregistro);
   $this->response($registros->result());
 }



 public function actualizestado_get() {

  $idestado_empleado = $this->input->get('idestado_empleado');
  $data = array(
    'registro' => $this->models_estado_empleado->Horafecha(),
    'estado' => 1);

  $respuesta=$this->models_estado_empleado->update($idestado_empleado, $data);


  $respuestax = array('mensaje' => $respuesta);
              $this->response($respuestax);
}




public function comprobarIncial_get() {

  $idregistro = $this->input->get('idregistro');
  $idestado_registro = $this->input->get('idestado_registro');


  $canti = $this->models_estado_empleado->comprobar($idestado_registro, $idregistro,1);
  if ($canti == 0) {

    $respuesta = array('mensaje' => 1);
              $this->response($respuesta);
  }else{

    $respuesta = array('mensaje' => 0);
              $this->response($respuesta);
  }
}

public function comprobarcierre_get() {

  $idregistro = $this->input->get('idregistro');
  $idestado_registro = $this->input->get('idestado_registro');


  $canti = $this->models_estado_empleado->comprobar($idestado_registro, $idregistro,0);
  if ($canti == 0) {

             $respuesta = array('mensaje' => 1);
              $this->response($respuesta);
  }else{

             $respuesta = array('mensaje' => 0);
              $this->response($respuesta);
 }
}

public function cerrarAsiganar_get() {

  $idregistro = $this->input->get('idregistro');
  $idempleado = $this->input->get('idempleado');
  $idestado_registro = $this->input->get('idestado_registro');


  $canti = $this->models_estado_empleado->comprobar($idestado_registro, $idregistro,0);

  if ($canti == 0) {
    $data = array(
      'idestado_registro' => $idestado_registro,
      'idregistro' => $idregistro,
      'idempleado' => $idempleado,
      'estado' => 0);

    $this->models_estado_empleado->insertar($data);
    if ($idestado_registro == 2) {
                /*se va actulizar el numero de registro
                =====================================
                =======================================*/
                $fecha_de_inspeccion=$this->input->get('fecha_de_inspeccion');

                if (strcmp ($fecha_de_inspeccion , '0000-00-00') !== 0) {

                  $idempleadobuscar =$this->models_empleado->Buscar($idempleado);
                  $row = $idempleadobuscar->row();
                  $count = $this->models_registro->countFolio($fecha_de_inspeccion,$idempleado);
                  $sum=$count+1;
                  $fechax=date("dmy", strtotime($fecha_de_inspeccion));
                  $numexpediente=$fechax."".$row->iniciales."".$sum;


                  $datax = array(
                    'idestado_registro' => $idestado_registro,
                    'num_expediente' => $numexpediente,
                    'idempleado' => $idempleado);



                }else{
                 $datax = array(
                  'idestado_registro' => $idestado_registro,
                  'idempleado' => $idempleado);

               }
               $this->models_registro->update($idregistro, $datax);


             }
              $respuesta = array('mensaje' => 1);
              $this->response($respuesta);

           } else {

             $respuesta = array('mensaje' => 0);
              $this->response($respuesta);
          }








        }

        public function getPagosUsuario_get() {

          $idempleado = $this->input->get('idempleado');
          $idregistro = $this->input->get('idregistro');
          $registros = $this->models_pagos->getPagosUsuario($idempleado,$idregistro);
          $this->response($registros->result());
        }


        public function registroPago_post() {

         $data = array(
          'usuario' => $this->input->post('usuario'),
          'anticipo' => $this->input->post('anticipo'),
          'descripcion' =>  $this->input->post('descripcion'),
          'idempleado' =>  $this->input->post('idempleado'),
          'idregistro' => $this->input->post('idregistro'));

         $valor = $this->models_pagos->insertar($data);


          $respuesta = array(
          'mensaje' => $valor);


           $this->response($respuesta);


       }



       public function eliminarPago_post() {

        $idregistro = $this->input->post('idregistro');
        $idpagos = $this->input->post('idpagos');
        $nombrez = $this->input->post('usuario');
        $data = array(
          'estado' => 0);
        $datax = array(
          'idpagos' => $idpagos,
          'usuario' => $nombrez);

        $valorx = $this->models_pagoseliminados->insertar($datax);

        $valor = $this->models_pagos->update($idpagos,$data);

         $respuesta = array(
          'mensaje' => $valor);


           $this->response($respuesta);

      }


      public function actualizarPass_post() {

        $idempleado=$this->input->post('idempleado');
        $data = array(
          'pass' => $this->input->post('passworduno'));

        $valor = $this->models_empleado->updatepass($idempleado,$data);


         $respuesta = array(
          'mensaje' => $valor);


           $this->response($respuesta);


      }


      public function insetarimg_get() {

          $idempleado = $this->input->get('idempleado');
          $idregistro = $this->input->get('idregistro');
          $archivo = $this->input->get('archivo');
          $tipo = $this->input->get('tipo');

           $info = $this->models_empleado->Buscar($idempleado);
           $row = $info->row();



          $data = array(
          'url' => $archivo,
          'urlDropbox' => '-',
          'descripcion' =>$archivo,
          'idregistro' => $idregistro,
          'usuario' => $row->Nombre.' '.$row->apellidos,
          'tipo' => $tipo,
          'dropbox'=>0);


          $registros = $this->models_archivos->insertar($data);

          $respuesta = array(
          'mensaje' => $registros);

          $this->response($respuesta);


        }







    }
