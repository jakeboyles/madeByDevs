<?php
class Session_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

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
		// If Post is Submitted Grab Divisions By Post Array
		if( !empty( $this->input->post('divisions') ) )
		{
			// Fetch Divisions
			$this->db->select( 'd.id, d.name' );
			$this->db->where_in( 'd.id', $this->input->post('divisions') );
			$query = $this->db->get( 'divisions d' );

			if($query->num_rows > 0)
			{
				$rows = $query->result_array();

				// Structure Array
				$related_divisions = array();
				foreach( $rows as $row )
				{
					$related_divisions[ $row['id'] ] = $row['name'];
				}
			}
		}
		else
		{
			// For Edit Division
			if( $id )
			{
				$related_divisions = $this->select_divisions( $id );
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

	// Fetch a List of Sessions in the Current Season
	public function get_active_sessions( $current_season_id = FALSE )
	{
		if( $current_season_id )
		{
			$this->db->select( 's.season_id, s.name' );
			$query = $this->db->get( 'sessions s' );

			if( $query->num_rows > 0 )
			{
				$rows = $query->result_array();
				return $rows;
			}
		}

		return false;
	}

	// Fetch a List of Active Sessions By Division ID
	public function get_active_sessions_by_division( $current_season_id = FALSE, $division_id = FALSE )
	{
		if( $current_season_id && $division_id )
		{
			$this->db->select( 'sd.session_id' );
			$this->db->join( 'sessions s', 's.id = sd.session_id', 'left outer' );
			$this->db->join( 'seasons se', 'se.id = s.season_id', 'left outer' );
			$this->db->where( array( 'sd.division_id' => $division_id, 'se.id' => $current_season_id ) );
			$this->db->order_by( 's.created_at', 'ASC' );
			$query = $this->db->get( 'session_divisions sd' );

			if( $query->num_rows > 0 )
			{
				$rows = $query->result_array();

				$session_ids = array();
				foreach( $rows as $row )
				{
					$session_ids[] = $row['session_id'];
				}

				return $session_ids;
			}
		}

		return false;		
	}


	public function get_divisions_by_session( $session_id = FALSE )
	{
		$divisions_by_session = array();
		if( $session_id )
		{
			$this->db->select( 'sd.session_id, sd.division_id, d.name' );
			$this->db->join( 'sessions s', 's.id = sd.session_id', 'left outer' );
			$this->db->join( 'seasons se', 'se.id = s.season_id', 'left outer' );
			$this->db->join( 'divisions d', 'd.id = sd.division_id', 'left outer' );
			$this->db->where( array( 'sd.session_id' => $session_id) );
			$this->db->order_by( 's.created_at', 'ASC' );
			$query = $this->db->get( 'session_divisions sd' );

			if( $query->num_rows > 0 )
			{
				$rows = $query->result_array();

				$session_ids = array();
				foreach( $rows as $row )
				{
					$divisons_by_session[$row['division_id']] = $row['name'];
				}

				return $divisons_by_session;
			}
		}

		return false;
	}



	// Get Records
	public function get_records_checkboxs( )
	{
		// Construct Query
		$this->db->select( 's.id, s.name' );
		$this->db->join( 'seasons', 'seasons.id = s.season_id', 'left outer' );

		// Run Query
		$query = $this->db->get( 'sessions s' );


		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$sessions = array();

			$rows = $query->result_array();
			
			foreach($rows as $row)
			{
				$sessions[$row['id']] = $row['name'];
			}

			return $sessions;
		}

		return false;
	}


	public function get_related_sessions( $id = FALSE )
	{
		$this->db->select( 'session_id, division_id ' );
		$this->db->where( array('division_id' => $id) );
		$query = $this->db->get( 'session_divisions sd' );

		if( $query->num_rows > 0 )
		{
			$rows = $query->result_array();

			$checked_ids = array();
			foreach( $rows as $row )
			{
				$checked_ids[$row['session_id']] = $row['division_id'];
			}

			return $checked_ids;
		}

		return false;	
	}


	public function get_seasons( )
	{
		$this->db->select( 'dc.team_id,t.name as team_name, s.name,s.year_start,s.year_end, s.id' );
		$this->db->join( 'division_champions dc', 'dc.season_id = s.id', 'left outer' );
		$this->db->join( 'teams t', 'dc.team_id = t.id', 'left outer' );
		$query = $this->db->get( 'seasons s' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

	}

		public function get_seasons_dropdown( )
	{
		$this->db->select( 's.name,s.year_start,s.year_end, s.id' );
		$query = $this->db->get( 'seasons s' );
		$seasons = array();
		
		if( $query->num_rows > 0 )
		{
			$rows = $query->result_array();

			$checked_ids = array();
			foreach( $rows as $row )
			{
				$seasons[$row['id']] = $row['name'];
			}

			return $seasons;
		}

	}


		// Assign Divisions to an Individual Session
	public function update_sessions( $id = FALSE )
	{
		if( $id )
		{
			// Remove Old Session/Division Relationships
			$this->db->where( 'division_id', $id );
			$this->db->delete( 'session_divisions' );

			$allData = array();

			// Add Current Session/Division Relationships
			if( !empty( $this->input->post('divisions') ) )
			{	
				foreach( $this->input->post('divisions') as $session )
				{
					$data = array(  
						'session_id' => $session,
						'division_id' => $id,
					);

					array_push($allData,$data);
				}

				// Insert all the records with only one call to the db
				$this->db->insert_batch('session_divisions',$allData); 

			}

			return true;
		}

		return false;	
	}

}