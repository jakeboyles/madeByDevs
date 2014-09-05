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
	public function insert_record( $post = FALSE, $image = FALSE )
	{
		if( $post )
		{
			// Insert Data
			$data = array(
				'status' => 'active',
				'name' => $post['name'],
				'team_logo' => empty( $logo ) ? NULL : $logo,
				'division_id' => empty( $post['division_id'] ) ? NULL : $post['division_id'],
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
	public function update_record( $id = FALSE, $post = FALSE, $logo = FALSE )
	{
		if( $id && $post )
		{
			// Update Data
			$data = array(
				'name' => $post['name'],
				'division_id' =>  empty( $post['division_id'] ) ? NULL : $post['division_id'],
				'team_logo' =>  empty( $logo ) ? NULL : $logo,
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
				$this->count_by( array( 'table' => 'team_players', 'where' => 'team_id = ' . $id ) ) > 0 
				|| $this->count_by( array( 'table' => 'session_teams', 'where' => 'team_id = ' . $id ) ) > 0
			)
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				$this->delete( $id );
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

	// Fetch a Team Schedule for Each Session in the Active Season
	public function get_current_schedule( $team_id = FALSE, $active_sessions = FALSE )
	{
		/*
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
					$schedule['season_name'] = $row['season_name'];

					// Apply Session Name to Schedule Array
					$schedule['sessions'][] = $row['session_name'];

					// Apply Games to the Schedule Array
					$schedule['games'][$row['session_name']] = $games;
				}
			}

			if ( !empty( $schedule ) )
			{
				return $schedule;
			}
		}
		*/
		if ( $team_id && $active_sessions )
		{
			$this->db->select('
				g.id, g.game_date_time, g.score_home, g.score_away, g.session_id, g.team_home_id, g.team_away_id, 
				thome.name as team_home,
				taway.name as team_away,
				l.id as location_id, l.name as location, lf.name as location_field
			');
			$this->db->join( 'locations l', 'l.id = g.location_id', 'left outer' );
			$this->db->join( 'locations lf', 'lf.id = g.location_field_id', 'left outer' );
			$this->db->join( 'teams thome', 'thome.id = g.team_home_id' );
			$this->db->join( 'teams taway', 'taway.id = g.team_away_id' );
			$this->db->where( '(team_home_id = ' . $team_id . ' OR team_away_id = ' . $team_id . ')' );
			$this->db->where_in( 'g.session_id', $active_sessions );
			$this->db->order_by( 'g.game_date_time', 'ASC' );
			$query = $this->db->get( 'games g' );

			if( $query->num_rows > 0 )
			{
				$games = array();
				$rows = $query->result_array();
				foreach( $rows as $row )
				{
					// Determine if Away or Home
					$row['is_home_team'] = ( $row['team_home_id'] == $team_id ) ? TRUE : FALSE;

					// Set Opponent Info
					$row['opponent_team_name'] = $row['is_home_team'] ? $row['team_away'] : $row['team_home'];
					$row['opponent_team_id'] = $row['is_home_team'] ? $row['team_away_id'] : $row['team_home_id'];
					
					// Determine Win or Loss
					if( $row['score_home'] != 0 || $row['score_away'] != 0 )
					{
						if( $row['is_home_team'] )
						{
							$row['result'] = ( $row['score_home'] > $row['score_away'] ) ? 'Win' : 'Loss';
						}
						elseif( !$row['is_home_team'] )
						{
							$row['result'] = ( $row['score_home'] > $row['score_away'] ) ? 'Loss' : 'Win';
						}
					}
					
					// Restore Appended Array Data to $games array to be returned
					$games[] = $row;
				}

				return $games;
			}
		}

		return false;
	}




	// Insert a user onto the roster
	public function insert_roster_record( $post = FALSE )
	{
	
		if($post)
		{
			// Update Data
			$data = array(
				'user_id' => $post['player_id'],
				'team_id' => $post['team_id'],
				'position_id' => $post['position'],
				'player_number' => $post['number'], 
			);

			// Update Record in Database
			$info = $this->db->insert('team_players', $data); 

			$id = $this->db->insert_id();

			$player = $this->get_player_info($id);

			$player= $player[0];

			 // Construct Data Array for JSON via AJAX
			$data_array = array(
				'result' => 'success',
				'insert_id' => $id,
				'row' => array(
					$id, 
					'<a href="/admin/users/edit/'.$player['user_id'].'">'.$player['first_name'].'</a>', 
					'<a href="/admin/users/edit/'.$player['user_id'].'">'.$player['last_name'].'</a>', 
					$player['name'], 
					'<a href="#" class="btn active btn-primary" data-ajax-url="' . base_url( 'admin/teams/edit_roster/' . $id ) . '" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="' . $id . '"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn active btn-danger" data-ajax-url="' . base_url( 'admin/teams/delete_roster/' . $id) . '" data-toggle="modal" data-target="#delete-modal" data-label="' . $player['first_name'] . " " . $player['last_name'] . '" data-row-id="' . $id . '"><i class="fa fa-times"></i></a>',
				)
			);

			return $data_array;
		}

		return false;
	}



		// Insert a user onto the roster
	public function insert_roster_record_frontend( $post = FALSE )
	{
	
		if($post)
		{
			// Update Data
			$data = array(
				'user_id' => $post['player_id'],
				'team_id' => $post['team_id'],
				'position_id' => $post['position'],
				'player_number' => $post['number'], 
			);

			// Update Record in Database
			$info = $this->db->insert('team_players', $data); 

			$id = $this->db->insert_id();

			$player = $this->get_player_info($id);

			$player= $player[0];

			 // Construct Data Array for JSON via AJAX
			$data_array = array(
				'result' => 'success',
				'insert_id' => $id,
				'row' => array(
					'<td style="border-top: medium none;">'.$player['first_name']." ".$player['last_name'].'</td>',
					'<td style="border-top: medium none;">'.$player['name'].'</td>',
					'<td style="border-top: medium none;">'.$player['player_number'].'</td>',
				)
			);

			return $data_array;
		}

		return false;
	}



	// Insert a user onto the roster
	public function update_roster_record_frontend( $id = FALSE , $post = FALSE )
	{
	
		if($post)
		{
			// Update Data
			$data = array(
				'position_id' => $post['position'],
				'player_number' => $post['number'], 
			);

			$this->db->where('user_id', $id);

			// Update Record in Database
			$info = $this->db->update('team_players', $data);


			$this->db->select('tp.id');
			$this->db->where('user_id', $id);
			$query = $this->db->get( 'team_players tp' );

			if($query->num_rows > 0)
			{
					$row = $query->row_array();
			}

			$player = $this->get_player_info($row['id']);

			$player= $player[0];

			 // Construct Data Array for JSON via AJAX
			$data_array = array(
				'result' => 'success',
				'insert_id' => $id,
				'row' => array(
					'<td style="border-top: medium none;">'.$player['first_name']." ".$player['last_name'].'</td>',
					'<td style="border-top: medium none;">'.$player['name'].'</td>',
					'<td style="border-top: medium none;">'.$player['player_number'].'</td>',
					'<td><a href="#" class="editModal btn active btn-primary" data-ajax-url="'.base_url("teams/edit_player/" . $player["user_id"]).'" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="'.$row['id'].'"><i class="fa fa-edit"></i></a><a href="#" class="btn active btn-danger" data-ajax-url="'.base_url("teams/delete_player/" . $row['id']).'" data-toggle="modal" data-target="#delete-modal" data-label="'.$player["first_name"] . " " . $player["last_name"].'" data-row-id="'.$row['id'].'"><i class="fa fa-times"></i></a></td>',
				)
			);

			return $data_array;
		}

		return false;
	}




	// Update roster field
	public function update_roster_field( $id = FALSE, $post = FALSE)
	{
	
		if($post && $id)
		{
			// Update Data
			$data = array(
				'user_id' => $post['player_id'],
				'team_id' => $post['parent_id'],
				'position_id' => $post['position'],
				'player_number' => $post['number'], 
			);

			// Update Record in Database
			 $this->db->where('id', $id);
			 $insert_id = $this->db->update('team_players', $data); 

			 $player = $this->get_player_info($id);
			 $player= $player[0];

			 // Construct Data Array for JSON via AJAX
			$data_array = array(
				'result' => 'success',
				'insert_id' => $insert_id,
				'row' => array(
					$id, 
					'<a href="/admin/users/edit/'.$player['user_id'].'">'.$player['first_name'].'</a>', 
					'<a href="/admin/users/edit/'.$player['user_id'].'">'.$player['last_name'].'</a>',
					$player['name'], 
					'<a href="#" class="btn active btn-primary" data-ajax-url="' . base_url( 'admin/teams/edit_roster/' . $id) . '" data-toggle="modal" data-target="#edit-modal" data-label="" data-row-id="' . $id . '"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn active btn-danger" data-ajax-url="' . base_url( 'admin/teams/delete_roster/' . $id ) . '" data-toggle="modal" data-target="#delete-modal" data-label="' . $player['first_name'] . " ". $player['last_name'] . '" data-row-id="' . $id . '"><i class="fa fa-times"></i></a>',
				)
			);




			 return $data_array;

		}

		return false;
	}






	// Delete a team member 
	public function delete_roster( $id = FALSE )
	{
		// If an ID Was Found in URL
		if( $id )
		{
			$this->db->where('id', $id);
			$this->db->delete('team_players'); 

		}

		return false;
	}





	// Fetch the Team Roster
	public function get_team_roster( $team_id = FALSE )
	{
		if( $team_id )
		{
			$this->db->select('
				tp.player_number,
				tp.id,
				u.first_name,u.id as user_id, u.last_name,
				p.name as position, p.abbreviation as position_abbreviation
			');
			$this->db->join( 'users u', 'u.id = tp.user_id', 'left outer' );
			$this->db->join( 'positions p', 'p.id = tp.position_id', 'left outer' );
			$this->db->where( 'tp.team_id', $team_id );
			$this->db->order_by( 'u.last_name ASC, u.first_name ASC' );
			$query = $this->db->get( 'team_players tp' );

			if( $query->num_rows() > 0 )
			{
				$rows = $query->result_array();
				return $rows;
			}
		}

		return false;
	}



	// Get more player info
	public function get_player( $team_id = FALSE )
	{
		if( $team_id )
		{
			$this->db->select('
				tp.player_number,
				tp.position_id,
				tp.user_id,
				tp.team_id,
			');
			$this->db->join( 'users u', 'u.id = tp.user_id', 'left outer' );
			$this->db->join( 'positions p', 'p.id = tp.position_id', 'left outer' );
			$this->db->where( 'tp.id', $team_id );
			$this->db->order_by( 'u.last_name ASC, u.first_name ASC' );
			$query = $this->db->get( 'team_players tp' );

			if( $query->num_rows() > 0 )
			{
				$rows = $query->result_array();
				return $rows;
			}
		}

		return false;
	}


	// Get More Player Info
	public function get_player_info( $team_id = FALSE )
	{
		if( $team_id )
		{
			$this->db->select('
				tp.player_number,
				tp.position_id,
				tp.user_id,
				tp.team_id,
				u.first_name,
				u.last_name,
				u.id as user_id,
				p.name,
			');
			$this->db->join( 'users u', 'u.id = tp.user_id', 'left outer' );
			$this->db->join( 'positions p', 'p.id = tp.position_id', 'left outer' );
			$this->db->where( 'tp.id', $team_id );
			$this->db->order_by( 'u.last_name ASC, u.first_name ASC' );
			$query = $this->db->get( 'team_players tp' );

			if( $query->num_rows() > 0 )
			{
				$rows = $query->result_array();
				return $rows;
			}
		}

		return false;
	}



		public function get_player_info_by_user_id( $user_id = FALSE )
	{
		if( $user_id )
		{
			$this->db->select('
				tp.player_number,
				tp.position_id,
				tp.user_id,
				tp.team_id,
				u.first_name,
				u.last_name,
				u.id as user_id,
				p.name,
			');
			$this->db->join( 'users u', 'u.id = tp.user_id', 'left outer' );
			$this->db->join( 'positions p', 'p.id = tp.position_id', 'left outer' );
			$this->db->where( 'tp.user_id', $user_id );
			$this->db->order_by( 'u.last_name ASC, u.first_name ASC' );
			$query = $this->db->get( 'team_players tp' );

			if( $query->num_rows() > 0 )
			{
				$rows = $query->result_array();
				return $rows;
			}
		}

		return false;
	}


	// Fetch a List of Current Seasons Teams and their Stats
	public function get_current_season_teams( $current_season_id )
	{
		
	}


		// Get Divisions in session
	public function get_team_by_division( $id = FALSE )
	{

		$this->db->select( 't.name,t.id' );
		$this->db->where( 'division_id' , $id );
		$query= $this->db->get('teams t');

		$teams = array();

		$rows = $query->result_array();

		if( $rows )
		{
			
			foreach($rows as $row) 
			{
				$teams[$row['id']] = $row["name"];
			}

			return $teams;

		}

		return false;
	}


	// Get Divisions in session
	public function get_captains()
	{

		$this->db->select( 'u.first_name,u.last_name,u.birthday,u.id' );
		$query= $this->db->get('users u');

		$teams = array();

		$rows = $query->result_array();

		if( $rows )
		{
			
			foreach($rows as $row) 
			{
				if(!empty($row['birthday'])) 
				{
					$birthdate = ' ('.date('m/d/y',strtotime($row['birthday'])).')';
				}
				else 
				{
					$birthdate = NULL;
				}
				$teams[$row['id']] = $row["first_name"].' '.$row['last_name'] . $birthdate;
			}

			return $teams;

		}

		return false;
	}


	// Get Logo For Team
	public function get_logo( $id = FALSE )
	{
		$this->db->select('t.team_logo, m.filename');
		$this->db->where('t.id = ' . $id);
		$this->db->join( 'media m', 'm.id = t.team_logo', 'left outer' );
		$query= $this->db->get('teams t');

		if( $query->num_rows() > 0 )
		{
			$rows = $query->result_array();
			return $rows[0];
		}
		else {
			return false;
		}
	}

}