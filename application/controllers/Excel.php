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
        $this->load->library('excel');
    }

    public function generar() {
        $StrinSQl = $this->session->tempdata('StrinSQl');
        $plaintext_string = $this->encrypt->decode($StrinSQl);
        $this->load->model('models_registro');

        //echo $plaintext_string;
        to_excel($this->models_registro->getExcel($plaintext_string), "Registro");
    }


    public function ejemplo() {

        $this->excel->setActiveSheetIndex(0);
  //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Informe');
  //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1','Celda1');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(10);

  $filename="nombre.xls"; //save our workbook as this file name
  header('Content-Type: application/vnd.ms-excel'); //mime type
  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
  header('Cache-Control: max-age=0'); //no cache
  
}



public function PHPExcel() {
    /** Incluir la libreria PHPExcel */
        //require_once 'Classes/PHPExcel.php';
// Crea un nuevo objeto PHPExcel
    PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = new PHPExcel();

// Establecer propiedades
    $objPHPExcel->getProperties()
    ->setCreator("Essy")
    ->setLastModifiedBy("Essy")
    ->setTitle("Reporte")
    ->setSubject("Reporte")
    ->setDescription("Reporte en excel")
    ->setKeywords("Excel Office 2007 openxml php")
    ->setCategory("Reporte de Excel");






      //  $datos = $this->tiket_models->getEntradasExcel($usuario, $descrip, $folio, $fechi, $fechf, 'ENTRADA');

// Agregar Informacion
    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);

    $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);

    $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)->setSize(15);
    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'REPORTE TICKET ENTRADAS');



    $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'FOLIO ');
    $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'DESCRIPCION ');
    $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'ESTADO ');
    $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'TIPO ');
    $objPHPExcel->getActiveSheet()->SetCellValue('E3', 'USUARIO ');
    $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'REGISTRO ');

    $galletas = 4;

//        if (isset($datos)) {
//            foreach ($datos->result() as $rowx) {
//
//                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $galletas, str_pad($rowx->folio, 5, "0", STR_PAD_LEFT));
//                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $galletas, $rowx->descripcion);
//                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $galletas, $rowx->estado);
//                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $galletas, $rowx->tipo);
//                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $galletas, $rowx->Nombre . " " . $rowx->apellidos);
//                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $galletas, $rowx->registro);
//                $galletas++;
//            }
//        }



// Renombrar Hoja
    $objPHPExcel->getActiveSheet()->setTitle('Reporte');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
    $objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ReporteEntradasTicket.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
}

}