<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel - Gotham Soccer League</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- NEED TO WORK ON -->

	<link href="assets/admin/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="assets/admin/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="assets/admin/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/admin/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/admin/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="assets/admin/css/animate.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/admin/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="assets/admin/css/responsive.css" rel="stylesheet" type="text/css"/>
	<link href="assets/admin/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>

	<!-- BEGIN CORE JS FRAMEWORK--> 
	<script src="assets/admin/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
	<script src="assets/admin/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
	<script src="assets/admin/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
	<script src="assets/admin/plugins/breakpoints.js" type="text/javascript"></script> 
	<script src="assets/admin/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
	<script src="assets/admin/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
	<!-- END CORE JS FRAMEWORK --> 
	<!-- BEGIN PAGE LEVEL JS --> 	
	<script src="assets/admin/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script> 	
	<script src="assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
	<script src="assets/admin/plugins/pace/pace.min.js" type="text/javascript"></script>  
	<script src="assets/admin/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS --> 	
	
	<!-- BEGIN CORE TEMPLATE JS --> 
	<script src="assets/admin/js/core.js" type="text/javascript"></script> 
	<script src="assets/admin/js/chat.js" type="text/javascript"></script> 
	<script src="assets/admin/js/demo.js" type="text/javascript"></script> 
	<!-- END CORE TEMPLATE JS --> 

	<!-- END NEED TO WORK ON -->

</head>
<body class="">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse"> 
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="navbar-inner">
		<!-- BEGIN NAVIGATION HEADER -->
		<div class="header-seperation"> 
			<!-- BEGIN MOBILE HEADER -->
			<ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">	
				<li class="dropdown">
					<a id="main-menu-toggle" href="#main-menu" class="">
						<div class="iconset top-menu-toggle-white"></div>
					</a>
				</li>		 
			</ul>
			<!-- END MOBILE HEADER -->
			<!-- BEGIN LOGO -->	
			<a href="<?php echo base_url('admin'); ?>">
				<img src="assets/admin/img/logo.png" class="logo" alt="" data-src="assets/admin/img/logo.png" data-src-retina="assets/admin/img/logo2x.png" width="222" height="21"/>
			</a>
			<!-- END LOGO --> 
		</div>
		<!-- END NAVIGATION HEADER -->
		<!-- BEGIN CONTENT HEADER -->
		<div class="header-quick-nav"> 
			<!-- BEGIN HEADER LEFT SIDE SECTION -->
			<div class="pull-left"> 
				<!-- BEGIN SLIM NAVIGATION TOGGLE -->
				<ul class="nav quick-section">
					<li class="quicklinks">
						<a href="#" class="" id="layout-condensed-toggle">
							<div class="iconset top-menu-toggle-dark"></div>
						</a>
					</li>
				</ul>
				<!-- END SLIM NAVIGATION TOGGLE -->				
				<!-- BEGIN HEADER QUICK LINKS -->
				<ul class="nav quick-section">
					<!-- BEGIN SEARCH BOX -->
					<li class="m-r-10 input-prepend inside search-form no-boarder">
						<span class="add-on"><span class="iconset top-search"></span></span>
						<input name="" type="text" class="no-boarder" placeholder="Search Dashboard" style="width:250px;">
					</li>
					<!-- END SEARCH BOX -->
				</ul>
				<!-- BEGIN HEADER QUICK LINKS -->				
			</div>
			<!-- END HEADER LEFT SIDE SECTION -->
			<!-- BEGIN HEADER RIGHT SIDE SECTION -->
			<div class="pull-right"> 
				<div class="chat-toggler">	
					<!-- BEGIN NOTIFICATION CENTER -->
					<a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content="" data-toggle="dropdown" data-original-title="Notifications">
						<div class="user-details"> 
							<div class="username">
								&nbsp;John<span class="bold">&nbsp;Smith</span>									
							</div>						
						</div> 
						<div class="iconset top-down-arrow"></div>
					</a>	
					<div id="notification-list" style="display:none">
						<div style="width:300px">
							<!-- BEGIN NOTIFICATION MESSAGE -->
							<div class="notification-messages info">
								<div class="user-profile">
									<img src="assets/admin/img/profiles/d.jpg" alt="" data-src="assets/admin/img/profiles/d.jpg" data-src-retina="assets/admin/img/profiles/d2x.jpg" width="35" height="35">
								</div>
								<div class="message-wrapper">
									<div class="heading">Title of Notification</div>
									<div class="description">Description...</div>
									<div class="date pull-left">A min ago</div>										
								</div>
								<div class="clearfix"></div>									
							</div>
							<!-- END NOTIFICATION MESSAGE -->	
						</div>				
					</div>
					<!-- END NOTIFICATION CENTER -->   			
				</div>
				<!-- BEGIN HEADER NAV BUTTONS -->
				<ul class="nav quick-section">
					<!-- BEGIN SETTINGS -->
					<li class="quicklinks"> 
						<a data-toggle="dropdown" class="dropdown-toggle pull-right" href="#" id="user-options">						
							<div class="iconset top-settings-dark"></div> 	
						</a>
						<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">
							<li><a href="#">Normal Link</a></li>
							<li><a href="#">Badge Link&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a></li>
							<li class="divider"></li>                
							<li><a href="#"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Separated Link</a></li>
						</ul>
					</li>
					<!-- END SETTINGS -->	
				</ul>
				<!-- END HEADER NAV BUTTONS -->
			</div>
			<!-- END HEADER RIGHT SIDE SECTION -->
		</div> 
		<!-- END CONTENT HEADER --> 
	</div>
	<!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER -->

<!-- BEGIN CONTENT -->
<div class="page-container row-fluid">
	 