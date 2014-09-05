<div id="content" class="blog col-md-8 col-md-push-4">
	<h1 class='pull-left'>Latest News</h1>
	<div class="top_pagination pull-right">
		<?php echo $links; ?>
	</div>
	<?php if(!empty($blogs)): ?>
		<?php foreach( $blogs as $blog ): ?>
		<div class="col-xs-12 blog_post">
			<h2><a href="<?php echo base_url( $blog['slug'] ); ?>"><?php echo $blog['title']; ?></a></h2>
			<p><?php echo nl2br($blog['content']);?></p>
			<a class="btn btn-primary" href="<?php echo base_url( $blog['slug'] ); ?>">Read More</a>
		</div>
		<?php endforeach; ?>
	<?php endif; ?>

	<div class="pull-right pagination">
		<?php echo $links; ?>
	</div>

</div>