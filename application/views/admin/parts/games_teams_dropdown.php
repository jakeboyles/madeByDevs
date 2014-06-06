<div class="row">

	<div class="form-group col-md-6">
		<?php echo form_label( 'Home Team*', 'team_home_id', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_input( array('name' => 'team_home_id', 'class' => 'form-control', 'id' => 'team_home_id', 'value' => set_value( 'team_home_id' ) ) ); ?>
	</div>

	<div class="form-group col-md-6">
		<?php echo form_label( 'Away Team*', 'team_away_id', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. </span> -->
		<?php echo form_input( array('name' => 'team_away_id', 'class' => 'form-control', 'id' => 'team_away_id', 'value' => set_value( 'team_away_id' ) ) ); ?>
	</div>

</div>