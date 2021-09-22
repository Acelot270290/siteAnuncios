<footer>
      <section class="footer-Content">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
              <div class="widget">
                <div class="footer-logo"><img src="<?php echo base_url('public/web/assets/img/logo.png'); ?> " alt=""></div>
                <div class="textwidget">
                  <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt consectetur, adipisci velit.</p>
                </div>
                <ul class="mt-3 footer-social">
                  <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                  <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>                  <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Páginas</h3>
                <ul class="menu">
                  <li><a href="#">- About Us</a></li>
                  <li><a href="#">- Blog</a></li>
                  <li><a href="#">- Events</a></li>
                  <li><a href="#">- Shop</a></li>
                  <li><a href="#">- FAQ's</a></li>
                  <li><a href="#">- About Us</a></li>
                  <li><a href="#">- Blog</a></li>
                  <li><a href="#">- Events</a></li>
                  <li><a href="#">- Shop</a></li>
                  <li><a href="#">- FAQ's</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Contato</h3>

								<?php $sistema = info_header_footer();?>
                <ul class="contact-footer">
                  <li>
                    <strong><i class="lni-phone"></i></strong><span><?php echo $sistema ->sistema_telefone_fixo; ?> <br> <?php echo $sistema ->sistema_telefone_movel; ?></span>
                  </li>
                  <li>
                    <strong><i class="lni-envelope"></i></strong><span><?php echo $sistema->sistema_email; ?></span>
                  </li>
                  <li>
                    <strong><i class="lni-map-marker"></i>CEP: &nbsp;</strong><span><?php echo  $sistema->sistema_cep .' - ' . $sistema->sistema_endereco . ' ' . $sistema->sistema_numero  ; ?><br><?php echo $sistema->sistema_bairro . ' - ' . $sistema->sistema_cidade . ' - ' . $sistema->sistema_estado; ?></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div id="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="site-info text-center">
                <p><a target="_blank" href="https://templateshub.net">Templates Hub</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <a href="#" class="back-to-top">
    <i class="lni-chevron-up"></i>
    </a>
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>

	</script><script src="<?php echo base_url('public/web/'); ?>assets/js/jquery-min.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/waypoints.min.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/wow.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/jquery.slicknav.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/main.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/form-validator.min.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/contact-form-script.min.js"></script>
    <script src="<?php echo base_url('public/web/'); ?>assets/js/summernote.js"></script>
  	<script src="<?php echo base_url('public/restrita/assets/js/util.js'); ?>"></script>
  	<script src="<?php echo base_url('public/restrita/assets/bootbox/bootbox.min.js'); ?>"></script>


	<?php if(isset($scripts)){ ?>
	
	<?php foreach($scripts as $script){ ?>
		
<!-- Carregando os scripts dinamicamente pelo controller usuarios -->

    <script src="<?php echo base_url('public/restrita/' . $script); ?>"></script>


	<?php } ?>

<?php } ?>

<script>

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});


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
</html>
