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
		<form method="POST" name="form_core" accept-charset="utf-8" enctype="multipart/form-data">
          <div class="card-header">
            <h4> <?php echo $titulo; ?> </h4>
          </div>
          <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Nome</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="first_name" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('fisrt_name')); ?>">
                  </div>
				  <?php echo form_error('first_name', '<div class="text-danger">','</div>'); ?>
                </div>
				<div class="form-group col-md-6">
                  <label>Sobrenome</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="last_name" value="<?php echo (isset($usuario) ? $usuario->last_name : set_value('last_name')); ?>">
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
                        <i class="fas fa-id-card text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control cpf" name="user_cpf" value="<?php echo (isset($usuario) ? $usuario->user_cpf : set_value('user_cpf')); ?>">
                  </div>
				  <?php echo form_error('user_cpf', '<div class="text-danger">','</div>'); ?>
                </div>
				<div class="form-group col-md-4">
                  <label>Telefone</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-phone text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control sp_celphones" name="phone" value="<?php echo (isset($usuario) ? $usuario->phone : set_value('phone')); ?>">
                  </div>
				  <?php echo form_error('phone', '<div class="text-danger">','</div>'); ?>
                </div>
				<div class="form-group col-md-4">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-envelope text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')); ?>">
                  </div>
				  <?php echo form_error('email', '<div class="text-danger">','</div>'); ?>
                </div>
                
              </div>
			  <div class="form-row">
                <div class="form-group col-md-2">
                  <label>CEP</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-map-marker-alt text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control cep" name="user_cep" value="<?php echo (isset($usuario) ? $usuario->user_cep : set_value('user_cep')); ?>">
                  </div>
				  <?php echo form_error('user_cep', '<div class="text-danger">','</div>'); ?>
                </div>
				<div class="form-group col-md-3">
                  <label>Endereço</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-road text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="user_endereco" value="<?php echo (isset($usuario) ? $usuario->user_endereco : set_value('user_endereco')); ?>">
                  </div>
				  <?php echo form_error('user_endereco', '<div class="text-danger">','</div>'); ?>
                </div>
				<div class="form-group col-md-2">
                  <label>Número</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-street-view text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="user_numero_endereco" value="<?php echo (isset($usuario) ? $usuario->user_numero_endereco : set_value('user_numero_endereco')); ?>">
                  </div>
				  <?php echo form_error('user_numero_endereco', '<div class="text-danger">','</div>'); ?>
                </div>
				<div class="form-group col-md-2">
                  <label>Bairro</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-directions text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="user_bairro" value="<?php echo (isset($usuario) ? $usuario->user_bairro : set_value('user_bairro')); ?>">
                  </div>
				  <?php echo form_error('user_bairro', '<div class="text-danger">','</div>'); ?>
                </div>
				<div class="form-group col-md-2">
                  <label>Cidade</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-location-arrow text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="user_cidade" value="<?php echo (isset($usuario) ? $usuario->user_cidade : set_value('user_cidade')); ?>">
                  </div>
				  <?php echo form_error('user_cidade', '<div class="text-danger">','</div>'); ?>
                </div>
				<div class="form-group col-md-1">
                  <label>Estado</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-map text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control uf" name="user_estado" value="<?php echo (isset($usuario) ? $usuario->user_estado : set_value('user_estado')); ?>">
                  </div>
				  <?php echo form_error('user_estado', '<div class="text-danger">','</div>'); ?>
                </div> 
                
              </div>
			  <div class="form-row">  
				<div class="form-group col-md-2">
                  <label>Ativo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-check-circle text-info"></i>
                      </div>
                    </div>
                    <select class="custom-select" name="active">

						<?php if(isset($usuario)){ ?>

						<option value="0" <?php echo($usuario->active == 0 ? 'selected' : ''); ?>>Não</option>
						<option value="1" <?php echo($usuario->active == 1 ? 'selected' : ''); ?>>sim</option>
						<?php }else{ ?>

						<option value="0">Não</option>
						<option value="1">sim</option>

							<?php } ?>
					</select>
                  </div>
				  <?php echo form_error('active', '<div class="text-danger">','</div>'); ?>
                </div>  
				<div class="form-group col-md-3">
                  <label>Perfil de Acesso</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user-tie text-info"></i>
                      </div>
                    </div>
                    <select class="custom-select" name="perfil">

					<?php foreach($grupos as $grupo){ ?>

						<?php if(isset($usuario)){ ?>

							<option value="<?php echo $grupo->id; ?>" <?php echo ($perfil->id == $grupo->id ? 'selected' : ''); ?>><?php echo $grupo->description; ?></option>

						<?php }else{ ?>

						<option value="<?php echo $grupo->id; ?>"><?php echo $grupo->description; ?></option>

							<?php } ?>
					<?php } ?>
					</select>
                  </div>
				  <?php echo form_error('perfil', '<div class="text-danger">','</div>'); ?>
                </div>   

				<div class="form-group col-md-4">
                  <label>Avatar</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-image text-info"></i>
                      </div>
                    </div>
                    <input type="file" class="form-control" name="user_foto_file">
                  </div>
				  <?php echo form_error('user_foto_file', '<div class="text-danger">','</div>'); ?>
                </div> 

				<div class="form-group col-md-3">

				<?php if(isset($usuario)){ ?>

					<div class="box-foto-usuario">

					<input type="hidden" name="user_foto" value="<?php echo $usuario->user_foto; ?>">
					<img width="100" alt="Usuário imagem" src="<?php echo base_url('uploads/usuarios/' . $usuario->user_foto); ?>" class="rounded-circle">
					</div>


					<?php }else{ ?>

						<div class="box-foto-usuario">

						</div>


						<?php } ?>
                 
                </div> 
				
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?php echo base_url('restrita/' . $this->router->fetch_class()); ?>" class=" btn btn-dark">voltar</a>
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
