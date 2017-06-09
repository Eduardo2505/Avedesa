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

                         <script type="text/javascript">
                            $(document).ready(function() {
                                $('#formCheck').submit(function() {
                                    var data = $(this).serialize();
                                    $.post('<?php echo site_url('') ?>adminpagos/agregarComanda', data, function(respuesta) {

                                       $('#tableTicket').html(respuesta);
                                       var totalr= $('#totalR').val();
                                       var totals= $('#totalA').val();
                                         // alert(totals);
                                         var i=0;
                                         $("#tblEntAttributes tbody input:checkbox:checked").each(   
                                            function() {
                                                var precio=$(this).attr("title");
                                                var idpago=$(this).val();
                                                $( "#"+idpago ).remove();

                                                totals-=precio;

                                                i++;

                                            }
                                            );

                                         var totalRA=totalr-i;



                                         $('#totalR').val(totalRA);
                                         $('#totalA').val(totals);
                                         $("#checkfull").removeAttr("checked");
                                         $('#subtitulo').html(totalRA+" // TOTAL ANTICIPO : $ "+addCommas(totals)+".00");

                                     });
                                    return false;
                                });
                            });

                            function addCommas(nStr) {
                                nStr += '';
                                x = nStr.split('.');
                                x1 = x[0];
                                x2 = x.length > 1 ? '.' + x[1] : '';
                                var rgx = /(\d+)(\d{3})/;
                                while (rgx.test(x1)) {
                                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                }
                                return x1 + x2;
                            }




                            $(document).ready(function() {
                                $("#checkfull").click(function(){
                                      //  alert("entro");
                                      $('.case').attr('checked', this.checked);



                                  });
                            });




                        </script>

                        <script type="text/javascript">

                            function modalx(t)
                            {
                                var idpago = t.attr("title");
                                var costo = t.attr("name");
                                $("#idpagoformeditar").val(idpago);
                                $("#anticipoPag").val(costo);
                                $("#editardescripcion").val("");
                                $("#btnmodal").click();
                            }

                        </script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#idEditar').submit(function() {
                                    var data = $(this).serialize();
                                    var idpago = $("#idpagoformeditar").val();
                                    $.get('<?php echo site_url('') ?>adminpagos/editarPagoVista', data, function(respuesta) {
                                       $('#'+idpago).html(respuesta);
                                       $("#closeModal").click();
                                   });
                                    return false;
                                });
                            });

                        </script>
                        <!--  Este es el modal -->
                        <div style="display: none;">
                            <a class="btn default" data-target="#static" data-toggle="modal" id="btnmodal">
                                View Demo </a>
                            </div>


                            <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">


                                <div class="modal-body" >
                                   <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-pencil"></i>Editar
                                        </div>

                                    </div>
                                </div>

                                <form id="idEditar" class="form-horizontal">
                                    <input type="hidden" id="idpagoformeditar" name="idpago">
                                    <div class="form-body">
                                        <div class="form-group">
                                          <label class="col-md-3 control-label">ANTICIPO : *</label>
                                          <div class="col-md-8">
                                              <input type="text" id="anticipoPag" class="form-control input-circle" maxlength="45" name="anticipo" placeholder="ANTICIPO" required pattern="[0-9]{1,8}">

                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-md-3 control-label">DESCRIPCIÓN : </label>
                                          <div class="col-md-8">
                                            <textarea name="descripcion" id="editardescripcion" required="" class="form-control input-circle" maxlength="150"></textarea>


                                        </div>
                                    </div>

                                    <div class="form-actions">
                                      <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                          <button type="submit" class="btn btn-circle green">GUARDAR</button>
                                          <button type="button" data-dismiss="modal" id="closeModal" class="btn btn-circle blue">SALIR</button>

                                      </div>
                                  </div>
                              </div>

                          </div>
                      </form>

                  </div>

              </div>


              <!-- Fin del modal -->
              <form  id="formCheck">
                <input type="hidden" id="totalR" value="<?php echo $total; ?>">
                <input type="hidden" id="totalA" value="<?php echo $totalSuma; ?>">
                <div class="tab-pane active" id="tab_1">
                    <div class="portlet box yellow">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>PAGOS // RESULTADOS :  <span id="subtitulo"><?php echo $total?> // TOTAL ANTICIPO : $ <?php echo number_format($totalSuma, 2, '.', ',');?></span>
                            </div>


                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-hover" id="tblEntAttributes">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkfull"/></th>
                                            <th>NUM. EXPEDIENTE</th>
                                            <th>ANTICIPO</th>
                                            <th>DECRIPCION</th>
                                            <th>REGISTRO</th>
                                            <th>USUARIO</th>
                                            <th>*</th>


                                        </tr>
                                    </thead>
                                    <tbody>



                                        <?php

                                        if (isset($registros)) {
                                        foreach ($registros->result() as $rowx) {


                                        ?>


                                        <tr id="<?php echo $rowx->idpagos; ?>">

                                            <td><input type="checkbox" class="case" title="<?php echo $rowx->anticipo; ?>"  name="pagos[]" value="<?php echo $rowx->idpagos; ?>"></td>

                                            <td><?php echo $rowx->num_expediente; ?></td>
                                            <td width="110px">$ <?php echo number_format($rowx->anticipo, 2, '.', ',');?></td>
                                            <td><?php echo $rowx->descripcion; ?></td>

                                            <td><?php echo $rowx->registro; ?></td>
                                            <td><?php echo $rowx->usuario; ?></td>


                                            <td><i class="fa fa-pencil" onclick="modalx($(this));" name="<?php echo $rowx->anticipo; ?>" title="<?php echo $rowx->idpagos ?>"></i></td>


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



            <div class="col-md-2">

             <button type="submit" class="form-control btn blue" ><i class="fa fa-check"></i> AGREGAR</button>
         </div>


     </div>
 </form>
 <br><br>



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
                <div class="table-scrollable" id="tableTicket">

                    <script type="text/javascript">


                        function clickEliminar(t)
                        {
                           // alert("cc");
                            var idpago = t.attr( "title");
                            var costo = t.attr( "name");
                            var totalr= $('#totalR').val();
                            var totals= $('#totalA').val();



                            var totalRs=parseInt(totalr)+1;
                            var totalsS=parseFloat(totals)+parseFloat(costo);



                            var dataString = 'idpago=' + idpago;
                            $.ajax({
                                type: "GET",
                                url: '<?php echo site_url('') ?>adminpagos/eliminarTicket',
                                data: dataString,
                                success: function(data) {

                                    $('#tableTicket').html(data);

                                    $('#totalR').val(totalRs);
                                    $('#totalA').val(totalsS);



                                    $('#subtitulo').html(totalRs+" // TOTAL ANTICIPO : $ "+addCommas(totalsS)+".00");

                                    $.ajax({
                                        type: "GET",
                                        url: '<?php echo site_url('') ?>adminpagos/buscarpago',
                                        data: dataString,
                                        success: function(data) {

                                            $("#tblEntAttributes tbody").append(data);

                                        }
                                    });


                                }
                            });


                        }


                    </script>
                    <table class="table table-hover">
                        <thead>
                            <tr>

                                <th>NUM. EXPEDIENTE</th>
                                <th>ANTICIPO</th>
                                <th>*</th>


                            </tr>
                        </thead>
                        <tbody>



                         <?php
                         $total=0;

                         if (isset($registrosTiket)) {
                         foreach ($registrosTiket->result() as $rowx) {

                         $total+=$rowx->anticipo;
                         ?>


                         <tr>


                           <td><?php echo $rowx->num_expediente; ?></td>
                           <td>$ <?php echo number_format($rowx->anticipo, 2, '.', ',');?></td>

                           <td><i class="fa fa-remove" onclick="clickEliminar($(this));" name="<?php echo $rowx->anticipo; ?>" title="<?php echo $rowx->idpagos ?>"></i></td>



                       </tr>



                       <?php
                   }
               }
               ?>  



           </tbody>

           <tr>

            <th>TOTAL: </th>
            <th> $ <?php echo number_format($total, 2, '.', ',');?></th>


        </tr>

    </table>
    <a href="<?php echo site_url('') ?>adminpagos/imprimirTiket" class="form-control btn blue" ><i class="fa fa-check"></i> IMPRIMIR</a>

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