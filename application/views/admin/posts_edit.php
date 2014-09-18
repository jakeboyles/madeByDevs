<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Posts</h3>		
		</div>

		<!-- START Form -->
		<?php echo form_open_multipart( 'admin/posts/edit/' . $record['id'], array( 'id' => 'edit-post-form' ) ); ?>
		<div class="row">
			<div class="col-md-8">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4 class="pull-left">Edit Post</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/posts'); ?>" class="btn btn-primary">View Posts</a>
							<a href="<?php echo base_url($record['slug']); ?>" target="_blank" class="btn btn-info">Preview</a>
						</div>
					</div>

					<div class="grid-body">
							
						<div class="row">

							<div class="col-md-12 col-sm-12 col-xs-12">

								<!-- START Display Error Messages -->
								<?php if( !empty($errors) ): ?>
								<div class="alert alert-error">
									<h4>Form Submission Errors</h3>
									<ul>
									<?php echo $errors; ?>
									</ul>
								</div>
								<?php endif; ?>


								<!-- START Display Error Messages -->
								<?php if( validation_errors() && $this->input->post() ): ?>
								<div class="alert alert-error">
									<h4>Form Submission Errors</h3>
									<ul>
									<?php echo validation_errors('<li>','</li>'); ?>
									</ul>
								</div>
								<?php endif; ?>
								<!-- END Display Error Messages -->

								<!-- START Success Message -->
								<?php if( !validation_errors() && $this->input->post() && empty($errors) ): ?>
								<div class="alert alert-success">
									This record has been updated.
								</div>
								<?php endif; ?>
								<!-- END Success Message -->
								
								<!-- START New Record Added Message -->
								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/posts/add') ): ?>
								<div class="alert alert-success">
									Record successfully added.
								</div>
								<?php endif; ?>
								<!-- END New Record Added Message -->

								<div class="form-group">
									<?php echo form_label( 'Post Title*', 'title', array( 'class' => 'form-label' ) ); ?>
									<span class="help"></span>
									<?php echo form_input( array('name' => 'title', 'class' => 'form-control', 'id' => 'title', 'value' => set_value( 'title', $record['title'] ) ) ); ?>
								</div>

								<div class="form-group">
									<?php echo form_label( 'Post URL Slug*', 'slug', array( 'class' => 'form-label' ) ); ?>
									<span class="help">e.g. a post slug of "about" would produce gothamsoccerleague.com/about</span>
									<?php echo form_input( array('name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'value' => set_value( 'slug', $record['slug'] ) ) ); ?>
								</div>

								<div class="form-group">
									<?php echo form_label( 'Post Date', 'slug', array( 'class' => 'form-label' ) ); ?>
									<span class="help">e.g. Date that post will go live</span>
									<?php echo form_input( array('name' => 'post_date', 'class' => 'date input-append form-control', 'id' => 'post_date', 'value' => set_value( 'post_date', date('m/d/Y',strtotime($record['post_date']) ) ) ) ); ?>
								</div>

								<div class="form-group">
									<?php echo form_label( 'Post Content', 'content', array( 'class' => 'form-label' ) ); ?>
									<span class="help"></span>
									<?php echo form_textarea( array('name' => 'content', 'class' => 'form-control', 'id' => 'content', 'value' => set_value( 'content', $record['content'] ) ) ); ?>
								</div>

								<button type="submit" class="btn btn-primary">Update Post</button>

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
						<?php if(!empty($categories)): ?>
						<?php foreach( $categories as $category ): ?>
							<div class="checkbox check-primary">
								<?php
								// Determine if the Checkbox Should be Checked or Not
								if( !empty( $this->input->post( 'categories' ) ) && in_array( $category['id'], $this->input->post( 'categories' ) ) )
									$checked = TRUE;
								elseif ( !empty( $post_categories ) && empty( $this->input->post() ) && array_key_exists( $category['id'], $post_categories ) )
									$checked = TRUE;
								else
									$checked = FALSE;
								?>
								<?php echo form_checkbox( array( 'name' => 'categories[]', 'value' => $category['id'], 'id' => 'checkbox' . $category['id'], 'checked' => $checked ) ); ?>
								<?php echo form_label( $category['name'], 'checkbox' . $category['id'], array( 'class' => 'form-label' ) ); ?>
							</div>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="grid simple">
					<div class="grid-title">
						<h4 class="pull-left">Featured Image</h4>
					</div>

					<div class="grid-body">
						<div class="form-group">
							<?php echo form_upload( array('name' => 'featured_image', 'class' => 'form-control', 'id' => 'featured_image', 'value' => set_value( 'featured_image' ) ) ); ?>
						</div>

						<?php if(!empty($record['featured_image'])): ?>
							<img class='edit-featured-image' src="<?php echo base_url('uploads').'/'.$record['featured_image_filename'] ; ?>" />
						<?php endif; ?>

					</div>
				</div>
				
			</div><!-- end .col-md-4 -->

		</div><!-- end .row -->
		<?php echo form_hidden( 'original_slug', $record['slug'] ); ?>
		<?php echo form_hidden( 'featured_image_edit', $record['featured_image'] ); ?>
		<?php echo form_close(); ?>

	</div><!-- end .content -->
</div><!-- end .page-content -->