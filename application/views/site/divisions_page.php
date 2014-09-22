<div id="content" class="division col-md-8 col-md-push-4">
	<!-- Desktop Current Season Standings -->
	<div class="team-standings">
		<div class="team-header">
			<div class="row">
				<div class="col-xs-12">
					<h3 class="team-name-primary"><?php echo $division['name']; ?> <span class="pull-right"><?php echo $season['year_end']; ?></span></h3>
					<h3 class="team-name-secondary"><?php echo $season['name'];?> Team Results</h3>
				</div>
			</div>
			<!-- <h5 class="team-date">fall 2012</h5> -->
		</div>

		<?php if(!empty($current_season)): ?>
		<div class="headline-image">
			<img src="<?php echo base_url("uploads/").'/'.$current_season['headline_image'] ;?>">
			<?php if(!empty($current_season['headline'])): ?>
				<div class="headline-text">
					<span><?php echo $current_season['headline']; ?></span>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<table class="table table-striped stripe-pattern-one">
			<thead>
				<tr>
					<th>Team</th>
					<th>GP</th>
					<th>GD</th>
					<th>Points</th>
				</tr>
				<tr>
					<th colspan="6"><div class="dashed">&nbsp;</div></th>
				</tr>
			</thead>
			<tbody>
				<?php

				function compareOrder($a, $b)
				{
				  return ($a'games_won']*3)+($a['games_tied']*1) < ($b['games_won']*3)+($b['games_tied']*1);
				}

				if(!empty($leaders)):

				usort($leaders, 'compareOrder');

				foreach($leaders as $team):

				if($team['games_played']!='0'):

				$formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);

				$points = ($team['games_won']*3)+($team['games_tied']*1);
				?>
					<tr>
						<td><a href="<?php echo base_url('teams/page').'/'.$team['id'] ;?>"><?php echo $team['team_name']; ?></a></td>
						<td><?php echo $team['games_played']; ?></td>
						<td><?php echo $team['points']-$team['points_against']; ?></td>
						<td><?php echo $points; ?></td>
					</tr>
				<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				
			</tbody>
		</table>
	</div>

<!-- <h2><?php echo $season['name']; ?> Teams</h2>
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
</div> -->

<?php if(!empty($historical_season)): ?>
<h2>Past Champions</h2>
<div class="row">
<?php if(!empty($historical_season['name'])): ?>
	<div class="team-standings team-champions col-md-12 col-xs-12">
		<div class="team-header">
			<h3 class="team-name-primary"><?php echo $division['name']; ?> <span class="pull-right"><?php echo $historical_season['year_end']; ?> </h3>
			<h3 class="team-name-secondary"><?php echo $historical_season['season']; ?> Champions</h3>
			<!-- <h5 class="team-date">fall 2012</h5> -->
		</div>

		<div class="team-title"><h4><a href="<?php echo base_url('teams/page').'/'.$historical_season['id']; ?>"><?php echo $historical_season['name']; ?></a></h4></div>
		<?php if(!empty($historical_season['picture'])): ?>
			<img src="<?php echo base_url("/uploads")."/".$historical_season['picture']; ?>" />
		<?php endif; ?>
	</div>
<?php endif; ?>
</div>
<?php endif; ?>


<h2><?php echo $division['name']; ?></h2>
<p><?php echo $division['description']; ?></p>



</div>