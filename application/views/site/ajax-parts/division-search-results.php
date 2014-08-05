<?php $division_count = count( $divisions ); ?>

<p><?php echo $division_count; ?> <?php echo $division_count == 1 ? 'Result' : 'Results'; ?></p>
<ul class="list-grey-alternating">
	<?php foreach( $divisions as $division ): ?>
	<li>
		<a href="<?php echo base_url('divisions/history/'. $division['id']); ?>"><?php echo $division['name']; ?> <i class="fa fa-chevron-right"></i></a>
	</li>
	<?php endforeach; ?>
</ul>