<?php 

//This is the argument that defines the new WP Query
$args = array(
    'posts_per_page'    => -1, //The number of posts to get. -1 means get all
    'post_type'         => 'books', //The post type goes here
    'offset'            => 1, //Use this to ignore the first, or however many posts you want
    'order'             => 'DESC', //Designates the ascending or descending order of the 'orderby' parameter
    'orderby'           => 'date', //Sort retrieved posts by parameter. Default is date
);


//For more info on everything WP Query, go to https://gist.github.com/luetkemj/2023628

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