<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario extends CI_Controller {

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
        $idpuesto = $this->session->userdata('idcat_puesto');
        /*if ($idpuesto == 9) {

            redirect('adminpagos/mostraranticipos', 'refresh');
        }

        if ($idpuesto != 1&&$idpuesto != 6) {

         redirect('registro', 'refresh');
     }*/
     $this->load->model('models_registro');


 }


 public function limpiar() {
     $registros=$this->models_registro->get();
     if (isset($registros)) {
        foreach ($registros->result() as $rowx) {
            try {


             $date = new DateTime($rowx->hora_de_inspeccion);
             $horaNueva=date_format($date, 'H:i:s');


             $datax = array(
                'hora_de_inspeccion' => $horaNueva);
             $idResgistrox=$rowx->idregistro;

             $this->models_registro->update($idResgistrox,$datax);

         } catch (Exception $e) {
            if($rowx->hora_de_inspeccion=='-'){

               $datax = array(
                'hora_de_inspeccion' => '00:00:00');
               $idResgistrox=$rowx->idregistro;

               $this->models_registro->update($idResgistrox,$datax);

           }else{
            echo $rowx->idregistro.'<br>';
        }
    }
}
}

}
public function index() {


//log_message('error', 'Comosas');

    $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
    $datax['nombre'] = $nombrez;
    $datax['puesto'] = $this->session->userdata('puesto');
    $datax['menusolicitudes'] = "active";
    $datax['menucatalogos'] = "x";
    $datax['menuadmin'] = "x";
    $datax['solictudesbus'] = "x";
    $datax['agenda'] = "active";
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
    $data['menu'] = $this->load->view('plantilla/menu', $datax, true);





    $hoy = date("01/m/Y");  
    $registros=$this->models_registro->calendario($hoy,'2','month');

    $cadenax="";
    if (isset($registros)) {

        foreach ($registros->result() as $rowx) {

            list($ano, $mes, $dia) = explode('-', $rowx->fecha_de_inspeccion);
            list($hora, $min, $segundo) = explode(':', $rowx->hora_de_inspeccion);
            $array = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11","12");
            $indice = array_search($mes,$array,false);
            $cadenax.="{ title: 'hrs $rowx->num_expediente $rowx->inspector',
            start: new Date($ano, $indice, $dia,$hora,$min,$segundo,0),
            backgroundColor: '$rowx->color',
            url: '".site_url('')."solicitudes/editar?idregistro=$rowx->idregistro'
        },";

    }
}

$scriptDinamic=" function cargardatos() {

    if (!jQuery().fullCalendar) {
        return;
    }
    var date = new Date();
    var h = {};

    if (Metronic.isRTL()) {
        if ($('#calendar').parents('.portlet').width() <= 720) {
            $('#calendar').addClass('mobile');
            h = {
                right: 'title, prev, next',
                center: '',
                left: 'agendaDay, agendaWeek, month, today'
            };
        } else {
            $('#calendar').removeClass('mobile');
            h = {
                right: 'title',
                center: '',
                left: 'agendaDay, agendaWeek, month, today, prev,next'
            };
        }
    } else {
        if ($('#calendar').parents('.portlet').width() <= 720) {
            $('#calendar').addClass('mobile');
            h = {
                left: 'title, prev, next',
                center: '',
                right: 'today,month,agendaWeek,agendaDay'
            };
        } else {
            $('#calendar').removeClass('mobile');
            h = {
                left: 'title',
                center: '',
                right: 'prev,next,today,month,agendaWeek,agendaDay'
            };
        }
    }



    $('#event_box').html('');
    $('#calendar').fullCalendar('destroy'); 
    $('#calendar').fullCalendar({ 
        header: h,
        defaultView: 'agendaWeek', 
        slotMinutes: 15,
        editable: false,
        droppable: true,
        events: [".$cadenax."]
    });


    $('.fc-prev-button').click(function(){

       var b = $('#calendar').fullCalendar('getDate');
       var formatdate=b.format('L');

       var mesx = $('.fc-month-button').attr('class');
       var diax = $('.fc-agendaDay-button').attr('class');
       var semanax = $('.fc-agendaDay-button').attr('class');
       var tipo='';

       if(mesx=='fc-month-button fc-button fc-state-default fc-state-active'){
        tipo='month';
    }else if(diax=='fc-agendaDay-button fc-button fc-state-default fc-corner-right fc-state-active'){
        tipo='agendaDay';
    }else{
       tipo='agendaWeek';
   }
   var url = '".site_url('')."calendario/buscar?mes='+formatdate+'&tipo='+tipo;
   $(location).attr('href',url);

});
$('.fc-next-button').click(function(){
   var b = $('#calendar').fullCalendar('getDate');
   var formatdate=b.format('L');
   var mesx = $('.fc-month-button').attr('class');
   var diax = $('.fc-agendaDay-button').attr('class');
   var semanax = $('.fc-agendaDay-button').attr('class');
   var tipo='';
   if(mesx=='fc-month-button fc-button fc-state-default fc-state-active'){
    tipo='month';
}else if(diax=='fc-agendaDay-button fc-button fc-state-default fc-corner-right fc-state-active'){
    tipo='agendaDay';
}else{
   tipo='agendaWeek';
}
var url = '".site_url('')."calendario/buscar?mes='+formatdate+'&tipo='+tipo;

$(location).attr('href',url);

});

}";



$data['scriptinicial']=$scriptDinamic;
$this->load->view('calendario', $data);
}



public function buscar() {




    $nombrez = $this->session->userdata('Nombre') . ' ' . $this->session->userdata('apellidos');
    $datax['nombre'] = $nombrez;
    $datax['puesto'] = $this->session->userdata('puesto');
    $datax['menusolicitudes'] = "active";
    $datax['menucatalogos'] = "x";
    $datax['menuadmin'] = "x";
    $datax['solictudesbus'] = "x";
    $datax['agenda'] = "active";
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
    $data['menu'] = $this->load->view('plantilla/menu', $datax, true);

    $fecha = $this->input->get('mes');
    $tipo = $this->input->get('tipo');
    list($dia, $mes, $ano) = explode('/', $fecha);
    $mesanicial=$ano."-".$mes.'-'.$dia;

        //$hoy = date($concepto);  
     // echo $mesanicial;

    $registros=$this->models_registro->calendario($fecha,'2',$tipo);

    $cadenax="";
    if (isset($registros)) {

        foreach ($registros->result() as $rowx) {

            list($ano, $mes, $dia) = explode('-', $rowx->fecha_de_inspeccion);
            list($hora, $min, $segundo) = explode(':', $rowx->hora_de_inspeccion);
            $array = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11","12");
            $indice = array_search($mes,$array,false);
            $cadenax.="{ title: '$rowx->num_expediente $rowx->inspector',
            start: new Date($ano, $indice, $dia,$hora,$min,$segundo,0),
            backgroundColor: '$rowx->color',
            url: '".site_url('')."solicitudes/editar?idregistro=$rowx->idregistro'
        },";

    }
}

$scriptDinamic=" function cargardatos() {

    if (!jQuery().fullCalendar) {
        return;
    }
    var date = new Date();
    var h = {};

    if (Metronic.isRTL()) {
        if ($('#calendar').parents('.portlet').width() <= 720) {
            $('#calendar').addClass('mobile');
            h = {
                right: 'title, prev, next',
                center: '',
                left: 'agendaDay, agendaWeek, month, today'
            };
        } else {
            $('#calendar').removeClass('mobile');
            h = {
                right: 'title',
                center: '',
                left: 'agendaDay, agendaWeek, month, today, prev,next'
            };
        }
    } else {
        if ($('#calendar').parents('.portlet').width() <= 720) {
            $('#calendar').addClass('mobile');
            h = {
                left: 'title, prev, next',
                center: '',
                right: 'today,month,agendaWeek,agendaDay'
            };
        } else {
            $('#calendar').removeClass('mobile');
            h = {
                left: 'title',
                center: '',
                right: 'prev,next,today,month,agendaWeek,agendaDay'
            };
        }
    }



    $('#event_box').html('');
    $('#calendar').fullCalendar('destroy'); 
    $('#calendar').fullCalendar({ 
        header: h,
        defaultView: '".$tipo."', 
        slotMinutes: 15,
        editable: false,
        droppable: true,
        defaultDate: moment('".$mesanicial."'),
        events: [".$cadenax."]
    });

    $('.fc-prev-button').click(function(){

       var b = $('#calendar').fullCalendar('getDate');
       var formatdate=b.format('L');
       var mesx = $('.fc-month-button').attr('class');
       var diax = $('.fc-agendaDay-button').attr('class');
       var semanax = $('.fc-agendaDay-button').attr('class');
       var tipo='';
       if(mesx=='fc-month-button fc-button fc-state-default fc-state-active'){
        tipo='month';
    }else if(diax=='fc-agendaDay-button fc-button fc-state-default fc-corner-right fc-state-active'){
        tipo='agendaDay';
    }else{
       tipo='agendaWeek';
   }
   var url = '".site_url('')."calendario/buscar?mes='+formatdate+'&tipo='+tipo;
   $(location).attr('href',url);


});

$('.fc-today-button').click(function(){

   var url = '".site_url('')."calendario';
   $(location).attr('href',url);


});


$('.fc-next-button').click(function(){
   var b = $('#calendar').fullCalendar('getDate');
   var formatdate=b.format('L');
   var mesx = $('.fc-month-button').attr('class');
   var diax = $('.fc-agendaDay-button').attr('class');
   var semanax = $('.fc-agendaDay-button').attr('class');
   var tipo='';
   if(mesx=='fc-month-button fc-button fc-state-default fc-state-active'){
    tipo='month';
}else if(diax=='fc-agendaDay-button fc-button fc-state-default fc-corner-right fc-state-active'){
    tipo='agendaDay';
}else{
   tipo='agendaWeek';
}
var url = '".site_url('')."calendario/buscar?mes='+formatdate+'&tipo='+tipo;
$(location).attr('href',url);
});

}";

$data['scriptinicial']=$scriptDinamic;

$this->load->view('calendario', $data);
}

}
