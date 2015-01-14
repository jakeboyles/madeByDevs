<div id="content" class="col-md-10 col-md-push-2">

		<div class="row m-t-40">

			<div class="col-md-11 col-sm-8 col-xs-8">

				<div class="col-md-4">
				<img src="<?php echo $user['profile_pic'];?>">
				</div>

				<div class="col-md-4">
				<h3><i class="fa fa-user"></i> <?php echo $user['display_name']; ?></h3>
				<h5><i class="fa fa-envelope"></i>  <?php echo $user['email']; ?></h5>
				</div>

				<div class="col-md-4">
					<div class="row">
						<div class="col-xs-6 count">
						<h2 class=""><?php echo count($comments); ?></h2>
						<h3>Comments</h3>
						</div>

						<div class="col-xs-6">
						<h2><?php echo count($projects); ?></h2>
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
					if(!empty($project['pictures'])) :
					 $picture = json_decode($project['pictures']);
					 endif; 
					 ?>

					 <div class="row p-b-30">
					<div class="col-md-3">
					<?php if(!empty($project['pictures'])) : ?>
						<img src="/uploads/<?php echo $picture[0]->image ?>">
					<?php endif; ?>
					</div>

					<div class="col-md-9">
						<h4><?php echo $project['title']; ?></h4>
						<P><?php echo word_limiter($project['description'], 20); ?></P>
					</div>
					</div>


				<?php endforeach; ?>
			<?php else: ?>
				<p>This user has not posted any projects yet.</p>
			<?php endif; ?>

			</div>


			<div class="col-md-5 col-md-offset-1">

			<H2 class="p-b-30"><i class="fa fa-comment"></i> Comments</H2>

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

			</div>



			</div>
	</div>

</div>