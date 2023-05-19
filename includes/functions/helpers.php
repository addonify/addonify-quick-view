<?php
/**
 * Helper functions for settings.
 *
 * @since      1.0.7
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes/functions
 * @author     Addonify <contact@addonify.com>
 */

if ( ! function_exists( 'addonify_quick_view_sanitize_multi_choices' ) ) {
	/**
	 * Sanitize multiple choices values.
	 *
	 * @since 1.0.7
	 *
	 * @param array $args Raw values.
	 * @return array $sanitized_values
	 */
	function addonify_quick_view_sanitize_multi_choices( $args ) {

		if (
			is_array( $args['choices'] ) &&
			count( $args['choices'] ) &&
			is_array( $args['values'] ) &&
			count( $args['values'] )
		) {

			$sanitized_values = array();

			foreach ( $args['values'] as $value ) {

				if ( array_key_exists( $value, $args['choices'] ) ) {

					$sanitized_values[] = $value;
				}
			}

			return $sanitized_values;
		}

		return array();
	}
}


if ( ! function_exists( 'addonify_quick_view_is_mobile' ) ) {
	/**
	 * Check if the device is mobile.
	 *
	 * @since 1.1.1
	 *
	 * @return boolean
	 */
	function addonify_quick_view_is_mobile() {

		if ( class_exists( '\Detection\MobileDetect' ) ) {

			$device_detect =  new \Detection\MobileDetect; // phpcs:ignore

			return $device_detect->isMobile();
		}
	}
}


if ( ! function_exists( 'addonify_quick_view_is_tablet' ) ) {
	/**
	 * Check if the device is tablet.
	 *
	 * @since 1.1.1
	 *
	 * @return boolean
	 */
	function addonify_quick_view_is_tablet() {

		if ( class_exists( '\Detection\MobileDetect' ) ) {

			$device_detect =  new \Detection\MobileDetect; // phpcs:ignore

			return $device_detect->isTablet();
		}
	}
}
