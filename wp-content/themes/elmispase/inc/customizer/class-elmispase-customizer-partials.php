<?php
/**
 * Elmispase customizer class for theme customize partials.
 *
 * Class Elmispase_Customizer_Partials
 *
 * @package    ThemeGrill
 * @subpackage Elmispase
 * @since      Elmispase 2.4.5
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elmispase customizer class for theme customize partials.
 *
 * Class Elmispase_Customizer_Partials
 */
class Elmispase_Customizer_Partials {

	/**
	 * Render the Read Next text for selective refresh partial.
	 *
	 * @return void
	 */
	public static function read_more_text_render() { ?>
		<a class="read-more" href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod( 'elmispase_read_more_text', __( 'Read more', 'elmispase' ) ) ); ?></a>
	<?php }

	public static function elmispase_header_info_text() {
		if ( get_theme_mod( 'elmispase_header_info_text', '' ) == '' ) {
			return;
		}

		$elmispase_header_info_text = '<div class="small-info-text"><p>' . get_theme_mod( 'elmispase_header_info_text', '' ) . '</p></div>';

		echo do_shortcode( $elmispase_header_info_text );
	}

	public static function elmispase_breadcrumb() {

		// NavXT
		if ( function_exists( 'bcn_display' ) ) {

			echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
			echo '<span class="breadcrumb-title">' . wp_kses_post( get_theme_mod( 'elmispase_custom_breadcrumb_text', __( 'You are here: ', 'elmispase' ) ) ) . '</span>';
			bcn_display();
			echo '</div> <!-- .breadcrumb : NavXT -->';

		} elseif ( function_exists( 'yoast_breadcrumb' ) ) { // SEO by Yoast

			yoast_breadcrumb(
				'<div class="breadcrumb">' . '<span class="breadcrumb-title">' . wp_kses_post( get_theme_mod( 'elmispase_custom_breadcrumb_text', __( 'You are here: ', 'elmispase' ) ) ) . '</span>',
				'</div> <!-- .breadcrumb : Yoast -->'
			);

		}
	}

	public static function elmispase_taxonomy_description() {
		?>

		<div class="taxonomy-description">
			<?php
			if ( get_theme_mod( 'elmispase_term_description', 0 ) == 1 ) :
				// Show term description for category.
				$term_description = term_description();

				if ( ! empty( $term_description ) ) :
					printf( '%s', $term_description );
				endif;

			endif;
			?>
		</div>

		<?php
	}

	public static function elmispase_footer_copyright() {

		$default_footer_value = get_theme_mod( 'elmispase_footer_editor', __( 'Copyright &copy; ', 'elmispase' ) . '[the-year] [site-link] ' . __( 'Theme by: ', 'elmispase' ) . '[tg-link] ' . __( 'Powered by: ', 'elmispase' ) . '[wp-link]' );

		$elmispase_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';

		echo do_shortcode( $elmispase_footer_copyright );
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

}
