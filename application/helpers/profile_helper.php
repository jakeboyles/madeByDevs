<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('profile_image'))
{
    function profile_image($image = '', $id = '')
    {

    	if(empty($image))
    	{
            return "<img src='http://placehold.it/300&text=No+Image'></a>";
    	}
        elseif($id != '')
        {
            return "<a href='/users/profile/".$id."'><img src='".$image."'></a>"; 
        }
    	else 
    	{
            return "<img src='".$image."'>";
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