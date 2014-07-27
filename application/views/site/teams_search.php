<div id="content" class="col-md-8 col-md-push-4">

	<h1>Find a Team</h1>

	<?php echo form_open( 'teams/ajax_search_teams', array( 'id' => 'search-teams-form') ); ?>
	<div class="input-group search-group">

		<?php echo form_input( array(
			'name' => 'search', 
			'class' => 'form-control search', 
			'id' => 'search-teams', 
			'placeholder' => 'Search Teams', 
			'value' => set_value( 'search' ) 
		) ); ?>

		<span class="input-group-btn">
			<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
	<?php echo form_close(); ?>

	<div class="team-search-results hide">
		<div class="spacer-20px"></div>
		<div class="data-return"></div>
		<hr>
	</div>

	<?php if( !empty($teams) ): ?>
	<h1>Select a Team</h1>
		<ul class="list-grey-alternating">
		<?php foreach( $teams as $team ): ?>
			<li>
				<a href="<?php echo base_url('teams/page/'. $team['id']); ?>"><?php echo $team['name']; ?> (<?php echo $team['division']; ?>) <i class="fa fa-chevron-right"></i></a>
			</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>

</div>