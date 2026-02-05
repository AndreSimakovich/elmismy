<?php
$maintenance_works_layout = maintenance_works_get_final_sidebar_layout();
$maintenance_works_sidebar_class = 'column-order-1';

if ( $maintenance_works_layout === 'left-sidebar' ) {
    $maintenance_works_sidebar_class = 'column-order-1';
} elseif ( $maintenance_works_layout === 'right-sidebar' ) {
    $maintenance_works_sidebar_class = 'column-order-2';
}

if ( $maintenance_works_layout !== 'no-sidebar' ) : ?>
    <aside id="secondary" class="widget-area <?php echo esc_attr( $maintenance_works_sidebar_class ); ?>">
        <div class="widget-area-wrapper">
            <?php if ( is_active_sidebar('sidebar-1') ) : ?>
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <?php else : ?>
                <!-- Default widgets -->
                <div class="widget widget_block widget_search">
                    <h3 class="widget-title"><?php esc_html_e('Search', 'maintenance-works'); ?></h3>
                    <?php get_search_form(); ?>
                </div>

                <div class="widget widget_pages">
                    <h3 class="widget-title"><?php esc_html_e('Pages', 'maintenance-works'); ?></h3>
                    <ul>
                        <?php
                        wp_list_pages(array(
                            'title_li' => '',
                        ));
                        ?>
                    </ul>
                </div>

                <div class="widget widget_archive">
                    <h3 class="widget-title"><?php esc_html_e('Archives', 'maintenance-works'); ?></h3>
                    <ul>
                        <?php wp_get_archives(['type' => 'monthly', 'show_post_count' => true]); ?>
                    </ul>
                </div>

                <div class="widget widget_categories">
                    <h3 class="widget-title"><?php esc_html_e('Categories', 'maintenance-works'); ?></h3>
                    <ul class="wp-block-categories-list wp-block-categories">
                        <?php wp_list_categories(['orderby' => 'name', 'title_li' => '', 'show_count' => true]); ?>
                    </ul>
                </div>

                <div class="widget widget_tag_cloud">
                    <h3 class="widget-title"><?php esc_html_e('Tags', 'maintenance-works'); ?></h3>
                    <?php
                    $maintenance_works_tags = get_tags();
                    if ( $maintenance_works_tags ) {
                        echo '<div class="tagcloud">';
                        foreach ( $maintenance_works_tags as $maintenance_works_tag ) {
                            $maintenance_works_link = get_tag_link($maintenance_works_tag->term_id);
                            echo '<a href="' . esc_url($maintenance_works_link) . '" class="tag-cloud-link">' . esc_html($maintenance_works_tag->name) . '</a> ';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>' . esc_html__('No tags found.', 'maintenance-works') . '</p>';
                    }
                    ?>
                </div>

            <?php endif; ?>
        </div>
    </aside>
<?php endif; ?>
