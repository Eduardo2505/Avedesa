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

         <li class="<?php  if(!empty($menuquincena)) {echo $menuquincena; }?>">

            <a href="<?php echo site_url('') ?>registro">
                <i class="fa fa-money"></i>
                <span class="title">Quincena</span>
                <span class="selected"></span>

            </a>

        </li>

        <li class="<?php  if(!empty($menuantecedentes)) {echo $menuantecedentes; }?>">

            <a href="<?php echo site_url('') ?>antecedentes">
                <i class="icon-docs"></i>
                <span class="title">Antecedentes</span>
                <span class="selected"></span>

            </a>

        </li>
        <li  class="<?php  if(!empty($solicitudes)) {echo $solicitudes; }?>">

            <a href="<?php echo site_url('') ?>registro/mostrarsolicitudes">
                <i class="fa fa-paper-plane-o"></i>
                <span class="title">Solicitudes</span>
                <span class="selected"></span>

            </a>

        </li>

        <?php if($verSolicitudesBusqueda!=0){?>
        <li  class="<?php  if(!empty($menusolicitudesver)) {echo $menusolicitudesver; }?>">

            <a href="<?php echo site_url('') ?>solicitudesvista">
                <i class="icon-wallet"></i>
                <span class="title">Búsqueda de Solicitudes</span>
                <span class="selected"></span>

            </a>

        </li>

        <?php  }?>


        <li class="heading">
            <h3 class="uppercase">Usuario</h3>
        </li>

        <li class="<?php  if(!empty($munupass)) {echo $munupass; }?>">

            <a href="<?php echo site_url('') ?>registro/contrasena">
                <i class="icon-user"></i>
                <span class="title">Modificar</span>
                <span class="selected"></span>

            </a>

        </li>





    </ul>
    <!-- END SIDEBAR MENU -->
</div>
</div>