<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://addonify.com
 * @since             1.0.0
 * @package           Addonify_Quick_View
 *
 * @wordpress-plugin
 * Plugin Name:       Addonify WooCommerce Quick View
 * Plugin URI:        https://addonify.com/addonify-woocommerce-quick-view
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Addonify
 * Author URI:        https://addonify.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       addonify-quick-view
 * Domain Path:       /languages
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
define( 'ADDONIFY_QUICK_VIEW_VERSION', '1.0.0' );


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


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	// woocommerce is active
	run_addonify_quick_view();
}
else{

	// woocommerce is not active
	function woocommerce_not_active_notice() {
		echo '<div class="notice notice-error is-dismissible"><p>';
		_e( 'Addonify Quick View is enabled but not effective. It requires WooCommerce in order to work.', 'addonify-quick-view' );
		echo '</p></div>';
	}
	
	add_action( 'admin_notices', 'woocommerce_not_active_notice' );

}


