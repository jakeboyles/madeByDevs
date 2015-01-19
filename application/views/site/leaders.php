<div class="content col-md-10 allProjects">

<div class="col-md-12 p-b-30">
		<h2>Leaderboard</h2>

</div>

	<?php foreach($techs as $tech): ?>

		<div class='projects col-md-4'>
		<h3 class="col-md-12"><?php echo $tech['name'];?></h3>
		<?php if(!empty($tech['leaders'])): ?>
		<?php foreach($tech['leaders'] as $no): ?>
			<div class="pull-left col-md-12 leader">
			<div class="row">
				<div class="col-md-2">
					<?php echo profile_image($no['profile_pic']); ?>
				</div>
				<div class="col-md-10">
					<h4><?php echo $no['display_name']; ?></h4>
					<p><i class="fa fa-thumbs-up"></i> <?php echo $no['votes']; ?></p>
				</div>

			</div>
			</div>

		<?php endforeach; ?>
	<?php else: ?>
		<P class="col-md-12">There are currently no leaders</P>
	<?php endif; ?>
		</div>

	<?php endforeach; ?>





</div>


