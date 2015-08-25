<?php
//Date helpers

function computeTimeInterval($out, $in){
    $interval = date_diff(new DateTime($in), new DateTime($out));
    return $interval;
}

function computeBreaks($out, $in, $required_break){
    $overbreak = \DateInterval::createFromDateString("00:00:00");
    $time_difference = date_diff(new DateTime($out), new DateTime($in))->format("%H:%I:%S");

    if($time_difference > $required_break){
        $overbreak = date_diff(new DateTime($required_break), new DateTime($time_difference));
    } 
    return $overbreak;
}

function toHours($date){
    $totalHours = 0;

    $days = (int)$date->format("%d");
    $hours = (int)$date->format("%h");
	$minute = (int)$date->format("%i");

    $totalHours = ($days * 24) + $hours + ($minute / 60);

    return round($totalHours, 2); 
}

function toMinutes($interval){
    $days = (int)$interval->format("%d");
    $hours = (int)$interval->format("%h");
    $minutes = (int)$interval->format("%i");

    return round(computeToMinutes($days, $hours, $minutes), 2);
}

function stringToMinutes($datetime){
    $days = date('D', strtotime($datetime));
    $hours = date('H', strtotime($datetime));
    $minutes = date('i', strtotime($datetime));
    
    return (int)computeToMinutes($days, $hours, $minutes); 
}

//
function computeToMinutes($days, $hours, $minutes){
    $total = (($days * 24) * 60) + ($hours * 60) + $minutes;
    return $total;
}

function incrementDateByOneDay($date){
    $date = new DateTime($date);
    $date->add(new DateInterval('P1D'));
    return $date->format("Y-m-d");
}
