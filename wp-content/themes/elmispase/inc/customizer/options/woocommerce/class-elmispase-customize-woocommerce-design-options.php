<?php
/**
 * Class to include Design WooCommerce customize options.
 *
 * Class Elmispase_Customize_WooCommerce_Design_Options
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
 * Bail out if `WooCommerce` plugin is not installed and activated.
 */
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Class to include Design WooCommerce customize options.
 *
 * Class Elmispase_Customize_WooCommerce_Design_Options
 */
class Elmispase_Customize_WooCommerce_Design_Options extends Elmispase_Customize_Base_Option {

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
				'name'     => 'woocommerce_cart_icon_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Cart Icon', 'elmispase' ),
				'section'  => 'elmispase_woocommerce_button_design',
				'priority' => 10,
			),

			array(
				'name'     => 'elmispase_cart_icon',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show WooCommerce cart icon on menu bar', 'elmispase' ),
				'section'  => 'elmispase_woocommerce_button_design',
				'priority' => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new Elmispase_Customize_WooCommerce_Design_Options();
