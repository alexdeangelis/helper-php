<?php

// filter the Gravity Forms button type
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='button button-white' id='gform_submit_button_{$form['id']}'><span>Submit&nbsp;<i class='fa fa-arrow-right'></i></span></button>";
}

?>