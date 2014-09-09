	<?php if(!empty($players)): ?>
	<div class="form-group">
		<?php echo form_label( 'Players', 'players', array( 'class' => 'form-label' ) ); ?>
		<?php echo form_dropdown( 'players', array( '' => '') + $players, set_value( 'players' ), ' class="pretty-select" ' ); ?>
	</div>
	<?php else: ?>
	<p>There are no players on this team</p>
	<?php endif; ?>