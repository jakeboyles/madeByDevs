<?php $team_count = count( $teams ); ?>

<p><?php echo $team_count; ?> <?php echo $team_count == 1 ? 'Result' : 'Results'; ?></p>
<ul class="list-grey-alternating">
	<?php foreach( $teams as $team ): ?>
	<li>
		<a href="<?php echo base_url('teams/page/'. $team['id']); ?>"><?php echo $team['name']; ?> (<?php echo $team['division']; ?>) <i class="fa fa-chevron-right"></i></a>
	</li>
	<?php endforeach; ?>
</ul>