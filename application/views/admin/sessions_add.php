<div class="page-content"> 

	<div class="content">

		<div class="page-title">	
			<h3>Sessions</h3>		
		</div>

		<!-- START Form -->
		<?php echo form_open( 'admin/sessions/add/', array( 'id' => 'add-session-form') ); ?>
		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4 class="pull-left">Add Session</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/sessions'); ?>" class="btn btn-primary">View Sessions</a>
						</div>
					</div>

					<div class="grid-body">
							
						<div class="row">

							<div class="col-md-12 col-sm-12 col-xs-12">

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

								<div class="form-group">
									<?php echo form_label( 'Session Name*', 'name', array( 'class' => 'form-label' ) ); ?>
									<span class="help">e.g. Session A</span>
									<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name' ) ) ); ?>
								</div>

								<div class="form-group">
									<?php echo form_label( 'Season', 'season_id', array( 'class' => 'form-label' ) ); ?>
									<span class="help">What season does this session belong to?</span>
									<?php echo form_dropdown( 'season_id', array( '' => '') + $seasons, set_value( 'season_id' ), 'class="pretty-select"' ); ?>
								</div>

								<button type="submit" class="btn btn-primary">Update Session</button>

							</div>

						</div>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-8 -->

		</div><!-- end .row -->
		<?php echo form_close(); ?>
		<!-- END Form -->

	</div><!-- end .content -->
</div><!-- end .page-content -->