<?php

function maintenance_works_enqueue_fonts() {
    $maintenance_works_default_font_content = 'PlusJakartaSans';
    $maintenance_works_default_font_heading = 'PlusJakartaSans';

    $maintenance_works_font_content = esc_attr(get_theme_mod('maintenance_works_content_typography_font', $maintenance_works_default_font_content));
    $maintenance_works_font_heading = esc_attr(get_theme_mod('maintenance_works_heading_typography_font', $maintenance_works_default_font_heading));

    $maintenance_works_css = '';

    // Always enqueue main font
    $maintenance_works_css .= '
    :root {
        --font-main: ' . $maintenance_works_font_content . ', ' . (in_array($maintenance_works_font_content, ['bitter', 'charis-sil']) ? 'serif' : 'sans-serif') . '!important;
    }';
    wp_enqueue_style('maintenance-works-style-font-general', get_template_directory_uri() . '/fonts/' . $maintenance_works_font_content . '/font.css');

    // Always enqueue header font
    $maintenance_works_css .= '
    :root {
        --font-head: ' . $maintenance_works_font_heading . ', ' . (in_array($maintenance_works_font_heading, ['bitter', 'charis-sil']) ? 'serif' : 'sans-serif') . '!important;
    }';
    wp_enqueue_style('maintenance-works-style-font-h', get_template_directory_uri() . '/fonts/' . $maintenance_works_font_heading . '/font.css');

    // Add inline style
    wp_add_inline_style('maintenance-works-style-font-general', $maintenance_works_css);
}
add_action('wp_enqueue_scripts', 'maintenance_works_enqueue_fonts', 50);