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
		$data['locations'] = $this->Location_model->get_records();

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

	// View for a Single Location
	public function location( $id = FALSE )
	{
		$data = array();

		if( $id && is_numeric( $id ) )
		{
			// Get This Location Data
			$atts = array( 'where' => 'id = ' . $id, 'single' => TRUE );
			$data['location'] = $this->Location_model->get_records( FALSE, $atts );

			// If a Location Was Found
			if( $data['location'] )
			{
				// Get Fields For this Location
				$data['fields'] = $this->Location_model->get_records( $id );
			}

		}

		// Load Location View
		$this->load->site_template( 'directions_location', $data );
	}

	// View for a Single Field
	public function field( $id = FALSE )
	{
		$data = array();

		if( $id && is_numeric( $id ) )
		{
			// Get This Field Data
			$data['field'] = $this->Location_model->get_field( $id );

			// Get The Parent Locations Data
			$atts = array( 'where' => 'id = ' . $data['field']['parent_id'], 'single' => TRUE );
			$data['location'] = $this->Location_model->get_records( FALSE, $atts );
		}

		// Load Location View
		$this->load->site_template( 'directions_field', $data );
	}

}