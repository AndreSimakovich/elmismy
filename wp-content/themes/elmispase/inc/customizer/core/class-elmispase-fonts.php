<?php
/**
 * Helper class for font settings for this theme.
 *
 * Class Elmispase_Fonts
 *
 * @package    ThemeGrill
 * @subpackage Elmispase
 * @since      Elmispase 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper class for font settings for this theme.
 *
 * Class Elmispase_Fonts
 */
class Elmispase_Fonts {

	/**
	 * System Fonts
	 *
	 * @var array
	 */
	public static $system_fonts = array();

	/**
	 * Google Fonts
	 *
	 * @var array
	 */
	public static $google_fonts = array();

	/**
	 * Custom Fonts
	 *
	 * @var array
	 */
	public static $custom_fonts = array();

	/**
	 * Font variants
	 *
	 * @var array
	 */
	public static $font_variants = array();

	/**
	 * Google font subsets
	 *
	 * @var array
	 */
	public static $google_font_subsets = array();

	/**
	 * Get system fonts.
	 *
	 * @return mixed|void
	 */
	public static function get_system_fonts() {

		if ( empty( self::$system_fonts ) ) :

			self::$system_fonts = array(

				'default'                                                                                                                              => array(
					'family' => 'default',
					'label'  => 'Default',
				),
				'Georgia,Times,"Times New Roman",serif'                                                                                                 => array(
					'family' => 'Georgia,Times,"Times New Roman",serif',
					'label'  => 'serif',
				),
				'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif' => array(
					'family' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif',
					'label'  => 'sans-serif',
				),
				'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace'                                                   => array(
					'family' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
					'label'  => 'monospace',
				),

			);

		endif;

		return apply_filters( 'elmispase_system_fonts', self::$system_fonts );

	}

	/**
	 * Get Google fonts.
	 * It's array is generated from the google-fonts.json file.
	 *
	 * @return mixed|void
	 */
	public static function get_google_fonts() {

		if ( empty( self::$google_fonts ) ) :

			global $wp_filesystem;
			$google_fonts_file = apply_filters( 'elmispase_google_fonts_json_file', dirname(__FILE__) . '/custom-controls/typography/google-fonts.json' );

			if ( ! file_exists( dirname(__FILE__) . '/custom-controls/typography/google-fonts.json' ) ) {
				return array();
			}

			// Require `file.php` file of WordPress to include filesystem check for getting the file contents.
			if ( ! $wp_filesystem ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
			}

			// Proceed only if the file is readable.
			if ( is_readable( $google_fonts_file ) ) {
				WP_Filesystem();

				$file_contents     = $wp_filesystem->get_contents( $google_fonts_file );
				$google_fonts_json = json_decode( $file_contents, 1 );

				foreach ( $google_fonts_json['items'] as $key => $font ) {

					$google_fonts[ $font['family'] ] = array(
						'family'   => $font['family'],
						'label'    => $font['family'],
						'variants' => $font['variants'],
						'subsets'  => $font['subsets'],
					);

					self::$google_fonts = $google_fonts;

				}
			}

		endif;

		return apply_filters( 'elmispase_system_fonts', self::$google_fonts );

	}

	/**
	 * Get custom fonts.
	 *
	 * @return mixed|void
	 */
	public static function get_custom_fonts() {

		return apply_filters( 'elmispase_custom_fonts', self::$custom_fonts );

	}

	/**
	 * Get font variants.
	 *
	 * @return mixed|void
	 */
	public static function get_font_variants() {

		if ( empty( self::$font_variants ) ) :

			self::$font_variants = array(
				'100'       => esc_html__( 'Thin 100', 'elmispase' ),
				'100italic' => esc_html__( 'Thin 100 Italic', 'elmispase' ),
				'200'       => esc_html__( 'Extra-Light 200', 'elmispase' ),
				'200italic' => esc_html__( 'Extra-Light 200 Italic', 'elmispase' ),
				'300'       => esc_html__( 'Light 300', 'elmispase' ),
				'300italic' => esc_html__( 'Light 300 Italic', 'elmispase' ),
				'regular'   => esc_html__( 'Regular 400', 'elmispase' ),
				'italic'    => esc_html__( 'Regular 400 Italic', 'elmispase' ),
				'500'       => esc_html__( 'Medium 500', 'elmispase' ),
				'500italic' => esc_html__( 'Medium 500 Italic', 'elmispase' ),
				'600'       => esc_html__( 'Semi-Bold 600', 'elmispase' ),
				'600italic' => esc_html__( 'Semi-Bold 600 Italic', 'elmispase' ),
				'700'       => esc_html__( 'Bold 700', 'elmispase' ),
				'700italic' => esc_html__( 'Bold 700 Italic', 'elmispase' ),
				'800'       => esc_html__( 'Extra-Bold 800', 'elmispase' ),
				'800italic' => esc_html__( 'Extra-Bold 800 Italic', 'elmispase' ),
				'900'       => esc_html__( 'Black 900', 'elmispase' ),
				'900italic' => esc_html__( 'Black 900 Italic', 'elmispase' ),
			);

		endif;

		return apply_filters( 'elmispase_font_variants', self::$font_variants );

	}

	/**
	 * Get Google font subsets.
	 *
	 * @return mixed|void
	 */
	public static function get_google_font_subsets() {

		if ( empty( self::$google_font_subsets ) ) :

			self::$google_font_subsets = array(
				'arabic'              => esc_html__( 'Arabic', 'elmispase' ),
				'bengali'             => esc_html__( 'Bengali', 'elmispase' ),
				'chinese-hongkong'    => esc_html__( 'Chinese (Hong Kong)', 'elmispase' ),
				'chinese-simplified'  => esc_html__( 'Chinese (Simplified)', 'elmispase' ),
				'chinese-traditional' => esc_html__( 'Chinese (Traditional)', 'elmispase' ),
				'cyrillic'            => esc_html__( 'Cyrillic', 'elmispase' ),
				'cyrillic-ext'        => esc_html__( 'Cyrillic Extended', 'elmispase' ),
				'devanagari'          => esc_html__( 'Devanagari', 'elmispase' ),
				'greek'               => esc_html__( 'Greek', 'elmispase' ),
				'greek-ext'           => esc_html__( 'Greek Extended', 'elmispase' ),
				'gujarati'            => esc_html__( 'Gujarati', 'elmispase' ),
				'gurmukhi'            => esc_html__( 'Gurmukhi', 'elmispase' ),
				'hebrew'              => esc_html__( 'Hebrew', 'elmispase' ),
				'japanese'            => esc_html__( 'Japanese', 'elmispase' ),
				'kannada'             => esc_html__( 'Kannada', 'elmispase' ),
				'khmer'               => esc_html__( 'Khmer', 'elmispase' ),
				'korean'              => esc_html__( 'Korean', 'elmispase' ),
				'latin'               => esc_html__( 'Latin', 'elmispase' ),
				'latin-ext'           => esc_html__( 'Latin Extended', 'elmispase' ),
				'malayalam'           => esc_html__( 'Malayalam', 'elmispase' ),
				'myanmar'             => esc_html__( 'Myanmar', 'elmispase' ),
				'oriya'               => esc_html__( 'Oriya', 'elmispase' ),
				'sinhala'             => esc_html__( 'Sinhala', 'elmispase' ),
				'tamil'               => esc_html__( 'Tamil', 'elmispase' ),
				'telugu'              => esc_html__( 'Telugu', 'elmispase' ),
				'thai'                => esc_html__( 'Thai', 'elmispase' ),
				'tibetan'             => esc_html__( 'Tibetan', 'elmispase' ),
				'vietnamese'          => esc_html__( 'Vietnamese', 'elmispase' ),
			);

		endif;

		return apply_filters( 'elmispase_font_variants', self::$google_font_subsets );

	}

}
