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

	$(document).on('click','.fileinput-remove',function() {
		if ($("#tfDocEdit").val()!="") {
			$("#divImgEditPreview").hide();
		} else {
			$("#divImgEditPreview").show();
		}
	});

	$("#tfDocEdit").change(function() {
		if ($("#tfDocEdit").val()!="") {
			$("#divImgEditPreview").hide();
		} else {
			$("#divImgEditPreview").show();
		}
	});
});

$(function () {
	frmAgregar = $("#frmAgregar").validate({
		ignore: [],
		rules: {
			NivelAdd: { required: true },
			TipoFormatoAdd: { required: true },
			NombreAdd: { required: true, maxlength: 100 },
			DocAdd: { required: true }
		}
	});

	frmEditar = $("#frmEditar").validate({
		ignore: [],
		rules: {
			NombreEdit: { required: true, maxlength: 100 }
		}
	});

	$("#tfDocAdd").fileinput({
		language: 'es',
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-default",
		removeClass: "btn btn-danger",
		fileType: "any"
	});

	$("#tfDocEdit").fileinput({
		language: 'es',
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-default",
		removeClass: "btn btn-danger",
		fileType: "any"
	});

	$("#kvFileinputModal").on('hidden.bs.modal', function (e) {
		$('body').addClass('modal-open');
	});
});

function cinicial(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"controlEstadia.php",
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
	rutaImg = rutaImg.split(/[?]/g);
	var formato = rutaImg[0];
	formato = formato.substring(formato.length-4, formato.length);
	var arreglo = ['.jpg', '.png', 'jpeg', '.JPG', '.PNG', 'JPEG','.gif','.GIF'];
	if (arreglo.indexOf(formato) >= 0) {
		$("#imgDetail").attr('src',rutaImg[0] + "?" + rutaImg[1]);
		$("#docDetail").removeAttr('src');
		$("#docDetail").css('display','none');
		$("#imgDetail").css('display','');
	}
	else {
		$("#docDetail").attr('src',rutaImg[0] + "?" + rutaImg[1]);
		$("#imgDetail").removeAttr('src');
		$("#imgDetail").css('display','none');
		$("#docDetail").css('display','');
	}
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
	ajax.open("POST", "addeditEstadia.php");
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

function editar(idNota, nivel, formato, nombre, rutaDoc, activo) {
	$("#mdEditar").modal();
	$("#divImgEditPreview").show();
	$("#tfIdEdit").val(idNota);
	nombre = nombre.replace(/&quoxyz/g, '"');
	nombre = nombre.replace(/&apoxyz/g, "'");
	$("#tfNombreEdit").val(nombre);
	$("#slcNivelEdit").val(nivel);
	$("#slcTipoFormatoEdit").val(formato);
	$("#ImgEditPreview").attr('src', rutaDoc);
	$("#tfDocEditName").val(rutaDoc);
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
	ajax.open("POST", "addeditEstadia.php");
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
		url:"controlEstadia.php",
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

function cancelar() { location.href = "../"; }