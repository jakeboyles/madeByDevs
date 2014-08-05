<div id="content" class="col-md-8 col-md-push-4">

	<?php if( !empty( $team ) ): ?>
	<div class="team">

		<h1><?php echo $team['name']; ?></h1>

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


	</div>
	<?php else: ?>

		<h1>Team Not Found</h1>
		<p>It appears you have visited a team page that does not exists. Please try our <a href="<?php echo base_url('teams'); ?>">team search page</a> to find the team you are looking for.</p>
	
	<?php endif; ?>

</div>