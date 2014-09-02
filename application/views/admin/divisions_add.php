<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Divisions</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Add Division</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/divisions'); ?>" class="btn btn-primary">View Divisions</a>
						</div>
					</div>

					<div class="grid-body">

						<?php echo form_open( 'admin/divisions/add', array( 'id' => 'add-division-form') ); ?>
							
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

								<!-- START Form -->

									<div class="form-group">
										<?php echo form_label( 'Division Name', 'name', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Men's First Division</span>
										<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value('name') ) ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Division Type', 'division_type', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Men's, Women's, or Youth</span>
										<?php echo form_dropdown( 'division_type', array( '' => '') + $division_types, set_value('division_type'), 'class="pretty-select"' ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Create Division</button>

								<!-- END Form -->

							</div>

							<!-- Second Column -->
				            <div class="col-md-4">
						 		<div class="grid simple">
									<div class="grid-title">
										<h4 class="pull-left">Assign Sessions</h4>
										<div class="pull-right">
											<a href="<?php echo base_url('admin/sessions'); ?>" class="btn btn-primary">View Sessions</a>
										</div>
									</div>

									<div class="grid-body">

										<?php
										//echo '<pre>'; var_dump( $divisions ); echo '</pre>';
										//echo '<pre>'; var_dump( $related_divisions ); echo '</pre>';
										?>

											<?php foreach( $sessions as $key => $val ): ?>
												<div class="checkbox check-primary">
													<?php $checked = ( !empty( $related_divisions ) && array_key_exists( $key, $related_divisions ) ) ? TRUE : FALSE; ?>
													<?php echo form_checkbox( array( 'name' => 'divisions[]', 'value' => $key, 'id' => 'checkbox' . $key, 'checked' => $checked ) ); ?>
													<?php echo form_label( $val, 'checkbox' . $key, array( 'class' => 'form-label' ) ); ?>
												</div>
											<?php endforeach; ?>

									</div>
								</div> 
							</div><!-- end .col-md-4 -->

						</div>

						<?php echo form_close(); ?>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-12 -->
		</div><!-- end .row -->

	</div><!-- end .content -->
</div><!-- end .page-content -->