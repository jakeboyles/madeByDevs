<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Seasons</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Edit Season</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/seasons'); ?>" class="btn btn-primary">View Seasons</a>
						</div>
					</div>

					<div class="grid-body">
							
						<div class="row">

							<div class="col-md-8 col-sm-8 col-xs-8">

								<!-- START Display Error Messages -->
								<?php if( validation_errors() && $this->input->post() ): ?>
								<div class="alert alert-error">
									<h4>Form Submission Errors</h3>
									<ul>
									<?php echo validation_errors('<li>','</li>'); ?>
									</ul>
								</div>
								<?php endif; ?>
								<!-- END Display Error Messages -->

								<!-- START Success Message -->
								<?php if( !validation_errors() && $this->input->post() ): ?>
								<div class="alert alert-success">
									This record has been updated.
								</div>
								<?php endif; ?>
								<!-- END Success Message -->
								
								<!-- START New Record Added Message -->
								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/seasons/add') ): ?>
								<div class="alert alert-success">
									Record successfully added.
								</div>
								<?php endif; ?>
								<!-- END New Record Added Message -->

								<!-- START Form -->
								<?php echo form_open( 'admin/seasons/edit/' . $record['id'], array( 'id' => 'edit-season-form') ); ?>

									<div class="form-group">
										<?php echo form_label( 'Season Name*', 'name', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Spring 2014</span>
										<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name', $record['name'] ) ) ); ?>
									</div>

									<div class="row">

										<div class="form-group col-md-6">
											<?php echo form_label( 'Year Start*', 'year_start', array( 'class' => 'form-label' ) ); ?>
											<span class="help">e.g. In what year will this season begin?</span>
											<?php echo form_input( array('name' => 'year_start', 'class' => 'form-control', 'id' => 'year_start', 'value' => set_value( 'year_start', $record['year_start'] ) ) ); ?>
										</div>

										<div class="form-group col-md-6">
											<?php echo form_label( 'Year End*', 'year_end', array( 'class' => 'form-label' ) ); ?>
											<span class="help">e.g. In what year will this season end?</span>
											<?php echo form_input( array('name' => 'year_end', 'class' => 'form-control', 'id' => 'year_end', 'value' => set_value( 'year_end', $record['year_end'] ) ) ); ?>
										</div>

									</div>

									<div class="form-group">
										<?php echo form_label( 'Season Description', 'description', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Add a short description of the season.</span>
										<?php echo form_textarea( array('name' => 'description', 'class' => 'form-control', 'id' => 'description', 'value' => set_value( 'description', $record['description'] ) ) ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Update Season</button>

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