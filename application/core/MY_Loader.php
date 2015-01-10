<?php
class MY_Loader extends CI_Loader {

	public function site_template($template_name, $vars = array(), $return = FALSE)
	{
		$content  = $this->view('site/_header', $vars, $return);
		$content .= $this->view('site/' . $template_name, $vars, $return);
		$content .= $this->view('site/_sidebar', $vars, $return);
		$content .= $this->view('site/_footer', $vars, $return);

		if ($return)
		{
			return $content;
		}
	}

	public function admin_template($template_name, $vars = array(), $return = FALSE)
	{
		$content  = $this->view('admin/_header', $vars, $return);
		$content .= $this->view('admin/_sidebar', $vars, $return);
		$content .= $this->view('admin/' . $template_name, $vars, $return);
		$content .= $this->view('admin/_footer', $vars, $return);

		if ($return)
		{
			return $content;
		}
	}

}