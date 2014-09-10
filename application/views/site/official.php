<div id="content" class="clearfix col-xs-12 col-xs-push-0 col-md-8 col-md-push-4">
	<h1 class=''>Official Dashboard</h1>

	<?php echo form_open_multipart( '/users/add_game_record', array( 'id' => 'add-team-form', 'class' => 'col-xs-12') ); ?>

	<div class="form-group">
		<?php echo form_label( 'Date *', 'date', array( 'class' => 'form-label' ) ); ?>
		<?php echo form_input( array('name' => 'date', 'data-ajax-url' => base_url('admin/games/get_games_by_date'),  'class' => 'form-control date input-append', 'id' => 'date-selector-dropdown', 'value' => set_value( 'dates', date('m/d/Y',time()) )  ) ); ?>
	</div>

	<div class='games-dropdown'></div>

	<!-- This Loads in Via AJAX After a Division is Selected -->
	<div class="users-dropdowns"></div>

		<!-- This Loads in Via AJAX After a Division is Selected -->
	<div class="hide teams-dropdowns"></div>

</div>