<?php
class Cms extends Site_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Content Model
		$this->load->model('Content_model');
	}

	// Figure Out How to Route the Content
	public function index()
	{
		// Set Vars
		$uri_segment_count = $this->uri->total_segments();
		$first_segment = $this->uri->segment(1);

		// Load Category Archive
		if( $uri_segment_count == 2 && $first_segment == 'category' )
		{
			$this->category();
		}
		// Load Page
		elseif ( $uri_segment_count == 1 && $first_segment != 'category' )
		{
			$this->page();
		}
		// Load 404 Page
		else
		{
			$this->not_found();
		}
	}

	// Page or Post Display
	public function page()
	{
		// Get Page
		$page_slug = $this->uri->segment(1);
		$data['page'] = $this->Content_model->get_page( $page_slug );

		// Load Page If One was Found
		if( $data['page'])
		{
			// Store Page Title
			$data['page_title'] = $data['page']['title'];

			// Load Page View
			if( $data['page']['post_type'] == 'page' )
			{
				$this->load->site_template( 'page', $data );
			}
			// Load Post View 
			elseif( $data['page']['post_type'] == 'post' )
			{
				$this->load->site_template( 'page', $data );
			}
		}
		// Else Load 404 Page
		else
		{
			$this->not_found();
		}
	}

	// Category Archive Display
	public function category()
	{
		// Get Category
		$category_slug = $this->uri->segment(2);

		// See If This Category Slug Exists
		$data['category'] = $this->Content_model->get_category_by_slug( $category_slug );

		// If Category Was found Load Archive View
		if( $data['category'] )
		{
			// Get A List of Posts For this Category
			$data['posts'] = $this->Content_model->get_posts_by_category_id( $data['category']['id'] );
			
			// Load View
			$data['page_title'] = $data['category']['name'] . ' Archive';
			$this->load->site_template( 'archive', $data );
		}
		// Else Load 404 Page
		else
		{
			$this->not_found();
		}
	}

	// Load 404 Page
	public function not_found()
	{
		$data['page_title'] = 'Page Not Found';
		$this->load->site_template( '404', $data );
	}

	// Load Sample/Boilerplate Page
	// To Do: Remove this and make via CMS
	public function sample()
	{
		$this->load->site_template( 'sample' );
	}
}