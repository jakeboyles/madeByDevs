<!-- Add Record Modal -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo form_open( '', array( 'id' => 'ajax-add-record-form') ); ?>

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<br>
					<h4 id="myModalLabel" class="semi-bold">Adding a New Field For</h4>
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
						<?php echo form_label( 'Field Name*', 'name', array( 'class' => 'form-label' ) ); ?>
						<!-- <span class="help">e.g. </span> -->
						<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name' ) ) ); ?>
					</div>

					<div class="row">

						<div class="form-group col-md-4">
							<?php echo form_label( 'Map Latitude', 'map_latitude', array( 'class' => 'form-label' ) ); ?>
							<!-- <span class="help">e.g. 37.331741</span> -->
							<?php echo form_input( array('name' => 'map_latitude', 'class' => 'form-control', 'id' => 'map_latitude', 'value' => set_value( 'map_latitude' ) ) ); ?>
						</div>

						<div class="form-group col-md-4">
							<?php echo form_label( 'Map Longitude', 'map_longitude', array( 'class' => 'form-label' ) ); ?>
							<!-- <span class="help">e.g. -122.030333</span> -->
							<?php echo form_input( array('name' => 'map_longitude', 'class' => 'form-control', 'id' => 'map_longitude', 'value' => set_value( 'map_longitude' ) ) ); ?>
						</div>

						<div class="form-group col-md-4">
							<?php echo form_label( 'Map Zoom', 'map_zoom', array( 'class' => 'form-label' ) ); ?>
							<span class="help">0-19</span>
							<?php echo form_input( array('name' => 'map_zoom', 'class' => 'form-control', 'id' => 'map_zoom', 'value' => set_value( 'map_zoom' ) ) ); ?>
						</div>

					</div>

					<div class="form-group ">
							<?php echo form_label( 'Field Description', 'description', array( 'class' => 'form-label' ) ); ?>
							<span class="help">e.g. Further details about the location or driving directions.</span>
							<?php echo form_textarea( array('name' => 'description', 'class' => 'form-control', 'id' => 'description', 'value' => set_value( 'description' ) ) ); ?>
					</div>


					<div class="well well-small">
						<i class="fa fa-info-circle"></i> You can find the latitude and longitude via an address by using the <a href="http://itouchmap.com/latlong.html" target="_blank">iTouchMap.com Tool</a>.
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