<?php 

//Get the event field from ACF
$event_date = get_field('event_date');

//Create a DateTime object from the field. Use the return format found when setting up the field in ACF
$event_dateTime = DateTime::createFromFormat("d/m/Y g:i a", $event_date);

//If the DateTime object exists, get an element of the date in a certain format
if ( is_object($event_dateTime) ) {
    //Get the Day in a specific format
    $day = $event_dateTime->format('d');
    //Get the Month in a specific format
    $month = $event_dateTime->format('M');
    //Get the year in a specific format
    //$year = $dateTime->format('Y');
  //...
}



//This gets the current time
$current_dateTime = new DateTime();


// If the event time is in the future, do somthing
if ($event_dateTime > $current_dateTime) {

} else {
    /*Nothing*/
}


//This argument gets all posts between two dates

$args = array(
    'posts_per_page' => -1,
    'post_type'      => 'post',
    'meta_query' => array(
        //current date is after event start date
        array(
            'key' => 'event_start_date', // name of custom field
            'value' => date('Y-m-d H:i:s'),
            'compare' => '<',
            'type' => 'DATETIME'
        ),
        //current date is before event end date
        array(
            'key' => 'event_end_date', // name of custom field
            'value' => date('Y-m-d H:i:s'),
            'compare' => '>',
            'type' => 'DATETIME'
        )
    )
);

?>