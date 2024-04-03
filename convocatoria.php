<?php 
$titulo = "Convocatoria de Nuevo Ingreso 2019 ";
$pagina = "convocatoria";
?>
<?php require $_SERVER['DOCUMENT_ROOT'].'/inc/header.inc'; ?>
<?php require $_SERVER['DOCUMENT_ROOT'].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdon();
?>

<div class="clearfix"></div>
<section>
    <div class="container">
        <div class="row">  
            <?php 
                $principal->consultaconvocatoria();
            ?>
        </div>
    </div>     
</section>
<?php require $_SERVER['DOCUMENT_ROOT'].'/inc/footer.inc'; ?>