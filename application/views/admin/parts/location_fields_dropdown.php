<?php echo form_label( 'Field', 'location_field_id', array( 'class' => 'form-label' ) ); ?>
<!-- <span class="help">e.g. </span> -->
<?php echo form_dropdown( 'location_field_id', array( '' => '') + $locations, set_value( 'location_field_id' ), 'class="pretty-select"' ); ?>