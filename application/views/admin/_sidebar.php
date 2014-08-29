	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar" id="main-menu"> 
		<div class="page-sidebar-wrapper" id="main-menu-wrapper">
			
			<ul>	
				<!-- Dashboard LINK -->
				<li class="start <?php echo !$this->uri->segment(2) ? 'active' : ''; ?>">
					<a href="<?php echo base_url('admin'); ?>">
						<i class="icon-custom-home"></i>
						<span class="title">Dashboard</span>
						<span class="selected"></span>
					</a>
				</li>
			</ul>

			<!-- Content Management Menu -->
			<p class="menu-title">Content Management</p>
			<ul>
				<li class="<?php echo $this->uri->segment(2) == 'pages' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-pencil"></i>
						<span class="title">Pages</span>
						<span class="arrow<?php echo $this->uri->segment(2) == 'pages' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/pages'); ?>">All Pages</a></li>
						<li><a href="<?php echo base_url( 'admin/pages/add'); ?>">Add New</a></li>
					</ul>
				</li>
				<li class="<?php echo $this->uri->segment(2) == 'posts' ||  $this->uri->segment(2) == 'categories' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-edit"></i>
						<span class="title">Posts</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'posts' ||  $this->uri->segment(2) == 'categories' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/posts'); ?>">All Posts</a></li>
						<li><a href="<?php echo base_url( 'admin/posts/add'); ?>">Add New Post</a></li>
						<li><a href="<?php echo base_url( 'admin/categories'); ?>">Categories</a></li>
					</ul>
				</li>
				<!--
				<li class="">
					<a href="#">
						<i class="fa fa-cog"></i>
						<span class="title">Theme Settings</span>
					</a>
				</li>
				-->
			</ul>

			<!-- League Management Menu -->
			<p class="menu-title">League Management</p>
			<ul>
				<li class="<?php echo $this->uri->segment(2) == 'seasons' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-calendar"></i>
						<span class="title">Seasons</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'seasons' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/seasons'); ?>">All Seasons</a></li>
						<li><a href="<?php echo base_url( 'admin/seasons/add'); ?>">Add New</a></li>
					</ul>
				</li>
				<li class="<?php echo $this->uri->segment(2) == 'sessions' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-calendar"></i>
						<span class="title">Sessions</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'sessions' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/sessions'); ?>">All Sessions</a></li>
						<li><a href="<?php echo base_url( 'admin/sessions/add'); ?>">Add New</a></li>
					</ul>
				</li>
				<li class="<?php echo $this->uri->segment(2) == 'divisions' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-trophy"></i>
						<span class="title">Divisions</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'divisions' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/divisions'); ?>">All Divisions</a></li>
						<li><a href="<?php echo base_url( 'admin/divisions/add'); ?>">Add New</a></li>
					</ul>
				</li>
				<li class="<?php echo $this->uri->segment(2) == 'games' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-bullseye"></i>
						<span class="title">Games</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'games' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/games'); ?>">All Games</a></li>
						<li><a href="<?php echo base_url( 'admin/games/add'); ?>">Add New</a></li>
					</ul>
				</li>
				<li class="<?php echo $this->uri->segment(2) == 'teams' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-users"></i>
						<span class="title">Teams</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'teams' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/teams'); ?>">All Teams</a></li>
						<li><a href="<?php echo base_url( 'admin/teams/add'); ?>">Add New</a></li>
					</ul>
				</li>
				<li class="<?php echo $this->uri->segment(2) == 'locations' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-map-marker"></i>
						<span class="title">Locations</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'locations' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/locations'); ?>">All Locations</a></li>
						<li><a href="<?php echo base_url( 'admin/locations/add'); ?>">Add New</a></li>
					</ul>
				</li>
			</ul>

			<!-- User Menu -->
			<p class="menu-title">User Management</p>
			<ul>
				<li class="<?php echo $this->uri->segment(2) == 'users' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-users"></i>
						<span class="title">Users</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'users' ? 'open' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/users'); ?>">All Users</a></li>
						<li><a href="<?php echo base_url( 'admin/users/add'); ?>">Add New</a></li>
					</ul>
				</li>
			</ul>

		</div>
	</div>

	<!-- BEGIN SCROLL UP HOVER -->
	<a href="#" class="scrollup">Scroll</a>
	<!-- END SCROLL UP HOVER -->

	<!-- END SIDEBAR -->