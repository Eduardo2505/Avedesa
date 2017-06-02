<!DOCTYPE html>

<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Admin Ave</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->

    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo site_url('') ?>metronic/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="<?php echo site_url('') ?>metronic/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="<?php echo site_url('') ?>favicon.ico"/>



    <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>


    <script src="<?php echo site_url('') ?>metronic/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/demo.js" type="text/javascript"></script>
    <script src="<?php echo site_url('') ?>metronic/admin/pages/scripts/components-pickers.js"></script>

    <link href="<?php echo site_url('') ?>metronic/colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/colorpicker/css/layout.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo site_url('') ?>metronic/colorpicker/js/colorpicker.js" type="text/javascript"></script>
    <script src="<?php echo site_url('') ?>metronic/colorpicker/js/eye.js" type="text/javascript"></script>
    <script src="<?php echo site_url('') ?>metronic/colorpicker/js/utils.js" type="text/javascript"></script>
    
    
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
                                        <a href="<?php echo site_url('') ?>empleado/mostrar">MOSTRAR</a>
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
                                                        <i class="fa fa-gift"></i>REGISTRO EMPLEADO
                                                    </div>

                                                </div>
                                                <div class="portlet-body form">
                                                    <!-- BEGIN FORM-->
                                                    <form action="<?php echo site_url('') ?>empleado/registro" method="POST"   class="form-horizontal">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">NOMBRE: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control input-circle" maxlength="45" name="Nombre" placeholder="Nombre" required="">

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">APELLIDOS: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control input-circle" maxlength="45" name="apellidos" placeholder="Apellidos" required="">

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">INICIALES: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control input-circle"  maxlength="45" name="iniciales" placeholder="INICIALES">

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">EMAIL: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="email" class="form-control input-circle"  maxlength="45" name="email" placeholder="EMAIL">

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">ESTADO: *</label>
                                                                <div class="col-md-4">

                                                                    <select class="form-control input-circle" required="" name="estado">
                                                                        <option value="1">Activo</option>
                                                                        <option value="0">Inactivo</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">EMPRESA: *</label>
                                                                <div class="col-md-4">

                                                                    <select class="form-control input-circle" required="" name="idempresa">
                                                                        <option value="">Seleccione</option>

                                                                        <?php
                                                                        if (isset($empresas)) {
                                                                            foreach ($empresas->result() as $rowx) {
                                                                                ?>

                                                                                <option value="<?php echo $rowx->idempresa; ?>"><?php echo $rowx->nombre; ?></option>



                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>  
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Color: *</label>
                                                                <div class="col-md-4">
                                                                    <div id="colorSelector"><div style="background-color: #c91e6e"></div></div>
                                                                    <input type="hidden" id="colorNuevo" name="color" value="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">PUESTO: *</label>
                                                                <div class="col-md-4">
                                                                    <?php
                                                                    if (isset($puestox)) {
                                                                        foreach ($puestox->result() as $rowx) {
                                                                            ?>

                                                                            <div class="checkbox-inline">
                                                                                <input type="checkbox" value="<?php echo $rowx->idcat_puesto; ?>" name="numero[]"> <?php echo $rowx->puesto; ?>
                                                                            </div>



                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>  
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                        <button type="submit" class="btn btn-circle blue">GUARDAR</button>

                                                                    </div>
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
            <script type="text/javascript">
                $('#colorSelector').ColorPicker({
                    color: '#c91e6e',
                    onShow: function (colpkr) {
                        $(colpkr).fadeIn(500);
                        return false;
                    },
                    onHide: function (colpkr) {
                        $(colpkr).fadeOut(500);
                        return false;
                    },
                    onChange: function (hsb, hex, rgb) {
                        $('#colorSelector div').css('backgroundColor', '#' + hex);
                        $('#colorNuevo').val('#' + hex);
                    }
                });
            </script>
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