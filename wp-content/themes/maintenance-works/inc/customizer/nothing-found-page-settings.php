<?php
/**
* Noting Found Page Settings.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

$wp_customize->add_section( 'maintenance_works_noting_found_page_settings',
    array(
        'title'      => esc_html__( 'Nothing Found Page Settings', 'maintenance-works' ),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
        'panel'      => 'maintenance_works_theme_addons_panel',
    )
);

$wp_customize->add_setting( 'maintenance_works_noting_found_main_title',
    array(
        'default'           => 'Nothing Found',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_noting_found_main_title',
    array(
        'label'    => esc_html__( 'Main Title', 'maintenance-works' ),
        'section'  => 'maintenance_works_noting_found_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_noting_found_para',
    array(
        'default'           => 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_noting_found_para',
    array(
        'label'    => esc_html__( 'Para Text', 'maintenance-works' ),
        'section'  => 'maintenance_works_noting_found_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting('maintenance_works_noting_found_saerch',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_noting_found_saerch',
    array(
        'label' => esc_html__('Enable/Disable Search', 'maintenance-works'),
        'section' => 'maintenance_works_noting_found_page_settings',
        'type' => 'checkbox',
    )
);