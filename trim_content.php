<?php

$content = get_the_content();
$trimmed_content = wp_trim_words( $content, 12, '...' );