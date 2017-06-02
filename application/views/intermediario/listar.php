<!DOCTYPE html>
<html lang="es-419">
    <head>        
        <title>Entradas</title>

        <?php $head; ?>

    </head>

    <body class="bg-img-num1"> 

        <div class="container">  
             <?php echo  $menu; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="col-md-4">
                            <form action="<?php echo site_url('') ?>intermediario/mostrar">
                                <input type="text" name="nombre" placeholder="Busqueda.... " maxlength="45">
                                <input type="submit" value="Buscar.." class="btn btn-success">
                            </form>
                        </div>
                        <div class="col-md-8">

                            <div class="content" style="text-align: center">
                                <a href="<?php echo site_url('') ?>intermediario/" class="widget-icon  widget-icon-circle"><span class="icon-time"></span></a> REGISTRAR
                            </div>
                        </div>
                    </div>
                </div>  
            </div> 

            <div class="row">


                <div class="col-md-12">

                    <div class="block">
                        <div class="header">
                            <h2>INTERMEDIARIO</h2>
                        </div>


                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TIPO</th>


                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                if (isset($registros)) {
                                    foreach ($registros->result() as $rowx) {
                                        ?>


                                        <tr>
                                            <td><?php echo $rowx->idintermediario; ?></td>
                                            <td><?php echo $rowx->nombre; ?></td>

                                            <td>



                                                <a href="<?php echo site_url('') ?>intermediario/editar?idregistro=<?php echo $rowx->idintermediario ?>"   class="btn default btn-xs optenerID"> <i class="fa fa-edit"></i> EDITAR</a>


                                            </td>
                                        </tr>



                                        <?php
                                    }
                                }
                                ?>  





                            </tbody>
                        </table>  



                        <div class="dataTables_paginate paging_full_numbers" >
                            <?php echo $pagination; ?>

                        </div>


                    </div>
                </div>                

            </div>




        </div>     









</body>
</html>