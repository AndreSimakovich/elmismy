<?php
/**
* 404 Page Settings.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

$wp_customize->add_section( 'maintenance_works_404_page_settings',
    array(
        'title'      => esc_html__( '404 Page Settings', 'maintenance-works' ),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
        'panel'      => 'maintenance_works_theme_addons_panel',
    )
);

$wp_customize->add_setting( 'maintenance_works_404_main_title',
    array(
        'default'           => $maintenance_works_default['maintenance_works_404_main_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_404_main_title',
    array(
        'label'    => esc_html__( '404 Main Title', 'maintenance-works' ),
        'section'  => 'maintenance_works_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_404_subtitle_one',
    array(
        'default'           => $maintenance_works_default['maintenance_works_404_subtitle_one'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_404_subtitle_one',
    array(
        'label'    => esc_html__( '404 Sub Title One', 'maintenance-works' ),
        'section'  => 'maintenance_works_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_404_para_one',
    array(
        'default'           => $maintenance_works_default['maintenance_works_404_para_one'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_404_para_one',
    array(
        'label'    => esc_html__( '404 Para Text One', 'maintenance-works' ),
        'section'  => 'maintenance_works_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_404_subtitle_two',
    array(
        'default'           => $maintenance_works_default['maintenance_works_404_subtitle_two'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_404_subtitle_two',
    array(
        'label'    => esc_html__( '404 Sub Title Two', 'maintenance-works' ),
        'section'  => 'maintenance_works_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_404_para_two',
    array(
        'default'           => $maintenance_works_default['maintenance_works_404_para_two'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_404_para_two',
    array(
        'label'    => esc_html__( '404 Para Text Two', 'maintenance-works' ),
        'section'  => 'maintenance_works_404_page_settings',
        'type'     => 'text',
    )
);