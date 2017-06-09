
<table class="table table-hover">
    <thead>
        <tr>

            <th>NUM. EXPEDIENTE</th>
            <th>ANTICIPO</th>
            <th>*</th>


        </tr>
    </thead>
    <tbody>



       <?php
       $total=0;

       if (isset($registros)) {
        foreach ($registros->result() as $rowx) {

           $total+=$rowx->anticipo;
           ?>


           <tr>


             <td><?php echo $rowx->num_expediente; ?></td>
             <td>$ <?php echo number_format($rowx->anticipo, 2, '.', ',');?></td>

             <td><i class="fa fa-remove" onclick="clickEliminar($(this));" name="<?php echo $rowx->anticipo;?>" title="<?php echo $rowx->idpagos ?>"></i></td>


         </tr>



         <?php
     }
 }
 ?>  



</tbody>

<tr>

    <th>TOTAL: </th>
    <th> $ <?php echo number_format($total, 2, '.', ',');?></th>


</tr>

</table>
<a href="<?php echo site_url('') ?>adminpagos/imprimirTiket" class="form-control btn blue" ><i class="fa fa-check"></i> IMPRIMIR</a>