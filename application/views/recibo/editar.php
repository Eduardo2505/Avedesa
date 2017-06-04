<!DOCTYPE html>

<html lang="es">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <?php $this->load->view('plantilla/head') ?>
        <?php
        $row = $query->row();
        ?>
    </head>

    <body class="page-header-fixed page-quick-sidebar-over-content ">
        <!-- BEGIN HEADER -->
        <div class="page-header -i navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="<?php echo site_url('') ?>solicitudes">
                        <img src="<?php echo site_url('') ?>metronic/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
                    </a>

                </div>

                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">


                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <div class="dropdown-toggle">
                                <img alt="" class="img-circle" src="<?php echo site_url('') ?>metronic/admin/layout/img/avatar3_small.jpg"/>

                                <span class="username username-hide-on-mobile">
                                    ¡Hola! <?php echo $nombre ?> ( <?php echo $puesto ?>) </span>
                            
                            </div>
                           
                        </li>
                        <li class="dropdown dropdown-user" >
                        <a href="<?php echo site_url('') ?>menu" class="dropdown-toggle">
                                <i class="fa fa-bars"></i> <span class="username username-hide-on-mobile"> MENÚ</span>
                            </a>
                           

                        </li>
                        <li class="dropdown dropdown-user" >
                        <a href="<?php echo site_url('') ?>salir/close" class="dropdown-toggle">
                                <i class="icon-logout"></i> <span class="username username-hide-on-mobile"> SALIR</span>
                            </a>
                           

                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">


            <?php echo $menu; ?>


            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">



                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="<?php echo site_url('') ?>recibo/mostrar?idquincena=<?php echo $row->idquincena; ?>">REGRESAR</a>
                                <i class="fa fa-angle-right"></i>
                            </li>

                        </ul>

                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->


                    <div class="row">

                        <div class="col-md-12">






                            <div class="tab-content">


                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>RECIBO DE : <?php echo $row->nomempleado; ?> *** QUINCENA <?php echo $row->inicio; ?> - <?php echo $row->final; ?> PAGADA <?php echo $row->pagada; ?>
                                        </div>

                                    </div>
                                    <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                                        <div class="col-md-6">
                                            <form action='<?php echo site_url('') ?>recibo/actualizar' method="POST"  class="form-horizontal">
                                                <input type="hidden"  value="<?php echo $row->idrecibo; ?>" maxlength="45" name="idrecibo" />
                                                <input type="hidden"  value="0" maxlength="45" name="nomina" />
                                                <input type="hidden"  value="0" maxlength="45" name="a_cuenta" />
                                                <div class="form-body">



                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">- TRANSFERENCIA: *</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control input-circle" value="<?php echo $row->transferencia; ?>" maxlength="45" name="transferencia" placeholder="TRANSFERENCIA" required="">

                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-md-3 control-label">  - DEDUCCIONES: *</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control input-circle" value="<?php echo $row->deducciones; ?>" maxlength="45" name="deducciones" placeholder="DEDUCCIONES" required="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"> - RETARDOS: *</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control input-circle" value="<?php echo $row->retardos; ?>" maxlength="45" name="retardos" placeholder="RETARDOS" required="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">  - ABONO: *</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control input-circle" value="<?php echo $row->abono; ?>" maxlength="45" name="abono" placeholder="ABONO" required="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">  - ANTICIPO: *</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control input-circle" value="<?php echo $row->anticipo; ?>" maxlength="45" name="anticipo" placeholder="ANTICIPO" required="">

                                                        </div>
                                                    </div>

                                                   

                                                  
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">  + EXTRA: *</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control input-circle" value="<?php echo $row->extra; ?>" maxlength="45" name="extra" placeholder="EXTRA" required="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"> + PASAJES: *</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control input-circle" value="<?php echo $row->pasajes; ?>" maxlength="45" name="pasajes" placeholder="PASAJES" required="">

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"> OBSERVACIONES: *</label>
                                                        <div class="col-md-6">

                                                            <textarea class="form-control input-circle" maxlength="445"  name="observaciones"><?php echo $row->Observaciones; ?></textarea>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"> PAGAR: *</label>
                                                        <div class="col-md-4">

                                                            <?php
                                                            $menos = $row->nomina + $row->transferencia + $row->retardos + $row->abono + $row->anticipo + $row->deducciones + $row->a_cuenta;
                                                            $sum = $row->extra + $row->pasajes;
                                                            $total = ($sub + $sum) - $menos;
                                                            ?>
                                                            <input type="hidden" name="total" value="<?php echo $total; ?>">
                                                            <h2>$ <?php echo $total; ?></h2>
                                                        </div>
                                                    </div>




                                                    <div class="form-actions">
                                                        <div class="row">


                                                            <div class="col-md-offset-3 col-md-9">
                                                                <a href="<?php echo site_url('') ?>recibo/mostrar?idquincena=<?php echo $row->idquincena; ?>"  class="btn btn-circle default">REGRESAR</a>
                                                                <button type="submit" class="btn btn-circle blue">Guardar y calcular</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="block" id="udpdatecor">

                                                    </div>

                                                </div>


                                            </form>
                                        </div>
                                        <div class="col-md-6">


                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('.actualizarbtn').click(function() {
                                                        var id = $(this).attr("title");
                                                        var costo = $(this).attr("name");
                                                        var cant = $('#can_' + id).val();
                                                        var idrecibo = '<?php echo $idrecibo; ?>';
                                                        var idquince = '<?php echo $idquincena; ?>';
                                                        var idEmpleadosub = '<?php echo $idEmpleadosub; ?>';
                                                        var dataString = 'idcosto_concepto=' + id + '&cantidad=' + cant + '&costo=' + costo + '&idrecibo=' + idrecibo + '&idquince=' + idquince + '&idEmpleadosub=' + idEmpleadosub;


                                                        $('#subtotal_' + id).html('Guardando...');

                                                        //alert(dataString);
                                                        $.ajax({
                                                            type: "GET",
                                                            url: '<?php echo site_url('') ?>recibo/actualizarconceptos',
                                                            data: dataString,
                                                            success: function(data) {


                                                                $('#subtotal_' + id).html(data);


                                                                $.ajax({
                                                                    type: "GET",
                                                                    url: '<?php echo site_url('') ?>recibo/actulizarsubto',
                                                                    data: dataString,
                                                                    success: function(datax) {


                                                                        $('#ttotal').html(datax);


                                                                    }
                                                                });


                                                            }
                                                        });
                                                        //}

                                                    }


                                                    );
                                                });

                                            </script>
                                            <div class="tabbable-line boxless tabbable-reversed">


                                                <div class="table-scrollable">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>CONCEPTO</th>
                                                                <th>COSTO</th>
                                                                <th>CANTIDAD</th>
                                                                <th>SUBTOTAL</th>
                                                                <th>ACCION</th>



                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                            <?php
                                                            echo $conceptos;
                                                            ?>  




                                                            <tr><td colspan="4">NÓMINA :</td><td><samp id="ttotal"> $ <?php echo $sub ?></samp></td><tr>
                                                        </tbody>
                                                    </table> 
                                                </div>


                                            </div>
                                        </div>

                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
            2016 &copy; HelpMex.com.mx
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>

    <!-- END JAVASCRIPTS -->

    <script>
        jQuery(document).ready(function() {
            // initiate layout and plugins

            Layout.init(); // init current layout
            QuickSidebar.init(); // init quick sidebar
            Demo.init(); // init demo features
            ComponentsPickers.init();
        });
    </script>





</body>
<!-- END BODY -->
</html>