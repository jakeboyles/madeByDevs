<?php
class Project_model extends MY_Model
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
			p.author_id,p.id, p.description,p.date_posted,u.display_name as name,t.id as techid, t.name as technology,p.pictures,p.title,p.github');

		 $this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );
		 $this->db->join( 'technology t', 't.id = p.technology', 'left outer' );

		 if(!empty($atts)) {
			$this->db->where( $atts ); 
		}
		

		// Run Query
		$query = $this->db->get( 'projects p' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}


	// Get Records
	public function get_by_tech()
	{
		// Construct Query
		$this->db->select('
			p.id, p.description,p.date_posted,u.display_name as name,t.id as techid,t.name as technology,p.pictures,p.title,p.github');

		 $this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );
		 $this->db->join( 'technology t', 't.id = p.technology', 'left outer' );

		// Look for Custom Where Query

		$this->db->where( 'technology', $this->input->post('technology') ); 


		// Run Query
		$query = $this->db->get( 'projects p' );

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



			$images = array();



			foreach($_FILES as $key => $photo) 
			{
				if($key!='logo' && $photo['error'] == '0' ){
					$image = $this->_add_image($post,$key);

					if(!empty($image))
					{

						$image = array(
						    "image" => $image,
						);

						array_push($images,$image);
					}
				}
			}


			// Insert Data
			$data = array(
				'description' => $post['description'],
				'technology' => $post['technology'],
				'author_id' => $this->session->userdata('user_id'),
				'pictures' => json_encode($images),
				'github' => $post['github'],
				'title' => $post['title'],
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->db->insert('projects',$data);

			return $this->db->insert_id();
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


	public function add_comment($post, $id)
	{
		// Insert Data
			$data = array(
				'comment' => $post['comment'],
				'post' => $id,
				'author_id' => $this->session->userdata('user_id'),
				'created_at' => date("y/m/d h:i:s"),
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->db->insert('comments',$data);

			return $this->db->insert_id();
	}


	private function _login($email, $id)
	{			
		// Store Session
		$this->session->set_userdata( array(
			'email' => $email,
			'user_id' => '2'
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
