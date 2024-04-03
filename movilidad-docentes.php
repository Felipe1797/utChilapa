<?php 
$titulo = "Movilidad Docentes";
$pagina = "movilidad";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'; ?>

<?php
    $principal->consultabannerramdon();
?>

<section id="movilidad-es">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-center">
				<h1 class="text-center borde-bottum">Movilidad Docentes</h1>
				<br />
			</div>
			<div id="faq-result" class="imagencontainer"></div>
		</div>
	</div>
	<div id="loader-icon" class="text-center" style="margin-top: 40px;">
		<img src="../img/ajax-loader.gif" style="height: 50px;"/>
		<br>
		Cargando...
	</div>
</section>

<script>
	function galeria(url,nombre,descripcion) {
		$("#mdGaleria").remove();
		$("body").append(
		"<div class='modal fade' role='modal' aria-labelledby='gridSystemModalLabel' id='mdGaleria'>"+
			"<div class='modal-dialog modal-lg' role='document'>"+
				"<div class='modal-content'>"+
					"<div class='modal-body' style='padding:0px; position:relative;'>"+
						"<div class='Gallery-media'><img class='media-image' src='" + url + "'></div>"+
						"<div class='closeBTN'>"+
							"<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+
						"</div>"+
					"</div>"+
					"<div class='modal-footer' style='background: white; border-radius: 0px; border-top: 0px;'>"+
						"<div class='name'><strong><h4>" + nombre + "</h4></strong>"+
						"</div>"+
						"<div class='description'>" + descripcion + "</div>"+
					"</div>"+
				"</div>"+
			"</div>"+
		"</div><script>$(document).ready(function(){$('#mdGaleria').modal('show');});");
	}

	$(document).ready(function(){
		getresult('../ut/principal/modelPrincipal.php',"");

		function getresult(url, pagenum) {
			$.ajax({
				url: url,
				type: "POST",
				data: "opcion=consultamovilidaddocentes&pageNewNum=" + pagenum,
				beforeSend: function(resultados){ $('#loader-icon').show(); },
				complete: function(resultados){ $('#loader-icon').hide(); },
				success: function(resultados){
					$("#faq-result").append(resultados);
				},
				error: function(){}
		   });
		}
		$(window).scroll(function(){
			if (($(window).scrollTop()) >= $(document).height() - $(window).height()){
				if($(".pagenum:last").val() <= $(".total-page").val()) {
					var pagenum = parseInt($(".pagenum:last").val()) + 1;
					getresult('../ut/principal/modelPrincipal.php',pagenum);
				}
			}
		});
	});
</script>

<?php require $_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'; ?>