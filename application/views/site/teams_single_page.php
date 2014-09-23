<div id="content" class="col-md-8 col-md-push-4">

	<?php if( !empty( $team ) ): ?>
	<div class="team">

		<h1 class="pull-left"><?php echo $team['name']; ?></h1>
		<?php if(!empty($is_captain)) : ?>
			<a class="pull-right team-edit btn btn-primary" href="<?php echo base_url('teams/edit').'/'.$team['id']; ?>">Edit</a>
		<?php endif; ?>

		<?php if(!empty($photos[0])):?>
			<div class="main_photo">
				<a href="<?php echo base_url('uploads')."/".$photos[0]['filename'] ?>" data-lightbox="team"><img src="<?php echo base_url('uploads')."/".$photos[0]['filename'] ?>" /></a>
				<?php if(!empty($logo['filename'])): ?>
				<div class="team_logo">
					<img class="pull-left" src='<?php echo base_url('uploads')."/".$logo['filename'] ?>'>
				</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="row sub-photos">
			<?php if(!empty($photos[1])):?>
			<div class="col-xs-4">
				<a href="<?php echo base_url('uploads')."/".$photos[1]['filename'] ?>" data-lightbox="team" ><img src="<?php echo base_url('uploads')."/".$photos[1]['filename'] ?>" /></a>
			</div>
			<? endif; ?>
			<?php if(!empty($photos[2])):?>
			<div class="col-xs-4">
				<a href="<?php echo base_url('uploads')."/".$photos[2]['filename'] ?>" data-lightbox="team"><img src="<?php echo base_url('uploads')."/".$photos[2]['filename'] ?>" /></a>
			</div>
			<? endif; ?>
			<?php if(!empty($photos[3])):?>
			<div class="col-xs-4">
				<a href="#" class="viewMorePhotos">View More Photos</a>
			</div>
			<? endif; ?>
		</div>
		<br>


		<!-- Team Photos Section -->
		<?php if( !empty( $photos ) ): ?>
		<div class="photos"></div>
		<?php endif; ?>

		<!-- Team Description -->
		<?php if( !empty( $team['description'] ) ): ?>
		<div class="description">
			<?php echo nl2br( $team['description'] ); ?>
		</div>
		<?php endif; ?>

		<!-- Team Schedule -->
		<?php if( !empty( $games) ): ?>

			<!-- Team Schedule (Desktop) -->
			<div class="alternating-table-container hidden-xs">
				<h3><?php echo $league['current_season_name']; ?> Schedule</h3>
				<table class="table table-striped stripe-pattern-one">
					<thead>
						<tr>
							<th>Date</th>
							<th>Field</th>
							<th>Opponent</th>
							<th>Result</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach( $games as $game ): ?>
						<tr>
							<td><?php echo date( 'M j Y - g:ia', strtotime( $game['game_date_time'] ) ); ?>
							<td>
								<a href="<?php echo base_url( 'directions/location/' . $game['location_id'] ); ?>">
									<?php echo $game['location']; ?>
									<?php if( !empty( $game['location_field'] ) ) echo '(' . $game['location_field'] . ')'; ?>
								</a>
							</td>
							<td>
								<a href="<?php echo base_url('teams/page/' . $game['opponent_team_id']); ?>">
									<?php echo $game['opponent_team_name']; ?>
								</a>
							</td>
							<td>
								<?php echo $game['score_home'] . '-' . $game['score_away']; ?>
								<?php echo !empty( $game['result'] ) ? ' (' . $game['result'] . ')' : ''; ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<!-- Team Schedule (Mobile) -->
			<div class="mobile-expand-list visible-xs">
				<h3><?php echo $league['current_season_name']; ?> Schedule</h3>
				<ul class="content">
					<?php foreach( $games as $game ): ?>
					<li>
						<a href="#"><?php echo date( 'M j Y - g:ia', strtotime( $game['game_date_time'] ) ); ?><i class="fa fa-chevron-right"></i></a>
						<ul>
							<li>
								<h5 class="title">Field</h5>
								<h6 class="option">
									<a href="<?php echo base_url( 'directions/location/' . $game['location_id'] ); ?>">
										<?php echo $game['location']; ?>
										<?php if( !empty( $game['location_field'] ) ) echo '(' . $game['location_field'] . ')'; ?>
									</a>
								</h6>
								<h5 class="title">Opponent</h5>
								<h6 class="option">
									<a href="<?php echo base_url('teams/page/' . $game['opponent_team_id']); ?>">
										<?php echo $game['opponent_team_name']; ?>
									</a>
								</h6>
								<h5 class="title">Result</h5>
								<h6 class="option">
									<?php echo $game['score_home'] . '-' . $game['score_away']; ?>
									<?php echo !empty( $game['result'] ) ? ' (' . $game['result'] . ')' : ''; ?>
								</h6>
							</li>
						</ul>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>

		<?php endif; ?>

		<!-- Team Roster -->
		<?php if( !empty( $roster ) ): ?>

			<!-- Team Roster (Desktop) -->
			<div class="alternating-table-container hidden-xs">
				<h3><?php echo $league['current_season_name']; ?> Roster</h3>
				<table class="table table-striped stripe-pattern-one">
					<thead>
						<tr>
							<th>Player Name</th>
							<th>Position</th>
							<th>Number</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach( $roster as $player ): ?>
						<tr>
							<td><?php echo $player['first_name'] . ' ' . $player['last_name']; ?></td>
							<td><?php echo $player['position']; ?></td>
							<td><?php echo $player['player_number']; ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<!-- Team Roster (Mobile) -->
			<div class="mobile-expand-list visible-xs">
				<h3><?php echo $league['current_season_name']; ?> Roster</h3>
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
							</li>
						</ul>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>

		<?php endif; ?>

		<!-- Team History -->
		<!-- To Do: Display team history. Not currently in scope -->


	<?php if(!empty($team['additional_info'])): ?>
		<h3>Additonal Information</h3>
		<p><?php echo $team['additional_info']; ?></p>
	<?php endif; ?>


	</div>
	<?php else: ?>

		<h1>Team Not Found</h1>
		<p>It appears you have visited a team page that does not exists. Please try our <a href="<?php echo base_url('teams'); ?>">team search page</a> to find the team you are looking for.</p>
	
	<?php endif; ?>

	<div class="hidden_images_lightbox">
		<?php 
		$counter = 0;
		if(!empty($photos)):
			foreach($photos as $photo): 
				if($counter>2 && $counter<15):
		?>
					<a class="hidden" href="<?php echo base_url('uploads')."/".$photo['filename'] ?>" data-lightbox="team" ><img src="<?php echo base_url('uploads')."/".$photo['filename'] ?>" /></a>
		<?php 
				endif;
				$counter++;
			endforeach; 
		endif;
		?>
	</div>

</div>