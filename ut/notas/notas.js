var frmAgregar;
var frmEditar;
var frmAgregarPromo;
var frmEditarPromo;

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

	$("#mdAgregarPromo").on('hidden.bs.modal', function (e) {
		frmAgregarPromo.resetForm();
		$('#gender').next('.bootstrap-select').removeClass('error').removeClass('valid');
		$('.form-control').removeClass('valid');
		$("#frmAgregarPromo")[0].reset();
	});

	$("#mdEditarPromo").on('hidden.bs.modal', function (e) {
		frmEditarPromo.resetForm();
		$('#gender').next('.bootstrap-select').removeClass('error').removeClass('valid');
		$('.form-control').removeClass('valid');
		$("#btnAcepEditPromo").removeAttr('data-id');
		$("#frmEditarPromo")[0].reset();
	});

	$(document).on('click','.fileinput-remove',function() {
		if ($("#tfImgEdit").val()!="") {
			$("#divImgEditPreview").hide();
		} else {
			$("#divImgEditPreview").show();
		}

		if ($("#tfImgEditPromo").val()!="") {
			$("#divImgEditPreviewPromo").hide();
		} else {
			var ruta = $("#tfImgEditNamePromo").val().split("?");
			if (ruta[0]!="") {
				$("#divImgEditPreviewPromo").show();
			} else {
				$("#divImgEditPreviewPromo").hide();
			}
		}
	});

	$("#tfImgEdit").change(function() {
		if ($("#tfImgEdit").val()!="") {
			$("#divImgEditPreview").hide();
		} else {
			$("#divImgEditPreview").show();
		}
	});

	$("#tfImgEditPromo").change(function() {
		if ($("#tfImgEditPromo").val()!="") {
			$("#divImgEditPreviewPromo").hide();
		} else {
			var ruta = $("#tfImgEditNamePromo").val().split("?");
			if (ruta[0]!="") {
				$("#divImgEditPreviewPromo").show();
			} else {
				$("#divImgEditPreviewPromo").hide();
			}
		}
	});
});

$(function () {
	frmAgregar = $("#frmAgregar").validate({
		ignore: [],
		rules: {
			NombreAdd: { required: true, maxlength: 255 },
			DescripcionAdd: { required: true, maxlength: 4000 },
			ImgAdd: { required: true, filesize: 1048576 },
			URLNotaAdd: { url: true, maxlength: 1000 }
		}, messages: { 
			ImgAdd: { 
				filesize: "Imagen mayor 1Mb. ____"
			}
		}
	});

	frmEditar = $("#frmEditar").validate({
		ignore: [],
		rules: {
			NombreEdit: { required: true, maxlength: 255 },
			DescripcionEdit: { required: true, maxlength: 4000 },
			ImgEdit: { filesize: 1048576 },
			URLNotaEdit: { url: true, maxlength: 1000 }
		}, messages: { 
			ImgEdit: {
				filesize: "Imagen mayor 1Mb. ____"
			}
		}
	});

	$("#tfImgAdd").fileinput({
		language: 'es',
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-default",
		removeClass: "btn btn-danger",
		allowedFileExtensions: ['jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG']
	});

	$("#tfImgEdit").fileinput({
		language: 'es',
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-default",
		removeClass: "btn btn-danger",
		allowedFileExtensions: ['jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG']
	});

	frmAgregarPromo = $("#frmAgregarPromo").validate({
		ignore: [],
		rules: {
			TipoPromo: { required: true },
			NombreAddPromo: { maxlength: 100 },
			URLAddPromo: { maxlength: 1000 },
			ImgAddPromo: { filesize: 1048576 }
		}, messages: { 
			ImgAdd: { 
				filesize: "Imagen mayor 1Mb. ____"
			}
		}
	});

	frmEditarPromo = $("#frmEditarPromo").validate({
		ignore: [],
		rules: {
			TipoEditPromo: { required: true },
			NombreEditPromo: { maxlength: 100 },
			URLEditPromo: { maxlength: 1000 },
			ImgEditPromo: { filesize: 1048576 }
		}, messages: { 
			ImgEditPromo: { 
				filesize: "Imagen mayor 1Mb. ____"
			}
		}
	});

	$("#tfImgAddPromo").fileinput({
		language: 'es',
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-default",
		removeClass: "btn btn-danger",
		allowedFileExtensions: ['jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG']
	});

	$("#tfImgEditPromo").fileinput({
		language: 'es',
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-default",
		removeClass: "btn btn-danger",
		allowedFileExtensions: ['jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG']
	});

	$("#kvFileinputModal").on('hidden.bs.modal', function (e) {
		$('body').addClass('modal-open');
	});

	$.validator.addMethod('filesize', function(value, element, param) {
		return this.optional(element) || (element.files[0].size <= param) 
	});
});

function cinicial(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"controlNotas.php",
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

function verImg(rutaImg) {
	$("#mdVerImg").modal();
	$("#imgDetail").attr('src',rutaImg);
}

function nuevo() { $("#mdAgregar").modal(); }

function _(el){ return document.getElementById(el); }

function agregar(){
	_("statusAdd").innerHTML = "";
	$('#pbcAdd').show();
	var formdata = new FormData($("#frmAgregar")[0]);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandlerAdd, false);
	ajax.addEventListener("load", completeHandlerAdd, false);
	ajax.addEventListener("error", errorHandlerAdd, false);
	ajax.addEventListener("abort", abortHandlerAdd, false);
	ajax.open("POST", "addeditNotas.php");
	ajax.send(formdata);
	$(".btn-danger").attr("disabled",true);
	$(".btn-success").attr("disabled",true);
	$(".close").attr("disabled",true);
}

function progressHandlerAdd(event){
	var percent = (event.loaded / event.total) * 100;
	var pb = document.getElementById("pbAdd");
	var pbt = document.getElementById("pbtAdd");
	var pbt2 = document.getElementById("pbt2Add");
	pb.style.width = Math.round(percent)+"%";
	pb.style.background = "#bbe0fc";
	pbt.style.color = "#000";
	pbt.innerHTML = "Subiendo " + Math.round(percent)+" %...";
	pbt2.innerHTML = "Subiendo " + event.loaded + " bytes de " + event.total;
}

function completeHandlerAdd(event){
	var pb = document.getElementById("pbAdd");
	var pbt = document.getElementById("pbtAdd");
	var pbt2 = document.getElementById("pbt2Add");
	pb.style.background = "rgb(149, 183, 93)";
	pbt.style.color = "#FFF";
	pbt.innerHTML = "Completado 100 %";
	pbt2.innerHTML = "";

	if (event.target.responseText == "Bien") {
		$('#artAgregadoExitoso').show(200).delay(1500).hide(200);
		setTimeout(function () {
			$('.form-control').removeClass('valid');
			$("#frmAgregar")[0].reset();
			pb.style.width = "0%";
			pb.style.background = "#bbe0fc";
			pbt.style.color = "#000";
			pbt.innerHTML = "";
			$('#pbcAdd').hide();
			$(".btn-danger").attr("disabled",false);
			$(".btn-success").attr("disabled",false);
			$(".close").attr("disabled",false);
		}, 1700);
		cinicial('');
	}
}

function errorHandlerAdd(event){
	_("statusAdd").innerHTML = "Carga fallida";
	$(".btn-danger").attr("disabled",false);
	$(".btn-success").attr("disabled",false);
	$(".close").attr("disabled",false);
}

function abortHandlerAdd(event){
	_("statusAdd").innerHTML = "Carga abortada";
	$(".btn-danger").attr("disabled",false);
	$(".btn-success").attr("disabled",false);
	$(".close").attr("disabled",false);
}

function editar(idNota,nombre,descripcion,rutaImg,rutaNota,activo) {
	$("#mdEditar").modal();
	$("#divImgEditPreview").show();
	$("#tfIdEdit").val(idNota);
	nombre = nombre.replace(/&quoxyz/g, '"');
	nombre = nombre.replace(/&apoxyz/g, "'");
	$("#tfNombreEdit").val(nombre);
	descripcion = descripcion.replace(/&quoxyz/g, '"');
	descripcion = descripcion.replace(/&apoxyz/g, "'");
	descripcion = descripcion.replace(/<br>/g, "\n");
	$("#tfDescripcionEdit").html(descripcion);
	$("#ImgEditPreview").attr('src', rutaImg);
	$("#tfImgEditName").val(rutaImg);
	$("#tfURLNotaEdit").val(rutaNota);
	if (activo==1) {
		$("#chkActivoEdit").prop("checked",true);
	} else if (activo==0) {
		$("#chkActivoEdit").prop("checked",false);
	}
}

function modificar(){
	_("statusEdit").innerHTML = "";
	$('#pbcEdit').show();
	var formdata = new FormData($("#frmEditar")[0]);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandlerEdit, false);
	ajax.addEventListener("load", completeHandlerEdit, false);
	ajax.addEventListener("error", errorHandlerEdit, false);
	ajax.addEventListener("abort", abortHandlerEdit, false);
	ajax.open("POST", "addeditNotas.php");
	ajax.send(formdata);
	$(".btn-danger").attr("disabled",true);
	$(".btn-success").attr("disabled",true);
	$(".close").attr("disabled",true);
}

function progressHandlerEdit(event){
	var percent = (event.loaded / event.total) * 100;
	var pb = document.getElementById("pbEdit");
	var pbt = document.getElementById("pbtEdit");
	var pbt2 = document.getElementById("pbt2Edit");
	pb.style.width = Math.round(percent)+"%";
	pb.style.background = "#bbe0fc";
	pbt.style.color = "#000";
	pbt.innerHTML = "Subiendo " + Math.round(percent)+" %...";
	pbt2.innerHTML = "Subiendo " + event.loaded + " bytes de " + event.total;
}

function completeHandlerEdit(event){
	var pb = document.getElementById("pbEdit");
	var pbt = document.getElementById("pbtEdit");
	var pbt2 = document.getElementById("pbt2Edit");
	pb.style.background = "rgb(149, 183, 93)";
	pbt.style.color = "#FFF";
	pbt.innerHTML = "Completado 100 %";
	pbt2.innerHTML = "";

	if (event.target.responseText == "Bien") {
		$('#artEditadoExitoso').show(200).delay(1500).hide(200);
		setTimeout(function () {
			$('.form-control').removeClass('valid');
			$("#mdEditar").modal('hide');
			pb.style.width = "0%";
			pb.style.background = "#bbe0fc";
			pbt.style.color = "#000";
			pbt.innerHTML = "";
			$('#pbcEdit').hide();
			$(".btn-danger").attr("disabled",false);
			$(".btn-success").attr("disabled",false);
			$(".close").attr("disabled",false);
		}, 1700);
		cinicial('');
	}
}

function errorHandlerEdit(event){
	_("statusEdit").innerHTML = "Carga fallida";
	$(".btn-danger").attr("disabled",false);
	$(".btn-success").attr("disabled",false);
	$(".close").attr("disabled",false);
}

function abortHandlerEdit(event){
	_("statusEdit").innerHTML = "Carga abortada";
	$(".btn-danger").attr("disabled",false);
	$(".btn-success").attr("disabled",false);
	$(".close").attr("disabled",false);
}

function eliminar(idNota, rutaImg) {
	$("#mdConfirEliminar").modal();
	$("#btnAcepDelet").attr('data-id',idNota);
	$("#btnAcepDelet").attr('data-rutaimg',rutaImg);
}

function confirEliminar() {
	var IdNota = $("#btnAcepDelet").attr('data-id');
	var RutaImg = $("#btnAcepDelet").attr('data-rutaimg');
	$.ajax({
		url:"controlNotas.php",
		data:"opcion=eliminar&IdNota=" + IdNota + "&RutaImg=" + RutaImg,
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

function cinicialpromo(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"controlNotas.php",
		data:"opcion=cinicialpromo&vals=" + vals,
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

function nuevo2() { $("#mdAgregarPromo").modal(); }

function agregarPromo(){
	_("statusAddPromo").innerHTML = "";
	$('#pbcAddPromo').show();
	var formdata = new FormData($("#frmAgregarPromo")[0]);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandlerAddPromo, false);
	ajax.addEventListener("load", completeHandlerAddPromo, false);
	ajax.addEventListener("error", errorHandlerAddPromo, false);
	ajax.addEventListener("abort", abortHandlerAddPromo, false);
	ajax.open("POST", "addeditNotas.php");
	ajax.send(formdata);
	$(".btn-danger").attr("disabled",true);
	$(".btn-success").attr("disabled",true);
	$(".close").attr("disabled",true);
}

function progressHandlerAddPromo(event){
	var percent = (event.loaded / event.total) * 100;
	var pb = document.getElementById("pbAddPromo");
	var pbt = document.getElementById("pbtAddPromo");
	var pbt2 = document.getElementById("pbt2AddPromo");
	pb.style.width = Math.round(percent)+"%";
	pb.style.background = "#bbe0fc";
	pbt.style.color = "#000";
	pbt.innerHTML = "Subiendo " + Math.round(percent)+" %...";
	pbt2.innerHTML = "Subiendo " + event.loaded + " bytes de " + event.total;
}

function completeHandlerAddPromo(event){
	var pb = document.getElementById("pbAddPromo");
	var pbt = document.getElementById("pbtAddPromo");
	var pbt2 = document.getElementById("pbt2AddPromo");
	pb.style.background = "rgb(149, 183, 93)";
	pbt.style.color = "#FFF";
	pbt.innerHTML = "Completado 100 %";
	pbt2.innerHTML = "";

	if (event.target.responseText == "Bien") {
		$('#artAgregadoExitosoPromo').show(200).delay(1500).hide(200);
		setTimeout(function () {
			$('.form-control').removeClass('valid');
			$("#frmAgregarPromo")[0].reset();
			pb.style.width = "0%";
			pb.style.background = "#bbe0fc";
			pbt.style.color = "#000";
			pbt.innerHTML = "";
			$('#pbcAddPromo').hide();
			$(".btn-danger").attr("disabled",false);
			$(".btn-success").attr("disabled",false);
			$(".close").attr("disabled",false);
		}, 1700);
		cinicialpromo('');
	}
}

function errorHandlerAddPromo(event){
	_("statusAddPromo").innerHTML = "Carga fallida";
	$(".btn-danger").attr("disabled",false);
	$(".btn-success").attr("disabled",false);
	$(".close").attr("disabled",false);
}

function abortHandlerAddPromo(event){
	_("statusAddPromo").innerHTML = "Carga abortada";
	$(".btn-danger").attr("disabled",false);
	$(".btn-success").attr("disabled",false);
	$(".close").attr("disabled",false);
}

function editarpromo(id, tipo, nombre, url, rutaImg, activo) {
	var ruta = rutaImg.split("?");
	$("#mdEditarPromo").modal();
	if (ruta[0]!="") {
		$("#divImgEditPreviewPromo").show();
	} else {
		$("#divImgEditPreviewPromo").hide();
	}
	$("#tfIdEditPromo").val(id);
	$("#slcTipoEditPromo").val(tipo);
	nombre = nombre.replace(/&quoxyz/g, '"');
	nombre = nombre.replace(/&apoxyz/g, "'");
	$("#tfNombreEditPromo").val(nombre);
	url = url.replace(/&quoxyz/g, '"');
	url = url.replace(/&apoxyz/g, "'");
	$("#tfURLEditPromo").val(url);
	$("#ImgEditPreviewPromo").attr('src', rutaImg);
	$("#tfImgEditNamePromo").val(rutaImg);
	if (activo==1) {
		$("#chkActivoEditPromo").prop("checked",true);
	} else if (activo==0) {
		$("#chkActivoEditPromo").prop("checked",false);
	}
}

function modificarPromo(){
	_("statusEditPromo").innerHTML = "";
	$('#pbcEditPromo').show();
	var formdata = new FormData($("#frmEditarPromo")[0]);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandlerEditPromo, false);
	ajax.addEventListener("load", completeHandlerEditPromo, false);
	ajax.addEventListener("error", errorHandlerEditPromo, false);
	ajax.addEventListener("abort", abortHandlerEditPromo, false);
	ajax.open("POST", "addeditNotas.php");
	ajax.send(formdata);
	$(".btn-danger").attr("disabled",true);
	$(".btn-success").attr("disabled",true);
	$(".close").attr("disabled",true);
}

function progressHandlerEditPromo(event){
	var percent = (event.loaded / event.total) * 100;
	var pb = document.getElementById("pbEditPromo");
	var pbt = document.getElementById("pbtEditPromo");
	var pbt2 = document.getElementById("pbt2EditPromo");
	pb.style.width = Math.round(percent)+"%";
	pb.style.background = "#bbe0fc";
	pbt.style.color = "#000";
	pbt.innerHTML = "Subiendo " + Math.round(percent)+" %...";
	pbt2.innerHTML = "Subiendo " + event.loaded + " bytes de " + event.total;
}

function completeHandlerEditPromo(event){
	var pb = document.getElementById("pbEditPromo");
	var pbt = document.getElementById("pbtEditPromo");
	var pbt2 = document.getElementById("pbt2EditPromo");
	pb.style.background = "rgb(149, 183, 93)";
	pbt.style.color = "#FFF";
	pbt.innerHTML = "Completado 100 %";
	pbt2.innerHTML = "";
	
	if (event.target.responseText == "Bien") {
		$('#artEditadoExitosoPromo').show(200).delay(1500).hide(200);
		setTimeout(function () {
			$('.form-control').removeClass('valid');
			$("#mdEditarPromo").modal('hide');
			pb.style.width = "0%";
			pb.style.background = "#bbe0fc";
			pbt.style.color = "#000";
			pbt.innerHTML = "";
			$('#pbcEditPromo').hide();
			$(".btn-danger").attr("disabled",false);
			$(".btn-success").attr("disabled",false);
			$(".close").attr("disabled",false);
		}, 1700);
		cinicialpromo('');
	}
}

function errorHandlerEditPromo(event){
	_("statusEditPromo").innerHTML = "Carga fallida";
	$(".btn-danger").attr("disabled",false);
	$(".btn-success").attr("disabled",false);
	$(".close").attr("disabled",false);
}

function abortHandlerEditPromo(event){
	_("statusEditPromo").innerHTML = "Carga abortada";
	$(".btn-danger").attr("disabled",false);
	$(".btn-success").attr("disabled",false);
	$(".close").attr("disabled",false);
}

function eliminarpromo(id, rutaImg) {
	$("#mdConfirEliminarPromo").modal();
	$("#btnAcepDeletPromo").attr('data-id',id);
	$("#btnAcepDeletPromo").attr('data-rutaimg',rutaImg);
}

function confirEliminarPromo() {
	var Id = $("#btnAcepDeletPromo").attr('data-id');
	var RutaImg = $("#btnAcepDeletPromo").attr('data-rutaimg');
	$.ajax({
		url:"controlNotas.php",
		data:"opcion=eliminarpromo&Id=" + Id + "&RutaImg=" + RutaImg,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			if (resultados == "Bien") {
				$('#artEliminadoExitosoPromo').show(1).delay(1500).hide(1);
				setTimeout(function () {
					$("#btnAcepDeletPromo").removeAttr('data-id');
					$("#btnAcepDeletPromo").removeAttr('data-rutaimg');
					$("#mdConfirEliminarPromo").modal('hide');
				}, 1500);
				cinicialpromo('');
			}
		}
	});
}