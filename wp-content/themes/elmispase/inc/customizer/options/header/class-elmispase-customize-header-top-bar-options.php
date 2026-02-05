<?php
/**
 * Class to include Header Top Bar customize options.
 *
 * Class Elmispase_Customize_Header_Top_Bar_Options
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
 * Class to include Header Top Bar customize options.
 *
 * Class Elmispase_Customize_Header_Top_Bar_Options
 */
class Elmispase_Customize_Header_Top_Bar_Options extends Elmispase_Customize_Base_Option {

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

			/**
			 * Tob bar Activation.
			 */
			array(
				'name'     => 'header_top_bar_active_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Activate Header Top Bar', 'elmispase' ),
				'section'  => 'elmispase_header_top_bar',
				'priority' => 10,
			),

			array(
				'name'     => 'elmispase_activate_top_header_bar',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show top header bar. The top header bar includes social icons area, small text area and menu area.', 'elmispase' ),
				'section'  => 'elmispase_header_top_bar',
				'priority' => 15,
			),

			// Header Info text option.
			array(
				'name'       => 'header_info_text_heading',
				'type'       => 'control',
				'control'    => 'elmispase-title',
				'label'      => esc_html__( 'Header Info Text', 'elmispase' ),
				'section'    => 'elmispase_header_top_bar',
				'priority'   => 20,
				'dependency' => array(
					'elmispase_activate_top_header_bar',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'elmispase_header_info_text',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'textarea',
				'label'      => esc_html__( 'You can add phone numbers, other contact info here as you like. This box also accepts shortcodes.', 'elmispase' ),
				'section'    => 'elmispase_header_top_bar',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.small-info-text p',
					'render_callback' => array(
						'Elmispase_Customizer_Partials',
						'elmispase_header_info_text',
					),
				),
				'dependency' => array(
					'elmispase_activate_top_header_bar',
					'!=',
					0,
				),
				'priority'   => 25,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Header_Top_Bar_Options();
