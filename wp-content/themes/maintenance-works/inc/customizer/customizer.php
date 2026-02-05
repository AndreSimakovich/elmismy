<?php
/**
 * Maintenance Works Theme Customizer
 * @package Maintenance Works
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

if (!function_exists('maintenance_works_customize_register')) :

function maintenance_works_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/global-color-setting.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/typography.php';
	require get_template_directory() . '/inc/customizer/header-button.php';
	require get_template_directory() . '/inc/customizer/social-media.php';
	require get_template_directory() . '/inc/customizer/colors.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/footer.php';
	require get_template_directory() . '/inc/customizer/layout-setting.php';
	require get_template_directory() . '/inc/customizer/homepage-content.php';
	require get_template_directory() . '/inc/customizer/custom-addon.php';
	require get_template_directory() . '/inc/customizer/additional-woocommerce.php';
	require get_template_directory() . '/inc/customizer/404-page-settings.php';
	require get_template_directory() . '/inc/customizer/nothing-found-page-settings.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'colors' )->panel = 'maintenance_works_theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','maintenance-works');
	$wp_customize->get_section( 'title_tagline' )->panel = 'maintenance_works_theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'maintenance_works_theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'maintenance_works_theme_general_settings';

	if ( isset( $wp_customize->selective_refresh ) ) {
		
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.header-titles .custom-logo-name',
			'render_callback' => 'maintenance_works_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'maintenance_works_customize_partial_blogdescription',
		) );

	}

	$wp_customize->add_panel( 'maintenance_works_theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'maintenance-works' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'maintenance_works_theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'maintenance-works' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Theme Options Panel.
	$wp_customize->add_panel( 'maintenance_works_theme_footer_option_panel',
		array(
			'title'      => esc_html__( 'Footer Settings', 'maintenance-works' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'maintenance_works_theme_home_pannel',
		array(
			'title'      => esc_html__( 'Frontpage Settings', 'maintenance-works' ),
			'priority'   => 4,
			'capability' => 'edit_theme_options',
		)
	);

	// Addon Panel.
	$wp_customize->add_panel( 'maintenance_works_theme_addons_panel',
		array(
			'title'      => esc_html__( 'Theme Addons', 'maintenance-works' ),
			'priority'   => 5,
			'capability' => 'edit_theme_options',
		)
	);
	
	// Theme Options Panel.
	$wp_customize->add_panel( 'maintenance_works_theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'maintenance-works' ),
			'priority'   => 5,
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_setting('maintenance_works_logo_width_range',
	    array(
	        'default'           => $maintenance_works_default['maintenance_works_logo_width_range'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'maintenance_works_sanitize_number_range',
	    )
	);
	$wp_customize->add_control('maintenance_works_logo_width_range',
	    array(
	        'label'       => esc_html__('Logo width', 'maintenance-works'),
	        'description'       => esc_html__( 'Specify the range for logo size with a minimum of 200px and a maximum of 700px, in increments of 20px.', 'maintenance-works' ),
	        'section'     => 'title_tagline',
	        'type'        => 'range',
	        'input_attrs' => array(
	           'min'   => 100,
	           'max'   => 700,
	           'step'   => 20,
        	),
	    )
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'Maintenance_Works_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Maintenance_Works_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Maintenance Works Pro', 'maintenance-works' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'maintenance-works' ),
				'pro_url'  => esc_url('https://www.omegathemes.com/products/maintenance-wordpress-theme'),
				'priority'  => 1,
			)
		)
	);
}

endif;
add_action( 'customize_register', 'maintenance_works_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('maintenance_works_customizer_scripts')) :

    function maintenance_works_customizer_scripts(){
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('maintenance-works-customizer', get_template_directory_uri() . '/lib/custom/css/customizer.css');
        wp_enqueue_script('maintenance-works-customizer', get_template_directory_uri() . '/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('maintenance_works_ajax_nonce');
        wp_localize_script( 
		    'maintenance-works-customizer',
		    'maintenance_works_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'maintenance_works_customizer_scripts');
add_action('customize_controls_init', 'maintenance_works_customizer_scripts');

function maintenance_works_customize_preview_js() {
	wp_enqueue_script( 'maintenance-works-customizer-preview', get_template_directory_uri() . '/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '', true );
}
add_action( 'customize_preview_init', 'maintenance_works_customize_preview_js' );

if (!function_exists('maintenance_works_customize_partial_blogname')) :
	function maintenance_works_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

if (!function_exists('maintenance_works_customize_partial_blogdescription')) :
	function maintenance_works_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
endif;