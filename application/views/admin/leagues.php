<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Leagues</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple ">

					<div class="grid-title">
						<h4 class="pull-left">List of Leagues</h4>
						<div class="pull-right">
 							<!--<a href="<?php echo base_url('admin/leagues/add'); ?>" class="btn btn-primary">Add New League</a>-->
 						</div>
					</div>

					<div class="grid-body">
							
						<table class="table table-striped dataTable" data-sort="1" data-sort-direction="asc">
							<thead>
								<tr>
									<th>id</th>
									<th>Name</th>
									<th>Active Season</th>
									<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
								</tr>
							</thead>
							<tbody>
								<?php if ( !empty($records) ): ?>
									<?php foreach( $records as $record ): ?>
									<tr id="<?php echo $record['id']; ?>">
										<td><?php echo $record['id']; ?></td>
										<td><?php echo $record['name']; ?></td>
										<td><a href="<?php echo base_url('admin/seasons/edit/' . $record['current_season_id']); ?>"><?php echo $record['current_season_name']; ?></a></td>
										<td>
											<a href="<?php echo base_url('admin/leagues/edit/' . $record['current_season_id']); ?>" class="btn active btn-primary"><i class="fa fa-edit"></i></a>
											<a href="#" class="btn active btn-danger" data-ajax-url="<?php echo base_url('admin/leagues/delete/' . $record['current_season_id']); ?>" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $record['current_season_name']; ?>" data-row-id="<?php echo $record['current_season_id']; ?>"><i class="fa fa-times"></i></a>
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

</div>