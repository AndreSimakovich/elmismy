<?php
/**
 * Class to include Typography General customize options.
 *
 * Class Elmispase_Customize_Typography_options
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
 * Class to include Typography General customize options.
 *
 * Class Elmispase_Customize_Typography_options
 */
class Elmispase_Customize_Typography_options extends Elmispase_Customize_Base_Option {

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

			/**
			 * Content.
			 */
			array(
				'name'     => 'elmispase_body_font_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Body', 'elmispase' ),
				'section'  => 'elmispase_base_typography_section',
				'priority' => 5,
			),

			array(
				'name'     => 'elmispase_content_font_typography',
				'default'  => array(
					'font-family' => 'Lato',
				),
				'type'     => 'control',
				'control'  => 'elmispase-typography',
				'section'  => 'elmispase_base_typography_section',
				'priority' => 15,
			),

			/**
			 * Headings.
			 */
			array(
				'name'     => 'elmispase_headings_typography_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Headings', 'elmispase' ),
				'section'  => 'elmispase_headings_typography_section',
				'priority' => 5,
			),

			array(
				'name'     => 'elmispase_titles_font_typography',
				'default'  => array(
					'font-family' => 'Lato',
				),
				'type'     => 'control',
				'control'  => 'elmispase-typography',
				'section'  => 'elmispase_headings_typography_section',
				'priority' => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Typography_options();
