<?php $location_count = count( $locations ); ?>

<p><?php echo $location_count; ?> <?php echo $location_count == 1 ? 'Result' : 'Results'; ?></p>
<ul class="list-grey-alternating">
	<?php foreach( $locations as $location ): ?>
	<li>
		<a href="<?php echo base_url('directions/location/'. $location['id']); ?>"><?php echo $location['name']; ?> <i class="fa fa-chevron-right"></i></a>
	</li>
	<?php endforeach; ?>
</ul>