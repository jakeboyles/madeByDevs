<?php
$ci =&get_instance();
$ci->load->model( 'Content_model' );
$atts = array( 'limit' => 3, 'where' => 'p.post_type = \'post\'' );
$latest_posts = $ci->Content_model->get_posts( $atts );
?>

<div class="col-md-pull-8 col-md-4">

	<!-- BEGIN Latest News Widget -->
	<h2 class="newsTitle">Latest News</h2>
	<ul class="newsLinks">
		<?php foreach( $latest_posts as $item ): ?>
		<li><a href="<?php echo base_url( $item['slug'] ); ?>"><span><?php echo $item['title']; ?></span><i class="fa fa-chevron-right"></i></a></li>
		<?php endforeach; ?>
		<li><a href="#">View All News</a></li>
	</ul>
	<!-- END Latest News Widget -->

	<!-- Ad Widget -->
	<img src="http://placehold.it/750x350&text=Weather+Ad" /><br/></br/>

	<!-- Ad Widget -->
	<img src="http://placehold.it/750x450/ff69b4/ffffff&text=Display+Ad" />

</div><!-- end .col-md-pull-8 col-md-4 -->