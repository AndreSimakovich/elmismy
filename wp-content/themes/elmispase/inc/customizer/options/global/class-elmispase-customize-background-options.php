<?php
/**
 * Class to include Background customize options.
 *
 * Class Elmispase_Customize_Background_Options
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
 * Class to include Background customize option.
 *
 * Class Elmispase_Customize_Background_Options
 */
class Elmispase_Customize_Background_Options extends Elmispase_Customize_Base_Option {

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
			 * Global color background options.
			 */
			// Outside container design options heading separator.
			array(
				'name'     => 'global_background_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Outside Container', 'elmispase' ),
				'section'  => 'elmispase_global_background_section',
				'priority' => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Background_Options();
