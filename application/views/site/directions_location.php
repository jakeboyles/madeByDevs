<div class="col-md-8 col-md-push-4">

	<?php if( !empty( $location ) ): ?>
	<div class="location">

		<!-- Location Name -->
		<h1><?php echo $location['name']; ?></h1>

		<!-- Location Map -->
		<div class="map">map goes here</div>

		<!-- Location Description -->
		<?php if( !empty( $location['description'] ) ): ?>
		<div class="description">
			<h2>Directions</h2>
			<?php echo nl2br( $location['description'] ); ?>
		</div>
		<?php endif; ?>

		<!-- Location Address -->
		<div class="address">
			<h2>Address</h2>
			<?php if( !empty( $location['street_address'] ) ) echo $location['street_address'] . '<br>'; ?>
			<?php if( !empty( $location['street_address_2'] ) ) echo $location['street_address_2'] . '<br>'; ?>
			<?php if( !empty( $location['city'] ) ) echo $location['city'] . ', '; ?>
			<?php if( !empty( $location['state'] ) ) echo $location['state'] . ' '; ?>
			<?php if( !empty( $location['postal'] ) ) echo $location['postal']; ?>
		</div>

		<!-- Location Contact Info -->
		<?php if( !empty( $location['phone'] ) && !empty( $location['website'] ) ): ?>
		<div class="contact">
			<h2>Contact Information</h2>
			<?php if( !empty( $location['phone'] ) ): ?>
				<h3>Phone</h3>
				<?php echo $location['phone']; ?>
			<?php endif; ?>
			<?php if( !empty( $location['website'] ) ): ?>
				<h3>Website</h3>
				<a href="<?php echo $location['website']; ?>" target="_blank"><?php echo $location['name']; ?> Website</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<!-- Location Fields -->
		<?php if( !empty( $fields ) ): ?>
		<div class="fields">
			<h2>Fields</h2>
			<ul class="list-grey-alternating">
				<?php foreach( $fields as $field ): ?>
				<li>
					<a href="<?php echo base_url('directions/field/'. $field['id']); ?>"><?php echo $field['name']; ?> <i class="fa fa-chevron-right"></i></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

	</div>
	<?php else: ?>

		<h1>Location Not Found</h1>
		<p>It appears you have visited a location that does not exists. Please try our <a href="<?php echo base_url('directions'); ?>">directions page</a> to find the location/field you are looking for.</p>

	<?php endif; ?>

</div>