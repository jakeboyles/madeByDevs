<?php
class Authenticate_model extends MY_Model
{

	// Make Sure the User Can be Found ( Mainly Used for Logging In )
	public function login( $email = FALSE, $password = FALSE )
	{
		// Make Sure We Have All the Fields We Need
		if($email == FALSE || $password == FALSE)
		{
			return false;
		}
		
		// Salt to Use for Password Hash
		$password = $this->password_hash( $password );


		// Look for a Match in The Database
		$this->db->select( 'id, user_type_id' );
		$this->db->where( 'email', $email );
		$this->db->where( 'password', $password );
		$this->db->limit(1);
		$query = $this->db->get( 'users' );
			
		// If a Match was Found, Return True		
		if($query->num_rows() > 0)
		{
			// Store variables
			$row = $query->row_array();
			//$user_id = $row->id;

			// Update Last Login
			// $data = array(
			// 	'last_login' => $this->mysql_datetime()
			// );
			$this->db->where( 'id', $row['id'] );

			// Return User ID
			return $row;
		}

		return false;
	}

	// Make Sure the User Has Access
	public function has_admin_access( $email )
	{

	}

}