<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Elmispase
 * @since Elmispase 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'elmispase_before_post_content' ); ?>
	<div class="entry-content clearfix">
		<?php
		if ( ( get_theme_mod( 'elmispase_featured_image_single_page', 0 ) == 1 ) && has_post_thumbnail() ) {
			$title_attribute = get_the_title( $post->ID );
			$thumb_id        = get_post_thumbnail_id( get_the_ID() );
			$img_altr        = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
			$img_alt         = ! empty( $img_altr ) ? $img_altr : $title_attribute;
			$post_thumbnail_attr = array(
				'alt'   => esc_attr( $img_alt ),
				'title' => esc_attr( $title_attribute ),
			);
			the_post_thumbnail( 'featured-blog-large', $post_thumbnail_attr );
		}
		the_content();
		?>
		<?php
		wp_link_pages( array(
			'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . __( 'Pages:', 'elmispase' ),
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>'
		) );
		?>
	</div>
	<footer class="entry-meta-bar clearfix">
		<div class="entry-meta clearfix">
			<?php edit_post_link( __( 'Edit', 'elmispase' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	</footer>
	<?php
	do_action( 'elmispase_after_post_content' );
	?>
</article>
