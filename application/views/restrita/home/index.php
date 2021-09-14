
    <div class="main-wrapper main-wrapper-1">

			<?php $this->load->view('restrita/layout/navbar'); ?>

			<?php $this->load->view('restrita/layout/sidebar'); ?>
     
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">

					<h1>Teste</h1>
            <!-- Home da área restrita -->

						<?php 
						
						echo '<prev>';
						echo print_r($this->session->userdata()); 
						echo '<prev>';
						
						?>

          </div>
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
					<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

        </div>
      </div>
