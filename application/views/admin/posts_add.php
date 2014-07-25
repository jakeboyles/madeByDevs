<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Posts</h3>		
		</div>

		<!-- START Form -->
		<?php echo form_open( 'admin/posts/add/', array( 'id' => 'add-post-form') ); ?>
		<div class="row">
			<div class="col-md-8">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Add Post</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/posts'); ?>" class="btn btn-primary">View Posts</a>
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
								

								<div class="form-group">
									<?php echo form_label( 'Post Title*', 'title', array( 'class' => 'form-label' ) ); ?>
									<span class="help"></span>
									<?php echo form_input( array('name' => 'title', 'class' => 'form-control', 'id' => 'title', 'value' => set_value( 'title' ) ) ); ?>
								</div>

								<div class="form-group">
									<?php echo form_label( 'Post URL Slug*', 'slug', array( 'class' => 'form-label' ) ); ?>
									<span class="help">e.g. a post slug of "about" would produce gothamsoccerleague.com/about</span>
									<?php echo form_input( array('name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'value' => set_value( 'slug' ) ) ); ?>
								</div>

								<div class="form-group">
									<?php echo form_label( 'Post Content', 'content', array( 'class' => 'form-label' ) ); ?>
									<span class="help"></span>
									<?php echo form_textarea( array('name' => 'content', 'class' => 'form-control', 'id' => 'content', 'value' => set_value( 'content' ) ) ); ?>
								</div>

								<button type="submit" class="btn btn-primary">Create Post</button>

							</div>

						</div>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-8 -->

			<!-- Second Column -->
			<div class="col-md-4">

		 		<div class="grid simple">
					<div class="grid-title">
						<h4 class="pull-left">Post Categories</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/categories'); ?>" class="btn btn-primary">View Categories</a>
						</div>
					</div>

					<div class="grid-body">
						<?php foreach( $categories as $category ): ?>
							<div class="checkbox check-primary">
								<?php
								// Determine if the Checkbox Should be Checked or Not
								if( !empty( $this->input->post( 'categories' ) ) && in_array( $category['id'], $this->input->post( 'categories' ) ) )
									$checked = TRUE;
								else
									$checked = FALSE;
								?>
								<?php echo form_checkbox( array( 'name' => 'categories[]', 'value' => $category['id'], 'id' => 'checkbox' . $category['id'], 'checked' => $checked ) ); ?>
								<?php echo form_label( $category['name'], 'checkbox' . $category['id'], array( 'class' => 'form-label' ) ); ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				
			</div><!-- end .col-md-4 -->

		</div><!-- end .row -->
		<?php echo form_close(); ?><!-- END Form -->					

	</div><!-- end .content -->
</div><!-- end .page-content -->