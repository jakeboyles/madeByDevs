<?php
class Leader_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_leader( $tech = false )
	{

		$this->db->select('name,id');

		// Run Query
		$query = $this->db->get( 'technology' );



		if($query->num_rows > 0)
		{

			$rows = $query->result_array();
			$all = array();		
			$itall = array();	

			if( $rows )
			{
				foreach($rows as $row) 
				{
					$leader['name'] = $row['name'];
					$query = $this->db->query("select users.id,users.profile_pic,users.display_name, count(user) as votes from votes LEFT OUTER JOIN users ON users.id = votes.user WHERE technology = ".$row['id']." group by user ORDER BY votes desc LIMIT 5");
					$leaders = $query->result_array();

					$leader['leaders'] =  $leaders;
					array_push($itall,$leader);
				}
			}

			return $itall;
		}



		return false;
	}



	
	
}
