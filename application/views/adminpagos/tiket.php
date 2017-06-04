
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

               
               
                $('#subtitulo').html(totalRs+" // TOTAL ANTICIPO : $ "+addCommas(totalsS)+".00");

                    $.ajax({
                                type: "GET",
                                url: '<?php echo site_url('') ?>adminpagos/buscarpago',
                                data: dataString,
                                success: function(data) {

                                $("#tblEntAttributes tbody").append(data);

                                }
                                });


                                    }
                                });
                            });
                        });

                                function addCommas(nStr) {
                                        nStr += '';
                                        x = nStr.split('.');
                                        x1 = x[0];
                                        x2 = x.length > 1 ? '.' + x[1] : '';
                                        var rgx = /(\d+)(\d{3})/;
                                        while (rgx.test(x1)) {
                                                x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                        }
                                        return x1 + x2;
                                 }

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

           <td><i class="fa fa-remove idpagoEliminar" name="<?php echo $rowx->anticipo;?>" title="<?php echo $rowx->idpagos ?>"></i></td>


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