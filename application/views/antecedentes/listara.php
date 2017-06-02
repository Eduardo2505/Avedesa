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
                                    <a href="<?php echo site_url('') ?>antecedentesa">NUEVA BUSQUEDA</a>
                                    <i class="fa fa-angle-right"></i>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('') ?>antecedentesa/mostrar">VER ANTECEDENTES</a>
                                </li>
                            </ul>

                        </div>
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN PAGE CONTENT-->
                        <div class="row">

                            <div class="col-md-12">
                                <div class="tabbable-line boxless tabbable-reversed">

                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab_1">
                                            <div class="portlet box blue">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Antecedentes  
                                                    </div>
                                                      <div class="tools">


                                                    RESULTADOS :  <?php echo $total ?> REGISTROS 
                                                    </a>

                                                </div>


                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-scrollable">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Num. DE AVALÚO</th>
                                                                    <th>CALLE</th>
                                                                    <th>COLONIA</th>
                                                                    <th>CP</th>
                                                                    <th>DELEGACION</th>
                                                                    <th>ENTIDAD</th>
                                                                    <th>FECHA</th>
                                                                    <th>TIPO</th>
                                                                    <th>USUARIO</th>
                                                                    <th>DIGITALIZACIÓN</th>
                                                                    <th>VER</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                                <?php
                                                                if (isset($registros)) {
                                                                    foreach ($registros->result() as $rowx) {
                                                                        ?>


                                                                        <tr>

                                                                            <td><?php echo $rowx->idGrpAve; ?></td>
                                                                            <td><?php echo $rowx->calle; ?></td>
                                                                            <td><?php echo $rowx->colonia; ?></td>
                                                                            <td><?php echo $rowx->cp; ?></td>
                                                                            <td><?php echo $rowx->delegacion; ?></td>
                                                                            <td><?php echo $rowx->entidad; ?></td>
                                                                            <td><?php echo $rowx->fecha; ?></td>
                                                                            <td><?php echo $rowx->tipo; ?></td>
                                                                             <td><?php echo $rowx->idusuario; ?></td>
                                                                              <td><?php echo $rowx->registro; ?></td>
                                                                            <td> <a href="<?php echo $rowx->urlDropbox ?>"  target="_blank" class="btn default btn-xs privi" ><i class="fa fa-search"></i> Ver</a></td>

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



                        <script type="text/javascript">

                            $(document).ready(function() {
                                $('.asignacion').click(function() {
                                    var idregistro = $(this).attr("title");
                                    var dataString = 'idregistro=' + idregistro;

                                    var url = "<?php echo site_url('') ?>asignar/asignarIndividual";

                                    $.ajax({
                                        type: "GET",
                                        url: url,
                                        data: dataString,
                                        success: function(data) {



                                            $("#mostrarprivi").html(data);
                                            $("#btnmodal").click();



                                            return false;
                                        }

                                    });

                                    return false;
                                });

                            });
                        </script>

                        <div style="display: none;">
                            <a class="btn default" data-target="#static" data-toggle="modal" id="btnmodal">
                                View Demo </a>
                            </div>


                            <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">


                                <div class="modal-body"  id="mostrarprivi">
                                    <p>
                                      xx
                                  </p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn blue">SALIR</button>

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
                ComponentsPickers.init();
                Metronic.init(); // init metronic core components
                Demo.init(); // init demo features

            });
        </script>






    </body>
    <!-- END BODY -->
    </html>