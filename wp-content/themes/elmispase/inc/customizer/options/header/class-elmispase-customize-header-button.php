<?php
/**
 * Class to include Header button customize options.
 *
 * Class Elmispase_Customize_Header_Button_Options
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
 * Class to include Header button customize options.
 *
 * Class Elmispase_Customize_Header_Button_Options
 */
class Elmispase_Customize_Header_Button_Options extends Elmispase_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			// Header button one option.
			array(
				'name'     => 'elmispase_header_button_one_setting',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'text',
				'label'    => esc_html__( 'Button Text', 'elmispase' ),
				'section'  => 'elmispase_header_button_one',
				'priority' => 15,
			),

			// Header button one option.
			array(
				'name'     => 'elmispase_header_button_one_link',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'url',
				'label'    => esc_html__( 'Button Link', 'elmispase' ),
				'section'  => 'elmispase_header_button_one',
				'priority' => 15,
			),

			array(
				'name'     => 'elmispase_header_button_one_tab',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show in new tab', 'elmispase' ),
				'section'  => 'elmispase_header_button_one',
				'priority' => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Header_Button_Options();
