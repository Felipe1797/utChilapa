var frmAgregar;
var frmEditar;

$(document).ready(function(){
	$("#mdAgregar").on('hidden.bs.modal', function (e) {
		frmAgregar.resetForm();
		$('#gender').next('.bootstrap-select').removeClass('error').removeClass('valid');
		$('.form-control').removeClass('valid');
		$("#frmAgregar")[0].reset();
	});

	$("#mdEditar").on('hidden.bs.modal', function (e) {
		frmEditar.resetForm();
		$('#gender').next('.bootstrap-select').removeClass('error').removeClass('valid');
		$('.form-control').removeClass('valid');
		$("#btnAcepEdit").removeAttr('data-id');
		$("#frmEditar")[0].reset();
	});
});

$(function () {
	frmAgregar = $("#frmAgregar").validate({
	    ignore: [],
	    rules: {
			NombresAdd: { required: true, maxlength: 30 },
			ApellidosAdd: { required: true, maxlength: 30 },
			NombreUsuarioAdd: { required: true,
				remote: {
					url: "../verificar/verificarExistencia.php",
					type: "POST"
				}, maxlength: 30
            },
			EMailAdd: { required: true, email: true,
				remote: {
					url: "../verificar/verificarExistencia.php",
					type: "POST"
				}, maxlength: 255
             },
			ContrasenaAdd: { required: true },
	        CargoAdd: { required: true }
	    },
    	messages: {
    		NombreUsuarioAdd:{
    			remote: "¡El nombre de usurio ya está en uso!."
    		},
			EMailAdd: {
				required: "Introduzca una dirección de correo electrónico.",
				EMailAdd: "Por favor, escribe una dirección de correo válida.",
				remote: "¡El correo electrónico ya está en uso!."
			}
		}
	});

	frmEditar = $("#frmEditar").validate({
	    ignore: [],
	    rules: {
	        NombresEdit: { required: true },
	        ApellidosEdit: { required: true },
	        NombreUsuarioEdit: { required: true },
	        EMailEdit: { required: true, email: true }
	    }
	});
});

function cinicial(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"controlUsuarios.php",
		data:"opcion=cinicial&vals=" + vals,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			$("#respuestaTabla").html(resultados);
			$('#tbl1').DataTable({
				'language': {
					'sProcessing':'Procesando...',
					'sLengthMenu':'Mostrar _MENU_ registros',
					'sZeroRecords':'No se encontraron resultados',
					'sEmptyTable':'Ningún dato disponible en esta tabla',
					'sInfo':'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
					'sInfoEmpty':'Mostrando registros del 0 al 0 de un total de 0 registros',
					'sInfoFiltered':'(filtrado de un total de _MAX_ registros)',
					'sInfoPostFix':'',
					'sSearch':'Buscar:',
					'sUrl':'',
					'sInfoThousands':',',
					'sLoadingRecords':'Cargando...',
					'oPaginate': 
					{
						'sFirst':'Primero',
						'sLast':'Último',
						'sNext':'Siguiente',
						'sPrevious':'Anterior'
					},
					'oAria': 
					{
						'sSortAscending':': Activar para ordenar la columna de manera ascendente',
						'sSortDescending':': Activar para ordenar la columna de manera descendente'
					}
				},
	  			"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
				"stateSave": true,
				"sPaginationType": "full_numbers" 
			});
			$("[data-toggle='tooltip']").tooltip();
		} else {
		}
	});
}

function nuevoUsuario() { $("#mdAgregar").modal(); }

function agregar() {
	var IdUsuario = 0;
	var Nombres = $("#tfNombresAdd").val();
	var Apellidos = $("#tfApellidosAdd").val();
	var NombreUsuario = $("#tfNombreUsuarioAdd").val();
	var EMail = $("#tfEMailAdd").val();
	var Contrasena = $("#tfContrasenaAdd").val();
	var Activo = true;
	var Cargo = $("#slcCargoAdd").val();

	$.ajax({
		url:"controlUsuarios.php",
		data:"opcion=agregar&IdUsuario=" + IdUsuario + "&Nombres=" + Nombres + "&Apellidos=" + Apellidos + 
							"&NombreUsuario=" + NombreUsuario + "&EMail=" + EMail + "&Contrasena=" + Contrasena + 
							"&Activo=" + Activo + "&Cargo=" + Cargo,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artAgregadoExitoso').show(200).delay(1500).hide(200);
				setTimeout(function () {
					$('.form-control').removeClass('valid');
					$("#frmAgregar")[0].reset();
				}, 1700);
				cinicial('');
			}
		}
	});
}

function editar(idUsuario,nombres,apellidos,nombreUsuario,eMail,activo,cargo) {
	$("#mdEditar").modal();
	$("#btnAcepEdit").attr('data-id',idUsuario);
	$("#tfNombresEdit").val(nombres);
	$("#tfApellidosEdit").val(apellidos);
	$("#tfNombreUsuarioEdit").val(nombreUsuario);
	$("#tfEMailEdit").val(eMail);
	if (activo==1) {
		$("#chkActivoEdit").prop("checked",true);
	} else if (activo==0) {
		$("#chkActivoEdit").prop("checked",false);
	}
	$("#slcCargoEdit").val(cargo);
}

function modificar() {
	var IdUsuario = $("#btnAcepEdit").attr('data-id');
	var Nombres = $("#tfNombresEdit").val();
	var Apellidos = $("#tfApellidosEdit").val();
	var NombreUsuario = $("#tfNombreUsuarioEdit").val();
	var EMail = $("#tfEMailEdit").val();
	var Contrasena = $("#tfContrasenaEdit").val();
	var Activo = $("#chkActivoEdit").prop("checked");
	var Cargo = $("#slcCargoEdit").val();

	$.ajax({
		url:"controlUsuarios.php",
		data:"opcion=modificar&IdUsuario=" + IdUsuario + "&Nombres=" + Nombres + "&Apellidos=" + Apellidos + 
							"&NombreUsuario=" + NombreUsuario + "&EMail=" + EMail + "&Contrasena=" + Contrasena + "&Activo=" + Activo + "&Cargo=" + Cargo,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artEditadoExitoso').show(200).delay(1500).hide(200);
				setTimeout(function () {
					$('.form-control').removeClass('valid');
					$("#mdEditar").modal('hide');
				}, 1700);
				cinicial('');
			}
		}
	});
}

function editarAcceso(Id, Avisos, Notas, Calendarios, Becas, Requisitos, Documentos, Visitas, Seguimientos, Movilidades, Directorios, Titulos, Banner) {
	$("#mdEditarAcceso").modal();
	$("#btnAcepEditAcceso").attr('data-id',Id);
	if (Avisos==1) { $("#chAvisos").prop("checked",true); }
	if (Avisos==0) { $("#chAvisos").prop("checked",false); }
	if (Notas==1) { $("#chNotas").prop("checked",true); }
	if (Notas==0) { $("#chNotas").prop("checked",false); }
	if (Calendarios==1) { $("#chCalendarios").prop("checked",true); }
	if (Calendarios==0) { $("#chCalendarios").prop("checked",false); }
	if (Becas==1) { $("#chBecas").prop("checked",true); }
	if (Becas==0) { $("#chBecas").prop("checked",false); }
	if (Requisitos==1) { $("#chRequisitos").prop("checked",true); }
	if (Requisitos==0) { $("#chRequisitos").prop("checked",false); }
	if (Documentos==1) { $("#chDocumentos").prop("checked",true); }
	if (Documentos==0) { $("#chDocumentos").prop("checked",false); }
	if (Visitas==1) { $("#chVisitas").prop("checked",true); }
	if (Visitas==0) { $("#chVisitas").prop("checked",false); }
	if (Seguimientos==1) { $("#chSeguimientos").prop("checked",true); }
	if (Seguimientos==0) { $("#chSeguimientos").prop("checked",false); }
	if (Movilidades==1) { $("#chMovilidades").prop("checked",true); }
	if (Movilidades==0) { $("#chMovilidades").prop("checked",false); }
	if (Directorios==1) { $("#chDirectorios").prop("checked",true); }
	if (Directorios==0) { $("#chDirectorios").prop("checked",false); }
	if (Titulos==1) { $("#chTitulos").prop("checked",true); }
	if (Titulos==0) { $("#chTitulos").prop("checked",false); }
	if (Banner==1) { $("#chBanner").prop("checked",true); }
	if (Banner==0) { $("#chBanner").prop("checked",false); }
}

function modificarAcceso() {
	var Id = $("#btnAcepEditAcceso").attr('data-id');
	var Banner = $("#chBanner").prop("checked");
	var Avisos = $("#chAvisos").prop("checked");
	var Notas = $("#chNotas").prop("checked");
	var Calendarios = $("#chCalendarios").prop("checked");
	var Becas = $("#chBecas").prop("checked");
	var Requisitos = $("#chRequisitos").prop("checked");
	var Documentos = $("#chDocumentos").prop("checked");
	var Visitas = $("#chVisitas").prop("checked");
	var Seguimientos = $("#chSeguimientos").prop("checked");
	var Movilidades = $("#chMovilidades").prop("checked");
	var Directorios = $("#chDirectorios").prop("checked");
	var Titulos = $("#chTitulos").prop("checked");

	$.ajax({
		url:"controlUsuarios.php",
		data:"opcion=modificarAcceso&Id=" + Id + "&Avisos=" + Avisos + "&Notas=" + Notas + "&Calendarios=" + Calendarios + "&Becas=" + Becas +
				"&Requisitos=" + Requisitos + "&Documentos=" + Documentos + "&Visitas=" + Visitas + "&Seguimientos=" + Seguimientos +
				"&Movilidades=" + Movilidades + "&Directorios=" + Directorios + "&Titulos=" + Titulos + "&Banner=" + Banner,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artEditadoAccesoExitoso').show(200).delay(1500).hide(200);
				setTimeout(function () {
					$('.form-control').removeClass('valid');
					$("#mdEditarAcceso").modal('hide');
				}, 1700);
				cinicial('');
			}
		}
	});
}

function eliminar(idUsuario) {
	$.ajax({
		url:"controlUsuarios.php",
		data:"opcion=validarEliminar&IdUsuario=" + idUsuario,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$("#mdConfirEliminar").modal();
				$("#btnAcepDelet").attr('data-id',idUsuario);
			} else if (resultados == "Error") {
				$("#mdErrorEliminar").modal();
			}
		}
	});
}

function confirEliminar() {
	var IdUsuario = $("#btnAcepDelet").attr('data-id');
	$.ajax({
		url:"controlUsuarios.php",
		data:"opcion=eliminar&IdUsuario=" + IdUsuario,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artEliminadoExitoso').show(1).delay(1500).hide(1);
				setTimeout(function () {
					$("#btnAcepDelet").removeAttr('data-id');
					$("#mdConfirEliminar").modal('hide');
				}, 1500);
				cinicial('');
			}
		}
	});
}

