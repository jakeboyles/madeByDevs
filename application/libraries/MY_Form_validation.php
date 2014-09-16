<?
class MY_Form_validation extends CI_Form_validation {
	// --------------------------------------------------------------------

	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	public function does_not_match($str, $field)
	{
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}

		$field = $_POST[$field];

		if($str===$field)
		{
            $this->set_message('does_not_match', 'Active season can not equal previous season.');
            return false;
		}
		else 
		{
			return true;
		}
	}
	
}
?>