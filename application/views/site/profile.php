<div id="content" class="col-md-10 col-md-push-2">

		<div class="row m-t-40">

			<div class="col-md-11 col-sm-8 col-xs-8">

				<div class="col-md-4 profilePicture">
				<?php echo profile_image($user['profile_pic']); ?>
				</div>

				<div class="col-md-4">
				<h3><i class="fa fa-user"></i> <?php echo $user['display_name']; ?></h3>
				<?php if(!empty($user['email'])): ?>
					<h5><i class="fa fa-envelope"></i>  <?php echo $user['email']; ?></h5>
				<?php endif; ?>
				<?php if($this->site_data>0): ?>
					<h5><a data-toggle="modal" data-target=".questionModal" href=""><i class="fa fa-exclamation-circle text-danger"></i> You Have <?php echo $this->site_data; ?> Notifications</a><h5>
				<?php endif; ?>
				</div>

				<div class="col-md-4">
					<div class="row">
						<div class="col-xs-6 count">
						<?php if($comments!=false): ?>
						<h2><?php echo count($comments); ?></h2>
						<?php else: ?>
						<h2>0</h2>
						<?php endif; ?>
						<h3>Comments</h3>
						</div>

						<div class="col-xs-6 count">
						<?php if($projects!=false): ?>
						<h2><?php echo count($projects); ?></h2>
						<?php else: ?>
						<h2>0</h2>
						<?php endif; ?>
						<h3>Projects</h3>
						</div>
					</div>
				</div>


			</div>


			<div class="col-md-11 p-t-30">

			<div class="col-md-6">

			<H2 class="p-b-30"><i class="fa fa-code"></i> Projects</H2>

			<?php if(!empty($projects)): ?>
				<?php foreach($projects as $project): 
					if(!empty($project['project']['pictures'])) :
					 $picture = json_decode($project['project']['pictures']);
					 endif; 
					 ?>

					<div class="row p-b-30">
					<div class="col-md-3">
					<?php if(!empty($picture[0]->image)) : ?>
						<a href="<?php echo base_url('projects/view').'/'.$project['project']['id']; ?>">
							<?php echo project_image($picture[0]->image); ?>
						</a>
					<?php endif; ?>
					</div>

					<div class="col-md-9">
						<h4><a href="<?php echo base_url('projects/view').'/'.$project['project']['id']; ?>"><?php echo $project['project']['title']; ?></a></h4>
						<P><?php echo word_limiter($project['project']['description'], 20); ?></P>
					</div>
					</div>


				<?php endforeach; ?>
			<?php else: ?>
				<p>This user has not posted any projects yet.</p>
			<?php endif; ?>

			</div>


			<div class="col-md-5 col-md-offset-1">

			<H2 class="p-b-30"><i class="fa fa-comment"></i> Comments</H2>
			<?php if(!empty($comments)): ?>
			<?php foreach($comments as $project): ?>

				 <div class="row">
				<!-- <div class="col-md-3">
					<img src="/uploads/<?php echo $picture[0]->image ?>">
				</div> -->

				<div class="col-md-9 comment">
					<P><?php echo $project['comment']; ?><br>
					<span class="on">on <a href="<?php echo base_url('projects/view/')."/".$project['project_id']; ?>"><?php echo $project['project_title']; ?></a></span>
					</P>
				</div>
				</div>


			<?php endforeach; ?>

			<?php else: ?>
				<p>This user has not posted any comments yet.</p>
			<?php endif; ?>

			</div>



			</div>
	</div>

</div>


<div class="modal questionModal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Notifications</h4>
      </div>
      <div class="modal-body clearfix">
        <form id="commentForm" enctype="multipart/form-data">
        	<div class="form-group col-md-12">
				<?php foreach($notifications as $notification): ?>
					<h3><a href="<?php echo base_url('projects/view/').'/'.$notification['notification_id'].'#questions'; ?>">You have a new <?php echo $notification['name'];?> to be answered.</a></h3>
				<?php endforeach; ?>
			</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="leaveComment" data-ajax-url="<?php echo base_url() ?>admin/projects/addComment/<?php echo $project['id']; ?>" class="btn btn-primary">Comment</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

