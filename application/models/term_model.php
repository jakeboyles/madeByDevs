<?php
class Term_model extends MY_Model
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
		$this->db->select( 'id, name, slug, created_at, created_by, modified_at, modified_by' );

		// Run Query
		$query = $this->db->get( 'terms t' );

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
			// Determine URL Slug
			$slug = empty( $post['slug'] ) ? $post['name'] : $post['slug'];
			$slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); // Removes special chars
			$slug = strtolower( $slug ); // conver the string to all lower case

			// Insert Data
			$data = array(
				'name' => empty( $post['name'] ) ? NULL : $post['name'],
				'slug' => $slug
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
			// Determine URL Slug
			$slug = empty( $post['slug'] ) ? $post['name'] : $post['slug'];
			$slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); // Removes special chars
			$slug = strtolower( $slug ); // conver the string to all lower case

			// Update Data
			$data = array(
				'name' => empty( $post['name'] ) ? NULL : $post['name'],
				'slug' => $slug
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
		// If an ID Was Found in URL
		if( $id )
		{
			$this->delete( $id );
		}

		return false;
	}

	// Get a List of Categories
	public function get_categories()
	{
		$this->db->select( 'id, name, slug, created_at, created_by, modified_at, modified_by' );
		$query = $this->db->get( 'terms' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}

}