 <!DOCTYPE html>
 <html>
 <head>
  <script type="text/javascript">
    function imprSelec(muestra)
    {
        var ficha = document.getElementById(muestra);
        var ventimp = window.open(' ', 'popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
        window.location="<?php echo $urlredi ?>";
    }
</script> 
</head>
<body onload="javascript:imprSelec('muestra')">

    <div  id="muestra">
        <table>


            <tr>
                <td>ADMINISTRADOR</td>
            </tr>
            <tr>

                <td><?php echo $nombre?></td>
            </tr>



        </table>
        <br>
        <table>


            <tr>
                <th>Expediente</th>
                <th>Anticipo</th>
                <th>Usuario</th>
            </tr>


            <?php
            $total=0;
            if (isset($registros)) {

                foreach ($registros->result() as $rowx) {

                 $total+=$rowx->anticipo;

                 $datax = array(
                    'impreso' => 1);


                 $this->models_pagosadmin->updatePagosAceptados($rowx->idpagosaceptados,$datax);

                 $fechaRegistro=$rowx->registro;

                 ?>
                 <tr>
                    <th><?php echo $rowx->num_expediente ?></th>
                    <th>$ <?php echo number_format($rowx->anticipo, 2, '.', ',');?></th>
                    <th><?php echo $rowx->usuario ?></th>
                </tr>

                <?php
            }


        }

        ?>


        <tr>
            <th style="text-align: right;">TOTAL: </th>
            <th>$ <?php echo number_format($total, 2, '.', ',');?></th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th><br><br></th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th><?php echo $fechaRegistro ?></th>
            <th></th>
        </tr>

    </table>

</div>


</body>
</html>