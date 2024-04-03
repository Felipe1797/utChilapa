var tbl1;

$(document).ready(function (){
	
	$(document).on('click','#tbl1-select-all',function(){
		var rows = tbl1.rows({ 'search': 'applied' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
	});

	$(document).on("change", '#tbl1 tbody input[type="checkbox"]', function () {
		if(!this.checked){
			var el = $('#tbl1-select-all').get(0);
			if(el && el.checked && ('indeterminate' in el)){
				el.indeterminate = true;
			}
		}
	});
});

function cinicial(Vals) {
	var vals = Vals;
	
	$.ajax({
		url:"controlSuperUsuarios.php",
		data:"opcion=cinicial&vals=" + vals,
		type:"POST"
	}).done(function(resultados) {
		if (resultados != null && resultados != "") {
			$("#respuestaTabla").html(resultados);
			tbl1 = $('#tbl1').DataTable({
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
				"sPaginationType": "full_numbers",
				'columnDefs': [{
					'targets': 6,
					'searchable': false,
					'orderable': false,
					'className': 'dt-body-center',
					'render': function (data, type, full, meta){
						return '<input type="checkbox" name="eliminar[]" value="' + $('<div/>').text(data).html() + '">';
					}
				}]
			});
			$("[data-toggle='tooltip']").tooltip();
		} else {
		}
	});
}

function eliminar() {
	var checkboxes = tbl1.$('input[name="eliminar[]"]:checked'), values = [];
	Array.prototype.forEach.call(checkboxes, function(el) {
		values.push(el.value);
	});
	
	if (values!=null && values!="") {
		$("#mdConfirEliminar").modal();
	}
}

function delChoose() {
	var checkboxes = tbl1.$('input[name="eliminar[]"]:checked'), values = [];
	Array.prototype.forEach.call(checkboxes, function(el) {
		values.push(el.value);
	});
	
	if (values!=null && values!="") {
		$.ajax({
		url:"controlSuperUsuarios.php",
		data:"opcion=eliminar&vals=" + values.toString(),
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

	
}