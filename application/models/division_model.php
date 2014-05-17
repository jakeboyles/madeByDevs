<?php
class Division_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );

	// Get Divisions
	public function get_records( $limit = FALSE, $offset = FALSE )
	{
		$this->db->select( 'd.id, d.name, d.created, d.modified, l.name as league' );
		$this->db->join( 'leagues l', 'l.id = d.league_id' );

		// If Limit and Offset are Set ( For Pagination )
		if( is_int( $limit ) )
		{
			$this->db->limit( $limit, $offset );
		}
		
		// Run Query
		$query = $this->db->get( 'divisions d' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}

	// Add Division
	public function add_record( $post = FALSE )
	{
		if( $post )
		{
			// Insert Data
			$data = array(
				'league_id' => 1,
				'name' => $post['name'],
				'division_type' => empty( $post['division_type'] ) ? NULL : $post['division_type']
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->Division_model->insert( $data );

			return $insert_id;
		}

		return false;
	}

}