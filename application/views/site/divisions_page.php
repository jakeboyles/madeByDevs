<div id="content" class="col-md-8 col-md-push-4">
	<h1><?php echo $division['name']; ?></h1>
	<p><?php echo $division['description']; ?></p>

	<!-- Desktop Current Season Standings -->
	<div class="team-standings">
		<div class="team-header">
			<h3 class="team-name-primary"><?php echo $division['name']; ?></h3>
			<h3 class="team-name-secondary"><?php echo $season['name'];?> Team Results</h3>
			<!-- <h5 class="team-date">fall 2012</h5> -->
		</div>

		<table class="table table-striped stripe-pattern-one">
			<thead>
				<tr>
					<th>Team</th>
					<th>GP</th>
					<th>WR</th>
					<th class="hidden-xs">NLR</th>
					<th class="hidden-xs">EPG</th>
					<th class="hidden-xs">TP</th>
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

				if(!empty($leaders)):

				usort($leaders, 'compareOrder');

				foreach($leaders as $team):

				if($team['games_played']!='moo'):

				$formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);

				$epg = ($team['games_won']*3+$team['games_tied'])/$team['games_played'];
				?>
					<tr>
						<td><a href="<?php echo base_url('teams/page').'/'.$team['id'] ;?>"><?php echo $team['team_name']; ?></a></td>
						<td><?php echo $team['games_played']; ?></td>
						<td><?php echo $formatter->format($team['win_loss']); ?></td>
						<?php if($team['games_played']!="0"):?>
							<td class="hidden-xs"><?php echo $formatter->format(($team['games_won']+$team['games_tied']) / $team['games_played']) ;?></td>
							<?php else: ?>
							<td class="hidden-xs">0%</td>
						<?php endif; ?>
						<td class="hidden-xs"><?php echo $epg; ?></td>
						<td class="hidden-xs"><?php echo $team['games_played']*$epg;?></td>
					</tr>
				<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				
			</tbody>
		</table>
	</div>

<h2><?php echo $season['name']; ?> Teams</h2>
<div class='alternating-table-container'>
	<table class="roster-table table table-striped stripe-pattern-one standings">
		<thead>
			<tr>
				<th>Team</th>
			</tr>
		</thead>
		<tbody>
			<?php for($i=0;$i<count($current_season_teams['names']);$i++): ?>
				<tr>
					<td><a href="<?php echo base_url('teams/page')."/". $current_season_teams['ids'][$i]; ?>"><?php echo $current_season_teams['names'][$i]; ?></a></td>
				</tr>
			<?php endfor; ?>
		</tbody>
	</table>
</div>
<h2>Past Champions</h2>

<div class="row">
<?php foreach($champions as $champion): ?>
<?php if(!empty($champion['name'])): ?>
	<div class="team-standings team-champions col-md-12 col-xs-12">
		<div class="team-header">
			<h3 class="team-name-primary"><?php echo $division['name']; ?></h3>
			<h3 class="team-name-secondary"><?php echo $champion['session_name']; ?> Champions</h3>
			<!-- <h5 class="team-date">fall 2012</h5> -->
		</div>

		<div class="team-title"><h4><a href="<?php echo base_url('teams/page').'/'.$champion['id']; ?>"><?php echo $champion['name']; ?></a></h4></div>
		<?php if(!empty($champion['filename'])): ?>
			<img src="<?php echo base_url("/uploads")."/".$champion['filename']; ?>" />
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php endforeach; ?>
</div>



</div>