<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://addonify.com
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes
 * @author     Addonify <info@addonify.com>
 */
class Addonify_Quick_View {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Addonify_Quick_View_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ADDONIFY_QUICK_VIEW_VERSION' ) ) {
			$this->version = ADDONIFY_QUICK_VIEW_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'addonify-quick-view';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Addonify_Quick_View_Loader. Orchestrates the hooks of the plugin.
	 * - Addonify_Quick_View_i18n. Defines internationalization functionality.
	 * - Addonify_Quick_View_Admin. Defines all hooks for the admin area.
	 * - Addonify_Quick_View_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-addonify-quick-view-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-addonify-quick-view-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-addonify-quick-view-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-addonify-quick-view-public.php';

		$this->loader = new Addonify_Quick_View_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Addonify_Quick_View_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Addonify_Quick_View_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */

	private function define_admin_hooks() {

		$plugin_admin = new Addonify_Quick_View_Admin( $this->get_plugin_name(), $this->get_version() );
		
		// enqueue admin styles and scripts
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// admin menu
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu_callback' );

		// custom link in all plugin page
		$this->loader->add_action( 'plugin_action_links', $plugin_admin, 'custom_plugin_link_callback', 10, 2 );

		// show settings page ui 
		$this->loader->add_action("admin_init", $plugin_admin, 'settings_page_ui' );
		
		//show notice if woocommerce is not active
		$this->loader->add_action('admin_init', $plugin_admin, 'show_woocommerce_not_active_notice_callback' );

		// show admin notices after form submission
		$this->loader->add_action('admin_notices', $plugin_admin, 'form_submission_notification_callback' );

	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Addonify_Quick_View_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// add overlay container in image
		$this->loader->add_action( 'woocommerce_before_shop_loop_item', $plugin_public, 'addonify_overlay_container_start_callback' );
		$this->loader->add_action( 'woocommerce_after_shop_loop_item', $plugin_public, 'addonify_overlay_container_end_callback' );


		// add "Quick View" button after add to cart button
		$this->loader->add_action( 'woocommerce_after_shop_loop_item', $plugin_public, 'show_quick_view_btn_after_add_to_cart_btn_callback', 20 );


		// add "Quick View" button before add to cart button
		$this->loader->add_action( 'woocommerce_after_shop_loop_item', $plugin_public, 'show_quick_view_btn_before_add_to_cart_btn_callback' );

		

		// add "Quick View" button aside image
		$this->loader->add_action( 'woocommerce_shop_loop_item_title', $plugin_public, 'show_quick_view_btn_aside_image_callback', 8 );


		// add custom markup into footer
		$this->loader->add_action( 'wp_footer', $plugin_public, 'add_markup_into_footer_callback' );


		// add custom styles into header
		$this->loader->add_action( 'wp_head', $plugin_public, 'generate_custom_styles_callback' );


		// ajax callback
		$this->loader->add_action( 'wp_ajax_get_quick_view_contents', $plugin_public, 'quick_view_contents_callback' );
		$this->loader->add_action( 'wp_ajax_nopriv_get_quick_view_contents', $plugin_public, 'quick_view_contents_callback' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();
		
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Addonify_Quick_View_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
