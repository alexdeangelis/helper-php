<?php

//If there is a cookie called developer, do this...
if ( $_COOKIE['developer'] == true ) {
    echo '<pre>';
    //Var dumps the whole post
    var_dump($post);
    echo '</pre>';
}

?>