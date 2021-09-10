
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
                  <div class="card-header d-block">
                    <h4><?php echo $titulo; ?></h4>
										<a data-toggle='tooltip' data-placement='top' title="Cadastrar Usuário" href="<?php echo base_url('restrita/' .$this->router->fetch_class()  . '/core/'); ?>" class="btn btn-primary mr-2 float-right">Cadastrar</a>

                  </div>
                  <div class="card-body">

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

                    <div class="table-responsive">
                      <table class="table table-striped data-table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nome categoria</th>
                            <th>Nome categoria pai</th>
                            <th>Meta link da categoria</th>
                            <th>Ativo</th>
                            <th class="nosort">Ações</th>
                          </tr>
                        </thead>
                        <tbody>

												<?php foreach($categorias as $categoria){ ?>

                          <tr>
													<td><?php echo $categoria->categoria_id ?></td>
													<td><?php echo $categoria->categoria_nome ?></td>
													<td><?php echo $categoria->categoria_pai_nome ?></td>
													<td><?php echo $categoria->categoria_meta_link ?></td>

													<td><?php echo ($categoria->categoria_ativa == 1 ? '<div class="badge badge-success badge-shadow">Sim</div>' : '<div class="badge badge-danger badge-shadow">Não</div>'); ?></td>
													 
													<td>
														 <a data-toggle='tooltip' data-placement='top' title="Editar usuário" href="<?php echo base_url('restrita/' .$this->router->fetch_class()  . '/core/' .$categoria->categoria_id ); ?>" class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>
														 <a data-toggle='tooltip' data-placement='top' title="Excluir usuário" href="<?php echo base_url('restrita/' .$this->router->fetch_class()  . '/delete/' .$categoria->categoria_id ); ?>" class="btn btn-danger delete" data-confirm="Tem certeza que deseja excluir?"><i class="fas fa-trash-alt"></i></a>
														
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
