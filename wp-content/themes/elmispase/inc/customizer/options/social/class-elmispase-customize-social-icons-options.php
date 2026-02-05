<?php
/**
 * Class to include Social customize options.
 *
 * Class Elmispase_Customize_Social_Icons_Options
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
 * Class to include Social customize option.
 *
 * Class Elmispase_Customize_Social_Icons_Options
 */
class Elmispase_Customize_Social_Icons_Options extends Elmispase_Customize_Base_Option {

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
			 * Social Icons.
			 */
			array(
				'name'    => 'social_link_activation_heading',
				'type'    => 'control',
				'control' => 'elmispase-title',
				'label'   => esc_html__( 'Activate social links area', 'elmispase' ),
				'section' => 'elmispase_social_links_options',
			),

			// Social links enable/disable option.
			array(
				'name'      => 'elmispase_activate_social_links',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to activate social links area. You also need to activate the header top bar section in Header options to show this social links area', 'elmispase' ),
				'section'   => 'elmispase_social_links_options',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.social-links',
				),
			),

			array(
				'name'       => 'social_icon_heading',
				'type'       => 'control',
				'control'    => 'elmispase-title',
				'label'      => esc_html__( 'Social Icon', 'elmispase' ),
				'section'    => 'elmispase_social_links_options',
				'dependency' => array(
					'elmispase_activate_social_links',
					'!=',
					0,
				),
			),

		);

		$options = array_merge( $options, $configs );

		// Social links lists.
		$elmispase_social_links = array(
			'elmispase_social_facebook'  => esc_html__( 'Facebook', 'elmispase' ),
			'elmispase_social_twitter'   => esc_html__( 'Twitter', 'elmispase' ),
			'elmispase_social_instagram' => esc_html__( 'Instagram', 'elmispase' ),
			'elmispase_social_linkedin'  => esc_html__( 'LinkedIn', 'elmispase' )
		);

		$i = 1;

		// Available social links via theme.
		foreach ( $elmispase_social_links as $key => $value ) {

			// Social links url option.
			$configs[] = array(
				'name'       => $key,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'url',
				'label'      => sprintf( 'Add link for %1$s', $value ),
				'section'    => 'elmispase_social_links_options',
				'dependency' => array(
					'elmispase_activate_social_links',
					'!=',
					0,
				),
			);

			// Social links open in new tab enable/disable option.
			$configs[] = array(
				'name'       => $key . 'new_tab',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to show in new tab', 'elmispase' ),
				'section'    => 'elmispase_social_links_options',
				'dependency' => array(
					'elmispase_activate_social_links',
					'!=',
					0,
				),
			);

			// Social links separator.
			$configs[] = array(
				'name'       => $key . '_additional',
				'type'       => 'control',
				'control'    => 'elmispase-divider',
				'section'    => 'elmispase_social_links_options',
				'dependency' => array(
					'elmispase_activate_social_links',
					'!=',
					0,
				),
			);

			$i++;

		}

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Social_Icons_Options();
