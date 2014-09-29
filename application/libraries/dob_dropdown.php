<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dob_dropdown{
	
	public function buildDayDropdown($name='',$id='',$value='')
	{
		$days='';
		while ( $days <= '31')
		{
		if($days>0)
		{
		$day[$days]=$days;
		}else{
		}
		$days++;
		}
		$id = 'id='.$id;
		return $day;
	}

	function buildYearDropdown($name='',$id='',$value='')
	{
		$years = range(1900, date("Y"));
		array_unshift($years, 'Select a year');
		foreach($years as $year)
		{
		if($year == 'Select a year'){
		}else{
		$year_list[$year] = $year;
		}
		}
		$id = 'id='.$id;
		return $year_list;
	}


	function buildMonthDropdown($name='',$id='',$value='')
	{
			$month=array(
			'01'=>'Jan',
			'02'=>'Feb',
			'03'=>'Mar',
			'04'=>'Apr',
			'05'=>'May',
			'06'=>'Jun',
			'07'=>'Jul',
			'08'=>'Aug',
			'09'=>'Sep',
			'10'=>'Oct',
			'11'=>'Nov',
			'12'=>'Dec');
			$id = 'id='.$id;
			return $month;
	}
}