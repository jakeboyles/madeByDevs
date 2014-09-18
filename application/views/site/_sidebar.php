<?php
$ci =&get_instance();
$ci->load->model( 'Post_model' );
$ci->load->model( 'League_model' );
$latest_posts = $ci->Post_model->fetch_posts('3');

$weather = $ci->League_model->get_weather('45056');

?>

<div class="col-md-pull-8 col-xs-12 col-md-4">

	<!-- BEGIN Latest News Widget -->
	<?php if(!empty($latest_posts)): ?>
		<h2 class="newsTitle">Latest News</h2>

		<ul class="newsLinks">
			<?php foreach( $latest_posts as $item ): ?>
			<li><a href="<?php echo base_url( $item['slug'] ); ?>"><span><?php echo $item['title']; ?></span><i class="fa fa-chevron-right"></i></a></li>
			<?php endforeach; ?>
			<li><a href="<?php echo base_url('cms/blog'); ?>">View All News</a></li>
		</ul>
	<?php endif; ?>
	<!-- END Latest News Widget -->
	<!-- Ad Widget -->
	<?php if(!empty($weather['current_observation'])): ?>
	<div class="weather">
		<div class="row">
			<div class="col-xs-12">
				<h3>Current Weather</h3>
				<span class="date"><?php echo date('m/d h:m a', $weather['current_observation']['observation_epoch']); ?></span>
			</div>
		<div class="col-xs-12 col-md-5">
			<span class='city'><?php echo $weather['current_observation']['display_location']['full']; ?></span><br>
			<span class='condition'><?php echo $weather['current_observation']['weather']; ?></span>
		</div>
		<div class="col-xs-12 col-md-3">
			<img src='http://icons.wxug.com/i/c/k/<?php echo $weather['current_observation']['icon']; ?>.gif' >
		</div>
		<div class="col-xs-12 col-md-4">
			<span class='temp'><?php echo $weather['current_observation']['temp_f']; ?> F&deg;</span><br>
			<span class='wind'><?php echo $weather['current_observation']['wind_mph']; ?> MPH /</span>
			<span class='direction'><?php echo $weather['current_observation']['wind_dir']; ?></span>
		</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- Ad Widget -->
	<img src="http://placehold.it/750x450/ff69b4/ffffff&text=Display+Ad" />

</div><!-- end .col-md-pull-8 col-md-4 -->