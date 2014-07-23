<?php
class Content_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Page
	public function get_page( $slug = FALSE )
	{
		if( $slug )
		{
			$this->db->select('
				p.id, p.post_type, p.author_id, p.title, p.content, p.slug, p.created_at, p.modified_at, 
				CONCAT(u.first_name, " ", u.last_name) as author, u.email as author_email
			', FALSE);
			$this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );
			$this->db->where( 'slug', $slug );
			$query = $this->db->get( 'posts p' );

			if($query->num_rows > 0)
			{
				$row = $query->row_array();
				return $row;
			}

		}

		return false;
	}
}