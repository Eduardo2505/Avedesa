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
                                <a href="<?php echo site_url('') ?>quincena/">REGISTRAR</a>
                                <i class="fa fa-angle-right"></i>
                            </li>

                        </ul>

                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->


                    <div class="row">

                        <div class="col-md-12">
                            <div class="row search-form-default">
                                <div class="col-md-12">
                                    <form action="<?php echo site_url('') ?>quincena/mostrar">
                                        <div class="input-group">
                                            <div class="input-cont">


                                                <div class="input-group input-large date-picker input-daterange"  data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control"  name="inicial">
                                                    <span class="input-group-addon">
                                                        a </span>
                                                        <input type="text" class="form-control" name="finali">
                                                    </div>


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
                                                        <i class="fa fa-gift"></i>QUINCENA
                                                    </div>


                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-scrollable">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>

                                                                    <th>INICIO</th>
                                                                    <th>FINAL</th>
                                                                    <th>PAGADO</th>
                                                                    <th>ESTADO</th>
                                                                    <th>ACCIONES</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>



                                                                <?php
                                                                if (isset($registros)) {
                                                                    foreach ($registros->result() as $rowx) {
                                                                        ?>


                                                                        <tr>

                                                                            <td><?php echo $rowx->inicio; ?></td>
                                                                            <td><?php echo $rowx->final; ?></td>
                                                                            <td><?php echo $rowx->pagada; ?></td>
                                                                            <td><?php echo $rowx->estado; ?></td>


                                                                            <td>



                                                                                <a href="<?php echo site_url('') ?>quincena/editar?idquincena=<?php echo $rowx->idquincena ?>"   class="btn btn-lg blue" title="Editar"><i class="fa fa-edit"></i></a>
                                                                                <a href="<?php echo site_url('') ?>recibo/trabajar?idquincena=<?php echo $rowx->idquincena ?>"   class="btn btn-lg blue" title="Trabajadores" ><i class="fa fa-users"></i></a>
                                                                                <a href="<?php echo site_url('') ?>recibo/mostrar?idquincena=<?php echo $rowx->idquincena ?>"    class="btn btn-lg blue" title="Trabajar"> <i class="fa fa-gear"></i></a>
                                                                                <a href="<?php echo site_url('') ?>excel/reporterecibo?idquincena=<?php echo $rowx->idquincena ?>"    class="btn btn-lg green" title="Reporte Quincenal"> <i class="fa fa-file-excel-o"></i></a>
                                                                                <?php
                                                                                if ($rowx->estado == 'Activo') {
                                                                                    ?>
                                                                                    <a href="<?php echo site_url('') ?>quincena/actualizarestado?idquincena=<?php echo $rowx->idquincena ?>&estado=Inactivo"    title="Desactivar" class="btn btn-lg blue"><i class="fa fa-check"></i></a>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <a href="<?php echo site_url('') ?>quincena/actualizarestado?idquincena=<?php echo $rowx->idquincena ?>&estado=Activo"   title="Activar"  class="btn btn-lg red"><i class="fa fa-exclamation"></i></a>
                                                                                    <?php
                                                                                }
                                                                                ?>


                                                                            </td>
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