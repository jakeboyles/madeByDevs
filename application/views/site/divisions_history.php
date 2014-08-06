<div id="content" class="col-md-8 col-md-push-4">

	<h1><?php echo $division['name']; ?></h1>

	<!-- Desktop Current Season Standings -->
	<div class="team-standings">
		<div class="team-header">
			<h3 class="team-name-primary"><?php echo $league['current_season_name']; ?></h3>
			<h3 class="team-name-secondary">Leaderboard</h3>
			<!-- <h5 class="team-date">fall 2012</h5> -->
		</div>

		<table class="table table-striped stripe-pattern-one">
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
				<tr>
					<td><a href="#">Empire FC</a></td>
					<td>8</td>
					<td>8</td>
					<td>12</td>
					<td>17</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Hudson FC</a></td>
					<td>8</td>
					<td>8</td>
					<td>6</td>
					<td>16</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Bean's Rejects</a></td>
					<td>8</td>
					<td>8</td>
					<td>2</td>
					<td>13</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Grampus HD</a></td>
					<td>8</td>
					<td>-1</td>
					<td>11</td>
					<td>8</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Brooklyn Red Star</a></td>
					<td>8</td>
					<td>5</td>
					<td>10</td>
					<td>8</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">OTPHJ FC</a></td>
					<td>8</td>
					<td>-3</td>
					<td>6</td>
					<td>8</td>
					<td>8</td>
				</tr>
			</tbody>
		</table>
	</div>

	<h2>Previous Seasons</h2>

	<!-- Previous Season Stats (Desktop) -->
	<div class="alternating-table-container hidden-xs">
		<h3>Spring 2014 Season</h3>
		<table class="table table-striped stripe-pattern-one">
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
				<tr>
					<td><a href="#">Empire FC</a></td>
					<td>8</td>
					<td>8</td>
					<td>12</td>
					<td>17</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Hudson FC</a></td>
					<td>8</td>
					<td>8</td>
					<td>6</td>
					<td>16</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Bean's Rejects</a></td>
					<td>8</td>
					<td>8</td>
					<td>2</td>
					<td>13</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Grampus HD</a></td>
					<td>8</td>
					<td>-1</td>
					<td>11</td>
					<td>8</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Brooklyn Red Star</a></td>
					<td>8</td>
					<td>5</td>
					<td>10</td>
					<td>8</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">OTPHJ FC</a></td>
					<td>8</td>
					<td>-3</td>
					<td>6</td>
					<td>8</td>
					<td>8</td>
				</tr>
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

	<!-- Previous Season Stats (Desktop) -->
	<div class="alternating-table-container hidden-xs">
		<h3>Winter 2013 - 2014 Season</h3>
		<table class="table table-striped stripe-pattern-one">
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
				<tr>
					<td><a href="#">Empire FC</a></td>
					<td>8</td>
					<td>8</td>
					<td>12</td>
					<td>17</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Hudson FC</a></td>
					<td>8</td>
					<td>8</td>
					<td>6</td>
					<td>16</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Bean's Rejects</a></td>
					<td>8</td>
					<td>8</td>
					<td>2</td>
					<td>13</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Grampus HD</a></td>
					<td>8</td>
					<td>-1</td>
					<td>11</td>
					<td>8</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">Brooklyn Red Star</a></td>
					<td>8</td>
					<td>5</td>
					<td>10</td>
					<td>8</td>
					<td>8</td>
				</tr>
				<tr>
					<td><a href="#">OTPHJ FC</a></td>
					<td>8</td>
					<td>-3</td>
					<td>6</td>
					<td>8</td>
					<td>8</td>
				</tr>
			</tbody>
		</table>
	</div>

</div>