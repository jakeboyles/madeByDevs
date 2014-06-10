<?php
class Game_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	//public $before_dropdown = array( 'order_by(name)' );

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
			if( !empty( $args['limit'] ) && $args['limit'] == 1 )
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

	// AJAX Insert Record
	public function insert_game_ajax( $post = FALSE )
	{
		if( $post )
		{
			// Parsing
			$game_date_time = $this->mysql_datetime( $post['game_date'] . ' ' . $post['game_time'] );

			// Insert Data
			$data = array(
				'session_id' => $post['session_id'],
				'division_id' => $post['division_id'],
				'location_id' => $post['location_id'],
				'location_field_id' => empty( $post['location_field_id'] ) ? NULL : $post['location_field_id'],
				'team_home_id' => $post['team_home_id'],
				'team_away_id' => $post['team_away_id'],
				'game_date_time' => $game_date_time,
				'game_type' => 'soccer'
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			// Fetch This Game From the Database
			//$game = $this->get( $insert_id );
			$game = $this->get_records( array( 'where' => 'g.id = ' . $insert_id, 'limit' => 1 ) );

			//echo '<pre>'; var_dump( $game ); echo '</pre>';

			// Construct Data Array for JSON via AJAX
			$data_array = array(
				'result' => 'success',
				'insert_id' => $insert_id,
				'row' => array(
					$insert_id, 
					$game['division'], 
					$game['home_team'], 
					$game['away_team'], 
					$game['location'],
					date( 'm/d/Y g:i A', strtotime( $game['game_date_time'] ) ), 
					'<a href="#" class="btn active btn-primary" data-ajax-url="' . base_url( 'admin/locations/edit_field/' . $game['id'] ) . '" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="' . $game['id'] . '"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn active btn-danger" data-ajax-url="' . base_url( 'admin/locations/delete/' . $game['id'] ) . '" data-toggle="modal" data-target="#delete-modal" data-label="' . $game['home_team'] . ' vs ' . $game['away_team'] . '" data-row-id="' . $game['id'] . '"><i class="fa fa-times"></i></a>'
				)
			);

			// Return Data Array
			return $data_array;
		}

		return false;
	}

}