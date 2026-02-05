<?php
/**
 * Template Name: Page Builder Template
 *
 * Displays the Page Builder Template via the theme.
 *
 * @package ThemeGrill
 * @subpackage Elmispase
 * @since Elmispase 1.4.9
 */
get_header(); ?>

<?php do_action( 'elmispase_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile;
			?>
        </div><!-- #content -->
    </div><!-- #primary -->

<?php do_action( 'elmispase_after_body_content' ); ?>

<?php get_footer(); ?>