<div class="col-md-8 col-md-push-4">
	<h1><?php echo $category['name']; ?></h1>
	
	<!-- Loop Through the Posts -->
	<?php if( !empty( $posts ) ): ?>

		<?php foreach( $posts as $post ): ?>

			<div class="post-entry">
				<h2 class="post-title">
					<a href="<?php echo base_url( $post['slug'] ); ?>"><?php echo $post['title']; ?></a>
				</h2>
				<div class="post-date">
					<?php echo date('F, d, Y', strtotime( $post['created_at'] ) ); ?>
				</div>
				<div class="post-content">
					<?php echo $post['content']; ?>
				</div>
			</div>

		<?php endforeach; ?>

	<?php else: ?>

		This archive does not currently have any posts.

	<?php endif; ?>
</div>