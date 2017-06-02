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
                                <a href="<?php echo site_url('') ?>asignar/mostrar">MOSTRAR</a>
                                <i class="fa fa-angle-right"></i>
                            </li>

                        </ul>

                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->


                    <div class="row">

                        <div class="col-md-12">

                            <?php if ($msn == 1) { ?>
                                <div class="alert alert-block alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <h3 class="alert-heading">Nuevo registro</h3>
                                    <p>
                                        Se registro correctamente!
                                    </p>

                                </div>
                            <?php } else if ($msn == 0) { ?>    

                                <div class="alert alert-block alert-danger fade in">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <h3 class="alert-heading">¡Error!</h3>
                                    <p>
                                        Compruebe los datos
                                    </p>

                                </div>
                            <?php } ?>

                            <div class="tabbable-line boxless tabbable-reversed">

                                <div class="tab-content">


                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>ASIGNAR SOLICITUDES
                                            </div>

                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <form   class="form-horizontal">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Empleado: *</label>
                                                        <div class="col-md-4">
                                                            <select class="form-control input-circle" required="" id="idempleado">
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
                                                        <div class="col-md-4">
                                                            <select class="form-control input-circle" required="" id="idestado_registro">
                                                                <option value="">Seleccione</option>

                                                                <?php
                                                                if (isset($estados)) {
                                                                    foreach ($estados->result() as $rowx) {
                                                                        ?>

                                                                        <option value="<?php echo $rowx->idestado_registro; ?>"><?php echo $rowx->estado; ?></option>



                                                                        <?php
                                                                    }
                                                                }
                                                                ?>  
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <script type="text/javascript">

                                                            $(document).ready(function() {

                                                                $('#someTextBox').keypress(function(event) {

                                                                    // alert('You pressed a "enter" key in textbox');
                                                                    var idavale = $(this).val();
                                                                    var dataString = 'idavale=' + idavale;
                                                                    var url = '<?php echo site_url('') ?>asignar/buscar';

                                                                    $.ajax({
                                                                        type: 'GET',
                                                                        url: url,
                                                                        data: dataString,
                                                                        success: function(data) {



                                                                            $('#mostrarprivi').html(data);



                                                                            // return false;
                                                                        }

                                                                    });

                                                                });
                                                            });

                                                            $(document).ready(function() {
                                                                $('.eliminarclass').click(function() {
                                                                    var id = $(this).attr("title");

                                                                    alert(id);
                                                                }


                                                                );
                                                            });
                                                        </script>
                                                        <label class="col-md-3 control-label">ID /FOLIO *</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control input-circle" maxlength="45"  id="someTextBox" placeholder="ID /FOLIO" required="" />

                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-6">
                                                        <div class="table-scrollable" id="mostrarprivi">
                                                            
                                                               
                                                        </div>
                                                         <div class="table-scrollable" id="divtable">
                                                            
                                                               
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>

                                            <!-- END FORM-->
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