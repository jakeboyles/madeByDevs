<?php
class Directions extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();

		// Load Models Needed
		$this->load->model('Location_model');
	}

	// Display the Location Search
	public function index()
	{
		// Store Data to Pass to View
		$data = array();

		// Load View
		$this->load->site_template( 'directions_search', $data );
	}

	// Find a List of Locations 
	public function ajax_search_locations()
	{
		$search = $this->input->post('search');

		if( $search )
		{
			$atts = array( 'where' => 'l.name LIKE \'%' . $search . '%\'' );

			$locations = $this->Location_model->get_records( FALSE, $atts );

			if( $locations )
			{
				$data['locations'] = $locations;
				$this->load->view( 'site/ajax-parts/location-search-results.php', $data );
			}
			else
			{
				echo 'No results found.';
			}
		}

		return false;
	}

	// View for Locations
	public function location( $id = FALSE )
	{
		if( $id && is_numeric( $id ) )
		{
			// Get This Location Data
			$atts = array( 'where' => 'id = ' . $id, 'single' => TRUE );
			$location = $this->Location_model->get_records( FALSE, $atts );
			echo '<pre>'; var_dump( $location ); echo '</pre>';

			// If a Location Was Found
			if( $location )
			{
				// Get Fields For this Location
				$fields = $this->Location_model->get_records( $id );
				echo '<pre>'; var_dump( $fields ); echo '</pre>';
			}
			
		}

	}

}