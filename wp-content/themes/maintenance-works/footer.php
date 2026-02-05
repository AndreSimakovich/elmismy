<?php
/**
 * The template for displaying the footer
 * @package Maintenance Works
 * @since 1.0.0
 */

/**
 * Toogle Contents
 * @hooked maintenance_works_content_offcanvas - 30
*/

do_action('maintenance_works_before_footer_content_action'); ?>

</div>

<footer id="site-footer" role="contentinfo">

    <?php
    /**
     * Footer Content
     * @hooked maintenance_works_footer_content_widget - 10
     * @hooked maintenance_works_footer_content_info - 20
    */

    do_action('maintenance_works_footer_content_action'); ?>

</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>