<?php
class Question_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_records( $where = FALSE )
	{
		// Construct Query
		$this->db->select('q.id,q.pictures,q.answer,q.asker,q.question,u.profile_pic');

		$this->db->join( 'users u', 'u.id = q.asker', 'left outer' );

		if(!empty($where)) {
			$this->db->where( $where ); 
		}
		
		// Run Query
		$query = $this->db->get( 'questions q' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}

	public function add_question($id,$post)
	{

		if( $post )
		{

			$images = array();
			foreach($_FILES as $key => $photo) 
			{

				if($key=='picture' && $photo['error'] == '0' ){
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
				'asker' => $this->session->userdata('user_id'),
				'project_id' => $id,
				'question' => $post['question'],
				'status' =>  0,
				'date_posted' =>date("Y-m-d H:i:s"),
				'pictures' => json_encode($images),
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->db->insert('questions',$data);

			return $this->db->insert_id();
		}

		return false;


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
