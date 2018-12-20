<?php

//CREATE THE DESTINATIONS WALKER FOR THE DESTINATIONS MEGA MENU
class Destinations_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
        
        $item_id = $item->object_id;
        $title = $item->title;
        $permalink = $item->url;
        
        //If there is a featured image do this...
        if( get_the_post_thumbnail($item_id) ) {
            //$destination_image = wp_get_attachment_url( get_post_thumbnail_id($item_id) );
            $destination_image_object = wp_get_attachment_image_src(get_post_thumbnail_id($item_id),'medium');
            $destination_image = $destination_image_object[0];
            $no_image_class = false;
        } else {
            $destination_image = false;
            $no_image_class = 'no_image_destination_class';
        }
        
        $output .= '<a href="' . $permalink . '">';
        $output .= "<div class='col-xs-6 col-sm-4 col-md-3'><li class='" .  implode(" ", $item->classes) . "'><div class='ratio ratio_mega_menu " . $no_image_class ."' style='background-image:url(" . $destination_image . ")'><div class='content'><h4>";
        $output .= $title;
        $output .= "</h4><div></div></li></div>";
        $output .= '</a>';
    }
}