<?php
/**
 * Spacious functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

/** Load functions */
require_once( SPACIOUS_INCLUDES_DIR . '/custom-header.php' );
require_once( SPACIOUS_INCLUDES_DIR . '/functions.php' );
require_once( SPACIOUS_INCLUDES_DIR . '/header-functions.php' );


if (!function_exists('theme_special_nav')) {
    function theme_special_nav() {
        //  Ваш код.


function dark_style_load() {
$theme_uri = get_template_directory_uri();
wp_register_style('dark', $theme_uri.'/dark.css');
wp_enqueue_style('dark');
}
add_action('wp_enqueue_scripts', 'dark_load');


    }
}
?>