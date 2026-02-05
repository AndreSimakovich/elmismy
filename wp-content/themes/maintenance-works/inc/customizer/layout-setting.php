<?php
/**
* Layouts Settings.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'maintenance_works_layout_setting',
	array(
	'title'      => esc_html__( 'Sidebar Settings', 'maintenance-works' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'      => 'maintenance_works_theme_option_panel',
	)
);

$wp_customize->add_setting( 'maintenance_works_global_sidebar_layout',
    array(
    'default'           => $maintenance_works_default['maintenance_works_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_sidebar_option',
    )
);
$wp_customize->add_control( 'maintenance_works_global_sidebar_layout',
    array(
    'label'       => esc_html__( 'Global Sidebar Layout', 'maintenance-works' ),
    'section'     => 'maintenance_works_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'maintenance-works' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'maintenance-works' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'maintenance-works' ),
        ),
    )
);

$wp_customize->add_setting('maintenance_works_page_sidebar_layout', array(
    'default'           => $maintenance_works_default['maintenance_works_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_sidebar_option',
));

$wp_customize->add_control('maintenance_works_page_sidebar_layout', array(
    'label'       => esc_html__('Single Page Sidebar Layout', 'maintenance-works'),
    'section'     => 'maintenance_works_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__('Right Sidebar', 'maintenance-works'),
        'left-sidebar'  => esc_html__('Left Sidebar', 'maintenance-works'),
        'no-sidebar'    => esc_html__('No Sidebar', 'maintenance-works'),
    ),
));

$wp_customize->add_setting('maintenance_works_post_sidebar_layout', array(
    'default'           => $maintenance_works_default['maintenance_works_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_sidebar_option',
));

$wp_customize->add_control('maintenance_works_post_sidebar_layout', array(
    'label'       => esc_html__('Single Post Sidebar Layout', 'maintenance-works'),
    'section'     => 'maintenance_works_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__('Right Sidebar', 'maintenance-works'),
        'left-sidebar'  => esc_html__('Left Sidebar', 'maintenance-works'),
        'no-sidebar'    => esc_html__('No Sidebar', 'maintenance-works'),
    ),
));

$wp_customize->add_setting('maintenance_works_sticky_sidebar',
    array(
        'default'           => true,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_sticky_sidebar',
    array(
        'label' => esc_html__('Enable/Disable Sticky Sidebar', 'maintenance-works'),
        'section' => 'maintenance_works_layout_setting',
        'type' => 'checkbox',
    )
);