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
                                        <a href="<?php echo site_url('') ?>solicitudes">NUEVA BUSQUEDA</a>
                                        <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('') ?>solicitudesWebService">NUEVO REGISTRO</a>
                                        <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('') ?>solicitudes/mostrar">VER SOLICITUDES</a>
                                    </li>
                                </ul>

                            </div>
                            <!-- END PAGE HEADER-->
                            <!-- BEGIN PAGE CONTENT-->
                            <div class="row">




                                <script type="text/javascript">
                                    function format(input)
                                    {

                                        var num = input.value.replace(/\./g, '');
                                        if (!isNaN(num)) {
                                            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                                            num = num.split('').reverse().join('').replace(/^[\.]/, '');
                                            input.value = num;
                                        } else {
                                            input.value = input.value.replace(/[^\d\.]*/g, '');
                                        }


                                    }
                                </script>

                                <div class="col-md-12">
                                   <?php if ($msn >= 1) { ?>
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


                                <div class="tab-pane active" id="tab_1">
                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>REGISTRO
                                            </div>
                                            <div class="tools">


                                                <a href="javascript:;" class="reload">
                                                </a>

                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <form action="<?php echo site_url('') ?>solicitudes/registro" method="POST"  class="horizontal-form">
                                                <div class="form-body">

                                                    <div class="row">

                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label">Nombre de referencia: *</label>
                                                                <input type="text" class="form-control" name="nomRefer" required="" placeholder="Nombre de referencia" />


                                                            </div>
                                                        </div>


<!--                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Num. Expediente:</label>
                                                                     <input type="text" class="form-control" name="numExpediente" placeholder="Nombre de Expediente" />




                                                                </div>
                                                            </div>-->
                                                            <!--/span-->
                                                            


                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Num. Avalúo:</label>
                                                                    <input type="text" class="form-control" maxlength="45"  name="numavaluo" placeholder="Num. Avalúo" />


                                                                </div>
                                                            </div>
                                                            
                                                            <!--/span-->
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Teléfono:</label>
                                                                    <input type="text" name="telefono" maxlength="45"   class="form-control" placeholder="Teléfono"/>


                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Email:</label>
                                                                    <input type="email" name="email"  maxlength="45"  class="form-control" placeholder="Correo Electrónico"/>


                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tipo Avaluo: *</label>
                                                                    <select class="form-control"  name="idtipo_avaluo" required="">
                                                                        <option value="">Seleccione</option>

                                                                        <?php
                                                                        if (isset($tipo_avaluo)) {
                                                                            foreach ($tipo_avaluo->result() as $rowx) {
                                                                                ?>

                                                                                <option value="<?php echo $rowx->idtipo_avaluo; ?>"><?php echo $rowx->nombre; ?></option>



                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>

                                                                    </select>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Objeto de avalúo:</label>
                                                                    <select class="form-control"  name="objetivoAvaluo">
                                                                        <option value="">Seleccione</option>

                                                                        <?php
                                                                        if (isset($objetivo_avaluo)) {
                                                                            foreach ($objetivo_avaluo->result() as $rowx) {
                                                                                ?>

                                                                                <option value="<?php echo $rowx->idobjetivo_avaluo; ?>"><?php echo $rowx->nombre; ?></option>



                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>  






                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Otros:</label>
                                                                    <input type="text" name="otros" maxlength="150"  class="form-control" placeholder="Otros"/>

                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Costo:</label>
                                                                    <input onkeyup="format(this)" onchange="format(this)" maxlength="10" name="costo" class="form-control"  value="0"/>


                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--/row-->

                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label>Ubicación:</label>
                                                                    <textarea class="form-control" name="ubicacion" ></textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <h3 class="form-section">Avalúo</h3>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Inspector:</label>
                                                                    <select class="form-control" name="idempleado" >

                                                                        <option value="">Seleccione</option>

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
                                                            </div>

                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Monto crédito:</label>
                                                                    <input onkeyup="format(this)" onchange="format(this)" maxlength="10" name="monto_credito" class="form-control"  value="0"/>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Monto venta:</label>
                                                                    <input onkeyup="format(this)" onchange="format(this)" name="monto_venta" maxlength="10" class="form-control"  value="0"/>                                         

                                                                </div>
                                                            </div>
                                                         <!--    <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Pago Adelantado:</label>
                                                                    <input onkeyup="format(this)" onchange="format(this)" name="adelanto_pago" maxlength="10"  class="form-control" />                                           


                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Intermediario: </label>
                                                                    <input type="text" maxlength="100" class="form-control" name="intermediario" placeholder="Intermediario" />

                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Capturista:</label>
                                                                    <input type="hidden" name="idcapturista" value="<?php echo $idcapturista; ?>"/>
                                                                    <input type="text"  class="form-control" value="<?php echo $nombre; ?>" disabled=""/>


                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Asigno:</label>
                                                                    <select class="form-control" name="idasigno" >

                                                                        <option value="">Seleccione</option>

                                                                        <?php
                                                                        if (isset($asigno)) {
                                                                            foreach ($asigno->result() as $rowx) {
                                                                                ?>

                                                                                <option value="<?php echo $rowx->idempleado; ?>"><?php echo $rowx->Nombre; ?> <?php echo $rowx->apellidos; ?></option>



                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>  


                                                                    </select>




                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Observaciones:</label>
                                                                    <textarea class="form-control" maxlength="445" name="observaciones"></textarea>
                                                                </div>
                                                            </div>
                                                            <!--/span-->

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Estado:</label>
                                                                    <select class="form-control" name="idestado_registro"  required="">
                                                                    <option value="2">Inspección</option>

                                                                  </select>




                                                              </div>
                                                          </div>
                                                          <!--/span-->
                                                          <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Inspección:</label>
                                                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
                                                                    <input type="text" class="form-control" name="fecha_de_inspeccion" readonly="">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                    </span>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Hora de inspección :</label>


                                                <input type="text" name="hora_de_inspeccion" class="form-control timepicker timepicker-24" value="N/A">
                                                
                                          
                                                                

                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <!--/span-->



                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Entrega de visita:</label>
                                                                <input type="text" name="fecha_de_entrega" disabled="" class="mdatepicker form-control" />

                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Quien recibe:</label>
                                                                <input type="text" maxlength="100" class="form-control" name="usuario_entrega"/>

                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="fecha_asigancion">
                                                        <input type="hidden" name="fecha_captura">
                                                        <input type="hidden" name="fecha_cierre">




                                                    </div>




                                                </div>
                                                <div class="form-actions right">

                                                    <button type="submit" class="btn blue"><i class="fa fa-check"></i> Guardar</button>
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