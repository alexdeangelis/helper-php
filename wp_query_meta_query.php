<?php

//This is an example of a WP Query with 2 additional queries

$args = array(
    'posts_per_page'  => -1,
    'order'           => 'ASC',
    'post_type'       => 'shows',
    'meta_key'    => 'show_time',
    'meta_query' => array(
        'relation' => 'AND', //The logical relationship between each inner taxonomy array when there is more than one
        array(
            'key' => 'show_type', //Define the first field to filter by. This is a field within the post type above
            'value' => 'Streaming', //Value of the key defined above
            'compare' => '='
        ),
        array(
            'key' => 'show_time', //Define the second field to filter by.
            'value' => date("d/m/Y g:i a"), //Value of the key defined above
            'compare' => '>=',
            'type' => 'DATE' // (string) - Custom field type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'.
        )
      )
    ); 

$the_query = new WP_Query( $args );

//The IF statement, using the WP Query
//If the WP Query bring back any results, do this...
if ( $the_query->have_posts() ) {
    
    //This is the start of the cutom loop
    while( $the_query->have_posts() ) {
        
        $the_query->the_post();
        
        //In here $post will bring back the post specific to the custom WP Query
       
    } 
}

//Can put an else statement here to do somehting if no posts are found.


//This resets the post data so that $post will work correctly on the page
wp_reset_postdata();
?>