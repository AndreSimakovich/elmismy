<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package    ThemeGrill
 * @subpackage Elmispase
 * @since      Elmispase 1.0
 */

add_action( 'widgets_init', 'elmispase_widgets_init' );
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function elmispase_widgets_init() {

	// Registering main right sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'elmispase' ),
		'id'            => 'elmispase_right_sidebar',
		'description'   => esc_html__( 'Shows widgets at Right side.', 'elmispase' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering main left sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'elmispase' ),
		'id'            => 'elmispase_left_sidebar',
		'description'   => esc_html__( 'Shows widgets at Left side.', 'elmispase' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Header sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Header Sidebar', 'elmispase' ),
		'id'            => 'elmispase_header_sidebar',
		'description'   => esc_html__( 'Shows widgets in header section just above the main navigation menu.', 'elmispase' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering Business Page template top section sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Business Top Sidebar', 'elmispase' ),
		'id'            => 'elmispase_business_page_top_section_sidebar',
		'description'   => esc_html__( 'Shows widgets on Business Page Template Top Section.', 'elmispase' ) . ' ' . __( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Widget', 'elmispase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering Business Page template middle section left half sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Business Middle Left Sidebar', 'elmispase' ),
		'id'            => 'elmispase_business_page_middle_section_left_half_sidebar',
		'description'   => esc_html__( 'Shows widgets on Business Page Template Middle Section Left Half.', 'elmispase' ) . ' ' . __( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'elmispase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering Business Page template middle section right half sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Business Middle Right Sidebar', 'elmispase' ),
		'id'            => 'elmispase_business_page_middle_section_right_half_sidebar',
		'description'   => esc_html__( 'Shows widgets on Business Page Template Middle Section Right Half.', 'elmispase' ) . ' ' . __( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'elmispase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


	// Registering Business Page template bottom section sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Business Bottom Sidebar', 'elmispase' ),
		'id'            => 'elmispase_business_page_bottom_section_sidebar',
		'description'   => esc_html__( 'Shows widgets on Business Page Template Bottom Section.', 'elmispase' ) . ' ' . __( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Widget', 'elmispase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering contact Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Page Sidebar', 'elmispase' ),
		'id'            => 'elmispase_contact_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Contact Page Template.', 'elmispase' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Error 404 Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Error 404 Page Sidebar', 'elmispase' ),
		'id'            => 'elmispase_error_404_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Error 404 page.', 'elmispase' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar One', 'elmispase' ),
		'id'            => 'elmispase_footer_sidebar_one',
		'description'   => esc_html__( 'Shows widgets at footer sidebar one.', 'elmispase' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// custom footer sidebar column select
	$sidebar_num = '';
	$sidebar_num = get_theme_mod( 'elmispase_footer_widget_column_select_type', 'four' );
	if ( $sidebar_num == 'four' || $sidebar_num == 'three' || $sidebar_num == 'two' ) {
		// Registering footer sidebar two
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar Two', 'elmispase' ),
			'id'            => 'elmispase_footer_sidebar_two',
			'description'   => esc_html__( 'Shows widgets at footer sidebar two.', 'elmispase' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	if ( $sidebar_num == 'four' || $sidebar_num == 'three' ) {
		// Registering footer sidebar three
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar Three', 'elmispase' ),
			'id'            => 'elmispase_footer_sidebar_three',
			'description'   => esc_html__( 'Shows widgets at footer sidebar three.', 'elmispase' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	if ( $sidebar_num == 'four' ) {
		// Registering footer sidebar four
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar Four', 'elmispase' ),
			'id'            => 'elmispase_footer_sidebar_four',
			'description'   => esc_html__( 'Shows widgets at footer sidebar four.', 'elmispase' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	// Registering woocommerce sidebar
	if ( class_exists( 'woocommerce' ) ) {
		register_sidebar( array(
			'name'          => __( 'Shop Sidebar', 'elmispase' ),
			'id'            => 'elmispase_woocommerce_sidebar',
			'description'   => __( 'Widget area for WooCommerce Pages.', 'elmispase' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	// Registering widgets
	register_widget( 'elmispase_featured_single_page_widget' );
	register_widget( 'elmispase_service_widget' );
	register_widget( 'elmispase_call_to_action_widget' );
	register_widget( 'elmispase_testimonial_widget' );
	register_widget( 'elmispase_recent_work_widget' );
}

/**
 * Include Elmispase widgets class.
 */
// Class: TG: Featured Single Page.
require_once get_template_directory() . '/inc/widgets/class-elmispase-featured-single-page-widget.php';

// Class: TG: Services.
require_once get_template_directory() . '/inc/widgets/class-elmispase-service-widget.php';

// Class: TG: Call to Action Widget.
require_once get_template_directory() . '/inc/widgets/class-elmispase-call-to-action-widget.php';

// Class: TG: Testimonial.
require_once get_template_directory() . '/inc/widgets/class-elmispase-testimonial-widget.php';

// Class: TG: Featured Widget.
require_once get_template_directory() . '/inc/widgets/class-elmispase-recent-work-widget.php';
