<?php 
/**
 * Theme Header Section for our theme.
 * 
 * @package ThemeGrill
 * @subpackage Elmispase
 * @since Elmispase 1.0
 */
?>
<?php 
// Создаем безопасную функцию-заглушку, если плагин Options Framework не активен
if ( ! function_exists( 'of_get_option' ) ) {
    function of_get_option( $name, $default = false ) {
        return $default;
    }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
<?php do_action( 'before' ); ?>
<div id="page" class="hfeed site">
	<?php do_action( 'elmispase_before_header' ); ?>
	<header id="masthead" class="site-header clearfix">
		
		<?php if( of_get_option( 'elmispase_header_image_position', 'above' ) == 'above' ) { elmispase_render_header_image(); } ?>

		<div id="header-text-nav-container">
			<div class="inner-wrap">
				
				<div id="header-text-nav-wrap" class="clearfix">
					<div id="header-left-section">
						<?php 
						// Вывод логотипа (используем стандартный метод WP, если настроили поддержку)
						if ( has_custom_logo() ) {
							the_custom_logo();
						} elseif ( of_get_option( 'elmispase_header_logo_image', '' ) != '' ) {
							?>
							<div id="header-logo-image">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<img src="<?php echo of_get_option( 'elmispase_header_logo_image' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
								</a>
							</div>
							<?php
						}

						if( of_get_option( 'elmispase_show_header_logo_text', 'text_only' ) !== 'logo_only' ) {
						?>
						<div id="header-text">
							<h1 id="site-title"> 
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
							<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
						</div>
						<?php
						}
						?>
					</div><!-- #header-left-section -->

					<div id="header-right-section">
						<?php if( is_active_sidebar( 'elmispase_header_sidebar' ) ) : ?>	
							<div id="header-right-sidebar" class="clearfix">
								<?php dynamic_sidebar( 'elmispase_header_sidebar' ); ?>		
							</div>
						<?php endif; ?>

						<nav id="site-navigation" class="main-navigation" role="navigation">
							<h1 class="menu-toggle"><?php _e( 'Menu', 'elmispase' ); ?></h1>
							<?php
								if ( has_nav_menu( 'primary' ) ) {									
									wp_nav_menu( array( 'theme_location' => 'primary' ) );
								} else {
									wp_page_menu();
								}
							?>
						</nav>					
			    	</div><!-- #header-right-section --> 
			    	
			   </div><!-- #header-text-nav-wrap -->
			</div><!-- .inner-wrap -->
		</div><!-- #header-text-nav-container -->

		<?php if( of_get_option( 'elmispase_header_image_position', 'above' ) == 'below' ) { elmispase_render_header_image(); } ?>

		<?php
		if( of_get_option( 'elmispase_activate_slider', '0' ) == '1' && ( is_home() || is_front_page() ) ) {
   			elmispase_featured_image_slider();
		}

		if( ( '' != elmispase_header_title() ) && !( is_home() || is_front_page() ) ) {
		?>
		<div class="header-post-title-container clearfix">
			<div class="inner-wrap">
				<div class="post-title-wrapper">
					<h1 class="header-post-title-class"><?php echo elmispase_header_title(); ?></h1>
				</div>
				<?php if( function_exists( 'elmispase_breadcrumb' ) ) { elmispase_breadcrumb(); } ?>
			</div>
		</div>
		<?php } ?>
	</header>
	<?php do_action( 'elmispase_after_header' ); ?>
	<?php do_action( 'elmispase_before_main' ); ?>
	<div id="main" class="clearfix">
		<div class="inner-wrap">