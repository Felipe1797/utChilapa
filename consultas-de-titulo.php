<?php 
$titulo = "Consultas de Título";
$pagina = "titulo";
?>
<?php require $_SERVER['DOCUMENT_ROOT'].'/inc/header.inc'; ?>
<?php require $_SERVER['DOCUMENT_ROOT'].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdon();
?>

<div class="clearfix"></div>
<style>
	@media (min-width: 992px) {.aladerecha { text-align: right; }}
	.error { color: #E04B4A; }
</style>
<section>
	<div class="container">
		<div class="row">
			<div class='col-md-12 col-lg-12'>
				<h1 class='text-center wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>Consulta tu Título</h1>
				<br>
			</div>
			<div class="col-xs-12 col-md-12 col-lg-12 form-group wow fadeInUp" style="margin: 0px; padding: 0px;">
				<form id="frmBuscar" name="frmBuscar" method="post" action="javascript:buscar();">
					<label class="label-control col-xs-7 col-md-2 col-lg-2 aladerecha">Nombre C. o Matricula:</label>
					<div class="col-xs-12 col-md-4 col-lg-4" style="margin: 0px;">
						<input type="text" name="Nombre" class="form-control" placeholder="Apellidos Nombre(s)">
					</div>

					<label class="label-control col-xs-12 col-md-1 col-lg-1 aladerecha">Nivel:</label>
					<div class="col-xs-12 col-md-4 col-lg-4" style="margin: 0px;" id="divNivel"></div>
					
					<div class="col-xs-2 col-md-1 col-lg-1">
						<button type="submit" class="form-control" style="width: 90px;">Buscar</button>
					</div>
				</form>
			</div>

			<br><br><br><br><br><br><br><br>

			<div id="resultado" class="col-xs-12 col-md-12 col-lg-12  wow fadeInUp"></div>
		</div>
	</div>
</section>
<script>
	$(function () {
		frmBuscar = $("#frmBuscar").validate({
			ignore: [],
			rules: {
				Nombre: { required: true },
				Nivel: { required: true },
			}
		});

		$.ajax({
			url:"../ut/principal/modelPrincipal.php",
			data:"opcion=consultacarreras",
			type:"POST"
		}).done(function(resultados) {
			if (resultados != null && resultados != "") {
				$("#divNivel").html(resultados);
			}
		});
	});
	function buscar() {
		$.ajax({
			url:"../ut/principal/modelPrincipal.php",
			data:"opcion=consultatitulo&" + $("#frmBuscar").serialize(),
			type:"POST"
		}).done(function(resultados) {
			if (resultados != null && resultados != "") {
				$("#resultado").html(resultados);
			}
		});
	}
</script>
<?php require $_SERVER['DOCUMENT_ROOT'].'/inc/footer.inc'; ?>