

<script type="text/javascript">
    $(document).ready(function() {
        $('#enviarAsigancion').submit(function(){
            var data=$(this).serialize();
          //  console.log(data);


            $.get('<?php echo site_url('') ?>asignar/agregar',data,function(respuesta){

              $('#divtable').html(respuesta);    

          });
            return false;
        });
    });

</script>

<form class="form-horizontal" id="enviarAsigancion" >
    <input type="hidden" value="<?php echo $idregistro?>" name="idregistro" id="idregistro">
    <input type="hidden" value="<?php echo $fecha_de_inspeccion?>" name="fecha_de_inspeccion" id="fecha_de_inspeccion">
    <div class="form-body">
        <div class="form-group">
            <label class="col-md-3 control-label">Empleado: *</label>
            <div class="col-md-8">
                <select class="form-control input-circle" required="" name="idempleado" id="idempleado">
                    <option value="">Seleccione</option>

                    <?php
                    if (isset($empleados)) {
                        foreach ($empleados->result() as $rowe) {
                            ?>

                            <option value="<?php echo $rowe->idempleado; ?>"><?php echo $rowe->Nombre; ?> <?php echo $rowe->apellidos; ?></option>



                            <?php
                        }
                    }
                    ?>  
                </select>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Estado: *</label>
            <div class="col-md-8">
                <select class="form-control input-circle" required="" name="idestado_registro" id="idestado_registro">
                    <option value="">Seleccione</option>

                    <?php
                    if (isset($estados)) {
                        foreach ($estados->result() as $rowx) {


                          if($rowx->idestado_registro!=2){

                              

                              
                            ?>

                            <option value="<?php echo $rowx->idestado_registro; ?>"><?php echo $rowx->estado; ?></option>



                            <?php
                        }
                    }
                }
                ?>  
            </select>

        </div>
    </div>
    <div class="form-group">
     <label class="col-md-3 control-label">*</label>
     <div class="col-md-4">
       <button type="submit" class="btn btn-circle green">GUARDAR</button>
   </div>
</div>


</div>

</form>

<div class="table-scrollable" id="divtable">
   <table class="table table-hover">
    <thead>
        <tr>
            <th>Estado</th>
            <th>Nombre</th>
            <th>Accion</th>

        </tr>
    </thead>
    <tbody> 

     <?php
     if (isset($registros)) {
        foreach ($registros->result() as $rowx) {
            ?>
            <tr>
                <td><?php echo $rowx->estado; ?></td>
                <td><?php echo $rowx->nombre; ?> <?php echo $rowx->apellidos; ?></td>
                <td><a href="#"  title="<?php echo $rowx->idestado_empleado; ?>" class="btn default btn-xs eliminarXD"><i class="fa fa-remove"></i> Eliminar </a></td>

            </tr>



            <?php
        }
    }
    ?>  


</tbody>
</table>
<script type='text/javascript'>

    $(document).ready(function() {
        $('.eliminarXD').click(function() {
            var idestado_empleado = $(this).attr('title');
            var idregistro = $('#idregistro').val();
            var dataString = 'idestado_empleado=' + idestado_empleado+'&idregistro='+idregistro



            var url = '<?php echo site_url('') ?>asignar/eliminarIndividual';

            $.ajax({
                type: 'GET',
                url: url,
                data: dataString,
                success: function(data) {


                    $('#divtable').html(data);                                               


                    return false;
                }

            });

            return false;
        });

    });
</script>
</div>

