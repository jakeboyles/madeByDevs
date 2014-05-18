<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Divisions</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Edit Division</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/divisions'); ?>" class="btn btn-primary">View Divisions</a>
						</div>
					</div>

					<div class="grid-body">
							
						<div class="row">

							<div class="col-md-8 col-sm-8 col-xs-8">

								<!-- START Display Error Messages -->
								<?php if( validation_errors() && $this->input->post() ): ?>
								<div class="alert alert-error">
									<?php echo validation_errors(); ?>
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
								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/divisions/add') ): ?>
								<div class="alert alert-success">
									Record successfully added.
								</div>
								<?php endif; ?>
								<!-- END New Record Added Message -->

								<!-- START Form -->
								<?php echo form_open( 'admin/divisions/edit/' . $record['id'], array( 'id' => 'add-division-form') ); ?>

									<div class="form-group">
										<?php echo form_label( 'Division Name', 'name', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Men's First Division</span>
										<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value( 'name', $record['name'] ) ) ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Division Type', 'division_type', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Men's, Women's, or Youth</span>
										<?php $division_type_options = array( '' => '', 1 => "Men's", 2 => "Women's", 3 => "Youth" ); ?>
										<?php echo form_dropdown( 'division_type', $division_type_options, set_value( 'division_type', $record['division_type_id'] ), 'class="pretty-select"' ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Update Record</button>

								<?php echo form_close(); ?>
								<!-- END Form -->

							</div>

						</div>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-12 -->
		</div><!-- end .row -->

	</div><!-- end .content -->
</div><!-- end .page-content -->