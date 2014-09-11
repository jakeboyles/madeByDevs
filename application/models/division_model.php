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
		$query = $this->db->get('teams t');

		$rows2 = $query->result_array();

		return $rows2;
	}


	// Get all games played by a team when they were in a division
	public function get_win_loss_by_team($team = FALSE, $division_id = FALSE)
	{
		$this->db->select('
			gt.win, 
			gt.loss,
			gt.tie,
			');
		$this->db->where( 'gt.team_id' , $team['id'] );

		if(!empty($division_id)) {
			$this->db->where('gt.division_id',$division_id);
		}

		$query = $this->db->get('game_teams gt');

		$games = $query->result_array();

		return $games;
	}

	// Get the best teams from each division
	public function get_division_leaders()
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

				$teams = $this->get_teams_by_division($division);

				if( $teams )
				{
					foreach( $teams as $team ) 
					{
						
						$teams_win_loss = $this->get_win_loss_by_team($team, $division['id']);

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

				$divisions_total[] = $stat;

			}

			return $divisions_total;
		}
	}



	// Get the best teams from each division
	public function get_team_stats($division_id = FALSE)
	{
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

						$teams_win_loss = $this->get_win_loss_by_team($team, $division['id']);

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

						$teams_total[] = $stat;

					}

				}

			}

			return $teams_total;
		}
	}
}