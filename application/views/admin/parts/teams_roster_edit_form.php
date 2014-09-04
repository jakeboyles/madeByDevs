	
	<div class="form-group">
		<?php echo form_label( 'Add Player', 'players', array( 'class' => 'form-label' ) ); ?>
		<?php echo form_dropdown( 'player_id', array( '' => '') + $players, set_value('players',$record[0]['user_id']), 'class="pretty-select"' ); ?>
	</div>

	<div class="form-group">
		<?php echo form_label( 'Position', 'positions', array( 'class' => 'form-label' ) ); ?>
		<?php echo form_dropdown( 'position', array( '' => '') + $positions, set_value('positions',$record[0]['position_id']), 'class="pretty-select"' ); ?>
	</div>

	<div class="form-group">
		<?php echo form_label( 'Number', 'number', array( 'class' => 'form-label' ) ); ?>
		<span class="help">0-999</span>
		<?php echo form_input( array('name' => 'number', 'class' => 'form-control', 'id' => 'number', 'value' => set_value( 'number', $record[0]['player_number'] ) ) ); ?>
	</div>









