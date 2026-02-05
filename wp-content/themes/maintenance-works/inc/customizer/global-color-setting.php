<?php
/**
* Global Color Settings.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'maintenance_works_global_color_setting',
	array(
	'title'      => esc_html__( 'Global Color Settings', 'maintenance-works' ),
	'priority'   => 1,
	'capability' => 'edit_theme_options',
	'panel'      => 'maintenance_works_theme_option_panel',
	)
);

$wp_customize->add_setting( 'maintenance_works_global_color',
    array(
    'default'           => '#125665',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'maintenance_works_global_color',
    array(
        'label'      => esc_html__( 'Global Color', 'maintenance-works' ),
        'section'    => 'maintenance_works_global_color_setting',
        'settings'   => 'maintenance_works_global_color',
    ) ) 
);

$wp_customize->add_setting( 'maintenance_works_secondary_color',
    array(
    'default'           => '#F18F20',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'maintenance_works_secondary_color',
    array(
        'label'      => esc_html__( 'Global Color', 'maintenance-works' ),
        'section'    => 'maintenance_works_global_color_setting',
        'settings'   => 'maintenance_works_secondary_color',
    ) ) 
);