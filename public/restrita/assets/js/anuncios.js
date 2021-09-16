$('#master').on('change',function(){

var anuncio_categoria_pai_id = $(this).val();

if(anuncio_categoria_pai_id){

	/*
	*Foi escolhida a categoria principal agora foi passada para o ajax request
	*/

	$.ajax({

		type: 'POST',
		url: BASE_URL + 'restrita/anuncios/get_categorias_filhas',
		dataType: 'json',
		data: {
			anuncio_categoria_pai_id : anuncio_categoria_pai_id,
		},
		success:function (data){
			/*
			*Renderizamos no Select optiom um texto para o user
			*/
			$('#anuncio_categoria').html('<option value="">Escollha uma Subcategoria...</option>');

			if(data){
				//categoria filhas encontradas, renderizamos as mesmas para o admin ou anunciante
				$(data).each(function(){
					var option = $('<option />');
					//na variavel setamos o atributo value o id da categoria filha
					option.attr('value', this.categoria_id).text(this.categoria_nome);
					$('#anuncio_categoria').append(option);
				});
			}else{
				
				//se caiu aqui nao existe na base de dados uma subcategoria atrelada na categoria pai
			$('#anuncio_categoria').html('<option value="">Subcategoria não encontrada...</option>');
			}

			
		}
	});

	}else{
	/*
	*Se caiu aqui porque nao foi escolhida nenhuma categoria principal
	rederizamos <option>Escollha uma categoria principal</option>
	*/
	$('#anuncio_categoria').html('<option value="">Escollha uma categoria principal</option>');

}

});

$('[name=anuncio_localizacao_cep]').focusout( function(){

var anuncio_localizacao_cep = $(this).val();

$.ajax({


	type: 'POST',
	url: BASE_URL + 'restrita/anuncios/valida_anuncio_localizacao_cep',
	dataType: 'json',
	data: {
		anuncio_localizacao_cep : anuncio_localizacao_cep,
	},

	beforeSend: function(){

		$('#anuncio_localizacao_cep').html('<i class="fas fa-cog fa-spin text-info"></i>&nbsp;Consultando CEP...')
	},

	success:function (response){

		if(response.erro === 0){

			$('#anuncio_localizacao_cep').html(response.anuncio_localizacao_cep);

		}else{

			$('#anuncio_localizacao_cep').html(response.anuncio_localizacao_cep);


		}

	},

	error: function(){

		$('#anuncio_localizacao_cep').html('Não foi possivel consultar seu CEP, Tente novamente dentro de alguns minutos');


	}


});

});
