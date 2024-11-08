<?php
/**
 * Enqueue admin scripts.
 *
 * @package Addonify_Quick_View
 * @since 2.0.0
 */

use Kucrut\Vite;

/**
* Enqueue admin scripts in addonify quick view settings page.
*
* @since 2.0.0
*/
if ( isset( $_GET['page'] ) && 'addonify-quick-view' === $_GET['page'] ) { //phpcs:ignore

	$handle = 'addonify-quick-view-admin';

	add_action(
		'admin_enqueue_scripts',
		function () use ( $handle ): void {
			Vite\enqueue_asset(
				__DIR__ . '/app/dist',
				'admin/app/src/main.ts',
				array(
					'handle'           => $handle,
					'dependencies'     => array( 'lodash', 'wp-api-fetch' ), // Dependencies.
					'css-dependencies' => array(), // Optional style dependencies. Defaults to empty array.
					'css-media'        => 'all', // Optional.
					'css-only'         => false, // Optional. Set to true to only load style assets in production mode.
					'in-footer'        => true, // Optional. Defaults to false.
				)
			);

			wp_localize_script(
				$handle,
				'addonifyQuickViewLocals',
				array(
					'adminURL'      => admin_url( '/' ),
					'siteURL'       => site_url( '/' ),
					'restNamespace' => 'addonify-quick-view/v2',
					'version'       => ADDONIFY_QUICK_VIEW_VERSION,
					'isProActive'   => Addonify_Quick_View_Admin::is_pro_active(),
					'nonce'         => wp_create_nonce( 'addonify-quick-view-admin-nonce' ),
				)
			);
		}
	);
}
