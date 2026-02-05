<?php
/**
 * Class to register panels and sections for customize options.
 *
 * Class Elmispase_Customize_Register_Section_Panels
 *
 * @package    ThemeGrill
 * @subpackage elmispase
 * @since      Elmispase 1.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to register panels and sections for customize options.
 *
 * Class Elmispase_Customize_Register_Section_Panels
 */
class Elmispase_Customize_Register_Section_Panels extends Elmispase_Customize_Base_Option {

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
			 * Panels.
			 */
			array(
				'name'     => 'elmispase_global_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Global', 'elmispase' ),
				'priority' => 10,
			),

			array(
				'name'     => 'elmispase_header_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Header', 'elmispase' ),
				'priority' => 20,
			),

			array(
				'name'     => 'elmispase_slider_options',
				'type'     => 'section',
				'title'    => esc_html__( 'Slider', 'elmispase' ),
				'priority' => 30,
			),

			array(
				'name'     => 'elmispase_content_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Content', 'elmispase' ),
				'priority' => 40,
			),

			array(
				'name'     => 'elmispase_footer_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Footer', 'elmispase' ),
				'priority' => 50,
			),

			// Separator.
			array(
				'name'             => 'separator',
				'type'             => 'section',
				'priority'         => 80,
				'section_callback' => 'elmispase_WP_Customize_Separator',
			),

			/**
			 * Global.
			 */
			// Colors.
			array(
				'name'     => 'elmispase_global_color_setting',
				'type'     => 'section',
				'title'    => esc_html__( 'Colors', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'priority' => 10,
			),

			array(
				'name'     => 'elmispase_primary_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Colors', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'section'  => 'elmispase_global_color_setting',
				'priority' => 10,
			),

			array(
				'name'     => 'elmispase_skin_color_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Color Skin', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'section'  => 'elmispase_global_color_setting',
				'priority' => 30,
			),

			// Background.
			array(
				'name'     => 'elmispase_global_background_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Background', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'priority' => 20,
			),

			// Layout.
			array(
				'name'     => 'elmispase_global_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Layout', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'priority' => 30,
			),

			array(
				'name'     => 'elmispase_site_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Layout', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'section'  => 'elmispase_global_layout_section',
				'priority' => 10,
			),

			array(
				'name'     => 'elmispase_sidebar_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar Layout', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'section'  => 'elmispase_global_layout_section',
				'priority' => 20,
			),

			// Typography.
			array(
				'name'     => 'elmispase_global_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Typography', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'priority' => 40,
			),

			array(
				'name'     => 'elmispase_base_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Base', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'section'  => 'elmispase_global_typography_section',
				'priority' => 10,
			),

			array(
				'name'     => 'elmispase_headings_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Headings', 'elmispase' ),
				'panel'    => 'elmispase_global_options',
				'section'  => 'elmispase_global_typography_section',
				'priority' => 20,
			),

			/**
			 * Header.
			 */
			array(
				'name'     => 'title_tagline',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Identity', 'elmispase' ),
				'panel'    => 'elmispase_header_options',
				'priority' => 5,
			),

			array(
				'name'     => 'elmispase_header_top_bar',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Bar', 'elmispase' ),
				'panel'    => 'elmispase_header_options',
				'priority' => 20,
			),

			array(
				'name'     => 'elmispase_header_main',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Header', 'elmispase' ),
				'panel'    => 'elmispase_header_options',
				'priority' => 30,
			),

			array(
				'name'     => 'elmispase_header_primary_menu',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Menu', 'elmispase' ),
				'panel'    => 'elmispase_header_options',
				'priority' => 40,
			),

			array(
				'name'     => 'elmispase_header_button',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Button', 'elmispase' ),
				'panel'    => 'elmispase_header_options',
				'priority' => 50,
			),

			array(
				'name'     => 'elmispase_header_button_one',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Button One', 'elmispase' ),
				'panel'    => 'elmispase_header_options',
				'section'  => 'elmispase_header_button',
				'priority' => 20,
			),

			/**
			 * Content.
			 */
			array(
				'name'     => 'elmispase_post_page_content_options',
				'type'     => 'section',
				'title'    => esc_html__( 'Page Header', 'elmispase' ),
				'panel'    => 'elmispase_content_options',
				'priority' => 10,
			),

			array(
				'name'     => 'elmispase_blog_content_options',
				'type'     => 'section',
				'title'    => esc_html__( 'Blog / Archive', 'elmispase' ),
				'panel'    => 'elmispase_content_options',
				'priority' => 20,
			),

			array(
				'name'     => 'elmispase_single_post_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Single Post', 'elmispase' ),
				'panel'    => 'elmispase_content_options',
				'priority' => 30,
			),


			array(
				'name'     => 'elmispase_page_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Page', 'elmispase' ),
				'panel'    => 'elmispase_content_options',
				'priority' => 50,
			),

			/**
			 * Footer.
			 */

			array(
				'name'     => 'elmispase_footer_widgets_area_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Footer Widgets Area', 'elmispase' ),
				'panel'    => 'elmispase_footer_options',
				'priority' => 20,
			),


			/**
			 * Additional.
			 */
			array(
				'name'     => 'elmispase_social_links_options',
				'type'     => 'section',
				'title'    => esc_html__( 'Social Icons', 'elmispase' ),
				'priority' => 10,
			),

			/**
			 * WooCommerce.
			 */
			array(
				'name'     => 'elmispase_woocommerce_page_layout_setting',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar', 'elmispase' ),
				'panel'    => 'woocommerce',
				'priority' => 1,
			),

			array(
				'name'     => 'elmispase_woocommerce_button_design',
				'type'     => 'section',
				'title'    => esc_html__( 'Design', 'elmispase' ),
				'panel'    => 'woocommerce',
				'priority' => 2,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Register_Section_Panels();
