<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Users</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple ">

					<div class="grid-title">
						<h4>List of Users</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/users/add'); ?>" class="btn btn-primary">Add New User</a>
						</div>
					</div>

					<div class="grid-body">
							
						<table class="table table-striped dataTable" data-sort="1" data-sort-direction="asc">
							<thead>
								<tr>
									<th>id</th>
									<th>User Type</th>
									<th>Email</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Gender</th>
									<th>Postal</th>
									<th>Birthday</th>
									<th>Created</th>
									<th>Modified</th>
									<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $records as $record ): ?>
								<tr id="<?php echo $record['id']; ?>">
									<td><?php echo $record['id']; ?></td>
									<td><?php echo $record['user_type']; ?></td>
									<td><?php echo $record['email']; ?></td>
									<td><?php echo $record['first_name']; ?></td>
									<td><?php echo $record['last_name']; ?></td>
									<td><?php echo $record['gender']; ?></td>
									<td><?php echo $record['postal']; ?></td>
									<td><?php if( !empty( $record['birthday'] ) ) echo date( 'm/d/Y', strtotime( $record['birthday'] ) ); ?></td>
									<td><?php echo date( 'm/d/Y', strtotime( $record['created_at'] ) ); ?></td>
									<td><?php echo date( 'm/d/Y', strtotime( $record['modified_at'] ) ); ?></td>
									<td>
										<a href="<?php echo base_url('admin/users/edit/' . $record['id']); ?>" class="btn active btn-primary"><i class="fa fa-edit"></i></a>
										<a href="#" class="btn active btn-danger" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $record['first_name'] . ' ' . $record['last_name']; ?>" data-row-id="<?php echo $record['id']; ?>" data-ajax-url="<?php echo base_url('admin/users/delete/' . $record['id']); ?>"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

					</div>

				</div>
			</div>
		</div>


	</div>

</div>