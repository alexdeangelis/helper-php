<?php

//In functions.php

//Reading time functions
if (!function_exists('get_the_reading_time')):
	function get_the_reading_time($text){
 
		// Round fractions up so the minimum read time is 1 minute
		$readtime = ceil(str_word_count($text)/200);
		if ($readtime == 1){
			$readtime = $readtime . ' min read';
		}else{
			$readtime = $readtime . ' min read';
		}
		return $readtime;
	}
endif;


//On template file

echo get_the_reading_time(get_the_content());