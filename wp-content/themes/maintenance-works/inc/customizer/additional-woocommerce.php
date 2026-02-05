<?php
/**
* Additional Woocommerce Settings.
*
* @package Maintenance Works
*/

$maintenance_works_default = maintenance_works_get_default_theme_options();

// Additional Woocommerce Section.
$wp_customize->add_section( 'maintenance_works_additional_woocommerce_options',
	array(
	'title'      => esc_html__( 'Additional Woocommerce Options', 'maintenance-works' ),
	'priority'   => 210,
	'capability' => 'edit_theme_options',
	'panel'      => 'maintenance_works_theme_option_panel',
	)
);

	$wp_customize->add_setting('maintenance_works_per_columns',
		array(
		'default'           => $maintenance_works_default['maintenance_works_per_columns'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'maintenance_works_sanitize_number_range',
		)
	);
	$wp_customize->add_control('maintenance_works_per_columns',
		array(
		'label'       => esc_html__('Products Per Column', 'maintenance-works'),
		'section'     => 'maintenance_works_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 6,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('maintenance_works_product_per_page',
		array(
		'default'           => $maintenance_works_default['maintenance_works_product_per_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'maintenance_works_sanitize_number_range',
		)
	);
	$wp_customize->add_control('maintenance_works_product_per_page',
		array(
		'label'       => esc_html__('Products Per Page', 'maintenance-works'),
		'section'     => 'maintenance_works_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 100,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('maintenance_works_show_hide_related_product',
    array(
        'default' => $maintenance_works_default['maintenance_works_show_hide_related_product'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'maintenance_works_sanitize_checkbox',
    )
	);
	$wp_customize->add_control('maintenance_works_show_hide_related_product',
	    array(
	        'label' => esc_html__('Enable Related Products', 'maintenance-works'),
	        'section' => 'maintenance_works_additional_woocommerce_options',
	        'type' => 'checkbox',
	    )
	);

	$wp_customize->add_setting('maintenance_works_custom_related_products_number',
		array(
		'default'           => $maintenance_works_default['maintenance_works_custom_related_products_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'maintenance_works_sanitize_number_range',
		)
	);
	$wp_customize->add_control('maintenance_works_custom_related_products_number',
		array(
		'label'       => esc_html__('Related Products Per Page', 'maintenance-works'),
		'section'     => 'maintenance_works_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 10,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('maintenance_works_custom_related_products_number_per_row',
		array(
		'default'           => $maintenance_works_default['maintenance_works_custom_related_products_number_per_row'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'maintenance_works_sanitize_number_range',
		)
	);
	$wp_customize->add_control('maintenance_works_custom_related_products_number_per_row',
		array(
		'label'       => esc_html__('Related Products Per Row', 'maintenance-works'),
		'section'     => 'maintenance_works_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 5,
		'step'   => 1,
		),
		)
	);