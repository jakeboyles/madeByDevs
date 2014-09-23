<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title><?php if( !empty( $page_title) ) echo $page_title . ' | '; ?>Gotham Soccer League</title>
		<link href="<?php echo base_url('assets/site/assets/css/main.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/site/assets/js/plugins/bootstrap-datepicker/css/datepicker.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/site/assets/js/plugins/lightbox2/css/lightbox.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/site/assets/fonts/weather-icons-master/css/weather-icons.min.css'); ?>" rel="stylesheet">

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
						<li><a href="<?php echo base_url('about'); ?>">About</a></li>
						<li><a href="<?php echo base_url('divisions'); ?>">Divisions</a></li>
						<li><a href="<?php echo base_url('history'); ?>">History</a></li>
						<li><a href="<?php echo base_url('directions'); ?>">Directions</a></li>
						<li><a href="<?php echo base_url('rules'); ?>">Rules</a></li>
						<li><a href="<?php echo base_url('teams'); ?>">Teams</a></li>
						<!-- <li><a href="<?php echo base_url('cms/blog'); ?>">News</a></li> -->
						<li><a href="<?php echo base_url('login'); ?>">Account</a></li>
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

					<?php
					$ci =&get_instance();
					$ci->load->model( 'Game_model' );
					$games= $ci->Game_model->get_slider_games();
					?>

					<?php if(!empty($games)): ?>
					<ul>
						<?php foreach($games as $game)
						{
						?>
						<li>
							<div class="score-head">
								<div class="match col-xs-12"><a href="<?php echo base_url('teams').'/page/'.$game['team_home_id']; ?>"><?php echo $game['home_team'];?></a> vs.<br> <a href="<?php echo base_url('teams').'/page/'.$game['team_away_id']; ?>"><?php echo $game['away_team'];?></a></div>
								<div class="division col-xs-12 text-right"><a href="<?php echo base_url('divisions').'/page/'.$game['division_id']; ?>"><?php echo $game['division'];?></a></div>
							</div>
							<div class="score-body">
								<?php 
								$date = Date('m/d/y', strtotime($game['game_date_time']))
								?>
								<div class="row">
								<div class="col-xs-8 date-location"><span class="date"><?php echo $date;?></span><br/><span class="location"><?php echo $game['location'];?></span></div>
								<div class="col-xs-4 final-score"><?php echo $game['score_home']?>-<?php echo $game['score_away']?> Final</div>
								</div>
							</div>
						</li>

						<?php
						}
						?>	
					</ul>
				<?php endif; ?>
				</div>
				<a href="#" class="control jcarousel-control-next"><i class="fa fa-angle-right"></i></a>
			</div>
			<!-- END Score Scroller -->
		</div>

		<!-- Start Content / Sidebar Container -->
		<div class="container">
			<div class="row">