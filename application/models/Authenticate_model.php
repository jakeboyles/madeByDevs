<?php
class Authenticate_model extends MY_Model
{

	// Make Sure the User Can be Found ( Mainly Used for Logging In )
	public function login($email = FALSE, $password = FALSE)
	{
		// Make Sure We Have All the Fields We Need
		if($email == FALSE || $password == FALSE)
		{
			return false;
		}
		
		// Salt to Use for Password Hash
		$password = $this->password_hash( $password );

		// Look for a Match in The Database
		$this->db->select('id');
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$this->db->limit(1);
		$query = $this->db->get('users');
			
		// If a Match was Found, Return True		
		if($query->num_rows() > 0)
		{
			// Store variables
			$row = $query->row();
			$user_id = $row->id;

			// Update Last Login
			$data = array(
				'last_login' => $this->mysql_datetime()
			);
			$this->db->where('id',$user_id);
			$this->db->update('users',$data);

			// Return User ID
			return $user_id;
		}

		return false;
	}

}