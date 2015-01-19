	<div class="sidebar col-md-2">
	<a href="<?php echo base_url('/'); ?>"><img class="logo" src="<?php echo base_url('assets/site/assets/img/logo.png'); ?>"></a>

	<ul>
		<li class="menu"><a href="#">
		<svg width="50" height="50">
			<g class="bars"> 
                <rect class="bar" fill="#F2F2F2" sketch:type="MSShapeGroup" x="12" y="24" width="30" height="4"></rect>
                <rect class="bar" fill="#F2F2F2" sketch:type="MSShapeGroup" x="12" y="16" width="30" height="4"></rect>
                <rect class="bar" fill="#F2F2F2" sketch:type="MSShapeGroup" x="12" y="8" width="30" height="4"></rect>
            </g>
        </svg>
		</a></li>
		<li><a href="<?php echo base_url('projects');?>"><i class="fa fa-code"></i><br> <span>Projects</span></a></li>
		<li><a href="<?php echo base_url('leaders');?>"><i class="fa fa-trophy"></i><br> <span>Rankings</span></a></li>
		<?php if($this->session->userdata('email')): ?>
		<li><a href="<?php echo base_url('/users/profile/'.$this->session->userdata('user_id'));?>"><i class="fa fa-user"></i> <br> <span>Your Profile</span></a></li>
		<?php endif; ?>
	</ul>

	<div class="showMenu">
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