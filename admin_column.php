<?php

// Replace 'deals' with the name of the custom post type
// 'end_date' is the new column to add
// First function creates the column
// Second function populates the column with data.

// Extra Deals Admin Columns
function add_deals_columns ( $columns ) {
	unset( $columns['date'] );
	$columns['end_date'] = __( 'End Date', 'tf-happy-foodie-2021' );
  $columns['date'] = __( 'Date', 'tf-happy-foodie-2021' );
	return $columns;
}
add_filter ( 'manage_deals_posts_columns', 'add_deals_columns' );

// Add content to Extra Deals Column
function deals_custom_column ( $column, $post_id ) {
	switch ( $column ) {
		case 'end_date':
			echo get_field ( 'hf_deal_end_date',$post_id );
			break;
	}
}
add_action ( 'manage_deals_posts_custom_column', 'deals_custom_column', 10, 2 );