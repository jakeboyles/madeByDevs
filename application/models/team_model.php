<?php
class Team_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	//public $before_dropdown = array( 'order_by(email)' );

	// Get Records
	public function get_records( )
	{
		// Construct Query
		$this->db->select( 't.id, t.captain_user_id, t.name, t.description, t.team_logo, t.status, t.created_at, t.modified_at, u.first_name, u.last_name, u.email' );
		$this->db->join( 'users u', 'u.id = t.captain_user_id', 'left outer' );

		// Run Query
		$query = $this->db->get( 'teams t' );

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
				'status' => 'active',
				'name' => $post['name'],
				'captain_user_id' => empty( $post['captain_user_id'] ) ? NULL : $post['captain_user_id'],
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
				'captain_user_id' => empty( $post['captain_user_id'] ) ? NULL : $post['captain_user_id'],
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