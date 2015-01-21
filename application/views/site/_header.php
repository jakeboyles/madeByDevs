<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>Made By Devs</title>
		<link  rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link href="<?php echo base_url('assets/site/assets/css/main.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/site/assets/js/plugins/bootstrap-datepicker/css/datepicker.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/site/assets/js/plugins/lightbox2/css/lightbox.css'); ?>" rel="stylesheet">

		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700|Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<style class="additional">
		</style>

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>

	<body>
	<div class="visible-xs-block">
		<a class="mobileShow" href="#">
		<div class="MobileMenu">
		<i class="fa fa-align-justify "></i> MENU
		</div>
		</a>

		<div class="menu">
		<ul>
			<div class="searchContain">

				<?php echo form_open_multipart( 'projects/search', array( 'id' => 'register') ); ?>
				<input type="input" name="search" class="search">
				<i class="fa fa-search"></i>
				<input type="submit" class="hide">
				<?php echo form_close(); ?>


			</div>
			<h3 class="m-t-50">Projects</h3>
			<li><a href="<?php echo base_url('admin/projects/add');?>">Create Project</a></li>
			<li><a href="<?php echo base_url('projects');?>">View Projects</a></li>

			<h3>User</h3>

			<?php if($this->session->userdata('email')): ?>
				<li><a href="<?php echo base_url('/admin/users/profile/'.$this->session->userdata('user_id'));?>">Edit Profile</a></li>
				<li><a href="<?php echo base_url('/login/logout');?>">Logout</a></li>
			<?php else: ?>
				<li><a href="<?php echo base_url('/register');?>">Sign Up</a></li>
				<li><a href="<?php echo base_url('/login');?>">Login</a></li>
			<?php endif; ?>

<!-- 			<li><a href="#">Search Members</a></li>
 -->			<li><a href="<?php echo base_url('leaders');?>">See Leaderboard</a></li>



		</ul>		
	</div>
	</div>
