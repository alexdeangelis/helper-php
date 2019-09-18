<?php

// Add scripts to wp_head()
function no_js_script() {
	if (!is_page('_fallback')) {
		echo '<noscript><meta http-equiv="refresh" content="2;url=/_fallback/" /></noscript>';
	} else {}
}
add_action( 'wp_head', 'no_js_script' );