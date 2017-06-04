<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asignar extends CI_Controller {

    private $limite = 10;

    function __construct() {

        parent::__construct();
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('pagination');
        $datoiniciar = $this->session->userdata('Nombre');
        // es es el nuevo contenidoxxxx
        if (strlen($datoiniciar) == 0) {


            redirect('', 'refresh');
        }
        $idpuesto = $this->session->userdata('idcat_puesto');
        /*if ($idpuesto != 1 && $idpuesto != 6) {

            redirect('registro', 'refresh');
        }*/


        $this->load->model('models_estado_registro');
        $this->load->model('models_estado_empleado');
        $this->load->model('models_empleado');
        $this->load->model('models_registro');
    }

    public function asignarx() {

        $idavale = $this->input->get('id');
        $idempleado = $this->input->get('idempleado');
        $idestado_registro = $this->input->get('idestado_registro');


        $canti = $this->models_estado_empleado->comprobarActualizacion($idestado_registro, $idavale);
        $html = "<table class='table table-hover'>";
        if ($canti == 0) {
            $data = array(
                'idestado_registro' => $idestado_registro,
                'idregistro' => $idavale,
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
               $this->models_registro->update($idavale, $datax);


           }

       } else {
        $html.= "<tr><th colspan='4'><font color=\"red\">YA SE ENCUENTRA REGISTRADO</font> </th></tr>";
    }
    $registros = $this->models_estado_empleado->mostrar();


    $html.= " <tr><th>ID</th><th>FOLIO</th><th>ESTADO</th><th>EMPLEADO</th></tr>
    <tbody>";
        if (isset($registros)) {
            foreach ($registros->result() as $row) {


                $html .= "
                <tr><td>$row->idregistro</td><td>$row->num_expediente</td><td>$row->estado</td><td>$row->nombre $row->apellidos</td></tr>";
            }
        }



        $html .= " </tbody>
    </table>";


    echo $html;
}

public function buscar() {

    $idavale = $this->input->get('idavale');

    $this->load->model('models_registro');

    $registros = $this->models_registro->filtro($idavale);
    $html = " <script type='text/javascript'>
    $(document).ready(function() {
        $('.eliminarclass').click(function() {
            var id = $(this).attr('title');


            var idempleado =$('#idempleado').val();
            var idestado_registro =$('#idestado_registro').val();
            if(idempleado!=''&&idestado_registro!=''){
                var dataString = 'id=' + id+'&idempleado='+idempleado+'&idestado_registro='+idestado_registro;

                var url = '" . site_url('') . "asignar/asignarx';

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: dataString,
                    success: function(data) {



                        $('#divtable').html(data);




                    }

                });
            }else{
                alert('Seleccione un empleado y un estado');
            }
        }


        );
    });
</script>
<table class='table table-hover'>
    <tr><th>ID</th><th>FILIO</th><th>ACCIÓN</th></tr>
    <tbody>
        ";
        if (isset($registros)) {
            foreach ($registros->result() as $row) {


                $html .= "
                <tr><td>$row->idregistro</td><td>$row->num_expediente</td><td><a href='#'  title='$row->idregistro&fecha_de_inspeccion=$row->fecha_de_inspeccion'   class='btn default btn-xs eliminarclass'><i class='fa fa-remove'></i>ASIGNAR</a></td></tr>";
            }
        }
        $html.=" </tbody>

    </table>
    ";
    echo $html;
}

public function index() {

    $data['msn'] = -1;
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
    $datax['asignarMenu'] = "active";
    $data['nombre'] = $nombrez;
    $data['idcapturista'] = $this->session->userdata('idempleado');
    $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
    $data['head'] = $this->load->view('plantilla/head', true);
    $data['estados'] = $this->models_estado_registro->get();
    $data['empleados'] = $this->models_empleado->get();

    $this->load->view('asignar/registro', $data);
}

public function mostrar() {


    $offset = $this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }

    $nombre = trim($this->input->get('buscar'));
    $data['registros'] = $this->models_estado_empleado->listar($nombre, "", "", $offset, $this->limite);

    $config['base_url'] = base_url() . 'asignar/mostrar?buscar=' . $nombre;
    $config['total_rows'] = $this->models_estado_empleado->listarcount($nombre, "", "");
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
        $datax['asignarMenu'] = "active";
        

        $data['nombre'] = $nombrez;
        $data['idcapturista'] = $this->session->userdata('idempleado');
        $data['menu'] = $this->load->view('plantilla/menu', $datax, true);
        $data['head'] = $this->load->view('plantilla/head', true);
        $this->load->view('asignar/listar', $data);
    }

    public function eliminar() {
        $idestado_empleado = $this->input->get('idestado_empleado');
        $idestado_registro = $this->input->get('idestado_registro');
        $id = $this->input->get('id');
        $this->models_estado_empleado->eliminar($idestado_empleado);
        echo "se elimino";
        //redirect('avaluos/mostrar', 'refresh');
    }

    public function asignarIndividual() {


        $idregistro = $this->input->get('idregistro');     
        $fecha_de_inspeccion = $this->input->get('fecha_de_inspeccion');    
        $data['estados'] = $this->models_estado_registro->get();
        $data['registros'] = $this->models_estado_empleado->mostrarRegistro($idregistro);
        $data['estados'] = $this->models_estado_registro->get();
        $data['empleados'] = $this->models_empleado->get();
        $data['idregistro'] = $idregistro;
        $data['fecha_de_inspeccion'] = $fecha_de_inspeccion;
        $ver=$this->load->view('asignar/registroindividual', $data,true);
        echo $ver;



    }

    public function eliminarIndividual() {


        $idregistro = $this->input->get('idregistro');  
        $idestado_empleado = $this->input->get('idestado_empleado');  

        $this->models_estado_empleado->eliminar($idestado_empleado);       
        
        $registros = $this->models_estado_empleado->mostrarRegistro($idregistro);
        $html='<table class="table table-hover">
        <thead>
            <tr>
                <th>Estado</th>
                <th>Nombre</th>
                <th>Accion</th>

            </tr>
        </thead>
        <tbody> ';
            if (isset($registros)) {
                foreach ($registros->result() as $rowx) {

                   $html.=' <tr>
                   <td>'.$rowx->estado.'</td>
                   <td>'.$rowx->nombre.' '.$rowx->apellidos.'</td>
                   <td><a href="#"  title="'.$rowx->idestado_empleado.'" class="btn default btn-xs eliminarXD"><i class="fa fa-remove"></i> Eliminar </a></td>

               </tr>';



           }
       }

       $html.="</tbody>
   </table>
   <script type='text/javascript'>

    $(document).ready(function() {
        $('.eliminarXD').click(function() {
            var idestado_empleado = $(this).attr('title');
            var idregistro = $('#idregistro').val();
            var dataString = 'idestado_empleado=' + idestado_empleado+'&idregistro='+idregistro



            var url = '".site_url('')."asignar/eliminarIndividual';

            $.ajax({
                type: 'GET',
                url: url,
                data: dataString,
                success: function(data) {


                    $('#divtable').html(data);                                               


                    return false;
                }

            });

            return false;
        });

    });
</script>";

echo $html;



}

public function agregar() {

    $idregistro = $this->input->get('idregistro');
    $idempleado = $this->input->get('idempleado');
    $idestado_registro = $this->input->get('idestado_registro');


    $canti = $this->models_estado_empleado->comprobarActualizacion($idestado_registro, $idregistro);
    $html = ' <table class="table table-hover">
    <thead>
        <tr>
            <th>Estado</th>
            <th>Nombre</th>
            <th>Accion</th>

        </tr>
    </thead>
    <tbody> ';
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

       } else {
        $html.= "<tr><th colspan='4'><font color=\"red\">YA SE ENCUENTRA REGISTRADO</font> </th></tr>";
    }


    $registros = $this->models_estado_empleado->mostrarRegistro($idregistro);

    if (isset($registros)) {
        foreach ($registros->result() as $rowx) {

           $html.=' <tr>
           <td>'.$rowx->estado.'</td>
           <td>'.$rowx->nombre.' '.$rowx->apellidos.'</td>
           <td><a href="#"  title="'.$rowx->idestado_empleado.'" class="btn default btn-xs eliminarXD"><i class="fa fa-remove"></i> Eliminar </a></td>

       </tr>';



   }
}

$html.="</tbody>
</table>
<script type='text/javascript'>

    $(document).ready(function() {
        $('.eliminarXD').click(function() {
            var idestado_empleado = $(this).attr('title');
            var idregistro = $('#idregistro').val();
            var dataString = 'idestado_empleado=' + idestado_empleado+'&idregistro='+idregistro



            var url = '".site_url('')."asignar/eliminarIndividual';

            $.ajax({
                type: 'GET',
                url: url,
                data: dataString,
                success: function(data) {


                    $('#divtable').html(data);                                               


                    return false;
                }

            });

            return false;
        });

    });
</script>";

echo $html;




}

}

