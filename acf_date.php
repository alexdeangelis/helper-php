<?php

// This compares an ACF date field with today's date :)

$today = date('Ymd');
$event_args = array(
    'posts_per_page'  => -1,
    'post_type'       => 'post',
    'orderby' => 'meta_value',
    'tax_query' => array (
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array( 'events' ),
            'include_children' => true,
            'operator' => 'IN'
        ),
    ),
    //'meta_key'    => 'event_start_date',
    'meta_query' => array(
        array(
            'key' => 'event_start_date', //Define the second field to filter by.
            'value' => $today, //Value of the key defined above
            'compare' => '>=',
            'type' => 'DATE' // (string) - Custom field type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'.
        )
    )
);