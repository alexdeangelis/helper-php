<?php

//If the function yoasttobottom() doesn't exist, do this...
if ( ! function_exists( 'yoasttobottom' ) ) {
    // Move Yoast Meta Box to bottom
    function yoasttobottom() {
        return 'low';
    }
    add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
    
} else { }