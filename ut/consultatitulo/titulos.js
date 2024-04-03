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

	$(document).on('click','.fileinput-remove',function() {
		if ($("#tfDocImport").val()=="") {
			$("#respuestaTabla4").html("");
		}
		if ($("#tfDocUpdate").val()=="") {
			$("#respuestaTabla3").html("");
		}
	});
});

$(function () {
	frmAgregar = $("#frmAgregar").validate({
		ignore: [],
		rules: {
			MatriculaAdd: { required:true, minlength: 11, maxlength: 11 },
			NombreAdd: { required: true, maxlength: 60 },
			CargoAdd: { required: true },
			EstadoAdd: { required: true },
			ObservacionesAdd: { maxlength: 1000 }
		}
	});

	frmEditar = $("#frmEditar").validate({
		ignore: [],
		rules: {
			IdEdit: { required:true, minlength: 11, maxlength: 11 },
			NombreEdit: { required: true, maxlength: 60 },
			CargoEdit: { required: true },
			EstadoEdit: { required: true },
			ObservacionesEdit: { maxlength: 1000 }
		}
	});

	frmAgregar2 = $("#frmAgregar2").validate({
		ignore: [],
		rules: {
			NombreAdd2: { required: true, maxlength: 100 }
		}
	});

	frmEditar2 = $("#frmEditar2").validate({
		ignore: [],
		rules: {
			NombreEdit2: { required: true, maxlength: 100 }
		}
	});

	$("#tfDocImport").fileinput({
		language: 'es',
		showUpload: false,
		showCaption: true,
		showPreview: false,
		browseClass: "btn btn-default",
		removeClass: "btn btn-danger",
		allowedFileExtensions: ['csv', 'CSV']
	});

	$("#tfDocUpdate").fileinput({
		language: 'es',
		showUpload: false,
		showCaption: true,
		showPreview: false,
		browseClass: "btn btn-default",
		removeClass: "btn btn-danger",
		allowedFileExtensions: ['csv', 'CSV']
	});
});

function cinicial(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"controlTitulo.php",
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
		url:"controlTitulo.php",
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
	var Matricula = $("#tfMatriculaAdd").val();
	var Nombre = $("#tfNombreAdd").val();
	var Carrera = $("#cmbCargoAdd").val();
	var Estado = $("#cmbEstadoAdd").val();
	var Observaciones = $("#txtObservacionesAdd").val();
	Observaciones = Observaciones.replace(/\r?\n/g, "<br>");

	$.ajax({
		url:"controlTitulo.php",
		data:"opcion=agregar&Matricula=" + Matricula + "&Nombre=" + Nombre + "&Carrera=" + Carrera +
				"&Estado=" + Estado + "&Observaciones=" + Observaciones,
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
	$.ajax({
		url:"controlTitulo.php",
		data:"opcion=agregar2&Nombre=" + Nombre,
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
		url:"controlTitulo.php",
		data:"opcion=ccargo",
		type:"POST"
	}).done(function(resultados) {
		$("#divCargo").html(resultados);
	});

	$.ajax({
		url:"controlTitulo.php",
		data:"opcion=ccargo2",
		type:"POST"
	}).done(function(resultados) {
		$("#divCargoEdit").html(resultados);
	});
}

function editar(idDirectivo,nombre,carrera,estado,observaciones,activo) {
	$("#mdEditar").modal();
	$("#tfIdEdit").val(idDirectivo);
	$("#tfNombreEdit").val(nombre);
	$("#cmbCargoEdit").val(carrera);
	$("#cmbEstadoEdit").val(estado);
	observaciones = observaciones.replace(/&quoxyz/g, '"');
	observaciones = observaciones.replace(/&apoxyz/g, "'");
	observaciones = observaciones.replace(/<br>/g, "\n");
	$("#txtObservacionesEdit").html(observaciones);
	if (activo==1) {
		$("#chkActivoEdit").prop("checked",true);
	} else if (activo==0) {
		$("#chkActivoEdit").prop("checked",false);
	}
}

function editar2(idCargo, nombre) {
	$("#mdEditar2").modal();
	$("#tfIdEdit2").val(idCargo);
	$("#tfNombreEdit2").val(nombre);
}

function modificar() {
	var Matricula = $("#tfIdEdit").val();
	var Nombre = $("#tfNombreEdit").val();
	var Carrera = $("#cmbCargoEdit").val();
	var Estado =$("#cmbEstadoEdit").val();
	var Observaciones = $("#txtObservacionesEdit").val();
	Observaciones = Observaciones.replace(/\r?\n/g, "<br>");
	var Activo = $("#chkActivoEdit").prop("checked");

	$.ajax({
		url:"controlTitulo.php",
		data:"opcion=modificar&Matricula=" + Matricula + "&Nombre=" + Nombre + "&Carrera=" + Carrera + 
				"&Estado=" + Estado + "&Observaciones=" + Observaciones + "&Activo=" + Activo,
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

	$.ajax({
		url:"controlTitulo.php",
		data:"opcion=modificar2&IdCargo=" + IdCargo + "&Nombre=" + Nombre,
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
	var Matricula = $("#btnAcepDelet").attr('data-id');
	$.ajax({
		url:"controlTitulo.php",
		data:"opcion=eliminar&Matricula=" + Matricula,
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
		url:"controlTitulo.php",
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

function _(el){ return document.getElementById(el); }

function validarExtImport(obj){
	var uploadFile = obj.files[0];

	if (!window.FileReader) {
		alert('El navegador no soporta la lectura de archivos');
		return;
	}
	if (uploadFile!="" || uploadFile!=null) {
		if (!(/\.(csv|CSV)$/i).test(uploadFile.name)) {
			$("#respuestaTabla4").html("");
		}
		else {
			_("statusAdd").innerHTML = "";
			$('#pbcAdd').show();
			var formdata = new FormData($("#frmImport")[0]);
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandlerImport, false);
			ajax.addEventListener("load", completeHandlerImport, false);
			ajax.addEventListener("error", errorHandlerImport, false);
			ajax.addEventListener("abort", abortHandlerImport, false);
			ajax.open("POST", "addimportTitle.php");
			ajax.send(formdata);
			$(".btn-danger").attr("disabled",true);
			$(".btn-default").attr("disabled",true);
		}
	} else {
		$("#respuestaTabla4").html("");
	}
}

function progressHandlerImport(event){
	var percent = (event.loaded / event.total) * 100;
	var pb = document.getElementById("pbAdd");
	var pbt = document.getElementById("pbtAdd");
	var pbt2 = document.getElementById("pbt2Add");
	pb.style.width = Math.round(percent)+"%";
	pb.style.background = "#bbe0fc";
	pbt.style.color = "#000";
	pbt.innerHTML = "Subiendo " + Math.round(percent)+" %...";
}

function completeHandlerImport(event){
	var pb = document.getElementById("pbAdd");
	var pbt = document.getElementById("pbtAdd");
	var pbt2 = document.getElementById("pbt2Add");
	pb.style.background = "rgb(149, 183, 93)";
	pbt.style.color = "#FFF";
	pbt.innerHTML = "Completado 100 %";
	pbt2.innerHTML = "";

	if (event.target.responseText !="") {
		$("#respuestaTabla4").html(event.target.responseText);
		$(".btn-danger").attr("disabled",false);
		$(".btn-default").attr("disabled",false);
		$('#pbcAdd').hide(5500);
		cinicial("");
	}
}

function errorHandlerImport(event){
	_("statusAdd").innerHTML = "Carga fallida";
	$(".btn-danger").attr("disabled",false);
	$(".btn-default").attr("disabled",false);
}

function abortHandlerImport(event){
	_("statusAdd").innerHTML = "Carga abortada";
	$(".btn-danger").attr("disabled",false);
	$(".btn-default").attr("disabled",false);
}

function validarExtUpdate(obj){
	var uploadFile = obj.files[0];

	if (!window.FileReader) {
		alert('El navegador no soporta la lectura de archivos');
		return;
	}
	if (uploadFile!="" || uploadFile!=null) {
		if (!(/\.(csv|CSV)$/i).test(uploadFile.name)) {
			$("#respuestaTabla3").html("");
		}
		else {
			_("statusEdit").innerHTML = "";
			$('#pbcEdit').show();
			var formdata = new FormData($("#frmUpdate")[0]);
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandlerUpdate, false);
			ajax.addEventListener("load", completeHandlerUpdate, false);
			ajax.addEventListener("error", errorHandlerUpdate, false);
			ajax.addEventListener("abort", abortHandlerUpdate, false);
			ajax.open("POST", "addimportTitle.php");
			ajax.send(formdata);
			$(".btn-danger").attr("disabled",true);
			$(".btn-default").attr("disabled",true);
		}
	} else {
		$("#respuestaTabla3").html("");
	}
}

function progressHandlerUpdate(event){
	var percent = (event.loaded / event.total) * 100;
	var pb = document.getElementById("pbEdit");
	var pbt = document.getElementById("pbtEdit");
	var pbt2 = document.getElementById("pbt2Edit");
	pb.style.width = Math.round(percent)+"%";
	pb.style.background = "#bbe0fc";
	pbt.style.color = "#000";
	pbt.innerHTML = "Subiendo " + Math.round(percent)+" %...";
}

function completeHandlerUpdate(event){
	var pb = document.getElementById("pbEdit");
	var pbt = document.getElementById("pbtEdit");
	var pbt2 = document.getElementById("pbt2Edit");
	pb.style.background = "rgb(149, 183, 93)";
	pbt.style.color = "#FFF";
	pbt.innerHTML = "Completado 100 %";
	pbt2.innerHTML = "";

	if (event.target.responseText !="") {
		$("#respuestaTabla3").html(event.target.responseText);
		$(".btn-danger").attr("disabled",false);
		$(".btn-default").attr("disabled",false);
		$('#pbcEdit').hide(5500);
		cinicial("");
	}
}

function errorHandlerUpdate(event){
	_("statusEdit").innerHTML = "Carga fallida";
	$(".btn-danger").attr("disabled",false);
	$(".btn-default").attr("disabled",false);
}

function abortHandlerUpdate(event){
	_("statusEdit").innerHTML = "Carga abortada";
	$(".btn-danger").attr("disabled",false);
	$(".btn-default").attr("disabled",false);
}