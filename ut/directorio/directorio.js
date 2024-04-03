var frmAgregar;
var frmEditar;
var frmAgregar2;
var frmEditar2;

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

	$("#mdAgregar2").on('hidden.bs.modal', function (e) {
		frmAgregar2.resetForm();
		$('#gender').next('.bootstrap-select').removeClass('error').removeClass('valid');
		$('.form-control').removeClass('valid');
		$("#frmAgregar2")[0].reset();
	});

	$("#mdEditar2").on('hidden.bs.modal', function (e) {
		frmEditar2.resetForm();
		$('#gender').next('.bootstrap-select').removeClass('error').removeClass('valid');
		$('.form-control').removeClass('valid');
		$("#btnAcepEdit2").removeAttr('data-id');
		$("#frmEditar2")[0].reset();
	});
});

$(function () {
	frmAgregar = $("#frmAgregar").validate({
		ignore: [],
		rules: {
			NombreAdd: { required: true, maxlength: 60 },
			CargoAdd: { required: true },
			EmailAdd: { required: true, email: true, maxlength: 255 }
		}
	});

	frmEditar = $("#frmEditar").validate({
		ignore: [],
		rules: {
			NombreEdit: { required: true, maxlength: 60 },
			CargoEdit: { required: true },
			EmailEdit: { required: true, email: true, maxlength: 255 }
		}
	});

	frmAgregar2 = $("#frmAgregar2").validate({
		ignore: [],
		rules: {
			NombreAdd2: { required: true, maxlength: 100 },
			NivelAdd2: { required: true, maxlength: 4 }
		}
	});

	frmEditar2 = $("#frmEditar2").validate({
		ignore: [],
		rules: {
			NombreEdit2: { required: true, maxlength: 100 },
			NivelEdit2: { required: true, maxlength: 4 }
		}
	});
});

function cinicial(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"controlDirectorio.php",
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
					'oPaginate': {
						'sFirst':'Primero',
						'sLast':'Último',
						'sNext':'Siguiente',
						'sPrevious':'Anterior'
					},
					'oAria': {
						'sSortAscending':': Activar para ordenar la columna de manera ascendente',
						'sSortDescending':': Activar para ordenar la columna de manera descendente'
					}
				},
	  			"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
				"stateSave": true,
				"sPaginationType": "full_numbers" 
			});
			$("[data-toggle='tooltip']").tooltip();
		}
	});
}

function cinicial2(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=cinicial2&vals=" + vals,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			$("#respuestaTabla2").html(resultados);
			$('#tbl2').DataTable({
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
					'oPaginate': {
						'sFirst':'Primero',
						'sLast':'Último',
						'sNext':'Siguiente',
						'sPrevious':'Anterior'
					},
					'oAria': {
						'sSortAscending':': Activar para ordenar la columna de manera ascendente',
						'sSortDescending':': Activar para ordenar la columna de manera descendente'
					}
				},
	  			"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
				"stateSave": true,
				"sPaginationType": "full_numbers" 
			});
			$("[data-toggle='tooltip']").tooltip();
		}
	});
}

function nuevo() { $("#mdAgregar").modal(); }

function nuevo2() { $("#mdAgregar2").modal(); }

function agregar() {
	var Nombre = $("#tfNombreAdd").val();
	var IdCargo = $("#cmbCargoAdd").val();
	var Email = $("#tfEmailAdd").val();
	var TelExt = $("#tfTelExtAdd").val();
	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=agregar&Nombre=" + Nombre + "&IdCargo=" + IdCargo + "&Email=" + Email + "&TelExt=" + TelExt,
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

function agregar2() {
	var Nombre = $("#tfNombreAdd2").val();
	var Nivel = $("#tfNivelAdd2").val();
	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=agregar2&Nombre=" + Nombre + "&Nivel=" + Nivel,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artAgregadoExitoso2').show(200).delay(1500).hide(200);
				setTimeout(function () {
					$('.form-control').removeClass('valid');
					$("#frmAgregar2")[0].reset();
				}, 1700);
				cinicial2('');
				cCargos();
			}
		}
	});
}

function cCargos() {
	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=ccargo",
		type:"POST"
	}).done(function(resultados) {
		$("#divCargo").html(resultados);
	});

	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=ccargo2",
		type:"POST"
	}).done(function(resultados) {
		$("#divCargoEdit").html(resultados);
	});
}

function editar(idDirectivo,nombre,idCargo,eMail,activo,telExt) {
	$("#mdEditar").modal();
	$("#tfIdEdit").val(idDirectivo);
	$("#tfNombreEdit").val(nombre);
	$("#cmbCargoEdit").val(idCargo);
	$("#tfEmailEdit").val(eMail);
	$("#tfTelExtEdit").val(telExt);
	if (activo==1) {
		$("#chkActivoEdit").prop("checked",true);
	} else if (activo==0) {
		$("#chkActivoEdit").prop("checked",false);
	}
}

function editar2(idCargo, nombre, nivel) {
	$("#mdEditar2").modal();
	$("#tfIdEdit2").val(idCargo);
	$("#tfNombreEdit2").val(nombre);
	$("#tfNivelEdit2").val(nivel);
}

function modificar() {
	var IdDirectivo = $("#tfIdEdit").val();
	var Nombre = $("#tfNombreEdit").val();
	var IdCargo = $("#cmbCargoEdit").val();
	var Email = $("#tfEmailEdit").val();
	var TelExt = $("#tfTelExtEdit").val();
	var Activo = $("#chkActivoEdit").prop("checked");

	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=modificar&IdDirectivo=" + IdDirectivo + "&Nombre=" + Nombre + "&IdCargo=" + IdCargo 
												+ "&Email=" + Email + "&Activo=" + Activo + "&TelExt=" + TelExt,
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

function modificar2() {
	var IdCargo = $("#tfIdEdit2").val();
	var Nombre = $("#tfNombreEdit2").val();
	var Nivel = $("#tfNivelEdit2").val();

	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=modificar2&IdCargo=" + IdCargo + "&Nombre=" + Nombre + "&Nivel=" + Nivel,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artEditadoExitoso2').show(200).delay(1500).hide(200);
				setTimeout(function () {
					$('.form-control').removeClass('valid');
					$("#mdEditar2").modal('hide');
				}, 1700);
				cinicial2('');
				cCargos();
			}
		}
	});
}

function eliminar(idNota) {
	$("#mdConfirEliminar").modal();
	$("#btnAcepDelet").attr('data-id',idNota);
}

function eliminar2(idCargo) {
	$("#mdConfirEliminar2").modal();
	$("#btnAcepDelet2").attr('data-id',idCargo);
}

function confirEliminar() {
	var IdDirectivo = $("#btnAcepDelet").attr('data-id');
	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=eliminar&IdDirectivo=" + IdDirectivo,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artEliminadoExitoso').show(1).delay(1500).hide(1);
				setTimeout(function () {
					$("#btnAcepDelet").removeAttr('data-id');
					$("#btnAcepDelet").removeAttr('data-rutaimg');
					$("#mdConfirEliminar").modal('hide');
				}, 1500);
				cinicial('');
			}
		}
	});
}

function confirEliminar2() {
	var IdCargo = $("#btnAcepDelet2").attr('data-id');
	$.ajax({
		url:"controlDirectorio.php",
		data:"opcion=eliminar2&IdCargo=" + IdCargo,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artEliminadoExitoso2').show(1).delay(1500).hide(1);
				setTimeout(function () {
					$("#btnAcepDelet2").removeAttr('data-id');
					$("#mdConfirEliminar2").modal('hide');
				}, 1500);
				cinicial2('');
				cCargos();
			}
		}
	});
}

function cancelar() { location.href = "../"; }