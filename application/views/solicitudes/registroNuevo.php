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
                                <a href="<?php echo site_url('') ?>solicitudesConsulta">NUEVA BUSQUEDA</a>
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





                        <div class="col-md-12">

                            <div class="col-md-12">
                               <?php if ($msn == 1) { ?>
                                   <div class="alert alert-block alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <h3 class="alert-heading">Nuevo registro</h3>
                                    <p>
                                       Se registro correctamente!
                                   </p>

                               </div>
                           <?php }?>    





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
                                            <form action="<?php echo site_url('') ?>solicitudesWebService/registro" method="POST"  class="horizontal-form">
                                                <div class="form-body">

                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="form-group">

                                                              <input type="checkbox"  checked id="valortipoSnc"  style="width: 15px;height: 15px">
                                                              <input type="hidden" value="1" name="tipoSnc" id="tipoSnc" >
                                                              <label class="control-label"> Sincronizacion GYS </label>
                                                          </div>
                                                      </div>





                                                      <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Num. Avalúo:</label>
                                                            <input type="text" onkeyup="mayus(this);" class="form-control" maxlength="45"  name="folio_cliente" placeholder="Num. Avalúo" />


                                                        </div>
                                                    </div>

                                                   <!--      <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Fecha Compromiso:</label>
                                                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
                                                                    <input type="text" class="form-control" name="fecha_compremiso" readonly="">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                    </span>
                                                                </div>

                                                            </div>
                                                        </div> -->

                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Costo:</label>
                                                                <input onkeypress="return soloNumeros(event, this)" maxlength="16" name="costo" class="form-control monedaxn"  value="0"/>


                                                            </div>
                                                        </div>

                                                      <!--   <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Fecha Solicitud:</label>
                                                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
                                                                    <input type="text" class="form-control" name="fecha_solicitud" readonly="">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                    </span>
                                                                </div>

                                                            </div>
                                                        </div> -->

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Otros:</label>
                                                                <input type="text" onkeyup="mayus(this);" name="otros" maxlength="150"  class="form-control" placeholder="Otros"/>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row">


                                                       <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Operador :</label>
                                                            <select class="form-control" name="idOperador" >

                                                                <option value="">Seleccione</option>
                                                                <?php
                                                                if (isset($operador)) {
                                                                    foreach ($operador->result() as $rowx) {

                                                                        if ($this->config->item('idEmpleado') == $rowx->idempleado) {
                                                                            ?>


                                                                            <option selected="selected" value="<?php echo $rowx->idempleado; ?>"><?php echo $rowx->Nombre; ?> <?php echo $rowx->apellidos; ?></option>

                                                                            <?php
                                                                        } else {
                                                                            ?>

                                                                            <option value="<?php echo $rowx->idempleado; ?>"><?php echo $rowx->Nombre; ?> <?php echo $rowx->apellidos; ?></option>


                                                                            <?php
                                                                        }


                                                                    }
                                                                }
                                                                ?>  



                                                            </select>




                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Inspector :</label>
                                                            <select class="form-control" name="idInsepctor" >

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

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Ejecutivo (Asigno) :</label>
                                                            <select class="form-control" name="idEjecutivo" >

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


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Tipo Avaluo *: </label>
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


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Reportar Tesoreria: </label>
                                                            <select class="form-control"  name="reporteTesoreria" >
                                                                <option value="">Seleccione</option>
                                                                <option value="1">Si</option>
                                                                <option value="0">NO</option>

                                                            </select>


                                                        </div>
                                                    </div>


                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="control-label">Intermediario Financiero: </label>
                                                            <select class="form-control" id="idIntemediario"  name="idIntemediario" >
                                                                <option value="">Seleccione</option>

                                                                <?php
                                                                if (isset($intemediarios)) {
                                                                    foreach ($intemediarios->result() as $rowx) {
                                                                        ?>

                                                                        <option value="<?php echo $rowx->clave; ?>"><?php echo $rowx->descripcion; ?></option>



                                                                        <?php
                                                                    }
                                                                }
                                                                ?>


                                                            </select>


                                                        </div>


                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Recomienda : </label>
                                                            <input type="text" maxlength="100" class="form-control" name="otro_intermediario" placeholder="Recomienda" />

                                                        </div>
                                                    </div>

                                                    <!--/span-->
                                                </div>
                                                <!--/row-->


                                                <h3 class="form-section">Visita</h3>


                                                <div class="row">




                                                  <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label">Nombre de referencia * : </label>
                                                        <input type="text" onkeyup="mayus(this);" class="form-control" name="nomRefer" required="" placeholder="Nombre de referencia" />


                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Fecha Visita:</label>
                                                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
                                                            <input type="text" class="form-control" name="fecha_visita" readonly="">
                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Hora de inspección :</label>


                                                        <input type="text" name="hora_de_inspeccion" class="form-control timepicker timepicker-24" >




                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Visita Exitosa: </label>
                                                        <select class="form-control"  name="visita_exitosa" >
                                                            <option value="-1">Seleccione</option>
                                                            <option value="1">Si</option>
                                                            <option value="0">NO</option>

                                                        </select>


                                                    </div>
                                                </div>





                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Teléfono *:</label>
                                                        <input type="text"  required=""  onKeyPress="return soloNumeros(event)" name="telefono_v" maxlength="18"   class="form-control" placeholder="Teléfono"/>


                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Teléfono 2 :</label>
                                                        <input type="text"   name="telefono_v2" maxlength="18"   class="form-control" placeholder="Teléfono 2"/>


                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Email:</label>
                                                        <input type="email" name="email_v"  maxlength="45"  class="form-control" placeholder="Correo Electrónico"/>


                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Monto crédito:</label>
                                                        <input  maxlength="16" onkeypress="return soloNumeros(event, this)" name="monto_credito" class="form-control monedaxn"  value="0"/>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Monto venta:</label>
                                                        <input onkeypress="return soloNumeros(event, this)" name="monto_venta" maxlength="16" class="form-control monedaxn"  value="0"/>                                         

                                                    </div>
                                                </div>








                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Observaciones:</label>
                                                        <textarea onkeyup="mayus(this);" class="form-control" maxlength="445" name="observaciones"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Quien recibe:</label>
                                                        <input type="text" onkeyup="mayus(this);" maxlength="100" class="form-control" name="usuario_entrega"/>

                                                    </div>
                                                </div>
                                            </div>

                                            <h3 class="form-section">Solicitante</h3>

                                            <div class="row">

                                               <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Nombre *:</label>
                                                    <input type="text" required="" onkeyup="mayus(this);" name="nombre_s" maxlength="45"   class="form-control" placeholder="Nombre"/>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Primer Apellido *:</label>
                                                    <input type="text" required=""  onkeyup="mayus(this);" name="p_apellido_s" maxlength="45"   class="form-control" placeholder="Primer Apellidos"/>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Segundo Apellido:</label>
                                                    <input type="text" onkeyup="mayus(this);" name="s_apellido_s" maxlength="45"   class="form-control" placeholder="Segundo Apellido"/>


                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Tipo Persona *: </label>
                                                    <select class="form-control"  name="tipo_persona_s" required="">
                                                        <option value="">Seleccione</option>
                                                        <option value="Moral">Moral</option>
                                                        <option value="Física">Fisica</option>

                                                    </select>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">RFC:</label>
                                                    <input type="text" onkeyup="mayus(this);" name="rfc_s" maxlength="45"   class="form-control" placeholder="RFC"/>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Nss:</label>
                                                    <input type="text" onkeyup="mayus(this);" name="nss_s" maxlength="45"   class="form-control" placeholder="Num. Seguro Social"/>


                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">C.P. :</label>
                                                    <input type="text"   name="cp_s" maxlength="6"   class="form-control" placeholder="C.P."/>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Colonia * :</label>
                                                    <input type="text" required=""  onkeyup="mayus(this);" name="col_s" maxlength="45"   class="form-control" placeholder="Colonia"/>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Entidad *: </label>
                                                    <select class="form-control"  id="idEntidad_s" name="idEntidad_s" required="">
                                                        <option value="">Seleccione</option>

                                                        <?php
                                                        if (isset($entidades)) {
                                                            foreach ($entidades->result() as $rowx) {
                                                                ?>

                                                                <option value="<?php echo $rowx->idEntidad; ?>"><?php echo $rowx->entidad; ?></option>



                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Municipio *: </label>

                                                    <select class="form-control" id="dividMunicipio_s"  name="id_muni_s" required="">
                                                        <option value="">Seleccione</option>



                                                    </select>



                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Calle *:</label>
                                                    <input type="text" required=""  onkeyup="mayus(this);" name="calle_s" maxlength="45"   class="form-control" placeholder="Calle "/>


                                                </div>
                                            </div>



                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Num. Ext *:</label>
                                                    <input type="text" onkeyup="mayus(this);" required="" name="num_ext_s" maxlength="45"   class="form-control" placeholder="Num. Ext:"/>


                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Num. Int :</label>
                                                    <input type="text"   onkeyup="mayus(this);" name="num_int_s" maxlength="45"   class="form-control" placeholder="Num. Int"/>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Teléfono:</label>
                                                    <input type="text"  onKeyPress="return soloNumeros(event)" name="telefono_s" maxlength="18"   class="form-control" placeholder="Teléfono"/>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Email:</label>
                                                    <input type="text" name="email_s" maxlength="45"   class="form-control" placeholder="Email"/>


                                                </div>
                                            </div>


                                        </div>


                                        <h3 class="form-section">Inmueble</h3>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                  <input type="checkbox"  checked id="valorCheck"  style="width: 15px;height: 15px">
                                                  <input type="hidden" value="1" name="mismoSolicitante" id="mismoSolicitante" >
                                                  <label class="control-label">El mismo del solicitante </label>
                                              </div>
                                          </div>

                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Tipo Inmueble * :</label>
                                                <select class="form-control"   name="idtipo_avaluo_i" required="">
                                                    <option value="">Seleccione</option>

                                                    <?php
                                                    if (isset($tipoInmueble)) {
                                                        foreach ($tipoInmueble->result() as $rowx) {
                                                            ?>

                                                            <option value="<?php echo $rowx->idtipoInmueble; ?>"><?php echo $rowx->tipo; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">C.P :</label>
                                                <input type="text"  disabled="" onKeyPress="return soloNumeros(event)" name="cp_i" maxlength="6"   class="form-control inmuebleclass" placeholder="C:P"/>


                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Entidad: </label>
                                                <select class="form-control inmuebleclass" disabled=""  id="idEntidad_i" name="idEntidad_i" required="">
                                                    <option value="-1">Seleccione</option>

                                                    <?php
                                                    if (isset($entidades)) {
                                                        foreach ($entidades->result() as $rowx) {
                                                            ?>

                                                            <option value="<?php echo $rowx->idEntidad; ?>"><?php echo $rowx->entidad; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>


                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Municipio: </label>

                                                <select class="form-control inmuebleclass" disabled="" id="divid_muni_i"  name="id_muni_i" required="">
                                                    <option value="-1">Seleccione</option>

                                                </select>


                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Colonia:</label>
                                                <input type="text" disabled="" onkeyup="mayus(this);" name="col_i" maxlength="100"   class="form-control inmuebleclass" placeholder="Colonia"/>


                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Calle:</label>
                                                <input type="text" disabled="" onkeyup="mayus(this);" name="calle_i" maxlength="150"   class="form-control inmuebleclass" placeholder="Calle"/>


                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Num. Int:</label>
                                                <input type="text" disabled="" onkeyup="mayus(this);" name="num_int_i" maxlength="45"   class="form-control inmuebleclass" placeholder="Num. Int"/>


                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Num. Ext:</label>
                                                <input type="text" disabled="" onkeyup="mayus(this);" name="num_ex_i" maxlength="45"   class="form-control inmuebleclass" placeholder="Num. Ext"/>


                                            </div>
                                        </div>



                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Mz:</label>
                                                <input type="text" onkeyup="mayus(this);" name="mz_i" maxlength="45"   class="form-control" placeholder="Mz"/>


                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Lt.:</label>
                                                <input type="text"  onkeyup="mayus(this);" name="lt_i" maxlength="45"   class="form-control" placeholder="Lt"/>


                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Condominio.:</label>
                                                <input type="text"  onkeyup="mayus(this);" name="condominio_i" maxlength="45"   class="form-control" placeholder="Condominio"/>


                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Entrada.:</label>
                                                <input type="text"  onkeyup="mayus(this);" name="entrada_i" maxlength="45"   class="form-control" placeholder="Entrada"/>


                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Edificio.:</label>
                                                <input type="text"  onkeyup="mayus(this);" name="edificio_i" maxlength="45"   class="form-control" placeholder="Edificio"/>


                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Depto.:</label>
                                                <input type="text"  onkeyup="mayus(this);" name="depto_i" maxlength="45"   class="form-control" placeholder="Departamento"/>


                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Entre Calle.:</label>
                                                <input type="text"  onkeyup="mayus(this);" name="entre_calle_i" maxlength="150"   class="form-control" placeholder="Entre Calle."/>


                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Y  Calle.:</label>
                                                <input type="text"  onkeyup="mayus(this);" name="yCalle_i" maxlength="150"   class="form-control" placeholder="Y  Calle."/>


                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Ciudad.:</label>
                                                <input type="text"  onkeyup="mayus(this);" name="ciudad_i" maxlength="45"   class="form-control" placeholder="Ciudad"/>


                                            </div>
                                        </div>

<!-- <div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Latitud.:</label>
        <input type="text" disabled="" onkeyup="mayus(this);" name="latitud_i" maxlength="45"   class="form-control inmuebleclass" placeholder="Latitud"/>


    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Longitud.:</label>
        <input type="text" disabled="" name="longitud_i" maxlength="45"   class="form-control inmuebleclass" placeholder="Longitud"/>


    </div>
</div>

<div class="col-md-3">

    <div class="form-group">
        <label class="control-label">Altitud.:</label>
        <input type="text"  disabled="" name="altitud_i" maxlength="45"   class="form-control inmuebleclass" placeholder="Altitud"/>


    </div>
</div>
-->

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
<div style="display: none">
    <a class="btn default" data-target="#static" data-toggle="modal" id="btnmodal">
    View Demo </a>
</div>
<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-body" style="text-align: center;"><br><br>
       <i class="fa fa-exclamation-triangle" style="font-size: 40px;color:#F3565D"></i><br> <br><p id="mensajeError">

        </p>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger">ACEPTAR</button>

    </div>
</div>
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

<script type="text/javascript">

    $(document).ready(function() {
        $('#idEntidad_s').change(function() {
            var idEntidad_i = $(this).val();
            var dataString = 'idEntidad_i=' + idEntidad_i;
            var url = "<?php echo site_url('') ?>solicitudesWebService/getMunicipios";
            $.ajax({
                type: "GET",
                url: url,
                data: dataString,
                success: function(data) {
                    //alert(data);
                    $("#dividMunicipio_s").html(data);
                    return false;
                }

            });

            return false;
        });

    });

    $(document).ready(function() {
        $('#idIntemediario').change(function() {
            var idEntidad_i = $(this).val();
            if(idEntidad_i==='-1'){

                $("#otro_inter").css("display", "block");
                $("#tipoSnc").val(0);
                $('#valortipoSnc').prop('checked', false);
                $("#mensajeError").html('Si el "INTERMEDIARIO FINANCIERO" es "OTRO" se desactivara la sincronización con GYS. ');
                $("#btnmodal").click();
                

            }else{
                $("#otro_inter").css("display", "none");
            }
            

            return false;
        });

//funcion quitar disbled
$( '#valorCheck' ).on( 'click', function() {
    if( $(this).is(':checked') ){
        // Hacer algo si el checkbox ha sido seleccionado
        $(".inmuebleclass").prop("disabled", true);       
        $('#mismoSolicitante').val(1);
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        $(".inmuebleclass").prop("disabled", false);
        $('#mismoSolicitante').val(0);
    }
});


$( '#valortipoSnc' ).on( 'click', function() {
    if( $(this).is(':checked') ){ 
        var va=$("#idIntemediario").val();
        if(va!=-1){ 
            $('#tipoSnc').val(1);
        }else{
            $("#mensajeError").html('El "INTERMEDIARIO FINANCIERO" debe ser diferente a "OTRO" ');
            $('#valortipoSnc').prop('checked', false);
            $("#btnmodal").click();
        }
    } else {
        $('#tipoSnc').val(0);
    }
});


});
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $('#idEntidad_i').change(function() {
            var idEntidad_i = $(this).val();
            var dataString = 'idEntidad_i=' + idEntidad_i;
            
            var url = "<?php echo site_url('') ?>solicitudesWebService/getMunicipios";
            $.ajax({
                type: "GET",
                url: url,
                data: dataString,
                success: function(data) {
                    $("#divid_muni_i").html(data);
                    return false;
                }

            });

            return false;
        });



    });


</script>
<script type="text/javascript">
    $(function() {
        $('.monedaxn').keyup(function(e) {
            var e = window.event || e;
            var keyUnicode = e.charCode || e.keyCode;
            if (e !== undefined) {
                switch (keyUnicode) {
                        case 16: break; // Shift
                        case 27: this.value = ''; break; // Esc: clear entry
                        case 35: break; // End
                        case 36: break; // Home
                        case 37: break; // cursor left
                        case 38: break; // cursor up
                        case 39: break; // cursor right
                        case 40: break; // cursor down
                        case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
                        case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
                        case 190: break; // .
                        default: $(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
                    }
                }
            });





    });     
    $(document).ready(function() {
        $('.monedaxn').formatCurrency();
                   // $('#formatWhileTypingAndWarnOnDecimalsEntered').formatCurrency('.currencyLabel')
               });   
           </script>

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