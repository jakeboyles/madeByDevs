<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('profile_image'))
{
    function profile_image($image = '')
    {

    	if(!empty($image))
    	{
        return "<img src='".$image."'>";
    	}
    	else 
    	{
    		return "<img src='http://placehold.it/300&text=No+Image'>";
    	}
    }   
}