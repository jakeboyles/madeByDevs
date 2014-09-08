<div class="row">
	<div class="col-md-12">
 		<div class="grid simple">

			<div class="grid-title">
				<h4>Roster</h4>
				<div class="pull-right">
					<a href="#" class="btn btn-primary" data-ajax-url="<?php echo base_url('admin/teams/add_player/' . $record['id']); ?>" data-toggle="modal" data-target="#add-modal" data-label="" data-row-id="<?php echo $record['id']; ?>">Add Player</a>
				</div>
			</div>

			<div class="grid-body">

				<table class="table table-striped dataTable" data-sort="1" data-sort-direction="asc">
					<thead>
						<tr>
							<th>ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Position</th>

							<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
						</tr>
					</thead>
					<tbody>
						<?php if ( !empty($roster) ): ?>

							<?php foreach( $roster as $player ): 
							?>
							<tr id="<?php echo $player['id']; ?>">
								<td><?php echo $player['id']; ?></td>
								<td><a href="<?php echo base_url('admin/users/edit/' . $player['user_id']); ?>"><?php echo $player['first_name']; ?></a></td>
								<td><a href="<?php echo base_url('admin/users/edit/' . $player['user_id']); ?>"><?php echo $player['last_name']; ?></a></td>
								<td><?php echo $player['position']; ?></td>
								<td>
									<a href="#" class="btn active btn-primary" data-ajax-url="<?php echo base_url('admin/teams/edit_roster/' . $player['id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $player['id']; ?>"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn active btn-danger" data-ajax-url="<?php echo base_url('admin/teams/delete_roster/' . $player['id']); ?>" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $player['first_name'] . " " . $player['last_name']; ?>" data-row-id="<?php echo $player['id']; ?>"><i class="fa fa-times"></i></a>
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
<?php $this->load->view('admin/teams_roster_add'); ?>

<!-- Load in Edit Record Modal -->
<?php $this->load->view('admin/teams_roster_edit'); ?>