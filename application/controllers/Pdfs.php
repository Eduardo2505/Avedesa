<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdfs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('models_registro');
        $this->load->library('ciqrcode');
        $this->load->helper('url');
    }

    public function generar() {




        $idregistro = $this->input->get('idregistro');


        // Genera el QR
        $params['data'] = site_url('').'pagos/registro?id='.$idregistro;
        $params['level'] = 'H';
        $params['size'] = 3;
        $params['savename'] = FCPATH.'tes.png';
        $this->ciqrcode->generate($params);

        $query = $this->models_registro->buscar($idregistro);
        $row = $query->row();
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Grupo Ave');
        $pdf->SetTitle('Caratula de Cita');
        $pdf->SetSubject('Citas');
        //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData('tcpdf_signature.png', PDF_HEADER_LOGO_WIDTH, "AVE", "Unidad de Valución, S.A de C.V", array(0, 0, 0), array(0, 0, 0));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(10,20,10,10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(5);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setFontSubsetting(true);

        $pdf->AddPage();


        $fecha = $row->fecha_de_inspeccion;



        $fehchiii = $this->models_registro->obtenerFechaEnLetra($fecha);

//Salida: Viernes 24 de Febrero del 2012


        $html = '<style type="text/css">

    *{text-align: center;font-size:14px }
        .texto{
            width:290px;height: 100px;
            background-color: #BBBBBB;

        }
        .texto2{
            width:290px;height: 50px;
            background-color: #BBBBBB;

        }
        .texto3{
            width:290px;height: 80px;
            background-color: #BBBBBB;

        }
        .texto4{
            width:650px;
            background-color: #BBBBBB;

        }
        .texto5{
            width:400px;height:250px;
            background-color: #BBBBBB;

        }
        .texto6{
            width:240px;height:250px;
            background-color: #BBBBBB;
            font-size:12px;

        }
        .separador{
            width:60px;

        }


    </style>
    <h1 style="font-size:18px">CARATULA DE CITA FOLIO: ' . $row->num_expediente . '</h1>
    <table>
        <tr>
            <td class="texto2"><br>
                <strong>ASIGNÓ: </strong>' . $row->asigno . '
                <BR><strong>CAPTURISTA: </strong> ' . $row->capturista . '</td>
                    <td class="separador"></td>
                    <td class="texto2"><br>
                        <strong>INSPECTOR:</strong> <br>' . $row->Nombre . ' ' . $row->apellidos . '</td>
                    </tr>
                    <tr><td colspan="3"><br></td></tr>
                    <tr>
                        <td class="texto"><br>
                            <strong> FECHA:</strong><br> ' . $fehchiii . ' <br>
                            <strong>HORA:</strong><br> ' . $row->hora_de_inspeccion . ' hrs</td>
                            <td class="separador"> </td>
                            <td class="texto"><br>
                                <strong>UBICACIÓN:</strong><br> ' . $row->ubicacion . '</td></tr>
                                <tr><td colspan="3"><br></td></tr>
                                <tr><td class="texto3"><br>
                                    <strong> CONTACTO DE VISITA: </strong><br>' . $row->referencia . ' <br>
                                    <strong>TELEFONO:  </strong>
                                    <br> ' . $row->telefono . '</td>
                                    <td class="separador"></td>
                                    <td class="texto3">
                                        <br>
                                        <strong>MONTO DE CREDITO: </strong><br> $ ' . number_format($row->monto_credito) . '<br>
                                        <strong>MONTO DE VENTA: </strong><br> $ ' . number_format($row->monto_venta) . '</td>
                                    </tr>
                                    <tr><td colspan="3"><br></td></tr>
                                    <tr><td class="texto2">
                                        <br>
                                        <strong> COSTO : </strong><br> $ ' . number_format($row->costo) . '</td>
                                        <td class="separador"> </td>
                                        <td class="texto2"><br>
                                            <strong>OBJETO DEL AVALUO: </strong><br> ' . $row->nomobjetivo . '</td>
                                        </tr>
                                        <tr><td colspan="3"><br></td></tr>
                                        <tr><td class="texto2">
                                            <br>
                                            <strong> INTERMEDIARIO : </strong><br>' . $row->nomIntermediria . ' </td>
                                            <td class="separador" > </td>
                                            <td><img class="sobre" src="'.base_url().'tes.png" /></td>
                                        </tr>
                                        <tr><td colspan="3"></td></tr>

                                       
                                        <tr>
                                           <td colspan="3" class="texto4"><strong> OBSERVACIONES</strong><br>' . $row->observaciones . '<br> </td></tr>
                                           <tr><td colspan="3"><br></td></tr>
                                           <tr>
                                              <td class="texto5"><br>
                                                <strong> OBSERVACIONES DEL INMUEBLE </strong><br>
                                            </td><td style="width:10px;"></td>
                                            <td class="texto6" ><br> <strong>CHECK LIST DE DOCUMENTACION</strong><br>SOLICITANTE Y PROPIETARIO<BR><br>

                                                <input type="checkbox" name="vehicle" class="checkboxtext" value="Bike"> INE <input class="checkboxtext"  type="checkbox" name="vehicle" value="Bike"><BR>
                                                <input type="checkbox" name="vehicle" class="checkboxtext" value="Bike"> CURP <input class="checkboxtext"  type="checkbox" name="vehicle" value="Bike"><BR>
                                                <input type="checkbox" name="vehicle" class="checkboxtext"  value="Bike"> RFC <input class="checkboxtext"  type="checkbox" name="vehicle" value="Bike"><BR>
                                                <input type="checkbox" name="vehicle" class="checkboxtext" value="Bike"> NSS <input class="checkboxtext"  type="checkbox" name="vehicle" value="Bike"><BR>
                                                <div style="text-align: left">
                                                    <input type="checkbox" name="vehicle" class="checkboxtext" value="Bike"> BOLETA PREDIAL O CASTRO<BR>
                                                    <input type="checkbox" name="vehicle" class="checkboxtext" value="Bike">  BOLETA DE AGUA<BR>
                                                    <input type="checkbox" name="vehicle" class="checkboxtext" value="Bike"> LICENCIA DE CONSTRUCCIÓN<BR>
                                                    <input type="checkbox" name="vehicle" class="checkboxtext" value="Bike"> PLANO<BR>
                                                    <input type="checkbox" name="vehicle" class="checkboxtext" value="Bike"> ESCRITURA

                                                </div>


                                            </td>
                                        </tr>

                                    </table>';





// set font
                                    $pdf->SetFont('helvetica', '', 8);

// set cell padding


                                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


                                    $nombre_archivo = utf8_decode('Caratula_de_Cita_' . str_pad($row->idregistro, 5, "0", STR_PAD_LEFT) . '.pdf');
                                    $pdf->Output($nombre_archivo, 'I');
                                }

                                public function recibo() {

                                    $this->load->model('models_cantidad_conceptos');
                                    $this->load->model('models_recibo');

                                    $idrecibo = $this->input->get('idrecibo');
//        $query = $this->models_registro->buscar($idregistro);
//        $row = $query->row();
                                    $this->load->library('Pdf');

                                    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
                                    $pdf->SetCreator(PDF_CREATOR);
                                    $pdf->SetAuthor('Grupo Ave');
                                    $pdf->SetTitle('Recibo');
                                    $pdf->SetSubject('Recibo');
        //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
                                    $pdf->SetHeaderData('tcpdf_signature.png', PDF_HEADER_LOGO_WIDTH, "AVE", "Unidad de Valución, S.A de C.V", array(0, 0, 0), array(0, 0, 0));
                                    $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
                                    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                                    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
                                    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
                                    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                                    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                                    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                                    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                                    $pdf->setFontSubsetting(true);

                                    $pdf->AddPage();

                                    $squery = $this->models_recibo->Buscar($idrecibo);
                                    $rowx = $squery->row();
                                    $conceptos = $this->models_recibo->conceptos($rowx->idempleado,1);

                                    $suma = 0;


                                    $html = '
                                    <div style="text-align:center"><H2>' . $rowx->nomempleado . ' <br>' . $rowx->inicio . '  a ' . $rowx->final . '</H2>
                                    </div>
                                    <h3>PAGADA : ' . $rowx->pagada . '</h3>

                                    <table> <thead>
                                        <tr style="background-color:#A6A5A5;font-weight: bold">
                                            <th>CONCEPTO</th>
                                            <th>COSTO</th>
                                            <th>CANTIDAD</th>
                                            <th>SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        if (isset($conceptos)) {
                                            foreach ($conceptos->result() as $rowxc) {

                                                $res = $this->models_cantidad_conceptos->Buscarcapturadocantidad($rowxc->idcosto_concepto, $idrecibo);


                                                $sub = $rowxc->costo * $res;
                                                $suma+=$sub;
                                                $html.= ' <tr>
                                                <td>' . $rowxc->nombre . '</td>
                                                <td> $ ' . $rowxc->costo . '</td>
                                                <td><label>' . $res . '</label></td>
                                                <td><label id="subtotal_' . $rowxc->idcosto_concepto . '"> $ ' . $sub . '</label></td>




                                            </tr>';
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


                                $html.= '<tr>
                                <th>-</th>
                                <th>-</th>
                                <th><br><h3>NÓMINA</h3></th>
                                <th><br><h3>  $' . $suma . ' </h3> </th>
                            </tr>';


//setlocale(LC_MONETARY, 'en_US');
//.money_format('%i', $row->monto_credito)

                            $html.= '</table>';
                           
                            $total = $this->models_recibo->calcularPago($idrecibo);
                            $html.= ' <BR><BR><h3>RESUMEN</h3> <BR> 
                            <table>

                             <tr><td>- TRANSFERENCIA :</td><td> $ ' . $rowx->transferencia . '</td></tr> 
                             <tr><td>- DEDUCCIONES :</td><td> $ ' . $rowx->deducciones . '</td></tr>
                             <tr><td>- RETARDOS :</td><td> $ ' . $rowx->retardos . '</td></tr> 
                             <tr><td>- ABONO :</td><td> $ ' . $rowx->abono . '</td></tr>
                             <tr><td>- ANTICIPO :</td><td> $ ' . $rowx->anticipo . '</td></tr>                   
                             <tr><td>+ EXTRA :</td><td> $ ' . $rowx->extra . '</td></tr>
                             <tr><td>+ PASAJES:</td><td> $ ' . $rowx->pasajes . '</td></tr>
                             <tr><td><h3><br>PAGAR: </h3> </td><td><h3><br> $ ' . $total . ' </h3> </td></tr>
                             <tr><td><br><br>OBSERVACIONES:</td><td><br><br> ' . $rowx->Observaciones . '</td></tr>
                             <table>';


                                $html.= '
                                <br><br><br><br><br><br><br><br><div style="text-align:center"> ________________________________________
                                <br>FIRMA <BR><BR>' . $rowx->nomempleado . '<div>';






// set font
                                $pdf->SetFont('helvetica', '', 8);

// set cell padding


                                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


                                $nombre_archivo = utf8_decode('Recibo_Eduardo.pdf');
                                $pdf->Output($nombre_archivo, 'I');
                            }

                        }