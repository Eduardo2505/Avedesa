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
<link rel="shortcut icon" href="<?php echo site_url('') ?>favicon.ico"/>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo site_url('') ?>metronic/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo site_url('') ?>metronic/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="<?php echo site_url('') ?>metronic/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
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


                            <!-- END PAGE HEADER-->
                            <!-- BEGIN PAGE CONTENT-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet box green-meadow calendar">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>Agenda de Inspección
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">

                                                <div class="col-md-12 col-sm-12">
                                                    <div id="calendar" class="has-toolbar">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END CALENDAR PORTLET-->
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




                <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
                <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
                <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
                <!-- END CORE PLUGINS -->
                <!-- BEGIN PAGE LEVEL PLUGINS -->
                <!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
                <script src="<?php echo site_url('') ?>metronic/global/plugins/moment.min.js"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/fullcalendar/fullcalendar.min.js"></script>
                <!-- END PAGE LEVEL PLUGINS -->
                <!-- BEGIN PAGE LEVEL SCRIPTS -->
                <script src="<?php echo site_url('') ?>metronic/global/scripts/metronic.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/layout.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/demo.js" type="text/javascript"></script>
                <script src="<?php echo site_url('') ?>metronic/global/plugins/fullcalendar/lang/es.js" type="text/javascript"></script>

                <script>

                    <?php echo $scriptinicial; ?>

                </script>
                <script>
                    jQuery(document).ready(function() {  

   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
cargardatos();

});
                    
             </script>







         </body>
         <!-- END BODY -->
         </html>