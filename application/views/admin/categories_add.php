<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Posts</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
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

								<!-- START Form -->
								<?php echo form_open( 'admin/posts/add/', array( 'id' => 'add-post-form') ); ?>

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