<?php $this->load->view('web/layout/navbar');?>
<div id="content" class="section-padding">
  <div class="container">
    <div class="row">

      <div class="col-sm-12 col-md-8 col-lg-9">
        <div class="row page-content">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="inner-box">
              <div class="dashboard-box">
                <h2 class="dashbord-title"><?php echo $titulo; ?></h2>
              </div>
              <div class="dashboard-wrapper">
                <div class="row justify-content-center">
                    <div class="login-form login-area">
                      
                      <form role="form" class="login-form" method="POST" action="<?php echo base_url('registrar'); ?>">

											<?php if($mensagem = $this->session->flashdata('sucesso')){ ?>

													<div class="alert alert-success bg-success text-white alert-dismissible show fade">
															<div class="alert-body">
																<button class="close" data-dismiss="alert">
																	<span>&times;</span>
																</button>
																<?php echo $mensagem ?>
															</div>
														</div>

														<?php } ?>

														<?php if($mensagem = $this->session->flashdata('erro')){ ?>

														<div class="alert alert-danger bg-danger text-white alert-dismissible show fade">
															<div class="alert-body">
																<button class="close" data-dismiss="alert">
																	<span>&times;</span>
																</button>
																<?php echo $mensagem ?>
															</div>
														</div>

																	<?php } ?>

											<div class="form-row">

											<div class="form-group col-md-6">
                          <div class="input-icon">
                            <i class="lni-user"></i>
														<input type="text" class="form-control" name="first_name" placeholder="Nome" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')); ?>">
													</div>
													<?php echo form_error('first_name', '<div class="text-danger">','</div>'); ?>
                        </div>
												<div class="form-group col-md-6">
                          <div class="input-icon">
                            <i class="lni-user"></i>
														<input type="text" class="form-control" name="last_name" placeholder="Sobrenome" value="<?php echo (isset($usuario) ? $usuario->last_name : set_value('last_name')); ?>">
													</div>
													<?php echo form_error('last_name', '<div class="text-danger">','</div>'); ?>
                        </div>

											</div>
											<div class="form-row">

										<div class="form-group col-md-4">
                  <label>CPF</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-bookmark-alt"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control cpf" name="user_cpf" placeholder="CPF" value="<?php echo (isset($usuario) ? $usuario->user_cpf : set_value('user_cpf')); ?>">
                  </div>
				  <?php echo form_error('user_cpf', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-4">
                  <label>Telefone</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-phone"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control sp_celphones" name="phone" placeholder="Telefone" value="<?php echo (isset($usuario) ? $usuario->phone : set_value('phone')); ?>">
                  </div>
				  <?php echo form_error('phone', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-4">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-envelope"></i>
                      </div>
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')); ?>">
                  </div>
				  <?php echo form_error('email', '<div class="text-danger">','</div>'); ?>
                </div>

											</div>
											<div class="form-row">
											<div class="form-group col-md-3">
                  <label>CEP</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-pin"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control cep" name="user_cep" placeholder="CEP" value="<?php echo (isset($usuario) ? $usuario->user_cep : set_value('user_cep')); ?>">
                  </div>
				  <?php echo form_error('user_cep', '<div class="text-danger">','</div>'); ?>
					<div id="user_cep"></div>
                </div>
								<div class="form-group col-md-6">
                  <label>Endereço</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-home"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="user_endereco" placeholder="Endereço" value="<?php echo (isset($usuario) ? $usuario->user_endereco : set_value('user_endereco')); ?>" readonly=''>
                  </div>
				  <?php echo form_error('user_endereco', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-3">
                  <label>Número</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-arrow-right-circle"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="user_numero_endereco" placeholder="Número" value="<?php echo (isset($usuario) ? $usuario->user_numero_endereco : set_value('user_numero_endereco')); ?>">
                  </div>
				  <?php echo form_error('user_numero_endereco', '<div class="text-danger">','</div>'); ?>
                </div>
											</div>
											<div class="form-row">
											<div class="form-group col-md-3">
											<label>Bairro</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-arrow-right"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="user_bairro" placeholder="Bairro" value="<?php echo (isset($usuario) ? $usuario->user_bairro : set_value('user_bairro')); ?>" readonly=''>
                  </div>
				  <?php echo form_error('user_bairro', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-6">
								<label>Cidade</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-map"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="user_cidade" placeholder="Cidade" value="<?php echo (isset($usuario) ? $usuario->user_cidade : set_value('user_cidade')); ?>" readonly=''>
                  </div>
				  <?php echo form_error('user_cidade', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-3">
								<label>Estado</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-map-marker"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control uf" placeholder="Estado" name="user_estado" value="<?php echo (isset($usuario) ? $usuario->user_estado : set_value('user_estado')); ?>" readonly=''>
                  </div>
				  <?php echo form_error('user_estado', '<div class="text-danger">','</div>'); ?>
                </div>
											</div>
											<div class="form-row">
											<div class="form-group col-md-6">
                  <label>Senha</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-lock"></i>
                      </div>
                    </div>
                    <input type="password" class="form-control" placeholder="Senha" name="password" value="">
                  </div>
				  						<?php echo form_error('password', '<div class="text-danger">','</div>'); ?>
                </div>
								<div class="form-group col-md-6">
                  <label>Confirma Senha</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-lock"></i>
                      </div>
                    </div>
                    <input type="password" class="form-control" placeholder="Confirma Senha" name="confirma_senha" value="">
                  </div>
				  						<?php echo form_error('confirma_senha', '<div class="text-danger">','</div>'); ?>
                </div>

											</div>
											<div class="form-row">
											<div class="form-group col-md-6">
                  <label>Avatar</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="lni-image"></i>
                      </div>
                    </div>
                    <input type="file" class="form-control" name="user_foto_file">
                  </div>
				  <?php echo form_error('user_foto', '<div class="text-danger">','</div>'); ?>
					<div id="user_foto"></div>
        </div> 
				<div class="form-group col-md-3">

<?php if(isset($usuario)){ ?>

	<div id="box-foto-usuario">

	<input type="hidden" name="user_foto" value="<?php echo $usuario->user_foto; ?>">
	<img width="80" alt="Usuário imagem" src="<?php echo base_url('uploads/usuarios/' . $usuario->user_foto); ?>" class="rounded-circle">
	</div>


	<?php }else{ ?>

		<div id="box-foto-usuario">

		</div>


		<?php } ?>

		<?php if(isset($usuario)){ //Validando o id do user ?>

			

	<input type="hidden" name="usuario_id" value="<?php echo $usuario->id; ?>">


			<?php } ?>
				 
</div> 
											</div>

                        <div class="text-center">
                          <button class="btn btn-common log-btn">Salvar</button>
                        </div>
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
