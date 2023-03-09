<?php 

function DateFormatToEU($date) {
    $dateFormat = strtotime($date);

    $dateEuFormat = date('d/m/Y',$dateFormat);

    echo $dateEuFormat;
}

function ConvertMinToHour($time) {
    $min = $time % 60;
    $hour = $time/60;
    $hour = floor($hour);

    if ($hour > 0) {
        echo $hour . "H ";
    }
    if ($min > 0) {
        echo $min . " min";
    } 
}

?>