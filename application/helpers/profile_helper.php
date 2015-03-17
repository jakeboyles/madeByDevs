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


if ( ! function_exists('project_image'))
{
    function project_image($image = '')
    {

        if(!empty($image))
        {
        return "<img src='".base_url('uploads').'/'.$image."'>";
        }
        else 
        {
            return "<img src='http://placehold.it/500x300&text=No+Image'>";
        }
    }   
}