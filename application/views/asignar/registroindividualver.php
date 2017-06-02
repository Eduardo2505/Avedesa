



<form class="form-horizontal"  action="<?php echo site_url('') ?>registro/actualizestadoYasigar">
    <input type="hidden" value="<?php echo $idregistro?>" name="idregistro" id="idregistro">
    <input type="hidden" value="<?php echo $idestado_empleado?>" name="idestado_empleado" id="idestado_empleado">

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
                    

                    <option value="6">Cierre</option>

                   
            </select>

        </div>
    </div>
    <div class="form-group">
     <label class="col-md-3 control-label">*</label>
     <div class="col-md-4">
       <button type="submit" class="btn btn-circle green">CERRAR Y ASIGNAR</button>
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
                

            </tr>



            <?php
        }
    }
    ?>  


</tbody>
</table>

</div>

