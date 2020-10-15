<?php

$content = get_the_content();
$trimmed_content = wp_trim_words( $content, 12, '...' );

// Trim excerpt, or trim content

if (has_excerpt()) {
	$content = get_the_excerpt();
	$trimmed_content = wp_trim_words( $content, 30, '...' );
} else {
	$content = get_the_content();
	$trimmed_content = wp_trim_words( $content, 30, '...' );
}