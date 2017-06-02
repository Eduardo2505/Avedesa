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

        

        <li class="<?php  if(!empty($munocaptura)) {echo $munocaptura; }?>">

            <a href="<?php echo site_url('') ?>antecedentesadmin/captura">
                <i class="icon-note"></i>
                <span class="title">Captura</span>
                <span class="selected"></span>

            </a>

        </li>
        <li  class="<?php  if(!empty($menuConsulta)) {echo $menuConsulta; }?>">

            <a href="<?php echo site_url('') ?>antecedentesadmin/busqueda">
                <i class="icon-magnifier"></i>
                <span class="title">Consulta</span>
                <span class="selected"></span>

            </a>

        </li>


    </ul>
    <!-- END SIDEBAR MENU -->
</div>
</div>