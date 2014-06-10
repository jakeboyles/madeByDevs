<div class="form-group">
	<?php echo form_label( 'Division*', 'division_id', array( 'class' => 'form-label' ) ); ?>
	<!-- <a href="#" data-toggle="popover" data-placement="right" data-content="Note that these are the active divisions for this session."><i class="fa fa-question-circle"></i></a> -->
	<span class="help">Note that these are the assigned divisions for this session.</span>
	<?php echo form_dropdown( 'division_id', array( '' => '') + $related_divisions, set_value( 'division_id', $record['division_id'] ), 'id="game-divisions-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/sessions/get_teams_by_division_ajax') . '"' ); ?>
</div>

<div class="teams-dropdowns">
	<div class="row">

		<div class="form-group col-md-6">
			<?php echo form_label( 'Home Team*', 'team_home_id', array( 'class' => 'form-label' ) ); ?>
			<i class="fa fa-question-circle pointer" data-toggle="popover" data-placement="bottom" data-content="Only showing teams that are found in the selected division."></i>
			<!-- <span class="help">e.g. </span> -->
			<?php echo form_dropdown( 'team_home_id', array( '' => '') + $teams, set_value( 'team_home_id', $record['team_home_id'] ), 'class="pretty-select"' ); ?>
		</div>

		<div class="form-group col-md-6">
			<?php echo form_label( 'Away Team*', 'team_away_id', array( 'class' => 'form-label' ) ); ?>
			<i class="fa fa-question-circle pointer" data-toggle="popover" data-placement="bottom" data-content="Only showing teams that are found in the selected division."></i>
			<!-- <span class="help">e.g. </span> -->
			<?php echo form_dropdown( 'team_away_id', array( '' => '') + $teams, set_value( 'team_away_id', $record['team_away_id'] ), 'class="pretty-select"' ); ?>
		</div>

	</div>
</div>

<div class="row">

	<div class="form-group col-md-6">
		<?php echo form_label( 'Location*', 'location_id', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_dropdown( 'location_id', array( '' => '') + $locations, set_value( 'location_id', $record['location_id'] ), 'id="game-locations-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/locations/get_fields_ajax') . '"' ); ?>
	</div>

	<?php if( !empty( $location_fields ) ): ?>
	<div class="form-group col-md-6">
		<div class="location-fields-dropdown">
			<?php echo form_label( 'Field', 'location_field_id', array( 'class' => 'form-label' ) ); ?>
			<!-- <span class="help">e.g. </span> -->
			<?php echo form_dropdown( 'location_field_id', array( '' => '') + $location_fields, set_value( 'location_field_id', $record['location_field_id'] ), 'class="pretty-select"' ); ?>
		</div>
	</div>
	<?php endif; ?>

</div>

<div class="row">

	<div class="form-group col-md-6">
		<?php echo form_label( 'Game Date*', 'game_date', array( 'class' => 'form-label' ) ); ?>
		<span class="help">mm/dd/yyyy format</span>
		<?php echo form_input( array('name' => 'game_date', 'class' => 'form-control date-mask', 'id' => 'game_date', 'value' => set_value( 'game_date', date('m/d/Y', strtotime( $record['game_date_time'] ) ) ) ) ); ?>
	</div>

	<div class="form-group col-md-6">
		<?php echo form_label( 'Game Time*', 'game_time', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<div>
			<div class="input-append bootstrap-timepicker-component">
				<?php echo form_input( array('name' => 'game_time', 'class' => 'form-control timepicker-default', 'id' => 'game_time', 'value' => set_value( 'game_time', date('h:i A', strtotime( $record['game_date_time'] ) ) ) ) ); ?>
				<span class="add-on"><span class="arrow"></span><i class="fa fa-clock-o"></i></span>
			</div>
		</div>

	</div>

</div>

<div class="row">

	<div class="form-group col-md-6">
		<?php echo form_label( 'Home Score', 'score_home', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_input( array('name' => 'score_home', 'class' => 'form-control', 'id' => 'score_home', 'value' => set_value( 'score_home', $record['score_home'] == NULL ? 0 : $record['score_home'] ) ) ); ?>
	</div>

	<div class="form-group col-md-6">
		<?php echo form_label( 'Away Score', 'score_away', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_input( array('name' => 'score_away', 'class' => 'form-control', 'id' => 'score_away', 'value' => set_value( 'score_away', $record['score_away'] == NULL ? 0 : $record['score_away']  ) ) ); ?>
	</div>

</div>

