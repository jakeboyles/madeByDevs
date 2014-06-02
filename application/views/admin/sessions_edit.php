<div class="page-content"> 

	<div class="content">

		<div class="page-title">	
			<h3>Sessions</h3>		
		</div>

		<!-- START Form -->
		<?php echo form_open( 'admin/sessions/edit/' . $record['id'], array( 'id' => 'edit-session-form') ); ?>
		<div class="row">
			<div class="col-md-8">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4 class="pull-left">Edit Session</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/sessions'); ?>" class="btn btn-primary">View Sessions</a>
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
								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/sessions/add') ): ?>
								<div class="alert alert-success">
									Record successfully added.
								</div>
								<?php endif; ?>
								<!-- END New Record Added Message -->

								<div class="form-group">
									<?php echo form_label( 'Session Name*', 'name', array( 'class' => 'form-label' ) ); ?>
									<span class="help">e.g. Session A</span>
									<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name', $record['name'] ) ) ); ?>
								</div>

								<div class="form-group">
									<?php echo form_label( 'Season', 'season_id', array( 'class' => 'form-label' ) ); ?>
									<span class="help">What season does this session belong to?</span>
									<?php echo form_dropdown( 'season_id', array( '' => '') + $seasons, set_value( 'season_id', $record['season_id'] ), 'class="pretty-select"' ); ?>
								</div>

								<button type="submit" class="btn btn-success">Update Session</button>

							</div>

						</div>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-8 -->

			<!-- Second Column -->
			<div class="col-md-4">
		 		<div class="grid simple">
					<div class="grid-title">
						<h4 class="pull-left">Assign Divisions</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/divisions'); ?>" class="btn btn-primary">Edit Divisions</a>
						</div>
					</div>

					<div class="grid-body">
						<?php foreach( $divisions as $key => $val ): ?>
							<div class="checkbox check-primary">
								<?php $checked = ( !empty( $related_divisions ) && in_array( $key, $related_divisions ) ) ? TRUE : FALSE; ?>
								<?php echo form_checkbox( array( 'name' => 'divisions[]', 'value' => $key, 'id' => 'checkbox' . $key, 'checked' => $checked ) ); ?>
								<?php echo form_label( $val, 'checkbox' . $key, array( 'class' => 'form-label' ) ); ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div><!-- end .col-md-4 -->

		</div><!-- end .row -->
		<?php echo form_close(); ?>
		<!-- END Form -->

	</div><!-- end .content -->
</div><!-- end .page-content -->