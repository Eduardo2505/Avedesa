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

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <div class="block">
                        <div class="header">
                            <h2>REGISTRO INTERMEDIARIO</h2>
                        </div>
                        <div class="content controls">

                            <?php if ($msn == 1) { ?>
                                <div class="block">
                                    <div class="alert alert-success">
                                        <h1> <b>Registro!</b> Se registro correctamente!</h1> 
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                    </div>
                                </div>
                            <?php } else if ($msn == 0) { ?>    

                                <div class="block">

                                    <div class="alert alert-danger">
                                        <h1> <b>Error!</b> Compruebe los datos</h1>
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                    </div>

                                </div>
                            <?php } ?>

                            
                             



                            <form action="<?php echo site_url('') ?>intermediario/registro" method="POST" > 

                                <div class="form-row">
                                    <div class="col-md-3">INTERMEDIARIO: *</div>
                                    <div class="col-md-9"><input type="text" class="form-control" maxlength="45" name="tipo" placeholder="INTERMEDIARIO" required=""/></div>
                                </div>
                                


                                <div class="side pull-right">
                                    <div class="col-md-4">
                                        <div class="btn-group btn-group-lg">

                                            <input type="submit" value="Guardar" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>



                            </form>

                        </div>

                    </div>                




                </div>
                <div class="col-md-2"></div>




            </div>
        </div>

    </body>
</html>