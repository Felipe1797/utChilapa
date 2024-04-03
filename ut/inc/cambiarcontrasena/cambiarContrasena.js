var frmCambiarContrasena;

$(document).ready(function(){
	
	$("#mdCambiarContrasena").on('hidden.bs.modal', function (e) {
		frmCambiarContrasena.resetForm();
		$('#gender').next('.bootstrap-select').removeClass('error').removeClass('valid');
		$('.form-control').removeClass('valid');
		$("#frmCambiarContrasena")[0].reset();
	});

});

$(function () {
	frmCambiarContrasena = $("#frmCambiarContrasena").validate({
	    ignore: [],
	    rules: {
			Contrasena: { required: true },
			ContrasenaNueva: { required: true },
	        ConfirContrasenaNueva: { required: true, equalTo: "#tfContrasenaNueva" }
	    },
    	messages: {
    		ConfirContrasenaNueva:{
    			equalTo: "Las contraseñas no coinciden. ¿Quieres volver a intentarlo?."
    		}
		}
	});
});
function cambiarContrasena() {
	//$("#").show(200).delay(1500).hide(200);
	$("#artFaltanDatos").hide();
	$("#artDatosIncorectros").hide();
	$("#artNoExiste").hide();
	$("#artErrorEMail").hide();
	$("#artVerificar").show(200);
	var Contrasena = $("#tfContrasena").val();
	var ContrasenaNueva = $("#tfContrasenaNueva").val();
	var ConfirContrasenaNueva = $("#tfConfirContrasenaNueva").val();
	
	$.ajax({
		url:"../inc/cambiarcontrasena/controlCambiarContrasena.php",
		data:"opcion=cambiarContrasena&Contrasena=" + Contrasena + "&ContrasenaNueva=" + ContrasenaNueva + 
										"&ConfirContrasenaNueva=" + ConfirContrasenaNueva,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$("#artBienContrasena").show(200).delay(2500).hide(200);
				setTimeout(function() {
					location.href="../logout.php"
				}, 2500);
			} else if (resultados == "NoExiste") {
				$("#artErrorContrasena").show(200).delay(2500).hide(200);
			}
		}
	});
	
}
