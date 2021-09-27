<?php $this->load->view('web/layout/navbar') ?>
<div class="main-container section-padding">
<div class="container">
   <div class="row">
      <div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
         <aside>
            <div class="widget categories">
               <h4 class="widget-title">Todas as Categorias</h4>
               <ul class="categories-list">
                  <?php $categorias_pai_sidebar = categorias_pai_sidebar(); ?>
                  <?php foreach($categorias_pai_sidebar as $cat_pai){ ?>
                  <li>
                     <a href="<?php echo base_url('busca/master/'. $cat_pai->categoria_pai_meta_link); ?>">
                     <i class="lni <?php echo $cat_pai->categoria_pai_classe_icone; ?>"></i>
                     <?php echo word_limiter($cat_pai->categoria_pai_nome,4);  ?> <span class="category-counter">(<?php echo $cat_pai->quantidade_anuncios; ?>)</span>
                     </a>
                  </li>
                  <?php } ?>
               </ul>
            </div>
         </aside>
      </div>
      <div class="col-lg-9 col-md-12 col-xs-12 page-content">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumb-wrapper">
                  <ol class="breadcrumb bg-white">
                     <li><a href="<?php echo base_url('/') ?>">Home&nbsp;/&nbsp;</a></li>
                     <?php if($this->router->fetch_class() == 'busca'){ ?>
                     <?php if($this->router->fetch_method() != 'master'){ ?>
                     <li><a href="<?php echo base_url('busca/master/'.$categoria_pai_meta_link); ?>"><?php echo $categoria_pai_nome; ?>&nbsp;/&nbsp;</a></li>
                     <?php if($this->router->fetch_method() != 'categoria'){ ?>
                     <li><a href="<?php echo base_url('busca/categoria/'.$categoria_meta_link); ?>"><?php echo $categoria_nome; ?></a>&nbsp;/&nbsp;</li>
                     <?php } ?>
                     <?php } ?>
                     <?php if($this->router->fetch_method() == 'cidade'){ ?>
                     <li><a href="<?php echo base_url('busca/estado/'.$anuncio_estado); ?>"><?php echo $anuncio_estado; ?></a>&nbsp;/&nbsp;</li>
                     <?php } ?>
                     <?php if($this->router->fetch_method() == 'bairro'){ ?>
                     <li><a href="<?php echo base_url('busca/estado/'.$anuncio_estado); ?>"><?php echo $anuncio_estado; ?></a>&nbsp;/&nbsp;</li>
                     <li><a href="<?php echo base_url('busca/cidade/'.$anuncio_cidade); ?>"><?php echo $anuncio_cidade; ?></a>&nbsp;/&nbsp;</li>
                     <?php } ?>
                     <li class="current"><?php echo $informacao_busca;?></li>
                     <?php } ?>
                     <?php if($this->router->fetch_class() == 'home'){ ?>
                     <li class="current">Todos os Anúncios</li>
                     <?php } ?>
                  </ol>
               </div>
            </div>
         </div>
         <div class="adds-wrapper">
            <div class="tab-content">
               <div id="list-view" class="tab-pane fade active show">
                  <div class="row">
                     <table class="anuncios-home">
                        <thead>
                           <tr>
                              <th class="nosort">
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($anuncios as $anuncio){ ?>
                           <tr>
                              <td>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="featured-box">
                                       <figure>
                                          <span class="<?php echo ($anuncio->anuncio_situacao == 1 ? 'price-save' : ' price-save bg-primary'); ?>">
                                          <?php echo ($anuncio->anuncio_situacao == 1 ? 'Novo' : 'Usado'); ?>
                                          </span>
                                          <a href="<?php echo base_url('detalhes/'.$anuncio->anuncio_codigo); ?>"><img style="max-width: 360px; max-height: 300px;" class="img-fluid" src="<?php echo base_url('uploads/anuncios/'.$anuncio->foto_nome); ?>" alt="<?php echo $anuncio->anuncio_titulo; ?>"></a>
                                       </figure>
                                       <div class="feature-content">
                                          <div class="product">
                                             <a href="<?php echo base_url('busca/master/'.$anuncio->categoria_pai_meta_link); ?>"><?php echo $anuncio->categoria_pai_nome; ?> > </a>
                                             <a href="<?php echo base_url('busca/categoria/'.$anuncio->categoria_meta_link); ?>"><?php echo $anuncio->categoria_nome; ?></a>
                                          </div>
                                          <h4><a href="<?php echo base_url('detalhes/'.$anuncio->anuncio_codigo); ?>"><?php echo word_limiter($anuncio->anuncio_titulo,5);  ?></a></h4>
                                          <div class="meta-tag">
                                             <span>
                                             <i class="lni-user"></i> <?php echo $anuncio->first_name. ' '.$anuncio->last_name; ?>
                                             </span>
                                             <span>
                                             <a href="#"><i class="lni-map-marker"></i> <?php echo $anuncio->anuncio_bairro. ' , '. $anuncio->anuncio_cidade. ' - '.$anuncio->anuncio_estado; ?></a>
                                             </span>
                                          </div>
                                          <p class="dsc"><?php echo word_limiter($anuncio->anuncio_descricao,18); ?></p>
                                          <div class="listing-bottom">
                                             <h3 class="price float-left"> <?php echo ($anuncio->anuncio_preco> 0 ? 'R$ ' .  number_format($anuncio->anuncio_preco, 2) : ''); ?></h3>
                                             <a href="<?php echo base_url('detalhes/'.$anuncio->anuncio_codigo); ?>" class="btn btn-common float-right">Ver mais</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
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
   </div>
</div>
