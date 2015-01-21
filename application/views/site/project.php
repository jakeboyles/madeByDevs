<div class="content col-md-10 singleProject">


		<?php 
			$pics = $project['pictures'];
			$pics = json_decode($pics);
			$main = '';
			if(is_array($pics)) {
				foreach($pics as $pic)
				{
					$main  =  $pic->image;
				}
			}
			?> 
			
		<div class="col-md-12">
			<div class="projectContainer">

				<div class="col-md-12">
					<h2><?php echo $project['title']; ?></h2>
				</div>

				<div class="col-md-4">
					<a class="author" href="<?php echo base_url('users/profile').'/'.$project['author_id']; ?>"><p><i class="fa fa-user"></i>  <?php echo $project['name']; ?></p></a>
				</div>

				<div class="col-md-4">
						<P><i class="fa fa-calendar"></i> <span class="moment"><?php echo date("Y-m-d H:i:s",strtotime($project['date_posted'])); ?></span></P>
				</div>

				<div class="col-md-4">
						<P><i class="fa fa-anchor"></i> <?php echo $project['github'] ?></P>
				</div>

				<div class="col-md-12">

					<a href="<?php echo base_url('projects/view').'/'.$project['id']; ?>">
						<img class="" src="<?php echo base_url('uploads').'/'.$main ?>">
					</a>

				</div>

				<p class="contentText"><?php echo $project['description']; ?></p>

			</div>
		</div>



		<?php if($this->session->userdata('email')): ?>
		<div class="col-md-12">
			<?php echo form_open_multipart( 'admin/projects/addComment/'.$project['id'], array( 'id' => 'register') ); ?>

			<h2>Add Comment</h2>

				<div class="form-group col-xs-6 col-xs-offset-3">
					<?php echo form_label( 'Comment', 'logo', array( 'class' => 'form-label' ) ); ?>
					<?php echo form_textarea( array('name' => 'comment', 'class' => 'form-control', 'id' => 'comment', 'value' => set_value('description') ) ); ?>
				</div>

				<div class="col-md-6 col-md-offset-3">
				<button type="submit" class="btn btn-primary pull-left">Submit</button>
				</div>

			<?php echo form_close(); ?>
		</div>
	<?php endif; ?>
			<div class="col-md-12 comments">
			<h2>Comments</h2>

			<?php if(!empty($comments)): ?>
			<?php foreach($comments as $comment): ?>
				<div class="comment row">
					<div class="col-md-2">
						<?php echo profile_image($comment['profile_pic']); ?>
					</div>

					<div class="col-md-10">
						<h3><?php echo $comment['display_name']; ?></h3>
						<p><?php echo $comment['comment']; ?></p>

						<span><i data-tech="<?php echo $project['techid']; ?>" data-user="<?php echo $comment['user_id']; ?>" data-id='<?php echo $comment['id']; ?>' class="fa fa-thumbs-up"></i></span>
						<span  class="p-l-15"><i data-tech="<?php echo $project['techid']; ?>" data-user="<?php echo $comment['user_id']; ?>" data-id='<?php echo $comment['id']; ?>' class="fa fa-thumbs-down"></i></span>
						 <span data-votes="<?php echo $comment['votes']; ?>" class="numVotes p-l-15"><?php echo $comment['votes']; ?></span> Votes
	<!-- 					<?php echo $comment['created_at']; ?>
	 -->			</div>
				</div>
			<?php endforeach; ?>
			<?php else: ?>
				<P>There are no comments right now, how about adding one?</P>
			<?php endif;?>
			</div>
		</div>
</div>




