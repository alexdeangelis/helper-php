<?php

$json_url = false;
$json_url = 'https://www.a-json.url.com';

if ($json_url) {
    $request = false;
    /*THE JSON CALL!*/
    $request = wp_remote_get( $json_url );

    if( is_wp_error( $request ) ) {
        return false; // Bail early
    }

    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body );
    if( ! empty( $data ) ) {
        
        //Var_dump json object
        var_dump($data)
        
    } else { }
} else {}