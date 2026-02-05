<?php
/**
* Typography Settings.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'maintenance_works_typography_setting',
	array(
	'title'      => esc_html__( 'Typography Settings', 'maintenance-works' ),
	'priority'   => 21,
	'capability' => 'edit_theme_options',
	'panel'      => 'maintenance_works_theme_option_panel',
	)
);

// -----------------  Font array
$maintenance_works_fonts = array(
    'Select'           => __('Default Font', 'maintenance-works'),
    'bad-script' => 'Bad Script',
    'bitter'     => 'Bitter',
    'charis-sil' => 'Charis SIL',
    'cuprum'     => 'Cuprum',
    'exo-2'      => 'Exo 2',
    'jost'       => 'Jost',
    'open-sans'  => 'Open Sans',
    'oswald'     => 'Oswald',
    'play'       => 'Play',
    'outfit'     => 'Outfit',
    'ubuntu'     => 'Ubuntu',
    'PlusJakartaSans'     => 'Plus Jakarta Sans',
);

 // -----------------  General text font
 $wp_customize->add_setting( 'maintenance_works_content_typography_font', array(
    'default'           => 'PlusJakartaSans',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_radio_sanitize',
) );
$wp_customize->add_control( 'maintenance_works_content_typography_font', array(
    'type'     => 'select',
    'label'    => esc_html__( 'General Content Font', 'maintenance-works' ),
    'section'  => 'maintenance_works_typography_setting',
    'settings' => 'maintenance_works_content_typography_font',
    'choices'  => $maintenance_works_fonts,
) );

 // -----------------  General Heading Font
$wp_customize->add_setting( 'maintenance_works_heading_typography_font', array(
    'default'           => 'PlusJakartaSans',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_radio_sanitize',
) );
$wp_customize->add_control( 'maintenance_works_heading_typography_font', array(
    'type'     => 'select',
    'label'    => esc_html__( 'General Heading Font', 'maintenance-works' ),
    'section'  => 'maintenance_works_typography_setting',
    'settings' => 'maintenance_works_heading_typography_font',
    'choices'  => $maintenance_works_fonts,
) );