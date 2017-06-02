
<?php
if (isset($priviledios)) {
    foreach ($priviledios->result() as $rowx) {
        ?>


        <?php echo $rowx->puesto; ?><br>

        <?php
    }
}
?>  