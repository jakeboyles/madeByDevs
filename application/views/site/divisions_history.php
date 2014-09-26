<div id="content" class="col-md-8 col-md-push-4">
	<h1><?php echo $division['name']; ?></h1>
	<p><?php echo $division['description']; ?></p>

	<!-- Desktop Current Season Standings -->
	<div class="team-standings">
		<div class="team-header">
			<h3 class="team-name-primary"><?php echo $division['name']; ?></h3>
			<h3 class="team-name-secondary">History</h3>
			<!-- <h5 class="team-date">fall 2012</h5> -->
		</div>

		<table class="table table-responsive hidden-xs table-striped stripe-pattern-one">
			<thead>
				<tr>
					<th>Team</th>
					<th>GP</th>
					<th>WR</th>
					<th>NLR</th>
					<th>EPG</th>
					<th>TP</th>
				</tr>
				<tr>
					<th colspan="6"><div class="dashed">&nbsp;</div></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				function compareOrder($a, $b)
				{
				  return $a['win_loss'] < $b['win_loss'];
				}

				usort($history, 'compareOrder');
				foreach($history as $team): 
				$formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);

				if($team['games_played']!='0') 
				{
					$epg = ($team['games_won']*3+$team['games_tied'])/$team['games_played'];
					$points= ($team['games_won']*3)+($team['games_tied']*1);
					$epg = number_format((float)$epg, 2, '.', '');
				} 
				else 
				{
					$epg = 0;
				}

				?>
					<tr>
						<td><a href="<?php echo base_url('teams/history').'/'.$team['id'] ;?>"><?php echo $team['team_name']; ?></a></td>
						<td><?php echo $team['games_played']; ?></td>
						<td><?php echo $formatter->format($team['win_loss']); ?></td>
						<?php if($team['games_played']!="0"):?>
							<td><?php echo $formatter->format(($team['games_won']+$team['games_tied']) / $team['games_played']) ;?></td>
							<?php else: ?>
							<td>0%</td>
						<?php endif; ?>
						<td><?php echo $epg; ?></td>
						<td><?php echo $points; ?></td>
					</tr>
				<?php endforeach; ?>
				
			</tbody>
		</table>


		<table class="table table-responsive visible-xs table-mobile table-striped">
			<thead>
				<tr>
					<th>Team</th>
					<th>GP</th>
					<th>WR</th>
					<th>NLR</th>
					<th>EPG</th>
					<th>TP</th>
				</tr>
			</thead>
			<tbody>
				<?php 

				usort($history, 'compareOrder');
				foreach($history as $team): 
				$formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);

				if($team['games_played']!='0') 
				{
					$epg = ($team['games_won']*3+$team['games_tied'])/$team['games_played'];
					$points= ($team['games_won']*3)+($team['games_tied']*1);
					$epg = number_format((float)$epg, 2, '.', '');
				} 
				else 
				{
					$epg = 0;
				}

				?>
					<tr>
						<td><a href="<?php echo base_url('teams/history').'/'.$team['id'] ;?>"><?php echo $team['team_name']; ?></a></td>
						<td><?php echo $team['games_played']; ?></td>
						<td><?php echo $formatter->format($team['win_loss']); ?></td>
						<?php if($team['games_played']!="0"):?>
							<td><?php echo $formatter->format(($team['games_won']+$team['games_tied']) / $team['games_played']) ;?></td>
							<?php else: ?>
							<td>0%</td>
						<?php endif; ?>
						<td><?php echo $epg; ?></td>
						<td><?php echo $points; ?></td>
					</tr>
				<?php endforeach; ?>
				
			</tbody>
		</table>


	</div>





</div>