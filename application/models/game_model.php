<?php
class Game_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	public $before_dropdown = array( 'order_by(name)' );

	// Get Records
	public function get_records( $args = FALSE )
	{
		// Construct Query
		$this->db->select( '
			g.id, g.session_id, g.division_id, g.location_id, g.game_date_time, g.team_home_id, g.team_away_id, g.score_home, g.score_away, g.created_at, g.modified_at,
			l.name as location,
			d.name as division,
			t.name as home_team,
			t2.name as away_team
		' );
		$this->db->join( 'teams t', 't.id = g.team_home_id', 'left outer' );
		$this->db->join( 'teams t2', 't2.id = g.team_away_id', 'left outer' );
		$this->db->join( 'locations l', 'l.id = g.location_id', 'left outer' );
		$this->db->join( 'divisions d', 'd.id = g.division_id', 'left outer' );

		// Load Games Based off of The Where Statement
		if( !empty( $args['where'] ) )
		{
			$this->db->where( $args['where'] );
		}

		// Run Query
		$query = $this->db->get( 'games g' );

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
				'year_start' => $post['year_start'],
				'year_end' => $post['year_end'],
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
				'year_start' => $post['year_start'],
				'year_end' => $post['year_end'],
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