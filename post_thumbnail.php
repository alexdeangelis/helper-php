<?php 
            
//If there is a featured image do this...
if( get_the_post_thumbnail() ) {

    //Gets the URL of the featured image...
    
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    echo $url;

} 

//If there isn't a featured image do this...

else { 

    //Do something else...
    
}


///OR use

the_post_thumbnail();

//to get the img object


?>

