<div class="page-content"> 

	<div class="content">  

		<div class="page-title">	
			<h3>Dashboard</h3>		
		</div>

		<h4>League Overview</h4>

		<div class="row">

			<div class="col-md-3 col-sm-6">
				<div class="tiles blue added-margin m-b-20">
					<div class="tiles-body">
						<!-- <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a></div> -->
						<div class="tiles-title">TOTAL USERS</div>
						<h2 class="text-white bold "><span data-animation-duration="900" data-value="<?php echo $users_total; ?>" class="animate-number">0</span></h2>
						<div class="tiles-title">REGISTERED THIS MONTH</div>
						<h2 class="text-white bold "><span data-animation-duration="900" data-value="<?php echo $users_this_month; ?>" class="animate-number">0</span></h2>
						<div class="overlayer bottom-right">
							<div class="p-r-15 p-b-15"> <i class="fa fa-user fa fa-5x"></i></div>
						</div>		
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="tiles green added-margin m-b-20">
					<div class="tiles-body">
						<!-- <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a></div> -->
						<div class="tiles-title">TOTAL GAMES</div>
						<h2 class="text-white bold "><span data-animation-duration="900" data-value="<?php echo $games_total; ?>" class="animate-number">0</span></h2>
						<div class="tiles-title">SCHEDULED THIS MONTH</div>
						<h2 class="text-white bold "><span data-animation-duration="900" data-value="<?php echo $games_this_month; ?>" class="animate-number">0</span></h2>
						<div class="overlayer bottom-right">
							<div class="p-r-15 p-b-15"> <i class="fa fa-bullhorn fa fa-5x"></i></div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="tiles red added-margin m-b-20">
					<div class="tiles-body">
						<!-- <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a></div> -->
						<div class="tiles-title">TOTAL TEAMS</div>
						<h2 class="text-white bold "><span data-animation-duration="900" data-value="<?php echo $teams_total; ?>" class="animate-number">0</span></h2>
						<div class="tiles-title">REGISTERED THIS MONTH</div>
						<h2 class="text-white bold "><span data-animation-duration="900" data-value="<?php echo $teams_this_month; ?>" class="animate-number">0</span></h2>
						<div class="overlayer bottom-right">
							<div class="p-r-15 p-b-15"> <i class="fa fa-users fa fa-5x"></i></div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="tiles purple added-margin m-b-20">
					<div class="tiles-body">
						<!-- <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a></div> -->
						<div class="tiles-title">TOTAL SEASONS</div>
						<h2 class="text-white bold "><span data-animation-duration="900" data-value="<?php echo $seasons_total; ?>" class="animate-number">0</span></h2>
						<div class="tiles-title">TOTAL SESSIONS</div>
						<h2 class="text-white bold "><span data-animation-duration="900" data-value="<?php echo $sessions_total; ?>" class="animate-number">0</span></h2>
						<div class="overlayer bottom-right">
							<div class="p-r-15 p-b-15"> <i class="fa fa-calendar fa fa-5x"></i></div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<h4>Content Management Overview</h4>

		<div class="row">

			<div class="col-md-3 col-sm-6">
				<div class="tiles white added-margin m-b-20">
					<div class="tiles-body">
						<!-- <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a></div> -->
						<h4 class="text-black no-margin semi-bold">Blog Posts</h4>
						<h2 class="text-black bold "><span data-animation-duration="900" data-value="<?php echo $post_total; ?>" class="animate-number">0</span></h2>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/posts/'); ?>" class="btn btn-primary">View Posts <i class="fa fa-arrow-circle-right"></i></a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="tiles white added-margin m-b-20">
					<div class="tiles-body">
						<!-- <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a></div> -->
						<h4 class="text-black no-margin semi-bold">Pages</h4>
						<h2 class="text-black bold "><span data-animation-duration="900" data-value="<?php echo $page_total; ?>" class="animate-number">0</span></h2>
						<div class="pull-right">
							<a href="<?php echo base_url('admin/pages/'); ?>" class="btn btn-primary">View Pages <i class="fa fa-arrow-circle-right"></i></a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>