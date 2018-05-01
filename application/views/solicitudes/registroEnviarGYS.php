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





                        <div class="col-md-12">

                            <div class="col-md-12">






                              <div class="tabbable-line boxless tabbable-reversed">

                                <div class="tab-content">

                                    <?php 

                                    $colo="blue";

                                    if($obj_registro->folio!=null) {
                                    $colo="red";
                                }
                                
                                ?> 


                                <div class="tab-pane active" id="tab_1">
                                    <div class="portlet box <?php echo $colo; ?>">
                                        <div class="portlet-title">
                                            <div class="caption">
                                              <?php if($obj_registro->folio==null) {
                                              ?>
                                              <i class="fa fa-gift"></i>ENVIAR A GYS
                                              <?php

                                          }else{?>
                                          <i class="fa fa-gift"></i>YA ENCUENTRA REGISTRADO EN GYS TIENE EL FOLIO : <?php echo $obj_registro->folio?>

                                          <?php } ?>                                                  
                                      </div>
                                      <div class="tools">


                                        <a href="javascript:;" class="reload">
                                        </a>

                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="<?php echo site_url('') ?>solicitudesWebService/editarCaptura" method="POST"  class="horizontal-form">
                                        <input type="hidden" value="<?php echo $idregistro;?>" name="idregistro">
                                        <input type="hidden" value="1" name="gys">
                                        <div class="form-body">

                                            <div class="row">




                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Num. Avalúo:</label>
                                                        <input type="text" value="<?php echo $obj_registro->num_avaluo ?>" onkeyup="mayus(this);" class="form-control" maxlength="45"  name="folio_cliente" placeholder="Num. Avalúo" />


                                                    </div>
                                                </div>


                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>Costo:</label>
                                                        <input value="<?php echo $obj_registro->costo ?>" onkeypress="return soloNumeros(event, this)" maxlength="15" name="costo" class="form-control"  value="0"/>


                                                    </div>
                                                </div>



                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Otros:</label>
                                                        <input type="text" value="<?php echo $obj_registro->otros ?>" onkeyup="mayus(this);" name="otros" maxlength="150"  class="form-control" placeholder="Otros"/>

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Num. Expediente:</label>
                                                        <input type="text" readonly="readonly" class="form-control" value="<?php echo $obj_registro->num_expediente ?>" name="numExpediente" placeholder="Nombre de Expediente" />
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">


                                               <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Operador <span style="color:red;font-weight: bold;"> * </span> :</label>
                                                    <select class="form-control" name="idOperador" required="" >

                                                        <option value="">Seleccione</option>

                                                        <?php
                                                        if (isset($asigno)) {
                                                        foreach ($asigno->result() as $rowx) {

                                                        if ($obj_registro->idOperador == $rowx->idempleado) {
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
                                    <label>Inspector <span style="color:red;font-weight: bold;"> * </span> :</label>
                                    <select class="form-control" name="idInsepctor" required="" >

                                        <option value="">Seleccione</option>

                                        <?php
                                        if (isset($empleados)) {
                                        foreach ($empleados->result() as $rowx) {


                                        if ($obj_registro->idempleado == $rowx->idempleado) {
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
                    <label>Ejecutivo (Asigno) <span style="color:red;font-weight: bold;"> * </span> :</label>
                    <select class="form-control" name="idEjecutivo" required="">

                        <option value="">Seleccione</option>

                        <?php
                        if (isset($asigno)) {
                        foreach ($asigno->result() as $rowx) {


                        if ($obj_registro->id_asigno == $rowx->idempleado) {
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
        <label class="control-label">Objeto de Avalúo <span style="color:red;font-weight: bold;"> * </span>:</label>
        <select class="form-control"  name="objetivoAvaluo" required="">
            <option value="">Seleccione</option>

            <?php
            if (isset($objetivo_avaluo)) {
            foreach ($objetivo_avaluo->result() as $rowx) {



            if ($obj_registro->idobjetivo_avaluo == $rowx->idobjetivo_avaluo) {
            ?>



            <option selected="selected" value="<?php echo $rowx->idobjetivo_avaluo; ?>"><?php echo $rowx->nombre; ?></option>

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


<div class="col-md-6">
    <div class="form-group">
        <label class="control-label">Tipo Avaluo <span style="color:red;font-weight: bold;"> * </span>: </label>
        <select class="form-control"  name="idtipo_avaluo" required="">
            <option value="">Seleccione</option>

            <?php
            if (isset($tipo_avaluo)) {
            foreach ($tipo_avaluo->result() as $rowx) {


            if ($obj_registro->idtipo_avaluo == $rowx->idtipo_avaluo) {
            ?>




            <option selected="selected" value="<?php echo $rowx->idtipo_avaluo; ?>"><?php echo $rowx->nombre; ?></option>
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


<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Reportar Tesoreria <span style="color:red;font-weight: bold;"> * </span>: </label>
        <select class="form-control"  name="reporteTesoreria" required="" >
            <option value="">Seleccione</option>


            <?php
            if ($obj_registro->reporteTesoreria == 1) {
            ?>

            <option value="1" selected="selected">Si</option>
            <option value="0">NO</option>

            <?php
        }else if($obj_registro->reporteTesoreria == 0){
        ?>

        <option value="1" >Si</option>
        <option value="0" selected="selected">NO</option>

        <?php


    } else {
    ?>
    <option value="1">Si</option>
    <option value="0">NO</option>


    <?php
}

?>


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



            if ($obj_registro->clave == $rowx->clave) {
            ?>



            <option selected="selected" value="<?php echo $rowx->clave; ?>"><?php echo $rowx->descripcion; ?></option>

            <?php
        } else {
        ?>
        <option value="<?php echo $rowx->clave; ?>"><?php echo $rowx->descripcion; ?></option>



        <?php
    }







}
}
?>


</select>


</div>
</div>


<?php
$style="";
$valor="";
if ($obj_registro->clave!=-1) {
$style="display: none";
}else{
$valor=$obj_registro->intermediario;

}
?>

<div class="col-md-4" id="otro_inter" style="<?php echo $style?>">
    <div class="form-group">
        <label>Otro Intermediario: </label>
        <input value="<?php echo $valor; ?>" onkeyup="mayus(this);" type="text" maxlength="100" class="form-control" name="otro_intermediario" placeholder="Otro Intermediario" />

    </div>
</div>

<!--/span-->
</div>
<!--/row-->


<h3 class="form-section">Visita</h3>


<div class="row">




  <div class="col-md-5">
    <div class="form-group">
        <label class="control-label">Nombre de referencia <span style="color:red;font-weight: bold;"> * </span> : </label>
        <input value="<?php echo $obj_registro->referencia ?>" type="text" onkeyup="mayus(this);" class="form-control" name="nomRefer" required="" placeholder="Nombre de referencia" />


    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label>Fecha Visita <span style="color:red;font-weight: bold;"> * </span> :</label>
        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
            <input type="text" value="<?php echo $obj_registro->fecha_de_inspeccion ?>" class="form-control" name="fecha_visita" readonly="" required="" >
            <span class="input-group-btn">
                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
            </span>
        </div>

    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label>Hora de inspección <span style="color:red;font-weight: bold;"> * </span> :</label>


        <input type="text" required="" value="<?php echo $obj_registro->hora_de_inspeccion ?>" name="hora_de_inspeccion" class="form-control timepicker timepicker-24" value="N/A">




    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Visita Exitosa <span style="color:red;font-weight: bold;"> * </span> : </label>
        <select class="form-control"  name="visita_exitosa"  required="">
            <option value="-1">Seleccione</option>

            <?php
            if ($obj_vista->VisitaExitosa == 1) {
            ?>

            <option value="1" selected="selected">Si</option>
            <option value="0">NO</option>

            <?php
        }else if($obj_vista->reporteTesoreria == 0){
        ?>

        <option value="1">Si</option>
        <option value="0" selected="selected" >NO</option>

        <?php


    } else {
    ?>
    <option value="1">Si</option>
    <option value="0">NO</option>


    <?php
}

?>


</select>


</div>
</div>





<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Teléfono <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text" value="<?php echo $obj_registro->telefono ?>" required=""  onKeyPress="return soloNumeros(event)" name="telefono_v" maxlength="18"   class="form-control" placeholder="Teléfono"/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Email:</label>
        <input type="email" value="<?php echo $obj_registro->email ?>" name="email_v"  maxlength="45"  class="form-control" placeholder="Correo Electrónico"/>


    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label>Monto crédito:</label>
        <input value="<?php echo $obj_registro->monto_credito ?>"  onkeyup="format(this)" onchange="format(this)" maxlength="10" name="monto_credito" class="form-control"  value="0"/>

    </div>
</div>
<div class="col-md-2">
    <div class="form-group">
        <label>Monto venta:</label>
        <input value="<?php echo $obj_registro->monto_venta ?>"  onkeyup="format(this)" onchange="format(this)" name="monto_venta" maxlength="10" class="form-control"  value="0"/>                                         

    </div>
</div>





</div>
<div class="row">


    <div class="col-md-4">
        <div class="form-group">
            <label>Observaciones:</label>
            <textarea  onkeyup="mayus(this);" class="form-control" maxlength="445" name="observaciones"><?php echo $obj_registro->observaciones; ?></textarea>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label>Quien recibe:</label>
            <input value="<?php echo $obj_registro->usuario_entrega ?>" type="text" onkeyup="mayus(this);" maxlength="100" class="form-control" name="usuario_entrega"/>

        </div>
    </div>
</div>

<h3 class="form-section">Solicitante</h3>

<div class="row">

   <div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Nombre <span style="color:red;font-weight: bold;"> * </span>:</label>
        <input type="text" value="<?php echo $obj_solicitante->Nombre ?>" required="" onkeyup="mayus(this);" name="nombre_s" maxlength="45"   class="form-control" placeholder="Nombre"/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Primer Apellido <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text" value="<?php echo $obj_solicitante->ApellidoPaterno ?>" required=""  onkeyup="mayus(this);" name="p_apellido_s" maxlength="45"   class="form-control" placeholder="Primer Apellidos"/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Segundo Apellido:</label>
        <input type="text" value="<?php echo $obj_solicitante->ApellidoMaterno ?>"  onkeyup="mayus(this);" name="s_apellido_s" maxlength="45"   class="form-control" placeholder="Segundo Apellido"/>


    </div>
</div>


<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Tipo Persona <span style="color:red;font-weight: bold;"> * </span>: </label>
        <select class="form-control"  name="tipo_persona_s" required="">
            <option value="">Seleccione</option>

            <?php
            if ($obj_solicitante->PersonaMoral === 'Moral') {
            ?>

            <option value="Moral" selected="selected">Moral</option>
            <option value="Física">Fisica</option>

            <?php
        }else if($obj_solicitante->PersonaMoral === 'Física'){
        ?>

        <option value="Moral">Moral</option>
        <option value="Física" selected="selected">Fisica</option>

        <?php


    } else {
    ?>
    <option value="Moral">Moral</option>
    <option value="Física">Fisica</option>


    <?php
}

?>


</select>


</div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">RFC:</label>
        <input type="text" value="<?php echo $obj_solicitante->Rfc ?>" onkeyup="mayus(this);" name="rfc_s" maxlength="45"   class="form-control" placeholder="RFC"/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Nss:</label>
        <input type="text" value="<?php echo $obj_solicitante->Nss ?>" onkeyup="mayus(this);" name="nss_s" maxlength="45"   class="form-control" placeholder="Num. Seguro Social"/>


    </div>
</div>


<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">C.P. <span style="color:red;font-weight: bold;"> * </span>:</label>
        <input type="text" required="" value="<?php echo $obj_solicitante->CodigoPostal ?>"    onKeyPress="return soloNumeros(event)" name="cp_s" maxlength="6"   class="form-control" placeholder="C.P."/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Colonia <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text" required="" value="<?php echo $obj_solicitante->Colonia ?>"  required=""  onkeyup="mayus(this);" name="col_s" maxlength="45"   class="form-control" placeholder="Colonia"/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Entidad <span style="color:red;font-weight: bold;"> * </span>: </label>
        <select class="form-control"  id="idEntidad_s" name="idEntidad_s" required="">
            <option value="-1">Seleccione</option>

            <?php
            if (isset($entidades)) {
            foreach ($entidades->result() as $rowx) {


            if ($obj_solicitante->ClaveEntidad == $rowx->idEntidad) {
            ?>


            <option selected="selected"  value="<?php echo $rowx->idEntidad; ?>"><?php echo $rowx->entidad; ?></option>


            <?php
        } else {
        ?>
        <option value="<?php echo $rowx->idEntidad; ?>"><?php echo $rowx->entidad; ?></option>



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
        <label class="control-label">Municipio <span style="color:red;font-weight: bold;"> * </span>: </label>

        <select class="form-control" id="dividMunicipio_s"  name="id_muni_s" required="">
            <option value="">Seleccione</option>
            <?php
            if (isset($municipios)) {
            foreach ($municipios->result() as $rowx) {


            if ($obj_solicitante->ClaveMunicipio == $rowx->idMunicipio) {
            ?>


            <option selected="selected"  value="<?php echo $rowx->idMunicipio; ?>"><?php echo $rowx->municipio; ?></option>


            <?php
        } else {
        ?>
        <option value="<?php echo $rowx->idMunicipio; ?>"><?php echo $rowx->municipio; ?></option>



        <?php
    }





}
}
?>


</select>



</div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="control-label">Calle <span style="color:red;font-weight: bold;"> * </span>:</label>
        <input type="text" value="<?php echo $obj_solicitante->Calle ?>" required=""  onkeyup="mayus(this);" name="calle_s" maxlength="45"   class="form-control" placeholder="Calle "/>


    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Num. Int <span style="color:red;font-weight: bold;"> * </span>:</label>
        <input type="text" value="<?php echo $obj_solicitante->NumeroInterior ?>" required=""  onkeyup="mayus(this);" name="num_int_s" maxlength="45"   class="form-control" placeholder="Num. Int"/>


    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Num. Ext:</label>
        <input type="text"  value="<?php echo $obj_solicitante->NumeroExterior ?>" onkeyup="mayus(this);" name="num_ext_s" maxlength="45"   class="form-control" placeholder="Num. Ext:"/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Teléfono:</label>
        <input type="text"  value="<?php echo $obj_solicitante->Telefono ?>" onKeyPress="return soloNumeros(event)" name="telefono_s" maxlength="18"   class="form-control" placeholder="Teléfono"/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Email:</label>
        <input type="text" value="<?php echo $obj_solicitante->CorreoElectronico ?>" name="email_s" maxlength="45"   class="form-control" placeholder="Email"/>


    </div>
</div>


</div>


<h3 class="form-section">Inmueble</h3>

<div class="row">

  <div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Tipo Inmueble <span style="color:red;font-weight: bold;"> * </span> :</label>
        <select class="form-control"  name="idtipo_avaluo_i" required="">
            <option value="">Seleccione</option>

            <?php
            if (isset($tipoInmueble)) {
            foreach ($tipoInmueble->result() as $rowx) {



            if ($obj_inmueble->idtipoInmueble == $rowx->idtipoInmueble) {
            ?>

            <option selected="selected" value="<?php echo $rowx->idtipoInmueble; ?>"><?php echo $rowx->tipo; ?></option>


            <?php
        } else {
        ?>
        <option value="<?php echo $rowx->idtipoInmueble; ?>"><?php echo $rowx->tipo; ?></option>



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
        <label class="control-label">C.P <span style="color:red;font-weight: bold;"> * </span>:</label>
        <input type="text"  required="" value="<?php echo $obj_inmueble->CodigoPostal ?>" onKeyPress="return soloNumeros(event)" name="cp_i" maxlength="6"   class="form-control" placeholder="C:P"/>


    </div>
</div>



<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Entidad <span style="color:red;font-weight: bold;"> * </span> : </label>
        <select class="form-control"  id="idEntidad_i" name="idEntidad_i" required="">
            <option value="-1">Seleccione</option>

            <?php
            if (isset($entidades)) {
            foreach ($entidades->result() as $rowx) {


            if ($obj_inmueble->ClaveEntidad == $rowx->idEntidad) {                                        ?>


            <option selected="selected" value="<?php echo $rowx->idEntidad; ?>"><?php echo $rowx->entidad; ?></option>



            <?php
        } else {
        ?>
        <option value="<?php echo $rowx->idEntidad; ?>"><?php echo $rowx->entidad; ?></option>




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
        <label class="control-label">Municipio <span style="color:red;font-weight: bold;"> * </span> : </label>

        <select class="form-control" id="divid_muni_i"  name="id_muni_i" required="">
            <option value="-1">Seleccione</option>

            <?php
            if (isset($municipios_i)) {
            foreach ($municipios_i->result() as $rowx) {


            if ($obj_inmueble->ClaveMunicipio == $rowx->idMunicipio) {
            ?>


            <option selected="selected"  value="<?php echo $rowx->idMunicipio; ?>"><?php echo $rowx->municipio; ?></option>


            <?php
        } else {
        ?>
        <option value="<?php echo $rowx->idMunicipio; ?>"><?php echo $rowx->municipio; ?></option>



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
        <label class="control-label">Colonia <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text" value="<?php echo $obj_inmueble->Colonia ?>" onkeyup="mayus(this);" name="col_i" maxlength="100"   class="form-control" placeholder="Colonia" required=""/>


    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Calle <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text" value="<?php echo $obj_inmueble->Calle ?>" onkeyup="mayus(this);" name="calle_i" maxlength="150"   class="form-control" placeholder="Calle" required="" />


    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Num. Int <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text"  value="<?php echo $obj_inmueble->NumeroInterior ?>"  onkeyup="mayus(this);" name="num_int_i" maxlength="45"   class="form-control" placeholder="Num. Int" required="" />


    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Num. Ext:</label>
        <input type="text" value="<?php echo $obj_inmueble->NumeroExterior ?>" onkeyup="mayus(this);" name="num_ex_i" maxlength="45"   class="form-control" placeholder="Num. Ext"/>


    </div>
</div>



<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Mz:</label>
        <input type="text" value="<?php echo $obj_inmueble->Manzana ?>" onkeyup="mayus(this);" name="mz_i" maxlength="45"   class="form-control" placeholder="Mz"/>


    </div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <label class="control-label">Lt.:</label>
        <input type="text" value="<?php echo $obj_inmueble->Lote ?>" onkeyup="mayus(this);" name="lt_i" maxlength="45"   class="form-control" placeholder="Lt"/>


    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Condominio.:</label>
        <input type="text" value="<?php echo $obj_inmueble->Condominio ?>" onkeyup="mayus(this);" name="condominio_i" maxlength="45"   class="form-control" placeholder="Condominio"/>


    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Entrada.:</label>
        <input type="text"  value="<?php echo $obj_inmueble->Entrada ?>" onkeyup="mayus(this);" name="entrada_i" maxlength="45"   class="form-control" placeholder="Entrada"/>


    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Edificio.:</label>
        <input type="text" value="<?php echo $obj_inmueble->Edificio ?>" onkeyup="mayus(this);" name="edificio_i" maxlength="45"   class="form-control" placeholder="Edificio"/>


    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Depto.:</label>
        <input type="text" value="<?php echo $obj_inmueble->Departamento ?>" onkeyup="mayus(this);" name="depto_i" maxlength="45"   class="form-control" placeholder="Departamento"/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Entre Calle.:</label>
        <input type="text" value="<?php echo $obj_inmueble->EntreCalle ?>" onkeyup="mayus(this);" name="entre_calle_i" maxlength="150"   class="form-control" placeholder="Entre Calle."/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Y  Calle.:</label>
        <input type="text" value="<?php echo $obj_inmueble->YCalle ?>" onkeyup="mayus(this);" name="yCalle_i" maxlength="150"   class="form-control" placeholder="Y  Calle."/>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="control-label">Ciudad. <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text" required="" value="<?php echo $obj_inmueble->Ciudad ?>" onkeyup="mayus(this);" name="ciudad_i" maxlength="45"   class="form-control" placeholder="Ciudad" />


    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Latitud <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text" value="<?php echo $obj_inmueble->Latitud ?>" onkeyup="mayus(this);" name="latitud_i" maxlength="45"   class="form-control" placeholder="Latitud" required="" />


    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Longitud <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text" value="<?php echo $obj_inmueble->Longitud ?>" name="longitud_i" maxlength="45"   class="form-control" placeholder="Longitud" required="" />


    </div>
</div>

<div class="col-md-3">

    <div class="form-group">
        <label class="control-label">Altitud <span style="color:red;font-weight: bold;"> * </span> :</label>
        <input type="text"  value="<?php echo $obj_inmueble->Altitud ?>" name="altitud_i" maxlength="45"   class="form-control" placeholder="Altitud" required="" />


    </div>
</div>


</div>




</div>
<div class="form-actions right">
   <a href="<?php echo site_url('') ?>solicitudes/mostrar"   class="btn default">REGRESAR</a>

   <?php if($obj_registro->folio==null) {
   ?>
   <button type="submit" class="btn blue"><i class="fa fa-check"></i> Enviar y Guardar</button>
   <?php

}?>
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




    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    function soloNumeros(e){
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    }
</script>

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