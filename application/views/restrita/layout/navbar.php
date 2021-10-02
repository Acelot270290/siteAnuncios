<div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>

          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
  
          <li class="dropdown dropdown-list-toggle">

					<?php $anuncios_nao_editados = get_anuncios_nao_editados(); ?>
					<?php $contas_bloqueadas = get_contas_bloqueadas(); ?>

					<?php if($anuncios_nao_editados > 0 || $contas_bloqueadas > 0){ ?>

						<a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
						<i data-feather="bell" class="bell"></i>
            </a>

						<?php } ?>

            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notificações
              </div>

              <div class="dropdown-list-content dropdown-list-icons" style="height: 150px;">

							<?php if($anuncios_nao_editados > 0){ ?>

                <a href="<?php echo base_url('restrita/anuncios'); ?>" class="dropdown-item dropdown-item-unread"> <span class="dropdown-item-icon bg-danger text-white"> 
									<i class="fas fa-tags"></i>
                  </span> <span class="dropdown-item-desc"> Existem <?php echo $anuncios_nao_editados; ?> anúncio não editados <span class="time">Não deixe de verirficar</span>
                  </span>
                </a>

								<?php }  ?>

								<?php if($contas_bloqueadas > 0){ ?>

								<a href="<?php echo base_url('restrita/usuarios'); ?>" class="dropdown-item dropdown-item-unread"> <span class="dropdown-item-icon bg-warning text-white"> 
									<i class="fas fa-users"></i>
									</span> <span class="dropdown-item-desc"> Existem <?php echo $contas_bloqueadas; ?> contas bloqueadas <span class="time">Não deixe de verirficar</span>
									</span>
								</a>

								<?php }  ?>

              </div>
       
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 

							<?php $user = $this->ion_auth->user()->row();  ?>

							<img alt="<?php echo $user->first_name; ?>" src="<?php echo base_url('uploads/usuarios/small/'.$user->user_foto); ?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>

            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Olá <?php echo $user->first_name; ?></div>
              <a href="<?php echo base_url('restrita/usuarios/core/'. $user->id); ?>" class="dropdown-item has-icon"> <i class="far fa-user"></i> 
							Perfil
              </a> 
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('restrita/login/logout'); ?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Sair
              </a>
            </div>
          </li>
        </ul>
      </nav>
