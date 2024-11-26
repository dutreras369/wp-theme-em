<?php
/*
    * Queries
*/

function blog_get_page( $names = array() ){

    $args = array(
        'post_type' => 'page',
        'post_status'    => 'publish',
        'post_name__in'  => $names
    );
    
    $data = new WP_Query($args);

    return $data;
}

function blog_get_custom_post_type($name = '', $cantidad = -1){

    $args = array(
       'post_type' => $name,
       'posts_per_page' => $cantidad,
       'post_status' => 'publish',
       'orderby'=> 'date', 
       'order'=>'desc',       
    );
 
    $data = new WP_Query($args);
       
    return $data;
 }