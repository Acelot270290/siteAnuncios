<?php $this->load->view('web/layout/navbar'); ?>
<div id="content" class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
        <aside>
          <div class="sidebar-box">
            <div class="user">
              <figure>
                <img width="80" src="<?php echo base_url('uploads/usuarios/small/'. $anunciante->user_foto); ?>"alt="">
              </figure>
              <div class="usercontent">
                <h3>Olá <?php echo $anunciante->first_name; ?></h3>
                <h4>Anunciante</h4>
              </div>
            </div>
            <nav class="navdashboard">
              <ul>
                <li>
                  <a href="<?php echo base_url('conta'); ?>">
                  <i class="lni-dashboard"></i>
                  <span>Dashboard</span>
                  </a>
                </li>
                <li>
                  <a href="account-profile-setting.html">
                  <i class="lni-cog"></i>
                  <span>Profile Settings</span>
                  </a>
                </li>
                <li>
                  <a href="account-myads.html">
                  <i class="lni-layers"></i>
                  <span>My Ads</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                  <i class="lni-envelope"></i>
                  <span>Offers/Messages</span>
                  </a>
                </li>
                <li>
                  <a href="payments.html">
                  <i class="lni-wallet"></i>
                  <span>Payments</span>
                  </a>
                </li>
                <li>
                  <a href="account-favourite-ads.html">
                  <i class="lni-heart"></i>
                  <span>My Favourites</span>
                  </a>
                </li>
                <li>
                  <a href="account-profile-setting.html">
                  <i class="lni-star"></i>
                  <span>Privacy Settings</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                  <i class="lni-enter"></i>
                  <span>Logout</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </aside>
      </div>
      <div class="col-sm-12 col-md-8 col-lg-9">
        <div class="row page-content">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="inner-box">
              <div class="dashboard-box">
                <h2 class="dashbord-title">Meus Dados</h2>
              </div>
              <div class="dashboard-wrapper">
                <div class="form-group mb-3">
                  <label class="control-label">Nome Completo:</label>
						<p class="mb-3"><?php echo $anunciante->first_name .' '.$anunciante->last_name;  ?></p>
                  <label class="control-label">Anunciante desde:</label>
						<p class="mb-3"><?php echo date('d/m/y'.strtotime($anunciante->created_on)); ?></p>
						<label class="control-label">Endereço:</label>
						<p class="mb-3">CEP: <?php echo $anunciante->user_cep .' - '. $anunciante->user_endereco .' - ' .$anunciante->user_numero_endereco;  ?><br>
					<?php echo $anunciante->user_bairro .' - ' .$anunciante->user_cidade. ' - '.$anunciante->user_estado; ?></p>
					<label class="control-label">Anúncios Cadastrados:</label>
					<p class="mb-3 badge badge-info"><?php echo $total_anuncios_cadastrados; ?></p>
					</div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
