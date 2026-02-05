<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package 		ThemeGrill
 * @subpackage 		Elmispase
 * @since 			Elmispase 1.0
 */

/****************************************************************************************/

add_filter( 'wp_title', 'elmispase_filter_wp_title' );
if ( ! function_exists( 'elmispase_filter_wp_title' ) ) :
/**
 * Modifying the Title
 *
 * Function tied to the wp_title filter hook.
 * @uses filter wp_title
 */
function elmispase_filter_wp_title( $title ) {
	global $page, $paged;
	
	// Get the Site Name
   $site_name = get_bloginfo( 'name' );

   // Get the Site Description
   $site_description = get_bloginfo( 'description' );

   $filtered_title = ''; 

	// For Homepage or Frontpage
   if(  is_home() || is_front_page() ) {		
		$filtered_title .= $site_name;	
		if ( !empty( $site_description ) )  {
        	$filtered_title .= ' &#124; '. $site_description;
		}
   }
	elseif( is_feed() ) {
		$filtered_title = '';
	}
	else{	
		$filtered_title = $title . $site_name;
	}

	// Add a page number if necessary:
	if( $paged >= 2 || $page >= 2 ) {
		$filtered_title .= ' &#124; ' . sprintf( __( 'Page %s', 'elmispase' ), max( $paged, $page ) );
	}
	
	// Return the modified title
   return $filtered_title;
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'elmispase_render_header_image' ) ) :
/**
 * Shows the small info text on top header part
 */
function elmispase_render_header_image() {
	$header_image = get_header_image();
	if( !empty( $header_image ) ) {
	?>
		<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
	<?php
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
				for( $i = 1; $i <= 5; $i++ ) {
					$elmispase_slider_title = of_get_option( 'elmispase_slider_title'.$i , '' );
					$elmispase_slider_text = of_get_option( 'elmispase_slider_text'.$i , '' );
					$elmispase_slider_image = of_get_option( 'elmispase_slider_image'.$i , '' );
					$elmispase_slider_link = of_get_option( 'elmispase_slider_link'.$i , '#' );
					if( !empty( $elmispase_header_title ) || !empty( $elmispase_slider_text ) || !empty( $elmispase_slider_image ) ) {
						if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }
						?>
						<div class="<?php echo $classes; ?>">
							<figure>
								<img alt="<?php echo esc_attr( $elmispase_slider_title ); ?>" src="<?php echo esc_url( $elmispase_slider_image ); ?>">
							</figure>
							<div class="entry-container">
								<?php if( !empty( $elmispase_slider_title ) || !empty( $elmispase_slider_text ) ) { ?>
								<div class="entry-description-container">
									<?php if( !empty( $elmispase_slider_title ) ) { ?>
									<div class="slider-title-head"><h3 class="entry-title"><a href="<?php echo esc_url( $elmispase_slider_link ); ?>" title="<?php echo esc_attr( $elmispase_slider_title ); ?>"><span><?php echo $elmispase_slider_title; ?></span></a></h3></div>
									<?php
									}
									if( !empty( $elmispase_slider_text ) ) {
										?>
									<div class="entry-content"><p><?php echo $elmispase_slider_text; ?></p></div>
									<?php 
									}
									?>
								</div>
								<?php } ?>
								<div class="clearfix"></div>
								<a class="slider-read-more-button" href="<?php echo esc_url( $elmispase_slider_link ); ?>" title="<?php echo esc_attr( $elmispase_slider_title ); ?>"><?php _e( 'Read more', 'elmispase' ); ?></a>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
			<nav id="controllers" class="clearfix"></nav>
		</section>

		<?php
}
endif;



if ( ! function_exists( 'elmispase_header_title' ) ) :
/**
 * Show the title in header
 */
function elmispase_header_title() {
	if( is_archive() ) {
		if ( is_category() ) :
			$elmispase_header_title = single_cat_title( '', FALSE );

		elseif ( is_tag() ) :
			$elmispase_header_title = single_tag_title( '', FALSE );

		elseif ( is_author() ) :
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			$elmispase_header_title =  sprintf( __( 'Author: %s', 'elmispase' ), '<span class="vcard">' . get_the_author() . '</span>' );
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
			$elmispase_header_title = __( 'Images', 'elmispase');

		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			$elmispase_header_title = __( 'Videos', 'elmispase' );

		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			$elmispase_header_title = __( 'Quotes', 'elmispase' );

		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			$elmispase_header_title = __( 'Links', 'elmispase' );

		else :
			$elmispase_header_title = __( 'Archives', 'elmispase' );

		endif;
	}
	elseif( is_404() ) {
		$elmispase_header_title = __( 'Page NOT Found', 'elmispase' );
	}
	elseif( is_search() ) {
		$elmispase_header_title = __( 'Search Results', 'elmispase' );
	}
	elseif( is_page()  ) {
		$elmispase_header_title = get_the_title();
	}
	elseif( is_single()  ) {
		$elmispase_header_title = get_the_title();
	}
	else {
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
	if( function_exists( 'bcn_display' ) ) {
		echo '<div class="breadcrumb">'; 
		echo '<span class="breadcrumb-title">'.__( 'You are here:', 'elmispase' ).'</span>';           
		bcn_display();               
		echo '</div> <!-- .breadcrumb -->'; 
	}   
}
endif;

?>