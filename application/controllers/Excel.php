<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Excel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('mysql_to_excel_helper');
        $this->load->helper('url');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('Classes/PHPExcel.php');
        
    }

    public function generar() {
        $StrinSQl = $this->session->tempdata('StrinSQl');
        $plaintext_string = $this->encrypt->decode($StrinSQl);
        $this->load->model('models_registro');

        //echo $plaintext_string;
        to_excel($this->models_registro->getExcel($plaintext_string), "Registro");
    }


    public function reporterecibo() {

        $this->load->model('models_recibo');
        $this->load->model('models_quincena');

        $idquincena = $this->input->get('idquincena');

        $datos = $this->models_recibo->reporteRecibo($idquincena);
        $query = $this->models_quincena->Buscar($idquincena);
        $info = $query->row();



// Crea un nuevo objeto PHPExcel
        PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = new PHPExcel();
// Establecer propiedades
        $objPHPExcel->getProperties()
        ->setCreator("helpmex.com.mx")
        ->setLastModifiedBy("helpmex.com.mx")
        ->setSubject("Reporte Recibo")
        ->setDescription("Reporte en excel")
        ->setKeywords("Excel Office 2007")
        ->setCategory("Reporte de Excel");
      //  
// Agregar Informacion
        $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(45);
        $objPHPExcel->getActiveSheet()->getStyle('k')->getAlignment()->setWrapText(true); 
        $objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('G')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('H')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('I')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('J')->getNumberFormat()->setFormatCode("$ #,##0.00");
        $objPHPExcel->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('J7')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('K7')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)->setSize(15);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
        $objPHPExcel->getActiveSheet()->mergeCells('A2:K2');
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
        $objPHPExcel->getActiveSheet()->mergeCells('A3:K3');
        $objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));


        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'REPORTE QUINCENAL');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Quincena: '.$info->inicio." // ".$info->final);
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Pagada: '.$info->pagada);
        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Nombre');
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', '(-) Transferencias');
        $objPHPExcel->getActiveSheet()->SetCellValue('C7', '(-) Deducciones');
        $objPHPExcel->getActiveSheet()->SetCellValue('D7', '(-) Retardos');
        $objPHPExcel->getActiveSheet()->SetCellValue('E7', '(-) Abono');
        $objPHPExcel->getActiveSheet()->SetCellValue('F7', '(-) Anticipo');
        $objPHPExcel->getActiveSheet()->SetCellValue('G7', '(+) Extra');
        $objPHPExcel->getActiveSheet()->SetCellValue('H7', '(+) Pasajes');
        $objPHPExcel->getActiveSheet()->SetCellValue('I7', 'Nómina');
        $objPHPExcel->getActiveSheet()->SetCellValue('J7', 'Total');
        $objPHPExcel->getActiveSheet()->SetCellValue('K7', 'Observaciones');
        $fila = 8;
        $ttTras=0;
        $ttDedu=0;
        $ttReta=0;
        $ttAbo=0;
        $ttAnt=0;
        $ttExtr=0;
        $ttPasa=0;
        $ttNomi=0;
        $ttTo=0;

        if (isset($datos)) {
         foreach ($datos->result() as $rowx) {

            $tra=$rowx->transferencia;
            $dedu=$rowx->deducciones;
            $reta=$rowx->retardos;
            $abo=$rowx->abono;
            $anti=$rowx->anticipo;
            $extr=$rowx->extra;
            $pas=$rowx->pasajes;
            $nomi=$rowx->nomina;
            $too=$rowx->total;

            

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $fila, $rowx->nombre.' '.$rowx->apellidos);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $fila, $tra);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $fila, $dedu);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $fila, $reta);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $fila,  $abo);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $fila, $anti);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $fila, $extr);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $fila, $pas);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $fila, $nomi);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $fila, $too);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $fila, $rowx->observaciones);

            $ttTras+=$tra;
            $ttDedu+=$dedu;
            $ttReta+=$reta;
            $ttAbo+=$abo;
            $ttAnt+=$anti;
            $ttExtr+=$extr;
            $ttPasa+=$pas;
            $ttNomi+=$nomi;;
            $ttTo+=$too;


            $fila++;
        }
    }

    $filaTotal=$fila+1;
     //TOTALES
    $objPHPExcel->getActiveSheet()->getStyle('A' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('C' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('D' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('E' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('F' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('G' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('H' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('I' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('J' . $filaTotal)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()
    ->getStyle('A' . $filaTotal)
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $filaTotal, 'TOTAL');
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $filaTotal,  $ttTras);
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $filaTotal, $ttDedu);
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $filaTotal, $ttReta);
    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $filaTotal, $ttAbo);
    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $filaTotal,  $ttAnt);
    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $filaTotal, $ttExtr);
    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $filaTotal, $ttPasa);
    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $filaTotal,  $ttNomi);
    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $filaTotal, $ttTo);
// Renombrar Hoja
    $objPHPExcel->getActiveSheet()->setTitle('Reporte');
    $objPHPExcel->setActiveSheetIndex(0);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte_Quincena.xlsx"');
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');


    exit;
}


}