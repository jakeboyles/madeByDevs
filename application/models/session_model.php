<?php
class Session_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	public $before_dropdown = array( 'order_by(name)' );
	public $after_update = array( 'update_divisions' );

	// Get Records
	public function get_records( )
	{
		// Construct Query
		$this->db->select( 's.id, s.name, s.created_at, s.modified_at, seasons.name as season_name' );
		$this->db->join( 'seasons', 'seasons.id = s.season_id', 'left outer' );

		// Run Query
		$query = $this->db->get( 'sessions s' );

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
				'season_id' => $post['season_id']
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
				'season_id' => $post['season_id']
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

	// Update Divisions
	public function update_divisions()
	{
		// Set Session ID
		$session_id = $this->uri->segment(4);

		// Remove Old Session/Division Relationships
		$this->db->where( 'session_id', $session_id );
		$this->db->delete( 'session_divisions' );

		// Add Current Session/Division Relationships
		if( !empty( $this->input->post('divisions') ) )
		{	
			foreach( $this->input->post('divisions') as $division )
			{
				$data = array(  
					'session_id' => $session_id,
					'division_id' => $division
				);
				$this->insert( $data, FALSE, 'session_divisions' );
			}
		}
	}

}