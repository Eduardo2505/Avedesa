<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">

            </br>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>

        <?php if (strcmp($puesto, 'Admin') != 0&&strcmp($puesto, 'Recepción') != 0){  ?>

        <li class="<?php  if(!empty($menuantecedentes)) {echo $menuantecedentes; }?>">

            <a href="<?php echo site_url('') ?>antecedentes">
                <i class="icon-docs"></i>
                <span class="title">Antecedentes</span>
                <span class="selected"></span>

            </a>

        </li>
        <li  class="<?php  if(!empty($solicitudes)) {echo $solicitudes; }?>">

            <a href="<?php echo site_url('') ?>registro/mostrarsolicitudes">
                <i class="icon-user"></i>
                <span class="title">Solicitudes</span>
                <span class="selected"></span>

            </a>

        </li>

        <?php if (strcmp($puesto, 'Inspector') != 0){  ?>

        <li  class="<?php  if(!empty($menusolicitudesver)) {echo $menusolicitudesver; }?>">

            <a href="<?php echo site_url('') ?>solicitudesvista">
                <i class="icon-wallet"></i>
                <span class="title">Búsqueda de Solicitudes</span>
                <span class="selected"></span>

            </a>

        </li>


        <?php }
    }?>

    <?php if (strcmp($puesto, 'Recepción') == 0){  ?>
    <li class="<?php echo $menusolicitudes; ?>">
        <a href="javascript:;">
            <i class="icon-wallet"></i>
            <span class="title">Solicitudes</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">

         <li class="<?php  if(!empty($agenda)) {echo $agenda; }?>">

            <a href="<?php echo site_url('') ?>calendario">

                <span class="title">Agenda</span>
                <span class="selected"></span>

            </a>

        </li>


        <li class="<?php echo $solictudesbus; ?>" >
            <a href="<?php echo site_url('') ?>solicitudes">
                Búsqueda</a>
            </li>
            <li class="<?php echo $solictudesnuevo; ?>">
                <a href="<?php echo site_url('') ?>solicitudes/registro">
                    Nuevo registro</a>
                </li>
                <li class="<?php echo $solictudesver; ?>" >
                    <a href="<?php echo site_url('') ?>solicitudes/mostrar">
                        Ver solicitudes</a>
                    </li>
                    <li >
                        <a href="<?php echo site_url('') ?>asignar/mostrar">
                            Asignar</a>
                        </li>

                    </ul>
                </li>
                <li class="<?php  if(!empty($menuantecedentes)) {echo $menuantecedentes; }?>">

                    <a href="<?php echo site_url('') ?>antecedentes">
                        <i class="icon-docs"></i>
                        <span class="title">Antecedentes</span>
                        <span class="selected"></span>

                    </a>

                </li>

                <?php } ?>

                <?php if (strcmp($puesto, 'Admin') == 0){  ?>
                <li class="<?php echo $menusolicitudes; ?>">
                    <a href="javascript:;">
                        <i class="icon-wallet"></i>
                        <span class="title">Solicitudes</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                       <li class="<?php  if(!empty($agenda)) {echo $agenda; }?>">

                        <a href="<?php echo site_url('') ?>calendario">

                            <span class="title">Agenda</span>
                            <span class="selected"></span>

                        </a>

                    </li>
                    <li class="<?php echo $solictudesbus; ?>" >
                        <a href="<?php echo site_url('') ?>solicitudes">
                            Búsqueda</a>
                        </li>
                        <li class="<?php echo $solictudesnuevo; ?>">
                            <a href="<?php echo site_url('') ?>solicitudes/registro">
                                Nuevo registro</a>
                            </li>
                            <li class="<?php echo $solictudesver; ?>" >
                                <a href="<?php echo site_url('') ?>solicitudes/mostrar">
                                    Ver solicitudes</a>
                                </li>
                                <li class="<?php  if(!empty($asignarMenu)) {echo $asignarMenu; }?>">
                                    <a href="<?php echo site_url('') ?>asignar/mostrar">
                                        Asignar</a>
                                    </li>

                                </ul>
                            </li>
                            <li class="<?php  if(!empty($menuantecedentes)) {echo $menuantecedentes; }?>">

                                <a href="<?php echo site_url('') ?>antecedentesa">
                                    <i class="icon-docs"></i>
                                    <span class="title">Antecedentes</span>
                                    <span class="selected"></span>

                                </a>

                            </li>
                            
                            <li class="<?php echo $menucatalogos; ?>">
                                <a href="javascript:;">
                                    <i class="icon-briefcase"></i>
                                    <span class="title">Catalogos</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="<?php echo $catalogost; ?>">
                                        <a href="<?php echo site_url('') ?>tipoavaluo/mostrar">
                                            Tipo Avaluos</a>
                                        </li>
                                        <li class="<?php echo $catalogoso; ?>">
                                            <a href="<?php echo site_url('') ?>objetivo/mostrar">
                                                Objetivo Avaluos</a>
                                            </li>
                                            <li class="<?php echo $catalogose; ?>">
                                                <a href="<?php echo site_url('') ?>estado/mostrar">
                                                    Estado</a>
                                                </li>

                                                <li class="<?php echo $catalogosp; ?>">
                                                    <a href="<?php echo site_url('') ?>puesto/mostrar">
                                                        Puesto</a>
                                                    </li>
                                                    <li class="<?php echo $catalogosem; ?>" >
                                                        <a href="<?php echo site_url('') ?>empresa/mostrar">
                                                            Empresa</a>
                                                        </li>
                                                        <li class="<?php echo $catalogoemp; ?>">
                                                            <a href="<?php echo site_url('') ?>empleado/mostrar">
                                                                Empleado</a>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li class="<?php echo $menuadmin; ?>">
                                                        <a href="javascript:;">
                                                            <i class="icon-settings"></i>
                                                            <span class="title">Administración</span>
                                                            <span class="selected"></span>
                                                            <span class="arrow open"></span>
                                                        </a>
                                                        <ul class="sub-menu">
                                                            <li class="<?php echo $adminq; ?>">
                                                                <a href="<?php echo site_url('') ?>quincena/mostrar">
                                                                    Quincenas</a>
                                                                </li>
                                                                <li class="<?php echo $adminc; ?>" >
                                                                    <a href="<?php echo site_url('') ?>concepto/mostrar">
                                                                        Conceptos</a>
                                                                    </li>
                                                                    <li class="<?php echo $admincc; ?>" >
                                                                        <a href="<?php echo site_url('') ?>costoconcepto/mostrar">
                                                                            Costo Conceptos</a>
                                                                        </li>
                                                                        <li class="<?php echo $admina; ?>" >
                                                                            <a href="<?php echo site_url('') ?>avaluos/mostrar">
                                                                                Avalúos</a>
                                                                            </li>

                                                                            <li class="<?php  if(!empty($adminapag)) {echo $adminapag; }?>" >
                                                                                <a href="<?php echo site_url('') ?>adminpagos/mostrarpagosadmin">
                                                                                    Pagos Anticipados</a>
                                                                                </li>

                                                                            </ul>
                                                                        </li>



                                                                        

                                                                        <li>

                                                                           <a target="_blank" href="https://www.the-qrcode-generator.com/scan">
                                                                            <i class="fa fa-qrcode"></i>
                                                                            <span class="title">QR</span>
                                                                            <span class="selected"></span>

                                                                        </a>

                                                                    </li>



                                                                    <?php }?>

                                                                  




                                                                </ul>
                                                                <!-- END SIDEBAR MENU -->
                                                            </div>
                                                        </div>