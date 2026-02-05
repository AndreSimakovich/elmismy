<?php
/**
 * Class to include Header button customize options.
 *
 * Class Elmispase_Customize_Page_Header_options
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
 * Class Elmispase_Customize_Page_Header_options
 */
class Elmispase_Customize_Page_Header_options extends Elmispase_Customize_Base_Option {

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

			array(
				'name'    => 'header_title_heading',
				'type'    => 'control',
				'control' => 'elmispase-title',
				'label'   => esc_html__( 'Header Title', 'elmispase' ),
				'section' => 'elmispase_post_page_content_options',
			),

			array(
				'name'    => 'elmispase_header_title_hide',
				'default' => 0,
				'type'    => 'control',
				'control' => 'checkbox',
				'label'   => esc_html__( 'Hide page/post header title', 'elmispase' ),
				'section' => 'elmispase_post_page_content_options',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Page_Header_options();
