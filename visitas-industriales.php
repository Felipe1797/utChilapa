<?php 
$titulo = "Visitas Industriales";
$pagina = "visitas";
?>
<?php
	require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc';
	require $_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc';
?>

<?php
    $principal->consultabannerramdon();
?>

<section style="padding-bottom: 0px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">Visitas Industriales</h1>
			</div>
			<div class="col-md-12">
				<h2 class="borde-left">¿Qué son las visitas industriales?</h2>
				<hr />
			</div>
			<div class="col-md-12">
				<p class="text-justify">Se entiende por visitas industriales, la asistencia de un grupo de alumnos acompañados por el profesor de tiempo completo o de asignatura a una empresa del sector productivo de bienes o servicios, con el objeto de conocer un proceso específico de la empresa, asi como de las inquietudes e intervenciones de los alumnos. Las visitas a las empresas deben corresponder con la formación teórica impartida en el aula, por lo cual es una actividad que requiere ser evaluada académicamente.<br />Las áreas académicas deberán coordinarse con el área de vinculación para la gestión de las visitas que los estudiantes realizarán a la industria, las cuales serán por lo menos uno por grupo cada cuatrimestre, en función de la matrícula y tendrán una relación clara con los contenidos de aprendizaje. El área de vinculación es responsable de gestionar los espacios necesarios para la realización de visitas de los estudiantes con base en las necesidades académicas. Las visitas de los estudiantes a la industria es una actividad institucional que debe ajustarse a la normatividad tanto de las empresas como de la institución contemplando la participación y el compromiso del personal docente, el apoyo administrativo para su realización y el buen comportamiento de los alumnos.</p>
			</div>
		</div>
	</div>
</section>

<section id="visitas-indus">
	<div class="container" style="padding: 0px;">
		<div class="">
			<h2 class="text-center">Galeria</h2>
			<br/>
		</div>
		<div id="faq-result" class="imagencontainer"></div>
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
				data: "opcion=consultavisitas&pageNewNum=" + pagenum,
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