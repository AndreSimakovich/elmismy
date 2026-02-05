<?php
/**
* Custom Functions.
*
* @package Maintenance Works
*/

if( !function_exists( 'maintenance_works_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function maintenance_works_sanitize_sidebar_option( $maintenance_works_input ){

        $maintenance_works_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $maintenance_works_input,$maintenance_works_metabox_options ) ){

            return $maintenance_works_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'maintenance_works_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function maintenance_works_sanitize_checkbox( $maintenance_works_checked ) {

		return ( ( isset( $maintenance_works_checked ) && true === $maintenance_works_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'maintenance_works_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function maintenance_works_sanitize_select( $maintenance_works_input, $maintenance_works_setting ) {
        $maintenance_works_input = sanitize_text_field( $maintenance_works_input );
        $choices = $maintenance_works_setting->manager->get_control( $maintenance_works_setting->id )->choices;
        return ( array_key_exists( $maintenance_works_input, $choices ) ? $maintenance_works_input : $maintenance_works_setting->default );
    }

endif;

/*Radio Button sanitization*/
function maintenance_works_sanitize_choices( $maintenance_works_input, $maintenance_works_setting ) {
    global $wp_customize;
    $maintenance_works_control = $wp_customize->get_control( $maintenance_works_setting->id );
    if ( array_key_exists( $maintenance_works_input, $maintenance_works_control->choices ) ) {
        return $maintenance_works_input;
    } else {
        return $maintenance_works_setting->default;
    }
}