<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
    
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
// functions.php дочерней темы
add_action( 'wp_enqueue_scripts', 'elmispase_child_enqueue_styles' );
function elmispase_child_enqueue_styles() {
    // Подключаем стили родительской темы
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    // Подключаем Bootstrap
    wp_enqueue_style( 'bootstrap-cdn', 'https://cdn.jsdelivr.net' );
}