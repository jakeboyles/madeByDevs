<!-- Add Record Modal -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open( '', array( 'id' => 'ajax-add-record-form') ); ?>

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<br>
					<h4 id="myModalLabel" class="semi-bold">Adding a New Game For</h4>
					<h3 class="no-margin"><?php echo $record['name']; ?></h3>
					<br>
				</div>

				<div class="modal-body">

					<!-- START Display Error Messages -->
					<div class="alert alert-error hide ajax-form-errors">
						<h4>Form Submission Errors</h3>
						<ul>
						<?php echo validation_errors('<li>','</li>'); ?>
						</ul>
					</div>
					<!-- END Display Error Messages -->

					<div class="form-group">
						<?php echo form_label( 'Division*', 'division_id', array( 'class' => 'form-label' ) ); ?>
						<a href="#" data-toggle="popover" data-placement="right" data-content="Note that these are the active divisions for this session."><i class="fa fa-question-circle"></i></a>
						<!-- <span class="help">e.g. </span> -->
						<?php echo form_dropdown( 'division_id', array( '' => '') + $related_divisions, set_value( 'division_id' ), 'id="game-divisions-dropdown" class="pretty-select" data-ajax-url="' . base_url('admin/sessions/get_teams_by_division') . '"' ); ?>
					</div>

					<!-- This Loads in Via AJAX After a Division is Selected -->
					<div class="teams-dropdowns"></div>

					<div class="form-group">
						<?php echo form_label( 'Game Date/Time*', 'game_time', array( 'class' => 'form-label' ) ); ?>
						<!-- <span class="help">e.g. </span> -->
						<?php echo form_input( array('name' => 'game_time', 'class' => 'form-control', 'id' => 'game_time', 'value' => set_value( 'game_time' ) ) ); ?>
					</div>

				</div>

				<div class="modal-footer">
					<div class="alert alert-error text-center hide">
						This record cannot be deleted as there is data that is attached to it.
					</div>

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" data-action="add-row" data-id="">Add Field</button>
				</div>

				<?php echo form_hidden( 'parent_id', $record['id'] ); ?>
				<?php echo form_hidden( 'add_field', TRUE ); ?>
			<?php echo form_close(); ?>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>