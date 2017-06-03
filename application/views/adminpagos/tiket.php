
<script type="text/javascript">


  $(document).ready(function() {
    $('.idpagoEliminar').click(function() {
        var idpago = $(this).attr( "title");
        var costo = $(this).attr( "name");
        var totalr= $('#totalR').val();
        var totals= $('#totalA').val();

        var totalRs=parseInt(totalr)+1;
        var totalsS=parseFloat(totals)+parseFloat(costo);

        var dataString = 'idpago=' + idpago;
        $.ajax({
            type: "GET",
            url: '<?php echo site_url('') ?>adminpagos/eliminarTicket',
            data: dataString,
            success: function(data) {

                $('#tableTicket').html(data);

                $('#totalR').val(totalRs);
                $('#totalA').val(totalsS);

                $("#tblEntAttributes tbody").append('<tr><td>x</td><td>x</td><td>x</td><td>x</td><td>x</td><td>x</td><tr>');
               
                $('#subtitulo').html(totalRs+" // TOTAL ANTICIPO : $ "+totalsS);

            }
        });
    });
});

</script>
<table class="table table-hover">
    <thead>
        <tr>

            <th>NUM. EXPEDIENTE</th>
            <th>ANTICIPO</th>
            <th></th>


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

           <td><i class="fa fa-remove idpagoEliminar" name="<?php echo number_format($rowx->anticipo, 2, '.', ',');?>" title="<?php echo $rowx->idpagos ?>"></i></td>


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
<a href="#" class="form-control btn blue" ><i class="fa fa-check"></i> IMPRIMIR</a>