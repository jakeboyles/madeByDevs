<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Games</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple ">

					<div class="grid-title">
						<h4 class="pull-left">List of Games</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/games/add'); ?>" class="btn btn-primary">Add New Game</a>
							
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
									<th>Session</th>
									<th>Game Time</th>
									<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
								</tr>
							</thead>
							<tbody>
								<?php if ( !empty($games) ): ?>
									<?php foreach( $games as $game ): ?>
									<tr id="<?php echo $game['id']; ?>">
										<td><?php echo $game['id']; ?></td>
										<td><?php echo $game['division']; ?></a></td>
										<td><?php echo $game['home_team']; ?></td>
										<td><?php echo $game['away_team']; ?></td>
										<td><?php echo $game['location']; ?></td>
										<td><a href="<?php echo base_url('admin/sessions/edit/'.$game['session_id']); ?>"><?php echo $game['session_name']; ?></a></td>
										<td><?php echo date('m/d/y h:m A', strtotime( $game['game_date_time'] ) ); ?></td>
										<td>
											<a href="<?php echo base_url('admin/games/edit/' . $game['id']); ?>" class="btn active btn-primary"><i class="fa fa-edit"></i></a>
											<a href="#" class="btn active btn-danger" data-ajax-url="<?php echo base_url('admin/games/delete/' . $game['id']); ?>" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $game['home_team'] . " vs " . $game['away_team']; ?>" data-row-id="<?php echo $game['id']; ?>"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>

					</div>

				</div>
			</div>
		</div>


	</div>

			<?php $this->load->view('admin/sessions_game_add_ajax'); ?>


</div>