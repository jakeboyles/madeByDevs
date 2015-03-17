<?php if(!empty($projects)): ?>
<?php foreach($projects as $project): ?>
		<?php 
			$pics = $project['project']['pictures'];
			$pics = json_decode($pics);
			$main = '';
			if(is_array($pics)) {
				foreach($pics as $pic)
				{
					$main  =  $pic->image;
				}
			}
			?> 
			
		<div class="col-md-4 project">
		<div class="projectContainer">
		<a href="<?php echo base_url('projects/view').'/'.$project['project']['id']; ?>">
		<?php echo project_image($main); ?>
		</a>

			<div class="row">
				<div class="col-md-8">
					<p><a href="<?php echo base_url('users/profile').'/'.$project['project']['author_id']; ?>"><?php echo $project['project']['name']; ?></a></p>
				</div>
				<div class="col-md-4">
				<P class="pull-right"><?php echo date("m/d",strtotime($project['project']['date_posted'])); ?></P>
				</div>
			</div>

			<P><?php echo word_limiter($project['project']['description'], 20); ?></P>

					<P class="pull-left tech"><?php echo $project['project']['technology']; ?></P>
					<span class="pull-right comments"><i class="fa fa-comments"></i> <?php echo $project['comments']; ?></span>
					<span class="pull-right questions"><i class="fa fa-question"></i> <?php echo $project['questions']; ?></span>
			</div>
		</div>

<?php endforeach; ?>	
<?php else: ?>
<p class="col-md-12">Sorry there are no projects for this type.</p>
<?php endif; ?>	