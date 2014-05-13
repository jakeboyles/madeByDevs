<?php
class Divisions_model extends MY_Model
{

	// Get Divisions
	public function get_divisions( $limit = FALSE, $offset = FALSE )
	{
		$this->db->select( 'divisions.id, divisions.name, divisions.created, divisions.modified, league.name as league' );
		$this->db->join( 'league', 'league.id = divisions.league_id' );

		// If Limit and Offset are Set ( For Pagination )
		if( is_int( $limit ) )
		{
			$this->db->limit( $limit, $offset );
		}
		
		// Run Query
		$query = $this->db->get( 'divisions' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}

}