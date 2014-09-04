<div id="content" class="col-md-8 col-md-push-4">
	<h1>Register</h1>

	<?php echo form_open( 'users/add', array( 'id' => 'add-division-form') ); ?>
							
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
						<?php echo form_label( 'First Name', 'firstname', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'first_name', 'class' => 'form-control', 'id' => 'firstname', 'value' => set_value('firstname') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Last Name', 'lastname', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'last_name', 'class' => 'form-control', 'id' => 'lastname', 'value' => set_value('lastname') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Birthday', 'birthday', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'birthday', 'class' => 'form-control', 'id' => 'birthday', 'value' => set_value('birthday') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Postal Code', 'postalcode', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'postal', 'class' => 'form-control', 'id' => 'postalcode', 'value' => set_value('postalcode') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Gender', 'gender', array( 'class' => 'form-label' ) ); ?>
						<div class="radio radio-success">
							<?php echo form_radio( array( 'name' => 'gender', 'id' => 'male', 'value' => 'Male', 'checked' => ( set_value('gender') == 'Male' ) ? TRUE : FALSE ) ); ?>
							<label for="male">Male</label>
							<?php echo form_radio( array( 'name' => 'gender', 'id' => 'female', 'value' => 'Female', 'checked' => ( set_value('gender') == 'Female' ) ? TRUE : FALSE ) ); ?>
							<label for="female">Female</label>
						</div>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Email Address', 'email', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value('email') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Password', 'password', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_password( array('name' => 'password', 'class' => 'form-control', 'id' => 'password', 'value' => set_value('password') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Confirm Password', 'confirm_password', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_password( array('name' => 'password_confirm', 'class' => 'form-control', 'id' => 'confirm_password', 'value' => set_value('confirm_password') ) ); ?>
					</div>

					<?php echo form_hidden('user_type_id', '3'); ?>


					<button type="submit" class="btn btn-primary">Register</button>

				<!-- END Form -->

			</div>
	</div>

</div>