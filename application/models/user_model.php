<?php
class User_model extends MY_Model
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
			u.id, u.email, u.user_type_id, u.profile_picture, u.first_name, u.last_name, u.gender, u.postal, u.birthday, u.last_login, u.created_at, u.created_by, u.modified_at, u.modified_by,
			ut.type as user_type
		');
		$this->db->join( 'user_types ut', 'ut.id = u.user_type_id', 'left outer' );

		// Look for Custom Where Query
		if( !empty( $atts['where'] ) )
		{
			$this->db->where( $atts['where'] ); 
		}

		// Run Query
		$query = $this->db->get( 'users u' );

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
				'user_type_id' => $post['user_type_id'],
				'email' => $post['email'],
				'password' => $this->password_hash( $post['password'] ),
				'first_name' => $post['first_name'],
				'last_name' => $post['last_name'],
				'gender' => empty( $post['gender'] ) ? NULL : $post['gender'],
				'postal' => empty( $post['postal'] ) ? NULL : $post['postal'],
				'birthday' => empty( $post['birthday'] ) ? NULL : $this->mysql_date( $post['birthday'] )
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
				'user_type_id' => $post['user_type_id'],
				'email' => $post['email'],
				'first_name' => $post['first_name'],
				'last_name' => $post['last_name'],
				'gender' => empty( $post['gender'] ) ? NULL : $post['gender'],
				'postal' => empty( $post['postal'] ) ? NULL : $post['postal'],
				'birthday' => empty( $post['birthday'] ) ? NULL : $this->mysql_date( $post['birthday'] )
			);

			// If Password was Set, Change It
			if( !empty( $post['password'] ) )
			{
				$data['password'] = $this->password_hash( $post['password'] );
			}

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
				$this->count_by( array( 'table' => 'teams', 'where' => 'captain_user_id = ' . $id ) ) > 0
				|| $this->count_by( array( 'table' => 'game_players_soccer', 'where' => 'user_id = ' . $id ) ) > 0
				|| $this->count_by( array( 'table' => 'session_players', 'where' => 'user_id = ' . $id ) ) > 0
				|| $this->count_by( array( 'table' => 'game_officials', 'where' => 'user_id = ' . $id ) ) > 0
			)
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				$this->User_model->delete( $id );
			}
		}

		return false;
	}


	public function add_player_roster( $post = FALSE )
	{
		if($post)
		{
			// Update Data
			$data = array(
				'user_id' => $post['players_id'],
				'team_id' => $post['team_id'],
				'position_id' => $post['position'],
				'player_number' => $post['number'],
			);

			// Update Record in Database
			$this->insert($data);

			return true;
		}

		return false;
	}


	// Get Players
	public function get_players( )
	{
		$rows = $this->get_records( array( 'where' => 'u.user_type_id = 3' ) );

		$user = array();

		if( $rows )
		{
			foreach($rows as $row) {

				$user[$row['id']] = $row["first_name"]." ".$row['last_name'];

			}

			return $user;
		}

		return false;
	}

}