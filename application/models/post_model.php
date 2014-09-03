<?php
class Post_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	//public $before_dropdown = array( 'order_by(name)' );

	// Get Records
	public function get_records( $post_type = false )
	{
		// Construct Query
		$this->db->select( 'p.id, p.post_type, p.author_id, p.title, p.content, p.slug, p.created_at, p.modified_at, u.first_name as author_first_name, u.last_name as author_last_name' );
		$this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );

		if( $post_type )
		{
			$this->db->where( 'post_type', $post_type );
		}

		// Run Query
		$query = $this->db->get( 'posts p' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}

	// Add Record
	public function insert_record( $post = FALSE, $post_type = FALSE )
	{
		if( $post && $post_type )
		{
			// Determine URL Slug
			$slug = empty( $post['slug'] ) ? $post['title'] : $post['slug'];
			$slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); // Removes special chars
			$slug = strtolower( $slug ); // conver the string to all lower case

			// Insert Data
			$data = array(
				'post_type' => $post_type,
				'author_id' => $this->session->userdata('user_id'),
				'title' => empty( $post['title'] ) ? NULL : $post['title'],
				'slug' => $slug,
				'content' => empty( $post['content'] ) ? NULL : $post['content']
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			// Assign Categories to the Post
			if( !empty( $post['categories'] ) )
			{
				foreach( $post['categories'] as $category_id )
				{
					$post_categories[] = array(
						'post_id' => $insert_id,
						'category_id' => $category_id,
						'created_at' => $this->mysql_datetime(),
						'created_by' => $this->session->userdata( 'user_id' )
					);
				}
				$this->db->insert_batch( 'post_categories', $post_categories ); 
			}

			// Return Insert ID
			return $insert_id;
		}

		return false;
	}

	// Edit Record
	public function update_record( $id = FALSE, $post = FALSE )
	{
		if( $id && $post )
		{
			// Determine URL Slug
			$slug = empty( $post['slug'] ) ? $post['title'] : $post['slug'];
			$slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); // Removes special chars
			$slug = strtolower( $slug ); // conver the string to all lower case

			// Update Data
			$data = array(
				'title' => empty( $post['title'] ) ? NULL : $post['title'],
				'slug' => $slug,
				'content' => empty( $post['content'] ) ? NULL : $post['content']
			);

			// Update Record in Database
			$this->update( $id, $data );

			// Delete Previous Categories From this Post
			$this->db->where( 'post_id', $id );
			$this->db->delete( 'post_categories' );

			// Assign Categories to the Post
			if( !empty( $post['categories'] ) )
			{
				foreach( $post['categories'] as $category_id )
				{
					$post_categories[] = array(
						'post_id' => $id,
						'category_id' => $category_id,
						'created_at' => $this->mysql_datetime(),
						'created_by' => $this->session->userdata( 'user_id' )
					);
				}
				$this->db->insert_batch( 'post_categories', $post_categories ); 
			}		

			// Return True
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
			// Delete Relationships from the post_categories table First
			$this->db->where( 'post_id', $id );
			$this->db->delete( 'post_categories' );

			// Delete Actual Post
			$this->delete( $id );
		}

		return false;
	}

	// Get Categories By Post ID
	public function get_post_categories( $post_id = FALSE )
	{	
		$this->db->select( 'c.id, c.name, c.slug, c.created_at, c.created_by, c.modified_at, c.modified_by' );
		$this->db->join( 'categories c', 'c.id = pc.category_id', 'left outer' );
		$this->db->where( 'post_id', $post_id );
		$query = $this->db->get( 'post_categories pc' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();

			$categories = array();
			foreach( $rows as $row )
			{
				$categories[$row['id']] = $row;
			}
			return $categories;
		}

		return false;
	}

	public function record_count($post_type) {
		if( $post_type )
		{
			$this->db->where( 'post_type', $post_type );
		}
        return $this->db->count_all_results("posts p");
    }


	public function fetch_posts($limit, $start, $post_type) {

		$this->db->limit($limit, $start);
        $this->db->select( 'p.id, p.post_type, p.author_id, p.title, p.content, p.slug, p.created_at, p.modified_at, u.first_name as author_first_name, u.last_name as author_last_name' );
		$this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );

		if( $post_type )
		{
			$this->db->where( 'post_type', $post_type );
		}

		// Run Query
		$query = $this->db->get( 'posts p' );

 
		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}
}