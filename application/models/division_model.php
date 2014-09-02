<?php
class Division_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';

	// Get Records
	public function get_records( $atts = FALSE )
	{
		// Construct Query
		$this->db->select( 'd.id, d.name,d.description, d.created_at, d.modified_at, dt.type as division_type' );
		$this->db->join( 'division_types dt', 'dt.id = d.division_type_id', 'left outer' );

		// Check for a Custom Where Query
		if( !empty( $atts['where'] ) )
		{
			$this->db->where( $atts['where'] );
		}

		// Run Query
		$query = $this->db->get( 'divisions d' );

		// If Rows Were Found, Return Them
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

	// Add Record
	public function insert_record( $post = FALSE )
	{
		if( $post )
		{
			// Insert Data
			$data = array(
				'name' => $post['name'],
				'division_type_id' => empty( $post['division_type'] ) ? NULL : $post['division_type'],
				'description' => empty( $post['description'] ) ? NULL : $post['description']
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			if(!empty($post['divisions']))
			{
				foreach($post['divisions'] as $key=>$value) 
				{
					$data2 = array(
						'session_id' => $value,
						'division_id' => $insert_id,
					);

					$insert_id2 = $this->insert( $data2, FALSE, 'session_divisions' );
				}
			}

			return $insert_id;
		}

		return false;
	}

	// Edit Record
	public function update_record( $id = FALSE, $post = FALSE )
	{
		if( $id && $post )
		{
			// Update Data
			$data = array(
				'name' => $post['name'],
				'division_type_id' => empty( $post['division_type'] ) ? NULL : $post['division_type']
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
		// To Do: This will all change based on new databse relationship structure
		// If an ID Was Found in URL
		if( $id )
		{
			// If this ID Belongs to Other Tables - Dont Delete It
			// @ return: Return a string of error for ajax
			if( 
				$this->count_by( array( 'table' => 'games', 'where' => 'division_id = ' . $id ) ) > 0 
				|| $this->count_by( array( 'table' => 'teams', 'where' => 'division_id = ' . $id ) ) > 0
			)
			{
				echo 'error';
			}
			// Else Delete It from Database
			else
			{
				// Remove Session Division Relationships
				$this->db->where( 'division_id', $id );
				$this->db->delete( 'session_divisions' );

				// Remove Division
				$this->Division_model->delete( $id );
			}
		}

		return false;
	}


	// Get Divisions in session
	public function get_divisions( $id = FALSE )
	{

		$this->db->select( 'sd.division_id,d.name' );
		$this->db->join( 'divisions d', 'd.id = sd.division_id', 'left outer' );
		$this->db->where( 'session_id' , $id );
		$query= $this->db->get('session_divisions sd');

		$divisions = array();

		$rows = $query->result_array();


		if( $rows )
		{
			foreach($rows as $row) 
			{
				$divisions[$row['division_id']] = $row["name"];
			}

			return $divisions;

		}

		return false;
	}

}