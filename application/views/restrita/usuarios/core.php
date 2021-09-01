
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
                  <div class="card-header">
                    <h4> <?php echo $titulo; ?> </h4>
                  </div>
                  <div class="card-body">
                    
                    <div class="form-group">
                      <label>Phone Number (US Format)</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control phone-number">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Password Strength</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                          </div>
                        </div>
                        <input type="password" class="form-control pwstrength" data-indicator="pwindicator">
                      </div>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Currency</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            $
                          </div>
                        </div>
                        <input type="text" class="form-control currency">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Purchase Code</label>
                      <input type="text" class="form-control purchase-code" placeholder="ASDF-GHIJ-KLMN-OPQR">
                    </div>
                    <div class="form-group">
                      <label>Invoice</label>
                      <input type="text" class="form-control invoice-input">
                    </div>
                    <div class="form-group">
                      <label>Date</label>
                      <input type="text" class="form-control datemask" placeholder="YYYY/MM/DD">
                    </div>
                    <div class="form-group">
                      <label>Credit Card</label>
                      <input type="text" class="form-control creditcard">
                    </div>
                    <div class="form-group">
                      <label>Tags</label>
                      <input type="text" class="form-control inputtags">
                    </div>
                  </div>
				  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
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
