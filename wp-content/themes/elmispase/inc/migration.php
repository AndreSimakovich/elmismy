<?php
/**
 * Migration scripts for Elmispase theme.
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
 * Migrate all of the customize options for 1.9.0 theme update.
 *
 * @since Elmispase 1.9.0
 */
function elmispase_major_controls_migrate() {

	$demo_import_migration = elmispase_demo_import_migration();

	if ( ! $demo_import_migration ) {

		if ( get_option( 'elmispase_major_controls_migrate' ) ) {
			return;
		}

	}

	// Get theme options.
	$themename              = get_option( 'stylesheet' );
	$themename              = preg_replace( "/\W/", "_", strtolower( $themename ) );
	$elmispase_theme_options = get_option( $themename );

	// Base heading.
	$elmispase_content_font = isset( $elmispase_theme_options['elmispase_content_font'] ) ? $elmispase_theme_options['elmispase_content_font'] : 'Lato';

	// All heading
	$elmispase_titles_font = isset( $elmispase_theme_options['elmispase_titles_font'] ) ? $elmispase_theme_options['elmispase_titles_font'] : 'Lato';


	if ( 'Lato' !== $elmispase_content_font ) {
		$elmispase_theme_options['elmispase_content_font_typography'] = array(
			'font-family' => $elmispase_content_font,
		);
	}

	if ( 'Lato' !== $elmispase_titles_font ) {
		$elmispase_theme_options['elmispase_titles_font_typography'] = array(
			'font-family' => $elmispase_titles_font,
		);
	}

	// Delete options data.
	$elmispase_remove_theme_options = array(
		'elmispase_content_font',
		'elmispase_titles_font',
	);

	foreach ( $elmispase_remove_theme_options as $elmispase_remove_theme_option ) {
		unset( $elmispase_theme_options[ $elmispase_remove_theme_option ] );
	}

	// Finally, update elmispase theme options.
	update_option( 'elmispase', $elmispase_theme_options );

	// Set a flag.
	update_option( 'elmispase_major_controls_migrate', 1 );
}

add_action( 'after_setup_theme', 'elmispase_major_controls_migrate' );


/**
 * Migrate Options Framework data to Customizer
 *
 */
function elmispase_options_migrate() {

	$demo_import_migration = elmispase_demo_import_migration();

	// Migrate the customize option if migration is done manually.
	if ( ! $demo_import_migration ) {

		// Shifting Users data from Theme Option to Customizer
		if ( get_option( 'elmispase_customizer_transfer' ) ) {
			return;
		}
	}

	// Set transfer
	update_option( 'elmispase_customizer_transfer', 1 );

	$elmispase_themename      = get_option( 'stylesheet' );
	$elmispase_themename_preg = preg_replace( '/\W/', '_', strtolower( $elmispase_themename ) );
	if ( false === ( $mods = get_option( $elmispase_themename_preg ) ) ) {
		return;
	}

	$elmispase_theme_options = array();
	$elmispase_theme_mods    = array();

	// When child theme is active.
	if ( is_child_theme() ) {
		$elmispase_theme_options = get_option( $elmispase_themename_preg );
		$elmispase_theme_mods    = get_theme_mods();

		foreach ( $elmispase_theme_options as $key => $value ) {
			$elmispase_theme_mods[ $key ] = $value;
		}
		update_option( 'theme_mods_' . $elmispase_themename, $elmispase_theme_mods );
	}
	// For parent theme data Transfer
	if ( false !== ( $mods = get_option( 'elmispase' ) ) ) {
		$elmispase_theme_options = get_option( 'elmispase' );
		$elmispase_theme_mods    = get_option( 'theme_mods_elmispase' );

		foreach ( $elmispase_theme_options as $key => $value ) {
			$elmispase_theme_mods[ $key ] = $value;
		}

		update_option( 'theme_mods_elmispase', $elmispase_theme_mods );
	}

	// Set flag for demo import migration to not repeat the migration process, ie, run it only once.
	if ( $demo_import_migration ) {
		update_option( 'elmispase_demo_import_migration_notice_dismiss', true );
	}
	
}

add_action( 'after_setup_theme', 'elmispase_options_migrate', 12 );
