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

            <?php
            $row = $query->row();
            ?>


            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">



                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="<?php echo site_url('') ?>registro">REGRESAR</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>

                                <a href="<?php echo site_url('') ?>registro/mostrar">MOSTRAR AVALUOS</a>

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
                                                <i class="fa fa-gift"></i> RECIBO DE : <?php echo $row->nomempleado; ?> *** QUINCENA <?php echo $row->inicio; ?> - <?php echo $row->final; ?> PAGADA <?php echo $row->pagada; ?>
                                            </div>

                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <script type="text/javascript">

                                                $(function() {
                                                    $('.formenviar').submit(function() {

                                                        $('#mensaje').html("");

                                                        var data = $(this).serialize();
                                                        //alert(data);

                                                        $.post('<?php echo site_url('') ?>registro/registro', data, function(respuesta) {
                                                            var n = respuesta.length;

                                                            if(n==1){

                                                                $(location).attr('href','<?php echo site_url('') ?>registro/trabajar?idquincena='+'<?php echo $idquincena ?>'); 
                                                            }else{


                                                                $('#mensaje').html(respuesta);
                                                            }



                                                        });




                                                        return false;
                                                    });
                                                });



                                                $(document).ready(function() {
                                                    $('#change').change(function() {
                                                        var id = $(this).val();
                                                        if (id == 1) {

                                                            $('#inputid').html('<input type="text" pattern="[0-9]{4}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="AAAA-NUM" required=""/>');
                                                        } else if (id == 2) {
                                                            $('#inputid').html('<input type="text" pattern="(^VC)-[0-9]{2}-[0-9]+" class="form-control input-circle" maxlength="45" name="avaluo" placeholder="VC-AA-NUM"required=""/>');
                                                        } else if (id == 3) {
                                                            $('#inputid').html('<input type="text" pattern="[0-9]{2}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="AA-NUM" required=""/>');
                                                        } else if (id == 4) {
                                                            $('#inputid').html('<input type="text" pattern="(^SL)-[0-9]{2}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="SL-AA-NUM" required=""/>');
                                                        } else if (id == 5) {
                                                            $('#inputid').html('<input type="text" pattern="(^JL)-[0-9]{2}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="JL-AA-NUM" required=""/>');
                                                        } else if (id == 6) {
                                                            $('#inputid').html('<input type="text"  pattern="(^OP)-[0-9]{2}-[0-9]+"  class="form-control input-circle" maxlength="45" name="avaluo" placeholder="OP-AA-NUM" required=""/>');
                                                        }else{
                                                            $('#inputid').html('');
                                                        }

                                                    }


                                                    );
                                                });

                                            </script>
                                            <div id="mensaje">

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <form class="formenviar" class="form-horizontal">

                                                            <input type="hidden" name="idEmpleado" value="<?php echo $idcapturista ?>" class="labelidemple">
                                                            <input type="hidden" name="idquincena" value="<?php echo $idquincena ?>" >
                                                            <input type="hidden" name="costo" value="0" >
                                                            <input type="hidden" name="observacion" value="-" >
                                                            <input type="hidden" name="idtipo" value="3" >
                                                            <input type="hidden" name="idrecibo" value="<?php echo $idrecibo; ?>" >

                                                            <div class="form-body">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label">TIPO AVALÚO</label>
                                                                    <div class="col-md-6">
                                                                        <select  class="form-control input-circle" id="change" required="">
                                                                            <option value="">Seleccione</option>
                                                                            <option value="1">UNIDAD DE VAL</option>
                                                                            <option value="2">VALOR COMERCIAL:</option>
                                                                            <option value="3">GRUPO AVE</option>
                                                                            <option value="4">SERGIO LOVERA</option>
                                                                            <option value="5">JL</option>
                                                                            <option value="6">OP</option>

                                                                        </select>
                                                                        <br>
                                                                        <div id="inputid"></div>

                                                                        <br> <select name="tipoConce" id="changeFolio"  required="" class="form-control input-circle">
                                                                        <option value="">Seleccione</option>

                                                                        <?php
                                                                        if (isset($conceptosAvaluos)) {
                                                                            foreach ($conceptosAvaluos->result() as $rowcc) {
                                                                                ?>
                                                                                <option value="<?php echo $rowcc->nombre; ?>-<?php echo $rowcc->costo; ?>-<?php echo $rowcc->idconcepto; ?>"><?php echo $rowcc->nombre; ?> ($ <?php echo $rowcc->costo; ?>)</option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <option value="-1">OTRO COSTO</option>
                                                                    </select>
                                                                    <div id="divPersonalizaAvaluos" style="display: none">
                                                                        <br>
                                                                        <input type="text" disabled="" pattern="[0-9]{1,8}" class="form-control input-circle classPer" maxlength="9" name="costoPersonalizado" placeholder="Costo"  required=""/>
                                                                        <br>
                                                                        <textarea disabled=""  placeholder="Observciones" required="" maxlength="40" name="observacionPersonalizado" class="form-control input-circle classPer"></textarea>

                                                                    </div>


                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <br>







                                                </div>
                                                <hr />
                                                <div class="row">

                                                    <form class="formenviar"  class="form-horizontal">
                                                        <input type="hidden" name="idEmpleado" value="<?php echo $idcapturista ?>" class="labelidemple">
                                                        <input type="hidden" name="idquincena" value="<?php echo $idquincena ?>" >
                                                        <input type="hidden" name="observacion" value="-" >
                                                        <input type="hidden" name="idtipo" value="2" >
                                                        <input type="hidden" name="idrecibo" value="<?php echo $idrecibo; ?>" >
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label">CÁLCULO</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control input-circle" maxlength="45" name="avaluo" placeholder="Num. Cálculo"  required=""/>


                                                                    <br> <select name="tipo" required="" class="form-control input-circle">

                                                                    <?php
                                                                    if (isset($conceptoscalotros)) {
                                                                        foreach ($conceptoscalotros->result() as $rowcc) {
                                                                            ?>
                                                                            <option value="<?php echo $rowcc->nombre; ?>-<?php echo $rowcc->costo; ?>-<?php echo $rowcc->idconcepto; ?>"><?php echo $rowcc->nombre; ?> ($ <?php echo $rowcc->costo; ?>)</option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>
                                                                <br>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                            </div>
                                                        </div>



                                                    </div>
                                                </form>

                                            </div>
                                            <hr />

                                        <!--     <div class="row">


                                                <form class="formenviar"  class="form-horizontal">
                                                    <input type="hidden" name="idEmpleado" value="<?php echo $idcapturista ?>" class="labelidemple">
                                                    <input type="hidden" name="idquincena" value="<?php echo $idquincena ?>" >
                                                    <input type="hidden" name="costo" value="0" >                                                        
                                                    <input type="hidden" name="idtipo" value="1" >
                                                    <input type="hidden" name="idrecibo" value="<?php echo $idrecibo; ?>" >
                                                    <input type="hidden" name="tipo" value="OBSERVACIONES" >
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">OTROS</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control input-circle" maxlength="45" name="avaluo" placeholder="Num. Observación"  required=""/>
                                                                <br>
                                                                <textarea placeholder="Observciones" name="observacion" class="form-control input-circle"></textarea>

                                                                <br>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <button type="submit" class="btn btn-circle blue">GUARDAR</button>
                                                            </div>
                                                        </div>



                                                    </div>
                                                </form>

                                            </div>
 -->
                                        </div> 


                                        <script type="text/javascript">

                                          $(document).ready(function() { 
                                            $('#changeFolio').click(function() {
                                                var veri=$(this).val();
                                                if(veri==-1){
                                                    $('#divPersonalizaAvaluos').show();
                                                    $('.classPer').prop('disabled', false);


                                                }else{
                                                    $('#divPersonalizaAvaluos').hide();
                                                    $('.classPer').prop('disabled', true);
                                                }

                                            });
                                        });

                                          $(document).ready(function() {
                                            $('.actualizarbtn').click(function() {
                                                var id = $(this).attr("title");
                                                var costo = $(this).attr("name");
                                                var cant = $('#can_' + id).val();
                                                var idrecibo = '<?php echo $idrecibo; ?>';
                                                var idquince = '<?php echo $idquincena; ?>';
                                                var dataString = 'idcosto_concepto=' + id + '&cantidad=' + cant + '&costo=' + costo + '&idrecibo=' + idrecibo + '&idquince=' + idquince;


                                                $('#subtotal_' + id).html('Guardando...');

                                                            //alert(dataString);
                                                            $.ajax({
                                                                type: "GET",
                                                                url: '<?php echo site_url('') ?>registro/actualizarconceptos',
                                                                data: dataString,
                                                                success: function(data) {


                                                                    $('#subtotal_' + id).html(data);


                                                                    $.ajax({
                                                                        type: "GET",
                                                                        url: '<?php echo site_url('') ?>registro/actulizarsubto',
                                                                        data: dataString,
                                                                        success: function(datax) {


                                                                            $('#ttotal').html(datax);




                                                                        }
                                                                    });


                                                                }
                                                            });
                                                            //}

                                                        }


                                                        );
                                        });

                                    </script>

                                    <div class="col-md-6"><br>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>CONCEPTO</th>
                                                    <th>COSTO</th>
                                                    <th>CANTIDAD</th>
                                                    <th>SUBTOTAL</th>
                                                    <th>ACCION</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                echo $conceptos;
                                                ?>  




                                                <tr><td colspan="4">TOTAL :</td><td><samp id="ttotal"> $ <?php echo $sub ?></samp></td><tr>
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