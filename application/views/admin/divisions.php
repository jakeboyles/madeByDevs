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

<!-- Delete Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<br>
				<h4 id="myModalLabel" class="semi-bold">Are you sure you want to delete this record?</h4>
				<p class="no-margin">Any data that was tied to this record may be affected. This action cannot be reversed.</p>
				<br>
			</div>

			<div class="modal-body">
				<h3>Delete: <span class="data-row-label"></span></h3>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" data-action="delete-row" data-id="">Delete Record</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

