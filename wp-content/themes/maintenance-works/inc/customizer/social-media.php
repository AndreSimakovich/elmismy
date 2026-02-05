<?php
/**
* Header Options.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'maintenance_works_social_media_setting',
	array(
	'title'      => esc_html__( 'Social Media Settings', 'maintenance-works' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'maintenance_works_theme_option_panel',
	)
);

$wp_customize->add_setting( 'maintenance_works_header_layout_facebook_link',
    array(
    'default'           => $maintenance_works_default['maintenance_works_header_layout_facebook_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'maintenance_works_header_layout_facebook_link',
    array(
    'label'    => esc_html__( 'Facebook Link', 'maintenance-works' ),
    'section'  => 'maintenance_works_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'maintenance_works_header_layout_twitter_link',
    array(
    'default'           => $maintenance_works_default['maintenance_works_header_layout_twitter_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'maintenance_works_header_layout_twitter_link',
    array(
    'label'    => esc_html__( 'Twitter Link', 'maintenance-works' ),
    'section'  => 'maintenance_works_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'maintenance_works_header_layout_pintrest_link',
    array(
    'default'           => $maintenance_works_default['maintenance_works_header_layout_pintrest_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'maintenance_works_header_layout_pintrest_link',
    array(
    'label'    => esc_html__( 'Pintrest Link', 'maintenance-works' ),
    'section'  => 'maintenance_works_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'maintenance_works_header_layout_instagram_link',
    array(
    'default'           => $maintenance_works_default['maintenance_works_header_layout_instagram_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'maintenance_works_header_layout_instagram_link',
    array(
    'label'    => esc_html__( 'Instagram Link', 'maintenance-works' ),
    'section'  => 'maintenance_works_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'maintenance_works_header_layout_youtube_link',
    array(
    'default'           => $maintenance_works_default['maintenance_works_header_layout_youtube_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'maintenance_works_header_layout_youtube_link',
    array(
    'label'    => esc_html__( 'Youtube Link', 'maintenance-works' ),
    'section'  => 'maintenance_works_social_media_setting',
    'type'     => 'url',
    )
);