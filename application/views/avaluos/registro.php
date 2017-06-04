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
                                <a href="<?php echo site_url('') ?>avaluos/mostrar">MOSTRAR</a>
                                <i class="fa fa-angle-right"></i>
                            </li>

                        </ul>

                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->


                    <div class="row">

                        <div class="col-md-12">



                            <div class="tabbable-line boxless tabbable-reversed">

                                <div class="tab-content">


                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>REGISTRO AVALUOS
                                            </div>

                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <script type="text/javascript">

                                                $(function() {
                                                    $('.formenviar').submit(function() {

                                                        $('#mensaje').html("");
                                                        var id = $('#changeempleado').val();
                                                        var idq = $('#changeidquincena').val();
                                                        var idqt = $('#changetipo').val();

                                                        if (id == -1 || idq == -1||idqt==-1) {
                                                            $('#mensaje').html('<div class="block"><div class="alert alert-danger"><h1> <b>Error!</b> Seleccione Empleado , Quincena o tipo </h1><button type="button" class="close" data-dismiss="alert">×</button></div></div>');
                                                        } else {
                                                            $('.labelidemple').val(id);
                                                            $('.labelidquinecan').val(idq);
                                                            $('.labelidtioi').val(idqt);

                                                            var data = $(this).serialize();


                                                            $.post('<?php echo site_url('') ?>avaluos/registro', data, function(respuesta) {

                                                                //alert(respuesta);
                                                                $('#mensaje').html(respuesta);



                                                            });




                                                        }
                                                        return false;
                                                    });
                                                });

                                            </script>
                                            <div class="row">
                                                <br>
                                                <div class="col-md-12">
                                                    <div class="col-md-4">


                                                        <select  required="" id="changeempleado" class="form-control input-circle">
                                                            <option value="-1">EMPLEADO</option>

                                                            <?php
                                                            if (isset($empleados)) {
                                                                foreach ($empleados->result() as $rowx) {
                                                                    ?>


                                                                    <option value="<?php echo $rowx->idempleado; ?>"><?php echo $rowx->Nombre; ?> <?php echo $rowx->apellidos; ?></option>


                                                                    <?php
                                                                }
                                                            }
                                                            ?>  
                                                        </select>


                                                    </div>
                                                    <div class="col-md-4">


                                                        <select name="idquincena"  class="form-control input-circle" required="" id="changeidquincena">
                                                            <option value="-1">QUINCENA</option>

                                                            <?php
                                                            if (isset($quincenas)) {
                                                                foreach ($quincenas->result() as $rowx) {
                                                                    ?>


                                                                    <option value="<?php echo $rowx->idquincena; ?>"><?php echo $rowx->inicio; ?> A <?php echo $rowx->final; ?></option>


                                                                    <?php
                                                                }
                                                            }
                                                            ?>  
                                                        </select>


                                                    </div>
                                                    <div class="col-md-4">


                                                        <select name="tipo" required=""  class="form-control input-circle" id="changetipo">
                                                            <option value="-1">TIPO</option>
                                                            <option value="Avalúos">Avalúos</option>
                                                            <option value="Revisiones Externas">Revisiones Externas</option>
                                                            <option value="Revisiones Externas">Correcciones</option>
                                                        </select>


                                                    </div>



                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    
                                                    <form class="formenviar"  class="form-horizontal">
                                                        <input type="hidden" name="idEmpleado" class="labelidemple">
                                                        <input type="hidden" name="idquincena" class="labelidquinecan">
                                                        <input type="hidden" name="tipo" class="labelidtioi">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">UNIDAD DE VAL*</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" pattern="[0-9]{4}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="AAAA-NUM" required=""/>

                                                                </div>
                                                                 <div class="col-md-4">
                                                                     <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                                </div>
                                                            </div>
                                                           
                                                                
                             

                                                        </div>
                                                    </form>
                                                     <form class="formenviar"  class="form-horizontal">
                                                        <input type="hidden" name="idEmpleado" class="labelidemple">
                                                        <input type="hidden" name="idquincena" class="labelidquinecan">
                                                        <input type="hidden" name="tipo" class="labelidtioi">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">VALOR COMERCIAL: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" pattern="(^VC)-[0-9]{2}-[0-9]+" class="form-control input-circle" maxlength="45" name="avaluo" placeholder="VC-AA-NUM"required=""/>

                                                                </div>
                                                                 <div class="col-md-4">
                                                                     <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                                </div>
                                                            </div>
                                                           
                                                          

                                                        </div>
                                                    </form>
                                                      <form class="formenviar"  class="form-horizontal">
                                                        <input type="hidden" name="idEmpleado" class="labelidemple">
                                                        <input type="hidden" name="idquincena" class="labelidquinecan">
                                                        <input type="hidden" name="tipo" class="labelidtioi">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">GRUPO AVE: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" pattern="[0-9]{2}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="AA-NUM" required=""/>

                                                                </div>
                                                                 <div class="col-md-4">
                                                                     <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                                </div>
                                                            </div>
                                                           
                                                          

                                                        </div>
                                                    </form>
                                                     <form class="formenviar"  class="form-horizontal">
                                                        <input type="hidden" name="idEmpleado" class="labelidemple">
                                                        <input type="hidden" name="idquincena" class="labelidquinecan">
                                                        <input type="hidden" name="tipo" class="labelidtioi">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">SERGIO LOVERA: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" pattern="(^SL)-[0-9]{2}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="SL-AA-NUM" required=""/>

                                                                </div>
                                                                 <div class="col-md-4">
                                                                     <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                                </div>
                                                            </div>
                                                           
                                                          

                                                        </div>
                                                    </form>
                                                      <form class="formenviar"  class="form-horizontal">
                                                        <input type="hidden" name="idEmpleado" class="labelidemple">
                                                        <input type="hidden" name="idquincena" class="labelidquinecan">
                                                        <input type="hidden" name="tipo" class="labelidtioi">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">JL: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" pattern="(^JL)-[0-9]{2}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="JL-AA-NUM" required=""/>

                                                                </div>
                                                                 <div class="col-md-4">
                                                                     <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                                </div>
                                                            </div>
                                                           
                                                          

                                                        </div>
                                                    </form>
                                                    <form class="formenviar"  class="form-horizontal">
                                                        <input type="hidden" name="idEmpleado" class="labelidemple">
                                                        <input type="hidden" name="idquincena" class="labelidquinecan">
                                                        <input type="hidden" name="tipo" class="labelidtioi">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">OP: *</label>
                                                                <div class="col-md-4">
                                                                    <input type="text"  pattern="(^OP)-[0-9]{2}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="OP-AA-NUM" required=""/>

                                                                </div>
                                                                 <div class="col-md-4">
                                                                     <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                                </div>
                                                            </div>
                                                           
                                                          

                                                        </div>
                                                    </form>
                                                  
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div id="mensaje">

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