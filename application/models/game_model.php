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
			$game_time = $this->mysql_datetime($post['game_date'].$post["game_time"]);
			$data = array(
				'session_id'=>empty( $post['session_id'] ) ? NULL : $post['session_id'],
				'division_id'=>empty( $post['division_id'] ) ? NULL : $post['division_id'],
				'division_id'=>empty( $post['division_id'] ) ? NULL : $post['division_id'],
				'location_id'=>empty( $post['location_id'] ) ? NULL : $post['location_id'],
				'location_field_id'=>empty( $post['location_field_id'] ) ? NULL : $post['location_field_id'],
				'team_home_id'=>empty( $post['team_home_id'] ) ? NULL : $post['team_home_id'],
				'team_away_id'=>empty( $post['team_away_id'] ) ? NULL : $post['team_away_id'],
				'game_date_time'=>$game_time,
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
			$game_time = $this->mysql_datetime($post['game_date'].$post["game_time"]);
			$data = array(
				'session_id'=>empty( $post['session_id'] ) ? NULL : $post['session_id'],
				'division_id'=>empty( $post['division_id'] ) ? NULL : $post['division_id'],
				'division_id'=>empty( $post['division_id'] ) ? NULL : $post['division_id'],
				'location_id'=>empty( $post['location_id'] ) ? NULL : $post['location_id'],
				'location_field_id'=>empty( $post['location_field_id'] ) ? NULL : $post['location_field_id'],
				'team_home_id'=>empty( $post['team_home_id'] ) ? NULL : $post['team_home_id'],
				'team_away_id'=>empty( $post['team_away_id'] ) ? NULL : $post['team_away_id'],
				'game_date_time'=>$game_time,
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
				$this->count_by( array( 'table' => 'game_officials', 'where' => 'game_id = ' . $id ) ) > 0 
				|| $this->count_by( array( 'table' => 'game_players_soccer', 'where' => 'game_id = ' . $id ) ) > 0
			)
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				$this->Game_model->delete( $id );
			}
		}

		return false;
	}

	// AJAX Insert Record
	public function insert_game_ajax( $post = FALSE )
	{
		if( $post )
		{
			// Combine Date and Time Form Fields into a Single mySQL datetime Field
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
				'score_home' => 0,
				'score_away' => 0,
				'game_type' => 'soccer'
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			// Fetch This Game From the Database
			$game = $this->get_records( array( 'where' => 'g.id = ' . $insert_id, 'limit' => 1 ) );

			// Construct Data Array for JSON via AJAX
			$score_home = !empty( $game['score_home'] ) ? $game['score_home'] : 0;
			$score_away = !empty( $game['score_away'] ) ? $game['score_away'] : 0;
			$data_array = array(
				'result' => 'success',
				'insert_id' => $insert_id,
				'row' => array(
					$insert_id, 
					$game['division'], 
					$game['home_team'] . ' (' . $score_home . ')', 
					$game['away_team'] . ' (' . $score_away . ')',  
					$game['location'],
					date( 'm/d/Y g:i A', strtotime( $game['game_date_time'] ) ), 
					'<a href="#" class="btn active btn-primary" data-ajax-url="' . base_url( 'admin/games/edit_ajax/' . $game['id'] ) . '" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="' . $game['id'] . '"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn active btn-danger" data-ajax-url="' . base_url( 'admin/games/delete/' . $game['id'] ) . '" data-toggle="modal" data-target="#delete-modal" data-label="' . $game['home_team'] . ' vs ' . $game['away_team'] . '" data-row-id="' . $game['id'] . '"><i class="fa fa-times"></i></a>'
				)
			);

			// Return Data Array
			return $data_array;
		}

		return false;
	}

	// Edit Record
	public function update_game_ajax( $id = FALSE, $post = FALSE )
	{
		if( $id && $post )
		{
			// Combine Date and Time Form Fields into a Single mySQL datetime Field
			$game_date_time = $this->mysql_datetime( $post['game_date'] . ' ' . $post['game_time'] );

			// Update Data
			$data = array(
				//'session_id' => $post['session_id'],
				'division_id' => $post['division_id'],
				'location_id' => $post['location_id'],
				'location_field_id' => empty( $post['location_field_id'] ) ? NULL : $post['location_field_id'],
				'team_home_id' => $post['team_home_id'],
				'team_away_id' => $post['team_away_id'],
				'game_date_time' => $game_date_time,
				'score_home' => empty( $post['score_home'] ) && $post['score_home'] != 0 ? NULL : $post['score_home'],
				'score_away' => empty( $post['score_away'] ) && $post['score_away'] != 0 ? NULL : $post['score_away'],
			);

			// Update Record in Database
			$this->update( $id, $data );

			// Fetch This Game From the Database
			$game = $this->get_records( array( 'where' => 'g.id = ' . $id, 'limit' => 1 ) );

			// Construct Data Array for JSON via AJAX
			$score_home = !empty( $game['score_home'] ) ? $game['score_home'] : 0;
			$score_away = !empty( $game['score_away'] ) ? $game['score_away'] : 0;
			$data_array = array(
				'result' => 'success',
				'update_id' => $game['id'],
				'row' => array(
					$game['id'], 
					$game['division'], 
					$game['home_team'] . ' (' . $score_home . ')', 
					$game['away_team'] . ' (' . $score_away . ')', 
					$game['location'],
					date( 'm/d/Y g:i A', strtotime( $game['game_date_time'] ) ), 
					'<a href="#" class="btn active btn-primary" data-ajax-url="' . base_url( 'admin/games/edit_ajax/' . $game['id'] ) . '" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="' . $game['id'] . '"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn active btn-danger" data-ajax-url="' . base_url( 'admin/games/delete/' . $game['id'] ) . '" data-toggle="modal" data-target="#delete-modal" data-label="' . $game['home_team'] . ' vs ' . $game['away_team'] . '" data-row-id="' . $game['id'] . '"><i class="fa fa-times"></i></a>'
				)
			);
			
			// Return Data Array
			return $data_array;
		}

		return false;
	}

}