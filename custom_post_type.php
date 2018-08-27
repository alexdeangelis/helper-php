<?php
/**
*	Custom Post Type Example
*
*   Make sure to replace mentions of Testimonial with your new custom post type...
*   and replace acholidaydestinations with the name of your theme
*   
*/      
if ( ! function_exists('post_type_testimonials') ) {
    
    // Register Custom Post Type
	function post_type_testimonials() {
        
        $labels = array(
			'name'                  => _x( 'Testimonials', 'Post Type General Name', 'acholidaydestinations' ),
			'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'acholidaydestinations' ),
			'menu_name'             => __( 'Testimonials', 'acholidaydestinations' ),
			'name_admin_bar'        => __( 'Testimonials', 'acholidaydestinations' ),
			'archives'              => __( 'Testimonials', 'acholidaydestinations' ),
			'parent_item_colon'     => __( 'Testimonial', 'acholidaydestinations' ),
			'all_items'             => __( 'Testimonials', 'acholidaydestinations' ),
			'add_new_item'          => __( 'Add Testimonial', 'acholidaydestinations' ),
			'add_new'               => __( 'Add New Testimonial', 'acholidaydestinations' ),
			'new_item'              => __( 'New Item', 'acholidaydestinations' ),
			'edit_item'             => __( 'Edit Testimonial', 'acholidaydestinations' ),
			'update_item'           => __( 'Update Item', 'acholidaydestinations' ),
			'view_item'             => __( 'View Testimonial', 'acholidaydestinations' ),
			'search_items'          => __( 'Search Item', 'acholidaydestinations' ),
			'not_found'             => __( 'Not found', 'acholidaydestinations' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'acholidaydestinations' ),
			'featured_image'        => __( 'Featured Image', 'acholidaydestinations' ),
			'set_featured_image'    => __( 'Set featured image', 'acholidaydestinations' ),
			'remove_featured_image' => __( 'Remove featured image', 'acholidaydestinations' ),
			'use_featured_image'    => __( 'Use as featured image', 'acholidaydestinations' ),
			'insert_into_item'      => __( 'Insert into item', 'acholidaydestinations' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'acholidaydestinations' ),
			'items_list'            => __( 'Items list', 'acholidaydestinations' ),
			'items_list_navigation' => __( 'Items list navigation', 'acholidaydestinations' ),
			'filter_items_list'     => __( 'Filter items list', 'acholidaydestinations' ),
		);
        $rewrite = array(
			'slug'                  => 'testimonials',
			'with_front'            => false,
			'pages'                 => true,
			'feeds'                 => true,
		);
        $args = array(
			'label'                 => __( 'Testimonials', 'acholidaydestinations' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 10,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
			'capability_type'       => 'page',
		);
		register_post_type( 'testimonials', $args );
    }
	add_action( 'init', 'post_type_testimonials', 0 );
}