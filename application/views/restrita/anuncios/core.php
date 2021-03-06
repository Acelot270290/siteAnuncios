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
              <div class="form-row">
                <div class="form-group col-md-2">
                  <label>Código Anúncio</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-audio-description text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control"  value="<?php echo $anuncio->anuncio_codigo; ?>"readonly="">
                  </div>
                </div>
                <div class="form-group col-md-10">
                  <label>Título do Anúncio</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-audio-description text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="anuncio_titulo" value="<?php echo (isset($anuncio) ? $anuncio->anuncio_titulo : set_value('anuncio_titulo')); ?>">
                  </div>
                  <?php echo form_error('anuncio_titulo', '<div class="text-danger">','</div>'); ?>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-2">
                  <label>Preço</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-audio-description text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control money2" name="anuncio_preco" value="<?php echo (isset($anuncio) ? $anuncio->anuncio_preco : set_value('anuncio_preco')); ?>">
                  </div>
                  <?php echo form_error('anuncio_preco', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-4">
                  <label class="mr-3">anuncio Principal</label>
                  <span class="text-info small">Atual:<?php echo $anuncio->categoria_pai_nome; ?></span>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-check-circle text-info"></i>
                      </div>
                    </div>
                    <select id="master" class="form-control select2" name="anuncio_categoria_pai_id">
                      <option value="">Escolha uma categoria principal...</option>
                      <?php foreach($categorias_pai as $cat_pai){ ?>
                      <option value="<?php echo $cat_pai->categoria_pai_id; ?>"><?php echo $cat_pai->categoria_pai_nome; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <?php echo form_error('anuncio_ativa', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-5">
                  <label class="mr-3">Subcategoria</label>
                  <span class="text-info small">Atual:<?php echo $anuncio->categoria_nome; ?></span>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-check-circle text-info"></i>
                      </div>
                    </div>
                    <select id ="anuncio_categoria" class="form-control select2" name="anuncio_categoria_id">
										<option value="">Escolha uma categoria...</option>
                    <?php echo form_error('anuncio_anuncio_id', '<div class="text-danger">','</div>'); ?>
                    </select>
                  </div>
                  <?php echo form_error('anuncio_anuncio_id', '<div class="text-danger">','</div>'); ?>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-2">
                  <label>Anúncio Publicado</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-check-circle text-info"></i>
                      </div>
                    </div>
                    <select class="custom-select" name="anuncio_publicado">
                      <option value="0" <?php echo($anuncio->anuncio_publicado == 0 ? 'selected' : ''); ?>>Não</option>
                      <option value="1" <?php echo($anuncio->anuncio_publicado == 1 ? 'selected' : ''); ?>>sim</option>
                    </select>
                  </div>
                  <?php echo form_error('anuncio_publicado', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-2">
                  <label>Situação do Item</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-check-circle text-info"></i>
                      </div>
                    </div>
                    <select class="custom-select" name="anuncio_situacao">
                      <option value="0" <?php echo($anuncio->anuncio_situacao == 0 ? 'selected' : ''); ?>>Novo</option>
                      <option value="1" <?php echo($anuncio->anuncio_situacao == 1 ? 'selected' : ''); ?>>Usado</option>
                    </select>
                  </div>
                  <?php echo form_error('anuncio_situacao', '<div class="text-danger">','</div>'); ?>
                </div>
                <div class="form-group col-md-2">
                  <label>Localização do anúncio</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-audio-description text-info"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control cep" name="anuncio_localizacao_cep" value="<?php echo (isset($anuncio) ? $anuncio->anuncio_localizacao_cep : set_value('anuncio_localizacao_cep')); ?>">
                  </div>
                  <?php echo form_error('anuncio_localizacao_cep', '<div class="text-danger">','</div>'); ?>
									<div id="anuncio_localizacao_cep"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label>Descrição do Anúncio</label>
                  <textarea class="form-control" name="anuncio_descricao" style="min-height: 200px;"><?php echo $anuncio->anuncio_descricao; ?></textarea>
                  <?php echo form_error('anuncio_descricao', '<div class="text-danger">','</div>'); ?>
                </div>
              </div>
              <div class="form_row">
                <div class="form-group col-md-8">
                  <label>Imagens do anúncio</label>
                  <div id="fileuploader">
                  </div>
                  <div id="erro_uploaded" class="text-danger">
                  </div>
                  <?php echo form_error('fotos_produtos', '<div class="text-danger">','</div>'); ?>
                </div>
              </div>
              <div class="form_row">
                <div class="form-group col-md-12">
                  <div id="uploaded_image">
                    <?php foreach($fotos_anuncio as $foto){ ?>
                    <ul style="list-style: none; display: inline-block;">
										<li class="text-center">
                        <img src="<?php echo base_url('uploads/anuncios/small/' .$foto->foto_nome);  ?>" width="80" class="img-thumbnail mr-1 mb-2">
                        <input type="hidden" name="fotos_produtos[]" value="<?php echo $foto->foto_nome; ?>"></input><br>
                        <button class="btn btn-danger btn-remove" style="width: 45px;">X</button>
                      </li>
                    </ul>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <?php if(isset($anuncio)){ //Validando o id do user ?>
                <input type="hidden" name="anuncio_id" value="<?php echo $anuncio->anuncio_id; ?>">
                <?php } ?>
              </div>
            </div>
            <div class="card-footer">
              <button id="btn-save-anuncio" type="submit" class="btn btn-primary">Salvar</button>
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
