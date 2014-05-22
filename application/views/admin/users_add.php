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
								<?php echo form_open( 'admin/users/add', array( 'id' => 'add-user-form') ); ?>

									<h3>Login Information</h3>

									<div class="form-group">
										<?php echo form_label( 'User Type*', 'user_type_id', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Admin, Official, Player</span>
										<?php echo form_dropdown( 'user_type_id', array( '' => '') + $user_types, set_value('user_type_id'), 'class="pretty-select"' ); ?>
									</div>

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

									<h3>Personal Information</h3>

									<div class="row">

										<div class="form-group col-md-6">
											<?php echo form_label( 'First Name*', 'first_name', array( 'class' => 'form-label' ) ); ?>
											<span class="help"></span>
											<?php echo form_input( array( 'name' => 'first_name', 'class' => 'form-control', 'id' => 'first_name', 'value' => set_value('first_name') ) ); ?>
										</div>

										<div class="form-group col-md-6">
											<?php echo form_label( 'Last Name*', 'last_name', array( 'class' => 'form-label' ) ); ?>
											<span class="help"></span>
											<?php echo form_input( array( 'name' => 'last_name', 'class' => 'form-control', 'id' => 'last_name', 'value' => set_value('last_name') ) ); ?>
										</div>

									</div>

									<div class="row">

										<div class="form-group col-md-6">
											<?php echo form_label( 'Gender', 'gender', array( 'class' => 'form-label' ) ); ?>
											<div class="radio radio-success">
												<?php echo form_radio( array( 'name' => 'gender', 'id' => 'male', 'value' => 'Male', 'checked' => ( set_value('gender') == 'Male' ) ? TRUE : FALSE ) ); ?>
												<label for="male">Male</label>
												<?php echo form_radio( array( 'name' => 'gender', 'id' => 'female', 'value' => 'Female', 'checked' => ( set_value('gender') == 'Female' ) ? TRUE : FALSE ) ); ?>
												<label for="female">Female</label>
											</div>
										</div>

										<div class="form-group col-md-3">
											<?php echo form_label( 'Postal Code', 'postal', array( 'class' => 'form-label' ) ); ?>
											<span class="help"></span>
											<?php echo form_input( array( 'name' => 'postal', 'class' => 'form-control', 'id' => 'postal', 'value' => set_value('postal') ) ); ?>
										</div>

										<div class="form-group col-md-3">
											<?php echo form_label( 'Birthday', 'birthday', array( 'class' => 'form-label' ) ); ?>
											<span class="help"></span>

											<div class="row">

												<div class="input-append success date col-md-9">
													<?php echo form_input( array( 'name' => 'birthday', 'class' => 'form-control', 'id' => 'birthday', 'value' => set_value('birthday') ) ); ?>
													<span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
												</div>

											</div>

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