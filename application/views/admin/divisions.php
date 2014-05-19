<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Divisions</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple ">

					<div class="grid-title">
						<h4>List of Divisions</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/divisions/add'); ?>" class="btn btn-primary">Add New Division</a>
						</div>
					</div>

					<div class="grid-body">
							
						<table class="table table-striped dataTable" data-sort="1" data-sort-direction="asc">
							<thead>
								<tr>
									<th>id</th>
									<th>Division</th>
									<th>Division Type</th>
									<th>Created</th>
									<th>Modified</th>
									<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $records as $record ): ?>
								<tr id="<?php echo $record['id']; ?>">
									<td><?php echo $record['id']; ?></td>
									<td><a href="<?php echo base_url('admin/divisions/edit/' . $record['id']); ?>"><?php echo $record['name']; ?></a></td>
									<td><?php echo $record['division_type']; ?></td>
									<td><?php echo date( 'm/d/Y', strtotime( $record['created'] ) ); ?></td>
									<td><?php echo date( 'm/d/Y', strtotime( $record['modified'] ) ); ?></td>
									<td>
										<a href="<?php echo base_url('admin/divisions/edit/' . $record['id']); ?>" class="btn active btn-primary"><i class="fa fa-edit"></i></a>
										<a href="#" class="btn active btn-danger" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $record['name']; ?>" data-row-id="<?php echo $record['id']; ?>" data-ajax-url="<?php echo base_url('admin/divisions/delete/' . $record['id']); ?>"><i class="fa fa-times"></i></a>
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