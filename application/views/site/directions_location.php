

<div id="content" class="col-md-8 col-md-push-4">

	<?php if( !empty( $location ) ): ?>
	<div class="location">

		<!-- Location Name -->
		<h1><?php echo $location['name']; ?></h1>

		<!-- Location Map -->
		<?php if( !empty( $location['map_latitude'] ) && !empty( $location['map_longitude'] ) && !empty( $location['map_zoom'] ) ): ?>
			<?php 
			$map_data = array( 
				'latitude' => $location['map_latitude'], 
				'longitude' => $location['map_longitude'], 
				'zoom' => (int) $location['map_zoom']
			);
			$map_markers = array( array(
				'latitude' => $location['map_latitude'], 
				'longitude' => $location['map_longitude'], 
				'zoom' => (int) $location['map_zoom']
			) );
			?>
			<script type="text/javascript">
			// Create a JavaScript Objects from PHP
			<?php echo "var mapData = " . json_encode( $map_data) . ';'; ?>
			<?php echo "var mapItems = " . json_encode($map_markers) . ';'; ?>

			// Initialize Map
			function initialize() {
				
				// Set Map Options
				var mapOptions = {
					center: new google.maps.LatLng( mapData.latitude, mapData.longitude ),
					zoom: mapData.zoom,
					mapTypeId: google.maps.MapTypeId.HYBRID,
					scrollwheel: false
				};
				
				// Set Map Var and Bind Options
				var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

				// Set Marker and i Variables
				var marker, i;
				
				// Loop Through the Markers and Infoboxes then add Them to the Map
				for ( i = 0; i < mapItems.length; i++ ) {
					// Add Marker
					marker = new google.maps.Marker({
						position: new google.maps.LatLng(mapItems[i].latitude, mapItems[i].longitude),
						map: map,
						//icon: iconBase + 'map-marker-' + mapItems[i].icon  + '.png'
					});
				}
			}
			google.maps.event.addDomListener(window, 'load', initialize);
			</script>
			<div class="hidden-xs" id="map-canvas"></div>

			<div class="visible-xs" id="map-overlay">
				<?php 
					$url_map = urlencode($location['street_address']);
				?>
				<a target="_blank" href="https://www.google.com/maps/place/<?php echo $location['map_latitude']; ?>,<?php echo $location['map_longitude'];?>">Click To Get Directions</a> 
				<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $location['map_latitude']; ?>,<?php echo $location['map_longitude'];?>&zoom=16&size=768x320&maptype=roadmap&markers=color:blue%7Clabel:S%<?php echo $location['map_latitude']; ?>,<?php echo $location['map_longitude']; ?>" class="map_image">
			</div>
		<?php endif; ?>

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