<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title><?php if( !empty( $page_title) ) echo $page_title . ' | '; ?>Gotham Soccer League</title>
		<link href="<?php echo base_url('assets/site/assets/css/main.min.css'); ?>" rel="stylesheet">

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Google Maps JS Files -->
		<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp&#038;sensor=false&#038;ver=1'></script>
		<script type='text/javascript' src='http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.5/src/infobox_packed.js?ver=1'></script>
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
						<li><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><a href="<?php echo base_url('about'); ?>">About Us</a></li>
						<li><a href="<?php echo base_url('divisions'); ?>">Divisions</a></li>
						<!-- <li><a href="<?php echo base_url('history'); ?>">History</a></li> -->
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
						<?php foreach($games as $game)
						{
						?>
						<li>
							<div class="score-head">
								<div class="match"><?php echo $game['home_team'];?> v <?php echo $game['away_team'];?></div>
								<div class="division"><?php echo $game['division'];?></div>
							</div>
							<div class="score-body">
								<?php 
								$date = explode(' ' ,$game['game_date_time']);
								?>
								<div class="row">
								<div class="col-xs-8 date-location"><?php echo $date[0];?><br/><?php echo $game['location'];?></div>
								<div class="col-xs-4 final-score"><?php echo $game['score_home']?>-<?php echo $game['score_away']?> Final</div>
								</div>
							</div>
						</li>

						<?php
						}
						?>
						
					</ul>
				</div>
				<a href="#" class="control jcarousel-control-next"><i class="fa fa-angle-right"></i></a>
			</div>
			<!-- END Score Scroller -->
		</div>

		<!-- Start Content / Sidebar Container -->
		<div class="container">
			<div class="row">