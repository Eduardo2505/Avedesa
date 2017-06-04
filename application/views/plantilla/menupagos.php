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


        <li class="<?php  if(!empty($menuanticipos)) {echo $menuanticipos; }?>">

            <a href="<?php echo site_url('') ?>adminpagos/mostraranticipos">
                <i class="icon-docs"></i>
                <span class="title">Expedientes con Anticipo</span>
                <span class="selected"></span>

            </a>

        </li>
        <li  class="<?php  if(!empty($menusinanticipos)) {echo $menusinanticipos; }?>">

            <a href="<?php echo site_url('') ?>adminpagos/mostrarsinanticipos">
                <i class="icon-user"></i>
                <span class="title">Expedientes Pendientes</span>
                <span class="selected"></span>

            </a>

        </li>


        <li class="<?php  if(!empty($menuanticipospago)) {echo $menuanticipospago; }?>">

            <a href="<?php echo site_url('') ?>adminpagos/mostrarpagos">
                <i class="icon-docs"></i>
                <span class="title">Pagos Anticipados</span>
                <span class="selected"></span>

            </a>

        </li>
        <li class="heading">
        <h3 class="uppercase">Usuario</h3>
        </li>

        <li class="<?php  if(!empty($munupass)) {echo $munupass; }?>">

            <a href="<?php echo site_url('') ?>adminpagos/contrasena">
                <i class="icon-user"></i>
                <span class="title">Modificar</span>
                <span class="selected"></span>

            </a>

        </li>

        

    </ul>
    <!-- END SIDEBAR MENU -->
</div>
</div>