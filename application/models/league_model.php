<?php
class League_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Fetch League
	public function get_records( $atts = FALSE )
	{
		// Determine the Active Season
		$this->db->select( 'l.current_season_id, s.name, s.year_start, s.year_end, s.description' );
		$this->db->join( 'seasons s', 's.id = l.current_season_id' );

		// Set Custom Where Clause if Defined
		if( !empty( $atts['where'] ) )
		{
			$this->db->where( $atts['where'] );
		}

		$query = $this->db->get( 'leagues l' );

		if($query->num_rows > 0)
		{
			if( !empty( $atts['single'] ) )
			{
				$row = $query->row_array();
				return $row;
			}
			else
			{
				$rows = $query->result_array();
				return $rows;
			}
			
		}

		return false;
	}
}