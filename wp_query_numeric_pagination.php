<?php

//Numeric Pagination


//Add this function to your functions.php file

function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}



//add this above the $args = array( ... ) section of your wp_query

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;



//add this inside the $args = array ( ... ) section

'paged' => $paged,



//add this after both the while statement and the surounding if ( $the_query->have_posts() ) statement

//replace $the_query with whatever you have called the variable for your 'new WP_Query'

pagination_bar( $the_query );

