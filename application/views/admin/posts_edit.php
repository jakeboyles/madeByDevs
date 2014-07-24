<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Posts</h3>		
		</div>

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

							<div class="col-md-8 col-sm-8 col-xs-8">

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
								<?php if( !validation_errors() && $this->input->post() ): ?>
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

								<!-- START Form -->
								<?php echo form_open( 'admin/posts/edit/' . $record['id'], array( 'id' => 'edit-post-form' ) ); ?>

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
										<?php echo form_label( 'Post Content', 'content', array( 'class' => 'form-label' ) ); ?>
										<span class="help"></span>
										<?php echo form_textarea( array('name' => 'content', 'class' => 'form-control', 'id' => 'content', 'value' => set_value( 'content', $record['content'] ) ) ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Update Post</button>

									<?php echo form_hidden( 'original_slug', $record['slug'] ); ?>
								<?php echo form_close(); ?>
								<!-- END Form -->

							</div>

						</div>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-8 -->

			<!-- Second Column -->
			<div class="col-md-4">

		 		<div class="grid simple">
					<div class="grid-title">
						<h4 class="pull-left">Assign Categories</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/categories'); ?>" class="btn btn-primary">Edit Categories</a>
						</div>
					</div>

					<div class="grid-body">
						<!-- 
						<?php foreach( $divisions as $key => $val ): ?>
							<div class="checkbox check-primary">
								<?php $checked = !empty( $this->input->post( 'divisions' ) ) && in_array( $key, $this->input->post( 'divisions' ) ) ? TRUE : FALSE; ?>
								<?php echo form_checkbox( array( 'name' => 'divisions[]', 'value' => $key, 'id' => 'checkbox' . $key, 'checked' => $checked ) ); ?>
								<?php echo form_label( $val, 'checkbox' . $key, array( 'class' => 'form-label' ) ); ?>
							</div>
						<?php endforeach; ?>
						-->
					</div>
				</div>
				
			</div><!-- end .col-md-4 -->



		</div><!-- end .row -->

	</div><!-- end .content -->
</div><!-- end .page-content -->