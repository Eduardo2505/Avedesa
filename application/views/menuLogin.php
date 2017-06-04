<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="utf-8"/>
    <title>Menú</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo site_url('') ?>metronic/admin/pages/css/lock.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo site_url('') ?>metronic/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url('') ?>metronic/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?php echo site_url('') ?>metronic/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="<?php echo site_url('') ?>favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->


<body>
    <div class="page-lock">

        <div class="page-body">
            <div class="lock-head">
              Menú
          </div>
          <div class="lock-body" style="text-align: center">
        
              <?php

              if (isset($resultados)) {
                foreach ($resultados->result() as $rowx) {
                    ?>
                    <div class="col-md-<?php echo $colTam?>">
                        <a href="<?php echo site_url('') ?><?php echo $rowx->url; ?>">
                            <div class="lock-avatar-block">
                                <img src="<?php echo site_url('') ?><?php echo $rowx->img; ?>" class="lock-avatar">
                            </div>
                        </a>
                    </div>
                    <?php

                }
            } ?>
        
    </div>
    <div class="lock-bottom">
        <a href="<?php echo site_url('') ?>salir/close">SALIR</a>
    </div>
</div>
<div class="page-footer-custom">
 2017 © HelpMex.com.mx
</div>
</div>
</body>

<!-- END JAVASCRIPTS -->

<!-- END BODY -->
</html>