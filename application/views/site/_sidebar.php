<?php
$ci =&get_instance();
$ci->load->model( 'Post_model' );
$ci->load->model( 'League_model' );
$latest_posts = $ci->Post_model->fetch_posts('3','0','post');

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
	<?php if(!empty($weather['name'])): ?>
	<div class="weather">
		<div class="row">
			<div class="col-xs-12">
				<h3>Current Weather</h3>
				<span class="date"><?php echo date('m/d h:m a', time()); ?></span>
			</div>
		<div class="col-xs-12 col-xs-5">
			<span class='city'><?php echo $weather['name']; ?></span>
			<span class='condition'><?php echo $weather['weather'][0]['main']; ?></span>
		</div>
		<div class="col-xs-12 col-xs-3">
			<i class='wi <?php echo weatherIcon($weather['weather'][0]['icon']); ?>'></i>
		</div>
		<div class="col-xs-12 col-xs-4">
			<span class='temp'>
				<?php
				 $temp = ($weather['main']['temp'] - 273.15)* 1.8000+ 32.00 ; 
				 echo number_format((float)$temp, 1, '.', '');
				 ?> F&deg;</span>
			<span class='wind'><?php echo $weather['wind']['speed']; ?> MPH </span>
		</div>
		</div>
	</div>
	<?php endif; ?>


	<!-- Ad Widget -->
	<!-- <img src="http://placehold.it/750x450/ff69b4/ffffff&text=Display+Ad" /> -->

</div><!-- end .col-md-pull-8 col-md-4 -->

<?php 
	function weatherIcon($id)
	{
		if($id == '01d' || $id == '01n')
		{
			return 'wi-day-sunny';
		}
		elseif($id == '02d' || $id == '02n')
		{
			return 'wi-day-sunny-overcast';
		}
		elseif($id == '03d' || $id == '03n')
		{
			return 'wi-day-sunny-overcast';
		}
		elseif($id == '04d' || $id == '04n')
		{
			return 'wi-day-cloudy-gusts';
		}
		elseif($id == '09d' || $id == '09n')
		{
			return 'wi-day-showers';
		}
		elseif($id == '10d' || $id == '10n')
		{
			return 'wi-day-rain';
		}
		elseif($id == '11d' || $id == '11n')
		{
			return 'wi-day-thunderstorm';
		}
		elseif($id == '13d' || $id == '13n')
		{
			return 'wi-day-snow';
		}
		elseif($id == '50d' || $id == '50n')
		{
			return 'wi-fog';
		}
	}
?>