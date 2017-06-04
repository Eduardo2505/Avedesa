<!DOCTYPE html>

<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <?php $this->load->view('plantilla/head') ?>
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
                                        <a href="javascript:history.back(1)">ATRAS</a>
                                        <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('') ?>solicitudes">NUEVA BUSQUEDA</a>
                                        <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('') ?>solicitudes/registro">NUEVO REGISTRO</a>
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

                                    <?php if ($msn == 1) { ?>
                                    <div class="block">
                                        <div class="alert alert-success">
                                            <h1> <b>Editar!</b> Se actualizo correctamente!</h1> 
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                        </div>
                                    </div>
                                    <?php } else if ($msn == 0) { ?>    

                                    <div class="block">

                                        <div class="alert alert-danger">
                                            <h1> <b>Error!</b> Compruebe los datos</h1>
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                        </div>

                                    </div>
                                    <?php }else if ($msn == 2) {?>

                                 

                                    <div class="block">

                                        <div class="alert alert-warning">
                                            <h1> <b>OJO!</b> No se creo una nueva Inspeción </h1>
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                        </div>

                                    </div>
                                    <?php } ?>


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

                                    <div class="tabbable-line boxless tabbable-reversed">

                                        <div class="tab-content">


                                            <div class="tab-pane active" id="tab_1">
                                                <div class="portlet box blue">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-gift"></i>DETALLES

                                                        </div>
                                                        <div class="tools">


                                                            <span  > FOLIO : <?php echo str_pad($row->idregistro, 5, "0", STR_PAD_LEFT); ?>

                                                                // FECHA DE REGISTRO <?php echo $row->registro_inicial; ?>

                                                                // ÚLTIMA ACTUALIZACIÓN <?php echo $row->registro; ?>
                                                            </span>

                                                        </div>
                                                    </div>
                                                    <div class="portlet-body form">
                                                        <!-- BEGIN FORM-->
                                                        <form action="<?php echo site_url('') ?>solicitudes/actualizar" method="POST"  class="horizontal-form">
                                                            <input type="hidden" name="idregistro" value="<?php echo $row->idregistro ?>">
                                                             <input type="hidden" name="fecha_final_aux" value="<?php echo $row->fecha_final ?>">
                                                            <div class="form-body">

                                                                <div class="row">

                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Nombre de referencia:</label>
                                                                            <input type="text" class="form-control" name="nomRefer" value="<?php echo $row->referencia ?>" placeholder="Nombre de referencia" required=""/>




                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Num. Expediente:</label>
                                                                            <input type="text" readonly="readonly" class="form-control" value="<?php echo $row->num_expediente ?>" name="numExpediente" placeholder="Nombre de Expediente" />
                                                                            <input type="hidden" name="fecha_de_inspeccion_aux" value="<?php echo $row->fecha_de_inspeccion ?>">





                                                                        </div>
                                                                    </div>


                                                                    <!--/span-->



                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Num. Avalúo:</label>
                                                                            <input type="text"  class="form-control" maxlength="45"  value="<?php echo $row->num_avaluo ?>"  name="numavaluo" placeholder="Num. Avalúo" />



                                                                        </div>
                                                                    </div>

                                                                    <!--/span-->
                                                                </div>
                                                                <!--/row-->
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Teléfono:</label>
                                                                            <input type="tel" name="telefono"  value="<?php echo $row->telefono ?>" maxlength="45"  class="form-control" placeholder="Teléfono"/>





                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Email:</label>
                                                                            <input type="email" name="email" value="<?php echo $row->email ?>"  maxlength="45"  class="form-control" placeholder="Correo Electrónico"/>



                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Tipo Avaluo: *</label>
                                                                            <select class="form-control" required="" name="idtipo_avaluo">
                                                                                <option value="">Seleccione</option>

                                                                                <?php
                                                                                if (isset($tipo_avaluo)) {
                                                                                    foreach ($tipo_avaluo->result() as $rowx) {

                                                                                        if ($row->idtipo_avaluo == $rowx->idtipo_avaluo) {
                                                                                            ?>

                                                                                            <option value="<?php echo $rowx->idtipo_avaluo; ?>" selected="selected"><?php echo $rowx->nombre; ?></option>

                                                                                            <?php
                                                                                        } else {
                                                                                            ?>

                                                                                            <option value="<?php echo $rowx->idtipo_avaluo; ?>"><?php echo $rowx->nombre; ?></option>

                                                                                            <?php
                                                                                        }
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
                                                                            <select class="form-control" name="objetivoAvaluo">
                                                                                <option value="">Seleccione</option>

                                                                                <?php
                                                                                if (isset($objetivo_avaluo)) {
                                                                                    foreach ($objetivo_avaluo->result() as $rowx) {

                                                                                        if ($row->idobjetivo_avaluo == $rowx->idobjetivo_avaluo) {
                                                                                            ?>
                                                                                            <option value="<?php echo $rowx->idobjetivo_avaluo; ?>" selected="selected"><?php echo $rowx->nombre; ?></option>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <option value="<?php echo $rowx->idobjetivo_avaluo; ?>"><?php echo $rowx->nombre; ?></option>
                                                                                            <?php
                                                                                        }
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
                                                                            <input type="text" maxlength="120" name="otros" value="<?php echo $row->otros ?>"  class="form-control" placeholder="Otros"/>


                                                                        </div>
                                                                    </div>
                                                                    <!--/span-->
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label>Costo:</label>
                                                                            <input onkeyup="format(this)" onchange="format(this)" value="<?php echo number_format($row->costo, 0, ",", "."); ?>" maxlength="10" name="costo" class="form-control"  value="0"/>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!--/row-->

                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>Ubicación:</label>
                                                                            <textarea class="form-control" maxlength="445" name="ubicacion" > <?php echo $row->ubicacion ?> </textarea>


                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <h3 class="form-section">Avalúo</h3>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Inspector:</label>   
                                                                            <input type="hidden" value="<?php echo $row->idempleado; ?>" name="idempleado_aux">                                                                         
                                                                            <select class="form-control"  name="idempleado" >

                                                                                <option value="0">Seleccione</option>

                                                                                <?php
                                                                                if (isset($empleados)) {
                                                                                    foreach ($empleados->result() as $rowx) {

                                                                                        if ($row->idempleado == $rowx->idempleado) {
                                                                                            ?>

                                                                                            <option value="<?php echo $rowx->idempleado; ?>" selected="selected"><?php echo $rowx->Nombre; ?> <?php echo $rowx->apellidos; ?></option>



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

                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label>Monto crédito:</label>
                                                                            <input onkeyup="format(this)" onchange="format(this)" value="<?php echo number_format($row->monto_credito, 0, ",", "."); ?>" maxlength="10" name="monto_credito" class="form-control" />


                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label>Monto venta:</label>
                                                                            <input onkeyup="format(this)" onchange="format(this)" name="monto_venta" maxlength="10" class="form-control"  value="<?php echo number_format($row->monto_venta, 0, ",", "."); ?>"/>  

                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Pago Adelantado:</label>
                                                                            <input onkeyup="format(this)" onchange="format(this)" value="<?php echo number_format($row->adelanto_pago, 0, ",", "."); ?>" name="adelanto_pago" maxlength="10" class="form-control" />  

                                                                        </div>
                                                                    </div> -->
                                                                </div>
                                                                <!--/row-->
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Intermediario: </label>
                                                                            <input type="text" maxlength="100" value="<?php echo $row->nomIntermediria; ?>" class="form-control" name="intermediario" placeholder="Intermediario" />




                                                                        </div>
                                                                    </div>
                                                                    <!--/span-->
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Capturista:</label>
                                                                            <input type="text" disabled=""  class="form-control" value="<?php echo $row->capturista; ?>" />






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

                                                                                        if ($rowx->idempleado == $row->id_asigno) {
                                                                                            ?>

                                                                                            <option value="<?php echo $rowx->idempleado; ?>"  selected="selected"><?php echo $rowx->Nombre; ?> <?php echo $rowx->apellidos; ?></option>


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
                                                                    <!--/span-->
                                                                </div>


                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Observaciones:</label>
                                                                            <textarea class="form-control" name="observaciones"> <?php echo $row->observaciones; ?></textarea>
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
                                                                    <div class="col-md-4">

                                                                    </div>
                                                                    <!--/span-->


                                                                </div>

                                                                <div class="row">

                                                                    <!--/span-->
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label>Inspección:</label>
                                                                            <input type="hidden" name="fecha_de_inspeccion_aux" value="<?php echo $row->fecha_de_inspeccion ?>">

                                                                            
                                                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd"  >
                                                                                <input type="text" class="form-control" name="fecha_de_inspeccion"
                                                                                value="<?php echo $row->fecha_de_inspeccion ?>" >
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                                </span>
                                                                            </div>
                                                                            
                                                                            <?php  if(!empty($arryCount["registro_2"])) {echo '<span style="color:blue">* '.$arryCount["registro_2"].'</span>'; }else{echo "PENDIENTE";}?><br>

                                                                            <?php  if(!empty($arryCount["nombre_2"])) {echo '<span style="color:blue">* '.$arryCount["nombre_2"].'</span>'; }?><br>




                                                                                


                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label>Hora de inspección :</label>


                                                                                <input type="text" name="hora_de_inspeccion" value="<?php echo $row->hora_de_inspeccion ?>" class="form-control timepicker timepicker-24">




                                                                            </div>
                                                                        </div>




                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label>Entrega de visita:</label>

                                                                                
                                                                                    <input type="text" class="form-control" name="fecha_de_entrega" value=" <?php  if(!empty($arryCount["registro_3"])) {echo $arryCount["registro_3"]; }?>" disabled="" />
                                                                         
                                                                           

                                                                            <?php  if(!empty($arryCount["nombre_3"])) {echo '<span style="color:blue">* '.$arryCount["nombre_3"].'</span>'; }else{echo "PENDIENTE";}?><br>
                                                                                <label style="color:red"><?php echo $row->fecha_de_entrega; ?></label>
                                                                                <input type="hidden" name="fecha_de_entrega_aux"
                                                                                value="<?php echo $row->fecha_de_entrega; ?>"/>






                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label>Quien recibe:</label>
                                                                                <input type="text" maxlength="100"  value="<?php echo $row->usuario_entrega; ?>"  class="form-control" name="usuario_entrega"/>


                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label>Asiganción:</label>

                                                                                <div class="input-group input-medium "  >
                                                                                    <input type="text" class="form-control" name="fecha_asigancion" value=" <?php  if(!empty($arryCount["registro_4"])) {echo $arryCount["registro_4"]; }?>" disabled="">
                                                                                <!-- <span class="input-group-btn">
                                                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                                </span>  -->
                                                                            </div>
                                                                            <?php  if(!empty($arryCount["nombre_4"])) {echo '<span style="color:blue">* '.$arryCount["nombre_4"].'</span>'; }else{echo "PENDIENTE";}?><br>


                                                                              <label style="color:red"><?php echo $row->fecha_asigancion; ?></label>

                                                                               <input type="hidden" name="fecha_asigancion_aux"
                                                                                value="<?php echo $row->fecha_asigancion; ?>">


                                                                          </div>
                                                                      </div>

                                                                  </div>
                                                                  <div class="row">





                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Captura:</label>

                                                                            <div class="input-group input-medium "  >
                                                                                <input type="text" class="form-control" name="fecha_captura" value=" <?php  if(!empty($arryCount["registro_5"])) {echo $arryCount["registro_5"]; }?>" disabled="">
                                                                              
                                                                            </div>
                                                                            <?php  if(!empty($arryCount["nombre_5"])) {echo '<span style="color:blue">* '.$arryCount["nombre_5"].'</span>'; } else{echo "PENDIENTE";}?><br>


                                                                                <label style="color:red"><?php echo $row->fecha_captura; ?></label>

                                                                                <input type="hidden" name="fecha_captura_aux"
                                                                                value="<?php echo $row->fecha_captura; ?>">
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Cierre:</label>

                                                                                <div class="input-group input-medium "  >
                                                                                    <input type="text" class="form-control" name="fecha_cierre" value=" <?php  if(!empty($arryCount["registro_6"])) {echo $arryCount["registro_6"]; }?>" disabled="">
                                                                                <!-- <span class="input-group-btn">
                                                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                                </span>  -->
                                                                            </div>
                                                                            <?php  if(!empty($arryCount["nombre_6"])) {echo '<span style="color:blue">* '.$arryCount["nombre_6"].'</span>'; }else{echo "PENDIENTE";}?><br>


                                                                               <label style="color:red"><?php echo $row->fecha_cierre; ?></label>
                                                                               <input type="hidden" name="fecha_cierre_aux"
                                                                                value="<?php echo $row->fecha_cierre; ?>">
                                                                           </div>

                                                                       </div>

                                                                   </div>
                                                                   <div class="form-actions right">

                                                                    <a href="javascript:history.back(1)"   class="btn default">REGRESAR</a>

                                                                    <button type="submit" class="btn blue"><i class="fa fa-check"></i> GUARDAR</button>

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