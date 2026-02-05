<?php


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

/**
 * $content_width global variable adjustment as per layout option.
 */
function elmispase_content_width() {
	global $post;
	global $content_width;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'elmispase_page_layout', true );
	}

	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}

	$elmispase_default_layout = get_theme_mod( 'default_layout', 'right_sidebar' );

	if ( $layout_meta == 'default_layout' ) {

		if ( ( get_theme_mod( 'elmispase_site_layout', 'box_1218px' ) == 'box_978px' ) || ( get_theme_mod( 'elmispase_site_layout', 'box_1218px' ) == 'wide_978px' ) ) {
			if ( $elmispase_default_layout == 'no_sidebar_full_width' ) {
				$content_width = 978; /* pixels */
			} else {
				$content_width = 642; /* pixels */
			}
		} elseif ( $elmispase_default_layout == 'no_sidebar_full_width' ) {
			$content_width = 1218; /* pixels */
		} else {
			$content_width = 750; /* pixels */
		}
	} elseif ( ( get_theme_mod( 'elmispase_site_layout', 'box_1218px' ) == 'box_978px' ) || ( get_theme_mod( 'elmispase_site_layout', 'box_1218px' ) == 'wide_978px' ) ) {
		if ( $layout_meta == 'no_sidebar_full_width' ) {
			$content_width = 978; /* pixels */
		} else {
			$content_width = 642; /* pixels */
		}
	} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
		$content_width = 1218; /* pixels */
	} else {
		$content_width = 750; /* pixels */
	}
}

add_action( 'template_redirect', 'elmispase_content_width' );

/**
 * All setup functionalities.
 *
 * @since 1.0
 */
if ( ! function_exists( 'elmispase_setup' ) ) :
	function elmispase_setup() {

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
		add_theme_support( 'post-thumbnails' );

		// Supporting title tag via add_theme_support (since WordPress 4.1)
		add_theme_support( 'title-tag' );

		// Adds the support for the Custom Logo introduced in WordPress 4.5
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 100,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Registering navigation menus.
		register_nav_menus(
			array(
				'header'  => esc_html__( 'Header Menu', 'elmispase' ),
				'primary' => esc_html__( 'Primary Menu', 'elmispase' ),
				'footer'  => esc_html__( 'Footer Menu', 'elmispase' ),
			)
		);

		// Cropping the images to different sizes to be used in the theme
		add_image_size( 'featured-blog-large', 750, 350, true );
		add_image_size( 'featured-blog-medium', 270, 270, true );
		add_image_size( 'featured', 642, 300, true );
		add_image_size( 'featured-blog-medium-small', 230, 230, true );

		// Setup the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'elmispase_custom_background_args',
				array(
					'default-color' => 'eaeaea',
				)
			)
		);

		// Adding excerpt option box for pages as well
		add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Support for selective refresh widgets in Customizer
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Gutenberg wide layout support.
		add_theme_support( 'align-wide' );

		// Gutenberg block styles support.
		add_theme_support( 'wp-block-styles' );

		// Gutenberg responsive embeds support.
		add_theme_support( 'responsive-embeds' );

		// Define and register starter content to showcase the theme on new sites.
		$starter_content = array(
			'widgets'     => array(
				// Add the search widget to the header sidebar.
				'elmispase_header_sidebar'       => array(
					'header_search' => array(
						'search',
						array(
							'title' => '',
						),
					),
				),

				// Add text widgets to the contact sidebar.
				'elmispase_contact_page_sidebar' => array(
					'text_business_info',
					'text_about',
				),

				// Add text widget and cta widget in the Business Top sidebar.
				'elmispase_business_page_top_section_sidebar' => array(
					'text_top_sidebar_info' => array(
						'text',
						array(
							'title' => esc_html__( 'Business Top Sidebar', 'elmispase' ),
							'text'  => esc_html__( 'Shows widgets on Business Page Template Top Section.', 'elmispase' ) . ' ' . __( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Widget', 'elmispase' ) .
									   '<ul>
											<li>' . '<strong>' . esc_html__( 'TG: Services', 'elmispase' ) . '</strong>' . ' - ' . esc_html__( 'Display some pages as services. Best for Business Top or Bottom sidebar.', 'elmispase' ) . '</li>
											<li>' . '<strong>' . esc_html__( 'TG: Call To Action Widget', 'elmispase' ) . '</strong>' . ' - ' . esc_html__( 'Use this widget to show the call to action section.', 'elmispase' ) . '</li>
											<li>' . '<strong>' . esc_html__( 'TG: Featured Widget', 'elmispase' ) . '</strong>' . ' - ' . esc_html__( 'Show your some pages as recent work. Best for Business Top or Bottom sidebar.', 'elmispase' ) . '</li>
					                    </ul>',
						),
					),
					'call_to_action'        => array(
						'elmispase_call_to_action_widget',
						array(
							'text_main'       => esc_html__( 'Call to Action Main Text', 'elmispase' ),
							'text_additional' => esc_html__( 'Call to Action Additional Text', 'elmispase' ),
							'button_text'     => esc_html__( 'Theme Info', 'elmispase' ),
							'button_url'      => 'https://themegrill.com/themes/elmispase/',
						),
					),
				),

				// Add text widget and featured single page widget in the Business Middle Left Sidebar.
				'elmispase_business_page_middle_section_left_half_sidebar' => array(
					'text_middle_left_sidebar_info' => array(
						'text',
						array(
							'title' => esc_html__( 'Business Middle Left Sidebar', 'elmispase' ),
							'text'  => esc_html__( 'Shows widgets on Business Page Template Middle Section Left Half.', 'elmispase' ) . ' ' . esc_html__( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'elmispase' ),
						),
					),
					'featured_single_page'          => array(
						'elmispase_featured_single_page_widget',
						array(
							'page_id' => '02',
						),
					),
				),

				// Add text widget and testimonial widget in the Business Middle Right Sidebar.
				'elmispase_business_page_middle_section_right_half_sidebar' => array(
					'text_middle_right_sidebar_info' => array(
						'text',
						array(
							'title' => esc_html__( 'Business Middle Right Sidebar', 'elmispase' ),
							'text'  => esc_html__( 'Shows widgets on Business Page Template Middle Section Right Half.', 'elmispase' ) . ' ' . esc_html__( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'elmispase' ),
						),
					),
					'testimonial'                    => array(
						'elmispase_testimonial_widget',
						array(
							'title'  => esc_html__( 'TG: Testimonial', 'elmispase' ),
							'text'   => 'Chocolate bar caramels fruitcake icing. Jujubes gingerbread marzipan applicake sweet lemon drops. Marshmallow cupcake bear claw oat cake candy marzipan. Cookie soufflé bear claw. ',
							'name'   => 'Mr. Bipin Singh',
							'byline' => 'CEO',
						),
					),
				),

				// Add text widget in the Business Bottom Sidebar.
				'elmispase_business_page_bottom_section_sidebar' => array(
					'text_bottom_sidebar_info' => array(
						'text',
						array(
							'title' => esc_html__( 'Business Bottom Sidebar', 'elmispase' ),
							'text'  => esc_html__( 'Shows widgets on Business Page Template Bottom Section.', 'elmispase' ) . ' ' . __( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Widget', 'elmispase' ) .
									   '<ul>
											<li>' . '<strong>' . esc_html__( 'TG: Services', 'elmispase' ) . '</strong>' . ' - ' . esc_html__( 'Display some pages as services. Best for Business Top or Bottom sidebar.', 'elmispase' ) . '</li>
											<li>' . '<strong>' . esc_html__( 'TG: Call To Action Widget', 'elmispase' ) . '</strong>' . ' - ' . esc_html__( 'Use this widget to show the call to action section.', 'elmispase' ) . '</li>
											<li>' . '<strong>' . esc_html__( 'TG: Featured Widget', 'elmispase' ) . '</strong>' . ' - ' . esc_html__( 'Show your some pages as recent work. Best for Business Top or Bottom sidebar.', 'elmispase' ) . '</li>
										</ul>',
						),
					),
				),

				// Add the text widget in the footer siderbar 1.
				'elmispase_footer_sidebar_one'   => array(
					'text_business_info',
				),

				// Add search widget and text widget in the footer siderbar 2.
				'elmispase_footer_sidebar_two'   => array(
					'search',
					'text_about',
				),

				// Add the text widget in the footer siderbar 3.
				'elmispase_footer_sidebar_three' => array(
					'text_custom_menu' => array(
						'text',
						array(
							'title' => esc_html__( 'Elmispase Important Links', 'elmispase' ),
							'text'  => '<ul>
											<li><a href="https://themegrill.com/themes/elmispase/">' . esc_html__( 'Theme Info', 'elmispase' ) . '</a></li>
											<li><a href="https://themegrilldemos.com/elmispase/">' . esc_html__( 'View Demo', 'elmispase' ) . '</a></li>
											<li><a href="https://www.youtube.com/watch?v=rhiybsv3vUU">' . esc_html__( 'Import Demo', 'elmispase' ) . '</a></li>
											<li><a href="https://docs.themegrill.com/elmispase/">' . esc_html__( 'Documentation', 'elmispase' ) . '</a></li>
											<li><a href="https://wordpress.org/support/theme/elmispase/">' . esc_html__( 'Support Forum', 'elmispase' ) . '</a></li>
										</ul>',
						),
					),
				),

				// Add the featured single page widget in the footer siderbar 4.
				'elmispase_footer_sidebar_four'  => array(
					'featured_single_page' => array(
						'elmispase_featured_single_page_widget',
						array(
							'page_id' => '02',
						),
					),
				),
			),

			// Specify the core-defined pages to create.
			'posts'       => array(
				'home'    => array(
					'template' => 'page-templates/business.php',
				),
				'about',
				'blog',
				'contact' => array(
					'template' => 'page-templates/contact.php',
				),
			),

			// Create the custom image attachments for site logo.
			'attachments' => array(
				'image-logo' => array(
					'post_title' => 'elmispase logo image',
					'file'       => 'images/elmispase-logo.png', // URL relative to the template directory.
				),
			),

			// Default to a static front page and assign the front and posts pages.
			'options'     => array(
				'show_on_front'  => 'page',
				'page_on_front'  => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),

			// Setting theme mods of slider settings.
			'theme_mods'  => array(
				'custom_logo'                              => '{{image-logo}}',
				'elmispase[elmispase_show_header_logo_text]' => 'both',
				'elmispase[elmispase_activate_slider]'       => '1',
				'elmispase[elmispase_blog_slider]'           => '1',
				'elmispase[elmispase_slider_image1]'         => get_template_directory_uri() . '/images/book.jpg',
				'elmispase[elmispase_slider_title1]'         => esc_html__( 'Enter title for your slider.', 'elmispase' ),
				'elmispase[elmispase_slider_text1]'          => 'Chocolate bar caramels fruitcake icing. Jujubes gingerbread marzipan applicake sweet lemon drops. Marshmallow cupcake bear claw oat cake candy marzipan. Cookie soufflé bear claw.',
				'elmispase[elmispase_slider_button_text1]'   => esc_html__( 'Read more', 'elmispase' ),
				'elmispase[elmispase_slider_link1]'          => '#',
				'elmispase[elmispase_slider_image2]'         => get_template_directory_uri() . '/images/chess.jpg',
				'elmispase[elmispase_slider_title2]'         => esc_html__( 'Enter title for your slider.', 'elmispase' ),
				'elmispase[elmispase_slider_text2]'          => 'Chocolate bar caramels fruitcake icing. Jujubes gingerbread marzipan applicake sweet lemon drops. Marshmallow cupcake bear claw oat cake candy marzipan. Cookie soufflé bear claw.',
				'elmispase[elmispase_slider_button_text2]'   => esc_html__( 'Read more', 'elmispase' ),
				'elmispase[elmispase_slider_link2]'          => '#',
			),

			// Set up nav menus for each of the two areas registered in the theme.
			'nav_menus'   => array(
				// Assign a menu to the "primary" location.
				'primary' => array(
					'name'  => esc_html__( 'Primary Menu', 'elmispase' ),
					'items' => array(
						'link_home',
						// Note that the core "home" page is actually a link in case a static front page is not used.
						'page_about',
						'page_blog',
						'page_contact',
					),
				),

				// Assign a menu to the "footer" location.
				'footer'  => array(
					'name'  => esc_html__( 'Footer Menu', 'elmispase' ),
					'items' => array(
						'page_about',
						'page_blog',
						'page_contact',
					),
				),
			),
		);

		$starter_content = apply_filters( 'elmispase_starter_content', $starter_content );

		add_theme_support( 'starter-content', $starter_content );
	}
endif;
add_action( 'after_setup_theme', 'elmispase_setup' );

function elmispase_load_textdomain() {
	load_theme_textdomain( 'elmispase', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'elmispase_load_textdomain', 20 );

// Theme version.
$elmispase_theme = wp_get_theme( 'elmispase' );
define( 'ELMISPASE_THEME_VERSION', $elmispase_theme->get( 'Version' ) );

/**
 * Define Directory Location Constants
 */
define( 'ELMISPASE_PARENT_DIR', get_template_directory() );
define( 'ELMISPASE_CHILD_DIR', get_stylesheet_directory() );

define( 'ELMISPASE_INCLUDES_DIR', ELMISPASE_PARENT_DIR . '/inc' );
define( 'ELMISPASE_CSS_DIR', ELMISPASE_PARENT_DIR . '/css' );
define( 'ELMISPASE_JS_DIR', ELMISPASE_PARENT_DIR . '/js' );
define( 'ELMISPASE_LANGUAGES_DIR', ELMISPASE_PARENT_DIR . '/languages' );

define( 'ELMISPASE_ADMIN_DIR', ELMISPASE_INCLUDES_DIR . '/admin' );
define( 'ELMISPASE_WIDGETS_DIR', ELMISPASE_INCLUDES_DIR . '/widgets' );
define( 'ELMISPASE_ELEMENTOR_DIR', ELMISPASE_INCLUDES_DIR . '/elementor' );

define( 'ELMISPASE_ADMIN_IMAGES_DIR', ELMISPASE_ADMIN_DIR . '/images' );
define( 'ELMISPASE_ADMIN_CSS_DIR', ELMISPASE_ADMIN_DIR . '/css' );


/**
 * Define URL Location Constants
 */
define( 'ELMISPASE_PARENT_URL', get_template_directory_uri() );
define( 'ELMISPASE_CHILD_URL', get_stylesheet_directory_uri() );

define( 'ELMISPASE_INCLUDES_URL', ELMISPASE_PARENT_URL . '/inc' );
define( 'ELMISPASE_CSS_URL', ELMISPASE_PARENT_URL . '/css' );
define( 'ELMISPASE_JS_URL', ELMISPASE_PARENT_URL . '/js' );
define( 'ELMISPASE_LANGUAGES_URL', ELMISPASE_PARENT_URL . '/languages' );

define( 'ELMISPASE_ADMIN_URL', ELMISPASE_INCLUDES_URL . '/admin' );
define( 'ELMISPASE_WIDGETS_URL', ELMISPASE_INCLUDES_URL . '/widgets' );

define( 'ELMISPASE_ADMIN_IMAGES_URL', ELMISPASE_ADMIN_URL . '/images' );
define( 'ELMISPASE_ADMIN_CSS_URL', ELMISPASE_ADMIN_URL . '/css' );

/** Load functions */
require_once ELMISPASE_INCLUDES_DIR . '/custom-header.php';
require_once ELMISPASE_INCLUDES_DIR . '/functions.php';
require_once ELMISPASE_INCLUDES_DIR . '/header-functions.php';
require_once ELMISPASE_INCLUDES_DIR . '/customizer/class-elmispase-customizer.php';
require_once ELMISPASE_INCLUDES_DIR . '/customizer/class-elmispase-customizer-partials.php';

add_action('init', function (){
	require_once ELMISPASE_ADMIN_DIR . '/meta-boxes.php';
});
require_once ELMISPASE_INCLUDES_DIR . '/enqueue-scripts.php';
require_once ELMISPASE_INCLUDES_DIR . '/class-elmispase-dynamic-css.php';
require_once ELMISPASE_INCLUDES_DIR . '/migration.php';

/** Load demo import migration scripts. */
require_once ELMISPASE_INCLUDES_DIR . '/demo-import-migration.php';


/** Load Widgets and Widgetized Area */
require_once ELMISPASE_WIDGETS_DIR . '/widgets.php';

define( 'ELMISPASE_CUSTOMIZER_DIR', ELMISPASE_INCLUDES_DIR . '/customizer' );

/**
 * Detect plugin. For use on Front End only.
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 * Assign the Elmispase version to a variable.
 */
$theme            = wp_get_theme( 'elmispase' );
$elmispase_version = $theme['Version'];

/**
 * Calling in the admin area for the Welcome Page as well as for the new theme notice too.
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-elmispase-admin.php';
	require get_template_directory() . '/inc/admin/class-elmispase-dashboard.php';
	require get_template_directory() . '/inc/admin/class-elmispase-theme-review-notice.php';
	require get_template_directory() . '/inc/admin/class-elmispase-tdi-notice.php';
	require get_template_directory() . '/inc/admin/class-elmispase-welcome-notice.php';
	require get_template_directory() . '/inc/admin/class-elmispase-notice.php';
	require get_template_directory() . '/inc/admin/class-elmispase-upgrade-notice.php';
}

/**
 * Load the Elmispase Toolkit file.
 */
if ( class_exists( 'Elmispase_Toolkit' ) ) {
	require_once ELMISPASE_INCLUDES_DIR . '/elmispase-toolkit.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once get_template_directory() . '/inc/jetpack.php';
}

/** Add the Elementor compatibility file */
if ( defined( 'ELEMENTOR_VERSION' ) ) {
	require_once ELMISPASE_INCLUDES_DIR . '/elementor/elementor.php';
}

/**
 * Load deprecated functions.
 */
require get_template_directory() . '/inc/deprecated/deprecated-functions.php';
