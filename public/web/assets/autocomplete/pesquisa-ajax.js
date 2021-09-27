$(document).ready(function (){

	$('#busca').autocomplete({

		source: function (request, response){

			$.ajax({

				URL: BASE_URL + 'busca/busca_ajax',
				type: 'post',
				dataType: 'json',
				data:'busca='+ request.term,
				success: function (data){

					if(data.response == "false"){

						var result = [{

							label: 'Infezlimente não encontramos o que está procurando...',
							value: response.term

						}];

						response(result);
					}else{

						response(data.message);
					}

				}, // fim success


			});//fim ajax


		},// fim source

		minLength: 1,
		select: function (event, ui){

			if(ui.item.value === 'Infezlimente não encontramos o que está procurando...'){

				return false;

			}else{

				$('#busca').val(ui.item.value);
				$(event.target.form).submit(); //Submite o formulario quando loica em um inmtem no select

			}

		},// fim select



	});//fim busca

});//fim
