<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recibo extends CI_Controller {

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

        $this->load->model('models_recibo');
        $this->load->model('models_cantidad_conceptos');
        $this->load->model('models_empleado');
        $this->load->model('models_quincena');
    }

    public function trabajar() {

        $data['msn'] = -1;
        $idquincena = $this->input->get('idquincena');
        $empleados = $this->models_empleado->get();


        $html = '';
        if (isset($empleados)) {
            foreach ($empleados->result() as $rowx) {

                $buscar = $this->models_recibo->Buscarquin($idquincena, $rowx->idempleado);
                if ($buscar == 0) {

                    $html.="<tr><td><input class='form-control input-circle' type='checkbox' name='nombre[]'   value='" . $rowx->idempleado . "' /> </td>
                                            <td>" . $rowx->Nombre . " " . $rowx->apellidos . "</td>
                                                </tr>";
                } else {

                    $html.="<tr><td><input class='form-control input-circle' type='checkbox' name='nombre[]'  value='" . $rowx->idempleado . "' checked/> </td>
                                              <td>" . $rowx->Nombre . " " . $rowx->apellidos . "</td>
                                                </tr>";
                }
            }
        }



        $data['empleados'] = $html;

        $query = $this->models_quincena->Buscar($idquincena);
        $row = $query->row();
        $data['idquin'] = $idquincena;
        $data['infoquincena'] = $row->inicio . ' a ' . $row->final . ' PAGADO ' . $row->pagada;

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
        $datax['adminq'] = "active";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('recibo/registro', $data);
    }

    public function registro() {

        $idquin = $_POST['idquincena'];

        $recibo = $this->models_recibo->get($idquin, "ACTIVO");

        if (isset($recibo)) {
            foreach ($recibo->result() as $rowx) {


                $data = array(
                    'estado' => 'ELIMINAR');

                $this->models_recibo->update($rowx->idrecibo, $data);
            }
        }


        if (!empty($_POST['nombre'])) {

            for ($i = 0; $i <= count($_POST['nombre']); $i++) {
                if (!empty($_POST['nombre'][$i])) {

                    $buscar = $this->models_recibo->Buscarquin($idquin, $_POST['nombre'][$i]);

                    //echo $_POST['nombre'][$i];
                    if ($buscar == 0) {

                        $data = array(
                            'idquincena' => $idquin,
                            'estado' => 'ACTIVO',
                            'idempleado' => $_POST['nombre'][$i]);
                        $this->models_recibo->insertar($data);
                    } else {
                        $data = array(
                            'estado' => 'ACTIVO');

                        $this->models_recibo->update($buscar, $data);
                    }
                }
            }
        }


        $recibox = $this->models_recibo->get($idquin, "ELIMINAR");

        if (isset($recibox)) {
            foreach ($recibox->result() as $rowx) {

                $this->models_recibo->eliminar($rowx->idrecibo);
            }
        }

        redirect('recibo/trabajar?idquincena=' . $idquin, 'refresh');
    }

    public function mostrar() {


        $offset = $this->input->get('per_page');
        $uri_segment = 0;
        if ($offset == "") {
            $offset = 0;
        }
        $idquincena = $this->input->get('idquincena');
        $nombre = trim($this->input->get('nombre'));
        $data['idquincena'] = $idquincena;

        $data['registros'] = $this->models_recibo->mostrar($nombre, $idquincena, $offset, $this->limite);

        $config['base_url'] = base_url() . 'recibo/mostrar?nombre=' . $nombre . '&idquincena=' . $idquincena;
        $config['total_rows'] = $this->models_recibo->mostrarcount($nombre, $idquincena);
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
        $datax['adminq'] = "active";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('recibo/listar', $data);
    }

    public function actualizar() {
        $idregistro = $this->input->post('idrecibo');

        $data = array(
            'nomina' => $this->input->post('nomina'),
            'transferencia' => $this->input->post('transferencia'),
            'resta' => $this->input->post('resta'),
            'retardos' => $this->input->post('retardos'),
            'abono' => $this->input->post('abono'),
            'anticipo' => $this->input->post('anticipo'),
            'deducciones' => $this->input->post('deducciones'),
            'a_cuenta' => $this->input->post('a_cuenta'),
            'extra' => $this->input->post('extra'),
            'Observaciones' => $this->input->post('observaciones'),
            'total' => $this->input->post('total'),
            'pasajes' => $this->input->post('pasajes'));

        $this->models_recibo->update($idregistro, $data);

        redirect('recibo/editar?idrecibo=' . $idregistro, 'refresh');
    }

    public function actulizarsubto() {

        $idrecibo = $this->input->get('idrecibo');
        $idempleado = $this->input->get('idEmpleadosub');
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

    public function editar() {


        $idregistro = $this->input->get('idrecibo');
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
        $datax['adminq'] = "active";
        $datax['adminc'] = "x";
        $datax['admincc'] = "x";
        $datax['admina'] = "x";

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $squery = $this->models_recibo->Buscar($idregistro);
        $rowx = $squery->row();
        $conceptos = $this->models_recibo->conceptos($rowx->idempleado, 1);
        $data['idquincena'] = $rowx->idquincena;
        $data['idEmpleadosub'] = $rowx->idempleado;
        $suma = 0;
        $html = '';
        if (isset($conceptos)) {
            foreach ($conceptos->result() as $rowxc) {

                $res = $this->models_cantidad_conceptos->Buscarcapturadocantidad($rowxc->idcosto_concepto, $idregistro);
                if ($res == 0) {
                    $html.= ' <tr>
                                        <td>' . $rowxc->nombre . '</td>
                                        <td>' . $rowxc->costo . '</td>
                                        <td><input value="0" type="text" id="can_' . $rowxc->idcosto_concepto . '" class="form-control input-circle"></td>
                                        <td><label id="subtotal_' . $rowxc->idcosto_concepto . '">0</label></td>
                                        <td><a href="#add"  name="' . $rowxc->costo . '" title="' . $rowxc->idcosto_concepto . '" class="btn btn-circle blue actualizarbtn">ACTUALIZAR</a>

                                        </td>


                                    </tr>';
                } else {

                    $sub = $rowxc->costo * $res;
                    $suma+=$sub;
                    $html.= ' <tr>
                                        <td>' . $rowxc->nombre . '</td>
                                        <td> $ ' . $rowxc->costo . '</td>
                                        <td><input type="text" value="' . $res . '" id="can_' . $rowxc->idcosto_concepto . '" class="form-control input-circle"></td>
                                             <td><label id="subtotal_' . $rowxc->idcosto_concepto . '"> $ ' . $sub . '</label></td>
                                        <td><a href="#add"  name="' . $rowxc->costo . '" title="' . $rowxc->idcosto_concepto . '" class="btn btn-circle blue actualizarbtn">ACTUALIZAR</a>

                                        </td>


                                    </tr>';
                }
            }
        }

        $otros = $this->models_recibo->conceptosotros($rowx->idquincena, $rowx->idempleado);
        if (isset($otros)) {
            foreach ($otros->result() as $rowot) {
                $subx = $rowot->costo * $rowot->cantidad;
                $suma+=$subx;
                $html.= ' <tr>
                                        <td>' . $rowot->tipo . '</td>
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

        $data['idrecibo'] = $idregistro;
        $data['query'] = $squery;




        $this->load->view('recibo/editar', $data);
    }

    public function actualizarestado() {

        $idregistro = $this->input->get('idrecibo');
        $idquincena = $this->input->get('idquincena');
        $estado = $this->input->get('estado');
        $data = array(
            'estado' => $estado);

        $this->models_recibo->update($idregistro, $data);

        redirect('recibo/mostrar?idquincena=' . $idquincena, 'refresh');
    }

}
