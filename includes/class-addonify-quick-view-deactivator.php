<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://addonify.com
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes
 * @author     Addonify <info@addonify.com>
 */
class Addonify_Quick_View_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		require plugin_dir_path( __DIR__ ) . 'includes/plugin-setting-defaults.php';

		$setting_defaults = addonify_quick_view_setting_defaults();

		if (
			is_array( $setting_defaults ) && $setting_defaults &&
			get_option( ADDONIFY_QUICK_VIEW_DB_INITIALS . 'delete_plugin_data_on_deactivation', false )
		) {
			foreach ( $setting_defaults as $setting_id => $setting_default ) {
				delete_option( ADDONIFY_QUICK_VIEW_DB_INITIALS . $setting_id );
			}
		}
	}
}
