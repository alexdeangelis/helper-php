<?php 

// When you need to redirect the single pages of a custom post type somewhere eles
// For more info go here: https://www.daddydesign.com/wordpress/how-to-redirect-all-single-posts-of-a-custom-post-type-in-wordpress/
//You may need to reset permalinks....who knows?!

add_action( 'template_redirect', 'redirect_post_type_single' );
function redirect_post_type_single(){
    if ( ! is_singular( 'YOUR-CUSTOM-POST-TYPE' ) )
        return;
    wp_redirect( get_page_link( YOUR-PAGE-ID ), 301 );
    exit;
}

?>