<?php
/**
* Header Banner Options.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();
$maintenance_works_post_category_list = maintenance_works_post_category_list();

$wp_customize->add_section( 'maintenance_works_header_slider_setting',
    array(
    'title'      => esc_html__( 'Slider Settings', 'maintenance-works' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'maintenance_works_theme_home_pannel',
    )
);

// Show/Hide Site Logo
$wp_customize->add_setting('maintenance_works_display_logo', array(
    'default'           => false,
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
));
$wp_customize->add_control('maintenance_works_display_logo', array(
    'label'    => esc_html__('Enable / Disable Site Logo', 'maintenance-works'),
    'section'  => 'title_tagline',
    'type'     => 'checkbox',
));

// Show/Hide Site Title
$wp_customize->add_setting('maintenance_works_display_title', array(
    'default'           => true,
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
));
$wp_customize->add_control('maintenance_works_display_title', array(
    'label'    => esc_html__('Enable / Disable Site Title', 'maintenance-works'),
    'section'  => 'title_tagline',
    'type'     => 'checkbox',
));

// Show/Hide Site Tagline
$wp_customize->add_setting('maintenance_works_display_header_text',
    array(
        'default'           => false,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_display_header_text',
    array(
        'label' => esc_html__('Enable / Disable Site Tagline', 'maintenance-works'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('maintenance_works_header_slider',
    array(
        'default' => $maintenance_works_default['maintenance_works_header_slider'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_header_slider',
    array(
        'label' => esc_html__('Enable Slider', 'maintenance-works'),
        'section' => 'maintenance_works_header_slider_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'maintenance_works_header_slider_cat',
    array(
    'default'           => 'uncategorized',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_select',
    )
);
$wp_customize->add_control( 'maintenance_works_header_slider_cat',
    array(
    'label'       => esc_html__( 'Slider Post Left Category', 'maintenance-works' ),
    'section'     => 'maintenance_works_header_slider_setting',
    'type'        => 'select',
    'choices'     => $maintenance_works_post_category_list,
    )
);

$wp_customize->add_setting('maintenance_works_banner_left_image',
    array(
        'default'           => $maintenance_works_default['maintenance_works_banner_left_image'],
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'maintenance_works_banner_left_image',
        array(
            'label' => __('Slider Left Image ','maintenance-works'),
            'section' => 'maintenance_works_header_slider_setting',
            'settings' => 'maintenance_works_banner_left_image',
        )
    )
);

$wp_customize->add_setting('maintenance_works_banner_right_image',
    array(
        'default'           => $maintenance_works_default['maintenance_works_banner_right_image'],
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'maintenance_works_banner_right_image',
        array(
            'label' => __('Slider Right Image ','maintenance-works'),
            'section' => 'maintenance_works_header_slider_setting',
            'settings' => 'maintenance_works_banner_right_image',
        )
    )
);

$wp_customize->add_setting( 'maintenance_works_slider_section_guarantee_title',
    array(
    'default'           => $maintenance_works_default['maintenance_works_slider_section_guarantee_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_slider_section_guarantee_title',
    array(
    'label'    => esc_html__( 'Our Projects Title', 'maintenance-works' ),
    'section'  => 'maintenance_works_header_slider_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_slider_section_availablity_title',
    array(
    'default'           => $maintenance_works_default['maintenance_works_slider_section_availablity_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_slider_section_availablity_title',
    array(
    'label'    => esc_html__( 'Our Projects Title', 'maintenance-works' ),
    'section'  => 'maintenance_works_header_slider_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_slider_section_location_title',
    array(
    'default'           => $maintenance_works_default['maintenance_works_slider_section_location_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_slider_section_location_title',
    array(
    'label'    => esc_html__( 'Our Projects Title', 'maintenance-works' ),
    'section'  => 'maintenance_works_header_slider_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_slider_section_appoinment_title',
    array(
    'default'           => $maintenance_works_default['maintenance_works_slider_section_appoinment_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_slider_section_appoinment_title',
    array(
    'label'    => esc_html__( 'Our Projects Title', 'maintenance-works' ),
    'section'  => 'maintenance_works_header_slider_setting',
    'type'     => 'text',
    )
);

// Our Projects Settings

$wp_customize->add_section( 'maintenance_works_about_us_setting',
    array(
    'title'      => esc_html__( 'Our Projects Settings', 'maintenance-works' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'maintenance_works_theme_home_pannel',
    )
);

$wp_customize->add_setting('maintenance_works_header_about_us',
    array(
        'default' => $maintenance_works_default['maintenance_works_header_about_us'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_header_about_us',
    array(
        'label' => esc_html__('Enable Our Projects', 'maintenance-works'),
        'section' => 'maintenance_works_about_us_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'maintenance_works_about_us_section_title',
    array(
    'default'           => $maintenance_works_default['maintenance_works_about_us_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_about_us_section_title',
    array(
    'label'    => esc_html__( 'Our Projects Short Title', 'maintenance-works' ),
    'section'  => 'maintenance_works_about_us_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'maintenance_works_about_us_section_sub_title',
    array(
    'default'           => $maintenance_works_default['maintenance_works_about_us_section_sub_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_about_us_section_sub_title',
    array(
    'label'    => esc_html__( 'Our Projects Heading', 'maintenance-works' ),
    'section'  => 'maintenance_works_about_us_setting',
    'type'     => 'text',
    )
);

$categories = get_categories();
$cat_post = array();
$cat_post[]= 'select';
$m = 0;
foreach($categories as $category){
    if($m==0){
        $default = $category->slug;
        $m++;
    }
    $cat_post[$category->slug] = $category->name;
}

$wp_customize->add_setting('maintenance_works_video_section_left_post_cat',array(
    'default'   => 'select',
    'sanitize_callback' => 'maintenance_works_sanitize_select',
));
$wp_customize->add_control('maintenance_works_video_section_left_post_cat' ,array(
    'type'    => 'select',
    'choices' => $cat_post,
    'label' => __('Select Category to display Services','maintenance-works'),
    'section' => 'maintenance_works_about_us_setting',
));