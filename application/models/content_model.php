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

	// Get Posts By Category ID
	public function get_posts_by_category_id( $category_id, $limit = FALSE )
	{
		if( $category_id )
		{
			// Get a List of Posts For this Category
			$this->db->select('
				p.id, p.author_id, p.title, p.slug, p.content, p.created_at, p.created_by, p.modified_at, p.modified_by, 
				CONCAT(u.first_name, " ", u.last_name) as author, u.email as author_email
			', FALSE);
			$this->db->join( 'posts p', 'p.id = pc.post_id', 'left outer' );
			$this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );
			$this->db->order_by( 'p.created_at', 'DESC' );
			$this->db->where( array( 'pc.category_id' => $category_id, 'p.post_type' => 'post' ) );

			// If a Limit is Set
			if( $limit && is_array( $limit ) )
			{
				if( count( $limit ) == 1 )
				{
					$this->db->limit( $limit[0] );
				}
				elseif( count( $limit ) == 2 )
				{
					$this->db->limit( $limit[0], $limit[1] );
				}
				
			}

			// Store Query
			$query = $this->db->get( 'post_categories pc' );

			// If Rows were Found, Return Them
			if($query->num_rows > 0)
			{
				$rows = $query->result_array();
				return $rows;
			}
		}

		return false;
	}

	// Get a Single Category By a Category Slug
	public function get_category_by_slug( $category_slug )
	{
		if( $category_slug )
		{
			$this->db->select( 'c.id, c.name, c.slug, c.created_at, c.created_by, c.modified_at, c.modified_by' );
			$this->db->where( 'slug', $category_slug );
			$query = $this->db->get( 'categories c' ); 

			// If A Record Is Found, Return It
			if($query->num_rows > 0)
			{
				$row = $query->row_array();
				return $row;
			}
		}

		return false;
	}

	// Get the Number Of Posts in a Category By Category ID
	public function get_post_count( $category_id )
	{
		$this->db->where( 'category_id', $category_id );
		$count = $this->db->count_all_results( 'post_categories' );

		if( $count )
		{
			return $count;
		}

		return false;
	}
}