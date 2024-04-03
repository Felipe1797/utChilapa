<?php 
$titulo = "Directorio";
$pagina = "directorio";
require $_SERVER['DOCUMENT_ROOT'].'/inc/header.inc'; 
require $_SERVER['DOCUMENT_ROOT'].'/inc/menu.inc'; 
?>
<?php
    $principal->consultabannerramdon();
?>
    <section id="directorio">
        <div class="container">
            <div class="row border">
                <div class="col-md-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2 class="text-center">DIRECTORIO ADMINISTRATIVO DE LA UARM</h2>
                    <br />
                    <br />
                </div>
                <?php 
                    $principal->consultarector();
                    $principal->consultadirector();
                    $principal->consultadirectivos();
                ?>
                <div class="col-md-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <br><br>
                    <h1 style="font-weight: 700;"><em>Teléfono: 7561040944</em></h1>
                    Para comunicarse con un área, por favor revise la extensión
                    <br><br><br>
                </div>
            </div>
        </div>
    </section>
    <div class="colo-direc">
    </div>
<?php require $_SERVER['DOCUMENT_ROOT'].'/inc/footer.inc'; ?>