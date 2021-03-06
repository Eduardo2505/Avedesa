<!DOCTYPE html>

<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <?php $this->load->view('plantilla/head') ?>
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




                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->


                <div class="row">

                    <div class="col-md-12">
                        <div class="row search-form-default">
                            <div class="col-md-12">
                                <form action="<?php echo site_url('') ?>adminpagos/mostraranticipos">
                                    <div class="input-group">
                                        <div class="input-cont">
                                            <input type="text" name="nombre" placeholder="NUM. EXPEDIENTE" class="form-control">
                                        </div>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn green-haze">
                                                Buscar &nbsp; <i class="m-icon-swapright m-icon-white"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tabbable-line boxless tabbable-reversed">

                            <div class="tab-content">


                                <div class="tab-pane active" id="tab_1">
                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>EXPEDIENTES CON ANTICIPADOS // RESULTADOS :  <?php echo $total?> // TOTAL ANTICIPO : $ <?php echo number_format($totalSuma, 2, '.', ',');?>
                                            </div>


                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th>NUM. EXPEDIENTE</th>
                                                            <th>REFERENCIA</th>
                                                            
                                                            <th>INSPECCIÓN</th>
                                                            <th>ANTICIPO</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <?php
                                                        
                                                        if (isset($registros)) {
                                                            foreach ($registros->result() as $rowx) {

                                                             
                                                             ?>


                                                             <tr>
                                                                <td><a href="mostrarpagosdetalles?numexpediente=<?php echo $rowx->num_expediente;?> " ><?php echo $rowx->num_expediente; ?></a></td>
                                                                
                                                                <td><?php echo $rowx->referencia; ?></td>

                                                                <td><?php echo $rowx->inspector; ?></td>
                                                                <td>$ <?php echo number_format($rowx->pago, 2, '.', ',');?></td>


                                                            </tr>



                                                            <?php
                                                        }
                                                    }
                                                    ?>  




                                                </tbody>
                                                
                                            </table>

                                        </div>

                                    </div>
                                    <div class="pull-right" >

                                        <?php echo $pagination; ?>

                                    </div>
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