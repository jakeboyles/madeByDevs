<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel - Gotham Soccer League</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- BEGIN PLUGIN CSS -->
	<link href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo base_url(); ?>assets/admin/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo base_url(); ?>assets/admin/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/admin/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo base_url(); ?>assets/admin/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- END PLUGIN CSS -->

	<!-- BEGIN CORE CSS FRAMEWORK -->
	<link href="<?php echo base_url(); ?>assets/admin/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/admin/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/admin/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/admin/css/animate.min.css" rel="stylesheet" type="text/css"/>
	<!-- END CORE CSS FRAMEWORK -->
	
	<!-- BEGIN CSS TEMPLATE -->
	<link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/admin/css/responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/admin/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/admin/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END CSS TEMPLATE -->
</head>
<body class="">

<!-- BEGIN CONTENT -->
<div class="page-container row-fluid">

	<div class="page-content" style="margin-left: 0;"> 

		<div class="content container">  

			<div class="row">
				<div class="col-md-offset-3 col-md-6">

					<div class="page-title">	
						<h3>Admin Panel Login</h3>		
					</div>

			 		<div class="grid simple ">

						<div class="grid-title">
							<h4>Please enter your login credentials.</h4>
						</div>

						<div class="grid-body">
							<?php if( !empty( validation_errors() ) ): ?>
							<div class="alert alert-error">
								<?php echo validation_errors(); ?>
							</div>
							<?php endif; ?>

							<?php echo form_open( 'admin/login', array( 'id' => 'add-division-form') ); ?>

								<div class="form-group">
									<?php echo form_label( 'Email Address', 'email', array( 'class' => 'form-label' ) ); ?>
									<?php echo form_input( array( 'name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => $this->input->post('email') ) ); ?>
								</div>

								<div class="form-group">
									<?php echo form_label( 'Password', 'password', array( 'class' => 'form-label' ) ); ?>
									<?php echo form_password( array( 'name' => 'password', 'class' => 'form-control', 'id' => 'password', 'value' => $this->input->post('password') ) ); ?>
								</div>

								<div class="pull-right">
									<button type="submit" class="btn btn-primary">Login</button>
								</div>

								<div class="clearfix"></div>

							<?php echo form_close(); ?>
						</div>

					</div>
				</div>
			</div>


		</div>

	</div>

</div>
<!-- END CONTENT -->

<!-- BEGIN CORE JS FRAMEWORK-->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/breakpoints.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->

<!-- BEGIN PAGE LEVEL JS -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>ß
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery-datatable/extra/js/TableTools.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-responsive/js/datatables.responsive.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-responsive/js/lodash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/datatables.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN CORE TEMPLATE JS -->
<script src="<?php echo base_url(); ?>assets/admin/js/core.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->

<!-- BEGIN CUSTOM JS -->
<script src="<?php echo base_url(); ?>assets/admin/js/custom.js" type="text/javascript"></script>
<!-- END CUSTOM JS -->

</body>
</html>