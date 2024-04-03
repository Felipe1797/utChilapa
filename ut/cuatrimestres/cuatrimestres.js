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
			CuatrimestreAdd: { required: true, maxlength: 100 },
			IdCarrreraAdd: { required: true, maxlength: 100 }
			
		}
	});

	frmEditar = $("#frmEditar").validate({
		ignore: [],
		rules: {
			CuatrimestreEdit: { required: true, maxlength: 100 },
			IdCarrreraEdit: { required: true, maxlength: 100 }
			
		}
	});
});

function cinicial(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"control.php",
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

function nuevo() { $("#mdAgregar").modal(); }

function agregar() {
	var Cuatrimestre = $("#tfCuatrimestreAdd").val();	
	var IdCarrera = $("#tfIdCarreraAdd").val();
	$.ajax({
		url:"control.php",
		data:"opcion=agregar&Cuatrimestre=" + Cuatrimestre + "&IdCarrera=" + IdCarrera,
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

function editar(idcuatrimestre,cuatrimestre,idcarrera) {
	$("#mdEditar").modal();
	$("#divImgEditPreview").show();
	$("#tfIdEdit").val(idcuatrimestre);
	cuatrimestre = cuatrimestre.replace(/&quoxyz/g, '"');
	cuatrimestre = cuatrimestre.replace(/&apoxyz/g, "'");
	$("#tfCuatrimestreEdit").val(cuatrimestre);	
	idcarrera = idcarrera.replace(/&quoxyz/g, '"');
	idcarrera = idcarrera.replace(/&apoxyz/g, "'");
	$("#tfIdCarreraEdit").val(idcarrera);
	
}

function modificar() {
	var IdCuatrimestre = $("#tfIdEdit").val();
	var Cuatrimestre = $("#tfCuatrimestreEdit").val();
	var IdCarrera = $("#tfIdCarreraEdit").val();


	$.ajax({
		url:"control.php",
		data:"opcion=modificar&IdCuatrimestre=" + IdCuatrimestre + "&Cuatrimestre=" + Cuatrimestre + "&IdCarrera=" + IdCarrera,
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

function eliminar(idNota) {
	$("#mdConfirEliminar").modal();
	$("#btnAcepDelet").attr('data-id',idNota);
}

function confirEliminar() {
	var IdNota = $("#btnAcepDelet").attr('data-id');
	$.ajax({
		url:"control.php",
		data:"opcion=eliminar&IdNota=" + IdNota,
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

function cancelar() { location.href = "../"; }