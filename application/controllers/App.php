<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	private $limite = 20;
	private $limiteinicio = 8;

	function __construct() {

		parent::__construct();

		$this->load->model('models_estado_registro');
		$this->load->model('models_empleado');
		$this->load->model('models_estado_empleado');
		$this->load->model('models_registro');
    $this->load->model('models_pagos');
    $this->load->model('models_pagoseliminados');
    $this->load->model('models_archivos');
    
  }



  public function login() {


    $email = $this->input->post('email');
    $password= $this->input->post('password');
    $nota=$this->models_empleado->login($email,$password);
    echo json_encode($nota->result());

  }


  public function mostraAnexos() {


    $idregistro = $this->input->get('idregistro');
    $buscar = $this->input->get('buscar');
    $tipo = $this->input->get('tipo');
    $offset= $this->input->get('offset');
    $registros=$this->models_archivos->mostrarapp($buscar, $idregistro, $tipo, $offset, $this->limite);
    echo json_encode($registros->result());

  }


  public function solicitudesPedientes() {


    $idempleado = $this->input->get('idempleado');
    $buscar = $this->input->get('buscar');
    $offset= $this->input->get('offset');
    $registros=$this->models_estado_empleado->listarApp($buscar, "0", $idempleado, $offset, $this->limite);
    echo json_encode($registros->result());

  }
  public function solicitudesInicio() {


    $idempleado = $this->input->get('idempleado');
    $buscar = $this->input->get('buscar');
    $offset= $this->input->get('offset');
    $registros=$this->models_estado_empleado->listarApp($buscar, "0", $idempleado, $offset, $this->limiteinicio);
    echo json_encode($registros->result());

  }
  public function solicitudesAprobados() {


    $idempleado = $this->input->get('idempleado');
    $buscar = $this->input->get('buscar');
    $offset= $this->input->get('offset');
    $registros=$this->models_estado_empleado->listarApp($buscar, "1", $idempleado, $offset, $this->limite);
    echo json_encode($registros->result());

  }

  public function buscar() {


    $idregistro = $this->input->get('idregistro');
    $registros=$this->models_registro->buscar($idregistro);
    echo json_encode($registros->result());

  }

  public function buscarconsultarfechas() {


    $idregistro = $this->input->get('idregistro');
    $registros=$this->models_estado_registro->consultarfechas($idregistro);
    echo json_encode($registros->result());

  }


  public function listaempleados() {

    $registros = $this->models_empleado->get();
    echo json_encode($registros->result());
  }
  public function estadosIndividuales() {

   $idregistro = $this->input->get('idregistro'); 
   $registros = $this->models_estado_empleado->mostrarRegistro($idregistro);  
   echo json_encode($registros->result());
 }



 public function actualizestado() {

  $idestado_empleado = $this->input->get('idestado_empleado');
  $data = array(
    'registro' => $this->models_estado_empleado->Horafecha(),
    'estado' => 1);

  $respuesta=$this->models_estado_empleado->update($idestado_empleado, $data);

  echo '{"mensaje":"'. $respuesta.'"}';
}




public function comprobarIncial() {

  $idregistro = $this->input->get('idregistro');
  $idestado_registro = $this->input->get('idestado_registro');


  $canti = $this->models_estado_empleado->comprobar($idestado_registro, $idregistro,1);
  if ($canti == 0) {
    echo '{"mensaje":"1"}';
  }else{
    echo '{"mensaje":"0"}';
  }
}

public function comprobarcierre() {

  $idregistro = $this->input->get('idregistro');
  $idestado_registro = $this->input->get('idestado_registro');


  $canti = $this->models_estado_empleado->comprobar($idestado_registro, $idregistro,0);
  if ($canti == 0) {
    echo '{"mensaje":"1"}';
  }else{
   echo '{"mensaje":"0"}';
 }
}

public function cerrarAsiganar() {

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
             echo '{"mensaje":"1"}';
           } else {

            echo '{"mensaje":"0"}';
          }


          





        }

        public function getPagosUsuario() {

          $idempleado = $this->input->get('idempleado'); 
          $idregistro = $this->input->get('idregistro'); 
          $registros = $this->models_pagos->getPagosUsuario($idempleado,$idregistro);  
          echo json_encode($registros->result());
        }


        public function registroPago() {

         $data = array(
          'usuario' => $this->input->post('usuario'),
          'anticipo' => $this->input->post('anticipo'),
          'descripcion' =>  $this->input->post('descripcion'),
          'idempleado' =>  $this->input->post('idempleado'),
          'idregistro' => $this->input->post('idregistro'));

         $valor = $this->models_pagos->insertar($data);


         echo '{"mensaje":"'.$valor.'"}';
         

       }



       public function eliminarPago() {

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

        echo '{"mensaje":"'.$valor.'"}';

      }


      public function actualizarPass() {

        $idempleado=$this->input->post('idempleado');
        $data = array(
          'pass' => $this->input->post('passworduno'));

        $valor = $this->models_empleado->updatepass($idempleado,$data);


        echo '{"mensaje":"'.$valor.'"}';


      }







    }
