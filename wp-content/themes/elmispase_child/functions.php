<?php
/**
 * Child Theme Functions - Elmispase
 * 
 * Структура:
 * 1. Константы
 * 2. Подключение стилей и скриптов (Enqueuing)
 * 3. Настройки поддержки темы (Theme Support)
 * 4. Регистрация областей (Меню, Виджеты) - на будущее
 * 5. Кастомные функции
 */

// ==========================================================================
// 1. КОНСТАНТЫ (упрощают прописывание путей)
// ==========================================================================
define( 'ELMISPASE_CHILD_VERSION', '1.0.1' );

// ==========================================================================
// 2. ПОДКЛЮЧЕНИЕ СТИЛЕЙ И СКРИПТОВ
// ==========================================================================
add_action( 'wp_enqueue_scripts', 'elmispase_child_enqueue_assets' );
function elmispase_child_enqueue_assets() {
    
    // 2.1. Стили родителя
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // 2.2. Bootstrap 5.3 (Исправленная ссылка на полный CSS)
    wp_enqueue_style( 'bootstrap-cdn', 'https://cdn.jsdelivr.net', array(), '5.3.0' );

    // 2.3. Стили дочерней темы (с автоматической версией по времени файла)
    wp_enqueue_style( 'child-style', 
        get_stylesheet_directory_uri() . '/style.css', 
        array('parent-style', 'bootstrap-cdn'), // Зависит от родителя и Bootstrap
        filemtime( get_stylesheet_directory() . '/style.css' ) 
    );

    // 2.4. Скрипты (на будущее, например JS от Bootstrap)
    // wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net', array('jquery'), '5.3.0', true );
}

// ==========================================================================
// 3. НАСТРОЙКИ ПОДДЕРЖКИ ТЕМЫ
// ==========================================================================
add_action( 'after_setup_theme', 'elmispase_child_setup', 20 );
function elmispase_child_setup() {
    
    // Поддержка заголовка окна браузера
    add_theme_support( 'title-tag' );

    // Настройка кастомного логотипа
    add_theme_support( 'custom-logo', [
        'height'      => 50,
        'width'       => 50,
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => [ 'site-title', 'site-description' ],
    ] );


    add_filter( 'wp_shortcode_handler_toggles', '__return_true' );

    // Добавляем поддержку форматов постов, если нужно в будущем
    // add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video' ) );
}

// ==========================================================================
// 4. РЕГИСТРАЦИЯ НОВЫХ ОБЛАСТЕЙ (На будущее)
// ==========================================================================
/**
 * Здесь вы сможете регистрировать новые меню или сайдбары, 
 * которых нет в Spacious
 */
// register_nav_menus( array( 'footer_menu' => 'Меню в футере' ) );

// ==========================================================================
// 5. КАСТОМНЫЕ ФУНКЦИИ (Ваша личная логика)
// ==========================================================================
/**
 * Пример: Изменение длины анонса (excerpt)
 */
add_filter( 'excerpt_length', function($length) { return 20; }, 999 );
add_filter( 'wp_shortcode_handler_toggles', '__return_true' );
// Конец файла (тег закрытия php опускаем для безопасности)