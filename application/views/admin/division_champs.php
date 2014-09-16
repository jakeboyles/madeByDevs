<div class="row">
	<div class="col-md-12">
 		<div class="grid simple">

			<div class="grid-title">
				<h4>Champions</h4>
			</div>

			<div class="grid-body">

				<table class="table table-striped dataTable" data-sort="1" data-sort-direction="asc">
					<thead>
						<tr>
							<th>id</th>
							<th>Seasons</th>
							<th><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></th>
						</tr>
					</thead>
					<tbody>
						<?php if ( !empty($seasons) ): ?>
							<?php foreach( $seasons as $season ): ?>
							<tr id="<?php echo $season['id']; ?>">
								<td><?php echo $season['id']; ?></td>
								<td><?php echo $season['name']; ?></td>
								<td>
									<a href="#" class="btn active btn-primary" data-ajax-url="<?php echo base_url('admin/divisions/add_champion/' . $record['id'].'-'.$season['id']); ?>" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="<?php echo $season['id']; ?>"><i class="fa fa-edit"></i></a>
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

<?php $this->load->view('admin/divisions_champions_edit'); ?>