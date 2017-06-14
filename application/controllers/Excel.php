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


  




public function lista_excel() {
    

   
    
   // Create new PHPExcel object
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                             ->setLastModifiedBy("Maarten Balliauw")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Test result file");
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('./excel_generados/01simple.xlsx');
redirect(base_url('/excel_generados/01simple.xlsx'));
}

public function PHPExcel() {
    /** Incluir la libreria PHPExcel */
        //require_once 'Classes/PHPExcel.php';
// Crea un nuevo objeto PHPExcel
    //PHPExcel_IOFactory::createReader('Excel2007');
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
    header('Content-Disposition: attachment;filename="ReporteEntradasTicket.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    /*$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('./excel_generados/ReporteEntradasTicket.xlsx');
    redirect(base_url('/excel_generados/ReporteEntradasTicket.xlsx'));*/
    exit;
}


}