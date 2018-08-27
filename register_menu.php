<?php ///Register Menus
function register_menus() {
    register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_menus' );


//Add this to the location where you want your menu:

wp_nav_menu( array( 'theme_location' => 'main-menu' ) );