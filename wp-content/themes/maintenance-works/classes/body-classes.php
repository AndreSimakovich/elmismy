<?php
/**
 * Body Classes.
 * @package Maintenance Works
 */

if (!function_exists('maintenance_works_body_classes')) :

    function maintenance_works_body_classes($maintenance_works_classes)
    {
        $maintenance_works_defaults = maintenance_works_get_default_theme_options();
        $maintenance_works_layout = maintenance_works_get_final_sidebar_layout();

        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $maintenance_works_classes[] = 'hfeed';
        }

        // Sidebar layout logic
        $maintenance_works_classes[] = $maintenance_works_layout;

        // Copyright alignment
        $copyright_alignment = get_theme_mod('maintenance_works_copyright_alignment', 'Default');
        $maintenance_works_classes[] = 'copyright-' . strtolower($copyright_alignment);

        return $maintenance_works_classes;
    }

endif;

add_filter('body_class', 'maintenance_works_body_classes');