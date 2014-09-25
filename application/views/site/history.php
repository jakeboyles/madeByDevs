<div id="content" class="col-md-8 col-md-push-4">
	<h1>History</h1>

	<div class="team-standings hidden-xs">
		<div class="team-header">
			<h3 class="team-name-primary">Division</h3>
			<h3 class="team-name-secondary">Leaders</h3>
			<!-- <h5 class="team-date">fall 2012</h5> -->
		</div>

		<table class="table table-striped stripe-pattern-one">
			<thead>
				<tr>
					<th>Division</th>
					<th>Team</th>
					<th>GP</th>
					<th>WR</th>
					<th>NLR</th>
					<th>EPG</th>
					<th>TP</th>
				<tr>
					<th colspan="7"><div class="dashed">&nbsp;</div></th>
				</tr>
				<tr></tr>
			</thead>
			<tbody>
				<?php foreach($division_leaders as $division): ?>
					<?php if(!empty($division['highest_team'])): ?>
						<tr>
							<?php
								$games_won = $division['games_won'];
								$epg = ( $games_won * 3 + $division['games_tied'] ) / $division['games_played'];
								$epg = number_format((float)$epg, 2, '.', '');
								$points= ($games_won*3)+($division['games_tied']*1);
								$formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);
							?>
							<td><a href="<?php echo base_url('divisions').'/history/'.$division['division_id'] ;?>"><?php echo $division['name']; ?></a></td>
							<td><a href="<?php echo base_url('teams').'/history/'.$division['team_id'] ;?>"><?php echo $division['highest_team']; ?></a></td>
							<td><?php echo $division['games_played']; ?></td>
							<td><?php echo $formatter->format($division['highest_win']); ?></td>
							<td><?php echo $formatter->format(($games_won+$division['games_tied']) / $division['games_played']) ;?></td>
							<td><?php echo $epg ;?></td>
							<td><?php echo $points; ?></td>
						</tr>
					<?php endif; ?>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>



		<!-- Team Roster (Mobile) -->
	<div class="mobile-expand-list visible-xs">
		<h3> History</h3>
		<ul class="content">
			<?php foreach( $division_leaders as $division ): ?>
			<?php if(!empty($division['highest_team'])): ?>
			<?php
				$games_won = $division['games_won'];
				$epg = ( $games_won * 3 + $division['games_tied'] ) / $division['games_played'];
				$formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);
			?>
			<li class="visible-xs">
				<ul class="visible-xs">
					<li class="visible-xs">
						<h5 class="title">Division</h5>
						<h6 class="option">
							<a href="<?php echo base_url('divisions').'/history/'.$division['division_id'] ;?>"><?php echo $division['name']; ?></a>
						</h6>
						<h5 class="title">Team</h5>
						<h6 class="option">
							<a href="<?php echo base_url('teams').'/history/'.$division['team_id'] ;?>"><?php echo $division['highest_team']; ?></a>
						</h6>
						<h5 class="title">GP</h5>
						<h6 class="option">
							<?php echo $division['games_played']; ?>
						</h6>
						<h5 class="title">WR</h5>
						<h6 class="option">
							<?php echo $formatter->format($division['highest_win']); ?>
						</h6>
						<h5 class="title">NLR</h5>
						<h6 class="option">
							<?php echo $formatter->format(($games_won+$division['games_tied']) / $division['games_played']) ;?>
						</h6>
						<h5 class="title">EPG</h5>
						<h6 class="option">
							<?php echo $epg ;?>
						</h6>
						<h5 class="title">TP</h5>
						<h6 class="option">
							<?php echo $division['games_played']*$epg;?>
						</h6>
					</li>
				</ul>
			</li>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>


</div>