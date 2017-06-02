<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function to_excel($sql, $filename='exceloutput')
{
    
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below

     $obj =& get_instance();

     $query = $sql["query"];

     $fields = $sql["fields"];

     if ($query->num_rows() == 0) {
       redirect('solicitudes', 'refresh');
     } else { 

       $i=0;
       foreach ($fields as $field) {

        if($i==0){
          $headers .= 'ID' . "\t";
        }
        if( $i==1){
          $headers .= 'Num. Expediente' . "\t";
        }
        if($i==2){
          $headers .= 'Nombre de referencia' . "\t";
        }
        if($i==3){
          $headers .= 'Tipo Avaluo' . "\t";
        }
        if($i==4){
          $headers .= 'Ubicación' . "\t";
        }
        if($i==5){
          $headers .= 'Costo' . "\t";
        }
        if($i==6){
          $headers .= 'Inspector' . "\t";
        }
        if($i==7){
          $headers .= 'Teléfono' . "\t";
        }
        if($i==8){
          $headers .= 'Email' . "\t";
        }
        if($i==9){
          $headers .= 'Objeto de avalúo' . "\t";
        }
        if($i==10){
          $headers .= 'Otros' . "\t";
        }
        if($i==11){
          $headers .= 'Fecha de inspeccion ' . "\t";
        }
        if($i==12){
          $headers .= 'Hora de inspeccion' . "\t";
        }
        if($i==13){
          $headers .= 'Monto crédito' . "\t";
        }
        if($i==14){
          $headers .= 'Monto venta' . "\t";
        }
        if($i==15){
          $headers .= 'Intermediario' . "\t";
        }
        if($i==16){
          $headers .= 'Capturista' . "\t";
        }
        if($i==17){
          $headers .= 'Asigno' . "\t";
        }
        if($i==18){
          $headers .= 'Entrega de visita:' . "\t";
        }
        if($i==19){
          $headers .= 'Quien recibe:' . "\t";
        }
        if($i==20){
          $headers .= 'Observaciones' . "\t";
        }
        if($i==21){
          $headers .= 'Fecha de Asiganción' . "\t";
        }
        if($i==22){
          $headers .= 'Fecha de Captura' . "\t";
        }
        if($i==23){
          $headers .= 'Fecha de Cierre' . "\t";
        }
        if($i==24){
          $headers .= 'Pago Adelantado' . "\t";
        }
        if($i==25){
          $headers .= 'Num. Avalúo' . "\t";
        }
        $i++;

      }

      foreach ($query->result() as $row) {
       $line = '';
       foreach($row as $value) {                                            
        if ((!isset($value)) OR ($value == "")) {
         $value = "\t";
       } else {
         $value = str_replace('"', '""', $value);
         $value = '"' . $value . '"' . "\t";
       }
       $line .= $value;
     }
     $data .= trim($line)."\n";
   }

   $data = str_replace("\r","",$data);

   header("Content-type: application/x-msdownload");
   header("Content-Disposition: attachment; filename=$filename.xls");
   echo mb_convert_encoding("$headers\n$data",'utf-16','utf-8');
 }
}
?>