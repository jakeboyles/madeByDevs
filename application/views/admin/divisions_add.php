<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Divisions</h3>		
		</div>

		<div class="row">
			<div class="col-md-12">
		 		<div class="grid simple ">

					<div class="grid-title">
						<h4>Add Division</h4>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/divisions'); ?>" class="btn btn-primary">View Divisions</a>
						</div>
					</div>

					<div class="grid-body">
							
						<div class="row">

							<div class="col-md-8 col-sm-8 col-xs-8">
								<?php echo form_open( 'admin/add', array( 'id' => 'add-division-form') ); ?>

									<div class="form-group">
										<?php echo form_label( 'Division Name', 'name', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Men's First Division</span>
										<?php echo form_input( array('name' => 'name', 'class' => 'form-control', 'id' => 'name') ); ?>
									</div>

									<div class="form-group">
										<?php echo form_label( 'Division Type', 'division_type', array( 'class' => 'form-label' ) ); ?>
										<span class="help">e.g. Men's, Women's, or Youth</span>
										<?php $division_type_options = array( '' => '', 1 => "Men's", 2 => "Women's", 3 => "Youth" ); ?>
										<?php echo form_dropdown( 'division_type', $division_type_options, '', 'class="pretty-select"' ); ?>
									</div>

								<?php echo form_close(); ?>
							</div>

						</div>

					</div>

				</div>
			</div>
		</div>


	</div>

</div>