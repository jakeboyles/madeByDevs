<?php
class User_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_records( $id)
	{
		// Construct Query
		$this->db->select('
			u.id, u.email, u.user_type_id, u.profile_pic, u.first_name, u.last_name,u.display_name
		');
		$this->db->join( 'user_types ut', 'ut.id = u.user_type_id', 'left outer' );

		// Look for Custom Where Query
		if( !empty( $id) )
		{
			$this->db->where('u.id',$id ); 
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
				'user_type_id' => 2,
				'email' => $post['email'],
				'password' => $this->password_hash( $post['password'] ),
				'display_name' => $post['name'],
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->db->insert('users',$data);

			return $insert_id;
		}

		return false;
	}


	// Add Record
	public function insert_record_fb( $post = FALSE )
	{
		if( $post )
		{
			// Insert Data
			$data = array(
				'user_type_id' => 1,
				'password' => '0',
				'display_name' => $post->displayName,
				'hybridauth_provider_uid' => $post->identifier,
				'profile_pic' => $post->photoURL,
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->db->insert('users',$data);

			$this->_login($post->email, $id);

			return $insert_id;
		}

		return false;
	}


	public function insert_record_tw( $post = FALSE )
	{

		if( $post )
		{
			// Insert Data
			$data = array(
				'user_type_id' => 1,
				'email' => $post->email,
				'password' => '0',
				'display_name' => $post->displayName,
				'hybridauth_provider_uid' => $post->identifier,
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->db->insert('users',$data);

			$this->login($post->email, $id);

			return $insert_id;
		}

		return false;
	}



	public function is_in_db($id)
	{

		// Construct Query
		$this->db->select('
			u.id, u.email, u.user_type_id, u.hybridauth_provider_uid
		');
		// $this->db->join( 'user_types ut', 'ut.id = u.user_type_id', 'left outer' );

		$this->db->where('hybridauth_provider_uid', $id);

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
			return $rows[0];
		}
		else 
		{
			return false;
		}



	}





	// Edit Record
	public function update_record( $id = FALSE, $post = FALSE )
	{


		if( $id && $post )
		{

			if($_FILES['image']['error'] == 0) {

				foreach($_FILES as $key => $photo) 
				{
					if($key=='image'){
						$image = $this->_add_image($post,$key);
					}
				}

				// Update Data
				$data = array(
					'email' => $post['email'],
					'display_name' => $post['name'],
					'profile_pic' => "/uploads/".$image
				);

			}

			else 
			{
				// Update Data
				$data = array(
					'email' => $post['email'],
					'display_name' => $post['name'],
				);
			}



			


			// Update Record in Database
			$this->db->where("id",$id);

			$this->db->update('users', $data );

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


	private function _login($email, $id)
	{			
		// Store Session
		$this->session->set_userdata( array(
			'email' => $email,
			'user_id' => '2',
			'user_type_id' => '1',
		) );
	}


	private function _add_image($post, $name)
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '25048';

		$this->load->library('upload', $config);

			// The field name for the file upload would be logo
			if ( ! $this->upload->do_upload($name))
			{
				return $this->upload->display_errors('<li>', '</li>');
			}
			else
			{
				$image = array('upload_data' => $this->upload->data());

				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/'. $image['upload_data']['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 500;
				$config['height'] = 300;

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();


				return $image['upload_data']['file_name'];

				

			}
	}

}
