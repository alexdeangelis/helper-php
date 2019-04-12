<?php

//Get the Yoast primary category
if ( ! function_exists( 'get_primary_taxonomy_id' ) ) {
    function get_primary_taxonomy_id( $post_id, $taxonomy ) {
        $prm_term = '';
        if (class_exists('WPSEO_Primary_Term')) {
            $wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
            $prm_term = $wpseo_primary_term->get_primary_term();
        }
        if ( !is_object($wpseo_primary_term) || empty( $prm_term ) ) {
            $term = wp_get_post_terms( $post_id, $taxonomy );
            if (isset( $term ) && !empty( $term ) ) {
                return $term[0]->term_id;
            } else {
                return '';
            }
        }
        return $wpseo_primary_term->get_primary_term();
    }
}