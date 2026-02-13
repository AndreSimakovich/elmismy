<?php
/**
 * Maintenance Works functions and definitions
 * @package Maintenance Works
 */

if ( ! function_exists( 'maintenance_works_after_theme_support' ) ) :

	function maintenance_works_after_theme_support() {
		
		add_theme_support( 'automatic-feed-links' );

		add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
			)
		);

        load_theme_textdomain( 'maintenance-works', get_template_directory() . '/languages' );

		$GLOBALS['content_width'] = apply_filters( 'maintenance_works_content_width', 1140 );
		
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 270,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		
		add_theme_support( 'title-tag' );

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		add_theme_support( 'post-formats', array(
			'video',  
			'audio',  
			'gallery',
			'quote',  
			'image',  
			'link',   
			'status', 
			'aside',  
			'chat',   
		) );
		
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );

		require get_template_directory() . '/inc/metabox.php';
		require get_template_directory() . '/inc/homepage-setup/homepage-setup-settings.php';

		if (! defined( 'MAINTENANCE_WORK_DOCS_PRO' ) ){
		define('MAINTENANCE_WORK_DOCS_PRO',__('https://layout.omegathemes.com/steps/pro-maintenance-works/','maintenance-works'));
		}
		if (! defined( 'MAINTENANCE_WORK_BUY_NOW' ) ){
		define('MAINTENANCE_WORK_BUY_NOW',__('https://www.omegathemes.com/products/online-learning-wordpress-theme','maintenance-works'));
		}
		if (! defined( 'MAINTENANCE_WORK_SUPPORT_FREE' ) ){
		define('MAINTENANCE_WORK_SUPPORT_FREE',__('https://wordpress.org/support/theme/maintenance-works/','maintenance-works'));
		}
		if (! defined( 'MAINTENANCE_WORK_REVIEW_FREE' ) ){
		define('MAINTENANCE_WORK_REVIEW_FREE',__('https://wordpress.org/support/theme/maintenance-works/reviews/#new-post/','maintenance-works'));
		}
		if (! defined( 'MAINTENANCE_WORK_DEMO_PRO' ) ){
		define('MAINTENANCE_WORK_DEMO_PRO',__('https://layout.omegathemes.com/maintenance-works/','maintenance-works'));
		}
		if (! defined( 'MAINTENANCE_WORK_LITE_DOCS_PRO' ) ){
		define('MAINTENANCE_WORK_LITE_DOCS_PRO',__('https://layout.omegathemes.com/steps/maintenance-works-lite/','maintenance-works'));
		}
		if (! defined( 'MAINTENANCE_WORK_BUNDLE_BUTTON' ) ){
			define('MAINTENANCE_WORK_BUNDLE_BUTTON',__('https://www.omegathemes.com/products/wp-theme-bundle','maintenance-works'));
		}

	}

endif;

add_action( 'after_setup_theme', 'maintenance_works_after_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function maintenance_works_register_styles() {

	wp_enqueue_style( 'dashicons' );

    $maintenance_works_theme_version = wp_get_theme()->get( 'Version' );
	$maintenance_works_fonts_url = maintenance_works_fonts_url();
    if( $maintenance_works_fonts_url ){
    	require_once get_theme_file_path( 'lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'maintenance-works-google-fonts',
			maintenance_works_wptt_get_webfont_url( $maintenance_works_fonts_url ),
			array(),
			$maintenance_works_theme_version
		);
    }

    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/lib/swiper/css/swiper-bundle.min.css');
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/lib/custom/css/owl.carousel.css');
	wp_enqueue_style( 'maintenance-works-style', get_stylesheet_uri(), array(), $maintenance_works_theme_version );

	wp_enqueue_style( 'maintenance-works-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom_css.php' );
	wp_add_inline_style( 'maintenance-works-style',$maintenance_works_custom_css );

	$maintenance_works_css = '';

	if ( get_header_image() ) :

		$maintenance_works_css .=  '
			header#site-header{
				background-image: url('.esc_url(get_header_image()).') !important;
				-webkit-background-size: cover !important;
				-moz-background-size: cover !important;
				-o-background-size: cover !important;
				background-size: cover !important;
			}';

	endif;

	wp_add_inline_style( 'maintenance-works-style', $maintenance_works_css );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/lib/swiper/js/swiper-bundle.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'maintenance-works-custom', get_template_directory_uri() . '/lib/custom/js/theme-custom-script.js', array('jquery'), '', 1);
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/lib/custom/js/owl.carousel.js', array('jquery'), '', 1);

    // Global Query
    if( is_front_page() ){

    	$maintenance_works_posts_per_page = absint( get_option('posts_per_page') );
        $maintenance_works_c_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $maintenance_works_posts_args = array(
            'posts_per_page'        => $maintenance_works_posts_per_page,
            'paged'                 => $maintenance_works_c_paged,
        );
        $maintenance_works_posts_qry = new WP_Query( $maintenance_works_posts_args );
        $maintenance_works_max = $maintenance_works_posts_qry->max_num_pages;

    }else{
        global $wp_query;
        $maintenance_works_max = $wp_query->max_num_pages;
        $maintenance_works_c_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    }

    $maintenance_works_default = maintenance_works_get_default_theme_options();
    $maintenance_works_pagination_layout = get_theme_mod( 'maintenance_works_pagination_layout',$maintenance_works_default['maintenance_works_pagination_layout'] );
}

add_action( 'wp_enqueue_scripts', 'maintenance_works_register_styles',200 );

function maintenance_works_admin_enqueue_scripts_callback() {
    if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
    }
    wp_enqueue_script('maintenance-works-uploaderjs', get_stylesheet_directory_uri() . '/lib/custom/js/uploader.js', array(), "1.0", true);
}
add_action( 'admin_enqueue_scripts', 'maintenance_works_admin_enqueue_scripts_callback' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function maintenance_works_menus() {

	$maintenance_works_locations = array(
		'maintenance-works-primary-menu'  => esc_html__( 'Primary Menu', 'maintenance-works' ),
	);

	register_nav_menus( $maintenance_works_locations );
}

add_action( 'init', 'maintenance_works_menus' );

add_filter('loop_shop_columns', 'maintenance_works_loop_columns');
if (!function_exists('maintenance_works_loop_columns')) {
	function maintenance_works_loop_columns() {
		$maintenance_works_columns = get_theme_mod( 'maintenance_works_per_columns', 3 );
		return $maintenance_works_columns;
	}
}

add_filter( 'loop_shop_per_page', 'maintenance_works_per_page', 20 );
function maintenance_works_per_page( $maintenance_works_cols ) {
  	$maintenance_works_cols = get_theme_mod( 'maintenance_works_product_per_page', 9 );
	return $maintenance_works_cols;
}

add_filter( 'woocommerce_output_related_products_args', 'maintenance_works_products_args' );

function maintenance_works_products_args( $maintenance_works_args ) {

    $maintenance_works_args['posts_per_page'] = get_theme_mod( 'maintenance_works_custom_related_products_number', 6 );

    $maintenance_works_args['columns'] = get_theme_mod( 'maintenance_works_custom_related_products_number_per_row', 3 );

    return $maintenance_works_args;
}

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/lib/custom/css/dynamic-style.php';


function maintenance_works_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'maintenance_works_remove_customize_register', 11 );

function maintenance_works_radio_sanitize(  $maintenance_works_input, $maintenance_works_setting  ) {
	$maintenance_works_input = sanitize_key( $maintenance_works_input );
	$maintenance_works_choices = $maintenance_works_setting->manager->get_control( $maintenance_works_setting->id )->choices;
	return ( array_key_exists( $maintenance_works_input, $maintenance_works_choices ) ? $maintenance_works_input : $maintenance_works_setting->default );
}
require get_template_directory() . '/inc/general.php';

function maintenance_works_sticky_sidebar_enabled() {
    $maintenance_works_sticky_sidebar = get_theme_mod('maintenance_works_sticky_sidebar', true);
    
    if ($maintenance_works_sticky_sidebar == false) {
        $maintenance_works_custom_css = ".widget-area-wrapper { position: relative !important; }";
        wp_add_inline_style('maintenance-works-style', $maintenance_works_custom_css);
    }
}
add_action('wp_enqueue_scripts', 'maintenance_works_sticky_sidebar_enabled');

// NOTICE FUNCTION

function maintenance_works_admin_notice() { 
    global $pagenow;
    $theme_args = wp_get_theme();
    $meta = get_option( 'maintenance_works_admin_notice' );
    $name = $theme_args->get( 'Name' );
    $current_screen = get_current_screen();

    if ( ! $meta ) {
        if ( is_network_admin() ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( $current_screen->base != 'appearance_page_maintenanceworks-wizard' ) {
            ?>
            <div class="notice notice-success notice-content">
                <h2><?php esc_html_e('Welcome! Thank you for choosing Online Learning LMS. Let’s Set Up Your Website!', 'maintenance-works') ?> </h2>
                <p><?php esc_html_e('Before you dive into customization, let’s go through a quick setup process to ensure everything runs smoothly. Click below to start setting up your website in minutes!', 'maintenance-works') ?> </p>
                <div class="info-link">
                    <a href="<?php echo esc_url( admin_url( 'themes.php?page=maintenanceworks-wizard' ) ); ?>"><?php esc_html_e('Get Started with Online Learning LMS', 'maintenance-works'); ?></a>
                </div>
                <p class="dismiss-link"><strong><a href="?maintenance_works_admin_notice=1"><?php esc_html_e( 'Dismiss', 'maintenance-works' ); ?></a></strong></p>
            </div>
            <?php
        }
    }
}
add_action( 'admin_notices', 'maintenance_works_admin_notice' );

if ( ! function_exists( 'maintenance_works_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
 */
function maintenance_works_update_admin_notice() {
    if ( isset( $_GET['maintenance_works_admin_notice'] ) && $_GET['maintenance_works_admin_notice'] == '1' ) {
        update_option( 'maintenance_works_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'maintenance_works_update_admin_notice' );