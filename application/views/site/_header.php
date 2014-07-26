<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title><?php if( !empty( $page_title) ) echo $page_title . ' | '; ?>Gotham Soccer League</title>
		<link href="<?php echo base_url('assets/site/assets/css/main.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/site/assets/css/chosen.css'); ?>" rel="stylesheet">

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<!-- START Sample Header / Menu -->
		<div class="full-width-nav">
			<div><a href="#" class="closeMenu"><i class="fa fa-times"></i></a></div>
			<div class="navigation"></div>
		</div>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">

			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<i class="fa fa-bars"></i>
					</button>

					<a class="navbar-brand" href="<?php echo base_url(); ?>">Gotham Soccer League</a>
				</div>

				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="<?php echo base_url('about'); ?>">About Us</a></li>
					<li><a href="<?php echo base_url('divisions'); ?>">Divisions</a></li>
					<li><a href="<?php echo base_url('history'); ?>">History</a></li>
					<li><a href="<?php echo base_url('directions'); ?>">Directions</a></li>
					<li><a href="<?php echo base_url('rules'); ?>">Rules</a></li>
					<li><a href="<?php echo base_url('teams'); ?>">Team Pages</a></li>
					<li><a href="<?php echo base_url('login'); ?>">Login</a></li>
					<li><a href="<?php echo base_url('register'); ?>" class="signup">Sign Up</a></li>
					</ul>
				</div>

			</div>

		</div>
		<!-- END Sample Header / Menu -->

		<div class="container">
			<!-- START Score Scroller -->
			<div class="score-scroller">
				<a href="#" class="control jcarousel-control-prev"><i class="fa fa-angle-left"></i></a>
				<div class="jcarousel">
					<ul>
						<li>
							<div class="score-head">
								<div class="match">BR v EFC</div>
								<div class="division">D1</div>
							</div>
							<div class="score-body">
								<div class="date-location">04/10/13<br/>Randals Island</div>
								<div class="final-score">4-5 Final</div>
							</div>
						</li>
						<li>
							<div class="score-head">
								<div class="match">BR v EFC</div>
								<div class="division">D2</div>
							</div>
							<div class="score-body">
								<div class="date-location">04/10/13<br/>Randals Island</div>
								<div class="final-score">3-2 Final</div>
							</div>
						</li>
						<li>
							<div class="score-head">
								<div class="match">BR v EFC</div>
								<div class="division">D6</div>
							</div>
							<div class="score-body">
								<div class="date-location">04/10/13<br/>Randals Island</div>
								<div class="final-score">2-1 Final</div>
							</div>
						</li>
						<li>
							<div class="score-head">
								<div class="match">dAR v PVC</div>
								<div class="division">D15</div>
							</div>
							<div class="score-body">
								<div class="date-location">04/10/14<br/>Randals Island</div>
								<div class="final-score">5-8 Final</div>
							</div>
						</li>
						<li>
							<div class="score-head">
								<div class="match">BR v EFC</div>
								<div class="division">D1</div>
							</div>
							<div class="score-body">
								<div class="date-location">06/10/13<br/>Randals Island</div>
								<div class="final-score">2-6 Final</div>
							</div>
						</li>
						<li>
							<div class="score-head">
								<div class="match">BR v EFC</div>
								<div class="division">D6</div>
							</div>
							<div class="score-body">
								<div class="date-location">10/10/13<br/>Randals Island</div>
								<div class="final-score">5-6 Final</div>
							</div>
						</li>
						<li>
							<div class="score-head">
								<div class="match">BR v EFC</div>
								<div class="division">D12</div>
							</div>
							<div class="score-body">
								<div class="date-location">04/10/13<br/>Randals Island</div>
								<div class="final-score">5-6 Final</div>
							</div>
						</li>
					</ul>
				</div>
				<a href="#" class="control jcarousel-control-next"><i class="fa fa-angle-right"></i></a>
			</div>
			<!-- END Score Scroller -->
		</div>

		<!-- Start Content / Sidebar Container -->
		<div class="container">
			<div class="row">