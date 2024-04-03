$('document').ready(function(){

	// Inicio de sesión con ajax y php

	$('#login-ut').validate({
		rules:{
			email:{
				required: true,
				email: true
			},
			pass:{
				required: true,
				minlength: 7
			}
		},
		messages:{
			email:{
				required: "porfavor completa este campo",
				email: "Ingrese un email válido"
			},
			pass:{
				required: "por favor completa este campo",
				minlength: "La contraseña debe de ser mas de 6 caracteres"
			}
		},
		functionerrorElement: "em",
		errorPlacement: function ( error, element ){

			error.addClass( "help-block" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element.next() );
			}
		},

		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
		},

		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
		}

	});

	var $botoni = $('#btn-login'),
        $from = $('#login-ut'),
        $carg = $('.cargador-login'),
        $alerta = $('.alerta-login'),
        $alertacon = $('.info-error');

	$botoni.on('click', function(){

		if($('#login-ut').valid()){
			
			var datos = $from.serialize(),
	        url = 'lib/controllogin.php';
		    $.ajax({
		        type: "POST",
		        url: url,
		        data: datos,
		        dataType: 'json',
		        beforeSend: function() {
		            $carg.css({display: 'block'});
		        },
		        complete: function (){
		            $carg.css({display: 'none'});
		        },
		        success: function(respuesta) {
		            if(respuesta.error){
		                $alerta.fadeIn();
		                $alertacon.html(respuesta.tipoError);
		                $alerta.fadeOut(9000);
		            } else {
		                $(location).attr( 'href', 'admin/' );
		            }
		        },
		        error: function (e){
		            console.log(e);
		        }
		    });

		}
    	
	});

	// Registrar usuarios ajax y php

	$('#from-registro').validate({
		rules:{
			nombre: "required",
			apellidos: "required",
			email:{
				required: true,
				email: true
			},
			pass:{
				required: true,
				minlength: 7
			},
			confirpass: {
				required: true,
				minlength: 7,
				equalTo: "#pass"
			},
			tipou: {
				required: true
			},
			cargo: "required",
			sexo: "required",
			tel: {
				required: true,
				number: true,
				minlength:10,
        		maxlength:10
			}
		},
		messages:{
			nombre: "por favor completa este campo",
			apellidos: "por favor completa este campo",
			email:{
				required: "porfavor completa este campo",
				email: "Ingrese un email válido"
			},
			pass:{
				required: "por favor completa este campo",
				minlength: "La contraseña debe de ser mas de 6 caracteres"
			},
			confirpass:{
				required: "por favor completa este campo",
				minlength: "La contraseña debe de ser mas de 6 caracteres",
				equalTo: "La contraseña no coincide"
			},
			tipou: "Selecione una opción",
			cargo: "por favor completa este campo",
			sexo: "Selecione una opción",
			tel: {
				required: "por favor completa este campo",
				number: "ingrese solo números",
				minlength:"ingrese slo 10 digitos",
        		maxlength:"ingrese slo 10 digitos"
			}
		},

		functionerrorElement: "em",
		errorPlacement: function ( error, element ){

			error.addClass( "help-block" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element.next() );
			}
		},

		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
		},

		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
		}
	});

	var $botoni_r = $('#btn-registro'),
    $from_r = $('#from-registro'),
    $carg_r = $('.cargador-regitro'),
    $alerta_r = $('.alerta-regitro'),
    $alertacon_r = $('.info-error');

    $botoni_r.on('click', function(){

    	if($('#from-registro').valid()){

    		var datos_r = $from_r.serialize(),
		    url_r = '/lib/registro.php';

			$.ajax({
			    type: "POST",
			    url: url_r,
			    data: datos_r,
			    dataType: 'json',
			    beforeSend: function() {
			        $carg_r.css({display: 'block'});
			    },
			    complete: function (){
			        $carg_r.css({display: 'none'});
			    },
			    success: function(respuesta) {
			        if(respuesta.error){
			        	$('div#alertas').addClass("alert-danger").removeClass("alert-info");
			            $alerta_r.fadeIn();
			            $alertacon_r.html(respuesta.tipoError);
			            $alerta_r.fadeOut(11000);
			        }else if(respuesta.success){
			        	$('div#alertas').addClass("alert-info").removeClass("alert-danger");
			            $alerta_r.fadeIn();
			            $alertacon_r.html(respuesta.tipo);
			            $alerta_r.fadeOut(12000);
			        }
			    },
			    error: function (e){
			        console.log(e);
			    }
			});
    	}
    });
	
});
