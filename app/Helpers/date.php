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
