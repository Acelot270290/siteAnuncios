<div class="main-wrapper main-wrapper-1">
<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>
<!-- Main Content -->
<div class="main-content">
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
										<?php if($mensagem = $this->session->flashdata('sucesso')){ ?>

						<div class="alert alert-success text-white alert-dismissible show fade">
								<div class="alert-body">
									<button class="close" data-dismiss="alert">
										<span>&times;</span>
									</button>
									<?php echo $mensagem ?>
								</div>
							</div>

							<?php } ?>

							<?php if($mensagem = $this->session->flashdata('erro')){ ?>

							<div class="alert alert-danger text-white alert-dismissible show fade">
								<div class="alert-body">
									<button class="close" data-dismiss="alert">
										<span>&times;</span>
									</button>
									<?php echo $mensagem ?>
								</div>
							</div>

							<?php } ?>
          <form method="POST" name="form_index">
            <div class="card-header">
              <h4> <?php echo $titulo; ?> </h4>
            </div>
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Razão Social</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="sistema_razao_social" value="<?php echo (isset($sistema) ? $sistema->sistema_razao_social : set_value('sistema_razao_social')); ?>">
                  </div>
                  <?php echo form_error('sistema_razao_social', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-4">
                  <label>Nome Fantasia</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-heading text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="sistema_nome_fantasia" value="<?php echo (isset($sistema) ? $sistema->sistema_nome_fantasia : set_value('sistema_nome_fantasia')); ?>">
                  </div>
                  <?php echo form_error('sistema_nome_fantasia', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-4">
                  <label>CNPJ</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control cnpj" name="sistema_cnpj" value="<?php echo (isset($sistema) ? $sistema->sistema_cnpj : set_value('sistema_cnpj')); ?>">
                  </div>
                  <?php echo form_error('sistema_cnpj', '<div class="text-danger">','</div>'); ?>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Inscrição Estadual</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-id-card text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="sistema_ie" value="<?php echo (isset($sistema) ? $sistema->sistema_ie : set_value('sistema_ie')); ?>">
                  </div>
                  <?php echo form_error('sistema_ie', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-4">
                  <label>Telefone fixo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-phone text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control phone_with_ddd" name="sistema_telefone_fixo" value="<?php echo (isset($sistema) ? $sistema->sistema_telefone_fixo : set_value('sistema_telefone_fixo')); ?>">
                  </div>
                  <?php echo form_error('sistema_telefone_fixo', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-4">
                  <label>Telefone celular</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-mobile text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control sp_celphones" name="sistema_telefone_movel" value="<?php echo (isset($sistema) ? $sistema->sistema_telefone_movel : set_value('sistema_telefone_movel')); ?>">
                  </div>
                  <?php echo form_error('sistema_telefone_movel', '<div class="text-danger">','</div>'); ?>
                </div>
              </div>
              <div class="form-row">

							<div class="form-group col-md-6">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-envelope text-info"></i>
                      </div>
                    </div>
                    <input type="email" class="form-control" name="sistema_email" value="<?php echo (isset($sistema) ? $sistema->sistema_email : set_value('sistema_email')); ?>">
                  </div>
                  <?php echo form_error('sistema_email', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-6">
                  <label>Título do Site</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-heading text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="sistema_site_titulo" value="<?php echo (isset($sistema) ? $sistema->sistema_site_titulo : set_value('sistema_site_titulo')); ?>">
                  </div>
                  <?php echo form_error('sistema_site_titulo', '<div class="text-danger">','</div>'); ?>
                </div>
              </div>
							<div class="form-row">
							<div class="form-group col-md-4">
                  <label>CEP</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-map-marker-alt text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control cep" name="sistema_cep" value="<?php echo (isset($sistema) ? $sistema->sistema_cep : set_value('sistema_cep')); ?>">
                  </div>
                  <?php echo form_error('sistema_cep', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-4">
                  <label>Endereço</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-road text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="sistema_endereco" value="<?php echo (isset($sistema) ? $sistema->sistema_endereco : set_value('sistema_endereco')); ?>">
                  </div>
                  <?php echo form_error('sistema_endereco', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-4">
                  <label>Número</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-street-view text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="sistema_numero" value="<?php echo (isset($sistema) ? $sistema->sistema_numero : set_value('sistema_numero')); ?>">
                  </div>
                  <?php echo form_error('sistema_numero', '<div class="text-danger">','</div>'); ?>
                </div>
							</div>
							<div class="form-row">
							<div class="form-group col-md-4">
                  <label>Bairro</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-directions text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="sistema_bairro" value="<?php echo (isset($sistema) ? $sistema->sistema_bairro : set_value('sistema_bairro')); ?>">
                  </div>
                  <?php echo form_error('sistema_bairro', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-4">
                  <label>Cidade</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-location-arrow text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="sistema_cidade" value="<?php echo (isset($sistema) ? $sistema->sistema_cidade : set_value('sistema_cidade')); ?>">
                  </div>
                  <?php echo form_error('sistema_cidade', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-4">
                  <label>Estado</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-map text-info"></i>
                      </div>
                    </div>

										<select class="custom-select" name="sistema_estado">
												<option value="AC" <?php echo ($sistema->sistema_estado == 'AC' ? 'selected' : ''); ?>>Acre</option>
												<option value="AL" <?php echo ($sistema->sistema_estado == 'AL' ? 'selected' : ''); ?>>Alagoas</option>
												<option value="AP" <?php echo ($sistema->sistema_estado == 'AP' ? 'selected' : ''); ?>>Amapá</option>
												<option value="AM" <?php echo ($sistema->sistema_estado == 'AM' ? 'selected' : ''); ?>>Amazonas</option>
												<option value="BA" <?php echo ($sistema->sistema_estado == 'BA' ? 'selected' : ''); ?>>Bahia</option>
												<option value="CE" <?php echo ($sistema->sistema_estado == 'CE' ? 'selected' : ''); ?>>Ceará</option>
												<option value="DF" <?php echo ($sistema->sistema_estado == 'DF' ? 'selected' : ''); ?>>Distrito Federal</option>
												<option value="ES" <?php echo ($sistema->sistema_estado == 'ES' ? 'selected' : ''); ?>>Espírito Santo</option>
												<option value="GO" <?php echo ($sistema->sistema_estado == 'GO' ? 'selected' : ''); ?>>Goiás</option>
												<option value="MA" <?php echo ($sistema->sistema_estado == 'MA' ? 'selected' : ''); ?>>Maranhão</option>
												<option value="MT" <?php echo ($sistema->sistema_estado == 'MT' ? 'selected' : ''); ?>>Mato Grosso</option>
												<option value="MS" <?php echo ($sistema->sistema_estado == 'MS' ? 'selected' : ''); ?>>Mato Grosso do Sul</option>
												<option value="MG" <?php echo ($sistema->sistema_estado == 'MG' ? 'selected' : ''); ?>>Minas Gerais</option>
												<option value="PA" <?php echo ($sistema->sistema_estado == 'PA' ? 'selected' : ''); ?>>Pará</option>
												<option value="PB" <?php echo ($sistema->sistema_estado == 'PB' ? 'selected' : ''); ?>>Paraíba</option>
												<option value="PR" <?php echo ($sistema->sistema_estado == 'PR' ? 'selected' : ''); ?>>Paraná</option>
												<option value="PE" <?php echo ($sistema->sistema_estado == 'PE' ? 'selected' : ''); ?>>Pernambuco</option>
												<option value="PI" <?php echo ($sistema->sistema_estado == 'PI' ? 'selected' : ''); ?>>Piauí</option>
												<option value="RJ" <?php echo ($sistema->sistema_estado == 'RJ' ? 'selected' : ''); ?>>Rio de Janeiro</option>
												<option value="RN" <?php echo ($sistema->sistema_estado == 'RN' ? 'selected' : ''); ?>>Rio Grande do Norte</option>
												<option value="RS" <?php echo ($sistema->sistema_estado == 'RS' ? 'selected' : ''); ?>>Rio Grande do Sul</option>
												<option value="RO" <?php echo ($sistema->sistema_estado == 'RO' ? 'selected' : ''); ?>>Rondônia</option>
												<option value="RR" <?php echo ($sistema->sistema_estado == 'RR' ? 'selected' : ''); ?>>Roraima</option>
												<option value="SC" <?php echo ($sistema->sistema_estado == 'SC' ? 'selected' : ''); ?>>Santa Catarina</option>
												<option value="SP" <?php echo ($sistema->sistema_estado == 'SP' ? 'selected' : ''); ?>>São Paulo</option>
												<option value="SE" <?php echo ($sistema->sistema_estado == 'SE' ? 'selected' : ''); ?>>Sergipe</option>
												<option value="TO" <?php echo ($sistema->sistema_estado == 'TO' ? 'selected' : ''); ?>>Tocantins</option>
										</select>


                  </div>
                  <?php echo form_error('sistema_estado', '<div class="text-danger">','</div>'); ?>
                </div>

							</div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Home da área restrita -->
    </div>
</section>
<div class="settingSidebar">
<a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
</a>
<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>
</div>
</div>
