<?php

//Use this in functions.php to create an options settings page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

//Use this to call the field
the_field('field_name', 'option');

?>