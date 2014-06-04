<div class="form-group">
	<?php echo form_label( 'Field Name*', 'name', array( 'class' => 'form-label' ) ); ?>
	<!-- <span class="help">e.g. </span> -->
	<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name', $record['name'] ) ) ); ?>
</div>

<div class="row">

	<div class="form-group col-md-4">
		<?php echo form_label( 'Map Latitude', 'map_latitude', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. 37.331741</span> -->
		<?php echo form_input( array('name' => 'map_latitude', 'class' => 'form-control', 'id' => 'map_latitude', 'value' => set_value( 'map_latitude', $record['map_latitude'] ) ) ); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo form_label( 'Map Longitude', 'map_longitude', array( 'class' => 'form-label' ) ); ?>
		<!-- <span class="help">e.g. -122.030333</span> -->
		<?php echo form_input( array('name' => 'map_longitude', 'class' => 'form-control', 'id' => 'map_longitude', 'value' => set_value( 'map_longitude', $record['map_longitude'] ) ) ); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo form_label( 'Map Zoom', 'map_zoom', array( 'class' => 'form-label' ) ); ?>
		<span class="help">0-19</span>
		<?php echo form_input( array('name' => 'map_zoom', 'class' => 'form-control', 'id' => 'map_zoom', 'value' => set_value( 'map_zoom', $record['map_zoom'] ) ) ); ?>
	</div>

</div>