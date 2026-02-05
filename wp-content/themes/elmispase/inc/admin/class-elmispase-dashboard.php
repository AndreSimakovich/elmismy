<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Elmispase_Dashboard {
	private static $instance;

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_action( 'admin_menu', array( $this, 'create_menu' ) );
	}

	public function create_menu() {
		if ( is_child_theme() ) {
			$theme = wp_get_theme()->parent();
		} else {
			$theme = wp_get_theme();
		}

		/* translators: %s: Theme Name. */
		$theme_page_name = sprintf( esc_html__( '%s Options', 'elmispase' ), $theme->Name );

		$page = add_theme_page(
			$theme_page_name,
			$theme_page_name,
			'edit_theme_options',
			'elmispase-options',
			array(
				$this,
				'option_page',
			)
		);

	}

	public function option_page() {
		if ( is_child_theme() ) {
			$theme = wp_get_theme()->parent();
		} else {
			$theme = wp_get_theme();
		}

		?>
		<div class="wrap">
		<div class="elmispase-header">
			<h1>
				<?php
				/* translators: %s: Theme version. */
				echo sprintf( esc_html__( 'Elmispase %s', 'elmispase' ), $theme->Version );
				?>
			</h1>
		</div>
		<div class="welcome-panel">
			<div class="welcome-panel-content">
				<h2>
					<?php
					/* translators: %s: Theme Name. */
					echo sprintf( esc_html__( 'Welcome to %s!', 'elmispase' ), $theme->Name );
					?>
				</h2>
				<p class="about-description">
					<?php
					/* translators: %s: Theme Name. */
					echo sprintf( esc_html__( 'Important links to get you started with %s', 'elmispase' ), $theme->Name );
					?>
				</p>

				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Get Started', 'elmispase' ); ?></h3>
						<a class="button button-primary button-hero"
						   href="<?php echo esc_url( 'https://docs.themegrill.com/elmispase/#section-1' ); ?>"
						   target="_blank"><?php esc_html_e( 'Learn Basics', 'elmispase' ); ?>
						</a>
					</div>

					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Next Steps', 'elmispase' ); ?></h3>
						<ul>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-media-text">' . esc_html__( 'Documentation', 'elmispase' ) . '</a>', esc_url( 'https://docs.themegrill.com/elmispase' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-layout">' . esc_html__( 'Starter Demos', 'elmispase' ) . '</a>', esc_url( 'https://themegrilldemos.com/elmispase-demos/' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-migrate">' . esc_html__( 'Premium Version', 'elmispase' ) . '</a>', esc_url( 'https://themegrill.com/themes/elmispase' ) ); ?></li>
						</ul>
					</div>

					<div class="welcome-panel-column">
						<h3><?php esc_html_e( 'Further Actions', 'elmispase' ); ?></h3>
						<ul>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-businesswoman">' . esc_html__( 'Got theme support question?', 'elmispase' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/elmispase/' ) ); ?></li>
							<li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-thumbs-up">' . esc_html__( 'Leave a review', 'elmispase' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/elmispase/reviews/' ) ); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

Elmispase_Dashboard::instance();
