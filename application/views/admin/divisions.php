<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Divisions</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple ">

					<div class="grid-title">
						<h4>Divisions</h4>
					</div>

					<div class="grid-body">
							
						<table class="table table-striped dataTable data-test">
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
								<?php foreach( $divisions as $division ): ?>
								<tr>
									<td><?php echo $division['id']; ?></td>
									<td><a href="<?php echo base_url('admin/divisions/edit/' . $division['id']); ?>"><?php echo $division['name']; ?></a></td>
									<td><?php echo $division['league']; ?></td>
									<td><?php echo $division['created']; ?></td>
									<td><?php echo $division['modified']; ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

						<div class="pagiation">
							<?php //echo $this->pagination->create_links(); ?>
						</div>

					</div>

				</div>
			</div>
		</div>


	</div>

</div>