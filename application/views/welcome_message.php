<!DOCTYPE html>

<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <?php
    include 'plantilla/head.php';
    ?>
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



                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <?php echo $titulos?>
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
                            <div class="tabbable-line boxless tabbable-reversed">

                                <div class="tab-content">


                                    <div class="tab-pane active" id="tab_1">
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>BÚSQUEDA
                                                </div>
                                                <div class="tools">


                                                    <a href="javascript:;" class="reload">
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="<?php echo $urlBusqueda ?>"  class="horizontal-form">
                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">ID</label>
                                                                    <input type="text" maxlength="10" class="form-control" name="folio" placeholder="Folio" />



                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">FOLIO</label>
                                                                    <input type="text" class="form-control" name="numExpediente" placeholder="Nombre de Expediente" />

                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="control-label">Nombre de referencia:</label>
                                                                    <input type="text" class="form-control" name="nomRefer" placeholder="Nombre de referencia" />

                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Teléfono:</label>
                                                                    <input type="tel" name="telefono" onKeyPress="return soloNumeros(event)" maxlength="12"  class="form-control" placeholder="Teléfono"/>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Num. Avalúo:</label>
                                                                    <input type="text"  class="form-control" maxlength="45"   name="numavaluo" placeholder="Num. Avalúo" />

                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Email:</label>
                                                                    <input type="email" name="email"  maxlength="45"  class="form-control" placeholder="Correo Electrónico"/>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tipo Avaluo:</label>
                                                                    <select class="form-control"  name="tipo_avaluo">
                                                                        <option value="">Seleccione</option>

                                                                        <?php
                                                                        if (isset($tipo_avaluo)) {
                                                                            foreach ($tipo_avaluo->result() as $rowx) {
                                                                                ?>

                                                                                <option value="<?php echo $rowx->nombre; ?>"><?php echo $rowx->nombre; ?> </option>



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
                                                                    <label class="control-label">Objeto de avalúo:</label>
                                                                    <select class="form-control" name="objetivoAvaluo">
                                                                        <option value="">Seleccione</option>

                                                                        <?php
                                                                        if (isset($objetivo_avaluo)) {
                                                                            foreach ($objetivo_avaluo->result() as $rowx) {
                                                                                ?>
                                                                                <option value="<?php echo $rowx->nombre; ?>"><?php echo $rowx->nombre; ?></option>



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
                                                                    <input type="text" name="otros" class="form-control" placeholder="Otros"/>

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
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Costo:</label>
                                                                    <input  maxlength="20"  onkeyup="format(this)" onchange="format(this)"  name="costo" class="form-control "  />

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h3 class="form-section">Avalúo</h3>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Fecha de inspección:</label>
                                                                    
                                                                    <div class="input-group input-large date-picker input-daterange"  data-date-format="yyyy-mm-dd">
                                                                        <input type="text" class="form-control"  name="fecha_de_inspeccion_inicio">
                                                                        <span class="input-group-addon">
                                                                            a </span>
                                                                            <input type="text" class="form-control" name="fecha_de_inspeccion_final">
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Hora de inspeccion :</label>
                                                                        <input type="text" class="form-control " name="hora_de_inspeccion" maxlength="45"  />

                                                                    </div>
                                                                </div>
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
                                                            </div>
                                                            <!--/row-->
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Monto crédito:</label>
                                                                        <input onkeyup="format(this)" onchange="format(this)" maxlength="20" name="monto_credito" class="form-control"  />

                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Monto venta:</label>
                                                                        <input onkeyup="format(this)" onchange="format(this)" name="monto_venta" maxlength="20" class="form-control" />                                           

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Intermediario:</label>
                                                                        <input type="text" maxlength="100" class="form-control" name="intermediario" placeholder="Intermediario" />




                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Capturista:</label>
                                                                        <select class="form-control" name="idcapturista"  >
                                                                            <option value="">Seleccione</option>
                                                                            <?php
                                                                            if (isset($capturista)) {
                                                                                foreach ($capturista->result() as $rowx) {
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

                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label>Observaciones:</label>
                                                                        <textarea class="form-control" name="observaciones"></textarea>




                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>

                                                            <div class="row">
                                                               
                                                                <!--/span-->

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Estado:</label>
                                                                        <select class="form-control" name="estado_registro" >
                                                                            <option value="">Seleccione</option>
                                                                            <?php
                                                                            if (isset($estado_registro)) {
                                                                                foreach ($estado_registro->result() as $rowx) {
                                                                                    ?>

                                                                                    <option value="<?php echo $rowx->estado; ?>"><?php echo $rowx->estado; ?></option>



                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>  
                                                                        </select>




                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Entrega de visita:</label>

                                                                        <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"  name="fecha_de_entrega_inicial">
                                                                            <span class="input-group-addon">
                                                                                a </span>
                                                                                <input type="text" class="form-control" name="fecha_de_entrega_finali">
                                                                            </div>
                                                                            <!-- /input-group -->
                                                                            <span class="help-block">
                                                                                Selecione el rango</span>

                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Asiganción:</label>

                                                                                <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                                                    <input type="text" class="form-control"  name="fecha_asigancion_inicial">
                                                                                    <span class="input-group-addon">
                                                                                        a </span>
                                                                                        <input type="text" class="form-control" name="fecha_asigancion_finali">
                                                                                    </div>
                                                                                    <!-- /input-group -->
                                                                                    <span class="help-block">
                                                                                        Selecione el rango</span>

                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                                
                                                                                
                                                                            </div>
                                                                            <div class="row">
                                                                               
                                                                               <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Captura:</label>

                                                                                    <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                                                        <input type="text" class="form-control"  name="fecha_captura_inicial">
                                                                                        <span class="input-group-addon">
                                                                                            a </span>
                                                                                            <input type="text" class="form-control" name="fecha_captura_finali">
                                                                                        </div>
                                                                                        <!-- /input-group -->
                                                                                        <span class="help-block">
                                                                                            Selecione el rango</span>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Cierre:</label>

                                                                                            <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                                                                <input type="text" class="form-control"  name="fecha_cierre_inicial">
                                                                                                <span class="input-group-addon">
                                                                                                    a </span>
                                                                                                    <input type="text" class="form-control" name="fecha_cierre_finali">
                                                                                                </div>
                                                                                                <!-- /input-group -->
                                                                                                <span class="help-block">
                                                                                                    Selecione el rango</span>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                    <label>Registro:</label>

                                                                                                    <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                                                                        <input type="text" class="form-control"  name="registro_inicial_inicial">
                                                                                                        <span class="input-group-addon">
                                                                                                            a </span>
                                                                                                            <input type="text" class="form-control" name="registro_inicial_finali">
                                                                                                        </div>
                                                                                                        <!-- /input-group -->
                                                                                                        <span class="help-block">
                                                                                                            Selecione el rango</span>

                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                </div>




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