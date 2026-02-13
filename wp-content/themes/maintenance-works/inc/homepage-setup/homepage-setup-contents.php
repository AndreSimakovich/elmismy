<?php
/**
 * Wizard
 *
 * @package Maintenance_Works_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Maintenance_Works_Whizzie {
	
	protected $version = '1.1.0';
	
	/** @var string Current theme name, used as namespace in actions. */
	protected $maintenance_works_theme_name = '';
	protected $maintenance_works_theme_title = '';
	
	/** @var string Wizard page slug and title. */
	protected $maintenance_works_page_slug = '';
	protected $maintenance_works_page_title = '';
	
	/** @var array Wizard steps set by user. */
	protected $config_steps = array();
	
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $maintenance_works_plugin_url = '';

	public $maintenance_works_plugin_path;
	public $parent_slug;
	
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;
	
	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';
	
	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	
	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}
	
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {
	
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['maintenance_works_page_slug'] ) ) {
			$this->maintenance_works_page_slug = esc_attr( $config['maintenance_works_page_slug'] );
		}
		if( isset( $config['maintenance_works_page_title'] ) ) {
			$this->maintenance_works_page_title = esc_attr( $config['maintenance_works_page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}
		
		$this->maintenance_works_plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->maintenance_works_plugin_path );
		$this->maintenance_works_plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$maintenance_works_current_theme = wp_get_theme();
		$this->maintenance_works_theme_title = $maintenance_works_current_theme->get( 'Name' );
		$this->maintenance_works_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $maintenance_works_current_theme->get( 'Name' ) ) );
		$this->maintenance_works_page_slug = apply_filters( $this->maintenance_works_theme_name . '_theme_setup_wizard_maintenance_works_page_slug', $this->maintenance_works_theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->maintenance_works_theme_name . '_theme_setup_wizard_parent_slug', '' );

	}
	
	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */	
	public function init() {
		
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_maintenance_works_setup_widgets', array( $this, 'maintenance_works_setup_widgets' ) );
		
	}
	
	public function enqueue_scripts() {
		wp_enqueue_style( 'maintenance-works-homepage-setup-style', get_template_directory_uri() . '/inc/homepage-setup/assets/css/homepage-setup-style.css');
		wp_register_script( 'maintenance-works-homepage-setup-script', get_template_directory_uri() . '/inc/homepage-setup/assets/js/homepage-setup-script.js', array( 'jquery' ), time() );
		wp_localize_script( 
			'maintenance-works-homepage-setup-script',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'maintenance-works' )
			)
		);
		wp_enqueue_script( 'maintenance-works-homepage-setup-script' );
	}
	
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}
			
	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}
	
	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->maintenance_works_theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->maintenance_works_theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}
	
	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_theme_page( esc_html( $this->maintenance_works_page_title ), esc_html( $this->maintenance_works_page_title ), 'manage_options', $this->maintenance_works_page_slug, array( $this, 'wizard_page' ) );
	}
	
	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() { 
		tgmpa_load_bulk_installer();

		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( esc_html__( 'Failed to find TGM', 'maintenance-works' ) );
		}

		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );
		$method = '';
		$fields = array_keys( $_POST );

		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}

		$maintenance_works_theme = wp_get_theme();
		$maintenance_works_theme_title = $maintenance_works_theme->get( 'Name' );
		$maintenance_works_theme_version = $maintenance_works_theme->get( 'Version' );

		?>
		<div class="wrap">
			<?php
				printf( '<h1>%s %s</h1>', esc_html( $maintenance_works_theme_title ), esc_html( '(Version :- ' . $maintenance_works_theme_version . ')' ) );
			?>
			<div class="homepage-setup">
				<div class="homepage-setup-theme-bundle">
					<div class="homepage-setup-theme-bundle-one">
						<h1><?php echo esc_html__( 'WP Theme Bundle', 'maintenance-works' ); ?></h1>
						<p><?php echo wp_kses_post( 'Get <span>15% OFF</span> on all WordPress themes! Use code <span>"BNDL15OFF"</span> at checkout. Limited time offer!' ); ?></p>
					</div>
					<div class="homepage-setup-theme-bundle-two">
						<p><?php echo wp_kses_post( 'Extra <span>15%</span> OFF' ); ?></p>
					</div>
					<div class="homepage-setup-theme-bundle-three">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/homepage-setup/assets/homepage-setup-images/bundle-banner.png' ); ?>" alt="<?php echo esc_attr__( 'Theme Bundle Image', 'maintenance-works' ); ?>">
					</div>
					<div class="homepage-setup-theme-bundle-four">
						<p><?php echo wp_kses_post( '<span>$2795</span>$69' ); ?></p>
						<a target="_blank" href="<?php echo esc_url( MAINTENANCE_WORK_BUNDLE_BUTTON ); ?>"><?php echo esc_html__( 'SHOP NOW', 'maintenance-works' ); ?> <span class="dashicons dashicons-arrow-right-alt2"></span></a>
					</div>
				</div>
			</div>
			
			<div class="card whizzie-wrap">
				<div class="demo_content_image">
					<div class="demo_content">
						<?php
							$maintenance_works_steps = $this->get_steps();
							echo '<ul class="whizzie-menu">';
							foreach ( $maintenance_works_steps as $maintenance_works_step ) {
								$class = 'step step-' . esc_attr( $maintenance_works_step['id'] );
								echo '<li data-step="' . esc_attr( $maintenance_works_step['id'] ) . '" class="' . esc_attr( $class ) . '">';
								printf( '<h2>%s</h2>', esc_html( $maintenance_works_step['title'] ) );

								$content = call_user_func( array( $this, $maintenance_works_step['view'] ) );
								if ( isset( $content['summary'] ) ) {
									printf(
										'<div class="summary">%s</div>',
										wp_kses_post( $content['summary'] )
									);
								}
								if ( isset( $content['detail'] ) ) {
									printf(
										'<div class="detail">%s</div>',
										wp_kses_post( $content['detail'] )
									);
								}
								if ( isset( $maintenance_works_step['button_text'] ) && $maintenance_works_step['button_text'] ) {
									printf( 
										'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
										esc_attr( $maintenance_works_step['callback'] ),
										esc_attr( $maintenance_works_step['id'] ),
										esc_html( $maintenance_works_step['button_text'] )
									);
								}
								echo '</li>';
							}
							echo '</ul>';
						?>
						
						<ul class="whizzie-nav">
							<?php
							$step_number = 1;	
							foreach ( $maintenance_works_steps as $maintenance_works_step ) {
								echo '<li class="nav-step-' . esc_attr( $maintenance_works_step['id'] ) . '">';
								echo '<span class="step-number">' . esc_html( $step_number ) . '</span>';
								echo '</li>';
								$step_number++;
							}
							?>
							<div class="blank-border"></div>
						</ul>

						<div class="homepage-setup-links">
							<div class="homepage-setup-links buttons">
								<a href="<?php echo esc_url( MAINTENANCE_WORK_LITE_DOCS_PRO ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Free Documentation', 'maintenance-works' ); ?></a>
								<a href="<?php echo esc_url( MAINTENANCE_WORK_BUY_NOW ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Get Premium', 'maintenance-works' ); ?></a>
								<a href="<?php echo esc_url( MAINTENANCE_WORK_DEMO_PRO ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Premium Demo', 'maintenance-works' ); ?></a>
								<a href="<?php echo esc_url( MAINTENANCE_WORK_SUPPORT_FREE ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Support Forum', 'maintenance-works' ); ?></a>
							</div>
						</div> <!-- .demo_image -->

						<div class="step-loading"><span class="spinner"></span></div>
					</div> <!-- .demo_content -->

					<div class="homepage-setup-image">
						<div class="homepage-setup-theme-buynow">
							<div class="homepage-setup-theme-buynow-one">
								<h1><?php echo wp_kses_post( 'Online Learning LMS<br>WordPress Theme' ); ?></h1>
								<p><?php echo wp_kses_post( '<span>25%<br>Off</span> SHOP NOW' ); ?></p>
							</div>
							<div class="homepage-setup-theme-buynow-two">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/homepage-setup/assets/homepage-setup-images/maintenance-works.png' ); ?>" alt="<?php echo esc_attr__( 'Theme Bundle Image', 'maintenance-works' ); ?>">
							</div>
							<div class="homepage-setup-theme-buynow-three">
								<p><?php echo wp_kses_post( 'Get <span>25% OFF</span> on Online Learning LMS WordPress Theme Use code <span>"NYTHEMES25"</span> at checkout.' ); ?></p>
							</div>
							<div class="homepage-setup-theme-buynow-four">
								<a target="_blank" href="<?php echo esc_url( MAINTENANCE_WORK_BUY_NOW ); ?>"><?php echo esc_html__( 'Upgrade To Pro With Just $40', 'maintenance-works' ); ?></a>
							</div>
						</div>
					</div> <!-- .demo_image -->

				</div> <!-- .demo_content_image -->
			</div> <!-- .whizzie-wrap -->
		</div> <!-- .wrap -->
		<?php
	}


	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$maintenance_works_dev_steps = $this->config_steps;
		$maintenance_works_steps = array( 
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Install and Activate Essential Plugins', 'maintenance-works' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'maintenance-works' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Setup Home Page', 'maintenance-works' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'maintenance_works_install_widgets',
				'button_text'	=> __( 'Start Home Page Setup', 'maintenance-works' ),
				'can_skip'		=> false
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'Customize Your Site', 'maintenance-works' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);
		
		// Iterate through each step and replace with dev config values
		if( $maintenance_works_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from homepage-setup-settings.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $maintenance_works_dev_steps as $maintenance_works_dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $maintenance_works_dev_step['id'] ) ) {
					$id = $maintenance_works_dev_step['id'];
					if( isset( $maintenance_works_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $maintenance_works_dev_step[$element] ) ) {
								$maintenance_works_steps[$id][$element] = $maintenance_works_dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $maintenance_works_steps;
	}

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); 
		
		// Add plugin name and type at the top
		$content['detail'] = '<div class="plugin-info">';
		$content['detail'] .= '<p><strong>Plugin</strong></p>';
		$content['detail'] .= '<p><strong>Type</strong></p>';
		$content['detail'] .= '</div>';
		
		// The detail element is initially hidden from the user
		$content['detail'] .= '<ul class="whizzie-do-plugins">';
		
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			if ( $slug != 'easy-post-views-count') {
				$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
				$keys = array();
				if ( isset( $plugins['install'][ $slug ] ) ) {
					$keys[] = 'Installation';
				}
				if ( isset( $plugins['update'][ $slug ] ) ) {
					$keys[] = 'Update';
				}
				if ( isset( $plugins['activate'][ $slug ] ) ) {
					$keys[] = 'Activation';
				}
				$content['detail'] .= implode( ' and ', $keys ) . ' required';
				$content['detail'] .= '</span></li>';
			}
		}
		
		$content['detail'] .= '</ul>';
		
		return $content;
	}
	
	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?> <?php }
	
	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
		<div id="maintenance-works-demo-setup-guid">
			<div class="customize_div">
				<div class="customize_div finish">
					<div class="customize_div finish btns">
						<h3><?php echo esc_html( 'Your Site Is Ready To View' ); ?></h3>
						<div class="btnsss">
							<a target="_blank" href="<?php echo esc_url( get_home_url() ); ?>" class="button button-primary">
								<?php esc_html_e( 'View Your Site', 'maintenance-works' ); ?>
							</a>
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize Your Site', 'maintenance-works' ); ?>
							</a>
							<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary">
								<?php esc_html_e( 'Finsh', 'maintenance-works' ); ?>
							</a>
						</div>
					</div>
					<div class="maintenance-works-setup-finish">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>"/>
					</div>
				</div>
			</div>
		</div>
	<?php }

	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file() {
		if( file_exists( $this->widget_file_url ) ) {
			return true;
		}
		return false;
	}
	
	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','maintenance-works' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();
		
		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','maintenance-works' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','maintenance-works' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','maintenance-works' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','maintenance-works' ) ) );
		}
		exit;
	}


	public function maintenance_works_customizer_nav_menu() {

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- Online Learning LMS Primary Menu -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

		$maintenance_works_themename = 'Online Learning LMS';
		$maintenance_works_menuname = $maintenance_works_themename . ' Primary Menu';
		$maintenance_works_menulocation = 'maintenance-works-primary-menu';
		$maintenance_works_menu_exists = wp_get_nav_menu_object($maintenance_works_menuname);

		if (!$maintenance_works_menu_exists) {
			$maintenance_works_menu_id = wp_create_nav_menu($maintenance_works_menuname);

			// Home
			wp_update_nav_menu_item($maintenance_works_menu_id, 0, array(
				'menu-item-title' => __('Home', 'maintenance-works'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$maintenance_works_page_about = get_page_by_path('about');
			if($maintenance_works_page_about){
				wp_update_nav_menu_item($maintenance_works_menu_id, 0, array(
					'menu-item-title' => __('About', 'maintenance-works'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($maintenance_works_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$maintenance_works_page_services = get_page_by_path('services');
			if($maintenance_works_page_services){
				wp_update_nav_menu_item($maintenance_works_menu_id, 0, array(
					'menu-item-title' => __('Services', 'maintenance-works'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($maintenance_works_page_services),
					'menu-item-status' => 'publish'
				));
			}

			// Shop Page (WooCommerce)
			if (class_exists('WooCommerce')) {
				$maintenance_works_shop_page_id = wc_get_page_id('shop');
				if ($maintenance_works_shop_page_id) {
					wp_update_nav_menu_item($maintenance_works_menu_id, 0, array(
						'menu-item-title' => __('Shop', 'maintenance-works'),
						'menu-item-classes' => 'shop',
						'menu-item-url' => get_permalink($maintenance_works_shop_page_id),
						'menu-item-status' => 'publish'
					));
				}
			}

			// Blog
			$maintenance_works_page_blog = get_page_by_path('blog');
			if($maintenance_works_page_blog){
				wp_update_nav_menu_item($maintenance_works_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'maintenance-works'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($maintenance_works_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// 404 Page
			$maintenance_works_notfound = get_page_by_path('404 Page');
			if($maintenance_works_notfound){
				wp_update_nav_menu_item($maintenance_works_menu_id, 0, array(
					'menu-item-title' => __('404 Page', 'maintenance-works'),
					'menu-item-classes' => '404',
					'menu-item-url' => get_permalink($maintenance_works_notfound),
					'menu-item-status' => 'publish'
				));
			}

			if (!has_nav_menu($maintenance_works_menulocation)) {
				$maintenance_works_locations = get_theme_mod('nav_menu_locations');
				$maintenance_works_locations[$maintenance_works_menulocation] = $maintenance_works_menu_id;
				set_theme_mod('nav_menu_locations', $maintenance_works_locations);
			}
		}
	}

	
	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function maintenance_works_setup_widgets(){

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- MENUS PAGES -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/
		
			// Creation of home page //
			$maintenance_works_home_content = '';
			$maintenance_works_home_title = 'Home';
			$maintenance_works_home = array(
					'post_type' => 'page',
					'post_title' => $maintenance_works_home_title,
					'post_content'  => $maintenance_works_home_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => 'home'
			);
			$maintenance_works_home_id = wp_insert_post($maintenance_works_home);

			add_post_meta( $maintenance_works_home_id, '_wp_page_template', 'frontpage.php' );

			$maintenance_works_home = get_page_by_path( 'Home' );
			update_option( 'page_on_front', $maintenance_works_home->ID );
			update_option( 'show_on_front', 'page' );

			// Creation of blog page //
			$maintenance_works_blog_title = 'Blog';
			$maintenance_works_blog_check = get_page_by_path('blog');
			if (!$maintenance_works_blog_check) {
				$maintenance_works_blog = array(
					'post_type'    => 'page',
					'post_title'   => $maintenance_works_blog_title,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'blog'
				);
				$maintenance_works_blog_id = wp_insert_post($maintenance_works_blog);

				if (!is_wp_error($maintenance_works_blog_id)) {
					update_option('page_for_posts', $maintenance_works_blog_id);
				}
			}

			// Creation of about page //
			$maintenance_works_about_title = 'About';
			$maintenance_works_about_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$maintenance_works_about_check = get_page_by_path('about');
			if (!$maintenance_works_about_check) {
				$maintenance_works_about = array(
					'post_type'    => 'page',
					'post_title'   => $maintenance_works_about_title,
					'post_content'   => $maintenance_works_about_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'about'
				);
				wp_insert_post($maintenance_works_about);
			}

			// Creation of services page //
			$maintenance_works_services_title = 'Services';
			$maintenance_works_services_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$maintenance_works_services_check = get_page_by_path('services');
			if (!$maintenance_works_services_check) {
				$maintenance_works_services = array(
					'post_type'    => 'page',
					'post_title'   => $maintenance_works_services_title,
					'post_content'   => $maintenance_works_services_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'services'
				);
				wp_insert_post($maintenance_works_services);
			}

			// Creation of 404 page //
			$maintenance_works_notfound_title = '404 Page';
			$maintenance_works_notfound = array(
				'post_type'   => 'page',
				'post_title'  => $maintenance_works_notfound_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug'   => '404'
			);
			$maintenance_works_notfound_id = wp_insert_post($maintenance_works_notfound);
			add_post_meta($maintenance_works_notfound_id, '_wp_page_template', '404.php');


		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- SLIDER POST -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

			$maintenance_works_slider_title = array('Reliable Maintenance Services You Can Trust');
			for($maintenance_works_i=1;$maintenance_works_i<=1;$maintenance_works_i++){

				$maintenance_works_title = $maintenance_works_slider_title[$maintenance_works_i-1];
				$maintenance_works_content = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.';

				// Create post object
				$maintenance_works_my_post = array(
						'post_title'    => wp_strip_all_tags( $maintenance_works_title ),
						'post_content'  => $maintenance_works_content,
						'post_status'   => 'publish',
						'post_type'     => 'post',
				);
				// Insert the post into the database
				$maintenance_works_post_id = wp_insert_post( $maintenance_works_my_post );

				wp_set_object_terms($maintenance_works_post_id, 'Slider', 'category', true);

				wp_set_object_terms($maintenance_works_post_id, 'Slider', 'post_tag', true);

				$maintenance_works_image_url = get_template_directory_uri().'/inc/homepage-setup/assets/homepage-setup-images/banner.png';

				$maintenance_works_image_name= 'banner.png';
				$upload_dir       = wp_upload_dir();
				// Set upload folder
				$maintenance_works_image_data       = file_get_contents($maintenance_works_image_url);
				// Get image data
				$unique_file_name = wp_unique_filename( $upload_dir['path'], $maintenance_works_image_name );

				$maintenance_works_filename = basename( $unique_file_name ); 
				
				// Check folder permission and define file location
				if( wp_mkdir_p( $upload_dir['path'] ) ) {
						$maintenance_works_file = $upload_dir['path'] . '/' . $maintenance_works_filename;
				} else {
						$maintenance_works_file = $upload_dir['basedir'] . '/' . $maintenance_works_filename;
				}
				// Create the image  file on the server
				// Generate unique name
				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				if ( ! $wp_filesystem->put_contents( $maintenance_works_file, $maintenance_works_image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}
				// Check image file type
				$wp_filetype = wp_check_filetype( $maintenance_works_filename, null );
				// Set attachment data
				$maintenance_works_attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $maintenance_works_filename ),
						'post_content'   => '',
						'post_type'     => 'post',
						'post_status'    => 'inherit'
				);
				// Create the attachment
				$maintenance_works_attach_id = wp_insert_attachment( $maintenance_works_attachment, $maintenance_works_file, $maintenance_works_post_id );
				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				// Define attachment metadata
				$maintenance_works_attach_data = wp_generate_attachment_metadata( $maintenance_works_attach_id, $maintenance_works_file );
				// Assign metadata to attachment
					wp_update_attachment_metadata( $maintenance_works_attach_id, $maintenance_works_attach_data );
				// And finally assign featured image to post
				set_post_thumbnail( $maintenance_works_post_id, $maintenance_works_attach_id );

			}

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- Our Projects -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

			set_theme_mod('maintenance_works_video_section_left_post_cat', 'Service');

			$maintenance_works_slider_title = array('Electric Repair','Switchboard upgrades','Electrical installation','Electrical Service','Switchboard upgrades');
			for($maintenance_works_i=1;$maintenance_works_i<=5;$maintenance_works_i++){

				set_theme_mod('maintenance_works_service_icon'.$maintenance_works_i,[$maintenance_works_i-1]);

				$maintenance_works_title = $maintenance_works_slider_title[$maintenance_works_i-1];
				$maintenance_works_content = 'repair of washing machines, refrigerators, Air conditioner, etc';

				// Create post object
				$maintenance_works_my_post = array(
						'post_title'    => wp_strip_all_tags( $maintenance_works_title ),
						'post_content'  => $maintenance_works_content,
						'post_status'   => 'publish',
						'post_type'     => 'post',
				);
				// Insert the post into the database
				$maintenance_works_post_id = wp_insert_post( $maintenance_works_my_post );

				wp_set_object_terms($maintenance_works_post_id, 'Service', 'category', true);

				wp_set_object_terms($maintenance_works_post_id, 'Service', 'post_tag', true);

				$maintenance_works_image_url = get_template_directory_uri().'/assets/images/post'.$maintenance_works_i.'.png';

				$maintenance_works_image_name= 'post'.$maintenance_works_i.'.png';
				$upload_dir       = wp_upload_dir();
				// Set upload folder
				$maintenance_works_image_data       = file_get_contents($maintenance_works_image_url);
				// Get image data
				$unique_file_name = wp_unique_filename( $upload_dir['path'], $maintenance_works_image_name );

				$maintenance_works_filename = basename( $unique_file_name ); 
				
				// Check folder permission and define file location
				if( wp_mkdir_p( $upload_dir['path'] ) ) {
						$maintenance_works_file = $upload_dir['path'] . '/' . $maintenance_works_filename;
				} else {
						$maintenance_works_file = $upload_dir['basedir'] . '/' . $maintenance_works_filename;
				}
				// Create the image  file on the server
				// Generate unique name
				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				if ( ! $wp_filesystem->put_contents( $maintenance_works_file, $maintenance_works_image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}
				// Check image file type
				$wp_filetype = wp_check_filetype( $maintenance_works_filename, null );
				// Set attachment data
				$maintenance_works_attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $maintenance_works_filename ),
						'post_content'   => '',
						'post_type'     => 'post',
						'post_status'    => 'inherit'
				);
				// Create the attachment
				$maintenance_works_attach_id = wp_insert_attachment( $maintenance_works_attachment, $maintenance_works_file, $maintenance_works_post_id );
				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				// Define attachment metadata
				$maintenance_works_attach_data = wp_generate_attachment_metadata( $maintenance_works_attach_id, $maintenance_works_file );
				// Assign metadata to attachment
					wp_update_attachment_metadata( $maintenance_works_attach_id, $maintenance_works_attach_data );
				// And finally assign featured image to post
				set_post_thumbnail( $maintenance_works_post_id, $maintenance_works_attach_id );

 			}

        
        $this->maintenance_works_customizer_nav_menu();

	    exit;
	}
}