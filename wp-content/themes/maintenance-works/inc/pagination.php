<?php
/**
 *
 * Pagination Functions
 *
 * @package Maintenance Works
 */

/**
 * Pagination for archive.
 */
function maintenance_works_render_posts_pagination() {
    // Get the setting to check if pagination is enabled
    $maintenance_works_is_pagination_enabled = get_theme_mod( 'maintenance_works_enable_pagination', true );

    // Check if pagination is enabled
    if ( $maintenance_works_is_pagination_enabled ) {
        // Get the selected pagination type from the Customizer
        $maintenance_works_pagination_type = get_theme_mod( 'maintenance_works_theme_pagination_type', 'numeric' );

        // Check if the pagination type is "newer_older" (Previous/Next) or "numeric"
        if ( 'newer_older' === $maintenance_works_pagination_type ) :
            // Display "Newer/Older" pagination (Previous/Next navigation)
            the_posts_navigation(
                array(
                    'prev_text' => __( '&laquo; Newer', 'maintenance-works' ),  // Change the label for "previous"
                    'next_text' => __( 'Older &raquo;', 'maintenance-works' ),  // Change the label for "next"
                    'screen_reader_text' => __( 'Posts navigation', 'maintenance-works' ),
                )
            );
        else :
            // Display numeric pagination (Page numbers)
            the_posts_pagination(
                array(
                    'prev_text' => __( '&laquo; Previous', 'maintenance-works' ),
                    'next_text' => __( 'Next &raquo;', 'maintenance-works' ),
                    'type'      => 'list', // Display as <ul> <li> tags
                    'screen_reader_text' => __( 'Posts navigation', 'maintenance-works' ),
                )
            );
        endif;
    }
}
add_action( 'maintenance_works_posts_pagination', 'maintenance_works_render_posts_pagination', 10 );