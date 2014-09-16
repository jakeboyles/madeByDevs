		
	<?php if(empty($record)): ?>
	<div class="row">
		<div class="form-group col-md-6">
			<?php echo form_label( $teams['home_team']." Score", 'teams', array( 'class' => 'form-label' ) ); ?>
			<?php echo form_input( array('name' => 'score_home', 'class' => 'form-control', 'id' => 'home_score', 'value' => '0' ) ); ?>
		</div>

		<div class="form-group col-md-6">
			<?php echo form_label( $teams['away_team']." Score", 'teams', array( 'class' => 'form-label' ) ); ?>
			<?php echo form_input( array('name' => 'score_away', 'class' => 'form-control', 'id' => 'away_score', 'value' => '0' ) ); ?>
		</div>
	</div>
	<?php else: ?>
	<div class="row">
		<div class="form-group col-md-6">
			<?php echo form_label( $teams['home_team']." Score", 'teams', array( 'class' => 'form-label' ) ); ?>
			<?php echo form_input( array('name' => 'score_home', 'class' => 'form-control', 'id' => 'home_score', 'value' => set_value( 'game_date', $record['score_home'] ) ) ); ?>
		</div>

		<div class="form-group col-md-6">
			<?php echo form_label( $teams['away_team']." Score", 'teams', array( 'class' => 'form-label' ) ); ?>
			<?php echo form_input( array('name' => 'score_away', 'class' => 'form-control', 'id' => 'away_score', 'value' => set_value( 'game_date', $record['score_away'] ) ) ); ?>
		</div>
	</div>
	<?php endif; ?>

	<button type="submit" class="btn btn-primary">Update Score</button>


	<?php echo form_close(); ?>


	<h2><?php echo $teams['home_team']; ?> Players</h2>

	<div class="alternating-table-container">
		<table class="table table-striped stripe-pattern-one">
			<thead>
				<tr>
					<th>Player Name</th>
					<th>Yellows</th>
					<th>Reds</th>
					<th>Scores</th>
					<th>Save</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($home_team)): ?>
					<?php foreach( $home_team as $player ): ?>
						<?php if(!empty($player['game_info'])): ?>
							<tr data-id="<?php echo $player['id']?>">
								<td><?php echo $player['first_name']." ".$player['last_name']; ?></td>
								<td><?php echo form_input( array('name' => 'yellows', 'class' => 'form-control', 'id' => 'yellows', 'value' =>  set_value( 'yellows', $player['game_info'][0]['yellow_cards'] ) ) ); ?></td>
								<td><?php echo form_input( array('name' => 'reds', 'class' => 'form-control', 'id' => 'reds', 'value' => set_value('yellows', $player['game_info'][0]['red_cards'] ) ) ); ?></td>
								<td><?php echo form_input( array('name' => 'scores', 'class' => 'form-control', 'id' => 'score', 'value' => set_value('yellows', $player['game_info'][0]['goals_scored'] ) ) ); ?></td>
								<td><a href="#" class="update_game_info btn active btn-primary" data-ajax-url="<?php echo base_url('users/edit_player_record/' . $player['id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $player['id']; ?>"><i class="fa fa-edit"></i></a></td>
								<input id="csrf" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
								<input id="team_id" type="hidden" name="team_id" value="<?php echo $teams['home_team_id']; ?>" />
								<input id="game_player_id" type="hidden" name="game_player_id" value="<?php echo $player['game_info'][0]['id'] ?>" />
							</tr>
						<?php else: ?>
							<tr data-id="<?php echo $player['id']?>">
								<td><?php echo $player['first_name']." ".$player['last_name']; ?></td>
								<td><?php echo form_input( array('name' => 'yellows', 'class' => 'form-control', 'id' => 'yellows', 'value' => '0' ) ); ?></td>
								<td><?php echo form_input( array('name' => 'reds', 'class' => 'form-control', 'id' => 'reds', 'value' => '0' ) ); ?></td>
								<td><?php echo form_input( array('name' => 'scores', 'class' => 'form-control', 'id' => 'score', 'value' => '0' ) ); ?></td>
								<td><a href="#" class="update_game_info btn active btn-primary" data-ajax-url="<?php echo base_url('users/add_player_record/' . $player['id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $player['id']; ?>"><i class="fa fa-edit"></i></a></td>
								<input id="csrf" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
								<input id="team_id" type="hidden" name="team_id" value="<?php echo $teams['home_team_id']; ?>" />
								<input id="game_player_id" type="hidden" name="game_player_id" value="<?php echo $player['game_info'][0]['id'] ?>" />
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>

<h2><?php echo $teams['away_team']; ?> Players</h2>
		<div class="alternating-table-container">
		<table class="table table-striped stripe-pattern-one">
			<thead>
				<tr>
					<th>Player Name</th>
					<th>Yellows</th>
					<th>Reds</th>
					<th>Scores</th>
					<th>Save</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($away_team)): ?>
					<?php foreach( $away_team as $player ): ?>
						<?php if(!empty($player['game_info'])): ?>
							<tr data-id="<?php echo $player['id']?>">
								<td><?php echo $player['first_name']." ".$player['last_name']; ?></td>
								<td><?php echo form_input( array('name' => 'yellows', 'class' => 'form-control', 'id' => 'yellows', 'value' =>  set_value( 'yellows', $player['game_info'][0]['yellow_cards'] ) ) ); ?></td>
								<td><?php echo form_input( array('name' => 'reds', 'class' => 'form-control', 'id' => 'reds', 'value' => set_value('yellows', $player['game_info'][0]['red_cards'] ) ) ); ?></td>
								<td><?php echo form_input( array('name' => 'scores', 'class' => 'form-control', 'id' => 'score', 'value' => set_value('yellows', $player['game_info'][0]['goals_scored'] ) ) ); ?></td>
								<td><a href="#" class="update_game_info btn active btn-primary" data-ajax-url="<?php echo base_url('users/edit_player_record/' . $player['id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $player['id']; ?>"><i class="fa fa-edit"></i></a></td>
								<input id="csrf" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
								<input id="team_id" type="hidden" name="team_id" value="<?php echo $teams['home_team_id']; ?>" />
								<input id="game_player_id" type="hidden" name="game_player_id" value="<?php echo $player['game_info'][0]['id'] ?>" />
							</tr>
						<?php else: ?>
							<tr data-id="<?php echo $player['id']?>">
								<td><?php echo $player['first_name']." ".$player['last_name']; ?></td>
								<td><?php echo form_input( array('name' => 'yellows', 'class' => 'form-control', 'id' => 'yellows', 'value' => '0' ) ); ?></td>
								<td><?php echo form_input( array('name' => 'reds', 'class' => 'form-control', 'id' => 'reds', 'value' => '0' ) ); ?></td>
								<td><?php echo form_input( array('name' => 'scores', 'class' => 'form-control', 'id' => 'score', 'value' => '0' ) ); ?></td>
								<td><a href="#" class="update_game_info btn active btn-primary" data-ajax-url="<?php echo base_url('users/add_player_record/' . $player['id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $player['id']; ?>"><i class="fa fa-edit"></i></a></td>
								<input id="csrf" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
								<input id="team_id" type="hidden" name="team_id" value="<?php echo $teams['home_team_id']; ?>" />
								<input id="game_player_id" type="hidden" name="game_player_id" value="<?php echo $player['game_info'][0]['id'] ?>" />
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>