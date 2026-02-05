<?php
/**
 * Class to include Header Media customize options.
 *
 * Class Elmispase_Customize_Header_Media_Options
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
 * Class to include Header Media customize options.
 *
 * Class Elmispase_Customize_Header_Media_Options
 */
class Elmispase_Customize_Header_Media_Options extends Elmispase_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$header_image_value = get_theme_mod( 'header_image' ) === 'remove-header' ? 'remove-header' : '';
		$header_video_value = get_theme_mod( 'header_video' ) === 0 ? 0 : '';

		$configs = array(

			array(
				'name'       => 'header_image_position_heading',
				'type'       => 'control',
				'control'    => 'elmispase-title',
				'label'      => esc_html__( 'Header Image Position', 'elmispase' ),
				'section'    => 'header_image',
				'dependency' => array(
					'conditions' => array(
						array(
							'header_image',
							'!=',
							$header_image_value,
						),
						array(
							'header_video',
							'!=',
							$header_video_value,
						),
						array(
							'external_header_video',
							'!=',
							'',
						),
					),
					'operator'   => 'OR',
				),
				'priority'   => 10,
			),

			// Header image position option.
			array(
				'name'       => 'elmispase_header_image_position',
				'default'    => 'above',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Header image display position', 'elmispase' ),
				'section'    => 'header_image',
				'choices'    => array(
					'above' => esc_html__( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'elmispase' ),
					'below' => esc_html__( 'Position Below: Display the Header image just below the site title and main menu part.', 'elmispase' ),
				),
				'dependency' => array(
					'conditions' => array(
						array(
							'header_image',
							'!=',
							$header_image_value,
						),
						array(
							'header_video',
							'!=',
							$header_video_value,
						),
						array(
							'external_header_video',
							'!=',
							'',
						),
					),
					'operator'   => 'OR',
				),
				'priority'   => 10,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new Elmispase_Customize_Header_Media_Options();
