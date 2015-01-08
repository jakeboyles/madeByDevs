<?php if(!empty($projects)): ?>
<?php foreach($projects as $project): ?>

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
			
		<div class="col-md-4 project">
		<div class="projectContainer">
		<a href="<?php echo base_url('projects/view').'/'.$project['id']; ?>">
		<img src="<?php echo base_url('uploads').'/'.$main ?>">
		</a>

			<div class="row">
				<div class="col-md-8">
					<p><?php echo $project['name']; ?></p>
				</div>
				<div class="col-md-4">
				<P class="pull-right"><?php echo date("m/d",strtotime($project['date_posted'])); ?></P>
				</div>
			</div>

			<P><?php echo word_limiter($project['description'], 20); ?></P>

					<P class="pull-left tech"><?php echo $project['technology']; ?></P>
					<span class="pull-right comments"><i class="fa fa-comments"></i> 0</span>
			</div>
		</div>

<?php endforeach; ?>	
<?php else: ?>
<p class="col-md-12">Sorry there are no projects for this type.</p>
<?php endif; ?>	