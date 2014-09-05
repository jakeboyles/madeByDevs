<div class="form-group">
	<?php echo form_label( 'First Name *', 'first_name', array( 'class' => 'form-label' ) ); ?>
	<?php echo form_input( array('name' => 'first_name', 'class' => 'form-control', 'id' => 'first_name', 'value' => set_value( 'first_name', $record['first_name'] ) ) ); ?>
</div>

<div class="form-group">
	<?php echo form_label( 'Last Name *', 'last_name', array( 'class' => 'form-label' ) ); ?>
	<?php echo form_input( array('name' => 'last_name', 'class' => 'form-control', 'id' => 'last_name', 'value' => set_value( 'last_name',$record['last_name'] ) ) ); ?>
</div>

<div class="form-group">
	<?php echo form_label( 'Date of Birth *', 'birthday', array( 'class' => 'form-label' ) ); ?>
	<?php echo form_input( array('name' => 'birthday', 'class' => 'form-control', 'id' => 'date_of_birth', 'value' => set_value( 'date_of_birth',$record['birthday'] ) ) ); ?>
</div>

<div class="form-group">
	<?php echo form_label( 'Email *', 'last_name', array( 'class' => 'form-label' ) ); ?>
	<?php echo form_input( array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value( 'email',$record['email'] ) ) ); ?>
</div>

<div class="form-group">
	<?php echo form_label( 'Position', 'positions', array( 'class' => 'form-label' ) ); ?>
	<?php echo form_dropdown( 'position', array( '' => '') + $positions, set_value('positions',$player_info[0]['position_id']), 'class="pretty-select"' ); ?>
</div>

<div class="form-group">
	<?php echo form_label( 'Number', 'number', array( 'class' => 'form-label' ) ); ?>
	<span class="help">0-999</span>
	<?php echo form_input( array('name' => 'number', 'class' => 'form-control', 'id' => 'number', 'value' => set_value( 'number', $player_info[0]['player_number'] ) ) ); ?>
</div>