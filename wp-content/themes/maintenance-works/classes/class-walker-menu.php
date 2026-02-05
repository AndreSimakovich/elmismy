<?php
/**
 * Custom page walker for this theme.
 *
 * @package Maintenance Works
 */

if (!class_exists('Maintenance_Works_Walker_Page')) {
    /**
     * CUSTOM PAGE WALKER
     * A custom walker for pages.
     */
    class Maintenance_Works_Walker_Page extends Walker_Page
    {

        /**
         * Outputs the beginning of the current element in the tree.
         *
         * @param string $maintenance_works_output Used to append additional content. Passed by reference.
         * @param WP_Post $page Page data object.
         * @param int $maintenance_works_depth Optional. Depth of page. Used for padding. Default 0.
         * @param array $maintenance_works_args Optional. Array of arguments. Default empty array.
         * @param int $current_page Optional. Page ID. Default 0.
         * @since 2.1.0
         *
         * @see Walker::start_el()
         */

        public function start_lvl( &$maintenance_works_output, $maintenance_works_depth = 0, $maintenance_works_args = array() ) {
            $maintenance_works_indent  = str_repeat( "\t", $maintenance_works_depth );
            $maintenance_works_output .= "$maintenance_works_indent<ul class='sub-menu'>\n";
        }

        public function start_el(&$maintenance_works_output, $page, $maintenance_works_depth = 0, $maintenance_works_args = array(), $current_page = 0)
        {

            if (isset($maintenance_works_args['item_spacing']) && 'preserve' === $maintenance_works_args['item_spacing']) {
                $t = "\t";
                $n = "\n";
            } else {
                $t = '';
                $n = '';
            }
            if ($maintenance_works_depth) {
                $maintenance_works_indent = str_repeat($t, $maintenance_works_depth);
            } else {
                $maintenance_works_indent = '';
            }

            $maintenance_works_css_class = array('page_item', 'page-item-' . $page->ID);

            if (isset($maintenance_works_args['pages_with_children'][$page->ID])) {
                $maintenance_works_css_class[] = 'page_item_has_children';
            }

            if (!empty($current_page)) {
                $_current_page = get_post($current_page);
                if ($_current_page && in_array($page->ID, $_current_page->ancestors, true)) {
                    $maintenance_works_css_class[] = 'current_page_ancestor';
                }
                if ($page->ID === $current_page) {
                    $maintenance_works_css_class[] = 'current_page_item';
                } elseif ($_current_page && $page->ID === $_current_page->post_parent) {
                    $maintenance_works_css_class[] = 'current_page_parent';
                }
            } elseif (get_option('page_for_posts') === $page->ID) {
                $maintenance_works_css_class[] = 'current_page_parent';
            }

            /** This filter is documented in wp-includes/class-walker-page.php */
            $maintenance_works_css_classes = implode(' ', apply_filters('page_css_class', $maintenance_works_css_class, $page, $maintenance_works_depth, $maintenance_works_args, $current_page));
            $maintenance_works_css_classes = $maintenance_works_css_classes ? ' class="' . esc_attr($maintenance_works_css_classes) . '"' : '';

            if ('' === $page->post_title) {
                /* translators: %d: ID of a post. */
                $page->post_title = sprintf(__('#%d (no title)', 'maintenance-works'), $page->ID);
            }

            $maintenance_works_args['link_before'] = empty($maintenance_works_args['link_before']) ? '' : $maintenance_works_args['link_before'];
            $maintenance_works_args['link_after'] = empty($maintenance_works_args['link_after']) ? '' : $maintenance_works_args['link_after'];

            $maintenance_works_atts = array();
            $maintenance_works_atts['href'] = get_permalink($page->ID);
            $maintenance_works_atts['aria-current'] = ($page->ID === $current_page) ? 'page' : '';

            /** This filter is documented in wp-includes/class-walker-page.php */
            $maintenance_works_atts = apply_filters('page_menu_link_attributes', $maintenance_works_atts, $page, $maintenance_works_depth, $maintenance_works_args, $current_page);

            $maintenance_works_attributes = '';
            foreach ($maintenance_works_atts as $attr => $maintenance_works_value) {
                if (!empty($maintenance_works_value)) {
                    $maintenance_works_value = ('href' === $attr) ? esc_url($maintenance_works_value) : esc_attr($maintenance_works_value);
                    $maintenance_works_attributes .= ' ' . $attr . '="' . $maintenance_works_value . '"';
                }
            }

            $maintenance_works_args['list_item_before'] = '';
            $maintenance_works_args['list_item_after'] = '';
            $maintenance_works_args['icon_rennder'] = '';
            // Wrap the link in a div and append a sub menu toggle.
            if (isset($maintenance_works_args['show_toggles']) && true === $maintenance_works_args['show_toggles']) {
                // Wrap the menu item link contents in a div, used for positioning.
                $maintenance_works_args['list_item_after'] = '';
            }


            // Add icons to menu items with children.
            if (isset($maintenance_works_args['show_sub_menu_icons']) && true === $maintenance_works_args['show_sub_menu_icons']) {
                if (isset($maintenance_works_args['pages_with_children'][$page->ID])) {
                    $maintenance_works_args['icon_rennder'] = '';
                }
            }

            // Add icons to menu items with children.
            if (isset($maintenance_works_args['show_toggles']) && true === $maintenance_works_args['show_toggles']) {
                if (isset($maintenance_works_args['pages_with_children'][$page->ID])) {

                    $toggle_target_string = '.page_item.page-item-' . $page->ID . ' > .sub-menu';

                    $maintenance_works_args['list_item_after'] = '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'maintenance-works' ) . '</span>' . maintenance_works_get_theme_svg( 'chevron-down' ) . '</span></button>';
                }
            }

            if (isset($maintenance_works_args['show_toggles']) && true === $maintenance_works_args['show_toggles']) {

                $maintenance_works_output .= $maintenance_works_indent . sprintf(
                        '<li%s>%s%s<a%s>%s%s%s</a>%s%s',
                        $maintenance_works_css_classes,
                        '<div class="submenu-wrapper">',
                        $maintenance_works_args['list_item_before'],
                        $maintenance_works_attributes,
                        $maintenance_works_args['link_before'],
                        /** This filter is documented in wp-includes/post-template.php */
                        apply_filters('the_title', $page->post_title, $page->ID),
                        $maintenance_works_args['link_after'],
                        $maintenance_works_args['list_item_after'],
                        '</div>'
                    );

            }else{

                $maintenance_works_output .= $maintenance_works_indent . sprintf(
                        '<li%s>%s<a%s>%s%s%s%s</a>%s',
                        $maintenance_works_css_classes,
                        $maintenance_works_args['list_item_before'],
                        $maintenance_works_attributes,
                        $maintenance_works_args['link_before'],
                        /** This filter is documented in wp-includes/post-template.php */
                        apply_filters('the_title', $page->post_title, $page->ID),
                        $maintenance_works_args['icon_rennder'],
                        $maintenance_works_args['link_after'],
                        $maintenance_works_args['list_item_after']
                    );

            }

            if (!empty($maintenance_works_args['show_date'])) {
                if ('modified' === $maintenance_works_args['show_date']) {
                    $maintenance_works_time = $page->post_modified;
                } else {
                    $maintenance_works_time = $page->post_date;
                }

                $maintenance_works_date_format = empty($maintenance_works_args['date_format']) ? '' : $maintenance_works_args['date_format'];
                $maintenance_works_output .= ' ' . mysql2date($maintenance_works_date_format, $maintenance_works_time);
            }
        }
    }
}