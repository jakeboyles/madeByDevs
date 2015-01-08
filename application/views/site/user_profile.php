<div id="content" class="col-md-10 col-md-push-2">
	<h1>Edit Profile</h1>

	<?php echo form_open_multipart( 'users/update/'.$user['id'], array( 'id' => 'register') ); ?>
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


				<div class="form-group col-md-12">
					<?php echo form_label( 'Name', 'name', array( 'class' => 'form-label' ) ); ?><br>
					<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'github', 'value' => set_value('github', $user['display_name']) ) ); ?>
				</div>


				<div class="form-group col-md-12">
					<?php echo form_label( 'Email', 'email', array( 'class' => 'form-label' ) ); ?><br>
					<?php echo form_input( array('name' => 'email', 'class' => 'form-control', 'id' => 'github', 'value' => set_value('email', $user['email']) ) ); ?>
				</div>

				<div class='m-t-40 pull-left'>
					<?php if(!empty($user["profile_pic"])): ?>
							<div class="col-md-4">
								<img src="<?php echo $user['profile_pic']; ?>">
							</div>

							<div class="col-md-4">

								<div class="form-group col-md-12">
									<?php echo form_label( 'Update Image', 'email', array( 'class' => 'form-label' ) ); ?><br>
									<?php echo form_upload( array('name' => 'image','multiple' => '', 'class' => 'form-controll', 'id' => 'logo', 'value' => set_value( 'logo' ) ) ); ?>
								</div>

							</div>
					<?php else:?>

						<div class="form-group col-md-12">
							<?php echo form_label( 'Update Image', 'email', array( 'class' => 'form-label' ) ); ?><br>
							<?php echo form_upload( array('name' => 'image','multiple' => '', 'class' => 'form-controll', 'id' => 'logo', 'value' => set_value( 'logo' ) ) ); ?>
						</div>


					<?php endif; ?>
				</div>

	

					<div class="col-md-12">
					<button type="submit" class="m-t-40 btn btn-primary">Update</button>
					</div>


			</div>
	</div>

</div>