<?php
/**
 * Функции и стили дочерней темы Elmispase
 */
add_action( 'wp_enqueue_scripts', 'elmispase_child_enqueue_styles' );
function elmispase_child_enqueue_styles() {
    // 1. Подключаем стили родительской темы
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // 2. Подключаем Bootstrap (исправленная ссылка на конкретный файл)
    wp_enqueue_style( 'bootstrap-cdn', 'https://cdn.jsdelivr.net' );

    // 3. Подключаем стили САМОЙ дочерней темы (важно!)
   wp_enqueue_style( 'child-style', 
    get_stylesheet_directory_uri() . '/style.css', 
    array('parent-style'), 
    filemtime( get_stylesheet_directory() . '/style.css' ) // Версия будет временем изменения файла
);
}
/**
 * Настройки темы  Приоритет 20, чтобы перекрыть настройки родительской темы
 */
add_action( 'after_setup_theme', function() {
    // Автоматический тег <title>
    add_theme_support( 'title-tag' );

    // Поддержка логотипа (перекрываем настройки родителя)
    add_theme_support( 'custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => [ 'site-title', 'site-description' ],
    ] );
}, 20 );// Приоритет 20, чтобы перекрыть настройки родительской темы