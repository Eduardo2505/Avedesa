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
                                <a href="<?php echo site_url('') ?>costoconcepto/">REGISTRAR</a>
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
                                    <form action="<?php echo site_url('') ?>costoconcepto/mostrar">
                                        <div class="input-group">
                                            <div class="input-cont">
                                                 <div class="col-md-4">
                                                <input type="text" name="concepto" placeholder="Concepto.... " class="form-control" maxlength="45">
                                                 </div>
                                                <div class="col-md-4">
                                                 <input type="text" name="empelado" placeholder="Empelado.... " class="form-control" maxlength="45">
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
                                                    <i class="fa fa-gift"></i>CONCEPTO
                                                </div>


                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-scrollable">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>CONCEPTO</th>
                                                                <th>EMPLEADO</th>
                                                                <th>COSTO</th>
                                                                <th>ACCIONES</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                            <?php
                                                            if (isset($registros)) {
                                                                foreach ($registros->result() as $rowx) {
                                                                    ?>


                                                                    <tr id="tr_<?php echo $rowx->idcosto_concepto ?>">
                                                                        <td><?php echo $rowx->concepto; ?></td>
                                                                        <td><?php echo $rowx->empleado; ?></td>

                                                                        <td><?php echo $rowx->costo; ?></td>

                                                                        <td>



                                                                            <a href="<?php echo site_url('') ?>costoconcepto/editar?id=<?php echo $rowx->idcosto_concepto ?>"   class="btn default btn-xs optenerID"> <i class="fa fa-edit"></i>EDITAR</a>


                                                                            <a href="#"   title="<?php echo $rowx->idcosto_concepto ?>"   class="btn default btn-xs eliminarclass"> <i class="fa fa-remove"></i> ELIMINAR</a>
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




                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('.eliminarclass').click(function() {
                                                var id = $(this).attr("title");

                                                $('#idcam').val(id);
                                                $("#btnmodal").click();
                                            }


                                            );
                                        });

                                        $(document).ready(function() {
                                            $('#btnaceptar').click(function() {
                                                var id = $('#idcam').val();
                                                var dataString = 'id=' + id;


                                                $.ajax({
                                                    type: "GET",
                                                    url: '<?php echo site_url('') ?>costoconcepto/eliminar',
                                                    data: dataString,
                                                    success: function(data) {

                                                        $('#tr_' + id).remove();


                                                    }
                                                });

                                            }


                                            );
                                        });

                                    </script>

                                    <div style="display: none">
                                        <a class="btn default" data-target="#static" data-toggle="modal" id="btnmodal">
                                            View Demo </a>
                                    </div>



                                    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                        <input type="hidden" id="idcam">
                                        <div class="modal-body">
                                            <h4 class="modal-title">¿Esta seguro de eliminar el concepto ?</h4>
                                        </div>
                                        <div class="modal-footer">


                                            <button type="button" class="btn btn-success btn-clean" data-dismiss="modal" id="btnaceptar">SI</button>
                                            <button type="button" class="btn btn-danger btn-clean" data-dismiss="modal">NO</button>

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