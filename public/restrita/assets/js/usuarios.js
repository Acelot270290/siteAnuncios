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

					if(!response.user_endereco){
						$('[name=user_endereco]').addClass('bg-white');
						$('[name=user_endereco]').prop('readonly', false);

					}

					if(!response.user_bairro){
						$('[name=user_bairro]').addClass('bg-white');
						$('[name=user_bairro]').prop('readonly', false);

					}

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

var envia_imagem_usuario = function(){

	$(document).on('change' , '[name="user_foto_file"]' , function (){

		var file_data = $('[name="user_foto_file"]').prop('files')[0];

		var form_data = new FormData();

		form_data.append('user_foto_file', file_data);

		
		$.ajax({

			type: "post",
			url: BASE_URL + 'restrita/usuarios/uploud_file',
			dataType: 'json',
			cache:false,
			contentType: false,
			processData:false,
			data: form_data,

			
			beforeSend: function(){
				//Definir disables e pagar erros de validação

				$('#user_foto').html('');

			},

			success: function (response){

				if(response.erro === 0){

					$('#box-foto-usuario').html("<input type='hidden' name='user_foto' value='"+ response.user_foto +"'> <img width='100' alt='Usuário imagem' src='" + BASE_URL + "/uplouds/usuarios/small" + response.user_foto +"' class='rounded-circle'>");
 

				}else{

					$('#user_foto').html(response.mensagem);

				}

			},

			error: function (response){

				$('#user_foto').html(response.mensagem);

			}


		});
		
	});

}

return{
	init: function(){
		preenche_endereco();
		envia_imagem_usuario();
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
