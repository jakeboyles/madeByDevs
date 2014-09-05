<!-- Add Record Modal -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open( '', array( 'id' => 'ajax-add-record-form') ); ?>

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<br>
					<h4 id="myModalLabel" class="semi-bold">Adding a New Player For <?php echo $record['name']; ?></h4>
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
							<?php echo form_label( 'First Name *', 'first_name', array( 'class' => 'form-label' ) ); ?>
							<?php echo form_input( array('name' => 'first_name', 'class' => 'form-control', 'id' => 'first_name', 'value' => set_value( 'first_name' ) ) ); ?>
						</div>

						<div class="form-group">
							<?php echo form_label( 'Last Name *', 'last_name', array( 'class' => 'form-label' ) ); ?>
							<?php echo form_input( array('name' => 'last_name', 'class' => 'form-control', 'id' => 'last_name', 'value' => set_value( 'last_name' ) ) ); ?>
						</div>

						<div class="form-group">
							<?php echo form_label( 'Date of Birth *', 'birthday', array( 'class' => 'form-label' ) ); ?>
							<?php echo form_input( array('name' => 'birthday', 'class' => 'form-control', 'id' => 'date_of_birth', 'value' => set_value( 'date_of_birth' ) ) ); ?>
						</div>

						<div class="form-group">
							<?php echo form_label( 'Email *', 'last_name', array( 'class' => 'form-label' ) ); ?>
							<?php echo form_input( array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value( 'email' ) ) ); ?>
						</div>
						

						<div class="form-group">
							<?php echo form_label( 'Position', 'positions', array( 'class' => 'form-label' ) ); ?>
							<?php echo form_dropdown( 'position', array( '' => '') + $positions, set_value('positions'), 'class="pretty-select"' ); ?>
						</div>


						<div class="form-group">
							<?php echo form_label( 'Number', 'number', array( 'class' => 'form-label' ) ); ?>
							<span class="help">0-999</span>
							<?php echo form_input( array('name' => 'number', 'class' => 'form-control', 'id' => 'number', 'value' => set_value( 'number' ) ) ); ?>
						</div>


				</div>

				<div class="modal-footer">
					<div class="alert alert-error text-center hide">
						This record cannot be deleted as there is data that is attached to it.
					</div>

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" data-action="add-row" data-id="">Add Player</button>
				</div>

				<?php echo form_hidden( 'user_type_id', '3' ); ?>
				<?php echo form_hidden( 'password', 'password' ); ?>
				<?php echo form_hidden( 'password_confirm', 'password' ); ?>

			<?php echo form_close(); ?>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>