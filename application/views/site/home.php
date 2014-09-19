<div id="content" class="col-md-8 col-md-push-4">

	<!-- START Header cycler -->
	<div id="carousel-head-show" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators hidden-xs">
	  	<?php $i = 0; ?>
	  	<?php if(!empty($sliders)): ?>
	  	<?php foreach($sliders as $slider): ?>
	  		<?php if($i==0) { ?>
			<li data-target="#carousel-head-show" data-slide-to="<?php echo $i; ?>" class="active"></li>
			<?php  } else { ?>
			<li data-target="#carousel-head-show" data-slide-to="<?php echo $i; ?>"></li>
			<?php 
			}
			$i++; ?>
		<?php endforeach; ?>
		<?php endif; ?>
	  </ol>
	  <div class="carousel-inner">

	  	<?php 
	  	$counter = 0;
	  	if(!empty($sliders)):
	  	foreach($sliders as $slider): 
	  	if($counter==0):
	  	?>
	  	  	<div class="item active">
			  <img src="<?php echo base_url('uploads').'/slider-'.$sliders[$counter]['filename']; ?>" alt="<?php echo $slider['title']; ?>">
				  <div class="content">
				  	<h3><?php echo $sliders[$counter]['title']; ?></h3>
				  	<?php echo $sliders[$counter]['content']; ?>
				  </div>
			</div>
		<?php else: ?>
			<div class="item">
			  <img src="<?php echo base_url('uploads').'/slider-'.$slider['filename']; ?>" alt="<?php echo $slider['title']; ?>">
				  <div class="content">
				  	<h3><?php echo $slider['title']; ?></h3>
				  	<?php echo $slider['content']; ?>
				  </div>
			</div>
		<?php endif; ?>
		<?php 
		$counter++;
		endforeach; 
		endif;
		?>
	  </div>
	  <a class="left carousel-control" href="#carousel-head-show" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#carousel-head-show" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	</div>
	<!-- END Header Cycler -->
			<div class="team-standings">
			<div class="team-header">
				<h3 class="team-name-primary">Division</h3>
				<h3 class="team-name-secondary">Leaderboard</h3>
				<h5 class="team-date"><?php echo $league[0]['current_season_name']; ?></h5>
			</div>
			<?php if(!empty($headlines[0]['filename'])): ?>
			<div class="division_headline">
			<img src="<?php echo base_url('uploads').'/slider-'.$headlines[0]['filename']; ?>" />
				<div class="content">
					<p><?php echo $headlines[0]['title']; ?>
				</div>
			</div>
			<?php endif; ?>
			<table class="sortable-table table table-striped stripe-pattern-one">
			<thead>
				<tr>
					<th class="hidden-xs">Div</th>
					<th>Team</th>
					<th>GP</th>
					<th>GD</th>
					<th>Pts</th>
				</tr>
				<tr>
					<th colspan="6"><div class="dashed">&nbsp;</div></th>
				</tr>
			</thead>
			<tbody>
				<?php

				function compareOrder($a, $b)
				{

				$pointsa = ($a['games_won']*3)+($a['games_tied']*1);
				$pointsb = ($b['games_won']*3)+($b['games_tied']*1);

				  return $pointsa < $pointsb;
				}

				if(!empty($leaders)):

				usort($leaders, 'compareOrder');

				foreach($leaders as $team):
				if($team['games_played']!='0'):
				$points = ($team['games_won']*3)+($team['games_tied']*1);
				?>
					<tr>
						<td class="hidden-xs"><a href="<?php echo base_url('divisions/page').'/'.$team['division_id'] ;?>"><?php echo $team['name']; ?></a></td>
						<td><a href="<?php echo base_url('teams/page').'/'.$team['team_id'] ;?>"><?php echo $team['highest_team']; ?></a></td>
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

</div><!-- end .col-md-8 col-md-push-4 -->