<div id="content" class="col-md-8 col-md-push-4">

	<h1><?php echo $main_team['name']; ?></h1>


	<!-- Desktop Current Season Standings -->
	<div class="team-standings hidden-xs">
		<div class="team-header">
			<h3 class="team-name-primary"><?php echo $main_team['name']; ?> </h3>
			<h3 class="team-name-secondary">History</h3>
			<!-- <h5 class="team-date">fall 2012</h5> -->
		</div>

		<table class="table sortable-table table-striped stripe-pattern-one">
			<thead>
				<tr>
					<th>Opponent</th>
					<th>Wins</th>
					<th>Losses</th>
					<th>Ties</th>
					<th>GF</th>
					<th>GA</th>

				</tr>
				<tr>
					<th colspan="6"><div class="dashed">&nbsp;</div></th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($history)): ?>
				<?php foreach($history as $team): 
				?>
					<tr>
						<td><a href="<?php echo base_url('teams/head_to_head').'/'.$main_team['id'].'-'.$team['opponent_id'] ;?>"><?php echo $team['name']; ?></a></td>
						<td>
							<?php 
							if(!empty($team['win']))
							{
							echo $team['win']; 
							}
							else
							{
							echo '0';
							}
							?>
						</td>
						<td>
							<?php 
							if(!empty($team['loss']))
							{
							echo $team['loss']; 
							}
							else
							{
								echo '0';
							}
							?>
						</td>
						<td>
							<?php 
							if(!empty($team['tie']))
							{
							echo $team['tie']; 
							}
							else
							{
								echo '0';
							}
							?>
						</td>

						<td>
							<?php 
							if(!empty($team['goals_for']))
							{
							echo $team['goals_for']; 
							}
							else
							{
								echo '0';
							}
							?>
						</td>

						<td>
							<?php 
							if(!empty($team['goals_against']))
							{
							echo $team['goals_against']; 
							}
							else
							{
								echo '0';
							}
							?>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php endif; ?>
				
			</tbody>
		</table>
	</div>

	

	<!-- Team Roster (Mobile) -->
	<div class="mobile-expand-list visible-xs">
		<h3> History</h3>
		<ul class="content">
			<?php foreach( $history as $team ): ?>
			<li class="visible-xs">
				<ul class="visible-xs">
					<li class="visible-xs">
						<h5 class="title">Opponnet</h5>
						<h6 class="option">
							<a href="<?php echo base_url('teams/head_to_head').'/'.$main_team['id'].'-'.$team['opponent_id'] ;?>"><?php echo $team['opponent']; ?></a>
						</h6>
						<h5 class="title">Score</h5>
						<h6 class="option">
							<?php echo $team['score_home'] . "-" . $team["score_away"]; ?>
						</h6>
						<h5 class="title">Result</h5>
						<h6 class="option">
							<?php if($team['win']=='1'):?>
							Won
							<?php elseif($team['tie']=='1'): ?>
							Tie
							<?php else: ?>
							Lost
							<?php endif; ?>
						</h6>
						<h5 class="title">Date</h5>
						<h6 class="option">
							<?php echo date('m/d/Y h:m A',strtotime($team['game_date_time'])); ?>
						</h6>
					</li>
				</ul>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>



</div>