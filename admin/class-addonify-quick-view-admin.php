<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://addonify.com
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/admin
 */

class Addonify_Quick_View_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Default settings_page_slug
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $settings_page_slug = 'addonify_quick_view';


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	
	public function enqueue_styles() {

		if( isset($_GET['page']) && $_GET['page'] == $this->settings_page_slug ){

			global $wp_styles;

			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/admin.css', array(), $this->version, 'all' );
		}
	}

	public function enqueue_scripts() {

		wp_register_script( 
			"{$this->plugin_name}-manifest", 
			plugin_dir_url( __FILE__ ) . 'assets/js/manifest.js', 
			null, 
			$this->version, 
			true 
		);

		wp_register_script( 
			"{$this->plugin_name}-vendor", 
			plugin_dir_url( __FILE__ ) . 'assets/js/vendor.js', 
			array(  "{$this->plugin_name}-manifest" ), 
			$this->version, 
			true 
		);

		wp_register_script( 
			"{$this->plugin_name}-main", 
			plugin_dir_url( __FILE__ ) . 'assets/js/main.js', 
			array( 'lodash', "{$this->plugin_name}-vendor", 'wp-i18n', 'wp-api-fetch' ), 
			$this->version, 
			true 
		);

		if( 
			isset( $_GET['page'] ) && 
			$_GET['page'] == $this->settings_page_slug 
		) {
			wp_enqueue_script( "{$this->plugin_name}-manifest" );

			wp_enqueue_script( "{$this->plugin_name}-vendor" );

			wp_enqueue_script( "{$this->plugin_name}-main" );

			wp_localize_script( "{$this->plugin_name}-main", 'adfy_wp_locolizer', array(
				'admin_url'  						=> esc_url( admin_url( '/' ) ),
				'ajax_url'   						=> esc_url( admin_url( 'admin-ajax.php' ) ),
				'rest_namespace' 					=> 'addonify_quick_view_options_api',
				'version_number' 					=> $this->version,
			));
		}

		wp_set_script_translations( "{$this->plugin_name}-main", $this->plugin_name );
	}

	
	// check if woocommerce is active
	private function is_woocommerce_active() {

		if ( class_exists( 'woocommerce' ) ) {
			return true;
		} 

		return false;
	}

	
	// callback function
	// admin menu
	public function add_menu_callback(){

		// do not show menu if woocommerce is not active
		if ( ! $this->is_woocommerce_active() )  return; 

		global $admin_page_hooks;
		
		$parent_menu_slug = array_search( 'addonify', $admin_page_hooks, true );

		if ( ! $parent_menu_slug ) {

			add_menu_page( 
				'Addonify Settings', 
				'Addonify', 
				'manage_options', 
				$this->settings_page_slug, 
				array( $this, 'get_settings_screen_contents' ), 
				'dashicons-superhero', 
				70 
			);

			add_submenu_page(  
				$this->settings_page_slug, 
				'Addonify Quick View Settings', 
				'Quick View', 
				'manage_options', 
				$this->settings_page_slug, 
				array( $this, 'get_settings_screen_contents' ), 
				0 
			);
		} else {

			add_submenu_page(  
				$parent_menu_slug, 
				'Addonify Quick View Settings', 
				'Quick View', 
				'manage_options', 
				$this->settings_page_slug, 
				array( $this, 'get_settings_screen_contents' ), 
				0 
			);
		}
	}

	// callback function
	// add custom "settings" link in the plugins.php page
	public function custom_plugin_link_callback( $links, $file ) {
		
		if ( $file == plugin_basename(dirname(__FILE__, 2) . '/addonify-quick-view.php') ) {
			// add "Settings" link
			$links[] = '<a href="admin.php?page='. $this->settings_page_slug .'">' . __('Settings','addonify-quick-view') . '</a>';
		}
		
		return $links;
	}


	// callback function
	// get contents for settings page screen
	public function get_settings_screen_contents() {
		?>
		<div id="___adfy-quickview-app___"></div>
		<?php
	}
	
	// callback
	// show error message in dashboard if woocommerce is not active
	public function show_woocommerce_not_active_notice_callback() {

		if( ! $this->is_woocommerce_active() ) {

			add_action('admin_notices', 'woocommerce_not_active_notice' );
		}

		function woocommerce_not_active_notice() {

			ob_start();
			require dirname( __FILE__ ) .'/templates/woocommerce_not_active_notice.php';
			echo ob_get_clean();
		}
	}

}