<?php
class User_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_records( )
	{
		// Construct Query
		$this->db->select('
			u.id, u.email, u.user_type_id, u.profile_picture, u.first_name, u.last_name, u.gender, u.postal, u.birthday, u.last_login, u.created_at, u.created_by, u.modified_at, u.modified_by,
			ut.type as user_type
		');
		$this->db->join( 'user_types ut', 'ut.id = u.user_type_id', 'left outer' );

		// Run Query
		$query = $this->db->get( 'users u' );

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
				'league_id' => 1,
				'name' => $post['name'],
				'division_type_id' => empty( $post['division_type'] ) ? NULL : $post['division_type']
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
				'division_type_id' => empty( $post['division_type'] ) ? NULL : $post['division_type']
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
			if( $this->count_by( 'division_id', $id, 'seasons' ) > 0 )
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				$this->Division_model->delete( $id );
			}
		}

		return false;
	}

}