<?php
class Session_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	//public $after_create = array( 'update_divisions' );
	public $before_update = array( 'modified_by' );
	//public $after_update = array( 'update_divisions' );
	public $return_type = 'array';
	//public $before_dropdown = array( 'order_by(name)' );

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

			// Assign Terms ( divisions )
			$this->_update_divisions( $insert_id );

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

			// Assign Terms ( divisions )
			$this->_update_divisions( $id );

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
				$this->count_by( array( 'table' => 'games', 'where' => 'session_id = ' . $id ) ) > 0
			)
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				// Remove Session/Division Relationships
				$this->db->where( 'session_id', $id );
				$this->db->delete( 'session_divisions' );

				// Remove Session
				$this->Session_model->delete( $id );
			}
		}

		return false;
	}

	// Select Divisions Assigned to this Session
	public function select_divisions( $id )
	{
		if( $id )
		{
			$this->db->select('sd.division_id, d.name');
			$this->db->join('divisions d','d.id = sd.division_id', 'left outer');
			$this->db->where( 'sd.session_id', $id );
			$query = $this->db->get( 'session_divisions sd' );

			if( $query->num_rows > 0 )
			{
				$divisions = array();
				foreach( $query->result_array() as $division )
				{
					$divisions[ $division['division_id'] ] = $division['name'];
				}

				return $divisions;
			}
		}
		
		return false;
	}

	// Assign Divisions to an Individual Session
	private function _update_divisions( $id = FALSE )
	{
		if( $id )
		{
			// Remove Old Session/Division Relationships
			$this->db->where( 'session_id', $id );
			$this->db->delete( 'session_divisions' );

			// Add Current Session/Division Relationships
			if( !empty( $this->input->post('divisions') ) )
			{	
				foreach( $this->input->post('divisions') as $division )
				{
					$data = array(  
						'session_id' => $id,
						'division_id' => $division
					);
					$this->insert( $data, FALSE, 'session_divisions' );
				}
			}
		}

		return false;	
	}

	// Get a list of divisions this Session has a relationship with
	public function get_related_divisions( $id = FALSE )
	{
		// For Edit A Session
		if( $id )
		{
			// If Form Was Submitted, Use Selected Divisions
			if( !empty( $this->input->post('divisions') ) )
			{
				$related_divisions = $this->input->post('divisions');
			}
			// Else Load the related divisions from the database
			else
			{
				$related_divisions = $this->select_divisions( $id );
			}
		}
		// For Add a Session
		else
		{
			// If Form Was Submitted, Use Selected Divisions
			if( !empty( $this->input->post('divisions') ) )
			{
				$related_divisions = $this->input->post('divisions');
			}
		}

		// If Related Divisions Are Set, Return Them
		if( !empty( $related_divisions ) )
		{
			return $related_divisions;
		}

		// Else Return False
		return false;
	}
}