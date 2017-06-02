<!DOCTYPE html>
<html lang="es">
    <head>  
        <?php $head; ?>

    </head>
    <body class="bg-img-num1"> 
        <div class="container"> 

            <?php echo  $menu; ?>




            <div class="row">
                <div class="col-md-12">
                    <div class="block">

                        <div class="content" style="text-align: center">

                            <a href="<?php echo site_url('') ?>intermediario/mostrar" class="widget-icon  widget-icon-circle"><span class="icon-time"></span></a> MOSTAR REGISTROS
                        </div>
                    </div>
                </div>  
            </div>     
            <?php
            $row = $query->row();
            ?>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <div class="block">
                        <div class="header">
                            <h2>EDITAR INTERMEDIARIO</h2>
                        </div>
                        <div class="content controls">
                            <script type="text/javascript">

                                $(function() {
                                    $('#fromactualizar').submit(function() {
                                        var data = $(this).serialize();
                                         $('#udpdatecor').html("    <p> Procesando .......<p>");
                                      
                                        $.get('<?php echo site_url('') ?>intermediario/actualizar', data, function(respuesta) {
                                            $('#udpdatecor').html(respuesta);

                                        });
                                        return false;
                                    });
                                });

                            </script>


                            <form  id="fromactualizar" > 
                                <input type="hidden"  value="<?php echo $row->idintermediario; ?>" maxlength="45" name="idtipo" />

                                <div class="form-row">
                                    <div class="col-md-3">INTERMEDIARIO: *</div>
                                    <div class="col-md-9"><input type="text" class="form-control" value="<?php echo $row->nombre; ?>" maxlength="45" name="tipo" placeholder="INTERMEDIARIO" required=""/></div>
                                </div>



                                <div class="side pull-right">
                                    <div class="col-md-5">
                                        <div class="btn-group btn-group-lg">
                                            <a href="javascript:history.back(1)"   class="btn btn-warnings">REGRESAR</a>




                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn-group btn-group-lg">

                                            <input type="submit" value="Guardar cambios" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                                
                                



                            </form>
                            
                             <div class="block" id="udpdatecor">
                                 
                                </div>

                        </div>

                    </div>                




                </div>
                <div class="col-md-2"></div>




            </div>
        </div>

    </body>
</html>