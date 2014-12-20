<div id="content" class="col-md-8 col-md-push-4">
	<h1>Registration</h1>

	<?php echo form_open( '', array( 'id' => 'register') ); ?>
							
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
						<?php echo form_label( 'First Name *', 'firstname', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'first_name', 'class' => 'form-control', 'id' => 'firstname', 'value' => set_value('firstname') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Last Name *', 'lastname', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'last_name', 'class' => 'form-control', 'id' => 'lastname', 'value' => set_value('lastname') ) ); ?>
					</div>


					<div class="form-group">
						<?php echo form_label( 'Email Address', 'email', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value('email') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Password *', 'password', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_password( array('name' => 'password', 'class' => 'form-control', 'id' => 'password', 'value' => set_value('password') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Confirm Password *', 'confirm_password', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_password( array('name' => 'password_confirm', 'class' => 'form-control', 'id' => 'confirm_password', 'value' => set_value('confirm_password') ) ); ?>
					</div>


					<button type="submit" class="btn btn-primary">Register</button>

				<!-- END Form -->

			</div>
	</div>

</div>