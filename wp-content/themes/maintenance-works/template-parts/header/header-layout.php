<?php
/**
 * Header Layout
 * @package Maintenance Works
 */

$maintenance_works_default = maintenance_works_get_default_theme_options();

$maintenance_works_header_layout_phone_number = esc_html( get_theme_mod( 'maintenance_works_header_layout_phone_number',
$maintenance_works_default['maintenance_works_header_layout_phone_number'] ) );

$maintenance_works_header_layout_email_address = esc_html( get_theme_mod( 'maintenance_works_header_layout_email_address',
$maintenance_works_default['maintenance_works_header_layout_email_address'] ) );

$maintenance_works_header_layout_address = esc_html( get_theme_mod( 'maintenance_works_header_layout_address',
$maintenance_works_default['maintenance_works_header_layout_address'] ) );


//Social Icons
$maintenance_works_header_layout_facebook_link = esc_html( get_theme_mod( 'maintenance_works_header_layout_facebook_link',
$maintenance_works_default['maintenance_works_header_layout_facebook_link'] ) );

$maintenance_works_header_layout_twitter_link = esc_html( get_theme_mod( 'maintenance_works_header_layout_twitter_link',
$maintenance_works_default['maintenance_works_header_layout_twitter_link'] ) );

$maintenance_works_header_layout_pintrest_link = esc_html( get_theme_mod( 'maintenance_works_header_layout_pintrest_link',
$maintenance_works_default['maintenance_works_header_layout_pintrest_link'] ) );

$maintenance_works_header_layout_instagram_link = esc_html( get_theme_mod( 'maintenance_works_header_layout_instagram_link',
$maintenance_works_default['maintenance_works_header_layout_instagram_link'] ) );

$maintenance_works_header_layout_youtube_link = esc_html( get_theme_mod( 'maintenance_works_header_layout_youtube_link',
$maintenance_works_default['maintenance_works_header_layout_youtube_link'] ) );

$maintenance_works_header_search = get_theme_mod( 'maintenance_works_header_search', 
$maintenance_works_default['maintenance_works_header_search'] );

$maintenance_works_sticky = get_theme_mod('maintenance_works_sticky');
$maintenance_works_data_sticky = "false";
if ($maintenance_works_sticky) {
$maintenance_works_data_sticky = "true";
}
?>

<section id="center-header">
    <div class=" header-main wrapper">
        <div class="header-right-box theme-header-areas">
            <section id="top-header" style="background-image: url('<?php echo esc_url(get_template_directory_uri() ); ?>/assets/images/topbar-bg.png')">
                <div class="header-wrapper">
                    <div class="theme-header-areas header-areas-right">
                        <?php if( $maintenance_works_header_layout_phone_number ){ ?>
                           <span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M97.3 507c-129.9-129.9-129.7-340.3 0-469.9 5.7-5.7 14.5-6.6 21.3-2.4l64.8 40.5a17.2 17.2 0 0 1 6.8 21l-32.4 81a17.2 17.2 0 0 1 -17.7 10.7l-55.8-5.6c-21.1 58.3-20.6 122.5 0 179.5l55.8-5.6a17.2 17.2 0 0 1 17.7 10.7l32.4 81a17.2 17.2 0 0 1 -6.8 21l-64.8 40.5a17.2 17.2 0 0 1 -21.3-2.4zM247.1 95.5c11.8 20 11.8 45 0 65.1-4 6.7-13.1 8-18.7 2.6l-6-5.7c-3.9-3.7-4.8-9.6-2.3-14.4a32.1 32.1 0 0 0 0-29.9c-2.5-4.8-1.7-10.7 2.3-14.4l6-5.7c5.6-5.4 14.8-4.1 18.7 2.6zm91.8-91.2c60.1 71.6 60.1 175.9 0 247.4-4.5 5.3-12.5 5.7-17.6 .9l-5.8-5.6c-4.6-4.4-5-11.5-.9-16.4 49.7-59.5 49.6-145.9 0-205.4-4-4.9-3.6-12 .9-16.4l5.8-5.6c5-4.8 13.1-4.4 17.6 .9zm-46 44.9c36.1 46.3 36.1 111.1 0 157.5-4.4 5.6-12.7 6.3-17.9 1.3l-5.8-5.6c-4.4-4.2-5-11.1-1.3-15.9 26.5-34.6 26.5-82.6 0-117.1-3.7-4.8-3.1-11.7 1.3-15.9l5.8-5.6c5.2-4.9 13.5-4.3 17.9 1.3z"/></svg>
                            <a href="tell:<?php echo esc_attr( $maintenance_works_header_layout_phone_number ); ?>"><?php echo esc_html( $maintenance_works_header_layout_phone_number ); ?></a></span>
                        <?php } ?>
                    </div>
                    <div class="theme-header-areas header-areas-right side-border">
                        <?php if( $maintenance_works_header_layout_email_address ){ ?>
                           <span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7 .3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2 .4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/></svg><a href="mailto:<?php echo esc_html( $maintenance_works_header_layout_email_address ); ?>"><?php echo esc_html( $maintenance_works_header_layout_email_address ); ?></a></span>
                        <?php } ?>
                    </div>
                    <div class="theme-header-areas header-areas-right">
                        <?php if( $maintenance_works_header_layout_address ){ ?>
                           <span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M172.3 501.7C27 291 0 269.4 0 192 0 86 86 0 192 0s192 86 192 192c0 77.4-27 99-172.3 309.7-9.5 13.8-29.9 13.8-39.5 0zM192 272c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80z"/></svg><?php echo esc_html( $maintenance_works_header_layout_address ); ?></span>
                        <?php } ?>
                    </div>
                    <div class="theme-header-areas">
                        <div class="social-area">
                            <?php if( $maintenance_works_header_layout_facebook_link ){ ?>
                               <a target="_blank" href="<?php echo esc_url( $maintenance_works_header_layout_facebook_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg></a>
                            <?php } ?>
                            <?php if( $maintenance_works_header_layout_twitter_link ){ ?>
                               <a target="_blank" href="<?php echo esc_url( $maintenance_works_header_layout_twitter_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg></a>
                            <?php } ?>
                            <?php if( $maintenance_works_header_layout_pintrest_link ){ ?>
                               <a target="_blank" href="<?php echo esc_url( $maintenance_works_header_layout_pintrest_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg></a>
                            <?php } ?>
                            <?php if( $maintenance_works_header_layout_instagram_link ){ ?>
                               <a target="_blank" href="<?php echo esc_url( $maintenance_works_header_layout_instagram_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a>
                            <?php } ?>
                            <?php if( $maintenance_works_header_layout_youtube_link ){ ?>
                               <a target="_blank" href="<?php echo esc_url( $maintenance_works_header_layout_youtube_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
            <header id="site-header" class="site-header-layout header-layout Stickyy <?php if( is_user_logged_in() && !isset( $wp_customize ) ){ echo "login-user";} ?>" data-sticky="<?php echo esc_attr($maintenance_works_data_sticky); ?>" role="banner">
                <div class="header-center">
                    <div class="theme-header-areas header-areas-right header-menu">
                        <div class="site-navigation">
                            <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'maintenance-works'); ?>" role="navigation">
                                <ul class="primary-menu theme-menu">
                                    <?php
                                    if (has_nav_menu('maintenance-works-primary-menu')) {
                                        wp_nav_menu(
                                            array(
                                                'container' => '',
                                                'items_wrap' => '%3$s',
                                                'theme_location' => 'maintenance-works-primary-menu',
                                            )
                                        );
                                    } else {
                                        wp_list_pages(
                                            array(
                                                'match_menu_classes' => true,
                                                'show_sub_menu_icons' => true,
                                                'title_li' => false,
                                                'walker' => new Maintenance_Works_Walker_Page(),
                                            )
                                        );
                                    } ?>
                                </ul>
                            </nav>
                        </div>
                        <div class="navbar-controls twp-hide-js">
                            <button type="button" class="navbar-control navbar-control-offcanvas">
                                <span class="navbar-control-trigger" tabindex="-1">
                                    <?php maintenance_works_the_theme_svg('menu'); ?>
                                </span>
                            </button>
                        </div>
                    </div>
                    <?php if( $maintenance_works_header_search ){ ?>
                    <div class="theme-header-areas header-areas-right header-search">
                        <a href="#search">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6 .1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
                        </a>
                        <!-- Search Form -->
                        <div id="search">
                            <span class="close">X</span>
                            <?php get_search_form(); ?>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </header>
            <section class="logo-box">
                <div class="header-logo" style="background-image: url('<?php echo esc_url(get_template_directory_uri() ); ?>/assets/images/logo-bg.png')">
                    <div class="header-titles">
                        <?php
                            maintenance_works_site_logo();
                            maintenance_works_site_description();
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
