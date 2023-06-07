<?php
/**
 * Plugin Name:       Addonify WooCommerce Quick View
 * Plugin URI:        https://addonify.com/downloads/woocommerce-quick-view/
 * Description:       Addonify WooCommerce Quick View plugin adds functionality to have a WooCommerce product quick preview on a modal window.
 * Version:           1.2.6
 * Requires at least: 5.9
 * Requires PHP:      7.4
 * Author:            Addonify
 * Author URI:        https://addonify.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       addonify-quick-view
 * Domain Path:       /languages
 *
 * @package Addonify_Quick_View
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ADDONIFY_QUICK_VIEW_VERSION', '1.2.6' );
define( 'ADDONIFY_DB_INITIALS', 'addonify_qv_' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-addonify-quick-view-activator.php
 */
function activate_addonify_quick_view() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-addonify-quick-view-activator.php';
	Addonify_Quick_View_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-addonify-quick-view-deactivator.php
 */
function deactivate_addonify_quick_view() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-addonify-quick-view-deactivator.php';
	Addonify_Quick_View_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_addonify_quick_view' );
register_deactivation_hook( __FILE__, 'deactivate_addonify_quick_view' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-addonify-quick-view.php';

/**
 * Load composer dependencies.
 *
 * - mobiledetect URL http://mobiledetect.net/
 */
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

if ( ! function_exists( 'run_addonify_quick_view' ) ) {
	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_addonify_quick_view() {

		$plugin = new Addonify_Quick_View();
		$plugin->run();

	}

	run_addonify_quick_view();
}
