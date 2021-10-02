

			<?php if($this->router->fetch_class() != 'login') { ?>
			<?php if(class_exists($this->router->fetch_class())) { ?>

				<footer class="main-footer">
        <div class="footer-left">
          <a href="http://alandiniz.com.br/">Alan Diniz</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>

			<?php } ?>
			<?php } ?>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo base_url('public/restrita/assets/js/app.min.js'); ?>"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?php echo base_url('public/restrita/assets/js/scripts.js'); ?>"></script>
  <!-- Custom JS File -->
  <script src="<?php echo base_url('public/restrita/assets/js/custom.js'); ?>"></script>
  <script src="<?php echo base_url('public/restrita/assets/js/util.js'); ?>"></script>
  <script src="<?php echo base_url('public/restrita/assets/bootbox/bootbox.min.js'); ?>"></script>



	<?php if(isset($scripts)){ ?>
	
	<?php foreach($scripts as $script){ ?>
		
<!-- Carregando os scripts dinamicamente pelo controller usuarios -->

    <script src="<?php echo base_url('public/restrita/' . $script); ?>"></script>


	<?php } ?>

<?php } ?>

<script>

	$('.delete').on('click', function(event){

		event.preventDefault();

		var redirect = $(this).attr('href');

		bootbox.confirm({
		
		title: $(this).attr('data-confirm'),
		centerVertical:true,
    message: "<p class='text-danger'>Está ação não poderá ser desfeita</p>",
    buttons: {
        confirm: {
            label: 'Sim',
            className: 'btn-success'
        },
        cancel: {
            label: 'Não, cancelar',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
        if(result){
					window.location.href = redirect;
				}
    }
});

	});


</script>

</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
