<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class RporteExcel extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('excel');
        $this->load->model('models_registro_consulta');
        $this->load->library('session');
        
    }

    public function generar() {

      


        //$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);




        $this->excel->getActiveSheet()->setCellValue('A1', 'Reporte Registros ');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A1:AA1');
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));

        $this->excel->getActiveSheet()->getStyle('A4:AA4')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
        //CABECERAS
        $this->excel->getActiveSheet()->getStyle('A4:AA4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A4:AA4')->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFE8E5E5');

        // Renombrar Hoja
        $this->excel->getActiveSheet()->setTitle('Reporte');
        $this->excel->setActiveSheetIndex(0);



        $this->excel->getActiveSheet()->SetCellValue('A4', 'ID REGISTRO');
        $this->excel->getActiveSheet()->SetCellValue('B4', 'REFERENCIA');
        $this->excel->getActiveSheet()->SetCellValue('C4', 'TELEFONO');
        $this->excel->getActiveSheet()->SetCellValue('D4', 'EMAIL');
        $this->excel->getActiveSheet()->SetCellValue('E4', 'TIPO AVALUO');
        $this->excel->getActiveSheet()->SetCellValue('F4', 'OBJETIVO');
        $this->excel->getActiveSheet()->SetCellValue('G4', 'OTROS');
        $this->excel->getActiveSheet()->SetCellValue('H4', 'UBICACIÓN');
        $this->excel->getActiveSheet()->SetCellValue('I4', 'COSTO');
        $this->excel->getActiveSheet()->SetCellValue('J4', 'FECHA INSPECCIÓN');
        $this->excel->getActiveSheet()->SetCellValue('K4', 'HORA INSPECCIÓN');
        $this->excel->getActiveSheet()->SetCellValue('L4', 'NOMBRE');
        $this->excel->getActiveSheet()->SetCellValue('M4', 'APELLIDOS');
        $this->excel->getActiveSheet()->SetCellValue('N4', 'MONTO CREDITO');
        $this->excel->getActiveSheet()->SetCellValue('O4', 'MONTO VENTA');
        $this->excel->getActiveSheet()->SetCellValue('P4', 'OBSERVACIONES');
        $this->excel->getActiveSheet()->SetCellValue('Q4', 'FECHA ASIGNACION');
        $this->excel->getActiveSheet()->SetCellValue('R4', 'FECHA CAPTURA');
        $this->excel->getActiveSheet()->SetCellValue('S4', 'FECHA CIERRE');
        $this->excel->getActiveSheet()->SetCellValue('T4', 'REGISTRO');
        $this->excel->getActiveSheet()->SetCellValue('U4', 'FECHA FIN');
        $this->excel->getActiveSheet()->SetCellValue('V4', 'INTEREDIARIO');
        $this->excel->getActiveSheet()->SetCellValue('W4', 'PAGO ADELANTADO');
        $this->excel->getActiveSheet()->SetCellValue('X4', 'EXPEDINTE');
        $this->excel->getActiveSheet()->SetCellValue('Y4', 'INSPECTOR');
        $this->excel->getActiveSheet()->SetCellValue('Z4', 'NUM. AVALUO');
        $this->excel->getActiveSheet()->SetCellValue('AA4', 'FECHA ENTREGA');


        $filtro=$this->session->userdata('filtro');
        if( $filtro!=""){
            $registros=$this->models_registro_consulta->reporteExcel($filtro);
            $fila = 5;
            if (isset($registros)) {
               foreach ($registros->result() as $rowx) {

                   $this->excel->getActiveSheet()->SetCellValue('A' . $fila, $rowx->idregistro);
                   $this->excel->getActiveSheet()->SetCellValue('B' . $fila, $rowx->referencia);
                   $this->excel->getActiveSheet()->SetCellValue('C' . $fila, $rowx->telefono);
                   $this->excel->getActiveSheet()->SetCellValue('D' . $fila, $rowx->email);
                   $this->excel->getActiveSheet()->SetCellValue('E' . $fila, $rowx->nomtipoava);
                   $this->excel->getActiveSheet()->SetCellValue('F' . $fila, $rowx->nomobjetivo);
                   $this->excel->getActiveSheet()->SetCellValue('G' . $fila, $rowx->otros);
                   $this->excel->getActiveSheet()->SetCellValue('H' . $fila, $rowx->ubicacion);
                   $this->excel->getActiveSheet()->SetCellValue('I' . $fila, $rowx->costo);
                   $this->excel->getActiveSheet()->SetCellValue('J' . $fila, $rowx->fecha_de_inspeccion);
                   $this->excel->getActiveSheet()->SetCellValue('K' . $fila, $rowx->hora_de_inspeccion);
                   $this->excel->getActiveSheet()->SetCellValue('L' . $fila, $rowx->Nombre);
                   $this->excel->getActiveSheet()->SetCellValue('M' . $fila, $rowx->apellidos);
                   $this->excel->getActiveSheet()->SetCellValue('N' . $fila, $rowx->monto_credito);
                   $this->excel->getActiveSheet()->SetCellValue('O' . $fila, $rowx->monto_venta);
                   $this->excel->getActiveSheet()->SetCellValue('P' . $fila, $rowx->observaciones);
                   $this->excel->getActiveSheet()->SetCellValue('Q' . $fila, $rowx->fecha_asigancion);
                   $this->excel->getActiveSheet()->SetCellValue('R' . $fila, $rowx->fecha_captura);
                   $this->excel->getActiveSheet()->SetCellValue('S' . $fila, $rowx->fecha_cierre);
                   $this->excel->getActiveSheet()->SetCellValue('T' . $fila, $rowx->registro);
                   $this->excel->getActiveSheet()->SetCellValue('U' . $fila, $rowx->fecha_final);
                   $this->excel->getActiveSheet()->SetCellValue('V' . $fila, $rowx->nomIntermediria);
                   $this->excel->getActiveSheet()->SetCellValue('W' . $fila, $rowx->adelanto_pago);
                   $this->excel->getActiveSheet()->SetCellValue('X' . $fila, $rowx->num_expediente);
                   $this->excel->getActiveSheet()->SetCellValue('Y' . $fila, $rowx->inspector);
                   $this->excel->getActiveSheet()->SetCellValue('Z' . $fila, $rowx->num_avaluo);
                   $this->excel->getActiveSheet()->SetCellValue('AA' . $fila, $rowx->fecha_de_entrega);




                   $fila++;
               }
           }
       }






       header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
       header('Content-Disposition: attachment;filename="nombredelfichero.xlsx"');
       header('Cache-Control: max-age=0'); //no cache
       $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        // Forzamos a la descarga
     //  $objWriter->save('nombredelfichero.xlsx');
        $objWriter->save('php://output');
        
    }




}