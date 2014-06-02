<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Games</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Add Game</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/games'); ?>" class="btn btn-primary">View Games</a>
						</div>
					</div>

					<div class="grid-body">
							
						<div class="row">

							<div class="col-md-8 col-sm-8 col-xs-8">

								<!-- START Display Error Messages -->
								<?php if(validation_errors() && $this->input->post()): ?>
								<div class="alert alert-error">
									<h4>Form Submission Errors</h3>
									<ul>
									<?php echo validation_errors('<li>','</li>'); ?>
									</ul>
								</div>
								<?php endif; ?>
								<!-- END Display Error Messages -->

								<!-- START Form -->
								<?php echo form_open( 'admin/games/add/', array( 'id' => 'add-game-form') ); ?>

									<div class="form-group">
										<?php echo form_label( 'Season Name*', 'name', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Spring 2014</span>
										<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name' ) ) ); ?>
									</div>

									<div class="row">

										<div class="form-group col-md-6">
											<?php echo form_label( 'Year Start*', 'year_start', array( 'class' => 'form-label' ) ); ?>
											<span class="help">e.g. In what year will this season begin?</span>
											<?php echo form_input( array('name' => 'year_start', 'class' => 'form-control', 'id' => 'year_start', 'value' => set_value( 'year_start' ) ) ); ?>
										</div>

										<div class="form-group col-md-6">
											<?php echo form_label( 'Year End*', 'year_end', array( 'class' => 'form-label' ) ); ?>
											<span class="help">e.g. In what year will this season end?</span>
											<?php echo form_input( array('name' => 'year_end', 'class' => 'form-control', 'id' => 'year_end', 'value' => set_value( 'year_end' ) ) ); ?>
										</div>

									</div>

									<div class="form-group">
										<?php echo form_label( 'Season Description', 'description', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Add a short description of the season.</span>
										<?php echo form_textarea( array('name' => 'description', 'class' => 'form-control', 'id' => 'description', 'value' => set_value( 'description' ) ) ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Create Game</button>

								<?php echo form_close(); ?>
								<!-- END Form -->

							</div>

						</div>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-12 -->
		</div><!-- end .row -->

	</div><!-- end .content -->
</div><!-- end .page-content -->