<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package           ThemeGrill
 * @subpackage        Elmispase
 * @since             Elmispase 1.0
 */

if ( ! function_exists( 'elmispase_social_links' ) ) :

	/**
	 * This function is for social links display on header
	 *
	 * Get links through Theme Options
	 */
	function elmispase_social_links() {

		$elmispase_social_links = array(
			'elmispase_social_facebook'  => 'Facebook',
			'elmispase_social_twitter'   => 'Twitter',
			'elmispase_social_instagram' => 'Instagram',
			'elmispase_social_linkedin'  => 'LinkedIn',
		);
		?>

		<div class="social-links clearfix">
			<ul>
				<?php
				$elmispase_links_output = '';

				foreach ( $elmispase_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );
					if ( ! empty( $link ) ) {
						if ( get_theme_mod( $key . 'new_tab', '0' ) == '1' ) {
							$new_tab = 'target="_blank"';
						} else {
							$new_tab = '';
						}

						$elmispase_links_output .= '<li class="elmispase-' . strtolower( $value ) . '"><a href="' . esc_url( $link ) . '" ' . $new_tab . '></a></li>';
					}
				}

				echo $elmispase_links_output;
				?>
			</ul>
		</div><!-- .social-links -->
		<?php
	}

endif;


if ( ! function_exists( 'elmispase_header_info_text' ) ) :

	/**
	 * Shows the small info text on top header part
	 */
	function elmispase_header_info_text() {
		if ( get_theme_mod( 'elmispase_header_info_text', '' ) == '' ) {
			return;
		}

		$elmispase_header_info_text = get_theme_mod( 'elmispase_header_info_text', '' );

		echo do_shortcode( $elmispase_header_info_text );
	}

endif;

/*	 * ************************************* WooCommerce cart icon ************************************** */
if ( ! function_exists( 'elmispase_cart_icon' ) ) :

	/**
	 * Display cart icon on menu bar.
	 *
	 * show cart icon if activated from customizer
	 */
	function elmispase_cart_icon() {
		if ( ( get_theme_mod( 'elmispase_cart_icon', 0 ) == 1 ) && class_exists( 'woocommerce' ) ) :
			?>
			<div class="cart-wrapper">
				<div class="elmispase-woocommerce-cart-views">

					<!-- Show cart icon with total cart item -->
					<?php $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url(); ?>

					<a href="<?php echo esc_url( $cart_url ); ?>" class="wcmenucart-contents">
						<i class="fa fa-shopping-cart"></i>
						<span class="cart-value"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
					</a>

					<!-- Show total cart price -->
					<div class="elmispase-woocommerce-cart-wrap">
						<div class="elmispase-woocommerce-cart"><?php esc_html_e( 'Total', 'elmispase' ); ?></div>
						<div class="cart-total"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div>
					</div>
				</div>

				<!-- WooCommerce Cart Widget -->
				<?php the_widget( 'WC_Widget_Cart', '' ); ?>

			</div> <!-- /.cart-wrapper -->
		<?php
		endif;
	}

endif;

/****************************************************************************************/
// Filter the get_header_image_tag() for supporting the older way of displaying the header image
function elmispase_header_image_markup( $html, $header, $attr ) {
	$output       = '';
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		$output .= '<img src="' . esc_url( $header_image ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';
	}

	return $output;
}

function elmispase_header_image_markup_filter() {
	add_filter( 'get_header_image_tag', 'elmispase_header_image_markup', 10, 3 );
}

add_action( 'elmispase_header_image_markup_render', 'elmispase_header_image_markup_filter' );

/****************************************************************************************/

if ( ! function_exists( 'elmispase_render_header_image' ) ) :
	/**
	 * Shows the small info text on top header part
	 */
	function elmispase_render_header_image() {
		if ( function_exists( 'the_custom_header_markup' ) ) {
			do_action( 'elmispase_header_image_markup_render' );
			the_custom_header_markup();
		} else {
			$header_image = get_header_image();
			if ( ! empty( $header_image ) ) { ?>
				<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				<?php
			}
		}
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'elmispase_featured_image_slider' ) ) :
	/**
	 * display featured post slider
	 */
	function elmispase_featured_image_slider() {
		global $post;
		?>
		<section id="featured-slider">
			<div class="slider-cycle">
				<?php
				for ( $i = 1; $i <= 5; $i++ ) {
					$elmispase_slider_title       = get_theme_mod( 'elmispase_slider_title' . $i, '' );
					$elmispase_slider_text        = get_theme_mod( 'elmispase_slider_text' . $i, '' );
					$elmispase_slider_image       = get_theme_mod( 'elmispase_slider_image' . $i, '' );
					$elmispase_slider_button_text = get_theme_mod( 'elmispase_slider_button_text' . $i, __( 'Read more', 'elmispase' ) );
					$elmispase_slider_link        = get_theme_mod( 'elmispase_slider_link' . $i, '#' );
					$attachment_post_id          = attachment_url_to_postid( $elmispase_slider_image );
					$image_attributes            = wp_get_attachment_image_src( $attachment_post_id, 'full' );
					if ( ! empty( $elmispase_header_title ) || ! empty( $elmispase_slider_text ) || ! empty( $elmispase_slider_image ) ) {
						if ( $i == 1 ) {
							$classes = "slides displayblock";
						} else {
							$classes = "slides displaynone";
						}
						?>
						<div class="<?php echo $classes; ?>">
							<figure>
								<?php $img_altr = get_post_meta( $attachment_post_id, '_wp_attachment_image_alt', true );
								$img_alt        = ! empty( $img_altr ) ? $img_altr : $elmispase_slider_title; ?>

								<?php if ( ! empty ( $image_attributes ) ) { ?>
									<img width="<?php echo esc_attr( $image_attributes[1] ); ?>" height="<?php echo esc_attr( $image_attributes[2] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" src="<?php echo esc_url( $elmispase_slider_image ); ?>">
								<?php } else { ?>
									<img alt="<?php echo esc_attr( $img_alt ); ?>" src="<?php echo esc_url( $elmispase_slider_image ); ?>">
								<?php } ?>

							</figure>
							<div class="entry-container">
								<?php if ( ! empty( $elmispase_slider_title ) || ! empty( $elmispase_slider_text ) ) { ?>
									<div class="entry-description-container">
										<?php if ( ! empty( $elmispase_slider_title ) ) { ?>
											<div class="slider-title-head"><h3 class="entry-title">
													<a href="<?php echo esc_url( $elmispase_slider_link ); ?>" title="<?php echo esc_attr( $elmispase_slider_title ); ?>"><span><?php echo esc_html( $elmispase_slider_title ); ?></span></a>
												</h3></div>
											<?php
										}
										if ( ! empty( $elmispase_slider_text ) ) {
											?>
											<div class="entry-content">
												<p><?php echo esc_textarea( $elmispase_slider_text ); ?></p></div>
											<?php
										}
										?>
									</div>
								<?php } ?>
								<div class="clearfix"></div>
								<?php if ( ! empty( $elmispase_slider_button_text ) ) { ?>
									<a class="slider-read-more-button" href="<?php echo esc_url( $elmispase_slider_link ); ?>" title="<?php echo esc_attr( $elmispase_slider_title ); ?>"><?php echo esc_html( $elmispase_slider_button_text ); ?></a>
								<?php } ?>
							</div>
						</div>
						<?php
					}
				}
				?>
				<nav id="controllers" class="clearfix"></nav>
			</div>
		</section>

		<?php
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'elmispase_header_title' ) ) :
	/**
	 * Show the title in header
	 */
	function elmispase_header_title() {
		if ( is_archive() ) {
			if ( is_category() ) :
				$elmispase_header_title = single_cat_title( '', false );

			elseif ( is_tag() ) :
				$elmispase_header_title = single_tag_title( '', false );

			elseif ( is_author() ) :
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				$elmispase_header_title = sprintf( __( 'Author: %s', 'elmispase' ), '<span class="vcard">' . get_the_author() . '</span>' );
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :
				$elmispase_header_title = sprintf( __( 'Day: %s', 'elmispase' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				$elmispase_header_title = sprintf( __( 'Month: %s', 'elmispase' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				$elmispase_header_title = sprintf( __( 'Year: %s', 'elmispase' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
				$elmispase_header_title = __( 'Asides', 'elmispase' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
				$elmispase_header_title = __( 'Images', 'elmispase' );

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
				$elmispase_header_title = __( 'Videos', 'elmispase' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
				$elmispase_header_title = __( 'Quotes', 'elmispase' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
				$elmispase_header_title = __( 'Links', 'elmispase' );

			elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) && function_exists( 'is_woocommerce' ) && is_woocommerce() ) :
				$elmispase_header_title = woocommerce_page_title( false );

			else :
				$elmispase_header_title = __( 'Archives', 'elmispase' );

			endif;
		} elseif ( is_404() ) {
			$elmispase_header_title = __( 'Page NOT Found', 'elmispase' );
		} elseif ( is_search() ) {
			$elmispase_header_title = __( 'Search Results', 'elmispase' );
		} elseif ( is_page() ) {
			$elmispase_header_title = get_the_title();
		} elseif ( is_single() ) {
			$elmispase_header_title = get_the_title();
		} elseif ( is_home() ) {
			$queried_id            = get_option( 'page_for_posts' );
			$elmispase_header_title = get_the_title( $queried_id );
		} else {
			$elmispase_header_title = '';
		}

		return $elmispase_header_title;

	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'elmispase_breadcrumb' ) ) :
	/**
	 * Display breadcrumb on header.
	 *
	 * If the page is home or front page, slider is displayed.
	 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
	 */
	function elmispase_breadcrumb() {
		if ( function_exists( 'bcn_display' ) ) {
			echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
			echo '<span class="breadcrumb-title">' . __( 'You are here: ', 'elmispase' ) . '</span>';
			bcn_display();
			echo '</div> <!-- .breadcrumb : NavXT -->';

		} elseif ( function_exists( 'yoast_breadcrumb' ) ) { // SEO by Yoast
			yoast_breadcrumb(
				'<div class="breadcrumb">' . '<span class="breadcrumb-title">' . wp_kses_post( get_theme_mod( 'elmispase_custom_breadcrumb_text', __( 'You are here: ', 'elmispase' ) ) ) . '</span>',
				'</div> <!-- .breadcrumb : Yoast -->'
			);
		}
	}
endif;

/*	 * ************************************************************************************* */
if ( ! function_exists( 'elmispase_main_nav' ) ) :
	function elmispase_main_nav() {
		// For header menu button enabled option.
		$class                  = '';
		$responsive_menu_enable = get_theme_mod( 'elmispase_new_menu', '1' );
		$header_button_link_1   = get_theme_mod( 'elmispase_header_button_one_link' );
		if ( $header_button_link_1 ) {
			$class = 'elmispase-header-button-enabled';
		}
		?>

		<nav id="site-navigation" class="main-navigation clearfix  <?php echo esc_attr( $class ); ?> <?php echo esc_attr( get_theme_mod( 'elmispase_one_line_menu_setting' )) ? 'tg-extra-menus' : ''; ?>" role="navigation">
			<p class="menu-toggle">
				<span class="<?php echo esc_attr( $responsive_menu_enable == '1' ? 'screen-reader-text' : '' ); ?>"><?php _e( 'Menu', 'elmispase' ); ?></span>
			</p>
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location'  => 'primary',
					'container_class' => 'menu-primary-container',
				) );
			} else {
				wp_page_menu();
			}
			?>
		</nav>

		<?php
	}
endif;
