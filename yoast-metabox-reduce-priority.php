<?php

// Move Yoast Meta Box to bottom of post
if ( ! function_exists( 'yoasttobottom' ) ) {
    function yoasttobottom() {
        return 'low';
    }
    add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
} else { }