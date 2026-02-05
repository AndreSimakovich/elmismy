<?php
/**
* Footer Settings.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

$wp_customize->add_section( 'maintenance_works_footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Settings', 'maintenance-works' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'maintenance_works_theme_option_panel',
	)
);

$wp_customize->add_setting('maintenance_works_display_footer',
    array(
    'default' => $maintenance_works_default['maintenance_works_display_footer'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
)
);
$wp_customize->add_control('maintenance_works_display_footer',
    array(
        'label' => esc_html__('Enable Footer', 'maintenance-works'),
        'section' => 'maintenance_works_footer_widget_area',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'maintenance_works_footer_column_layout',
	array(
	'default'           => $maintenance_works_default['maintenance_works_footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'maintenance_works_sanitize_select',
	)
);
$wp_customize->add_control( 'maintenance_works_footer_column_layout',
	array(
	'label'       => esc_html__( 'Footer Column Layout', 'maintenance-works' ),
	'section'     => 'maintenance_works_footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'maintenance-works' ),
		'2' => esc_html__( 'Two Column', 'maintenance-works' ),
		'3' => esc_html__( 'Three Column', 'maintenance-works' ),
	    ),
	)
);

$wp_customize->add_setting( 'maintenance_works_footer_widget_title_alignment',
        array(
    'default'           => $maintenance_works_default['maintenance_works_footer_widget_title_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_footer_widget_title_alignment',
    )
);
$wp_customize->add_control( 'maintenance_works_footer_widget_title_alignment',
    array(
    'label'       => esc_html__( 'Footer Widget Title Alignment', 'maintenance-works' ),
    'section'     => 'maintenance_works_footer_widget_area',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'maintenance-works' ),
        'center'  => esc_html__( 'Center', 'maintenance-works' ),
        'right'    => esc_html__( 'Right', 'maintenance-works' ),
        ),
    )
);

$wp_customize->add_setting( 'maintenance_works_footer_copyright_text',
	array(
	'default'           => $maintenance_works_default['maintenance_works_footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'maintenance_works_footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'maintenance-works' ),
	'section'  => 'maintenance_works_footer_widget_area',
	'type'     => 'text',
	)
);

$wp_customize->add_setting('maintenance_works_copyright_font_size',
    array(
        'default'           => $maintenance_works_default['maintenance_works_copyright_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_number_range',
    )
);
$wp_customize->add_control('maintenance_works_copyright_font_size',
    array(
        'label'       => esc_html__('Copyright Font Size', 'maintenance-works'),
        'section'     => 'maintenance_works_footer_widget_area',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 5,
           'max'   => 30,
           'step'   => 1,
    	),
    )
);

$wp_customize->add_setting( 'maintenance_works_copyright_alignment', array(
    'default'           => 'Default',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'maintenance_works_sanitize_copyright_alignment_meta',
) );

$wp_customize->add_control( 'maintenance_works_copyright_alignment', array(
    'label'    => esc_html__( 'Copyright Section Alignment', 'maintenance-works' ),
    'section'  => 'maintenance_works_footer_widget_area',
    'type'     => 'select',
    'choices'  => array(
        'Default' => esc_html__( 'Default View', 'maintenance-works' ),
        'Reverse' => esc_html__( 'Reverse View', 'maintenance-works' ),
        'Center'  => esc_html__( 'Centered Content', 'maintenance-works' ),
    ),
) );

$wp_customize->add_setting( 'maintenance_works_footer_widget_background_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
));
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'maintenance_works_footer_widget_background_color', array(
    'label'     => __('Footer Widget Background Color', 'maintenance-works'),
    'description' => __('It will change the complete footer widget background color.', 'maintenance-works'),
    'section' => 'maintenance_works_footer_widget_area',
    'settings' => 'maintenance_works_footer_widget_background_color',
)));

$wp_customize->add_setting('maintenance_works_footer_widget_background_image',array(
    'default'   => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'maintenance_works_footer_widget_background_image',array(
    'label' => __('Footer Widget Background Image','maintenance-works'),
    'section' => 'maintenance_works_footer_widget_area'
)));

$wp_customize->add_setting('maintenance_works_enable_to_the_top',
    array(
        'default' => $maintenance_works_default['maintenance_works_enable_to_the_top'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
);
$wp_customize->add_control('maintenance_works_enable_to_the_top',
    array(
        'label' => esc_html__('Enable To The Top', 'maintenance-works'),
        'section' => 'maintenance_works_footer_widget_area',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'maintenance_works_to_the_top_text',
    array(
    'default'           => $maintenance_works_default['maintenance_works_to_the_top_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'maintenance_works_to_the_top_text',
    array(
    'label'    => esc_html__( 'Edit Text Here', 'maintenance-works' ),
    'section'  => 'maintenance_works_footer_widget_area',
    'type'     => 'text',
    )
);