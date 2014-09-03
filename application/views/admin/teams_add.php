<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Teams</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Add Team</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/teams'); ?>" class="btn btn-primary">View Teams</a>
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
								<?php echo form_open_multipart( 'admin/teams/add/', array( 'id' => 'add-team-form') ); ?>

									<div class="form-group">
										<?php echo form_label( 'Team Name*', 'name', array( 'class' => 'form-label' ) ); ?>
										<!-- <span class="help">e.g. </span> -->
										<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name' ) ) ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Division*', 'division_id', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Which division does this team belong in?</span>
										<?php echo form_dropdown( 'division_id', array( '' => '') + $divisions, set_value( 'division_id' ), 'class="pretty-select"' ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Team Captain', 'captain_user_id', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. This allows a non admin user help manage this team.</span>
										<?php echo form_dropdown( 'captain_user_id', array( '' => '') + $users, set_value( 'captain_user_id' ), 'class="pretty-select"' ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Team Description', 'description', array( 'class' => 'form-label' ) ); ?>
										<!-- <span class="help">e.g. </span> -->
										<?php echo form_textarea( array('name' => 'description', 'class' => 'form-control', 'id' => 'description', 'value' => set_value( 'description' ) ) ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Create Team</button>

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