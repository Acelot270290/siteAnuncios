<?php $this->load->view('web/layout/navbar'); ?>
<div id="content" class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">

			<?php $this->load->view('web/conta/sidebar'); ?>
      </div>
      <div class="col-sm-12 col-md-8 col-lg-9">
        <div class="row page-content">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
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
