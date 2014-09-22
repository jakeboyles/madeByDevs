<?php
class Division_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_records( $atts = FALSE )
	{
		// Construct Query
		$this->db->select( 'd.id, d.name,d.description, d.created_at, d.modified_at, dt.type as division_type' );
		$this->db->join( 'division_types dt', 'dt.id = d.division_type_id', 'left outer' );

		// Check for a Custom Where Query
		if( !empty( $atts['where'] ) )
		{
			$this->db->where( $atts['where'] );
		}

		// Run Query
		$query = $this->db->get( 'divisions d' );

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
				'name' => $post['name'],
				'division_type_id' => empty( $post['division_type'] ) ? NULL : $post['division_type'],
				'description' => empty( $post['description'] ) ? NULL : $post['description']
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			if(!empty($post['divisions']))
			{
				foreach($post['divisions'] as $key=>$value) 
				{
					$data2 = array(
						'session_id' => $value,
						'division_id' => $insert_id,
					);

					$insert_id2 = $this->insert( $data2, FALSE, 'session_divisions' );
				}
			}

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
				'division_type_id' => empty( $post['division_type'] ) ? NULL : $post['division_type'],
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
		// To Do: This will all change based on new databse relationship structure
		// If an ID Was Found in URL
		if( $id )
		{
			// If this ID Belongs to Other Tables - Dont Delete It
			// @ return: Return a string of error for ajax
			if( 
				$this->count_by( array( 'table' => 'games', 'where' => 'division_id = ' . $id ) ) > 0 
				|| $this->count_by( array( 'table' => 'teams', 'where' => 'division_id = ' . $id ) ) > 0
			)
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				// Remove Session Division Relationships
				$this->db->where( 'division_id', $id );
				$this->db->delete( 'session_divisions' );

				// Remove Division
				$this->Division_model->delete( $id );
			}
		}

		return false;
	}


	// Get Divisions in session
	public function get_divisions( $id = FALSE )
	{

		$this->db->select( 'sd.division_id,d.name' );
		$this->db->join( 'divisions d', 'd.id = sd.division_id', 'left outer' );
		$this->db->where( 'session_id' , $id );
		$query= $this->db->get('session_divisions sd');

		$divisions = array();

		$rows = $query->result_array();


		if( $rows )
		{
			foreach($rows as $row) 
			{
				$divisions[$row['division_id']] = $row["name"];
			}

			return $divisions;

		}

		return false;
	}


	// Get all teams in a division
	public function get_teams_by_division($division = FALSE)
	{
		$this->db->select( 't.id, t.name' );
		$this->db->where( 't.division_id' , $division['id'] );
		$this->db->where( 't.active' , 1 );
		$query = $this->db->get('teams t');

		$rows2 = $query->result_array();

		return $rows2;
	}


	// Get all games played by a team when they were in a division
	public function get_win_loss_by_team($team = FALSE, $division_id = FALSE, $seasonID = FALSE)
	{
		$this->db->select('
			gt.win, 
			gt.loss,
			gt.tie,
			g.division_id,
			g.season_id,
			');
		$this->db->where( 'gt.team_id' , $team['id'] );
		$this->db->join( 'games g', 'g.id = gt.game_id', 'left outer' );

		if(!empty($division_id)) {
			$this->db->where('g.division_id',$division_id);
		}

		if(!empty($seasonID)) {
			$this->db->where('g.season_id',$seasonID);
		}

		$query = $this->db->get('game_teams gt');

		$games = $query->result_array();

		return $games;
	}

	// Get the best teams from each division
	public function get_division_leaders($season_id = FALSE)
	{
		$this->db->select('d.id,d.name');
		$query = $this->db->get('divisions d');


		$divisions = $query->result_array();

		$divisions_total = array();

		if( $divisions )
		{
			foreach($divisions as $division) 
			{
				$highest_win = NULL;
				$highest_team = NULL;
				$team_id = NULL;
				$totalWins = NULL;
				$totalTies = NULL;
				$totalGames = NULL;
				$points = NULL;
				$points_against = NULL;

				$teams = $this->get_teams_by_division($division);

				if( $teams )
				{
					foreach( $teams as $team ) 
					{

		
						if(!empty($season_id))
						{
							$teams_win_loss = $this->get_win_loss_by_team($team, $division['id'], $season_id);
						}
						else 
						{
							$teams_win_loss = $this->get_win_loss_by_team($team, $division['id']);
						}

						if( $teams_win_loss )
						{

							$games = 0;
							$wins = 0;
							$ties = 0;

							foreach( $teams_win_loss as $game ) 
							{
								$games++;

								if($game['win']=='1'){
									$wins++;
								}

								if($game['tie']=='1'){
									$ties++;
								}
								
							}

							$winloss = $wins / $games;

							if( $winloss > $highest_win )
							{
								$highest_win = $winloss;
								$highest_team = $team['name'];
								$team_id = $team['id'];
								$totalWins = $wins;
								$totalTies = $ties;
								$totalGames = $games;

								if(!empty($season_id))
								{
								$points = $this->get_points_for_team($team, $season_id);
								$points_against = $this->get_points_for_opponent($team, $season_id);
								}

							}

						}

					}

				}

				$stat['name'] = $division['name'];
				$stat['division_id'] = $division['id'];
				$stat['highest_win']=$highest_win;
				$stat['highest_team'] = $highest_team;
				$stat['games_played'] = $totalGames;
				$stat['games_won'] = $totalWins;
				$stat['games_tied'] = $totalTies;
				$stat['team_id'] = $team_id;
				$stat['points'] = $points;
				$stat['points_against'] = $points_against;

				$divisions_total[] = $stat;

			}

			return $divisions_total;
		}
	}




	// Get the best teams from each division
	public function get_team_stats($division_id = FALSE, $season_id = FALSE)
	{

		if(!empty($season_id))
		{
			$this->db->select('l.current_season_id');
			$query = $this->db->get('leagues l');

			$games = $query->result_array();

			$current_season_id = $games[0]['current_season_id'];

		}
		$this->db->select('d.id,d.name');
		$this->db->where('d.id',$division_id);
		$query = $this->db->get('divisions d');
		

		$divisions = $query->result_array();

		if( $divisions )
		{
			foreach($divisions as $division) 
			{

				$teams = $this->get_teams_by_division($division);

				$teams_total = array();

				if( $teams )
				{
					foreach( $teams as $team ) 
					{
						$winloss = 0;
						$games = 0;
						$wins = 0;
						$ties = 0;

						$teams_win_loss = $this->get_win_loss_by_team($team, $division['id'], $season_id);

						if(!empty($season_id)) {

							$points = $this->get_points_for_team($team,$current_season_id);
							$points_against = $this->get_points_for_opponent($team,$current_season_id);
						}
						else 
						{
							$points = $this->get_points_for_team($team);
							$points_against = $this->get_points_for_opponent($team);
						}
						if( $teams_win_loss )
						{

							foreach( $teams_win_loss as $game ) 
							{
								$games++;

								if($game['win']=='1'){
									$wins++;
								}

								if($game['tie']=='1'){
									$ties++;
								}
								
							}

							$winloss = $wins / $games;

		
						}

						$stat['win_loss']=$winloss;
						$stat['id']=$team['id'];
						$stat['team_name']=$team['name'];
						$stat['games_played'] = $games;
						$stat['games_won'] = $wins;
						$stat['games_tied'] = $ties;
						$stat['points'] = $points;
						$stat['points_against'] = $points_against;

						$teams_total[] = $stat;

					}

				}

			}

			usort($teams_total, function($a, $b) {
			    return $a['win_loss'] - $b['win_loss'];
			});
			return $teams_total;
		}
	}


	public function get_points_for_team( $id = FALSE, $season_id = FALSE )
	{
		$this->db->select('SUM(g.score_home) as total');
		$this->db->where('g.team_home_id',$id['id']);

		if($season_id)
		{
			$this->db->where('g.season_id',$season_id);
		}

		$query = $this->db->get( 'games g' );

		$points = 0;

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			if( !empty( $atts['single'] ) )
			{
				$row = $query->row_array();
				die($row);
			}
			else
			{
				$rows = $query->result_array();
				 $points = $rows[0]['total'];
			}
		}

		$this->db->select('SUM(g.score_away) as total');
		$this->db->where('g.team_away_id',$id['id']);

		if($season_id)
		{
			$this->db->where('g.season_id',$season_id);
		}

		$query = $this->db->get( 'games g' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			if( !empty( $atts['single'] ) )
			{
				$row = $query->row_array();
			}
			else
			{
				$rows = $query->result_array();
				$more = $rows[0]['total'];
				$points += $more;
			}
		}

		return $points;

	}



	public function get_points_for_opponent( $id= FALSE, $season_id = FALSE )
	{
		$this->db->select('SUM(g.score_away) as total');
		$this->db->where('g.team_home_id',$id['id']);

		if($season_id)
		{
			$this->db->where('g.season_id',$season_id);
		}

		$query = $this->db->get( 'games g' );

		$points = 0;

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			if( !empty( $atts['single'] ) )
			{
				$row = $query->row_array();
				die($row);
			}
			else
			{
				$rows = $query->result_array();
				 $points = $rows[0]['total'];
			}
		}

		$this->db->select('SUM(g.score_home) as total');
		$this->db->where('g.team_away_id',$id['id']);

		if($season_id)
		{
			$this->db->where('g.season_id',$season_id);
		}

		$query = $this->db->get( 'games g' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			if( !empty( $atts['single'] ) )
			{
				$row = $query->row_array();
			}
			else
			{
				$rows = $query->result_array();
				$more = $rows[0]['total'];
				$points += $more;
			}
		}

		return $points;

	}


	public function add_champion($division_id = FALSE , $post = FALSE)
	{
		if(!empty($division_id) && !empty($post))
		{

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5048';

			$this->load->library('upload', $config);

			if($_FILES['upload']['error']=='0'){

				if($_FILES['upload'])
				// The field name for the file upload would be logo
				if ( ! $this->upload->do_upload('upload'))
				{
					return $this->upload->display_errors('<li>', '</li>');
				}
				else
				{
					$image = array('upload_data' => $this->upload->data());

					$data = array(
						'filename' => $image['upload_data']['file_name'],
						'mime_type' => $image['upload_data']['file_type']
					);

					$image = $this->db->insert('media',$data);

					$image = $this->db->insert_id();
				}

			}

			if($_FILES['headline_image']['error']=='0'){

				if ( ! $this->upload->do_upload('headline_image'))
				{
					return $this->upload->display_errors('<li>', '</li>');
				}
				else
				{
					$headline_image = array('upload_data' => $this->upload->data());

					$data = array(
						'filename' => $headline_image['upload_data']['file_name'],
						'mime_type' => $headline_image['upload_data']['file_type']
					);

					$headline_image = $this->db->insert('media',$data);

					$headline_image = $this->db->insert_id();
				}

			}


		

			if($post['updating'] == "false")
			{
			// Insert Data
			$data = array(
				'media_id' => empty( $image ) ? NULL : $image,
				'division_id' => empty( $division_id ) ? NULL : $division_id,
				'season_id' => empty($post['season_id']) ? NULL : $post['season_id'],
				'headline' => empty($post['headline']) ? NULL : $post['headline'],
				'team_id' => empty($post['winner_id']) ? NULL : $post['winner_id'],
				'headline_image' => empty($headline_image) ? NULL : $headline_image,
			);

			$insert_id = $this->db->insert('division_champions', $data );
			}
			else
			{
			$data = array(
				'media_id' => empty( $image ) ? $post['media_id'] : $image,
				'division_id' => empty( $division_id ) ? NULL : $division_id,
				'season_id' => empty($post['season_id']) ? NULL : $post['season_id'],
				'headline' => empty($post['headline']) ? NULL : $post['headline'],
				'team_id' => empty($post['winner_id']) ? NULL : $post['winner_id'],
				'headline_image' => empty($headline_image) ? $post['headline_id'] : $headline_image,
			);

			$this->db->where('season_id',$post['season_id']);
			$this->db->where('division_id',$division_id);
			$insert_id = $this->db->update('division_champions', $data );	
			}

			if(!empty($insert_id)){
				return true;
			}
			else 
			{
				return false;
			}
		}
	}





	public function get_season_champion($divisionID = FALSE, $seasonID = False)
	{

		$this->db->select('dc.season_id, dc.team_id, dc.division_id,dc.media_id,dc.headline_image as headline_id, hl.filename as headline_image, m.filename as picture, dc.headline');
		$this->db->join( 'media hl', 'hl.id = dc.headline_image', 'left outer' );
		$this->db->join( 'media m', 'm.id = dc.media_id', 'left outer' );
		$this->db->where('dc.season_id',$seasonID);
		$this->db->where('dc.division_id',$divisionID);

		$query = $this->db->get( 'division_champions dc' );

		$info = $query->result_array();

		return $info;
	}

	public function get_current_season_data($season_id = FALSE, $division_id = FALSE)
	{
		$this->db->select('dc.season_id, dc.team_id,s.year_end, dc.division_id,dc.media_id,dc.headline_image as headline_id, hl.filename as headline_image, m.filename as picture, dc.headline');
		$this->db->join( 'media hl', 'hl.id = dc.headline_image', 'left outer' );
		$this->db->join( 'media m', 'm.id = dc.media_id', 'left outer' );
		$this->db->join( 'seasons s', 's.id = dc.season_id', 'left outer' );
		$this->db->where('dc.season_id',$season_id);
		$this->db->where('dc.division_id',$division_id);

		$atts['single'] = 'true';

		$query = $this->db->get( 'division_champions dc' );

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
	}

		public function get_historical_season_data($season_id = FALSE, $division_id = FALSE)
	{

		$this->db->select('dc.season_id,t.id, dc.team_id,s.year_end, dc.division_id,dc.media_id,dc.headline_image as headline_id, hl.filename as headline_image, m.filename as picture, dc.headline, t.name, s.name as season');
		$this->db->join( 'media hl', 'hl.id = dc.headline_image', 'left outer' );
		$this->db->join( 'media m', 'm.id = dc.media_id', 'left outer' );
		$this->db->join( 'teams t', 't.id = dc.team_id', 'left outer' );
		$this->db->join( 'seasons s', 's.id = dc.season_id', 'left outer' );
		$this->db->where('dc.season_id',$season_id);
		$this->db->where('dc.division_id',$division_id);

		$atts['single'] = 'true';

		$query = $this->db->get( 'division_champions dc' );

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
	}

}