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
		<div class="team-schedule hidden-xs">
			<h3><?php echo $league['current_season_name']; ?> Schedule</h3>
			<table class="table table-striped standings">
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

		<?php endif; ?>

		<!-- Team Roster -->
		<?php if( !empty( $roster ) ): ?>
		<div class="roster">

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