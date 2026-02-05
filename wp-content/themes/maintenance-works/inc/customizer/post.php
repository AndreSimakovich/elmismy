<?php
/**
* Posts Settings.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'maintenance_works_single_posts_settings',
    array(
    'title'      => esc_html__( 'Single Meta Information Settings', 'maintenance-works' ),
    'priority'   => 35,
    'capability' => 'edit_theme_options',
    'panel'      => 'maintenance_works_theme_option_panel',
    )
);

$wp_customize->add_setting('maintenance_works_display_single_post_image',
    array(
        'default' => $maintenance_works_default['maintenance_works_display_single_post_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_display_single_post_image',
    array(
        'label' => esc_html__('Enable Single Posts Image', 'maintenance-works'),
        'section' => 'maintenance_works_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_post_author',
    array(
        'default' => $maintenance_works_default['maintenance_works_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'maintenance-works'),
        'section' => 'maintenance_works_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_post_date',
    array(
        'default' => $maintenance_works_default['maintenance_works_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'maintenance-works'),
        'section' => 'maintenance_works_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_post_category',
    array(
        'default' => $maintenance_works_default['maintenance_works_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'maintenance-works'),
        'section' => 'maintenance_works_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_post_tags',
    array(
        'default' => $maintenance_works_default['maintenance_works_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'maintenance-works'),
        'section' => 'maintenance_works_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'maintenance_works_single_page_content_alignment',
    array(
    'default'           => $maintenance_works_default['maintenance_works_single_page_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'maintenance_works_single_page_content_alignment',
    array(
    'label'       => esc_html__( 'Single Page Content Alignment', 'maintenance-works' ),
    'section'     => 'maintenance_works_single_posts_settings',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'maintenance-works' ),
        'center'  => esc_html__( 'Center', 'maintenance-works' ),
        'right'    => esc_html__( 'Right', 'maintenance-works' ),
        ),
    )
);

$wp_customize->add_setting( 'maintenance_works_single_post_content_alignment',
    array(
    'default'           => $maintenance_works_default['maintenance_works_single_post_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'maintenance_works_single_post_content_alignment',
    array(
    'label'       => esc_html__( 'Single Post Content Alignment', 'maintenance-works' ),
    'section'     => 'maintenance_works_single_posts_settings',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'maintenance-works' ),
        'center'  => esc_html__( 'Center', 'maintenance-works' ),
        'right'    => esc_html__( 'Right', 'maintenance-works' ),
        ),
    )
);

// Archive Post Section.
$wp_customize->add_section( 'maintenance_works_posts_settings',
    array(
    'title'      => esc_html__( 'Archive Meta Information Settings', 'maintenance-works' ),
    'priority'   => 36,
    'capability' => 'edit_theme_options',
    'panel'      => 'maintenance_works_theme_option_panel',
    )
);

$wp_customize->add_setting('maintenance_works_display_archive_post_format_icon',
    array(
        'default' => $maintenance_works_default['maintenance_works_display_archive_post_format_icon'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_display_archive_post_format_icon',
    array(
        'label' => esc_html__('Enable Posts Format Icon', 'maintenance-works'),
        'section' => 'maintenance_works_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_display_archive_post_image',
    array(
        'default' => $maintenance_works_default['maintenance_works_display_archive_post_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_display_archive_post_image',
    array(
        'label' => esc_html__('Enable Posts Image', 'maintenance-works'),
        'section' => 'maintenance_works_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_display_archive_post_category',
    array(
        'default' => $maintenance_works_default['maintenance_works_display_archive_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_display_archive_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'maintenance-works'),
        'section' => 'maintenance_works_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_display_archive_post_title',
    array(
        'default' => $maintenance_works_default['maintenance_works_display_archive_post_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_display_archive_post_title',
    array(
        'label' => esc_html__('Enable Posts Title', 'maintenance-works'),
        'section' => 'maintenance_works_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_display_archive_post_content',
    array(
        'default' => $maintenance_works_default['maintenance_works_display_archive_post_content'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_display_archive_post_content',
    array(
        'label' => esc_html__('Enable Posts Content', 'maintenance-works'),
        'section' => 'maintenance_works_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_display_archive_post_button',
    array(
        'default' => $maintenance_works_default['maintenance_works_display_archive_post_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_display_archive_post_button',
    array(
        'label' => esc_html__('Enable Posts Button', 'maintenance-works'),
        'section' => 'maintenance_works_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_excerpt_limit',
    array(
        'default'           => $maintenance_works_default['maintenance_works_excerpt_limit'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_number_range',
    )
);
$wp_customize->add_control('maintenance_works_excerpt_limit',
    array(
        'label'       => esc_html__('Blog Posts Excerpt limit', 'maintenance-works'),
        'section'     => 'maintenance_works_posts_settings',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 100,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'maintenance_works_archive_image_size',
	array(
	'default'           => 'medium',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'maintenance_works_sanitize_select',
	)
);
$wp_customize->add_control( 'maintenance_works_archive_image_size',
	array(
	'label'       => esc_html__( 'Blog Posts Image Size', 'maintenance-works' ),
	'section'     => 'maintenance_works_posts_settings',
	'type'        => 'select',
	'choices'               => array(
		'full' => esc_html__( 'Large Size Image', 'maintenance-works' ),
		'large' => esc_html__( 'Big Size Image', 'maintenance-works' ),
		'medium' => esc_html__( 'Medium Size Image', 'maintenance-works' ),
		'small' => esc_html__( 'Small Size Image', 'maintenance-works' ),
		'xsmall' => esc_html__( 'Extra Small Size Image', 'maintenance-works' ),
		'thumbnail' => esc_html__( 'Thumbnail Size Image', 'maintenance-works' ),
	    ),
	)
);

$wp_customize->add_setting('maintenance_works_posts_per_columns',
    array(
    'default'           => '3',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_number_range',
    )
);
$wp_customize->add_control('maintenance_works_posts_per_columns',
    array(
    'label'       => esc_html__('Blog Posts Per Column', 'maintenance-works'),
    'section'     => 'maintenance_works_posts_settings',
    'type'        => 'number',
    'input_attrs' => array(
    'min'   => 1,
    'max'   => 5,
    'step'   => 1,
    ),
    )
);