<?php
/**
 * Elmispase customizer class for theme customize options.
 *
 * Class Elmispase_Customizer
 *
 * @package    ThemeGrill
 * @subpackage Elmispase
 * @since      Elmispase 1.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the customizer framework files.
require( dirname( __FILE__ ) . '/core/class-elmispase-customizer-framework.php' );
require( dirname( __FILE__ ) . '/core/class-elmispase-customize-base-option.php' );

/**
 * Elmispase customizer class.
 *
 * Class Elmispase_Customizer
 */
class Elmispase_Customizer {

	/**
	 * Customizer setup constructor.
	 *
	 * Elmispase_Customizer constructor.
	 */
	public function __construct() {

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_register' ), 12 );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_options_file_include' ), 1 );

	}

	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	
	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {

		// Override default.
		require ELMISPASE_CUSTOMIZER_DIR . '/override-defaults.php';

	}

	/**
	 * Register Elmispase customize panels, sections and controls type.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function register_panels_sections_controls( $wp_customize ) {

		// Register panels and sections.
		$wp_customize->register_panel_type( 'Elmispase_WP_Customize_Panel' );
		$wp_customize->register_section_type( 'Elmispase_WP_Customize_Section' );

		/**
		 * Register controls.
		 */
		/**
		 * WordPress default controls.
		 */
		// Checkbox control.
		Elmispase_Customize_Base_Control::add_control(
			'checkbox',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_checkbox',
				),
			)
		);

		// Radio control.
		Elmispase_Customize_Base_Control::add_control(
			'radio',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_radio_select',
				),
			)
		);

		// Select control.
		Elmispase_Customize_Base_Control::add_control(
			'select',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_radio_select',
				),
			)
		);

		// Text control.
		Elmispase_Customize_Base_Control::add_control(
			'text',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_nohtml',
				),
			)
		);

		// Number control.
		Elmispase_Customize_Base_Control::add_control(
			'number',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_number',
				),
			)
		);

		// Email control.
		Elmispase_Customize_Base_Control::add_control(
			'email',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_email',
				),
			)
		);

		// URL control.
		ElmispaseS_Customize_Base_Control::add_control(
			'url',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_url',
				),
			)
		);

		// Textarea control.
		Elmispase_Customize_Base_Control::add_control(
			'textarea',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_html',
				),
			)
		);

		// Dropdown pages control.
		Elmispase_Customize_Base_Control::add_control(
			'dropdown-pages',
			array(
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_dropdown_pages',
				),
			)
		);

		// Color control.
		Elmispase_Customize_Base_Control::add_control(
			'color',
			array(
				'callback'          => 'WP_Customize_Color_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_hex_color',
				),
			)
		);

		// Image upload control.
		Elmispase_Customize_Base_Control::add_control(
			'image',
			array(
				'callback'          => 'WP_Customize_Image_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_image_upload',
				),
			)
		);

		// Radio image control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-radio-image',
			array(
				'callback'          => 'Elmispase_Radio_Image_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_radio_select',
				),
			)
		);

		// Heading control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-heading',
			array(
				'callback'          => 'Elmispase_Heading_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_false_values',
				),
			)
		);

		// Editor control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-editor',
			array(
				'callback'          => 'Elmispase_Editor_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_html',
				),
			)
		);

		// Color control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-color',
			array(
				'callback'          => 'Elmispase_Color_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_alpha_color',
				),
			)
		);

		// Buttonset control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-buttonset',
			array(
				'callback'          => 'Elmispase_Buttonset_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_radio_select',
				),
			)
		);

		// Toggle control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-toggle',
			array(
				'callback'          => 'Elmispase_Toggle_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_checkbox',
				),
			)
		);

		// Divider control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-divider',
			array(
				'callback'          => 'Elmispase_Divider_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_false_values',
				),
			)
		);

		// Slider control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-slider',
			array(
				'callback'          => 'Elmispase_Slider_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_number',
				),
			)
		);

		// Custom control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-custom',
			array(
				'callback'          => 'Elmispase_Custom_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_false_values',
				),
			)
		);

		// Dropdown categories control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-dropdown-categories',
			array(
				'callback'          => 'Elmispase_Dropdown_Categories_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_dropdown_categories',
				),
			)
		);

		// Background control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-background',
			array(
				'callback'          => 'Elmispase_Background_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_background',
				),
			)
		);

		// Typography control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-typography',
			array(
				'callback'          => 'Elmispase_Typography_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_typography',
				),
			)
		);

		// Hidden control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-hidden',
			array(
				'callback'          => 'Elmispase_Hidden_Control',
				'sanitize_callback' => '',
			)
		);

		// Sortable control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-sortable',
			array(
				'callback'          => 'Elmispase_Sortable_Control',
				'sanitize_callback' => array(
					'Elmispase_Customizer_Sanitizes',
					'sanitize_sortable',
				),
			)
		);

		// Group control.
		Elmispase_Customize_Base_Control::add_control(
			'elmispase-group',
			array(
				'callback' => 'Elmispase_Group_Control',
			)
		);

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function customize_options_file_include() {

		// Include the required customize section and panels register file.
		require ELMISPASE_CUSTOMIZER_DIR . '/class-elmispase-customizer-register-sections-panels.php';

		/**
		 * Include the required customize options file.
		 */
		// Global.
		require ELMISPASE_CUSTOMIZER_DIR . '/options/global/class-elmispase-customize-colors-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/global/class-elmispase-customize-background-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/global/class-elmispase-customize-typography-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/global/class-elmispase-customize-layout-options.php';

		// Header.
		require ELMISPASE_CUSTOMIZER_DIR . '/options/header/class-elmispase-customize-site-identity-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/header/class-elmispase-customize-header-media-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/header/class-elmispase-customize-header-top-bar-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/header/class-elmispase-customize-primary-header-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/header/class-elmispase-customize-primary-menu-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/header/class-elmispase-customize-header-button.php';

		// Slider.
		require ELMISPASE_CUSTOMIZER_DIR . '/options/slider/class-elmispase-customize-slider-options.php';

		// Content.
		require ELMISPASE_CUSTOMIZER_DIR . '/options/content/class-elmispase-customize-page-header-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/content/class-elmispase-customize-blog-archive-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/content/class-elmispase-customize-single-post-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/content/class-elmispase-customize-page-options.php';

		// Additional.
		require ELMISPASE_CUSTOMIZER_DIR . '/options/social/class-elmispase-customize-social-icons-options.php';

		// Footer.
		require ELMISPASE_CUSTOMIZER_DIR . '/options/footer/class-elmispase-customize-footer-widgets-area-options.php';

		// WooCommerce.
		require ELMISPASE_CUSTOMIZER_DIR . '/options/woocommerce/class-elmispase-customize-woocommerce-sidebar-options.php';
		require ELMISPASE_CUSTOMIZER_DIR . '/options/woocommerce/class-elmispase-customize-woocommerce-design-options.php';
	}

}

return new Elmispase_Customizer();
