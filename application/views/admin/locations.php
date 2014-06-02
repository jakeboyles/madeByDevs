<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Locations</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple ">

					<div class="grid-title">
						<h4 class="pull-left">List of Locations</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/locations/add'); ?>" class="btn btn-primary">Add New Location</a>
						</div>
					</div>

					<div class="grid-body">
							
						<table class="table table-striped dataTable" data-sort="1" data-sort-direction="asc">
							<thead>
								<tr>
									<th>id</th>
									<th>Location</th>
									<th>Phone</th>
									<th>Website</th>
									<th>City</th>
									<th>State</th>
									<th>Postal</th>
									<th>Created</th>
									<th>Modified</th>
									<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
								</tr>
							</thead>
							<tbody>
								<?php if ( !empty($records) ): ?>
									<?php foreach( $records as $record ): ?>
									<tr id="<?php echo $record['id']; ?>">
										<td><?php echo $record['id']; ?></td>
										<td><a href="<?php echo base_url('admin/locations/edit/' . $record['id']); ?>"><?php echo $record['name']; ?></a></td>
										<td><?php echo $record['phone']; ?></td>
										<td><?php echo $record['website']; ?></td>
										<td><?php echo $record['city']; ?></td>
										<td><?php echo $record['state']; ?></td>
										<td><?php echo $record['postal']; ?></td>
										<td><?php echo date( 'm/d/Y', strtotime( $record['created_at'] ) ); ?></td>
										<td><?php echo date( 'm/d/Y', strtotime( $record['modified_at'] ) ); ?></td>
										<td>
											<a href="<?php echo base_url('admin/locations/edit/' . $record['id']); ?>" class="btn active btn-primary"><i class="fa fa-edit"></i></a>
											<a href="#" class="btn active btn-danger" data-ajax-url="<?php echo base_url('admin/locations/delete/' . $record['id']); ?>" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $record['name']; ?>" data-row-id="<?php echo $record['id']; ?>"><i class="fa fa-times"></i></a>
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