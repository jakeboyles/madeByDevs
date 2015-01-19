<?php
class Comment_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_records( $atts = FALSE )
	{
		// Construct Query
		$this->db->select('p.title as project_title, p.id as project_id, u.id as user_id,c.id,c.author_id,c.comment,c.post,u.display_name,u.profile_pic,c.created_at,c.votes');

		$this->db->join( 'users u', 'u.id = c.author_id', 'left outer' );
		$this->db->join( 'projects p', 'p.id = c.post', 'left outer' );

		if(!empty($atts)) {
		$this->db->where( $atts ); 
		}
		

		// Run Query
		$query = $this->db->get( 'comments c' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}

	public function add_vote($id,$user, $down =false)
	{


		$this->db->select('*');

		$this->db->where('comment', $id['id']);
		$this->db->where('user',$id['user']);

		$query = $this->db->get( 'votes v' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			return array("votes" => true);
		}



		if($down==false)
		{
			$this->db->set('votes', 'votes+1',FALSE);
		}
		else 
		{
			$this->db->set('votes', 'votes-1',FALSE);
		}
		$this->db->where('id', $id['id']); // '1' test value here ?
		$this->db->update('comments');  

		// Insert Data
		$data = array(
			'comment' => $id['id'],
			'user' => $id['user'],
			'technology' => $id['tech'],
			'type' => $down,
		);

		// Insert to Database and Store Insert ID
		$insert_id = $this->db->insert('votes',$data);

		return true;
	}
	
}
