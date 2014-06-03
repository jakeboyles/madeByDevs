<?php
class Location_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	public $before_dropdown = array( 'order_by(name)' );

	// Get Records
	public function get_records( $parent_id )
	{
		// Construct Query
		$this->db->select( 'l.id, l.name, l.phone, l.website, l.street_address, l.street_address_2, l.city, l.state, l.postal, l.map_latitude, l.map_longitude, l.map_zoom, l.created_at, l.modified_at' );

		// If Parent ID is Set, Fetch Locations By this Parent ID
		if( $parent_id )
		{
			$this->db->where( 'parent_id', $parent_id );
		}
		else
		{
			$this->db->where( 'parent_id', NULL );
		}

		// Run Query
		$query = $this->db->get( 'locations l' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
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
				$this->count_by( 'location_id', $id, 'games' ) > 0 
			)
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				$this->Location_model->delete( $id );
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
				'map_zoom' => empty( $post['map_zoom'] ) ? NULL : $post['map_zoom']
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			// Construct Data Array
			$data_array = array(
				'result' => 'success',
				'row' => array(
					$insert_id, 
					$post['name'], 
					$post['map_latitude'], 
					$post['map_longitude'], 
					$post['map_zoom'], 
					date('m/d/Y', time() ), 
					date('m/d/Y', time() ), 
					'<a href="#" class="btn active btn-primary"><i class="fa fa-edit"></i></a> 
					<a href="#" class="btn active btn-danger" data-ajax-url="' . base_url('admin/fields/delete/' . $insert_id) . '" data-toggle="modal" data-target="#delete-modal" data-label="" data-row-id="' . $insert_id . '"><i class="fa fa-times"></i></a>'
				)
			);

			// Return JSON
			return $data_array;
		}

		return false;
	}

}