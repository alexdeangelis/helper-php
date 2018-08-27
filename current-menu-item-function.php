<?php
/* 
 * Customize Menu Item Classes
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-which-menu-item-is-marked-active/
 *
 * @param array $classes, current menu classes
 * @param object $item, current menu item
 * @param object $args, menu arguments
 * @return array $classes
 */

//Keeps the menu item highlighted//

function be_menu_item_classes( $classes, $item, $args ) {
	global $post;
	if( ( in_category('about') ) && !is_home() && 'Marian' == $item->title || is_singular( 'books' ) && 'Books' == $item->title || is_post_type_archive( 'books' ) && 'Books' == $item->title || is_singular( 'post' ) && !in_category('about') && 'News' == $item->title )
		$classes[] = 'current-menu-item';
		
		
	return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'be_menu_item_classes', 10, 3 );

?>