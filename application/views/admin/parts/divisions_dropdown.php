<?php if( $divisions ): ?>

<div class="form-group">
	<?php echo form_label( 'Division *', 'division_id', array( 'class' => 'form-label' ) ); ?> 
	<a href="#" data-toggle="popover" data-placement="right" data-content="Note that these are the active divisions for this session."><i class="fa fa-question-circle"></i></a>
	<span class="help">Note that these are the assigned divisions for this session.</span>
	<?php echo form_dropdown( 'division_id', array( '' => '') + $divisions, set_value( 'division_id' ), 'id="game-divisions-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/sessions/get_teams_by_division_ajax') . '"' ); ?>
</div> 

<?php else: ?>

		<div class="col-md-12">

			<div class="well well-small">
				<i class="fa fa-info-circle"></i> There are not any divisions in this session
			</div>

		</div>

<?php endif; ?>

