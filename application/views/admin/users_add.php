<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Users</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Add User</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/users'); ?>" class="btn btn-primary">View Users</a>
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

								<!-- START Form -->
								<?php echo form_open( '', array( 'id' => 'add-user-form') ); ?>

									<h3>Login Information</h3>


									<div class="form-group">
										<?php echo form_label( 'Email*', 'email', array( 'class' => 'form-label' ) ); ?>
										<span class="help">This will act as the username for the user.</span>
										<?php echo form_input( array( 'name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value('email') ) ); ?>
									</div>

									<div class="row">

										<div class="form-group col-md-6">
											<?php echo form_label( 'Password*', 'password', array( 'class' => 'form-label' ) ); ?>
											<span class="help"></span>
											<?php echo form_password( array( 'name' => 'password', 'class' => 'form-control', 'id' => 'password', 'value' => set_value('password') ) ); ?>
										</div>


										<div class="form-group col-md-6">
											<?php echo form_label( 'Re-Type Password*', 'password_confirm', array( 'class' => 'form-label' ) ); ?>
											<span class="help"></span>
											<?php echo form_password( array( 'name' => 'password_confirm', 'class' => 'form-control', 'id' => 'password_confirm', 'value' => set_value('password_confirm') ) ); ?>
										</div>

									</div>




									<button type="submit" class="btn btn-primary">Create User</button>

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