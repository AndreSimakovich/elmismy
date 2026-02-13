<?php

	require get_template_directory() . '/inc/homepage-setup/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function maintenance_works_register_recommended_plugins() {
	$plugins = array(	
		array(
			'name'             => __( 'Classic Widgets', 'maintenance-works' ),
			'slug'             => 'classic-widgets',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'maintenance_works_register_recommended_plugins' );