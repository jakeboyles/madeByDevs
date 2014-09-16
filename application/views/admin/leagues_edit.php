<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Leagues</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Edit League</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/leagues'); ?>" class="btn btn-primary">View Leagues</a>
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
								<?php echo form_open( 'admin/leagues/edit/' . $record['id'], array( 'id' => 'edit-league-form') ); ?>

									<div class="form-group">
										<?php echo form_label( 'League Name*', 'name', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Gotham Soccer League</span>
										<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name', $record['name'] ) ) ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Active Season', 'current_season_id', array( 'class' => 'form-label' ) ); ?>
										<?php echo form_dropdown( 'current_season_id', array( '' => '') + $seasons, set_value('current_season_id',$record['current_season_id']), 'class="pretty-select"' ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Active Season', 'current_season_id', array( 'class' => 'form-label' ) ); ?>
										<?php echo form_dropdown( 'previous_season_id', array( '' => '') + $seasons, set_value('previous_season_id',$record['previous_season_id']), 'class="pretty-select"' ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Update League</button>

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