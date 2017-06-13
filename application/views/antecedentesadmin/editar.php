<!DOCTYPE html>

<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
 <?php $this->load->view('plantillaantecendentesadmin/head') ?>
 <?php
 $row = $query->row();
 ?>
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
                                    ¡Hola! <?php echo $nombre ?> </span>
                            
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
                <a href="<?php echo site_url('') ?>antecedentesadmin/busqueda">NUEVA BUSQUEDA</a>
              </li>

              <li>
               <i class="fa fa-angle-right"></i>
               <i class="icon-folder"></i>
               <a href="<?php echo site_url('') ?>antecedentesadmin/consulta">VER ANTECEDENTES</a>
             </li>

             <li>
              <i class="fa fa-angle-right"></i>
              <i class="icon-note"></i>
              <a href="#">EDITAR</a>
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
                      <i class="fa fa-gift"></i>EDITAR 
                    </div>

                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo site_url('') ?>antecedentesadmin/actualizar" method="post" enctype="multipart/form-data"  class="form-horizontal">
                      <input type="hidden" name="idGrpAve" value="<?php echo $idGrpAve?>">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="col-md-3 control-label">Calle: *</label>
                          <div class="col-md-4">
                            <textarea required="" class="form-control input-circle"  name="calle"> <?php echo $row->calle; ?></textarea>

                          </div>
                        </div>
                        <div class="form-group">

                          <label class="col-md-3 control-label">Colonia: *</label>
                          <div class="col-md-3">
                            <input type="text" class="form-control input-circle" maxlength="200" name="colonia" 
                            placeholder="Colonia" value="<?php echo $row->colonia; ?>" required="">
                          </div>

                          <div class="col-md-2">
                            <input type="text"
                            class="form-control input-circle" pattern="[0-9]{5}"
                            maxlength="5" name="cp" 
                            placeholder="CP" value="<?php echo $row->cp; ?>" required="">
                          </div>


                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Delegación: *</label>
                          <div class="col-md-4">
                           <input type="text" class="form-control input-circle" maxlength="200" name="delegacion" 
                           placeholder="Delegación" value="<?php echo $row->delegacion; ?>" required="">
                         </div>
                       </div>


                       <div class="form-group">

                        <label class="col-md-3 control-label">Entidad: *</label>
                        <div class="col-md-3">
                          <input type="text" class="form-control input-circle" maxlength="200" name="entidad" 
                          placeholder="Entidad" value="<?php echo $row->entidad; ?>"  required="">
                        </div>

                        <div class="col-md-2">
                          <input type="text"  
                          pattern="[0-9]{1,4}" class="form-control input-circle" maxlength="4" name="ano" 
                          placeholder="Año" value="<?php echo $row->fecha; ?>"  required="">
                        </div>


                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Tipo: *</label>
                        <div class="col-md-4">
                         <select class="form-control input-circle" required="" name="tipo">
                           <?php $tipo=$row->tipo;

                           if (strcmp($tipo,'GRUPO-AVE')== 0) {
                            ?>
                            <option value="GRUPO-AVE" selected="">GRUPO-AVE</option>
                            <option value="UNIDAD-AVE">UNIDAD-AVE</option>

                            <?php


                          }else{
                           ?>
                           <option value="GRUPO-AVE">GRUPO-AVE</option>
                           <option value="UNIDAD-AVE" selected="">UNIDAD-AVE</option>

                           <?php

                         }
                         ?>



                       </select>
                     </div>
                   </div>
                   <div class="form-group">
                    <label class="col-md-3 control-label">Archivo PDF: *</label>
                    <div class="col-md-4">
                    <input type="file" class="form-control input-circle" name="mi_archivo">
                   </div>
                 </div>
                 <?php if ($msn == 1) { ?>
                 <div class="form-group">
                   <div class="col-md-12">
                    <div class="alert alert-block alert-success fade in">
                      <button type="button" class="close" data-dismiss="alert"></button>
                      <h3 class="alert-heading">Nuevo registro</h3>
                      <p>
                       Se registro correctamente!
                     </p>

                   </div>
                 </div>
               </div>
               <?php } else if ($msn == 0) { ?>    
               <div class="form-group">
                 <div class="col-md-12">

                   <div class="alert alert-block alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <h3 class="alert-heading">¡Error!</h3>
                    <p>
                      <?php echo $msnError ?>
                    </p>

                  </div>
                </div>
              </div>
              <?php } ?>




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