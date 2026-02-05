<?php
/**
 * Class to include Layout customize options.
 *
 * Class Elmispase_Customize_Layout_Options
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
 * Class to include Layout customize options.
 *
 * Class Elmispase_Customize_Layout_Options
 */
class Elmispase_Customize_Layout_Options extends Elmispase_Customize_Base_Option {

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

			// Site layout option.
			array(
				'name'     => 'elmispase_site_layout',
				'default'  => 'box_1218px',
				'type'     => 'control',
				'control'  => 'radio',
				'label'    => esc_html__( 'Choose your site layout. The change is reflected in whole site.', 'elmispase' ),
				'section'  => 'elmispase_site_layout_section',
				'choices'  => array(
					'box_1218px'  => esc_html__( 'Boxed layout with content width of 1218px', 'elmispase' ),
					'box_978px'   => esc_html__( 'Boxed layout with content width of 978px', 'elmispase' ),
					'wide_1218px' => esc_html__( 'Wide layout with content width of 1218px', 'elmispase' ),
					'wide_978px'  => esc_html__( 'Wide layout with content width of 978px', 'elmispase' ),
				),
				'priority' => 10,
			),

			// Default layout option.
			array(
				'name'      => 'elmispase_default_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'elmispase-radio-image',
				'label'     => esc_html__( 'Default layout', 'elmispase' ),
				'section'   => 'elmispase_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'                => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                 => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'        => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered'  => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
					'no_sidebar_content_stretched' => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
					),
				),
				'image_col' => 3,
				'priority'  => 5,
			),

			// Default layout for pages only option.
			array(
				'name'      => 'elmispase_pages_default_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'elmispase-radio-image',
				'label'     => esc_html__( 'Default layout for pages only', 'elmispase' ),
				'section'   => 'elmispase_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'                => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                 => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'        => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered'  => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
					'no_sidebar_content_stretched' => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
					),
				),
				'image_col' => 3,
				'priority'  => 10,
			),

			// Default layout for single posts page only option.
			array(
				'name'      => 'elmispase_single_posts_default_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'elmispase-radio-image',
				'label'     => esc_html__( 'Default layout for single posts only', 'elmispase' ),
				'section'   => 'elmispase_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'                => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                 => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'        => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered'  => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
					'no_sidebar_content_stretched' => array(
						'label' => '',
						'url'   => ELMISPASE_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
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

return new Elmispase_Customize_Layout_Options();
