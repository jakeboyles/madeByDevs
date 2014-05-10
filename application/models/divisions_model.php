<?php
class Divisions_model extends CI_Model
{

	// Get Divisions
	public function get_divisions()
	{
		$this->db->select( 'divisions.id, divisions.name, divisions.created, divisions.modified, league.name as league' );
		$this->db->join( 'league', 'league.id = divisions.league_id' );
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