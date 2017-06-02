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

                    <div class="col-md-8">
                        <div class="row search-form-default">
                            <div class="col-md-12">
                                <form action="<?php echo site_url('') ?>adminpagos/mostrarpagosadmin"  class="horizontal-form">
                                    <div class="form-body">


                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">NUM. EXPEDIENTE</label>
                                                    <input type="text" maxlength="10" class="form-control" name="numexpediente" placeholder="NUM. EXPEDIENTE" />
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>REGISTRO</label>

                                                    <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control"  name="inicior">
                                                        <span class="input-group-addon">
                                                            a </span>
                                                            <input type="text" class="form-control" name="finalr">
                                                        </div>
                                                        <!-- /input-group -->
                                                        <span class="help-block">
                                                            Selecione el rango</span>

                                                        </div>
                                                    </div>
                                                    


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>AUTORIZADO</label>

                                                            <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                                                <input type="text" class="form-control"  name="inicioa">
                                                                <span class="input-group-addon">
                                                                    a </span>
                                                                    <input type="text" class="form-control" name="finala">
                                                                </div>
                                                                <!-- /input-group -->
                                                                <span class="help-block">
                                                                    Selecione el rango</span>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">USUARIO:</label>
                                                                    <select name="usuario" class="form-control">
                                                                     <option value="">Selecciona</option>
                                                                     <?php
                                                                     if (isset($usuarios)) {
                                                                        foreach ($usuarios->result() as $rowx) {
                                                                            ?>
                                                                            <option value="<?php echo str_replace(' ','-',$rowx->usuariopago); ?>"><?php echo $rowx->usuariopago; ?></option>





                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>   
                                                                </select>

                                                            </div>
                                                        </div>
                                                        
                                                 </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                         <div class="form-group">
                                                             <label class="control-label">Autorizados</label>
                                                             <select name="autorizado" class="form-control">
                                                                 <option value="">Selecciona</option>
                                                                 <option value="PENDIENTE">PENDIENTE</option>
                                                                 <option value="AUTORIZADO">AUTORIZADO</option>
                                                             </select>
                                                         </div>
                                                     </div>

                                                     <div class="col-md-2">
                                                         <div class="form-group">
                                                             <label class="control-label">*</label>
                                                             <button type="submit" class="form-control btn blue" ><i class="fa fa-check"></i> BUSQUEDA</button>
                                                         </div>
                                                     </div>

                                                    </div>



                                             </div>

                                         </form>
                                     </div>
                                 </div>
                                 <div class="tabbable-line boxless tabbable-reversed">

                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab_1">
                                            <div class="portlet box yellow">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>PAGOS // RESULTADOS :  <?php echo $total?> // TOTAL ANTICIPO : $ <?php echo number_format($totalSuma, 2, '.', ',');?>
                                                    </div>


                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-scrollable">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>

                                                                    <th>NUM. EXPEDIENTE</th>
                                                                    <th>ANTICIPO</th>
                                                                    <th>DECRIPCION</th>
                                                                    <th>REGISTRO</th>
                                                                    <th>USUARIO</th>
                                                                    <th>AUTORIZADO</th>
                                                                    <th>REGISTRO</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>



                                                                <?php

                                                                if (isset($registros)) {
                                                                    foreach ($registros->result() as $rowx) {


                                                                       ?>


                                                                       <tr>
                                                                        <td><?php echo $rowx->num_expediente; ?></td>
                                                                        <td>$ <?php echo number_format($rowx->anticipo, 2, '.', ',');?></td>
                                                                        <td><?php echo $rowx->descripcion; ?></td>

                                                                        <td><?php echo $rowx->registropago; ?></td>
                                                                        <td><?php echo $rowx->usuariopago; ?></td>
                                                                        <td><?php echo $rowx->usuarioAceptacion; ?></td>
                                                                        <td><?php echo $rowx->registroAceptacion; ?></td>





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
                                    <br><br>


                                    <div class="tab-pane active" id="tab_1">
                                        <div class="portlet box red">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>PAGOS ELIMIDANOS // <?php echo $totalx?> 
                                                </div>


                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-scrollable">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>

                                                                <th>NUM. EXPEDIENTE</th>
                                                                <th>ANTICIPO</th>
                                                                <th>DECRIPCION</th>
                                                                <th>REGISTRO</th>
                                                                <th>USUARIO</th>
                                                                <th>ELIMINÓ</th>
                                                                <th>REGISTRO</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                            <?php
                                                            $totalX=0;
                                                            if (isset($pagosEliminados)) {
                                                                foreach ($pagosEliminados->result() as $rowx) {

                                                                   $totalX+=$rowx->anticipo;
                                                                   ?>


                                                                   <tr>
                                                                    <td><?php echo $rowx->num_expediente; ?></td>
                                                                    <td>$ <?php echo number_format($rowx->anticipo, 2, '.', ',');?></td>
                                                                    <td><?php echo $rowx->descripcion; ?></td>

                                                                    <td><?php echo $rowx->registropago; ?></td>
                                                                    <td><?php echo $rowx->usuariopago; ?></td>
                                                                    <td><?php echo $rowx->usuarioAceptacion; ?></td>
                                                                    <td><?php echo $rowx->registroAceptacion; ?></td>





                                                                </tr>



                                                                <?php
                                                            }
                                                        }
                                                        ?>  




                                                    </tbody>
                                                    <tr>

                                                        <th style="text-align: right;">TOTAL: </th>
                                                        <th>$ <?php echo number_format($totalX, 2, '.', ',');?></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>

                                                    </tr>
                                                </table>

                                            </div>

                                        </div>
                                        <div class="pull-right" >

                                            <?php echo $paginationx; ?>

                                        </div>

                                    </div>


                                </div>








                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="tab-pane" >
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>TIKET 
                                    </div>


                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>

                                                    <th>NUM. EXPEDIENTE</th>
                                                    <th>ANTICIPO</th>
                                                    

                                                </tr>
                                            </thead>
                                            <tbody>







                                            </tbody>

                                            <tr>

                                                <th>TOTAL: </th>
                                                <th> $ 000</th>


                                            </tr>

                                        </table>
                                        <a href="<?php echo $urlDescargar ?>" class="form-control btn blue" ><i class="fa fa-check"></i> IMPRIMIR</a>

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