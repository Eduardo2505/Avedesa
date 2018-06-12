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
                                <a href="#">NUEVA BUSQUEDA</a>
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

                             <div class="tabbable-line boxless tabbable-reversed">

                                <div class="tab-content">


                                    <div class="tab-pane active" id="tab_1">
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>BUSQUEDA
                                                </div>
                                                <div class="tools">


                                                    <a href="javascript:;" class="reload">
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="<?php echo site_url('') ?>solicitudesConsulta/buscarS" class="horizontal-form">
                                                    <div class="form-body">

                                                        <div class="row">


                                                          <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>ID:</label>
                                                                <input onkeypress="return soloNumeros(event, this)" placeholder="Folio" maxlength="15" name="id" class="form-control" />

                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">FOLIO</label>
                                                                <input type="text" class="form-control" name="numExpediente" placeholder="Nombre de Expediente" />

                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Num. Avalúo:</label>
                                                                <input type="text" onkeyup="mayus(this);" class="form-control" maxlength="45"  name="folio_cliente" placeholder="Num. Avalúo" />

                                                            </div>
                                                        </div>      

                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Costo:</label>
                                                                <input onkeypress="return soloNumeros(event, this)" maxlength="16" name="costo" class="form-control monedaxn"  value="0"/>


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

                                                                    foreach ($asigno->result() as $rowx) {


                                                                        ?>

                                                                        <option value="<?php echo $rowx->idempleado; ?>"><?php echo $rowx->Nombre; ?> <?php echo $rowx->apellidos; ?></option>

                                                                        <?php
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
                                                                <label class="control-label">Tipo Avaluo : </label>
                                                                <select class="form-control"  name="idtipo_avaluo"  >
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

                                                        <div class="col-md-4" id="otro_inter" style="display: none">
                                                            <div class="form-group">
                                                                <label>Otro Intermediario: </label>
                                                                <input onkeyup="mayus(this);" type="text" maxlength="100" class="form-control" name="otro_intermediario" placeholder="Otro Intermediario" />

                                                            </div>
                                                        </div>

                                                        <!--/span-->

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Otros:</label>
                                                                <input type="text" onkeyup="mayus(this);" name="otros" maxlength="150"  class="form-control" placeholder="Otros"/>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"> Sincronizacion GYS </label>
                                                                <select class="form-control"   name="tipoSnc" >
                                                                    <option value="-1">Seleccione</option>
                                                                    <option value="1">STC</option>
                                                                    <option value="0">AVE</option>
                                                                </select>


                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--/row-->


                                                    <h3 class="form-section">Visita</h3>


                                                    <div class="row">




                                                      <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label">Nombre de referencia  : </label>
                                                            <input type="text" onkeyup="mayus(this);" class="form-control" name="nomRefer"   placeholder="Nombre de referencia" />


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

                                                   <!--  <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Hora de inspección :</label>


                                                            <input type="text" name="hora_de_inspeccion" class="form-control timepicker timepicker-24" >




                                                        </div>
                                                    </div> -->

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
                                                            <label class="control-label">Teléfono :</label>
                                                            <input type="text"     onKeyPress="return soloNumeros(event)" name="telefono_v" maxlength="18"   class="form-control" placeholder="Teléfono"/>


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
                                                        <label class="control-label">Nombre :</label>
                                                        <input type="text"   onkeyup="mayus(this);" name="nombre_s" maxlength="45"   class="form-control" placeholder="Nombre"/>


                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Primer Apellido :</label>
                                                        <input type="text"    onkeyup="mayus(this);" name="p_apellido_s" maxlength="45"   class="form-control" placeholder="Primer Apellidos"/>


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
                                                        <label class="control-label">Tipo Persona : </label>
                                                        <select class="form-control"  name="tipo_persona_s"  >
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
                                                        <label class="control-label">Colonia  :</label>
                                                        <input type="text"    onkeyup="mayus(this);" name="col_s" maxlength="45"   class="form-control" placeholder="Colonia"/>


                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Entidad : </label>
                                                        <select class="form-control"  id="idEntidad_s" name="idEntidad_s"  >
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
                                                        <label class="control-label">Municipio : </label>

                                                        <select class="form-control" id="dividMunicipio_s"  name="id_muni_s"  >
                                                            <option value="">Seleccione</option>



                                                        </select>



                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Calle :</label>
                                                        <input type="text"    onkeyup="mayus(this);" name="calle_s" maxlength="45"   class="form-control" placeholder="Calle "/>


                                                    </div>
                                                </div>



                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Num. Ext :</label>
                                                        <input type="text" onkeyup="mayus(this);"   name="num_ext_s" maxlength="45"   class="form-control" placeholder="Num. Ext:"/>


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


                                              <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Tipo Inmueble  :</label>
                                                    <select class="form-control"   name="idtipo_avaluo_i"  >
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
                                                    <input type="text"   onKeyPress="return soloNumeros(event)" name="cp_i" maxlength="6"   class="form-control inmuebleclass" placeholder="C:P"/>


                                                </div>
                                            </div>



                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Entidad: </label>
                                                    <select class="form-control inmuebleclass"   id="idEntidad_i" name="idEntidad_i"  >
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

                                                    <select class="form-control inmuebleclass"  id="divid_muni_i"  name="id_muni_i"  >
                                                        <option value="-1">Seleccione</option>

                                                    </select>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Colonia:</label>
                                                    <input type="text"  onkeyup="mayus(this);" name="col_i" maxlength="100"   class="form-control inmuebleclass" placeholder="Colonia"/>


                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Calle:</label>
                                                    <input type="text"onkeyup="mayus(this);" name="calle_i" maxlength="150"   class="form-control inmuebleclass" placeholder="Calle"/>


                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Num. Int:</label>
                                                    <input type="text"onkeyup="mayus(this);" name="num_int_i" maxlength="45"   class="form-control inmuebleclass" placeholder="Num. Int"/>


                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Num. Ext:</label>
                                                    <input type="text"onkeyup="mayus(this);" name="num_ex_i" maxlength="45"   class="form-control inmuebleclass" placeholder="Num. Ext"/>


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
                                                    <input type="text"  onkeyup="mayus(this);" name="vlt_i" maxlength="45"   class="form-control" placeholder="Lt"/>


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



                                        </div>


                                        <h3 class="form-section">Busqueda Avanzada</h3>

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

                                        <button type="submit" class="btn blue"><i class="fa fa-check"></i> Buscar</button>
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
        $('#tipoSnc').val(1);
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