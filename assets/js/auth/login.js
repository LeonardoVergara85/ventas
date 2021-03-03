
////// CAPTCHA DE SEGURIDAD ////////////////
var res;
var myCaptcha = new jCaptcha({
	resetOnError: true,
	callback: function(response, $captchaInputElement) {
		if (response == 'success') { 
			$captchaInputElement[0].classList.remove('captcha-error'); 
			$captchaInputElement[0].classList.add('captcha-success'); 
			$captchaInputElement[0].placeholder = 'Accediendo..'; 

			Login();
		} 

		if (response == 'error') { 
			$captchaInputElement[0].classList.remove('captcha-success'); 
			$captchaInputElement[0].classList.add('captcha-error'); 
			$captchaInputElement[0].placeholder = 'Incorrecto!'; 
		}
	}
});

$(document).ready(function() {

	document.getElementById('loginForm').autocomplete = 'off';
	$('#usuario').focus();
	$('canvas').css('background-color','darkgray');	 

	$( "#loginForm" ).submit(function( event ) {
		event.preventDefault();

		$('.alert-danger').hide();

		if($('#usuario').val() == '') {
			$('#lbl_msg').html('Ingrese nombre de usuario');
			$('.alert-danger').show();
			$('#usuario').focus();
			return;
		}

		if( $('#contrasena').val() == '' ) {
			$('#lbl_msg').html('Ingrese contraseña');
			$('.alert-danger').show();
			$('#contrasena').focus();
			return;
		}

		myCaptcha.validate();

	});

});

function Login() {

	$.ajax({

		type: "POST",
		url: "auth",
		dataType: 'json',
		data: {
			usuario: $('#usuario').val(),
			contrasenia: $('#contrasenia').val(),
		},
		success: function (resultado) {
			
			if(resultado.exito) {
				
				//alert('loguea');

				window.open(window.location.pathname+'/..', '_self');
				//window.location.href = "http://localhost/ventas/";

			} else if(resultado.error.mensaje == 'NoGrupo'){  //si no tiene grupo le avisa al usuario mediante un msj de modal

				$('#modal_error_sistema').modal('show');

			  } else{

					myCaptcha.reset();
					$('#inp_captcha').removeClass('captcha-ok');
					$('#inp_captcha').removeClass('captcha-error');
					$('#inp_captcha').val('');
					$('#inp_captcha').attr('placeholder','Ingresar resultado');

					$('.alert-danger').html(resultado.error.mensaje);
					$('.alert-danger').show('slow');
				
				}
		}
	});
}