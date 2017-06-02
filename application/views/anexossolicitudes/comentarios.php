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
                                   <li >
                                    <a href="<?php echo site_url('') ?>anexossolicitudes/acreditado?idregistro=<?php echo $idregistro ?>" >
                                        Acreditado <?php  if(!empty($arryCount["tipo_1"])) {echo '<span style="color:red">* '.$arryCount["tipo_1"].'</span>'; }?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('') ?>anexossolicitudes/predial?idregistro=<?php echo $idregistro ?>" >
                                            Predial <?php  if(!empty($arryCount["tipo_2"])) {echo '<span style="color:red">* '.$arryCount["tipo_2"].'</span>'; }?></a>
                                        </li>
                                        <li>
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
                                                        <a href="<?php echo site_url('') ?>anexos/boletaagua?idregistro=<?php echo $idregistro ?>" >
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
                                                             <li class="active">
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
                                                                                    <form action="<?php echo site_url('') ?>anexossolicitudes/comentario">
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
                                                                                                    <i class="fa fa-gift"></i>ANEXOS COMENTARIOS
                                                                                                    RESULTADOS <?php echo $total; ?><br><br>


                                                                                                </div>


                                                                                            </div>
                                                                                            <div class="portlet-body">

                                                                                                <form method="post"  class="form-horizontal" action="<?php echo site_url('') ?>anexossolicitudes/guaradarcomentario">
                                                                                                 <input type="hidden" name="idregistro" value="<?php echo $idregistro ?>">

                                                                                                 <div class="form-body">
                                                                                                    <div class="form-group">
                                                                                                        <label class="col-md-3 control-label">Comentario: *</label>
                                                                                                        <div class="col-md-4">
                                                                                                            <textarea class="form-control" required="" name="valor" >
                                                                                                                xx
                                                                                                                
                                                                                                            </textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-actions">
                                                                                                        <div class="row">


                                                                                                            <div class="col-md-offset-3 col-md-9">
                                                                                                                <input type="submit" class="btn btn-circle green-haze" name="submit" id="submit" value="ENVIAR"/>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </form>

                                                                                            <div class="table-scrollable">
                                                                                                <table class="table table-hover">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Comentario</th>
                                                                                                            <th>Registro</th>
                                                                                                            <th>Usuario</th>




                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>



                                                                                                        <?php
                                                                                                        if (isset($registros)) {
                                                                                                            foreach ($registros->result() as $rowx) {
                                                                                                                ?>

                                                                                                                <tr>
                                                                                                                    <td ><?php echo $rowx->comentario; ?></td>
                                                                                                                    <td ><?php echo $rowx->registro; ?></td>
                                                                                                                    <td ><?php echo $rowx->usuario; ?></td>




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

                                    <script>
                                        jQuery(document).ready(function() {

                // $('.sidebar-toggler').click();
                // alert("enter");
                Layout.init(); // init current layout
                QuickSidebar.init(); // init quick sidebar
                ComponentsPickers.init();
                Metronic.init(); // init metronic core components
                Demo.init(); // init demo features
                // UIExtendedModals.init();
            });
        </script>





    </body>
    <!-- END BODY -->
    </html>