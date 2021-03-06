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
               <form method="POST" name="form_core">
                  <div class="card-header">
                     <h4> <?php echo $titulo; ?> </h4>
                  </div>
                  <div class="card-body">

									<?php if(isset($categoria)){ ?>

										<div class="form-row">
										<div class="form-group col-md-12">	
										<label>Meta link da categoria</label>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <div class="input-group-text">
                                    <i class="fas fa-link text-info"></i>
                                 </div>
                              </div>
                              <input type="text" class="form-control"  value="<?php echo $categoria->categoria_pai_meta_link; ?>" readonly="">
                           </div>
										</div>
										</div>

									<?php } ?>
                     <div class="form-row">
                        <div class="form-group col-md-4">
                           <label>Nome da Categoria</label>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <div class="input-group-text">
                                    <i class="fas fa-audio-description text-info"></i>
                                 </div>
                              </div>
                              <input type="text" class="form-control" name="categoria_pai_nome" value="<?php echo (isset($categoria) ? $categoria->categoria_pai_nome : set_value('categoria_pai_nome')); ?>">
                           </div>
                           <?php echo form_error('categoria_pai_nome', '<div class="text-danger">','</div>'); ?>
                        </div>
                        <div class="form-group col-md-4">
                           <label>??cone da categoria</label>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <div class="input-group-text">
                                    <i class="fas fa-cube text-info"></i>
                                 </div>
                              </div>
                              <input type="text" class="form-control" name="categoria_pai_classe_icone" value="<?php echo (isset($categoria) ? $categoria->categoria_pai_classe_icone : set_value('categoria_pai_classe_icone')); ?>">
                           </div>
                           <?php echo form_error('categoria_pai_classe_icone', '<div class="text-danger">','</div>'); ?>
                        </div>
                        <div class="form-group col-md-4">
                           <label>Ativa</label>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <div class="input-group-text">
                                    <i class="fas fa-check-circle text-info"></i>
                                 </div>
                              </div>
                              <select class="custom-select" name="categoria_pai_ativa">
                                 <?php if(isset($categoria)){ ?>
                                 <option value="0" <?php echo($categoria->categoria_pai_ativa == 0 ? 'selected' : ''); ?>>N??o</option>
                                 <option value="1" <?php echo($categoria->categoria_pai_ativa == 1 ? 'selected' : ''); ?>>sim</option>
                                 <?php }else{ ?>
                                 <option value="0">N??o</option>
                                 <option value="1">sim</option>
                                 <?php } ?>
                              </select>
                           </div>
                           <?php echo form_error('categoria_pai_ativa', '<div class="text-danger">','</div>'); ?>
                        </div>
                        <?php if(isset($categoria)){ //Validando o id do user ?>
                        <input type="hidden" name="categoria_pai_id" value="<?php echo $categoria->categoria_pai_id; ?>">
                        <?php } ?>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Salvar</button>
                     <a href="<?php echo base_url('restrita/' . $this->router->fetch_class()); ?>" class=" btn btn-dark">voltar</a>
                  </div>
               </form>
            </div>
         </div>
         <!-- Home da ??rea restrita -->
      </div>
</section>
<div class="settingSidebar">
<a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
</a>
<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>
</div>
</div>
