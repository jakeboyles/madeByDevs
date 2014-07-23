<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Pages</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

					<div class="grid-title">
						<h4>Edit Page</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/pages'); ?>" class="btn btn-primary">View Pages</a>
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
								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/pages/add') ): ?>
								<div class="alert alert-success">
									Record successfully added.
								</div>
								<?php endif; ?>
								<!-- END New Record Added Message -->

								<!-- START Form -->
								<?php echo form_open( 'admin/pages/edit/' . $record['id'], array( 'id' => 'edit-page-form') ); ?>

									<div class="form-group">
										<?php echo form_label( 'Page Title*', 'title', array( 'class' => 'form-label' ) ); ?>
										<span class="help"></span>
										<?php echo form_input( array('name' => 'title', 'class' => 'form-control', 'id' => 'title', 'value' => set_value( 'title', $record['title'] ) ) ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Page Slug*', 'slug', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. a page slug of "about" would produce gothamsoccerleague.com/about</span>
										<?php echo form_input( array('name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'value' => set_value( 'slug', $record['slug'] ) ) ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Page Content', 'content', array( 'class' => 'form-label' ) ); ?>
										<span class="help"></span>
										<?php echo form_textarea( array('name' => 'content', 'class' => 'form-control', 'id' => 'content', 'value' => set_value( 'content', $record['content'] ) ) ); ?>
									</div>

									<button type="submit" class="btn btn-primary">Update Page</button>

									<?php echo form_hidden( 'original_slug', $record['slug'] ); ?>
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