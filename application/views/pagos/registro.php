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
                <a href="<?php echo site_url('') ?>solicitudes">REGRESAR</a>
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
                 Se registro correctamente el anticipo!
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
                      <i class="fa fa-money"></i>PAGO
                    </div>

                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo site_url('') ?>pagos/registro" class="form-horizontal">
                      <input type="hidden" name="id" value="<?php echo $id ?>">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="col-md-3 control-label">ANTICIPO : *</label>
                          <div class="col-md-4">
                            <input type="text" class="form-control input-circle" maxlength="45" name="anticipo" placeholder="ANTICIPO" required pattern="[0-9]{1,8}">

                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">DESCRIPCIÓN : </label>
                          <div class="col-md-4">
                            <textarea name="descripcion" class="form-control input-circle"></textarea>


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
                  <div class="portlet-body">
                    <div class="table-scrollable">
                      <table class="table table-hover">
                        <thead>
                          <tr>

                           <th>Descripción</th>
                           
                           <th>Usuario</th>
                           <th>Registro</th>
                           <th>Anticipo</th>
                           <th>ACCIONES</th>

                         </tr>
                       </thead>
                       <tbody>


                        <?php
                        $total=0;

                        if (isset($registros)) {
                          foreach ($registros->result() as $rowx) {


                            $total+=$rowx->anticipo;
                            ?>


                            <tr>

                              <td><?php echo $rowx->descripcion; ?></td>
                              <td><?php echo $rowx->usuario; ?></td>
                              <td><?php echo $rowx->registro; ?></td>
                              <td>$ <?php echo number_format($rowx->anticipo, 2, '.', ',');?></td>

                              <td>



                                <a href="<?php echo site_url('') ?>pagos/eliminar?idpagos=<?php echo $rowx->idpagos ?>&idregistro=<?php echo $id ?>"   class="btn default btn-xs"><i class="fa fa-edit"></i> Eliminar</a>


                              </td>
                            </tr>



                            <?php
                          }
                        }
                        ?>  




                      </tbody>

                      <tr>
                        <th></th>
                        <th style="text-align: right;">Total: </th>
                        <th>$ <?php echo number_format($total, 2, '.', ',');?></th>
                        <th></th>

                      </tr>
                    </table>

                  </div>

                  <!-- -->
                  <br>
                  <span class="label label-sm label-danger" style="font-size: 20px">
                    Eliminados</span>

                    <div class="table-scrollable">
                      <table class="table table-hover">
                        <thead>
                          <tr>

                           <th>Descripción</th>
                           
                           <th>Usuario</th>
                           <th>Registro</th>
                           <th>Anticipo</th>
                           <th>Eleminó</th>
                           <th>Registro</th>


                         </tr>
                       </thead>
                       <tbody>


                        <?php


                        if (isset($registrosEliminados)) {
                          foreach ($registrosEliminados->result() as $rowx) {


                            $total=+$rowx->anticipo;
                            ?>


                            <tr>

                              <td><?php echo $rowx->descripcion; ?></td>
                              <td><?php echo $rowx->usuario; ?></td>
                              <td><?php echo $rowx->registro; ?></td>
                              <td>$ <?php echo number_format($rowx->anticipo, 2, '.', ',');?></td>
                              <td><?php echo $rowx->usuarioElimanado; ?></td>
                              <td><?php echo $rowx->registroEliminado; ?></td>


                            </tr>



                            <?php
                          }
                        }
                        ?>  




                      </tbody>


                    </table>

                  </div>

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