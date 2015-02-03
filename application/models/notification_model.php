<?php
class Notification_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_records( $id )
	{
		// Construct Query
		$this->db->select('n.type,n.id,n.notification_id,n.type,nt.name');

		$this->db->join( 'notification_types nt', 'nt.id = n.type', 'left outer' );

		if(!empty($id)) {
			$this->db->where('n.user_id', $id ); 
		}
		
		// Run Query
		$query = $this->db->get( 'notifications n' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}

	public function add_notification($type,$user,$id)
	{

		if( $user )
		{
			// Insert Data
			$data = array(
				'type' => $type,
				'user_id' => $user,
				'notification_id' => $id,
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->db->insert('notifications',$data);

			return $this->db->insert_id();
		}

		return false;


	}


	public function delete_notification($id)
	{

		if( $id )
		{
			$this->db->where('notification_id', $id);
			$this->db->delete('notifications');
		}

		return false;


	}
	
}
