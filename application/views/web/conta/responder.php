<?php $this->load->view('web/layout/navbar');?>
<div id="content" class="section-padding">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
            <?php $this->load->view('web/conta/sidebar'); ?>
         </div>
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
                              <form role="form" class="login-form" method="POST" action="<?php echo base_url('conta/responder/'.$pergunta->pergunta_id); ?>">
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
                                    <div class="form-group col-md-12">
																		<label>Data da Pergunta</label>
                                       <div class="input-icon">
                                          <i class="lni-alarm-clock"></i>
                                          <input type="text" class="form-control" value="<?php echo formata_data_banco_com_hora($pergunta->data_pergunta); ?>" readonly="">
                                       </div>
                                    </div>
                                    <div class="form-group col-md-12">
																		<label>o que foi pergutado</label>
                                       <textarea class="form-control" readonly=""> <?php echo $pergunta->pergunta; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="form-row">

																 <?php if($pergunta->pergunta_respondida == 1){ ?>

																 <div class="form-group col-md-12">
																		<label>Data da Resposta</label>
                                       <div class="input-icon">
                                          <i class="lni-alarm-clock"></i>
                                          <input type="text" class="form-control bg-light" value="<?php echo formata_data_banco_com_hora($pergunta->data_resposta); ?>" readonly="">
                                       </div>
                                    </div>

																		<?php } ?>

                                    <div class="form-group col-md-12">
                                       <label>Sua resposta</label>
																			 <?php if($pergunta->pergunta_respondida == 1){ ?>
                                       <textarea class="form-control">  <?php echo $pergunta->resposta; ?></textarea>
																			 <?php }else{ ?>
																				<textarea class="form-control" name="resposta">  <?php echo set_value('resposta') ?></textarea>
																				<?php echo form_error('resposta', '<div class="text-danger">','</div>'); ?>

																				<?php } ?>
                                    </div>
                                 </div>

																 <?php if($pergunta->pergunta_respondida == 1){ ?>

																	<div class="text-center">
                                    <button class="btn btn-common log-btn" disabled="">Pergunta Respondida</button>
                                 </div>

																			 <?php }else{ ?>

																				<div class="text-center">
                                    <button type="submit" class="btn btn-common log-btn">Responder</button>
                                 </div>

																				
																				

																				<?php } ?>

                                
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
