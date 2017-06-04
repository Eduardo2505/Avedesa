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

            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">

                    <ul class="page-sidebar-menu" data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

                            <div class="sidebar-toggler">

                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">

                            </br>
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>





                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>

            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">



                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                 <a href="#">REGRESAR</a>
                                <i class="fa fa-angle-right"></i>

                            </li>
                            <li>

                                <a href="<?php echo site_url('') ?>registro/aprobados">APROBADOS</a>
                                <i class="fa fa-angle-right"></i>

                            </li>
                            <li>

                                <a href="<?php echo site_url('') ?>registro/mostrarsolicitudes">PEDIENTES</a>
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
                                    <form action="<?php echo site_url('') ?>registro/aprobados">
                                        <div class="input-group">
                                            <div class="input-cont">
                                                <input type="text" name="buscar" placeholder="Busqueda.... " class="form-control" maxlength="45">
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

                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('.optenerID').click(function() {
                                                var idRegistro = $(this).attr("title");
                                                var a = $('#' + idRegistro).html();
                                                $('#resultadopro').html(a);

                                                var a1 = $('#' + idRegistro + 'head').html();
                                                $('#cabecera').html(a1);
                                            }


                                            );
                                        });


                                    </script>
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>SOLICITUDES APROBADOS
                                                    RESULTADOS <?php echo $totalrow; ?>

                                                   
                                                </div>


                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-scrollable">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>FOLIO</th>
                                                                <th>Referencia</th>
                                                                <th>Ubicación</th>
                                                                <th>ESTADO</th>
                                                                <th>OPERACION</th>
                                                                <th>Acciones</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                            <?php
                                                            if (isset($registros)) {
                                                                foreach ($registros->result() as $rowx) {
                                                                    ?>

                                                                    <tr>
                                                                        <td ><?php echo $rowx->idregistro; ?></td>
                                                                        <td ><?php echo $rowx->num_expediente; ?></td>
                                                                        <td ><?php echo $rowx->referencia; ?></td>
                                                                        <td ><?php echo $rowx->ubicacion; ?></td>
                                                                        <td><?php echo $rowx->estado; ?></td>
                                                                        <td><?php
                                                                            if ($rowx->edo == 0) {

                                                                                echo "PENDIENTE";
                                                                            } else {
                                                                                echo "REGISTRADO";
                                                                            }
                                                                            ?></td>


                                                                        <td >


                                                                            <br><a href="<?php echo $url ?>avearchivos/subir/anexos.php?idregistro=<?php echo $rowx->idregistro ?>&estado=<?php echo $rowx->estado_fecha ?>&op=reg"  class="btn default btn-xs">ARCHIVOS</a>

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
                Layout.init(); // init current layout
                QuickSidebar.init(); // init quick sidebar
                ComponentsPickers.init();
                Metronic.init(); // init metronic core components
                Demo.init(); // init demo features
                UIExtendedModals.init();
            });
        </script>





    </body>
    <!-- END BODY -->
</html>