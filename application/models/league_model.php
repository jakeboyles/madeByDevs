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
		$this->db->select('
			l.current_season_id, l.id,l.weather_zipcode, l.name,
			s.name as current_season_name,l.previous_season_id, s.year_start as season_year_start, s.year_end as season_year_end, s.description as season_description
		');
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


	// Edit Record
	public function update_record( $id = FALSE, $post = FALSE )
	{
		if( $id && $post )
		{
			// Update Data
			$data = array(
				'name' => $post['name'],
				'current_season_id' => empty( $post['current_season_id'] ) ? NULL : $post['current_season_id'],
				'previous_season_id' => empty( $post['previous_season_id'] ) ? NULL : $post['previous_season_id'],
				'weather_zipcode' => empty( $post['weather'] ) ? NULL : $post['weather']
			);

			// Update Record in Database
			$this->update( $id, $data );

			return true;
		}

		return false;
	}


	public function get_weather( $zipcode = FALSE )
	{

		$zip = $this->get_records();
		$zipcode = $zip[0]['weather_zipcode'];


		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$zipcode.'&sensor=false';

		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);

		$result = json_decode($result,true);


		$url = 'api.openweathermap.org/data/2.5/weather?q='.$result['results'][0]['address_components'][1]['long_name'];

		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);

		$result = json_decode($result,true);

		// Will dump a beauty json :3
		return $result;
	}



}