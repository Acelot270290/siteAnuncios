<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php $sistema = info_header_footer(); ?>

<title><?php echo $sistema->sistema_site_titulo. '&nbsp|&nbsp' . (isset($titulo) ? $titulo : 'Não deixe de anunciar'); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/css/bootstrap.min.css">
	<link href="<?php echo base_url('public/web/'); ?>assets/css/LineIcons-free.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/fonts/line-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/css/slicknav.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/css/color-switcher.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/'); ?>assets/autocomplete/jquery-ui.css">

	
<?php if(isset($styles)){ ?>
	
	<?php foreach($styles as $estilo){ ?>
		
<!-- Carregando os estilos dinamicamente pelo controller usuarios -->
		<link rel="stylesheet" href="<?php echo base_url('public/restrita/' . $estilo); ?>">


	<?php } ?>

<?php } ?>

		<style>
			#DataTables_Table_0_length {
				margin-left: 17px;
			}
			#DataTables_Table_0_length .form-control{
				padding: 0;
				padding-left: 10px;
			}

			.select2-container--default .select2-selection--single {
				border: 1px solid #e5e5e5;
				border-radius: 4px;
				font-weight: 400;
			}

			.select2-container .select2-selection--single{
				height: 30px;
			}

			.select2-container--default .select2-selection--single .select2-selection__rendered{
				line-height: 30px;
			}

			.select2-container--default .select2-selection--single .select2-selection__arrow{
				top: 5px;
			}

			@media screen and (max-width: 360px){
				.featured-box img{
					width: 100% !important;
				}
			}

		</style>


  </head>


  <body>
