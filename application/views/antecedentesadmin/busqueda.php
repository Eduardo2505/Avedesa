<!DOCTYPE html>

<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <?php $this->load->view('plantillaantecendentesadmin/head') ?>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content ">
    <!-- BEGIN HEADER -->
    <div class="page-header -i navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="<?php echo site_url('') ?>antecedentesadmin/captura">
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
                                    ¡Hola! <?php echo $nombre ?></span>
                            
                            </div>
                           
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
                                <i class="icon-magnifier"></i>
                                <a href="#">BUSQUEDA</a>
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
                                                <i class="fa fa-gift"></i>BÚSQUEDA DE ANTECEDENTES
                                            </div>
                                            <div class="tools">


                                                <a href="javascript:;" class="reload">
                                                </a>

                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <form action="<?php echo site_url('') ?>antecedentesadmin/consulta"  class="horizontal-form">
                                                <div class="form-body">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Número del avalúo</label>
                                                                <input type="text" maxlength="45" class="form-control" name="idGrpAve" placeholder="Id Avaluo" />



                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Calle</label>
                                                                <input type="text" class="form-control" name="calle" placeholder="Calle" />

                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label">Colonia:</label>
                                                                <input type="text" class="form-control" name="colonia" placeholder="Colonia" />

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">CP:</label>
                                                                <input type="tel" name="cp" onKeyPress="return soloNumeros(event)" maxlength="6"  class="form-control" placeholder="CP"/>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Delegación:</label>
                                                                <input type="text"  class="form-control" maxlength="45"   name="delegacion" placeholder="Delegación" />

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Entidad:</label>
                                                                <input type="text" name="entidad"  maxlength="45"  class="form-control" placeholder="Entidad"/>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">

                                                        <!--/span-->

                                                        <!--/span-->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Año:</label>
                                                                <input type="text" onKeyPress="return soloNumeros(event)" name="fecha" maxlength="4" class="form-control" placeholder="200X"/>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Tipo:</label>
                                                                <select name="tipo" class="form-control">
                                                                   <option value="">Selecciona</option>
                                                                   <option value="GRUPO-AVE">GRUPO-AVE</option>
                                                                   <option value="UNIDAD-AVE">UNIDAD-AVE</option>
                                                               </select>

                                                           </div>
                                                       </div>

                                                       <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Usuario:</label>
                                                            <select name="usuario" class="form-control">
                                                               <option value="">Selecciona</option>

                                                               <?php
                                                               if (isset($usuarios)) {
                                                                foreach ($usuarios->result() as $rowx) {
                                                                    ?>
                                                                    <option value="<?php echo $rowx->idusuario; ?>"><?php echo $rowx->idusuario; ?></option>





                                                                    <?php
                                                                }
                                                            }
                                                            ?>   
                                                        </select>

                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fecha de Digitalización de: *</label>

                                                        <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                            <input type="text" class="form-control"  name="inicio">
                                                            <span class="input-group-addon">
                                                                a </span>
                                                                <input type="text" class="form-control" name="final">
                                                            </div>
                                                            <!-- /input-group -->
                                                            <span class="help-block">
                                                                Selecione el rango</span>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <!--/row-->




                                                </div>
                                                <div class="form-actions right">

                                                    <button type="submit" class="btn blue"><i class="fa fa-check"></i> BUSQUEDA</button>
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