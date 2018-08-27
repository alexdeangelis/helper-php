<?php

//Load CSS Stylesheet

function sebastianfaulks_scripts() {
    wp_enqueue_style( 'styles', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'sebastianfaulks_scripts' );

?>