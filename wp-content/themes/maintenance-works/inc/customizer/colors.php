<?php
/**
* Color Settings.
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

$wp_customize->add_setting( 'maintenance_works_default_text_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'maintenance_works_default_text_color',
    array(
        'label'      => esc_html__( 'Text Color', 'maintenance-works' ),
        'section'    => 'colors',
        'settings'   => 'maintenance_works_default_text_color',
    ) ) 
);

$wp_customize->add_setting( 'maintenance_works_border_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'maintenance_works_border_color',
    array(
        'label'      => esc_html__( 'Border Color', 'maintenance-works' ),
        'section'    => 'colors',
        'settings'   => 'maintenance_works_border_color',
    ) ) 
);