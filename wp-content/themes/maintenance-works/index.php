<?php
/**
 * The main template file
 * @package Maintenance Works
 * @since 1.0.0
 */

get_header();

$maintenance_works_layout = maintenance_works_get_final_sidebar_layout();
$maintenance_works_column_class = ($maintenance_works_layout === 'right-sidebar') ? 'column-order-1' : 'column-order-2';

?>

<div class="archive-main-block">
    <div class="wrapper">
        <div class="column-row <?php echo esc_attr($maintenance_works_layout === 'no-sidebar' ? 'no-sidebar-layout' : ''); ?>">

            <div id="primary" class="content-area <?php echo esc_attr($maintenance_works_column_class); ?>">
                <main id="site-content" role="main">

                    <?php
                    if (!is_front_page()) {
                        maintenance_works_breadcrumb();
                    }

                    if (have_posts()) : ?>

                        <div class="article-wraper article-wraper-archive">
                            <?php
                            while (have_posts()) :
                                the_post();
                                get_template_part('template-parts/content', get_post_format());
                            endwhile;
                            ?>
                        </div>

                        <?php
                        if (is_search()) {
                            the_posts_pagination();
                        } else {
                            do_action('maintenance_works_posts_pagination');
                        }

                    else :
                        get_template_part('template-parts/content', 'none');
                    endif;
                    ?>
                </main>
            </div>

            <?php if ($maintenance_works_layout !== 'no-sidebar') get_sidebar(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
