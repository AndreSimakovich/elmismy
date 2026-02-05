<?php
/**
 * Class to include Blog Single Post customize options.
 *
 * Class Elmispase_Customize_Single_Post_Options
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
 * Class to include Blog Single Post customize options.
 *
 * Class Elmispase_Customize_Single_Post_Options
 */
class Elmispase_Customize_Single_Post_Options extends Elmispase_Customize_Base_Option {

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
			 * Author Bio.
			 */
			array(
				'name'     => 'author_bio_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Author Bio', 'elmispase' ),
				'section'  => 'elmispase_single_post_section',
				'priority' => 10,
			),

			array(
				'name'      => 'elmispase_author_bio',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to enable the author bio section just below the post.', 'elmispase' ),
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.author-box',
				),
				'section'   => 'elmispase_single_post_section',
				'priority'  => 20,
			),

			/**
			 * Featured Image.
			 */
			array(
				'name'     => 'featured_image_single_post_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Featured Image In Single Post Page', 'elmispase' ),
				'section'  => 'elmispase_single_post_section',
				'priority' => 70,
			),

			array(
				'name'     => 'elmispase_featured_image_single_post_page',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to enable the featured image in single post page.', 'elmispase' ),
				'section'  => 'elmispase_single_post_section',
				'priority' => 80,
			),

			/**
			 * Related posts options.
			 */
			array(
				'name'     => 'related_post_heading',
				'type'     => 'control',
				'control'  => 'elmispase-title',
				'label'    => esc_html__( 'Related Posts', 'elmispase' ),
				'section'  => 'elmispase_single_post_section',
				'priority' => 160,
			),

			array(
				'name'     => 'elmispase_related_posts_activate',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to activate the related posts', 'elmispase' ),
				'section'  => 'elmispase_single_post_section',
				'priority' => 170,
			),

			array(
				'name'       => 'elmispase_related_posts',
				'default'    => 'categories',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Related Posts Must Be Shown As:', 'elmispase' ),
				'section'    => 'elmispase_single_post_section',
				'choices'    => array(
					'categories' => esc_html__( 'Related Posts By Categories', 'elmispase' ),
					'tags'       => esc_html__( 'Related Posts By Tags', 'elmispase' ),
				),
				'dependency' => array(
					'elmispase_related_posts_activate',
					'!=',
					0,
				),
				'priority'   => 180,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Elmispase_Customize_Single_Post_Options();
