<?php
/**
 * Custom Functions
 * @package Maintenance Works
 * @since 1.0.0
 */

if( !function_exists('maintenance_works_site_logo') ):

    /**
     * Logo & Description
     */
    /**
     * Displays the site logo, either text or image.
     *
     * @param array $maintenance_works_args Arguments for displaying the site logo either as an image or text.
     * @param boolean $maintenance_works_echo Echo or return the HTML.
     *
     * @return string $maintenance_works_html Compiled HTML based on our arguments.
     */
    function maintenance_works_site_logo( $maintenance_works_args = array(), $maintenance_works_echo = true ){
        $maintenance_works_logo = get_custom_logo();
        $maintenance_works_site_title = get_bloginfo('name');
        $maintenance_works_contents = '';
        $maintenance_works_classname = '';
        $maintenance_works_defaults = array(
            'logo' => '%1$s<span class="screen-reader-text">%2$s</span>',
            'logo_class' => 'site-logo site-branding',
            'title' => '<a href="%1$s" class="custom-logo-name">%2$s</a>',
            'title_class' => 'site-title',
            'home_wrap' => '<h1 class="%1$s">%2$s</h1>',
            'single_wrap' => '<div class="%1$s">%2$s</div>',
            'condition' => (is_front_page() || is_home()) && !is_page(),
        );
        $maintenance_works_args = wp_parse_args($maintenance_works_args, $maintenance_works_defaults);
        /**
         * Filters the arguments for `maintenance_works_site_logo()`.
         *
         * @param array $maintenance_works_args Parsed arguments.
         * @param array $maintenance_works_defaults Function's default arguments.
         */
        $maintenance_works_args = apply_filters('maintenance_works_site_logo_args', $maintenance_works_args, $maintenance_works_defaults);
        
        $maintenance_works_show_logo  = get_theme_mod('maintenance_works_display_logo', false);
        $maintenance_works_show_title = get_theme_mod('maintenance_works_display_title', true);

        if ( has_custom_logo() && $maintenance_works_show_logo ) {
            $maintenance_works_contents .= sprintf($maintenance_works_args['logo'], $maintenance_works_logo, esc_html($maintenance_works_site_title));
            $maintenance_works_classname = $maintenance_works_args['logo_class'];
        }

        if ( $maintenance_works_show_title ) {
            $maintenance_works_contents .= sprintf($maintenance_works_args['title'], esc_url(get_home_url(null, '/')), esc_html($maintenance_works_site_title));
            // If logo isn't shown, fallback to title class for wrapper.
            if ( !$maintenance_works_show_logo ) {
                $maintenance_works_classname = $maintenance_works_args['title_class'];
            }
        }

        // If nothing is shown (logo or title both disabled), exit early
        if ( empty($maintenance_works_contents) ) {
            return;
        }

        $maintenance_works_wrap = $maintenance_works_args['condition'] ? 'home_wrap' : 'single_wrap';
        // $maintenance_works_wrap = 'home_wrap';
        $maintenance_works_html = sprintf($maintenance_works_args[$maintenance_works_wrap], $maintenance_works_classname, $maintenance_works_contents);
        /**
         * Filters the arguments for `maintenance_works_site_logo()`.
         *
         * @param string $maintenance_works_html Compiled html based on our arguments.
         * @param array $maintenance_works_args Parsed arguments.
         * @param string $maintenance_works_classname Class name based on current view, home or single.
         * @param string $maintenance_works_contents HTML for site title or logo.
         */
        $maintenance_works_html = apply_filters('maintenance_works_site_logo', $maintenance_works_html, $maintenance_works_args, $maintenance_works_classname, $maintenance_works_contents);
        if (!$maintenance_works_echo) {
            return $maintenance_works_html;
        }
        echo $maintenance_works_html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }

endif;

if( !function_exists('maintenance_works_site_description') ):

    /**
     * Displays the site description.
     *
     * @param boolean $maintenance_works_echo Echo or return the html.
     *
     * @return string $maintenance_works_html The HTML to display.
     */
    function maintenance_works_site_description($maintenance_works_echo = true){

        if ( get_theme_mod('maintenance_works_display_header_text', false) == true ) :
        $maintenance_works_description = get_bloginfo('description');
        if (!$maintenance_works_description) {
            return;
        }
        $maintenance_works_wrapper = '<div class="site-description"><span>%s</span></div><!-- .site-description -->';
        $maintenance_works_html = sprintf($maintenance_works_wrapper, esc_html($maintenance_works_description));
        /**
         * Filters the html for the site description.
         *
         * @param string $maintenance_works_html The HTML to display.
         * @param string $maintenance_works_description Site description via `bloginfo()`.
         * @param string $maintenance_works_wrapper The format used in case you want to reuse it in a `sprintf()`.
         * @since 1.0.0
         *
         */
        $maintenance_works_html = apply_filters('maintenance_works_site_description', $maintenance_works_html, $maintenance_works_description, $maintenance_works_wrapper);
        if (!$maintenance_works_echo) {
            return $maintenance_works_html;
        }
        echo $maintenance_works_html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        endif;
    }

endif;

if( !function_exists('maintenance_works_posted_on') ):

    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function maintenance_works_posted_on( $maintenance_works_icon = true, $maintenance_works_animation_class = '' ){

        $maintenance_works_default = maintenance_works_get_default_theme_options();
        $maintenance_works_post_date = absint( get_theme_mod( 'maintenance_works_post_date',$maintenance_works_default['maintenance_works_post_date'] ) );

        if( $maintenance_works_post_date ){

            $maintenance_works_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $maintenance_works_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $maintenance_works_time_string = sprintf($maintenance_works_time_string,
                esc_attr(get_the_date(DATE_W3C)),
                esc_html(get_the_date()),
                esc_attr(get_the_modified_date(DATE_W3C)),
                esc_html(get_the_modified_date())
            );

            $maintenance_works_year = get_the_date('Y');
            $maintenance_works_month = get_the_date('m');
            $maintenance_works_day = get_the_date('d');
            $maintenance_works_link = get_day_link($maintenance_works_year, $maintenance_works_month, $maintenance_works_day);

            $maintenance_works_posted_on = '<a href="' . esc_url($maintenance_works_link) . '" rel="bookmark">' . $maintenance_works_time_string . '</a>';

            echo '<div class="entry-meta-item entry-meta-date">';
            echo '<div class="entry-meta-wrapper '.esc_attr( $maintenance_works_animation_class ).'">';

            if( $maintenance_works_icon ){

                echo '<span class="entry-meta-icon calendar-icon"> ';
                maintenance_works_the_theme_svg('calendar');
                echo '</span>';

            }

            echo '<span class="posted-on">' . $maintenance_works_posted_on . '</span>'; // WPCS: XSS OK.
            echo '</div>';
            echo '</div>';

        }

    }

endif;

if( !function_exists('maintenance_works_posted_by') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function maintenance_works_posted_by( $maintenance_works_icon = true, $maintenance_works_animation_class = '' ){   

        $maintenance_works_default = maintenance_works_get_default_theme_options();
        $maintenance_works_post_author = absint( get_theme_mod( 'maintenance_works_post_author',$maintenance_works_default['maintenance_works_post_author'] ) );

        if( $maintenance_works_post_author ){

            echo '<div class="entry-meta-item entry-meta-author">';
            echo '<div class="entry-meta-wrapper '.esc_attr( $maintenance_works_animation_class ).'">';

            if( $maintenance_works_icon ){
            
                echo '<span class="entry-meta-icon author-icon"> ';
                maintenance_works_the_theme_svg('user');
                echo '</span>';
                
            }

            $maintenance_works_byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html(get_the_author()) . '</a></span>';
            echo '<span class="byline"> ' . $maintenance_works_byline . '</span>'; // WPCS: XSS OK.
            echo '</div>';
            echo '</div>';

        }

    }

endif;


if( !function_exists('maintenance_works_posted_by_avatar') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function maintenance_works_posted_by_avatar( $maintenance_works_date = false ){

        $maintenance_works_default = maintenance_works_get_default_theme_options();
        $maintenance_works_post_author = absint( get_theme_mod( 'maintenance_works_post_author',$maintenance_works_default['maintenance_works_post_author'] ) );

        if( $maintenance_works_post_author ){



            echo '<div class="entry-meta-left">';
            echo '<div class="entry-meta-item entry-meta-avatar">';
            echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ) ) );
            echo '</div>';
            echo '</div>';

            echo '<div class="entry-meta-right">';

            $maintenance_works_byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html(get_the_author()) . '</a></span>';

            echo '<div class="entry-meta-item entry-meta-byline"> ' . $maintenance_works_byline . '</div>';

            if( $maintenance_works_date ){
                maintenance_works_posted_on($maintenance_works_icon = false);
            }
            echo '</div>';

        }

    }

endif;

if( !function_exists('maintenance_works_entry_footer') ):

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function maintenance_works_entry_footer( $maintenance_works_cats = true, $maintenance_works_tags = true, $maintenance_works_edits = true){   

        $maintenance_works_default = maintenance_works_get_default_theme_options();
        $maintenance_works_post_category = absint( get_theme_mod( 'maintenance_works_post_category',$maintenance_works_default['maintenance_works_post_category'] ) );
        $maintenance_works_post_tags = absint( get_theme_mod( 'maintenance_works_post_tags',$maintenance_works_default['maintenance_works_post_tags'] ) );

        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {

            if( $maintenance_works_cats && $maintenance_works_post_category ){

                /* translators: used between list items, there is a space after the comma */
                $maintenance_works_categories = get_the_category();
                if ($maintenance_works_categories) {
                    echo '<div class="entry-meta-item entry-meta-categories">';
                    echo '<div class="entry-meta-wrapper">';
                
                    /* translators: 1: list of categories. */
                    echo '<span class="cat-links">';
                    foreach( $maintenance_works_categories as $maintenance_works_category ){

                        $maintenance_works_cat_name = $maintenance_works_category->name;
                        $maintenance_works_cat_slug = $maintenance_works_category->slug;
                        $maintenance_works_cat_url = get_category_link( $maintenance_works_category->term_id );
                        ?>

                        <a class="twp_cat_<?php echo esc_attr( $maintenance_works_cat_slug ); ?>" href="<?php echo esc_url( $maintenance_works_cat_url ); ?>" rel="category tag"><?php echo esc_html( $maintenance_works_cat_name ); ?></a>

                    <?php }
                    echo '</span>'; // WPCS: XSS OK.
                    echo '</div>';
                    echo '</div>';
                }

            }

            if( $maintenance_works_tags && $maintenance_works_post_tags ){
                /* translators: used between list items, there is a space after the comma */
                $maintenance_works_tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'maintenance-works'));
                if( $maintenance_works_tags_list ){

                    echo '<div class="entry-meta-item entry-meta-tags">';
                    echo '<div class="entry-meta-wrapper">';

                    /* translators: 1: list of tags. */
                    echo '<span class="tags-links">';
                    echo wp_kses_post($maintenance_works_tags_list) . '</span>'; // WPCS: XSS OK.
                    echo '</div>';
                    echo '</div>';

                }

            }

            if( $maintenance_works_edits ){

                edit_post_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Edit <span class="screen-reader-text">%s</span>', 'maintenance-works'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }

        }
    }

endif;

if ( ! function_exists( 'maintenance_works_post_thumbnail' ) ) :

    /**
     * Displays an optional post thumbnail.
     *
     * Shows background style image with height class on archive/search/front,
     * and a normal inline image on single post/page views.
     */
    function maintenance_works_post_thumbnail( $maintenance_works_image_size = 'full' ) {

        if ( post_password_required() || is_attachment() ) {
            return;
        }

        // Fallback image path
        $maintenance_works_default_image = get_template_directory_uri() . '/assets/images/banner-2.png';

        // Image size → height class map
        $maintenance_works_size_class_map = array(
            'full'      => 'data-bg-large',
            'large'     => 'data-bg-big',
            'medium'    => 'data-bg-medium',
            'small'     => 'data-bg-small',
            'xsmall'    => 'data-bg-xsmall',
            'thumbnail' => 'data-bg-thumbnail',
        );

        $maintenance_works_class = isset( $maintenance_works_size_class_map[ $maintenance_works_image_size ] )
            ? $maintenance_works_size_class_map[ $maintenance_works_image_size ]
            : 'data-bg-medium';

        if ( is_singular() ) {
            the_post_thumbnail();
        } else {
            // 🔵 On archives → use background image style
            $maintenance_works_image = has_post_thumbnail()
                ? wp_get_attachment_image_src( get_post_thumbnail_id(), $maintenance_works_image_size )
                : array( $maintenance_works_default_image );

            $maintenance_works_bg_image = isset( $maintenance_works_image[0] ) ? $maintenance_works_image[0] : $maintenance_works_default_image;
            ?>
            <div class="post-thumbnail data-bg <?php echo esc_attr( $maintenance_works_class ); ?>"
                 data-background="<?php echo esc_url( $maintenance_works_bg_image ); ?>">
                <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
            </div>
            <?php
        }
    }

endif;

if( !function_exists('maintenance_works_is_comment_by_post_author') ):

    /**
     * Comments
     */
    /**
     * Check if the specified comment is written by the author of the post commented on.
     *
     * @param object $maintenance_works_comment Comment data.
     *
     * @return bool
     */
    function maintenance_works_is_comment_by_post_author($maintenance_works_comment = null){

        if (is_object($maintenance_works_comment) && $maintenance_works_comment->user_id > 0) {
            $maintenance_works_user = get_userdata($maintenance_works_comment->user_id);
            $post = get_post($maintenance_works_comment->comment_post_ID);
            if (!empty($maintenance_works_user) && !empty($post)) {
                return $maintenance_works_comment->user_id === $post->post_author;
            }
        }
        return false;
    }

endif;

if( !function_exists('maintenance_works_breadcrumb') ) :

    /**
     * Maintenance Works Breadcrumb
     */
    function maintenance_works_breadcrumb($maintenance_works_comment = null){

        echo '<div class="entry-breadcrumb">';
        maintenance_works_breadcrumb_trail();
        echo '</div>';

    }

endif;