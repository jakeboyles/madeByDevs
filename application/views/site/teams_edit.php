<div id="content" class="team_edit col-md-8 col-md-push-4">
	<div class="row">
		<h1 class='pull-left'>Manage Team - <?php echo $record['name']; ?></h1>
		<a class="pull-right view_page btn btn-primary" href="/teams/page/<?php echo $record['id']?>" class='btn btn-primary'>View Page</a>
	</div>

	<?php if(validation_errors() && $this->input->post()): ?>
	<div class="alert alert-error">
		<h4>Form Submission Errors</h3>
		<ul>
		<?php echo validation_errors('<li>','</li>'); ?>
		</ul>
	</div>
	<?php endif; ?>
	<!-- END Display Error Messages -->

	<!-- START Success Message -->
	<?php if( !validation_errors() && $this->input->post() && !$errors['errors'] ): ?>
	<div class="alert alert-success">
		This record has been updated.
	</div>
	<?php endif; ?>
	<!-- END Success Message -->

	<?php if($errors['errors']): ?>
	<div class="alert alert-error">
		<h4>Form Submission Errors</h3>
		<ul>
		<?php echo $errors['errors']; ?>
		</ul>
	</div>
	<?php endif; ?>




	<div class="row">
		<ul class="col-xs-12 nav nav-tabs" role="tablist">
		  <li class="active"><a href="#photos" role="tab" data-toggle="tab">Photos</a></li>
		  <li><a href="#roster" role="tab" data-toggle="tab">Roster</a></li>
		</ul>
	</div>



<div class="tab-content">

	<div class="tab-pane fade in active" id="photos">
		<br>
		<?php echo form_open_multipart( 'teams/add_logo/'.$record['id'], array( 'id' => 'add-location-form') ); ?>

			<div class="row">
				<div class="form-group col-xs-6">
					<?php echo form_label( 'Team Logo *', 'logo', array( 'class' => 'form-label' ) ); ?>
					<?php echo form_upload( array('name' => 'logo', 'class' => 'form-controll', 'id' => 'logo', 'value' => set_value( 'logo' ) ) ); ?>
				</div>

				<?php if(!empty($logo['filename'])): ?>
					<div class="logo_box col-xs-6">
						<img class='team_logo' src='<?php echo base_url('/uploads') . '/' . $logo['filename'] ?>' />
					</div>
				<?php endif; ?>
			</div>

			<h2>Add / Edit - Team Photos</h2>

			<div class="form-group">
					<?php echo form_label( 'Team Photo', 'photo1', array( 'class' => 'form-label' ) ); ?>
					<?php echo form_upload( array('name' => 'photo_one', 'class' => 'form-control', 'id' => 'photo1', 'value' => set_value( 'photo1' ) ) ); ?>
			</div>

			<div class="form-group">
					<?php echo form_label( 'Team Photo 2', 'photo2', array( 'class' => 'form-label' ) ); ?>
					<?php echo form_upload( array('name' => 'photo_two', 'class' => 'form-control', 'id' => 'photo2', 'value' => set_value( 'photo2' ) ) ); ?>
			</div>

			<div class="form-group">
					<?php echo form_label( 'Team Photo 3', 'photo3', array( 'class' => 'form-label' ) ); ?>
					<?php echo form_upload( array('name' => 'photo_three', 'class' => 'form-control', 'id' => 'photo3', 'value' => set_value( 'photo3' ) ) ); ?>
			</div>

			<br>
			<button type="submit" class="btn btn-primary">Update Images</button>

		<?php echo form_hidden( 'add_location', TRUE ); ?>
		<?php echo form_close(); ?>
	</div>


	<div class="tab-pane fade in" id="roster">

		<h3 class="col-md-6"><?php if(!empty($league['current_season_name'])): echo $league['current_season_name']; endif; ?> Roster</h3>
		<div class="col-md-6">
			<a class="pull-right btn btn-primary" href="#" id="ajaxButton" class="btn btn-primary" data-ajax-url="<?php echo base_url('teams/add_player/' . $record['id']); ?>" data-toggle="modal" data-target="#add-modal" data-label="" data-row-id="<?php echo $record['id']; ?>">Add Player</a>
		</div>


		<?php if(!empty($roster)): ?>
		<!-- Team Roster (Desktop) -->
			<div class="alternating-table-container hidden-xs">
				<div class="row">
				</div>
				<table class="col-xs-12 table table-striped stripe-pattern-one">
					<thead>
						<tr>
							<th>Player Name</th>
							<th>Position</th>
							<th>Number</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach( $roster as $player ): ?>
						<tr class="<?php echo $player['id'];?>">
							<td><?php echo $player['first_name'] . ' ' . $player['last_name']; ?></td>
							<td><?php echo $player['position']; ?></td>
							<td><?php echo $player['player_number']; ?></td>
							<td>
								<a href="#" class="editModal btn active btn-primary" data-ajax-url="<?php echo base_url('teams/edit_player/' . $player['user_id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $player['id']; ?>"><i class="fa fa-edit"></i></a>
								<a href="#" class="btn active btn-danger" data-ajax-url="<?php echo base_url('teams/delete_player/' . $player['user_id']); ?>" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $player['first_name'] . " " . $player['last_name']; ?>" data-row-id="<?php echo $player['user_id']; ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<!-- Team Roster (Mobile) -->
			<div class="mobile-expand-list visible-xs">
				<ul class="content">
					<?php foreach( $roster as $player ): ?>
					<li>
						<a href="#"><?php echo $player['first_name'] . ' ' . $player['last_name']; ?><i class="fa fa-chevron-right"></i></a>
						<ul>
							<li>
								<h5 class="title">Position</h5>
								<h6 class="option">
									<?php echo $player['position']; ?>
								</h6>
								<h5 class="title">Number</h5>
								<h6 class="option">
									<?php echo $player['player_number']; ?>
								</h6>
								<h5 class="title">Manage</h5>
								<h6 class="option">
									<a href="#" class="editModal btn active btn-primary" data-ajax-url="<?php echo base_url('teams/edit_player/' . $player['user_id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $player['id']; ?>"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn active btn-danger" data-ajax-url="<?php echo base_url('teams/delete_player/' . $player['user_id']); ?>" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $player['first_name'] . " " . $player['last_name']; ?>" data-row-id="<?php echo $player['user_id']; ?>"><i class="fa fa-times"></i></a>
								</h6>
							</li>
						</ul>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php else: ?>

		<div class="alternating-table-container hidden-xs">
				<div class="row">
				</div>
				<table class="col-xs-12 table table-striped stripe-pattern-one">
					<thead>
						<tr>
							<th>Player Name</th>
							<th>Position</th>
							<th>Number</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

			<!-- Team Roster (Mobile) -->
			<div class="mobile-expand-list visible-xs">
				<ul class="content">
					<li>
						<a href="#"><i class="fa fa-chevron-right"></i></a>
						<ul>
							<li>
								<h5 class="title">Position</h5>
								<h6 class="option">
								</h6>
								<h5 class="title">Number</h5>
								<h6 class="option">
								</h6>
								<h5 class="title">Manage</h5>
								<h6 class="option">
								</h6>
							</li>
						</ul>
					</li>
				</ul>
			</div>

		<?php endif; ?>
	
	</div>

</div>

</div>

<!-- Load in Add Record Modal -->
<?php $this->load->view('site/teams_roster_add'); ?>

<?php $this->load->view('site/teams_roster_edit'); ?>


