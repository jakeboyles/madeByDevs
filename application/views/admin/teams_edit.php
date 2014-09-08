<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Teams</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple">

<!-- 					<div class="grid-title">
						<h4>Edit Team</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/teams'); ?>" class="btn btn-primary">View Teams</a>
						</div>
					</div> -->

					<div class="grid-body">
						<div class="row">

							<div class="col-md-8 col-sm-8 col-xs-8">

								<!-- START Display Error Messages -->
								<?php if( validation_errors() && $this->input->post() ): ?>
								<div class="alert alert-error">
									<h4>Form Submission Errors</h4>
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
								<?php if( $this->agent->is_referral() && $this->agent->referrer() == base_url('admin/teams/add') ): ?>
								<div class="alert alert-success">
									Record successfully added.
								</div>
								<?php endif; ?>
								<!-- END New Record Added Message -->

								<!-- START Form -->

								<!-- END Form -->

							</div>

						</div>

					</div><!-- end .grid-body -->

				</div><!-- end .grid -->
			</div><!-- end .col-md-12 -->
		</div><!-- end .row -->

		

	</div><!-- end .content -->
</div><!-- end .page-content -->