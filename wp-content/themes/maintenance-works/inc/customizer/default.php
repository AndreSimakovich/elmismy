<?php
/**
 * Default Values.
 *
 * @package Maintenance Works
 */

if ( ! function_exists( 'maintenance_works_get_default_theme_options' ) ) :
	function maintenance_works_get_default_theme_options() {

		$maintenance_works_defaults = array();

        // Topbar
        $maintenance_works_defaults['maintenance_works_header_layout_phone_number']       =  esc_html__( '1234567890', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_header_layout_email_address']      =  esc_html__( 'support@example.com', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_header_layout_address']            =  esc_html__( '445 S St unit 12, Santa Rosa CA 95404, United States', 'maintenance-works' );

        $maintenance_works_defaults['maintenance_works_header_layout_facebook_link']           =  esc_url( '#', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_header_layout_twitter_link']            =  esc_url( '#', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_header_layout_pintrest_link']           =  esc_url( '#', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_header_layout_instagram_link']          =  esc_url( '#', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_header_layout_youtube_link']            =  esc_url( '#', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_header_search']                         = 0;
        $maintenance_works_defaults['maintenance_works_theme_loader']                 = 0;
        $maintenance_works_defaults['maintenance_works_footer_column_layout']                       = 3;
        $maintenance_works_defaults['maintenance_works_menu_font_size']                 = 14;
        $maintenance_works_defaults['maintenance_works_copyright_font_size']                 = 16; 
        $maintenance_works_defaults['maintenance_works_breadcrumb_font_size']                 = 16;
        $maintenance_works_defaults['maintenance_works_excerpt_limit']                 = 20;
        $maintenance_works_defaults['maintenance_works_per_columns']                 = 3;  
        $maintenance_works_defaults['maintenance_works_product_per_page']                 = 9;   
        $maintenance_works_defaults['maintenance_works_custom_related_products_number'] = 6;
        $maintenance_works_defaults['maintenance_works_custom_related_products_number_per_row'] = 3;
        $maintenance_works_defaults['maintenance_works_menu_text_transform']                 = 'capitalize'; 
        $maintenance_works_defaults['maintenance_works_single_page_content_alignment']                 = 'left';
        $maintenance_works_defaults['maintenance_works_theme_breadcrumb_options_alignment']                      = 'Center';
        $maintenance_works_defaults['maintenance_works_theme_pagination_options_alignment']                      = 'Center';
        $maintenance_works_defaults['maintenance_works_display_footer']            = 1;
        $maintenance_works_defaults['maintenance_works_footer_widget_title_alignment']                 = 'left'; 
        $maintenance_works_defaults['maintenance_works_show_hide_related_product']          = 1;
        $maintenance_works_defaults['maintenance_works_display_archive_post_image']            = 1;
        $maintenance_works_defaults['maintenance_works_sticky']                                         = 0;
        $maintenance_works_defaults['maintenance_works_theme_breadcrumb_enable']                 = 1;
        $maintenance_works_defaults['maintenance_works_single_post_content_alignment']                 = 'left';

        //Slider 

        $maintenance_works_defaults['maintenance_works_slider_section_guarantee_title']        =  esc_html__( 'Satisfaction Guarantee', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_slider_section_availablity_title']      =  esc_html__( '24H Availability', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_slider_section_location_title']         =  esc_html__( 'Local US Professional', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_slider_section_appoinment_title']       =  esc_html__( 'Flexible Appointments', 'maintenance-works' );

        
        $maintenance_works_defaults['maintenance_works_about_us_left_image']                    = esc_url(get_template_directory_uri() . '/assets/images/about.png');
        $maintenance_works_defaults['maintenance_works_banner_left_image']                    = esc_url(get_template_directory_uri() . '/assets/images/banner-1.png');
        $maintenance_works_defaults['maintenance_works_banner_right_image']                    = esc_url(get_template_directory_uri() . '/assets/images/banner-2.png');
        
	// Options.
        $maintenance_works_defaults['maintenance_works_logo_width_range']                 = 200;
        
        $maintenance_works_defaults['maintenance_works_global_sidebar_layout']	          = 'right-sidebar';
        
        $maintenance_works_defaults['maintenance_works_pagination_layout']                = 'numeric';
        $maintenance_works_defaults['maintenance_works_footer_copyright_text'] 	  = esc_html__( 'All rights reserved.', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_twp_navigation_type']              = 'theme-normal-navigation';
        $maintenance_works_defaults['maintenance_works_post_author']                      = 1;
        $maintenance_works_defaults['maintenance_works_post_date']                        = 1;
        $maintenance_works_defaults['maintenance_works_post_category']                	  = 1;
        $maintenance_works_defaults['maintenance_works_post_tags']                        = 1;
        $maintenance_works_defaults['maintenance_works_floating_next_previous_nav']       = 1;
        $maintenance_works_defaults['maintenance_works_header_slider']                    = 1;
        $maintenance_works_defaults['maintenance_works_background_color']                       = '#fff';
        $maintenance_works_defaults['maintenance_works_global_color']                           = '#125665';
        $maintenance_works_defaults['maintenance_works_secondary_color']                           = '#F18F20';
        $maintenance_works_defaults['maintenance_works_display_archive_post_category']          = 1;
        $maintenance_works_defaults['maintenance_works_display_archive_post_title']             = 1;
        $maintenance_works_defaults['maintenance_works_display_archive_post_content']           = 1;
        $maintenance_works_defaults['maintenance_works_display_archive_post_button']            = 1;
        
        $maintenance_works_defaults['maintenance_works_display_single_post_image']            = 1;
        $maintenance_works_defaults['maintenance_works_display_archive_post_format_icon']       = 1;
        
        $maintenance_works_defaults['maintenance_works_enable_to_the_top']                      = 1;
        $maintenance_works_defaults['maintenance_works_to_the_top_text']                      = esc_html__( 'To The Top', 'maintenance-works' );

        //Our Projects
        $maintenance_works_defaults['maintenance_works_header_about_us']                   = 1;
        $maintenance_works_defaults['maintenance_works_about_us_section_title']            = esc_html__( 'OUR PROJECTS', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_about_us_section_sub_title']        = esc_html__( 'We are experienced work lovers on Quality', 'maintenance-works' );

        // 404 Page Defaults
        $maintenance_works_defaults['maintenance_works_404_main_title'] = esc_html__( 'Oops! That page can’t be found.', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_404_subtitle_one'] = esc_html__( 'Maybe it’s out there, somewhere...', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_404_para_one'] = esc_html__( 'You can always find insightful stories on our', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_404_subtitle_two'] = esc_html__( 'Still feeling lost? You’re not alone.', 'maintenance-works' );
        $maintenance_works_defaults['maintenance_works_404_para_two'] = esc_html__( 'Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'maintenance-works' );

	// Pass through filter.
	$maintenance_works_defaults = apply_filters( 'maintenance_works_filter_default_theme_options', $maintenance_works_defaults );

		return $maintenance_works_defaults;
	}
endif;