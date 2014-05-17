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
							
						<table class="table table-striped dataTable">
							<thead>
								<tr>
									<th>id</th>
									<th>Division</th>
									<th>League</th>
									<th>Created</th>
									<th>Modified</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $records as $record ): ?>
								<tr>
									<td><?php echo $record['id']; ?></td>
									<td><a href="<?php echo base_url('admin/divisions/edit/' . $record['id']); ?>"><?php echo $record['name']; ?></a></td>
									<td><?php echo $record['league']; ?></td>
									<td><?php echo date( 'F d, Y', strtotime( $record['created'] ) ); ?></td>
									<td><?php echo date( 'F d, Y', strtotime( $record['modified'] ) ); ?></td>
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