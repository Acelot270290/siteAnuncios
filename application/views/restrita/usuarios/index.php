
    <div class="main-wrapper main-wrapper-1">

			<?php $this->load->view('restrita/layout/navbar'); ?>

			<?php $this->load->view('restrita/layout/sidebar'); ?>
     
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">

					<div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $titulo; ?></h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>
                              Imagem
                            </th>
                            <th>Nome Completo</th>
                            <th>Login</th>
                            <th>Perfil de Acesso</th>
                            <th>Ativo</th>
                            <th>Acções</th>
                          </tr>
                        </thead>
                        <tbody>

												<?php foreach($usuarios as $usuario){ ?>

                          <tr>
													<td><img alt="image" src="<?php echo base_url('uploads/usuarios/' . $usuario->user_foto); ?>" width="35"></td>
													<td><?php echo $usuario->first_name . '' . $usuario->last_name  ?></td>
													<td><?php echo $usuario->email ?></td>
													<td><?php echo ($this->ion_auth->is_admin($usuario->id) ? 'Administrador' : 'Anunciante'); ?></td>
													<td><?php echo ($usuario->active == 1 ? '<div class="badge badge-success badge-shadow">Sim</div>' : '<div class="badge badge-danger badge-shadow">Não</div>'); ?></td>
													 
													<td>
														 <a href="#" class="btn btn-primary">Atualizar</a>
														 <a href="#" class="btn btn-warning">Excluir</a>
														
														</td>
                          </tr>
													<?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
