<?php if(!empty($games)): ?>
	<div class="form-group">
		<?php echo form_label( 'Game', 'game_id', array( 'class' => 'form-label' ) ); ?>
		<?php echo form_dropdown( 'game_id', array( '' => '') + $games, set_value( 'game_id' ), 'id="game-select-dropdown" class="pretty-select col-xs-12"  data-ajax-url="' . base_url('admin/teams/get_teams_by_game') . '"'  ); ?>
	</div>
	<br>

<?php else: ?>

<div class="alert alert-error">
<P>There Are No Games On This Date</p>
</div>

<?php endif; ?>