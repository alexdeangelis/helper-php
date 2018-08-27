<?php 

//Get the event field from ACF
$event_date = get_field('event_date');

//Create a DateTime object from the field. Use the return format found when setting up the field in ACF
$dateTime = DateTime::createFromFormat("d/m/Y g:i a", $event_date);

//If the DateTime object exists..
if ( is_object($dateTime) ) {
    //Get the Day in a specific format
    $day = $dateTime->format('d');
    //Get the Month in a specific format
    $month = $dateTime->format('M');
    //Get the year in a specific format
    //$year = $dateTime->format('Y');
  //...
}

?>