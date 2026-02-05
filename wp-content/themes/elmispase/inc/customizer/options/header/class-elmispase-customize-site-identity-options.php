<?php
/**
 * Class to include Header Main Area customize options.
 *
 * Class Elmispase_Customize_Site_Identity_Options
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
 * Class to include Header Main Area customize options.
 *
 * Class Elmispase_Customize_Site_Identity_Options
 */
class Elmispase_Customize_Site_Identity_Options extends Elmispase_Customize_Base_Option {

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
				'name'     => 'logo_text_visibility_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Visibility', 'elmispase' ),
				'section'  => 'title_tagline',
				'priority' => 0,
			),

			// Header logo placement option.
			array(
				'name'     => 'elmispase_show_header_logo_text',
				'default'  => 'text_only',
				'type'     => 'control',
				'control'  => 'radio',
				'label'    => esc_html__( 'Choose the option that you want.', 'elmispase' ),
				'section'  => 'title_tagline',
				'choices'  => array(
					'logo_only' => esc_html__( 'Header Logo Only', 'elmispase' ),
					'text_only' => esc_html__( 'Header Text Only', 'elmispase' ),
					'both'      => esc_html__( 'Show Both', 'elmispase' ),
					'none'      => esc_html__( 'Disable', 'elmispase' ),
				),
				'priority' => 1,
			),

			array(
				'name'     => 'site_logo_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Site Logo', 'elmispase' ),
				'section'  => 'title_tagline',
				'priority' => 5,
			),

			array(
				'name'     => 'elmispase_different_retina_logo',
				'type'     => 'control',
				'control'  => 'checkbox',
				'default'  => 0,
				'label'    => esc_html__( 'Different Logo for Retina Devices?', 'elmispase' ),
				'section'  => 'title_tagline',
				'priority' => 6,
			),

			array(
				'name'       => 'elmispase_retina_logo_upload',
				'type'       => 'control',
				'control'    => 'image',
				'label'      => esc_html__( 'Retina Logo', 'elmispase' ),
				'section'    => 'title_tagline',
				'priority'   => 7,
				'dependency' => array(
					'elmispase_different_retina_logo',
					'!=',
					0,
				),
			),

			array(
				'name'     => 'site_icon_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Site Icon', 'elmispase' ),
				'section'  => 'title_tagline',
				'priority' => 8,
			),

			array(
				'name'     => 'site_title_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Site Title', 'elmispase' ),
				'section'  => 'title_tagline',
				'priority' => 9,
			),

			array(
				'name'     => 'site_tagline_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Site Tagline', 'elmispase' ),
				'section'  => 'title_tagline',
				'priority' => 10,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'header_text_color_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Colors', 'elmispase' ),
				'section'  => 'title_tagline',
				'priority' => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Site_Identity_Options();
