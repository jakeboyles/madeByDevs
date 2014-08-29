<?php
class Location_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	//public $before_dropdown = array( 'order_by(name)' );

	// Get Records
	public function get_records( $parent_id = FALSE, $atts = FALSE )
	{
		// Construct Query
		$this->db->select( 'l.id, l.name, l.phone, l.website, l.street_address, l.street_address_2, l.city, l.state, l.postal, l.map_latitude, l.map_longitude, l.map_zoom, l.description, l.created_at, l.modified_at' );

		// If Parent ID is Set, Fetch Locations By this Parent ID
		if( $parent_id )
		{
			$this->db->where( 'parent_id', $parent_id );
		}
		else
		{
			$this->db->where( 'parent_id', NULL );
		}

		// Check for Custom Where
		if( !empty( $atts['where'] ) )
		{
			$this->db->where( $atts['where'] );
		}

		// Order By Name ASC
		$this->db->order_by( 'l.name', 'ASC' );

		// Run Query
		$query = $this->db->get( 'locations l' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			// Return a Single Row
			if( !empty( $atts['single'] ) )
			{
				$row = $query->row_array();
				return $row;
			}
			// Return All Rows
			else
			{
				$rows = $query->result_array();
				return $rows;
			}
		}

		return false;
	}

	// Add Record
	public function insert_record( $post = FALSE )
	{
		if( $post )
		{
			// Insert Data
			$data = array(
				'name' => $post['name'],
				'phone' => empty( $post['phone'] ) ? NULL : $post['phone'],
				'website' => empty( $post['website'] ) ? NULL : $post['website'],
				'street_address' => empty( $post['street_address'] ) ? NULL : $post['street_address'],
				'street_address_2' => empty( $post['street_address_2'] ) ? NULL : $post['street_address_2'],
				'city' => empty( $post['city'] ) ? NULL : $post['city'],
				'state' => empty( $post['state'] ) ? NULL : $post['state'],
				'postal' => empty( $post['postal'] ) ? NULL : $post['postal'],
				'map_latitude' => empty( $post['map_latitude'] ) ? NULL : $post['map_latitude'],
				'map_longitude' => empty( $post['map_longitude'] ) ? NULL : $post['map_longitude'],
				'map_zoom' => empty( $post['map_zoom'] ) ? NULL : $post['map_zoom'],
				'description' => empty( $post['description'] ) ? NULL : $post['description']
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			return $insert_id;
		}

		return false;
	}

	// Edit Record
	public function update_record( $id = FALSE, $post = FALSE )
	{
		if( $id && $post )
		{
			// Update Data
			$data = array(
				'name' => $post['name'],
				'phone' => empty( $post['phone'] ) ? NULL : $post['phone'],
				'website' => empty( $post['website'] ) ? NULL : $post['website'],
				'street_address' => empty( $post['street_address'] ) ? NULL : $post['street_address'],
				'street_address_2' => empty( $post['street_address_2'] ) ? NULL : $post['street_address_2'],
				'city' => empty( $post['city'] ) ? NULL : $post['city'],
				'state' => empty( $post['state'] ) ? NULL : $post['state'],
				'postal' => empty( $post['postal'] ) ? NULL : $post['postal'],
				'map_latitude' => empty( $post['map_latitude'] ) ? NULL : $post['map_latitude'],
				'map_longitude' => empty( $post['map_longitude'] ) ? NULL : $post['map_longitude'],
				'map_zoom' => empty( $post['map_zoom'] ) ? NULL : $post['map_zoom'],
				'description' => empty( $post['description'] ) ? NULL : $post['description']
			);

			// Update Record in Database
			$this->update( $id, $data );

			return true;
		}

		return false;
	}

	// Delete record
	public function delete_record( $id = FALSE )
	{
		// If an ID Was Found in URL
		if( $id )
		{
			// If this ID Belongs to Other Tables - Dont Delete It
			// @ return: Return a string of error for ajax
			if( 
				$this->count_by( array( 'table' => 'games', 'where' => 'location_id = ' . $id ) ) > 0 
			)
			{
				echo 'error';
			}
			// Else Delete Location From DB including fields
			else
			{
				// See if this Location had a Parent ID
				$location = $this->Location_model->get( $id );

				// Delete Children (locations fields) of this Location
				if( $location['parent_id'] == NULL )
				{
					$this->Location_model->delete_by( array( 'parent_id' => $id ) );
				}

				// Delete This Location
				$this->Location_model->delete( $id );
			}
		}

		return false;
	}

	// Get a Single Location Field
	public function get_field( $id = FALSE, $atts = FALSE )
	{
		if( $id )
		{
			// Construct Query
			$this->db->select( 'l.id, l.parent_id, l.name, l.map_latitude, l.map_longitude, l.map_zoom, l.created_at, l.modified_at' );

			// Set Where
			$this->db->where( 'id', $id );

			// Check for Custom Where
			if( !empty( $atts['where'] ) )
			{
				$this->db->where( $atts['where'] );
			}

			// Run Query
			$query = $this->db->get( 'locations l' );

			// If Rows Were Found, Return Them
			if($query->num_rows > 0)
			{
				$row = $query->row_array();
				return $row;
			}
		}

		return false;
	}

	// Insert a Field for this Location
	public function insert_location_field( $post = FALSE )
	{
		if( $post )
		{
			// Insert Data
			$data = array(
				'name' => $post['name'],
				'parent_id' => $post['parent_id'],
				'map_latitude' => empty( $post['map_latitude'] ) ? NULL : $post['map_latitude'],
				'map_longitude' => empty( $post['map_longitude'] ) ? NULL : $post['map_longitude'],
				'map_zoom' => empty( $post['map_zoom'] ) ? NULL : $post['map_zoom'],
				'description' => empty( $post['description'] ) ? NULL : $post['description'],
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			// Construct Data Array for JSON via AJAX
			$data_array = array(
				'result' => 'success',
				'insert_id' => $insert_id,
				'row' => array(
					$insert_id, 
					$post['name'], 
					$post['map_latitude'], 
					$post['map_longitude'], 
					$post['map_zoom'], 
					date('m/d/Y', time() ), 
					date('m/d/Y', time() ), 
					'<a href="#" class="btn active btn-primary" data-ajax-url="' . base_url( 'admin/locations/edit_field/' . $insert_id ) . '" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="' . $insert_id . '"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn active btn-danger" data-ajax-url="' . base_url( 'admin/locations/delete/' . $insert_id ) . '" data-toggle="modal" data-target="#delete-modal" data-label="' . $post['name'] . '" data-row-id="' . $insert_id . '"><i class="fa fa-times"></i></a>',
					$post['description'],
				)
			);

			// Return Data Array
			return $data_array;
		}

		return false;
	}

	// Edit Record
	public function update_location_field( $id = FALSE, $post = FALSE )
	{
		if( $id && $post )
		{
			// Update Data
			$data = array(
				'name' => $post['name'],
				'map_latitude' => empty( $post['map_latitude'] ) ? NULL : $post['map_latitude'],
				'map_longitude' => empty( $post['map_longitude'] ) ? NULL : $post['map_longitude'],
				'map_zoom' => empty( $post['map_zoom'] ) ? NULL : $post['map_zoom'],
				'description' => empty( $post['description'] ) ? NULL : $post['description'],
			);

			// Update Record in Database
			$this->update( $id, $data );

			// Construct Data Array for JSON via AJAX
			$data_array = array(
				'result' => 'success',
				'update_id' => $id,
				'row' => array(
					$id, 
					$post['name'], 
					$post['map_latitude'], 
					$post['map_longitude'], 
					$post['map_zoom'], 
					date('m/d/Y', strtotime( $post['created_at'] ) ),
					date('m/d/Y', time() ), 
					'<a href="#" class="btn active btn-primary" data-ajax-url="' . base_url( 'admin/locations/edit_field/' . $id ) . '" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="' . $id . '"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn active btn-danger" data-ajax-url="' . base_url( 'admin/locations/delete/' . $id ) . '" data-toggle="modal" data-target="#delete-modal" data-label="' . $post['name'] . '" data-row-id="' . $id . '"><i class="fa fa-times"></i></a>',
					$post['description'],
				)
			);
			
			// Return Data Array
			return $data_array;
		}

		return false;
	}



		// Get Divisions in session
	public function get_location_fields( $id = FALSE )
	{

		$this->db->select( 'l.name,l.id' );
		$this->db->where( 'parent_id' , $id );
		$query= $this->db->get('locations l');

		$fields = array();

		$rows = $query->result_array();


		if( $rows )
		{
			foreach($rows as $row) 
			{
				$fields[$row['id']] = $row["name"];
			}

			return $fields;

		}
		return false;
	}

}