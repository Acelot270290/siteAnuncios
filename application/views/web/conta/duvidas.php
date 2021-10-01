<?php $this->load->view('web/layout/navbar');?>
<div id="content" class="section-padding">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
            <?php $this->load->view('web/conta/sidebar'); ?>
         </div>
			

				 <?php if(isset($duvidas)){ ?>

					<div class="col-sm-12 col-md-8 col-lg-9">
					<?php if($mensagem = $this->session->flashdata('sucesso')){ ?>
                      <div class="alert alert-success bg-success text-white alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                          </button>
                          <?php echo $mensagem; ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($mensagem = $this->session->flashdata('erro')){ ?>
                      <div class="alert alert-danger bg-danger text-white alert-dismissible show fade">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                          </button>
                          <?php echo $mensagem; ?>
                        </div>
                      </div>
                      <?php } ?>
            <div class="page-content">
               <div class="inner-box">
                  <div class="dashboard-box">
                     <h2 class="dashbord-title"><?php echo $titulo; ?></h2>
							
                  </div>
                  <div class="dashboard-wrapper">
                     
                     <table class="table table-responsive dashboardtable table-anuncios">
                        <thead>
                           <tr>
                              <th>Pergunta</th>
                              <th>Data da pergunta</th>
                              <th>Respondida</th>
                              <th class="nosort">Visualizar</th>
                           </tr>
                        </thead>
                        <tbody>

												<?php foreach($duvidas as $duvida){ ?>
                           <tr data-category="active">


                              <td data-title="Title">
                                 <h3><?php echo word_limiter($duvida->pergunta, 5); ?></h3>
                                 
                              </td>
															<td data-title="Category">
																<span class="adcategories"><?php echo formata_data_banco_com_hora($duvida->data_pergunta); ?></span>
															</td>
                              <td data-title="Ad Status"><?php echo ($duvida->pergunta_respondida == 1 ? '<span class="adstatus adstatusactive">Sim</span>' : '<span class="adstatus adstatusexpired">Não</span>'); ?></td>


                              <td data-title="Action">
                                 <div class="btns-actions">
                                    <a class="btn-action btn-view" href="<?php echo base_url($this->router->fetch_class().'/visualizar/'.$duvida->pergunta_id); ?>"><i class="lni-eye"></i></a>
												
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

					<?php }else{ ?>

						<div class="col-md-9">

						
					
					<div class="container text-center">

										<h1 class="mb-5">Você ainda não realizou perguntas ainda</h1>

										<img width="300" src="<?php echo base_url('public/web/assets/img/sem_anuncios.svg'); ?>"/>



					</div>

						
					</div>
					<?php } ?>
      </div>
   </div>
</div>
