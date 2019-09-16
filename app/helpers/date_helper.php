<?php 

//Helper function for date format without time DD:MM:YYY
	 function dateShow($date){		
		$year = substr($date,0,4);
		$month = substr($date,5,2);
		$day = substr($date,8,2);
		return $day.".".$month.".".$year;

	}

  //Helper function for date format with time
	 function dateTimeShow($date){		
		$year = substr($date,0,4);
		$month = substr($date,5,2);
    $day = substr($date,8,2);
    $hour = substr($date, 11,2);
    $minutes = substr($date, 14,2);
		return $day.".".$month.".".$year." ".$hour.":".$minutes;

	}

?>