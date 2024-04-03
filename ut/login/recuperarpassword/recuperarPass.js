$(document).ready(function(){
	$('input').keyup(function(e) {
		if(e.keyCode == 13) {
			recuperarPass();
		}
	});

});

function recuperarPass() {
	//$("#").show(200).delay(1500).hide(200);
	$("#artFaltanDatos").hide();
	$("#artDatosIncorectros").hide();
	$("#artNoExiste").hide();
	$("#artErrorEMail").hide();
	$("#artVerificar").show(200);
	var EMail = $("#tfEMail").val();

	if (EMail == "") {
		$("#artVerificar").hide();
		$("#artFaltanDatos").show(200);
	} else {
		$.ajax({
			url:"controlRecuperarPass.php",
			data:"opcion=recuperarPass&EMail=" + EMail,
			type:"POST"
		}).done(function(resultados) {
			if (resultados != null && resultados != "") {
				if (resultados == "Bien") {
					$("#artVerificar").hide();
					$("#artDatosBien").show(200);
					$("#artErrorEMail").hide();
					$("#artDatosBien").html($("#artDatosBien").html() + "<br />Contraseña enviada a: <br /> <strong>" + EMail + "</strong>");
					$("#frmgrpCambioBien").html("");
					$("#frmgrpCambioPassBien").html("<div class='form-group'><div class='col-md-12'>" + 
						"<a href='../../login' class='btn btn-info btn-block btn-lg'>Aceptar e ir a iniciar sesión.</button></div></div>");
				} else if (resultados == "NoExiste") {
					$("#artVerificar").hide();
					$("#artNoExiste").show(200);
				} else if (resultados == "ErrorEMail") {
					$("#artVerificar").hide();
					$("#artErrorEMail").show(200);
				}
			} else {
				$("#artVerificar").hide(200);
				$("#artFaltanDatos").hide(200);
				$("#artDatosIncorectros").show(200);
				$("#artErrorEMail").hide(200);
			}
		});
	}
}

function inputsVacios() {
	var EMail = $("#tfEMail").val();
	if (EMail != "") {
		$("#artFaltanDatos").hide(200);
		$("#artNoExiste").hide(200);
		$("#artErrorEMail").hide(200);
	} else {
		$("#artFaltanDatos").show(200);
		$("#artNoExiste").hide(200);
		$("#artErrorEMail").hide(200);
	}
}

function cancelar() {
	location.href = "../";
}