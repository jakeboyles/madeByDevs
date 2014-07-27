<div id="content" class="col-md-8 col-md-push-4">

	<?php if( !empty( $team ) ): ?>
	<div class="team">

		<h1><?php echo $team['name']; ?></h1>

		<!-- Team Photos Section -->
		<?php if( !empty( $photos ) ): ?>
		<div class="photos"></div>
		<?php endif; ?>

		<!-- Team Description -->
		<?php if( !empty( $team['description'] ) ): ?>
		<div class="description">
			<?php echo nl2br( $team['description'] ); ?>
		</div>
		<?php endif; ?>

		<!-- Team Schedule -->
		<?php if( !empty( $schedule ) ): ?>
		<div class="roster">

		</div>
		<?php endif; ?>

		<!-- Team Roster -->
		<?php if( !empty( $roster ) ): ?>
		<div class="roster">

		</div>
		<?php endif; ?>

		<!-- Team History -->
		<!-- To Do: Display team history. Not currently in scope -->


	</div>
	<?php else: ?>

		<h1>Team Not Found</h1>
		<p>It appears you have visited a team page that does not exists. Please try our <a href="<?php echo base_url('teams'); ?>">team search page</a> to find the team you are looking for.</p>
	
	<?php endif; ?>

</div>