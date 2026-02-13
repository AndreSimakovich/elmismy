<?php
/**
 * Custom Functions.
 *
 * @package Maintenance Works
 */

if( !function_exists( 'maintenance_works_fonts_url' ) ) :

    //Google Fonts URL
    function maintenance_works_fonts_url(){

        $maintenance_works_font_families = array(
            'Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800',
            'Sonsie+One',
        );

        $maintenance_works_fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $maintenance_works_font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($maintenance_works_fonts_url);
    }

endif;

if ( ! function_exists( 'maintenance_works_sub_menu_toggle_button' ) ) :

    function maintenance_works_sub_menu_toggle_button( $maintenance_works_args, $maintenance_works_item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $maintenance_works_args->theme_location == 'maintenance-works-primary-menu' && isset( $maintenance_works_args->show_toggles ) ) {
            
            // Wrap the menu item link contents in a div, used for positioning
            $maintenance_works_args->before = '<div class="submenu-wrapper">';
            $maintenance_works_args->after  = '';

            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $maintenance_works_item->classes ) ) {

                $maintenance_works_toggle_target_string = '.menu-item.menu-item-' . $maintenance_works_item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $maintenance_works_args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $maintenance_works_toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'maintenance-works' ) . '</span>' . maintenance_works_get_theme_svg( 'chevron-down' ) . '</span></button>';

            }

            // Close the wrapper
            $maintenance_works_args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        }elseif( $maintenance_works_args->theme_location == 'maintenance-works-primary-menu' ) {

            if ( in_array( 'menu-item-has-children', $maintenance_works_item->classes ) ) {

                $maintenance_works_args->before = '<div class="link-icon-wrapper">';
                $maintenance_works_args->after  = maintenance_works_get_theme_svg( 'chevron-down' ) . '</div>';

            } else {

                $maintenance_works_args->before = '';
                $maintenance_works_args->after  = '';

            }

        }

        return $maintenance_works_args;

    }

endif;

add_filter( 'nav_menu_item_args', 'maintenance_works_sub_menu_toggle_button', 10, 3 );

if ( ! function_exists( 'maintenance_works_the_theme_svg' ) ):
    
    function maintenance_works_the_theme_svg( $maintenance_works_svg_name, $maintenance_works_return = false ) {

        if( $maintenance_works_return ){

            return maintenance_works_get_theme_svg( $maintenance_works_svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in maintenance_works_get_theme_svg();.

        }else{

            echo maintenance_works_get_theme_svg( $maintenance_works_svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in maintenance_works_get_theme_svg();.

        }
    }

endif;

if ( ! function_exists( 'maintenance_works_get_theme_svg' ) ):

    function maintenance_works_get_theme_svg( $maintenance_works_svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $maintenance_works_svg = wp_kses(
            Maintenance_Works_SVG_Icons::get_svg( $maintenance_works_svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
                'polyline' => array(
                    'fill'      => true,
                    'points'    => true,
                ),
                'line' => array(
                    'fill'      => true,
                    'x1'      => true,
                    'x2' => true,
                    'y1'    => true,
                    'y2' => true,
                ),
            )
        );
        if ( ! $maintenance_works_svg ) {
            return false;
        }
        return $maintenance_works_svg;

    }

endif;

if( !function_exists( 'maintenance_works_post_category_list' ) ) :

    // Post Category List.
    function maintenance_works_post_category_list( $maintenance_works_select_cat = true ){

        $maintenance_works_post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $maintenance_works_post_cat_cat_array = array();
        if( $maintenance_works_select_cat ){

            $maintenance_works_post_cat_cat_array[''] = esc_html__( '-- Select Category --','maintenance-works' );

        }

        foreach ( $maintenance_works_post_cat_lists as $maintenance_works_post_cat_list ) {

            $maintenance_works_post_cat_cat_array[$maintenance_works_post_cat_list->slug] = $maintenance_works_post_cat_list->name;

        }

        return $maintenance_works_post_cat_cat_array;
    }

endif;

if( !function_exists('maintenance_works_single_post_navigation') ):

    function maintenance_works_single_post_navigation(){

        $maintenance_works_default = maintenance_works_get_default_theme_options();
        $maintenance_works_twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'maintenance_works_twp_disable_ajax_load_next_post', true ) );
        $maintenance_works_current_id = '';
        $article_wrap_class = '';
        global $post;
        $maintenance_works_current_id = $post->ID;
        if( $maintenance_works_twp_navigation_type == '' || $maintenance_works_twp_navigation_type == 'global-layout' ){
            $maintenance_works_twp_navigation_type = get_theme_mod('maintenance_works_twp_navigation_type', $maintenance_works_default['maintenance_works_twp_navigation_type']);
        }

        if( $maintenance_works_twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $maintenance_works_twp_navigation_type == 'theme-normal-navigation' ){ ?>

                <div class="navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . maintenance_works_the_theme_svg('arrow-left',$maintenance_works_return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Previous post:', 'maintenance-works') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . maintenance_works_the_theme_svg('arrow-right',$maintenance_works_return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Next post:', 'maintenance-works') . '</span><span class="post-title">%title</span>',
                    )); ?>
                </div>
                <?php

            }else{

                $maintenance_works_next_post = get_next_post();
                if( isset( $maintenance_works_next_post->ID ) ){

                    $maintenance_works_next_post_id = $maintenance_works_next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $maintenance_works_next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'maintenance_works_navigation_action','maintenance_works_single_post_navigation',30 );

if( !function_exists('maintenance_works_content_offcanvas') ):

    // Offcanvas Contents
    function maintenance_works_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html('Close', 'maintenance-works'); ?>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'maintenance-works'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('maintenance-works-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'maintenance-works-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Maintenance_Works_Walker_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'maintenance_works_before_footer_content_action','maintenance_works_content_offcanvas',30 );

if( !function_exists('maintenance_works_footer_content_widget') ):

    function maintenance_works_footer_content_widget(){
        
        $maintenance_works_default = maintenance_works_get_default_theme_options();
        
        $maintenance_works_footer_column_layout = absint(get_theme_mod('maintenance_works_footer_column_layout', $maintenance_works_default['maintenance_works_footer_column_layout']));
        $maintenance_works_footer_sidebar_class = 12;
        
        if($maintenance_works_footer_column_layout == 2) {
            $maintenance_works_footer_sidebar_class = 6;
        }
        
        if($maintenance_works_footer_column_layout == 3) {
            $maintenance_works_footer_sidebar_class = 4;
        }
        ?>
        
        <?php if ( get_theme_mod('maintenance_works_display_footer', true) == true ) : ?>
            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                    
                        <?php for ($i = 0; $i < $maintenance_works_footer_column_layout; $i++) : ?>
                            
                            <div class="column <?php echo 'column-' . absint($maintenance_works_footer_sidebar_class); ?> column-sm-12">
                                
                                <?php 
                                // If no widgets are assigned, display default widgets
                                if ( ! is_active_sidebar( 'maintenance-works-footer-widget-' . $i ) ) : 

                                    if ($i === 0) : ?>
                                        <div id="media_image-3" class="widget widget_media_image">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" alt="<?php echo esc_attr__( 'Footer Image', 'maintenance-works' ); ?>" style="max-width: 100%; height: auto;">
                                        </div>
                                        <div id="text-3" class="widget widget_text">
                                            <div class="textwidget">
                                                <p class="widget_text">
                                                    <?php esc_html_e('The Maintenance Works Theme is a powerful and flexible website solution designed specifically for service providers, technicians, contractors, and facility management businesses. Whether you specialize in building maintenance, repair services, facility maintenance, or property maintenance, this theme gives you everything you need to create a professional and trustworthy online presence with ease.', 'maintenance-works'); ?>
                                                </p>
                                            </div>
                                        </div>

                                    <?php elseif ($i === 1) : ?>
                                        <div id="pages-2" class="widget widget_pages">
                                            <h2 class="widget-title"><?php esc_html_e('Calendar', 'maintenance-works'); ?></h2>
                                            <?php get_calendar(); ?>
                                        </div>

                                    <?php elseif ($i === 2) : ?>
                                        <div id="search-2" class="widget widget_search">
                                            <h2 class="widget-title"><?php esc_html_e('Enter Keywords Here', 'maintenance-works'); ?></h2>
                                            <?php get_search_form(); ?>
                                        </div>
                                    <?php endif; 
                                    
                                else :
                                    // Display dynamic sidebar widget if assigned
                                    dynamic_sidebar('maintenance-works-footer-widget-' . $i);
                                endif;
                                ?>
                                
                            </div>
                            
                        <?php endfor; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?> 

    <?php
    }

endif;

add_action( 'maintenance_works_footer_content_action', 'maintenance_works_footer_content_widget', 10 );

if( !function_exists('maintenance_works_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function maintenance_works_footer_content_info(){

        $maintenance_works_default = maintenance_works_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-9">
                        <div class="footer-credits">
                            <div class="footer-copyright">
                                <?php
                                $maintenance_works_footer_copyright_text = wp_kses_post( get_theme_mod( 'maintenance_works_footer_copyright_text', $maintenance_works_default['maintenance_works_footer_copyright_text'] ) );
                                    echo esc_html( $maintenance_works_footer_copyright_text );
                                    echo '<br>';
                                    echo esc_html__('Theme: ', 'maintenance-works') . '<a href="' . esc_url('https://www.omegathemes.com/products/maintenance-works') . '" title="' . esc_attr__('Electrician Company ', 'maintenance-works') . '" target="_blank"><span>' . esc_html__('Maintenance Works  ', 'maintenance-works') . '</span></a>' . esc_html__(' By ', 'maintenance-works') . '  <span>' . esc_html__('OMEGA ', 'maintenance-works') . '</span>';
                                    echo esc_html__('Powered by ', 'maintenance-works') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'maintenance-works') . '" target="_blank"><span>' . esc_html__('WordPress.', 'maintenance-works') . '</span></a>';
                                 ?>
                            </div>
                        </div>
                    </div>
                    <div class="column column-3 align-text-right">
                        <a class="to-the-top" href="#site-header">
                            <span class="to-the-top-long">
                                <?php if ( get_theme_mod('maintenance_works_enable_to_the_top', true) == true ) : ?>
                                    <?php
                                    $maintenance_works_to_the_top_text = get_theme_mod( 'maintenance_works_to_the_top_text', __( 'To the Top', 'maintenance-works' ) );
                                    printf( 
                                        wp_kses( 
                                            /* translators: %s is the arrow icon markup */
                                            '%s %s', 
                                            array( 'span' => array( 'class' => array(), 'aria-hidden' => array() ) ) 
                                        ), 
                                        esc_html( $maintenance_works_to_the_top_text ),
                                        '<span class="arrow" aria-hidden="true">&uarr;</span>' 
                                    );
                                    ?>
                                <?php endif; ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

endif;

add_action( 'maintenance_works_footer_content_action','maintenance_works_footer_content_info',20 );


if( !function_exists( 'maintenance_works_main_slider' ) ) :

    function maintenance_works_main_slider(){

        $maintenance_works_defaults = maintenance_works_get_default_theme_options();
        $maintenance_works_header_slider = get_theme_mod( 'maintenance_works_header_slider', $maintenance_works_defaults['maintenance_works_header_slider'] );
        $maintenance_works_header_slider_cat = get_theme_mod( 'maintenance_works_header_slider_cat','uncategorized');
        $maintenance_works_banner_left_image = get_theme_mod( 'maintenance_works_banner_left_image', $maintenance_works_defaults['maintenance_works_banner_left_image'] );
        $maintenance_works_banner_right_image = get_theme_mod( 'maintenance_works_banner_right_image', $maintenance_works_defaults['maintenance_works_banner_right_image'] );

        $maintenance_works_slider_section_guarantee_title = esc_html( get_theme_mod( 'maintenance_works_slider_section_guarantee_title',
        $maintenance_works_defaults['maintenance_works_slider_section_guarantee_title'] ) );

        $maintenance_works_slider_section_availablity_title = esc_html( get_theme_mod( 'maintenance_works_slider_section_availablity_title',
        $maintenance_works_defaults['maintenance_works_slider_section_availablity_title'] ) );

        $maintenance_works_slider_section_location_title = esc_html( get_theme_mod( 'maintenance_works_slider_section_location_title',
        $maintenance_works_defaults['maintenance_works_slider_section_location_title'] ) );

        $maintenance_works_slider_section_appoinment_title = esc_html( get_theme_mod( 'maintenance_works_slider_section_appoinment_title',
        $maintenance_works_defaults['maintenance_works_slider_section_appoinment_title'] ) );

        if( $maintenance_works_header_slider ){
            if( $maintenance_works_header_slider_cat ){ ?>
                <div class="slider-box">
                    <div class="wrapper">
                        <div class="slider-main">
                            <div class="right-box">
                                <div class="entry-thumbnail">
                                    <?php if( $maintenance_works_banner_left_image ){ ?>
                                        <img src="<?php echo esc_url( $maintenance_works_banner_left_image ); ?>" alt="Banner Left Image">
                                    <?php } ?>
                                </div>
                                <div class="slide-center">
                                    <?php
                                    $maintenance_works_rtl = '';
                                    if( is_rtl() ){
                                        $maintenance_works_rtl = 'dir="rtl"';
                                    }
                                    $maintenance_works_banner_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $maintenance_works_header_slider_cat ) ) );
                                    if( $maintenance_works_banner_query->have_posts() ): ?>
                                        <div class="theme-custom-block theme-banner-block">
                                            <div class="" role="listbox" <?php echo esc_attr($maintenance_works_rtl);  ?>>
                                                <div class="owl-carousel">
                                                    <?php
                                                    while( $maintenance_works_banner_query->have_posts() ):
                                                    $maintenance_works_banner_query->the_post();?>                                  
                                                        <div class="main-carousel-caption">
                                                            <header class="entry-header">
                                                                <div class="entry-author">
                                                                    <span class="slide-cat"><?php the_category(); ?></span>
                                                                </div>
                                                                <h2 class="entry-title">
                                                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                                                </h2>
                                                                <a href="<?php the_permalink(); ?>" class="btn-fancy btn-fancy-primary" tabindex="0">
                                                                    <?php echo esc_html('Call Us Now', 'maintenance-works'); ?><span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M497.4 361.8l-112-48a24 24 0 0 0 -28 6.9l-49.6 60.6A370.7 370.7 0 0 1 130.6 204.1l60.6-49.6a23.9 23.9 0 0 0 6.9-28l-48-112A24.2 24.2 0 0 0 122.6 .6l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.3 24.3 0 0 0 -14-27.6z"/></svg></span>
                                                                </a>
                                                            </header>
                                                        </div>
                                                    <?php endwhile; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        wp_reset_postdata();
                                        endif; ?>
                                </div>
                                <div class="entry-thumbnail">
                                    <?php if( $maintenance_works_banner_right_image ){ ?>
                                        <img src="<?php echo esc_url( $maintenance_works_banner_right_image ); ?>" alt="Banner Left Image">
                                    <?php } ?>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <section id="info-header">
                            <div class="header-wrapper">
                                <div class="theme-header-areas header-areas-left">
                                    <span class="service-icon"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 640 640"><path d="M341.9 38.1C328.5 29.9 311.6 29.9 298.2 38.1C273.8 53 258.7 57 230.1 56.4C214.4 56 199.8 64.5 192.2 78.3C178.5 103.4 167.4 114.5 142.3 128.2C128.5 135.7 120.1 150.4 120.4 166.1C121.1 194.7 117 209.8 102.1 234.2C93.9 247.6 93.9 264.5 102.1 277.9C117 302.3 121 317.4 120.4 346C120 361.7 128.5 376.3 142.3 383.9C164.4 396 175.6 406 187.4 425.4L138.7 522.5C132.8 534.4 137.6 548.8 149.4 554.7L235.4 597.7C246.9 603.4 260.9 599.1 267.1 587.9L319.9 492.8L372.7 587.9C378.9 599.1 392.9 603.5 404.4 597.7L490.4 554.7C502.3 548.8 507.1 534.4 501.1 522.5L452.5 425.3C464.2 405.9 475.5 395.9 497.6 383.8C511.4 376.3 519.8 361.6 519.5 345.9C518.8 317.3 522.9 302.2 537.8 277.8C546 264.4 546 247.5 537.8 234.1C522.9 209.7 518.9 194.6 519.5 166C519.9 150.3 511.4 135.7 497.6 128.1C472.5 114.4 461.4 103.3 447.7 78.2C440.2 64.4 425.5 56 409.8 56.3C381.2 57 366.1 52.9 341.7 38zM320 160C373 160 416 203 416 256C416 309 373 352 320 352C267 352 224 309 224 256C224 203 267 160 320 160z"/></svg></span>
                                    <div class="header-areas-box">
                                        <?php if( $maintenance_works_slider_section_guarantee_title ){ ?>
                                            <h6><?php echo esc_html( $maintenance_works_slider_section_guarantee_title ); ?></h6>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="theme-header-areas header-areas-left">
                                    <span class="service-icon"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg></span>
                                    <div class="header-areas-box">
                                        <?php if( $maintenance_works_slider_section_availablity_title ){ ?>
                                            <h6><?php echo esc_html( $maintenance_works_slider_section_availablity_title ); ?></h6>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="theme-header-areas header-areas-right">
                                    <span class="service-icon"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 384 512"><path d="M172.3 501.7C27 291 0 269.4 0 192 0 86 86 0 192 0s192 86 192 192c0 77.4-27 99-172.3 309.7-9.5 13.8-29.9 13.8-39.5 0zM192 272c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80z"/></svg></span>
                                    <div class="header-areas-box">
                                        <?php if( $maintenance_works_slider_section_location_title ){ ?>
                                            <h6><?php echo esc_html( $maintenance_works_slider_section_location_title ); ?></h6>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="theme-header-areas header-areas-right">
                                    <span class="service-icon"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"/></svg></span>
                                    <div class="header-areas-box">
                                        <?php if( $maintenance_works_slider_section_appoinment_title ){ ?>
                                            <h6><?php echo esc_html( $maintenance_works_slider_section_appoinment_title ); ?></h6>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
        <?php }
    }

endif;

if( !function_exists( 'maintenance_works_about_us_section' ) ) :

    function maintenance_works_about_us_section(){ 

        $maintenance_works_deafult = maintenance_works_get_default_theme_options();

        $maintenance_works_header_about_us = get_theme_mod( 'maintenance_works_header_about_us', 
        $maintenance_works_deafult['maintenance_works_header_about_us'] );

        $maintenance_works_about_us_section_title = esc_html( get_theme_mod( 'maintenance_works_about_us_section_title',
        $maintenance_works_deafult['maintenance_works_about_us_section_title'] ) );

        $maintenance_works_about_us_section_sub_title = esc_html( get_theme_mod( 'maintenance_works_about_us_section_sub_title',
        $maintenance_works_deafult['maintenance_works_about_us_section_sub_title'] ) );

        $maintenance_works_video_section_left_post_cat = get_theme_mod( 'maintenance_works_video_section_left_post_cat' );
        
        if( $maintenance_works_header_about_us ){ ?>
            <div class="most-read">
                <div class="wrapper">
                    <div class="list-heading-main">
                        <p class="list-title">
                            <?php if( $maintenance_works_about_us_section_title ){ ?>
                                <?php echo esc_html($maintenance_works_about_us_section_title) ?>
                            <?php } ?>
                        </p>
                        <h3 class="list-sub-title">
                            <?php if( $maintenance_works_about_us_section_sub_title ){ ?>
                                <?php echo esc_html($maintenance_works_about_us_section_sub_title) ?>
                            <?php } ?>
                        </h3>
                    </div>
                </div>
                <div class="most-read-div">
                    <div class="owl-carousel" role="listbox">
                        <?php  $maintenance_works_locations_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 6,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $maintenance_works_video_section_left_post_cat ) ) );
                        if( $maintenance_works_locations_query->have_posts() ): ?>
                            <?php
                                $s=1;
                                while( $maintenance_works_locations_query->have_posts() ):
                                $maintenance_works_locations_query->the_post();
                                $maintenance_works_featured_packs_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                $maintenance_works_featured_packs_image = isset( $maintenance_works_featured_packs_image[0] ) ? $maintenance_works_featured_packs_image[0] : '';

                                ?>                                
                                <div class="theme-article-post video-left-post-content">
                                    <div class="entry-thumbnail">
                                        <div class="data-bg featured-img" data-background="<?php echo esc_url($maintenance_works_featured_packs_image ? $maintenance_works_featured_packs_image : get_template_directory_uri() . '/assets/images/packs.png'); ?>">
                                        </div>
                                        <p class="postbtn"><a href="<?php esc_url( get_permalink() ); ?>"> <?php echo esc_html('More Details','maintenance-works'); ?> </a></p>
                                        <?php maintenance_works_post_format_icon(); ?>
                                    </div>
                                    <div class="main-video-caption">
                                        <header class="entry-header">
                                            <h2 class="entry-title entry-title-big">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a>
                                            </h2>
                                        </header>
                                        <div class="entry-content">
                                            <?php
                                                if (has_excerpt()) {

                                                    the_excerpt();

                                                } else {

                                                echo esc_html(wp_trim_words(get_the_content(), 35, '...'));

                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php $s++; endwhile; ?>
                        <?php wp_reset_postdata(); endif; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }

endif;

if (!function_exists('maintenance_works_post_format_icon')):

    // Post Format Icon.
    function maintenance_works_post_format_icon() {

        $maintenance_works_format = get_post_format(get_the_ID()) ?: 'standard';
        $maintenance_works_icon = '';
        $maintenance_works_title = '';
        if( $maintenance_works_format == 'video' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'video' );
            $maintenance_works_title = esc_html__('Video','maintenance-works');
        }elseif( $maintenance_works_format == 'audio' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'audio' );
            $maintenance_works_title = esc_html__('Audio','maintenance-works');
        }elseif( $maintenance_works_format == 'gallery' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'gallery' );
            $maintenance_works_title = esc_html__('Gallery','maintenance-works');
        }elseif( $maintenance_works_format == 'quote' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'quote' );
            $maintenance_works_title = esc_html__('Quote','maintenance-works');
        }elseif( $maintenance_works_format == 'image' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'image' );
            $maintenance_works_title = esc_html__('Image','maintenance-works');
        } elseif( $maintenance_works_format == 'link' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'link' );
            $maintenance_works_title = esc_html__('Link','maintenance-works');
        } elseif( $maintenance_works_format == 'status' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'status' );
            $maintenance_works_title = esc_html__('Status','maintenance-works');
        } elseif( $maintenance_works_format == 'aside' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'aside' );
            $maintenance_works_title = esc_html__('Aside','maintenance-works');
        } elseif( $maintenance_works_format == 'chat' ){
            $maintenance_works_icon = maintenance_works_get_theme_svg( 'chat' );
            $maintenance_works_title = esc_html__('Chat','maintenance-works');
        }
        
        if (!empty($maintenance_works_icon)) { ?>
            <div class="theme-post-format">
                <span class="post-format-icom"><?php echo maintenance_works_svg_escape($maintenance_works_icon); ?></span>
                <?php if( $maintenance_works_title ){ echo '<span class="post-format-label">'.esc_html( $maintenance_works_title ).'</span>'; } ?>
            </div>
        <?php }
    }

endif;

if ( ! function_exists( 'maintenance_works_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $maintenance_works_svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function maintenance_works_svg_escape( $maintenance_works_input ) {

        // Make sure that only our allowed tags and attributes are included.
        $maintenance_works_svg = wp_kses(
            $maintenance_works_input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $maintenance_works_svg ) {
            return false;
        }

        return $maintenance_works_svg;

    }

endif;

if( !function_exists( 'maintenance_works_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function maintenance_works_sanitize_sidebar_option_meta( $maintenance_works_input ){

        $maintenance_works_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $maintenance_works_input,$maintenance_works_metabox_options ) ){

            return $maintenance_works_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'maintenance_works_sanitize_pagination_meta' ) ) :

    // Sidebar Option Sanitize.
    function maintenance_works_sanitize_pagination_meta( $maintenance_works_input ){

        $maintenance_works_metabox_options = array( 'Center','Right','Left');
        if( in_array( $maintenance_works_input,$maintenance_works_metabox_options ) ){

            return $maintenance_works_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'maintenance_works_sanitize_menu_transform' ) ) :

    // Sidebar Option Sanitize.
    function maintenance_works_sanitize_menu_transform( $maintenance_works_input ){

        $maintenance_works_metabox_options = array( 'capitalize','uppercase','lowercase');
        if( in_array( $maintenance_works_input,$maintenance_works_metabox_options ) ){

            return $maintenance_works_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'maintenance_works_sanitize_page_content_alignment' ) ) :

    // Sidebar Option Sanitize.
    function maintenance_works_sanitize_page_content_alignment( $maintenance_works_input ){

        $maintenance_works_metabox_options = array( 'left','center','right');
        if( in_array( $maintenance_works_input,$maintenance_works_metabox_options ) ){

            return $maintenance_works_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'maintenance_works_sanitize_copyright_alignment_meta' ) ) :

    // Sidebar Option Sanitize.
    function maintenance_works_sanitize_copyright_alignment_meta( $maintenance_works_input ){

        $maintenance_works_metabox_options = array( 'Default','Reverse','Center');
        if( in_array( $maintenance_works_input,$maintenance_works_metabox_options ) ){

            return $maintenance_works_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'maintenance_works_sanitize_footer_widget_title_alignment' ) ) :

    // Footer Option Sanitize.
    function maintenance_works_sanitize_footer_widget_title_alignment( $maintenance_works_input ){

        $maintenance_works_metabox_options = array( 'left','center','right');
        if( in_array( $maintenance_works_input,$maintenance_works_metabox_options ) ){

            return $maintenance_works_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'maintenance_works_sanitize_pagination_type' ) ) :

    /**
     * Sanitize the pagination type setting.
     *
     * @param string $maintenance_works_input The input value from the Customizer.
     * @return string The sanitized value.
     */
    function maintenance_works_sanitize_pagination_type( $maintenance_works_input ) {
        // Define valid options for the pagination type.
        $maintenance_works_valid_options = array( 'numeric', 'newer_older' ); // Update valid options to include 'newer_older'

        // If the input is one of the valid options, return it. Otherwise, return the default option ('numeric').
        if ( in_array( $maintenance_works_input, $maintenance_works_valid_options, true ) ) {
            return $maintenance_works_input;
        } else {
            // Return 'numeric' as the fallback if the input is invalid.
            return 'numeric';
        }
    }

endif;


// Sanitize the enable/disable setting for pagination
if( !function_exists('maintenance_works_sanitize_enable_pagination') ) :
    function maintenance_works_sanitize_enable_pagination( $maintenance_works_input ) {
        return (bool) $maintenance_works_input;
    }
endif;

/**
 * Sidebar Layout Function
 */
function maintenance_works_get_final_sidebar_layout() {
	$maintenance_works_defaults       = maintenance_works_get_default_theme_options();
	$maintenance_works_global_layout  = get_theme_mod('maintenance_works_global_sidebar_layout', $maintenance_works_defaults['maintenance_works_global_sidebar_layout']);
	$maintenance_works_page_layout    = get_theme_mod('maintenance_works_page_sidebar_layout', $maintenance_works_global_layout);
	$maintenance_works_post_layout    = get_theme_mod('maintenance_works_post_sidebar_layout', $maintenance_works_global_layout);
	$maintenance_works_meta_layout    = get_post_meta(get_the_ID(), 'maintenance_works_post_sidebar_option', true);

	if (!empty($maintenance_works_meta_layout) && $maintenance_works_meta_layout !== 'default') {
		return $maintenance_works_meta_layout;
	}
	if (is_page() || (function_exists('is_shop') && is_shop())) {
		return $maintenance_works_page_layout;
	}
	if (is_single()) {
		return $maintenance_works_post_layout;
	}
	return $maintenance_works_global_layout;
}