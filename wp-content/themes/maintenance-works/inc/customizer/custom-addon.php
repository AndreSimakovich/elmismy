<?php
/**
* Custom Addons.
*
* @package Maintenance Works
*/

$wp_customize->add_section( 'maintenance_works_theme_pagination_options',
    array(
    'title'      => esc_html__( 'Customizer Custom Settings', 'maintenance-works' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'maintenance_works_theme_addons_panel',
    )
);

$wp_customize->add_setting('maintenance_works_theme_loader',
    array(
        'default' => $maintenance_works_default['maintenance_works_theme_loader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_theme_loader',
    array(
        'label' => esc_html__('Enable Preloader', 'maintenance-works'),
        'section' => 'maintenance_works_theme_pagination_options',
        'type' => 'checkbox',
    )
);

// Add Pagination Enable/Disable option to Customizer
$wp_customize->add_setting( 'maintenance_works_enable_pagination', 
    array(
        'default'           => true, // Default is enabled
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_enable_pagination', // Sanitize the input
    )
);

// Add the control to the Customizer
$wp_customize->add_control( 'maintenance_works_enable_pagination', 
    array(
        'label'    => esc_html__( 'Enable Pagination', 'maintenance-works' ),
        'section'  => 'maintenance_works_theme_pagination_options', // Add to the correct section
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting( 'maintenance_works_theme_pagination_type', 
    array(
        'default'           => 'numeric', // Set "numeric" as the default
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_pagination_type', // Use our sanitize function
    )
);

$wp_customize->add_control( 'maintenance_works_theme_pagination_type',
    array(
        'label'       => esc_html__( 'Pagination Style', 'maintenance-works' ),
        'section'     => 'maintenance_works_theme_pagination_options',
        'type'        => 'select',
        'choices'     => array(
            'numeric'      => esc_html__( 'Numeric (Page Numbers)', 'maintenance-works' ),
            'newer_older'  => esc_html__( 'Newer/Older (Previous/Next)', 'maintenance-works' ), // Renamed to "Newer/Older"
        ),
    )
);

$wp_customize->add_setting( 'maintenance_works_theme_pagination_options_alignment',
    array(
    'default'           => $maintenance_works_default['maintenance_works_theme_pagination_options_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'maintenance_works_theme_pagination_options_alignment',
    array(
    'label'       => esc_html__( 'Pagination Alignment', 'maintenance-works' ),
    'section'     => 'maintenance_works_theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'maintenance-works' ),
        'Right' => esc_html__( 'Right', 'maintenance-works' ),
        'Left'  => esc_html__( 'Left', 'maintenance-works' ),
        ),
    )
);

$wp_customize->add_setting('maintenance_works_theme_breadcrumb_enable',
array(
    'default' => $maintenance_works_default['maintenance_works_theme_breadcrumb_enable'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
)
);
$wp_customize->add_control('maintenance_works_theme_breadcrumb_enable',
    array(
        'label' => esc_html__('Enable Breadcrumb', 'maintenance-works'),
        'section' => 'maintenance_works_theme_pagination_options',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'maintenance_works_theme_breadcrumb_options_alignment',
    array(
    'default'           => $maintenance_works_default['maintenance_works_theme_breadcrumb_options_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'maintenance_works_theme_breadcrumb_options_alignment',
    array(
    'label'       => esc_html__( 'Breadcrumb Alignment', 'maintenance-works' ),
    'section'     => 'maintenance_works_theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'maintenance-works' ),
        'Right' => esc_html__( 'Right', 'maintenance-works' ),
        'Left'  => esc_html__( 'Left', 'maintenance-works' ),
        ),
    )
);

$wp_customize->add_setting('maintenance_works_breadcrumb_font_size',
    array(
        'default'           => $maintenance_works_default['maintenance_works_breadcrumb_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_number_range',
    )
);
$wp_customize->add_control('maintenance_works_breadcrumb_font_size',
    array(
        'label'       => esc_html__('Breadcrumb Font Size', 'maintenance-works'),
        'section'     => 'maintenance_works_theme_pagination_options',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 45,
           'step'   => 1,
        ),
    )
);