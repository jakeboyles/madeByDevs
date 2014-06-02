<?php
class Location_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	public $before_dropdown = array( 'order_by(name)' );

	// Get Records
	public function get_records( )
	{
		// Construct Query
		$this->db->select( 's.id, s.name, s.year_start, s.year_end, s.created_at, s.modified_at, l.name as league_name' );
		$this->db->join( 'leagues l', 'l.id = s.league_id', 'left outer' );

		// Run Query
		$query = $this->db->get( 'seasons s' );

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
				$this->count_by( 'season_id', $id, 'sessions' ) > 0 
				|| $this->count_by( 'current_season_id', $id, 'leagues' ) > 0
			)
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				$this->Season_model->delete( $id );
			}
		}

		return false;
	}

}