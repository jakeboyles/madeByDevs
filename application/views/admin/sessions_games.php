<div class="row">
	<div class="col-md-12">
 		<div class="grid simple">

			<div class="grid-title">
				<h4>Games Scheduled in this Session</h4>
				<div class="pull-right">
					<a href="#" class="btn btn-primary" data-ajax-url="<?php echo base_url('admin/games/add_ajax/' . $record['id']); ?>" data-toggle="modal" data-target="#add-modal" data-label="" data-row-id="<?php echo $record['id']; ?>">Add Game</a>
				</div>
			</div>

			<div class="grid-body">

				<table class="table table-striped dataTable" data-sort="1" data-sort-direction="asc">
					<thead>
						<tr>
							<th>id</th>
							<th>Division</th>
							<th>Home Team</th>
							<th>Away Team</th>
							<th>Location</th>
							<th>Game Time</th>
							<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
						</tr>
					</thead>
					<tbody>
						<?php if ( !empty($games) ): ?>
							<?php foreach( $games as $game ): ?>
							<tr id="<?php echo $game['id']; ?>">
								<td><?php echo $game['id']; ?></td>
								<td><?php echo $game['division']; ?></td>
								<td><?php echo $game['home_team']; ?> (<?php echo !empty( $game['score_home'] ) ? $game['score_home'] : 0; ?>)</td>
								<td><?php echo $game['away_team']; ?> (<?php echo !empty( $game['score_away'] ) ? $game['score_away'] : 0; ?>)</td>
								<td><?php echo $game['location']; ?></td>
								<td><?php echo date( 'm/d/Y g:i A', strtotime( $game['game_date_time'] ) ); ?></td>
								<td>
									<a href="#" class="btn active btn-primary" data-ajax-url="<?php echo base_url('admin/games/edit_game_ajax/' . $game['id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $game['id']; ?>"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn active btn-danger" data-ajax-url="<?php echo base_url('admin/games/delete/' . $game['id']); ?>" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $game['home_team'] . ' vs ' . $game['away_team']; ?>" data-row-id="<?php echo $game['id']; ?>"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>

			</div><!-- end .grid-body -->

		</div><!-- end .grid -->
	</div><!-- end .col-md-12 -->
</div><!-- end .row -->

<!-- Load in Add Record Modal -->
<?php $this->load->view('admin/sessions_game_add_ajax'); ?>

<!-- Load in Edit Record Modal -->
<?php //$this->load->view('admin/games_edit'); ?>