<div class="row">

	<?php if( $teams ): ?>

		<div class="form-group col-md-6">
			<?php echo form_label( 'Home Team*', 'team_home_id', array( 'class' => 'form-label' ) ); ?>
			<!-- <i class="fa fa-question-circle pointer" data-toggle="popover" data-placement="bottom" data-content="Only showing teams that are found in the selected division."></i> -->
			<!-- <span class="help">e.g. </span> -->
			<?php echo form_dropdown( 'team_home_id', array( '' => '') + $teams, set_value( 'team_home_id' ), 'class="pretty-select"' ); ?>
		</div>

		<div class="form-group col-md-6">
			<?php echo form_label( 'Away Team*', 'team_away_id', array( 'class' => 'form-label' ) ); ?>
			<!-- <i class="fa fa-question-circle pointer" data-toggle="popover" data-placement="bottom" data-content="Only showing teams that are found in the selected division."></i> -->
			<!-- <span class="help">e.g. </span> -->
			<?php echo form_dropdown( 'team_away_id', array( '' => '') + $teams, set_value( 'team_away_id' ), 'class="pretty-select"' ); ?>
		</div>

	<?php else: ?>

		<div class="col-md-12">

			<div class="well well-small">
				<i class="fa fa-info-circle"></i> There are not any teams assigned to this division.
			</div>

		</div>

	<?php endif; ?>

</div>