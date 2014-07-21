<?php
class Page extends Site_Controller
{
	public function index( $slug = false )
	{
		//echo 'hello';
		echo '<pre>'; var_dump( $slug ); echo '</pre>';
	}
}