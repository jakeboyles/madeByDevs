<div class="content col-md-10">
		<div class="image">

		<?php if(!$this->session->userdata('email')): ?>
		<a href="<?php echo base_url('login'); ?>" class="login btn-small" href="#"><i class="fa fa-lock"></i> Login</a>
		<?php else: ?>
		<a href="<?php echo base_url('login/logout'); ?>" class="login btn-small" href="#"><i class="fa fa-lock"></i> Logout</a>
		<?php endif; ?>
			<h2>You Make Cool Stuff.</h2>
			<h3>Why Not Show It Off?</h3>
			<a href="<?php echo base_url('register'); ?>" class="btn btn-primary">Yeah, It's Free</a>
		</div>

		<div class="info">
		<p>You build cool shit. However, no one ever sees it nor aprreciates it. Your a developer. Made by devs gives you the opportunity to show off the cool stuff you have done and have it appreciated by devs just like you!</p>
		</div>

		<div class="moreContent">
		<h3>What We Offer</h3>

		<div class="canYouDo">
			<div class="col-md-4">
			<i class="fa fa-code"></i>
			<p>Create projects and get feedback.</p>
			</div>

			<div class="col-md-4">
			<i class="fa fa-users"></i>
			<p>Engage and meet other developers just like you.</p>
			</div>

			<div class="col-md-4">
			<i class="fa fa-check-square-o"></i>
			<p>Filter projects by languages that interest you.</p>
			</div>

			<div class="col-md-4">
			<i class="fa fa-github"></i>
			<p>Incorporates with GitHub to show off the code that powers your projects or ask for help.</p>
			</div>

			<div class="col-md-4">
			<i class="fa fa-trophy"></i>
			<p>Get rewarded for the help your provide and prove you knowledge!</p>
			</div>


			<div class="col-md-4">
			<i class="fa fa-briefcase"></i>
			<p>Find jobs that interest you in your area and remotely.</p>
			</div>

		</div>
		</div>
	</div>
