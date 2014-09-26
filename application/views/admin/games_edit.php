<div class="page-content game-edit"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Games</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Edit Game</h4>
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
								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/games/edit/').'/'.$record['id'] ): ?>
								<div class="alert alert-success">
									Record successfully updated.
								</div>
								<?php endif; ?>

								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/games/add') ): ?>
								<div class="alert alert-success">
									Record successfully added.
								</div>
								<?php endif; ?>

								<!-- END Display Error Messages -->

								<!-- START Form -->
								<?php echo form_open( '', array( 'id' => 'edit-team-form', 'data-ajax-url' => base_url("admin/games/edit_ajax/".$record['id'])) ); ?>

								<div class="alert alert-error hide ajax-form-errors">
									<h4>Form Submission Errors</h3>
									<ul>
									<?php echo validation_errors('<li>','</li>'); ?>
									</ul>
								</div>
								<!-- END Display Error Messages -->

								<div class="form-group">
									<?php echo form_label( 'Session*', 'session_id', array( 'class' => 'form-label' ) ); ?>
									<!-- <a href="#" data-toggle="popover" data-placement="right" data-content="Note that these are the active divisions for this session."><i class="fa fa-question-circle"></i></a> -->
									<span class="help">Note that these are the assigned divisions for this session.</span>
									<?php echo form_dropdown( 'session_id', array( '' => '') + $sessions, set_value( 'session_id',$record['session_id'] ), 'id="game-sessions-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/divisions/get_divisions_by_sessions') . '"' ); ?>
								</div>

								<div class="form-group division-dropdowns">
									<?php echo form_label( 'Division *', 'division_id', array( 'class' => 'form-label' ) ); ?> 
									<a href="#" data-toggle="popover" data-placement="right" data-content="Note that these are the active divisions for this session."><i class="fa fa-question-circle"></i></a>
									<span class="help">Note that these are the assigned divisions for this session.</span>
									<?php echo form_dropdown( 'division_id', array( '' => '') + $divisions, set_value( 'division_id', $record['division_id'] ), 'id="game-divisions-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/sessions/get_teams_by_division_ajax') . '"' ); ?>
								</div> 

								<!-- This Loads in Via AJAX After a Division is Selected -->
								<div class='row teams-dropdowns'>
									<div class="form-group col-md-6">
										<?php echo form_label( 'Home Team*', 'team_home_id', array( 'class' => 'form-label' ) ); ?>
										<!-- <i class="fa fa-question-circle pointer" data-toggle="popover" data-placement="bottom" data-content="Only showing teams that are found in the selected division."></i> -->
										<!-- <span class="help">e.g. </span> -->
										<?php echo form_dropdown( 'team_home_id', array( '' => '') + $teams, set_value( 'team_home_id', $record['team_home_id'] ), 'class="pretty-select"' ); ?>
									</div>

									<div class="form-group col-md-6">
										<?php echo form_label( 'Away Team*', 'team_away_id', array( 'class' => 'form-label' ) ); ?>
										<!-- <i class="fa fa-question-circle pointer" data-toggle="popover" data-placement="bottom" data-content="Only showing teams that are found in the selected division."></i> -->
										<!-- <span class="help">e.g. </span> -->
										<?php echo form_dropdown( 'team_away_id', array( '' => '') + $teams, set_value( 'team_away_id', $record['team_away_id'] ), 'class="pretty-select"' ); ?>
									</div>
								</div>


								<div class='row teams-dropdowns'>
									<div class="form-group col-md-6">
										<?php echo form_label( 'Home Score', 'home_score', array( 'class' => 'form-label' ) ); ?>
										<!-- <i class="fa fa-question-circle pointer" data-toggle="popover" data-placement="bottom" data-content="Only showing teams that are found in the selected division."></i> -->
										<!-- <span class="help">e.g. </span> -->
										<?php echo form_input( array('name' => 'score_home', 'class' => 'form-control', 'id' => 'home_score', 'value' => set_value( 'game_date', $record['score_home'] ) ) ); ?>
									</div>

									<div class="form-group col-md-6">
										<?php echo form_label( 'Away Score', 'score_away', array( 'class' => 'form-label' ) ); ?>
										<!-- <i class="fa fa-question-circle pointer" data-toggle="popover" data-placement="bottom" data-content="Only showing teams that are found in the selected division."></i> -->
										<!-- <span class="help">e.g. </span> -->
										<?php echo form_input( array('name' => 'score_away', 'class' => 'form-control', 'id' => 'score_away', 'value' => set_value( 'score_away', $record['score_away'] ) ) ); ?>
									</div>
								</div>



								<div class="row">
									<div class="form-group col-md-6">
										<?php echo form_label( 'Location*', 'location_id', array( 'class' => 'form-label' ) ); ?>
										<?php echo form_dropdown( 'location_id', array( '' => '') + $locations, set_value( 'location_id', $record['location_id']  ), 'id="game-locations-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/locations/get_fields_ajax') . '"' ); ?>
									</div>
									<?php if(!empty($locationfields)): ?>
									<div class="form-group col-md-6 location-fields-dropdown">
										<?php echo form_label( 'Field', 'location_field_id', array( 'class' => 'form-label' ) ); ?>
										<?php echo form_dropdown( 'location_field_id', array( '' => '') + $locationfields, set_value( 'location_field_id', $record['location_field_id'] ),  'class="pretty-select"' ); ?>
									</div>
									<?php endif; ?>

								</div>
								<div class="row">

									<div class="form-group col-md-6">
										<?php echo form_label( 'Game Date*', 'game_date', array( 'class' => 'form-label' ) ); ?>
										<span class="help">mm/dd/yyyy format</span>
										<?php echo form_input( array('name' => 'game_date', 'class' => 'form-control date-mask', 'id' => 'game_date', 'value' => set_value( 'game_date', $time['date'] ) ) ); ?>
									</div>

									<div class="form-group col-md-6">
										<?php echo form_label( 'Game Time*', 'game_time', array( 'class' => 'form-label' ) ); ?>
										<!-- <span class="help">e.g. </span> -->
										<div>
											<div class="input-append bootstrap-timepicker-component">
												<?php echo form_input( array('name' => 'game_time', 'class' => 'form-control timepicker-default', 'id' => 'game_time', 'value' => set_value( 'game_time', $time['hour'] ) ) ); ?>
												<span class="add-on"><span class="arrow"></span><i class="fa fa-clock-o"></i></span>
											</div>
										</div>

									</div>

								</div>

								<?php echo form_hidden('home_start', $record['team_home_id']); ?>

								<?php echo form_hidden('away_start', $record['team_away_id']); ?>


								<button type="submit" class="btn btn-primary">Edit Game</button>

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