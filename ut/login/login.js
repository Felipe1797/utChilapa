$(document).ready(function(){
	$('input').keyup(function(e) {
		if(e.keyCode == 13) {
			iniciarSesion();
		}
	});

});

function iniciarSesion() {
	//$("#").show(200).delay(1500).hide(200);
	$("#artFaltanDatos").hide();
	$("#artDatosIncorectros").hide();
	$("#artVerificar").show(200);
	var nombreusuario = $("#tfNombreUsuario").val();
	var contrasena = $("#tfContrasena").val();

	if (nombreusuario == "" || contrasena =="") {
		$("#artVerificar").hide();
		$("#artFaltanDatos").show(200);
	} else {
		$.ajax({
			url:"controlLogin.php",
			data:"opcion=iniciarSesion&nombreusuario=" + nombreusuario + "&contrasena=" + contrasena,
			type:"POST"
		}).done(function(resultados) {
			if (resultados != null && resultados != "") {
				if (resultados == "Si") {
					setTimeout(function () {
						window.location.href = "../superusuario";
				    }, 2000);
				}
			} else {
				$("#artVerificar").hide();
				$("#artFaltanDatos").hide();
				$("#artDatosIncorectros").show(200);
			}
		});
	}
}

function cancelar() {
	location.href = "../../";
}