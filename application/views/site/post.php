<div id="content" class="post col-md-8 col-md-push-4">
	<h1 class="title col-xs-8"><?php echo $page['title']; ?></h1>
	<p class="date col-xs-4">Posted: <?php echo Date('m/d/y',strtotime($page['created_at'])); ?></p>
	<div class="col-xs-12">
		<?php echo nl2br( $page['content'] ); ?>
	</div>
</div>