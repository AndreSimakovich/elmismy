<?php
/**
 * Class to include Header General customize options.
 *
 * Class Elmispase_Customize_Primary_Header_Options
 *
 * @package    ThemeGrill
 * @subpackage Elmispase
 * @since      Elmispase 1.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Header General customize options.
 *
 * Class Elmispase_Customize_Primary_Header_Options
 */
class Elmispase_Customize_Primary_Header_Options extends Elmispase_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			array(
				'name'     => 'header_display_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Header Display Type', 'elmispase' ),
				'section'  => 'elmispase_header_main',
				'priority' => 5,
			),

			// Main total header area display type option.
			array(
				'name'      => 'elmispase_header_display_type',
				'default'   => 'one',
				'type'      => 'control',
				'control'   => 'elmispase-radio-image',
				'label'     => esc_html__( 'Choose the header display type that you want.', 'elmispase' ),
				'section'   => 'elmispase_header_main',
				'choices'   => array(
					'one'  => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/header-left.png',
					),
					'four' => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/menu-bottom.png',
					),
				),
				'image_col' => 2,
				'priority'  => 10,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Primary_Header_Options();
