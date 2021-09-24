
<?php $this->load->view('web/layout/navbar') ?>

    <div class="main-container section-padding">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
            <aside>
              <div class="widget_search">
                <form role="search" id="search-form">
                  <input type="search" class="form-control" autocomplete="off" name="s" placeholder="Search..." id="search-input" value="">
                  <button type="submit" id="search-submit" class="search-btn"><i class="lni-search"></i></button>
                </form>
              </div>
              <div class="widget categories">
                <h4 class="widget-title">All Categories</h4>
                <ul class="categories-list">
                  <li>
                    <a href="#">
                    <i class="lni-dinner"></i>
                    Hotel & Travels <span class="category-counter">(5)</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    <i class="lni-control-panel"></i>
                    Services <span class="category-counter">(8)</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    <i class="lni-github"></i>
                    Pets <span class="category-counter">(2)</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    <i class="lni-coffee-cup"></i>
                    Restaurants <span class="category-counter">(3)</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    <i class="lni-home"></i>
                    Real Estate <span class="category-counter">(4)</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    <i class="lni-pencil"></i>
                    Jobs <span class="category-counter">(5)</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    <i class="lni-display"></i>
                    Electronics <span class="category-counter">(9)</span>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="widget">
                <h4 class="widget-title">Advertisement</h4>
                <div class="add-box">
                  <img class="img-fluid" src="assets/img/img1.jpg" alt="">
                </div>
              </div>
            </aside>
          </div>
          <div class="col-lg-9 col-md-12 col-xs-12 page-content">


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
																<a href="<?php echo base_url('master/'.$anuncio->categoria_pai_meta_link); ?>"><?php echo $anuncio->categoria_pai_nome; ?> > </a>
																<a href="<?php echo base_url('categorias/'.$anuncio->categoria_meta_link); ?>"><?php echo $anuncio->categoria_nome; ?></a>
															</div>
															<h4><a href="<?php echo base_url('detalhes/'.$anuncio->anuncio_codigo); ?>"><?php echo word_limiter($anuncio->anuncio_titulo,5);  ?></a></h4>
															<div class="meta-tag">
																<span>
																<a href="<?php echo base_url('anunciante/'.$anuncio->anuncio_user_id); ?>"><i class="lni-user"></i> <?php echo $anuncio->first_name. ' '.$anuncio->last_name; ?></a>
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

                  </div>

									</tbody>

									</table>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    
