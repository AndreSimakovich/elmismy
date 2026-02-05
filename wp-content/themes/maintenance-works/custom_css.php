<?php

$maintenance_works_custom_css = "";

	$maintenance_works_theme_pagination_options_alignment = get_theme_mod('maintenance_works_theme_pagination_options_alignment', 'Center');
		if ($maintenance_works_theme_pagination_options_alignment == 'Center') {
		    $maintenance_works_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		    $maintenance_works_custom_css .= 'justify-content: center;margin: 0 auto;';
		    $maintenance_works_custom_css .= '}';
		} else if ($maintenance_works_theme_pagination_options_alignment == 'Right') {
		    $maintenance_works_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		    $maintenance_works_custom_css .= 'justify-content: right;margin: 0 0 0 auto;';
		    $maintenance_works_custom_css .= '}';
		} else if ($maintenance_works_theme_pagination_options_alignment == 'Left') {
		    $maintenance_works_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		    $maintenance_works_custom_css .= 'justify-content: left;margin: 0 auto 0 0;';
		    $maintenance_works_custom_css .= '}';
	}	

	$maintenance_works_theme_breadcrumb_enable = get_theme_mod('maintenance_works_theme_breadcrumb_enable',true);
    if($maintenance_works_theme_breadcrumb_enable != true){
        $maintenance_works_custom_css .='nav.breadcrumb-trail.breadcrumbs,nav.woocommerce-breadcrumb{';
            $maintenance_works_custom_css .='display: none;';
        $maintenance_works_custom_css .='}';
    }

	$maintenance_works_theme_breadcrumb_options_alignment = get_theme_mod('maintenance_works_theme_breadcrumb_options_alignment', 'Left');
	if ($maintenance_works_theme_breadcrumb_options_alignment == 'Center') {
	    $maintenance_works_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $maintenance_works_custom_css .= 'text-align: center !important;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_theme_breadcrumb_options_alignment == 'Right') {
	    $maintenance_works_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $maintenance_works_custom_css .= 'text-align: Right !important;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_theme_breadcrumb_options_alignment == 'Left') {
	    $maintenance_works_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $maintenance_works_custom_css .= 'text-align: Left !important;';
	    $maintenance_works_custom_css .= '}';
	}

	$maintenance_works_single_page_content_alignment = get_theme_mod('maintenance_works_single_page_content_alignment', 'left');
	if ($maintenance_works_single_page_content_alignment == 'left') {
	    $maintenance_works_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $maintenance_works_custom_css .= 'text-align: left !important;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_single_page_content_alignment == 'center') {
	    $maintenance_works_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $maintenance_works_custom_css .= 'text-align: center !important;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_single_page_content_alignment == 'right') {
	    $maintenance_works_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $maintenance_works_custom_css .= 'text-align: right !important;';
	    $maintenance_works_custom_css .= '}';
	}

	$maintenance_works_single_post_content_alignment = get_theme_mod('maintenance_works_single_post_content_alignment', 'left');
	if ($maintenance_works_single_post_content_alignment == 'left') {
	    $maintenance_works_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $maintenance_works_custom_css .= 'text-align: left !important;justify-content: left;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_single_post_content_alignment == 'center') {
	    $maintenance_works_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $maintenance_works_custom_css .= 'text-align: center !important;justify-content: center;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_single_post_content_alignment == 'right') {
	    $maintenance_works_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $maintenance_works_custom_css .= 'text-align: right !important;justify-content: right;';
	    $maintenance_works_custom_css .= '}';
	}

	$maintenance_works_menu_text_transform = get_theme_mod('maintenance_works_menu_text_transform', 'Capitalize');
	if ($maintenance_works_menu_text_transform == 'Capitalize') {
	    $maintenance_works_custom_css .= '.site-navigation .primary-menu > li a{';
	    $maintenance_works_custom_css .= 'text-transform: Capitalize !important;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_menu_text_transform == 'uppercase') {
	    $maintenance_works_custom_css .= '.site-navigation .primary-menu > li a{';
	    $maintenance_works_custom_css .= 'text-transform: uppercase !important;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_menu_text_transform == 'lowercase') {
	    $maintenance_works_custom_css .= '.site-navigation .primary-menu > li a{';
	    $maintenance_works_custom_css .= 'text-transform: lowercase !important;';
	    $maintenance_works_custom_css .= '}';
	}

	$maintenance_works_footer_widget_title_alignment = get_theme_mod('maintenance_works_footer_widget_title_alignment', 'left');
	if ($maintenance_works_footer_widget_title_alignment == 'left') {
	    $maintenance_works_custom_css .= 'h2.widget-title{';
	    $maintenance_works_custom_css .= 'text-align: left !important;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_footer_widget_title_alignment == 'center') {
	    $maintenance_works_custom_css .= 'h2.widget-title{';
	    $maintenance_works_custom_css .= 'text-align: center !important;';
	    $maintenance_works_custom_css .= '}';
	} else if ($maintenance_works_footer_widget_title_alignment == 'right') {
	    $maintenance_works_custom_css .= 'h2.widget-title{';
	    $maintenance_works_custom_css .= 'text-align: right !important;';
	    $maintenance_works_custom_css .= '}';
	}

    $maintenance_works_show_hide_related_product = get_theme_mod('maintenance_works_show_hide_related_product',true);
    if($maintenance_works_show_hide_related_product != true){
        $maintenance_works_custom_css .='.related.products{';
            $maintenance_works_custom_css .='display: none;';
        $maintenance_works_custom_css .='}';
    }

	/*-------------------- Global First Color -------------------*/

	$maintenance_works_global_color = get_theme_mod('maintenance_works_global_color', '#125665'); // Add a fallback if the color isn't set

	if ($maintenance_works_global_color) {
		$maintenance_works_custom_css .= ':root {';
		$maintenance_works_custom_css .= '--global-color: ' . esc_attr($maintenance_works_global_color) . ';';
		$maintenance_works_custom_css .= '}';
	}

	/*-------------------- Secondary First Color -------------------*/

	$maintenance_works_secondary_color = get_theme_mod('maintenance_works_secondary_color', '#F18F20'); // Add a fallback if the color isn't set

	if ($maintenance_works_secondary_color) {
		$maintenance_works_custom_css .= ':root {';
		$maintenance_works_custom_css .= '--secondary-color: ' . esc_attr($maintenance_works_secondary_color) . ';';
		$maintenance_works_custom_css .= '}';
	}

	/*-------------------- Content Font -------------------*/

	$maintenance_works_content_typography_font = get_theme_mod('maintenance_works_content_typography_font', 'PlusJakartaSans'); // Add a fallback if the color isn't set

	if ($maintenance_works_content_typography_font) {
		$maintenance_works_custom_css .= ':root {';
		$maintenance_works_custom_css .= '--font-main: ' . esc_attr($maintenance_works_content_typography_font) . ';';
		$maintenance_works_custom_css .= '}';
	}

	/*-------------------- Heading Font -------------------*/

	$maintenance_works_heading_typography_font = get_theme_mod('maintenance_works_heading_typography_font', 'PlusJakartaSans'); // Add a fallback if the color isn't set

	if ($maintenance_works_heading_typography_font) {
		$maintenance_works_custom_css .= ':root {';
		$maintenance_works_custom_css .= '--font-head: ' . esc_attr($maintenance_works_heading_typography_font) . ';';
		$maintenance_works_custom_css .= '}';
	}
									
	$maintenance_works_columns = get_theme_mod('maintenance_works_posts_per_columns', 3);
	$maintenance_works_columns = absint($maintenance_works_columns);
	if ( $maintenance_works_columns < 1 || $maintenance_works_columns > 6 ) {
		$maintenance_works_columns = 3;
	}
	$maintenance_works_custom_css .= "
		.site-content .article-wraper-archive {
			grid-template-columns: repeat({$maintenance_works_columns}, 1fr);
		}
	";

	$maintenance_works_copyright_alignment = get_theme_mod( 'maintenance_works_copyright_alignment', 'Default' );
	if ( $maintenance_works_copyright_alignment === 'Reverse' ) {
		$maintenance_works_custom_css .= '.site-info .column-row { flex-direction: row-reverse; }';
		$maintenance_works_custom_css .= '.footer-credits { justify-content: flex-end; }';
		$maintenance_works_custom_css .= '.footer-copyright { text-align: right; }';
		$maintenance_works_custom_css .= '.site-info .column.column-3 { text-align: left; }';
	} elseif ( $maintenance_works_copyright_alignment === 'Center' ) {
		$maintenance_works_custom_css .= '.site-info .column-row { flex-direction: column; align-items: center; gap: 15px; }';
		$maintenance_works_custom_css .= '.footer-credits { justify-content: center; }';
		$maintenance_works_custom_css .= '.footer-copyright { text-align: center; }';
		$maintenance_works_custom_css .= '.site-info .column.column-3 { text-align: center; }';
	}

	$maintenance_works_footer_widget_background_color = get_theme_mod('maintenance_works_footer_widget_background_color');
	if ($maintenance_works_footer_widget_background_color) {

		$maintenance_works_custom_css .= "
			.footer-widgetarea {
				background-color: ". esc_attr($maintenance_works_footer_widget_background_color) .";
			}
		";
	}

	$maintenance_works_footer_widget_background_image = get_theme_mod('maintenance_works_footer_widget_background_image');
	if ($maintenance_works_footer_widget_background_image) {
		$maintenance_works_custom_css .= "
			.footer-widgetarea {
				background-image: url(" . esc_url($maintenance_works_footer_widget_background_image) . ");
			}
		";
	}

	$maintenance_works_copyright_font_size = get_theme_mod('maintenance_works_copyright_font_size');
	if ($maintenance_works_copyright_font_size) {

		$maintenance_works_custom_css .= "
			.footer-copyright {
				font-size: ". esc_attr($maintenance_works_copyright_font_size) ."px;
			}
		";
	}

	/*-------------------- Menu Color CSS -------------------*/

	$maintenance_works_header_menus_color = get_theme_mod('maintenance_works_header_menus_color');
	if($maintenance_works_header_menus_color != false){
		$maintenance_works_custom_css .='.site-navigation .primary-menu a{';
			$maintenance_works_custom_css .='color: '.esc_attr($maintenance_works_header_menus_color).'!important;';
		$maintenance_works_custom_css .='}';
	}

	$maintenance_works_header_menus_hover_color = get_theme_mod('maintenance_works_header_menus_hover_color');
	if($maintenance_works_header_menus_hover_color != false){
		$maintenance_works_custom_css .='.site-navigation .primary-menu a:hover{';
			$maintenance_works_custom_css .='color: '.esc_attr($maintenance_works_header_menus_hover_color).'!important;';
		$maintenance_works_custom_css .='}';
	}

	$maintenance_works_header_submenus_color = get_theme_mod('maintenance_works_header_submenus_color');
	if($maintenance_works_header_submenus_color != false){
		$maintenance_works_custom_css .='.site-navigation .primary-menu ul.sub-menu li a,.site-navigation .primary-menu li ul li a{';
			$maintenance_works_custom_css .='color: '.esc_attr($maintenance_works_header_submenus_color).'!important;';
		$maintenance_works_custom_css .='}';
	}

	$maintenance_works_header_submenus_hover_color = get_theme_mod('maintenance_works_header_submenus_hover_color');
	if($maintenance_works_header_submenus_hover_color != false){
		$maintenance_works_custom_css .='.site-navigation .primary-menu > li ul.sub-menu a:hover,.site-navigation .primary-menu li ul li a:hover{';
			$maintenance_works_custom_css .='color: '.esc_attr($maintenance_works_header_submenus_hover_color).'!important;';
		$maintenance_works_custom_css .='}';
	}