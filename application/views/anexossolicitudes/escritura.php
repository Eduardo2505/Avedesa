<!DOCTYPE html>

<html lang="es">

<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
 <meta charset="utf-8"/>
 <title>Anexos</title>
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
 <meta http-equiv="Content-type" content="text/html; charset=utf-8">
 <meta content="" name="description"/>
 <meta content="" name="author"/>

 <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

 <link href="<?php echo site_url('') ?>metronic/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/admin/pages/css/portfolio.css" rel="stylesheet" type="text/css"/>

 <link href="<?php echo site_url('') ?>metronic/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/global/css/plugins.css" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
 <link id="style_color" href="<?php echo site_url('') ?>metronic/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
 <link href="<?php echo site_url('') ?>metronic/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

 <link rel="shortcut icon" href="<?php echo site_url('') ?>favicon.ico"/>


</head>

<body class="page-header-fixed page-quick-sidebar-over-content ">
    <!-- BEGIN HEADER -->
    <div class="page-header -i navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="<?php echo site_url('') ?>registro">
                    <img src="<?php echo site_url('') ?>metronic/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
                </a>

            </div>

            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->

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

                <ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">
                    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                    <li class="sidebar-toggler-wrapper">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

                        <div class="sidebar-toggler">

                        </div>
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->





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
                            <a href="<?php echo site_url('') ?>solicitudesvista/mostrar" >
                                REGRESAR
                            </a>
                            </li>


                        </ul>

                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <div class="col-md-12">

                            <div class="tabbable-line">
                                <ul class="nav nav-tabs">
                                 <li>
                                 <a href="<?php echo site_url('') ?>anexossolicitudes/acreditado?idregistro=<?php echo $idregistro ?>" >
                                        Acreditado <?php  if(!empty($arryCount["tipo_1"])) {echo '<span style="color:red">* '.$arryCount["tipo_1"].'</span>'; }?></a>
                                    </li>
                                    <li>
                                    <a href="<?php echo site_url('') ?>anexossolicitudes/predial?idregistro=<?php echo $idregistro ?>" >
                                            Predial <?php  if(!empty($arryCount["tipo_2"])) {echo '<span style="color:red">* '.$arryCount["tipo_2"].'</span>'; }?></a>
                                        </li>
                                        <li class="active">
                                        <a href="<?php echo site_url('') ?>anexossolicitudes/escritura?idregistro=<?php echo $idregistro ?>" >
                                                Escritura <?php  if(!empty($arryCount["tipo_3"])) {echo '<span style="color:red">* '.$arryCount["tipo_3"].'</span>'; }?></a>
                                            </li>
                                            <li>
                                            <a href="<?php echo site_url('') ?>anexossolicitudes/plano?idregistro=<?php echo $idregistro ?>" >
                                                    Plano  <?php  if(!empty($arryCount["tipo_4"])) {echo '<span style="color:red">* '.$arryCount["tipo_4"].'</span>'; }?> </a>
                                                </li>
                                                <li>
                                                <a href="<?php echo site_url('') ?>anexossolicitudes/vendedor?idregistro=<?php echo $idregistro ?>" >
                                                        Vendedor <?php  if(!empty($arryCount["tipo_5"])) {echo '<span style="color:red">* '.$arryCount["tipo_5"].'</span>'; }?></a>
                                                    </li>
                                                    <li>
                                                    <a href="<?php echo site_url('') ?>anexossolicitudes/boletaagua?idregistro=<?php echo $idregistro ?>" >
                                                            Boleta de Agua <?php  if(!empty($arryCount["tipo_6"])) {echo '<span style="color:red">* '.$arryCount["tipo_6"].'</span>'; }?></a>
                                                        </li>
                                                        <li>
                                                        <a href="<?php echo site_url('') ?>anexossolicitudes/licencia?idregistro=<?php echo $idregistro ?>" >
                                                                Licencia de construcción <?php  if(!empty($arryCount["tipo_7"])) {echo '<span style="color:red">* '.$arryCount["tipo_7"].'</span>'; }?></a>
                                                            </li>
                                                            <li>
                                                            <a href="<?php echo site_url('') ?>anexossolicitudes/fotos?idregistro=<?php echo $idregistro ?>" >
                                                                 Fotos <?php  if(!empty($arryCount["tipo_8"])) {echo '<span style="color:red">* '.$arryCount["tipo_8"].'</span>'; }?></a>
                                                             </li>
                                                             <li>
                                                             <a href="<?php echo site_url('') ?>anexossolicitudes/comentario?idregistro=<?php echo $idregistro ?>" >
                                                                    Comentarios </a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="tab__blue">




                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="row search-form-default">
                                                                                <div class="col-md-12">
                                                                                    <form action="<?php echo site_url('') ?>anexossolicitudes/escritura">
                                                                                        <input type="hidden" name="idregistro" value="<?php echo $idregistro ?>">
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


                                                                                    <div class="tab-pane active" id="tab_1">
                                                                                        <div class="portlet box blue">
                                                                                            <div class="portlet-title">
                                                                                                <div class="caption">
                                                                                                    <i class="fa fa-gift"></i>ANEXOS ESCRITURA
                                                                                                    RESULTADOS <?php echo $total; ?><br><br>


                                                                                                </div>


                                                                                            </div>
                                                                                            <div class="portlet-body" style="text-align: center;">



                                                                                              <a href="<?php echo site_url('') ?>subir/cargar.php?<?php echo $linkarchivo ?>&tipo=<?php echo $tipoarchivo ?>" class="btn btn-circle green-haze" ><i class="fa fa-file-o"></i> SUBIR ARCHIVOS </a>


                                                                                              <div class="table-scrollable">
                                                                                                <table class="table table-hover">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Descripcion</th>
                                                                                                            <th>Registro</th>
                                                                                                            <th>Usuario</th>

                                                                                                            <th>Acciones</th>


                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>



                                                                                                        <?php
                                                                                                        if (isset($registros)) {
                                                                                                            foreach ($registros->result() as $rowx) {
                                                                                                                ?>

                                                                                                                <tr>
                                                                                                                    <td ><?php echo $rowx->descripcion; ?></td>
                                                                                                                    <td ><?php echo $rowx->registro; ?></td>
                                                                                                                    <td ><?php echo $rowx->usuario; ?></td>

                                                                                                                    <td >
                                                                                                                        <?php

                                                                                                                        if($rowx->dropbox==0){

                                                                                                                            ?>

                                                                                                                            <a class="mix-preview fancybox-button" href="<?php echo site_url('') ?>subir/server/php/files/<?php echo $rowx->url; ?>" title="<?php echo $rowx->descripcion; ?>" data-rel="fancybox-button" target="_blank">
                                                                                                                                <i class="fa fa-search"></i>VER
                                                                                                                            </a>







                                                                                                                            <?php


                                                                                                                        }else{
                                                                                                                           if($rowx->urlDropbox==null){

                                                                                                                            ?>

                                                                                                                            <a  target="_blank" href="https://www.dropbox.com/sh/m7l8k1be8k6piph/AAC4n5ID4XY0MQvXVljXdDHSa?dl=0&preview=<?php echo $rowx->descripcion; ?>"  class="btn default btn-xs">VER</a>

                                                                                                                            <?php }else{ ?>

                                                                                                                            <a  target="_blank" href="<?php echo $rowx->urlDropbox; ?>"  class="btn default btn-xs">VER</a>




                                                                                                                            <?php } ?>


                                                                                                                            <?php




                                                                                                                        }
                                                                                                                        ?>






                                                                                                                        <a href="<?php echo site_url('') ?>anexossolicitudes/eliminararchivo?idarchivo=<?php echo $rowx->idarchivos ?>&tipo=<?php echo $tipoarchivo ?>"  class="btn default btn-xs">ELIMINAR</a>

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

                                                            </div>

                                                            <script type="text/javascript">

                                                                $(document).ready(function() {
                                                                    $('#submit').click(function() {
                                                                        var ar = $('#archivos').val();
                                                                        if (ar != '') {
                                                    //  alert(ar);
                                                    $('#subiendo').click();
                                                }
                                            }


                                            );
                                                                });
                                                            </script>
                                                            <div style="display: none">
                                                                <a class="btn default" data-target="#static" data-toggle="modal" id="subiendo">
                                                                    View Demo </a>


                                                                </div>
                                                                <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                                                    <div class="modal-body">
                                                                        <p>
                                                                            Subiendo....
                                                                        </p>
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
                                    <script type="text/javascript" src="<?php echo site_url('') ?>metronic/global/plugins/jquery-mixitup/jquery.mixitup.min.js"></script>
                                    <script type="text/javascript" src="<?php echo site_url('') ?>metronic/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
                                    <!-- END PAGE LEVEL PLUGINS -->
                                    <script src="<?php echo site_url('') ?>metronic/global/scripts/metronic.js" type="text/javascript"></script>
                                    <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/layout.js" type="text/javascript"></script>
                                    <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
                                    <script src="<?php echo site_url('') ?>metronic/admin/layout/scripts/demo.js" type="text/javascript"></script>
                                    <script src="<?php echo site_url('') ?>metronic/admin/pages/scripts/portfolio.js"></script>
                                    <script>
                                        jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
Portfolio.init();
});
</script>





</body>
<!-- END BODY -->
</html>