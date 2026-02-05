<?php
/**
* Header Options.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'maintenance_works_button_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'maintenance-works' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'maintenance_works_theme_option_panel',
	)
);

$wp_customize->add_setting('maintenance_works_sticky',
    array(
        'default' => $maintenance_works_default['maintenance_works_sticky'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_sticky',
    array(
        'label' => esc_html__('Enable Sticky Header', 'maintenance-works'),
        'section' => 'maintenance_works_button_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'maintenance_works_header_layout_phone_number',
    array(
    'default'           => $maintenance_works_default['maintenance_works_header_layout_phone_number'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_header_layout_phone_number',
    array(
    'label'    => esc_html__( 'Phone Number', 'maintenance-works' ),
    'section'  => 'maintenance_works_button_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_header_layout_email_address',
    array(
    'default'           => $maintenance_works_default['maintenance_works_header_layout_email_address'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_header_layout_email_address',
    array(
    'label'    => esc_html__( 'Email Id', 'maintenance-works' ),
    'section'  => 'maintenance_works_button_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_header_layout_address',
    array(
    'default'           => $maintenance_works_default['maintenance_works_header_layout_address'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_header_layout_address',
    array(
    'label'    => esc_html__( 'Address', 'maintenance-works' ),
    'section'  => 'maintenance_works_button_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting('maintenance_works_menu_font_size',
    array(
        'default'           => $maintenance_works_default['maintenance_works_menu_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_number_range',
    )
);
$wp_customize->add_control('maintenance_works_menu_font_size',
    array(
        'label'       => esc_html__('Menu Font Size', 'maintenance-works'),
        'section'     => 'maintenance_works_button_header_setting',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 30,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'maintenance_works_menu_text_transform',
    array(
    'default'           => $maintenance_works_default['maintenance_works_menu_text_transform'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_menu_transform',
    )
);
$wp_customize->add_control( 'maintenance_works_menu_text_transform',
    array(
    'label'       => esc_html__( 'Menu Text Transform', 'maintenance-works' ),
    'section'     => 'maintenance_works_button_header_setting',
    'type'        => 'select',
    'choices'     => array(
        'capitalize' => esc_html__( 'Capitalize', 'maintenance-works' ),
        'uppercase'  => esc_html__( 'Uppercase', 'maintenance-works' ),
        'lowercase'    => esc_html__( 'Lowercase', 'maintenance-works' ),
        ),
    )
);

$wp_customize->add_setting('maintenance_works_header_menus_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'maintenance_works_header_menus_color', array(
    'label'    => __('Main Menu Color', 'maintenance-works'),
    'section'  => 'maintenance_works_button_header_setting',
)));

$wp_customize->add_setting('maintenance_works_header_menus_hover_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'maintenance_works_header_menus_hover_color', array(
    'label'    => __('Main Menu Hover Color', 'maintenance-works'),
    'section'  => 'maintenance_works_button_header_setting',
)));

$wp_customize->add_setting('maintenance_works_header_submenus_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'maintenance_works_header_submenus_color', array(
    'label'    => __('Submenu Color', 'maintenance-works'),
    'section'  => 'maintenance_works_button_header_setting',
)));

$wp_customize->add_setting('maintenance_works_header_submenus_hover_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'maintenance_works_header_submenus_hover_color', array(
    'label'    => __('Submenu Hover Color', 'maintenance-works'),
    'section'  => 'maintenance_works_button_header_setting',
)));

$wp_customize->add_setting('maintenance_works_header_search',
    array(
        'default' => $maintenance_works_default['maintenance_works_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_header_search',
    array(
        'label' => esc_html__('Enable Search', 'maintenance-works'),
        'section' => 'maintenance_works_button_header_setting',
        'type' => 'checkbox',
    )
);