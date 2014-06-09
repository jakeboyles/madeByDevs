<div class="row">

	<div class="form-group col-md-6">
		<?php echo form_label( 'Home Team*', 'team_home_id', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_dropdown( 'team_home_id', array( '' => '') + $teams, set_value( 'team_home_id' ), 'class="pretty-select"' ); ?>
	</div>

	<div class="form-group col-md-6">
		<?php echo form_label( 'Away Team*', 'team_away_id', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_dropdown( 'team_away_id', array( '' => '') + $teams, set_value( 'team_away_id' ), 'class="pretty-select"' ); ?>
	</div>

</div>