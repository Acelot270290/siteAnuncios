
    <header id="header-wrap">
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 col-md-5 col-xs-12">
						<?php $sistema = info_header_footer();?>

              <ul class="list-inline">
                <li><i class="lni-phone"></i> <?php echo $sistema->sistema_telefone_fixo; ?></li>
                <li><i class="lni-envelope"></i><?php echo $sistema->sistema_email; ?> </li>
              </ul>
            </div>
            <div class="col-lg-5 col-md-7 col-xs-12">

   
              <div class="header-top-right float-right">

							<?php $logado = $this->ion_auth->logged_in(); ?>

							<?php if(!$logado){ ?>

                <a href="<?php echo base_url('login'); ?>" class="header-top-button"><i class="lni-lock"></i> Login</a> |
								<a href="<?php echo base_url('registrar'); ?>" class="header-top-button"><i class="lni-pencil"></i> Registro</a>
								<?php }else{?>

									<?php $anunciante = $this->ion_auth->user()->row(); ?>

									<a href="<?php echo base_url('login/logout'); ?>" class="header-top-button"><i class="lni-shift-left"></i> sair</a> |
									<a title="Olá <?php echo $anunciante->first_name; ?> gerencie sua conta" href="<?php echo base_url('conta'); ?>" class="header-top-button"><img class="rounded-circle" width="30" src="<?php echo base_url('uploads/usuarios/small/'.$anunciante->user_foto); ?>"> Minha conta</a>

									<?php } ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg bg-white fixed-top scrolling-navbar">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="lni-menu"></span>
            <span class="lni-menu"></span>
            <span class="lni-menu"></span>
            </button>
            <a href="<?php echo base_url('/'); ?> " class="navbar-brand"><img src="<?php echo base_url('public/web/assets/img/logo.png'); ?>" alt=""></a>
          </div>
          <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav mr-auto w-100 justify-content-center">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/'); ?>">
                Home
                </a>
              </li>

							<?php $categorias = categorias_filhas_navbar(); ?>

							<?php foreach($categorias as $categoria){ ?>




              <li class="nav-item">
                <a title="<?php echo $categoria->categoria_nome; ?>" class="nav-link" href="<?php echo base_url('busca/categoria/'.$categoria->categoria_meta_link); ?>">
                <?php echo $categoria->categoria_nome; ?>
                </a>
              </li>

							<?php } ?>

            </ul>
            <div class="post-btn">
              <a class="btn btn-common" href="<?php echo base_url('conta') ?>"><i class="lni-pencil-alt"></i> Anunciar</a>
            </div>
          </div>
        </div>
        <ul class="mobile-menu">
          <li>
            <a href="<?php echo base_url('/'); ?>">
            Home
            </a>
            
          </li>

					<?php $categorias = categorias_filhas_navbar(); ?>

				<?php foreach($categorias as $categoria){ ?>

					<li>
                <a title="<?php echo $categoria->categoria_nome; ?>" class="nav-link" href="<?php echo base_url('busca/categoria/'.$categoria->categoria_meta_link); ?>">
                <?php echo $categoria->categoria_nome; ?>
                </a>
              </li>

					<?php } ?>

					<?php if(!$logado){ ?>

<a href="<?php echo base_url('login'); ?>" class="header-top-button">Login</a> |
<a href="<?php echo base_url('registrar'); ?>" class="header-top-button"><i class="lni-pencil"></i> Registro</a>
<?php }else{?>

	<?php $anunciante = $this->ion_auth->user()->row(); ?>
	<a title="Olá <?php echo $anunciante->first_name; ?> gerencie sua conta" href="<?php echo base_url('conta'); ?>" class="header-top-button"><img class="rounded-circle" width="30" src="<?php echo base_url('uploads/usuarios/small/'.$anunciante->user_foto); ?>"> Minha conta</a>
	<a href="<?php echo base_url('login/logout'); ?>" class="header-top-button"> sair</a> |
	

	<?php } ?>
    
          <li>
            <a href="#">Blog</a>
            <ul class="dropdown">
              <li><a href="blog.html">Blog - Right Sidebar</a></li>
              <li><a href="blog-left-sidebar.html">Blog - Left Sidebar</a></li>
              <li><a href="blog-grid-full-width.html"> Blog full width </a></li>
              <li><a href="single-post.html">Blog Details</a></li>
            </ul>
          </li>
        
        </ul>
      </nav>
      <div id="hero-area">
        <div class="overlay"></div>
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
              <div class="contents-ctg">
                <div class="search-bar">
                  <div class="search-inner ui-widget">
                    <form class="search-form" method="POST" action="<?php echo base_url('busca'); ?>">
                      <div class="form-group inputwithicon" style="width: 70%;">
                        <input type="text" name="busca" id="busca" class="form-control" placeholder="Qual produto você está procurando?">
                      </div>

                      <button class="btn btn-common" type="submit"><i class="lni-search"></i> Pesquisar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
