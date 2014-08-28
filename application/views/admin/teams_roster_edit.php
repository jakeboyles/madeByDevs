<!-- Edit Record Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open( '', array( 'id' => 'ajax-edit-record-form') ); ?>

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<br>
					<h4 id="myModalLabel" class="semi-bold">Adding a New Player For</h4>
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

					<!-- This will load in via AJAX from application/views/admin/parts/location_fields_edit_form.php -->
					<div class="form-fields"></div>

					<div class="well well-small">
						<i class="fa fa-info-circle"></i> You can find the latitude and longitude via an address by using the <a href="http://itouchmap.com/latlong.html" target="_blank">iTouchMap.com Tool</a>.
					</div>

				</div>

				<div class="modal-footer">
					<div class="alert alert-error text-center hide">
						This record cannot be deleted as there is data that is attached to it.
					</div>

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" data-action="add-row" data-id="">Edit Field</button>
				</div>

				<?php echo form_hidden( 'parent_id', $record['id'] ); ?>
				<?php echo form_hidden( 'edit_field', TRUE ); ?>
			<?php echo form_close(); ?>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>