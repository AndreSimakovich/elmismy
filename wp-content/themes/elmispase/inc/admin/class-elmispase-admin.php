<?php
/**
 * elmispase Admin Class.
 *
 * @author  Elmis
 * @package elmispase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'elmispase_Admin' ) ) :

	/**
	 * elmispase_Admin Class.
	 */
	class elmispase_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'elmispase-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), ELMISPASE_THEME_VERSION );

			wp_enqueue_script( 'elmispase-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), ELMISPASE_THEME_VERSION, true );

			// Only expose the nonce and AJAX functionality to users with appropriate capabilities
			$welcome_data = array(
				'uri'       => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&elmispase-hide-notice=welcome' ) ),
				'btn_text'  => esc_html__( 'Processing...', 'elmispase' ),
				'admin_url' => esc_url( admin_url() ),
			);

			// Only add nonce and ajaxurl if user has appropriate capabilities
			if ( current_user_can( 'manage_options' ) ) {
				$welcome_data['nonce']   = wp_create_nonce( 'elmispase_demo_import_nonce' );
				$welcome_data['ajaxurl'] = admin_url( 'admin-ajax.php' );
			}

			wp_localize_script( 'elmispase-plugin-install-helper', 'elmispaseRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new elmispase_Admin();
