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

		
			


			<!-- League Management Menu -->
			<p class="menu-title">League Management</p>
			<ul>

				<li class="<?php echo $this->uri->segment(2) == 'league' ? 'active open' : ''; ?>">
					<a href="javascript:;">
						<i class="fa fa-home"></i>
						<span class="title">LHome</span>
						<span class="arrow <?php echo $this->uri->segment(2) == 'home' ? '' : ''; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url( 'admin/'); ?>">All Leagues</a></li>
					</ul>
				</li>
				
			</ul>



		</div>
	</div>

	<!-- BEGIN SCROLL UP HOVER -->
	<a href="#" class="scrollup">Scroll</a>
	<!-- END SCROLL UP HOVER -->

	<!-- END SIDEBAR -->