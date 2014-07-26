<div class="col-md-8 col-md-push-4">

	<h1>Find a Field</h1>

	<?php echo form_open( 'directions/ajax_search_locations', array( 'id' => 'search-locations-form') ); ?>
	<div class="input-group search-group">

		<?php echo form_input( array(
			'name' => 'search', 
			'class' => 'form-control search', 
			'id' => 'search-locations', 
			'placeholder' => 'Search Fields', 
			'value' => set_value( 'search' ) 
		) ); ?>

		<span class="input-group-btn">
			<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
	<?php echo form_close(); ?>

	<div class="location-search-results hide">
		<div class="spacer-20px"></div>
		<div class="data-return"></div>
		<hr>
	</div>

	

</div>