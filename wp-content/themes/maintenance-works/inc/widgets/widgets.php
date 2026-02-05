<?php
/**
* Widget Functions.
*
* @package Maintenance Works
*/


function maintenance_works_widgets_init(){

	register_sidebar(array(
	    'name' => esc_html__('Main Sidebar', 'maintenance-works'),
	    'id' => 'sidebar-1',
	    'description' => esc_html__('Add widgets here.', 'maintenance-works'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>',
	));


    $maintenance_works_default = maintenance_works_get_default_theme_options();
    $maintenance_works_maintenance_works_footer_column_layout = absint( get_theme_mod( 'maintenance_works_footer_column_layout',$maintenance_works_default['maintenance_works_footer_column_layout'] ) );

    for( $maintenance_works_i = 0; $maintenance_works_i < $maintenance_works_maintenance_works_footer_column_layout; $maintenance_works_i++ ){
    	
    	if( $maintenance_works_i == 0 ){ $maintenance_works_count = esc_html__('One','maintenance-works'); }
    	if( $maintenance_works_i == 1 ){ $maintenance_works_count = esc_html__('Two','maintenance-works'); }
    	if( $maintenance_works_i == 2 ){ $maintenance_works_count = esc_html__('Three','maintenance-works'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'maintenance-works').$maintenance_works_count,
	        'id' => 'maintenance-works-footer-widget-'.$maintenance_works_i,
	        'description' => esc_html__('Add widgets here.', 'maintenance-works'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'maintenance_works_widgets_init');