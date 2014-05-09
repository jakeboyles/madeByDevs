<?php
class MY_Loader extends CI_Loader {

	public function template($template_name, $vars = array(), $return = FALSE)
	{
		$content  = $this->view('header', $vars, $return);
		$content .= $this->view($template_name, $vars, $return);
		$content .= $this->view('footer', $vars, $return);

		if ($return)
		{
			return $content;
		}
	}

	public function admin_template($template_name, $vars = array(), $return = FALSE)
	{
		$content  = $this->view('admin/header', $vars, $return);
		$content  = $this->view('admin/sidebar', $vars, $return);
		$content .= $this->view('admin/' . $template_name, $vars, $return);
		$content .= $this->view('admin/footer', $vars, $return);

		if ($return)
		{
			return $content;
		}
	}

}