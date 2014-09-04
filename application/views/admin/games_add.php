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
								<?php echo form_open( 'admin/games/add/', array( 'id' => 'add-team-form') ); ?>

								<div class="form-group">
									<?php echo form_label( 'Session*', 'session_id', array( 'class' => 'form-label' ) ); ?>
									<!-- <a href="#" data-toggle="popover" data-placement="right" data-content="Note that these are the active divisions for this session."><i class="fa fa-question-circle"></i></a> -->
									<span class="help">Note that these are the assigned divisions for this session.</span>
									<?php echo form_dropdown( 'session_id', array( '' => '') + $sessions, set_value( 'session_id' ), 'id="game-sessions-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/divisions/get_divisions_by_sessions') . '"' ); ?>
								</div>

								<!-- This Loads in Via AJAX After a Division is Selected -->
								<div class="division-dropdowns"></div>

								<!-- This Loads in Via AJAX After a Division is Selected -->
								<div class="teams-dropdowns"></div>

								<div class="row">

									<div class="form-group col-md-6">
										<?php echo form_label( 'Location*', 'location_id', array( 'class' => 'form-label' ) ); ?>
										<!-- <span class="help">e.g. </span> -->
										<?php echo form_dropdown( 'location_id', array( '' => '') + $locations, set_value( 'location_id' ), 'id="game-locations-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/locations/get_fields_ajax') . '"' ); ?>
									</div>

									<div class="form-group col-md-6">
										<div class="location-fields-dropdown hide"></div>
									</div>

								</div>

								<div class="row">

									<div class="form-group col-md-6">
										<?php echo form_label( 'Game Date*', 'game_date', array( 'class' => 'form-label' ) ); ?>
										<span class="help">mm/dd/yyyy format</span>
										<?php echo form_input( array('name' => 'game_date', 'class' => 'form-control date-mask', 'id' => 'game_date', 'value' => set_value( 'game_date' ) ) ); ?>
									</div>

									<div class="form-group col-md-6">
										<?php echo form_label( 'Game Time*', 'game_time', array( 'class' => 'form-label' ) ); ?>
										<!-- <span class="help">e.g. </span> -->
										<div>
											<div class="input-append bootstrap-timepicker-component">
												<?php echo form_input( array('name' => 'game_time', 'class' => 'form-control timepicker-default', 'id' => 'game_time', 'value' => set_value( 'game_time' ) ) ); ?>
												<span class="add-on"><span class="arrow"></span><i class="fa fa-clock-o"></i></span>
											</div>
										</div>

									</div>

								</div>


								<button type="submit" class="btn btn-primary">Add Game</button>

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