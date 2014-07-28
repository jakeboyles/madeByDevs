<?php
class Team_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_records( $atts = FALSE )
	{
		// Construct Query
		$this->db->select('
			t.id, t.captain_user_id, t.name, t.description, t.team_logo, t.status, t.created_at, t.modified_at, u.first_name, u.last_name, 
			u.id as user_id, u.email, 
			d.id as division_id, d.name as division
		');
		$this->db->join( 'users u', 'u.id = t.captain_user_id', 'left outer' );
		$this->db->join( 'divisions d', 'd.id = t.division_id', 'left outer' );
		$this->db->order_by( 't.name', 'ASC' );

		if( !empty( $atts['where'] ) )
		{
			$this->db->where( $atts['where'] );
		}

		// Run Query
		$query = $this->db->get( 'teams t' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			if( !empty( $atts['single'] ) )
			{
				$row = $query->row_array();
				return $row;
			}
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
				'status' => 'active',
				'name' => $post['name'],
				'division_id' => $post['division_id'],
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
				'division_id' => $post['division_id'],
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
				$this->count_by( array( 'table' => 'sessions', 'where' => 'season_id = ' . $id ) ) > 0 
				|| $this->count_by( array( 'table' => 'leagues', 'where' => 'current_season_id = ' . $id ) ) > 0
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

	// Get a list of Teams by Division ID
	public function get_teams_by_division( $division_id = FALSE )
	{
		if( $division_id )
		{
			$rows = $this->get_many_by( 'division_id', $division_id );

			// If Teams were Found, Construct an Array and Return them
			if( !empty( $rows ) )
			{
				$teams = array();
				foreach( $rows as $row )
				{
					$teams[ $row['id'] ] = $row['name'];
				}

				return $teams;
			}

		}

		return false;
	}

	// Fetch the Team Schedule for Each Session in the Active Season
	public function get_current_schedule( $team_id = FALSE, $active_sessions = FALSE )
	{
		if( $team_id && $active_sessions )
		{
			// Loop Through to get a schedule for each session
			$schedule = array();
			foreach( $active_sessions as $active_session )
			{
				// Fetch Games for this Session
				$this->db->select('
					g.id, g.game_date_time, g.score_home, g.score_away,
					thome.name as team_home,
					taway.name as team_away,
					l.id as location_id, l.name as location, lf.name as location_field
				');
				$this->db->join( 'locations l', 'l.id = g.location_id', 'left outer' );
				$this->db->join( 'locations lf', 'lf.id = g.location_field_id', 'left outer' );
				$this->db->join( 'teams thome', 'thome.id = g.team_home_id' );
				$this->db->join( 'teams taway', 'taway.id = g.team_away_id' );
				$this->db->where( 'g.session_id = ' . $active_session . ' AND (team_home_id = ' . $team_id . ' OR team_away_id = ' . $team_id . ')' );
				$this->db->order_by( 'g.game_date_time', 'ASC' );
				$query = $this->db->get( 'games g' );

				if( $query->num_rows > 0 )
				{
					// Store Games to an Array
					$games = $query->result_array();

					// Fetch Additional Schedule Information
					$this->db->select( 's.name as session_name, se.name as season_name' );
					$this->db->join( 'seasons se', 'se.id = s.season_id' );
					$this->db->where( 's.id', $active_session );
					$query = $this->db->get( 'sessions s' );
					$row = $query->row_array();

					// Apply Season Name to Schedule Array
					$schedule[$row['session_name']]['season_name'] = $row['season_name'];

					// Apply Session Name to Schedule Array
					$schedule[$row['session_name']]['session_name'] = $row['session_name'];

					// Apply Games to the Schedule Array
					$schedule[$row['session_name']]['games'] = $games;
				}
			}

			if ( !empty( $schedule ) )
			{
				return $schedule;
			}
		}

		return false;
	}

	

}