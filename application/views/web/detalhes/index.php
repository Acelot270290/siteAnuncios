<?php $this->load->view('web/layout/navbar');?>
<div class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb bg-white">
            <li><a href="<?php echo base_url('/') ?>">Home&nbsp;/&nbsp;</a></li>
            <li><a href="<?php echo base_url('busca/estado/'.$anuncio->anuncio_estado); ?>">&nbsp;<?php echo $anuncio->anuncio_estado; ?>&nbsp;/&nbsp; </a></li>
            <li><a href="<?php echo base_url('busca/cidade/'.$anuncio->anuncio_cidade_metalink); ?>">&nbsp;<?php echo $anuncio->anuncio_cidade; ?>&nbsp;/&nbsp; </a></li>
            <li><a href="<?php echo base_url('busca/bairro/'.$anuncio->anuncio_bairro_metalink); ?>">&nbsp;<?php echo $anuncio->anuncio_bairro; ?>&nbsp;/&nbsp; </a></li>
            <li><a href="<?php echo base_url('busca/master/'.$anuncio->categoria_pai_meta_link); ?>">&nbsp;<?php echo $anuncio->categoria_pai_nome; ?>&nbsp;/&nbsp; </a></li>
            <li class="current"><a href="<?php echo base_url('busca/categoria/'.$anuncio->categoria_meta_link); ?>">&nbsp;<?php echo $anuncio->categoria_nome; ?>&nbsp;/&nbsp; </a></li>
            <li class="current">Details</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="product-info row">
      <div class="col-lg-8 col-md-12 col-xs-12">
        <div class="ads-details-wrapper">
          <div id="owl-demo" class="owl-carousel owl-theme">
            <?php foreach($anuncios_fotos as $foto){ ?>
            <div class="item">
              <div class="product-img text-center">
                <img class="img-fluid" style="max-height: 450px;" src="<?php echo base_url('uploads/anuncios/'.$foto->foto_nome); ?>" alt="<?php echo $anuncio->anuncio_titulo; ?>">
              </div>
              <span class="<?php echo($anuncio->anuncio_preco > 0 ? 'price' : ''); ?>"><?php echo($anuncio->anuncio_preco > 0 ? 'R$ ' .number_format($anuncio->anuncio_preco, 2) : ''); ?></span>
            </div>
            <?php } ?>
          </div>
        </div>
        <div class="details-box">
          <div class="ads-details-info">
            <h2><?php echo $anuncio->anuncio_titulo; ?></h2>
            <div class="details-meta">
              <span><i class="lni-alarm-clock"></i> <?php echo formata_data_banco_com_hora($anuncio->anuncio_data_criacao); ?></span>
              <span><i class="lni-map-marker"></i>CEP <?php echo $anuncio->anuncio_localizacao_cep . ' - ' .$anuncio->anuncio_logradouro. ' - ' .$anuncio->anuncio_cidade. ' - ' . $anuncio->anuncio_estado; ?></span>
            </div>
            <p class="mb-4"><?php echo $anuncio->anuncio_descricao; ?>
            </h4>
          </div>
          <div class="tag-bottom">
            <div class="float-left">
              <ul class="advertisement">
                <li>
                  <p><strong><i class="lni-folder"></i> Categorias:</strong> <a href="<?php echo base_url('busca/master/'.$anuncio->categoria_pai_meta_link); ?>"><?php echo $anuncio->categoria_pai_nome; ?></a></p>
                </li>
                <li>
                  <p><strong><i class="lni-archive"></i> Situação do Anúncio: </strong><?php echo ($anuncio->anuncio_situacao== 1 ? 'Novo' : 'Usado'); ?></p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <aside class="details-sidebar">
        <div class="widget">
          <h4 class="widget-title">Anunciate</h4>
          <div class="agent-inner">
            <div class="agent-title">
              <div class="agent-photo">
                <img src="<?php echo base_url('uploads/usuarios/small/'.$anuncio->user_foto); ?>" alt="<?php echo $anuncio->nome_anunciante; ?>">
              </div>
              <div class="agent-details">
                <h3><?php echo $anuncio->nome_anunciante; ?></h3>
                <span><i class="lni-phone-handset"></i><?php echo $anuncio->telefone_anunciante; ?><br></span>
                <span><i class="lni-alarm-clock"></i>Desde: <?php echo date('d/m/Y',$anuncio->anunciante_desde); ?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="widget">
          <h4 class="widget-title">Todos anúncios de <?php echo $anuncio->nome_anunciante;?></h4>
          <ul class="posts-list">
            <?php foreach($todos_anuncios_anunciante as $anuncio){ ?>
            <li>
              <div class="widget-thumb">
                <a href="<?php echo base_url('detalhes/'.$anuncio->anuncio_codigo);?>"><img style="max-width: 30px;" src="<?php echo base_url('uploads/anuncios/small/'.$anuncio->foto_nome ); ?>" alt="<?php echo $anuncio->anuncio_titulo; ?>"></a>
              </div>
              <div class="widget-content">
                <h4>
                  <a href="<?php echo base_url('detalhes/'.$anuncio->anuncio_codigo);?>">
                  <?php echo $anuncio->anuncio_titulo; ?></a>
                </h4>
                <div class="meta-tag">
                  <span>
                  <i class="lni-user"></i> <?php echo $anuncio->first_name. ' '.$anuncio->last_name; ?>
                  </span>
                  <span>
                  <i class="lni-map-marker"></i><?php echo $anuncio->anuncio_bairro. ' , '. $anuncio->anuncio_cidade. ' - '.$anuncio->anuncio_estado; ?>
                  </span>
                </div>
                <h4 class="price"><?php echo ($anuncio->anuncio_preco> 0 ? 'R$ ' .  number_format($anuncio->anuncio_preco, 2) : ''); ?></h4>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="col-md-8" id="pergunta">
        <?php if($mensagem = $this->session->flashdata('sucesso_pergunta')){ ?>
        <div class="alert alert-success text-white alert-dismissible show fade">
          <div class="alert-body">
            <button class="close" data-dismiss="alert">
            <span>&times;</span>
            </button>
            <?php echo $mensagem ?>
          </div>
        </div>
        <?php } ?>
        <?php if($mensagem = $this->session->flashdata('erro_pergunta')){ ?>
        <div class="alert alert-danger text-white alert-dismissible show fade">
          <div class="alert-body">
            <button class="close" data-dismiss="alert">
            <span>&times;</span>
            </button>
            <?php echo $mensagem ?>
          </div>
        </div>
        <?php } ?>
        <div id="comments">
          <div class="comment-box">
            <div id="respond" class="mb-3">
              <form method="POST" action="<?php echo base_url('/detalhes/perguntar/'.$anuncio_user->anuncio_id); ?>">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="form-group" >
                      <textarea id="comment" style="resize: none;" class="form-control" name="pergunta" rows="4" placeholder="Digite sua pergunta..."required=""><?php echo ($this->session->has_userdata('pergunta') ? $this->session->userdata('pergunta') : set_value('pergunta')); ?></textarea>
							 <?php echo form_error('pergunta', '<div class="text-danger">','</div>'); ?>
                    </div>
                    <button type="submit" id="submit" class="btn btn-common">Perguntar</button>
                  </div>
                </div>
              </form>
            </div>
            <h3><?php echo ($anuncio_perguntas ? 'Últimas perguntas' : 'Sem Perguntas'); ?></h3>
            <ol class="comments-list">
              <?php if(isset($anuncio_perguntas)){ ?>
              <?php foreach($anuncio_perguntas as $pergunta){ ?>
              <li>
                <div class="media">
                  <div class="thumb-left" style="max-width: 100px;">
                    <a href="#">
                    <img width="100px" class="img-fluid" src="<?php echo base_url('uploads/usuarios/small/'.$pergunta->user_foto); ?>" alt="<?php echo $pergunta->nome_anunciante_pergunta; ?>">
                    </a>
                  </div>
                  <div class="info-body" style="width: 80%;">
                    <div class="media-heading">
                      <h4 class="name"><?php echo $pergunta->nome_anunciante_pergunta; ?></h4>
                      <span class="comment-date"><i class="lni-alarm-clock"></i> <?php echo formata_data_banco_com_hora($pergunta->data_pergunta); ?></span>
                    </div>
                    <p><?php echo $pergunta->pergunta; ?></p>
                  </div>
                </div>
                <?php if($pergunta->pergunta_respondida == 1){ ?>
                <ul>
                  <li>
                    <div class="media">
                      <div class="thumb-left" style="max-width: 100px;">
                        <a href="#">
                        <img class="img-fluid" src="<?php echo base_url('uploads/usuarios/small/'.$anuncio_user->user_foto); ?>" alt="<?php echo $anuncio_user->nome_anunciante; ?>">
                        </a>
                      </div>
                      <div class="info-body" style="width: 80%;">
                        <div class="media-heading">
                          <h4 class="name"><?php echo $anuncio_user->nome_anunciante; ?></h4>
                          <span class="comment-date"><i class="lni-alarm-clock"></i> <?php echo formata_data_banco_com_hora($pergunta->data_resposta); ?></span>
                        </div>
                        <p><?php echo $pergunta->resposta; ?></p>
                      </div>
                    </div>
                  </li>
                </ul>
                <?php } ?>
              </li>
              <?php } ?>
              <?php } ?>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
