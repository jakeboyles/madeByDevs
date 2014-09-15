<div id="content" class="col-md-8 col-md-push-4">

	<h1>Find a Division</h1>

	<?php echo form_open( 'divisions/ajax_search_divisions', array( 'id' => 'search-divisions-form') ); ?>
	<div class="input-group search-group">

		<?php echo form_input( array(
			'name' => 'search', 
			'class' => 'form-control search', 
			'id' => 'search-divisions', 
			'placeholder' => 'Search Divisions', 
			'value' => set_value( 'search' ) 
		) ); ?>

		<span class="input-group-btn">
			<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
	<?php echo form_close(); ?>

	<div class="division-search-results hide">
		<div class="spacer-20px"></div>
		<div class="data-return"></div>
		<hr>
	</div>

	<?php if( !empty( $divisions ) ): ?>
	<h1>Select a Division</h1>
		<ul class="list-grey-alternating">
		<?php foreach( $divisions as $division ): ?>
			<li>
				<a href="<?php echo base_url('divisions/page/'. $division['id']); ?>"><?php echo $division['name']; ?> <i class="fa fa-chevron-right"></i></a>
			</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>

</div>