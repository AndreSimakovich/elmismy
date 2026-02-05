<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class jElmispase_Customize_Slider_Options
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
 * Class to include Page customize options.
 *
 * Class Elmispase_Customize_Slider_Options
 */
class Elmispase_Customize_Slider_Options extends Elmispase_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			// Slider Activate heading.
			array(
				'name'    => 'slider_activate_heading',
				'type'    => 'control',
				'control' => 'elmispase-title',
				'label'   => esc_html__( 'Activate slider', 'elmispase' ),
				'section' => 'elmispase_slider_options',
			),

			array(
				'name'      => 'elmispase_activate_slider',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to activate slider.', 'elmispase' ),
				'section'   => 'elmispase_slider_options',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '#featured-slider',
					'render_callback' => '',
				),
			),

			// slider status heading.
			array(
				'name'       => 'slider_status_heading',
				'type'       => 'control',
				'control'    => 'elmispase-title',
				'label'      => esc_html__( 'Disable slider in Posts page', 'elmispase' ),
				'section'    => 'elmispase_slider_options',
				'dependency' => array(
					'elmispase_activate_slider',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'elmispase_blog_slider',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to disable slider in Posts Page', 'elmispase' ),
				'section'    => 'elmispase_slider_options',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '#featured-slider',
					'render_callback' => '',
				),
				'dependency' => array(
					'elmispase_activate_slider',
					'!=',
					0,
				),
			),
		);

		$options = array_merge( $options, $configs );

		for ( $i = 1; $i <= 5; $i++ ) {

			$configs[] = array(
				'name'       => 'slider_image_upload_heading' . $i,
				'type'       => 'control',
				'control'    => 'elmispase-title',
				'label'      => sprintf( esc_html__( 'Slider Content #%1$s', 'elmispase' ), $i ),
				'section'    => 'elmispase_slider_options',
				'dependency' => array(
					'elmispase_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'elmispase_slider_image' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'image',
				'label'      => esc_html__( 'Upload slider image.', 'elmispase' ),
				'section'    => 'elmispase_slider_options',
				'dependency' => array(
					'elmispase_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'elmispase_slider_title' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Enter title for your slider.', 'elmispase' ),
				'section'    => 'elmispase_slider_options',
				'dependency' => array(
					'elmispase_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'elmispase_slider_text' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'textarea',
				'label'      => esc_html__( 'Enter your slider description.', 'elmispase' ),
				'section'    => 'elmispase_slider_options',
				'dependency' => array(
					'elmispase_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'elmispase_slider_button_text' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Enter the button text. Default is "Read more"', 'elmispase' ),
				'section'    => 'elmispase_slider_options',
				'dependency' => array(
					'elmispase_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'elmispase_slider_link' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'url',
				'label'      => esc_html__( 'Enter link to redirect slider when clicked', 'elmispase' ),
				'section'    => 'elmispase_slider_options',
				'dependency' => array(
					'elmispase_activate_slider',
					'!=',
					0,
				),
			);
		}

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Slider_Options();
