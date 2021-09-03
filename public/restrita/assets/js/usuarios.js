var App_usuarios = function (){

var preenche_endereco = function(){

	$('[name=user_cep]').focusout(function (){

		var user_cep = $(this).val();

		$.ajax({

			type: "post",
			url: BASE_URL + 'restrita/usuarios/preenche_endereco',
			dataType: 'json',
			data: {user_cep: user_cep},
			beforeSend: function(){
				//Definir disables e pagar erros de validação

				$('#user_cep').html('Consultando o CEP');

			},

			success: function (response){

				if(response.erro ===0){

					$('#user_cep').html('');

					$('[name=user_endereco]').val(response.user_endereco);
					$('[name=user_bairro]').val(response.user_bairro);
					$('[name=user_cidade]').val(response.user_cidade);
					$('[name=user_estado]').val(response.user_estado);

				}

			},

			error: function (response){

				$('#user_cep').html(responder.mensagem);

			}


		});
		
	});

}

return{
	init: function(){
		preenche_endereco();
	}
}

}();//inicializar ao carregar a view

jQuery(document).ready(function () {

	$(window).keydown(function (event) {

		if (event.keyCode == 13){
			event.preventDefault();
			
			return false;		
		}
	});

	App_usuarios.init();

});
