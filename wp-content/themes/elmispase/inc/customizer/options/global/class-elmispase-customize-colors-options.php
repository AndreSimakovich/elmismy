<?php
/**
 * Class to include Colors customize options.
 *
 * Class Elmispase_Customize_Colors_Options
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
 * Class to include Colors customize options.
 *
 * Class Elmispase_Customize_Colors_Options
 */
class Elmispase_Customize_Colors_Options extends Elmispase_Customize_Base_Option {

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
			 * Primary Colors.
			 */
			// Primary color option.
			array(
				'name'     => 'elmispase_primary_color',
				'default'  => '#0FBE7C',
				'type'     => 'control',
				'control'  => 'elmispase-color',
				'label'    => esc_html__( 'Primary Color', 'elmispase' ),
				'section'  => 'elmispase_primary_colors_section',
				'priority' => 5,
			),

			// Skin color option.
			array(
				'name'     => 'elmispase_color_skin',
				'default'  => 'light',
				'type'     => 'control',
				'control'  => 'elmispase-radio-image',
				'label'    => esc_html__( 'Color Skin', 'elmispase' ),
				'section'  => 'elmispase_skin_color_section',
				'choices'  => array(
					'light' => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/light-color.jpg',
					),
					'dark'  => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/dark-color.jpg',
					),
				),
				'priority' => 0,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Colors_Options();
