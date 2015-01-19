<div id="content" class="col-md-10 col-md-push-2">
	<h1>Login</h1>

	<?php echo form_open( '/login', array( 'id' => 'login') ); ?>
							
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
						<?php echo form_label( 'Email Address', 'email', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_input( array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value('email') ) ); ?>
					</div>

					<div class="form-group">
						<?php echo form_label( 'Password', 'password', array( 'class' => 'form-label' ) ); ?>
						<?php echo form_password( array('name' => 'password', 'class' => 'form-control', 'id' => 'password', 'value' => set_value('password') ) ); ?>
					</div>

					<button type="submit" class="btn btn-primary">Login</button>

					<a href="<?php echo base_url('hauth/login/Twitter'); ?>" class="btn btn-block btn-social btn-twitter">
					    <i class="fa fa-twitter"></i> Sign in with Twitter
					</a>


				<!-- END Form -->

			</div>
	</div>

</div>