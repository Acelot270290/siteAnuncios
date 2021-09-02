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


			},

			success: function (response){

				alert(response.mensagem)

			},

			error: function (response){

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
