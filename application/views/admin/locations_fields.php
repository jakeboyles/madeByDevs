<!-- Display Location Fields -->
<div class="row">
	<div class="col-md-12">
 		<div class="grid simple">

			<div class="grid-title">
				<h4>Location Fields</h4>
				<div class="pull-right">
					<a href="#" class="btn btn-primary" data-ajax-url="<?php echo base_url('admin/locations/add_field/' . $record['id']); ?>" data-toggle="modal" data-target="#add-modal" data-label="" data-row-id="<?php echo $record['id']; ?>">Add Field</a>
				</div>
			</div>

			<div class="grid-body">

				<table class="table table-striped dataTable" data-sort="1" data-sort-direction="asc">
					<thead>
						<tr>
							<th>id</th>
							<th>Field Name</th>
							<th>Map Latitude</th>
							<th>Map Longitude</th>
							<th>Map Zoom</th>
							<th>Created</th>
							<th>Modified</th>
							<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
						</tr>
					</thead>
					<tbody>
						<?php if ( !empty($fields) ): ?>
							<?php foreach( $fields as $field ): ?>
							<tr id="<?php echo $field['id']; ?>">
								<td><?php echo $field['id']; ?></td>
								<td><?php echo $field['name']; ?></td>
								<td><?php echo $field['map_latitude']; ?></td>
								<td><?php echo $field['map_longitude']; ?></td>
								<td><?php echo $field['map_zoom']; ?></td>
								<td><?php echo date( 'm/d/Y', strtotime( $field['created_at'] ) ); ?></td>
								<td><?php echo date( 'm/d/Y', strtotime( $field['modified_at'] ) ); ?></td>
								<td>
									<a href="#" class="btn active btn-primary" data-ajax-url="<?php echo base_url('admin/locations/edit_field/' . $field['id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $field['id']; ?>"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn active btn-danger" data-ajax-url="<?php echo base_url('admin/locations/delete/' . $field['id']); ?>" data-toggle="modal" data-target="#delete-modal" data-label="<?php echo $field['name']; ?>" data-row-id="<?php echo $field['id']; ?>"><i class="fa fa-times"></i></a>
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
<?php $this->load->view('admin/locations_fields_add'); ?>

<!-- Load in Edit Record Modal -->
<?php $this->load->view('admin/locations_fields_edit'); ?>