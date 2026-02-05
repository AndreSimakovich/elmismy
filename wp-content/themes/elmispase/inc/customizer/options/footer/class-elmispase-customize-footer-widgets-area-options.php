<?php

/**
 * Class to include Color Footer customize options.
 *
 * Class Elmispase_Customize_Color_Footer_Options
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
 * Class to include Color Footer customize options.
 *
 * Class Elmispase_Customize_Color_Footer_Options
 */
class Elmispase_Customize_Footer_widgets_Area_Options extends Elmispase_Customize_Base_Option {

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
				'name'     => 'footer_widget_column_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Footer Widgets Column', 'elmispase' ),
				'section'  => 'elmispase_footer_widgets_area_section',
				'priority' => 10,
			),

			array(
				'name'      => 'elmispase_footer_widget_column_select_type',
				'default'   => 'four',
				'type'      => 'control',
				'control'   => 'elmispase-radio-image',
				'label'     => esc_html__( 'Choose the number of column for the footer widgetized areas.', 'elmispase' ),
				'section'   => 'elmispase_footer_widgets_area_section',
				'choices'   => array(
					'one'   => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/sidebar-layout-full-column.png',
					),
					'two'   => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/sidebar-layout-two-column.png',
					),
					'three' => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/sidebar-layout-third-column.png',
					),
					'four'  => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/sidebar-layout-fourth-column.png',
					),
				),
				'image_col' => 3,
				'priority'  => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Footer_widgets_Area_Options();

