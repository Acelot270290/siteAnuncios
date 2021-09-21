

$(".data-table").dataTable({

	"order":[], // Remover a ordenção do pluguin
  "columnDefs": [
    { "sortable": false, "targets": ['nosort'] } // criando a classe sem ordenação
  ]
});

$(".table-anuncios").dataTable({

	"language": {
		"url": "//cdn.datatables.net/plug-ins/1.11.2/i18n/pt_br.json",
	},
	"order":[], // Remover a ordenção do pluguin
	"lengthMenu":[[5,15,25,-1],[5,25,50,"All"]],
  "columnDefs": [
    { "sortable": false, "targets": ['nosort'] } // criando a classe sem ordenação
  ]
});

