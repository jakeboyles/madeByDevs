<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Locations</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Edit Location</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/locations'); ?>" class="btn btn-primary">View Locations</a>
						</div>
					</div>

					<div class="grid-body">
							
						<div class="row">

							<div class="col-md-8 col-sm-8 col-xs-8">

								<!-- START Display Error Messages -->
								<?php if(validation_errors() && $this->input->post()): ?>
								<div class="alert alert-error">
									<h4>Form Submission Errors</h3>
									<ul>
									<?php echo validation_errors('<li>','</li>'); ?>
									</ul>
								</div>
								<?php endif; ?>
								<!-- END Display Error Messages -->

								<!-- START Success Message -->
								<?php if( !validation_errors() && $this->input->post() ): ?>
								<div class="alert alert-success">
									This record has been updated.
								</div>
								<?php endif; ?>
								<!-- END Success Message -->
								
								<!-- START New Record Added Message -->
								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/locations/add') ): ?>
								<div class="alert alert-success">
									Record successfully added.
								</div>
								<?php endif; ?>
								<!-- END New Record Added Message -->

								<!-- START Form -->
								<?php echo form_open( 'admin/locations/edit/' . $record['id'], array( 'id' => 'edit-location-form') ); ?>

									<div class="form-group">
										<?php echo form_label( 'Location Name*', 'name', array( 'class' => 'form-label' ) ); ?>
										<!-- <span class="help">e.g. </span> -->
										<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name', $record['name'] ) ) ); ?>
									</div>

									<div class="row">

										<div class="form-group col-md-6">
											<?php echo form_label( 'Phone', 'phone', array( 'class' => 'form-label' ) ); ?>
											<!-- <span class="help">e.g. </span> -->
											<?php echo form_input( array('name' => 'phone', 'class' => 'form-control', 'id' => 'phone', 'value' => set_value( 'phone', $record['phone'] ) ) ); ?>
										</div>

										<div class="form-group col-md-6">
											<?php echo form_label( 'Website', 'website', array( 'class' => 'form-label' ) ); ?>
											<!-- <span class="help">e.g. </span> -->
											<?php echo form_input( array('name' => 'website', 'class' => 'form-control', 'id' => 'website', 'value' => set_value( 'website', $record['website'] ) ) ); ?>
										</div>

									</div>
									
									<div class="row">

										<div class="form-group col-md-6">
											<?php echo form_label( 'Street Address', 'street_address', array( 'class' => 'form-label' ) ); ?>
											<!-- <span class="help">e.g. </span> -->
											<?php echo form_input( array('name' => 'street_address', 'class' => 'form-control', 'id' => 'street_address', 'value' => set_value( 'street_address', $record['street_address'] ) ) ); ?>
										</div>

										<div class="form-group col-md-6">
											<?php echo form_label( 'Street Address 2', 'street_address_2', array( 'class' => 'form-label' ) ); ?>
											<!-- <span class="help">e.g. </span> -->
											<?php echo form_input( array('name' => 'street_address_2', 'class' => 'form-control', 'id' => 'street_address_2', 'value' => set_value( 'street_address_2', $record['street_address_2'] ) ) ); ?>
										</div>

									</div>

									<div class="row">

										<div class="form-group col-md-4">
											<?php echo form_label( 'City', 'city', array( 'class' => 'form-label' ) ); ?>
											<!-- <span class="help">e.g. </span> -->
											<?php echo form_input( array('name' => 'city', 'class' => 'form-control', 'id' => 'city', 'value' => set_value( 'city', $record['city'] ) ) ); ?>
										</div>

										<div class="form-group col-md-4">
											<?php echo form_label( 'State', 'state', array( 'class' => 'form-label' ) ); ?>
											<!-- <span class="help">e.g. </span> -->
											<?php echo form_dropdown( 'state', array( '' => '') + state_array(), set_value( 'state', $record['state'] ), 'class="pretty-select"' ); ?>
										</div>

										<div class="form-group col-md-4">
											<?php echo form_label( 'Postal', 'postal', array( 'class' => 'form-label' ) ); ?>
											<!-- <span class="help">e.g. </span> -->
											<?php echo form_input( array('name' => 'postal', 'class' => 'form-control', 'id' => 'postal', 'value' => set_value( 'postal', $record['postal'] ) ) ); ?>
										</div>

									</div>

									<div class="row">

										<div class="form-group col-md-4">
											<?php echo form_label( 'Map Latitude', 'map_latitude', array( 'class' => 'form-label' ) ); ?>
											<span class="help">e.g. 37.331741</span>
											<?php echo form_input( array('name' => 'map_latitude', 'class' => 'form-control', 'id' => 'map_latitude', 'value' => set_value( 'map_latitude', $record['map_latitude'] ) ) ); ?>
										</div>

										<div class="form-group col-md-4">
											<?php echo form_label( 'Map Longitude', 'map_longitude', array( 'class' => 'form-label' ) ); ?>
											<span class="help">e.g. -122.030333</span>
											<?php echo form_input( array('name' => 'map_longitude', 'class' => 'form-control', 'id' => 'map_longitude', 'value' => set_value( 'map_longitude', $record['map_longitude'] ) ) ); ?>
										</div>

										<div class="form-group col-md-4">
											<?php echo form_label( 'Map Zoom', 'map_zoom', array( 'class' => 'form-label' ) ); ?>
											<span class="help">0-19</span>
											<?php echo form_input( array('name' => 'map_zoom', 'class' => 'form-control', 'id' => 'map_zoom', 'value' => set_value( 'map_zoom', $record['map_zoom'] ) ) ); ?>
										</div>

									</div>

									<div class="well well-small">
										<i class="fa fa-info-circle"></i> You can find the latitude and longitude via an address by using the <a href="http://itouchmap.com/latlong.html" target="_blank">iTouchMap.com Tool</a>.
									</div>

									<div class="form-group">
										<?php echo form_label( 'Location Description', 'description', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Further details about the location or driving directions.</span>
										<?php echo form_textarea( array('name' => 'description', 'class' => 'form-control', 'id' => 'description', 'value' => set_value( 'description', $record['description'] ) ) ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Update Location</button>

								<?php echo form_hidden( 'edit_location', TRUE ); ?>
								<?php echo form_close(); ?>
								<!-- END Form -->

							</div>

						</div>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-12 -->
		</div><!-- end .row -->


		<?php $this->load->view('admin/locations_fields'); ?>

	</div><!-- end .content -->
</div><!-- end .page-content -->