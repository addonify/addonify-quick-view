<?php
/**
 * The class to define REST API endpoints used in settings page.
 * This is used to define REST API endpoints used in admin settings page to get and update settings values.
 *
 * @since      1.0.7
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes/functions
 * @author     Addonify <contact@addonify.com>
 */

/**
 * Includes setting fields.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'plugin-setting-defaults.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/general.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/button.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/modal-box.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/misc-buttons.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/custom-css.php';

if ( ! function_exists( 'addonify_quick_view_settings_fields' ) ) {
	/**
	 * Define settings fields.
	 *
	 * @since 1.0.7
	 *
	 * @return array
	 */
	function addonify_quick_view_settings_fields() {

		return apply_filters( 'addonify_quick_view_settings_fields', array() );
	}
}


if ( ! function_exists( 'addonify_quick_view_get_option' ) ) {
	/**
	 * Retrieve the value of a settings field.
	 *
	 * @since 1.0.7
	 *
	 * @param string $setting_id Setting ID.
	 */
	function addonify_quick_view_get_option( $setting_id ) {

		$defaults = addonify_quick_view_setting_defaults();

		return get_option( ADDONIFY_DB_INITIALS . $setting_id, $defaults[ $setting_id ] );
	}
}



if ( ! function_exists( 'addonify_quick_view_get_settings_fields_values' ) ) {
	/**
	 * Create and return array of setting_id and respective setting_value of settings fields.
	 *
	 * @since 1.0.7
	 *
	 * @param string $setting_id Setting ID.
	 * @return array
	 */
	function addonify_quick_view_get_settings_fields_values( $setting_id = '' ) {

		$setting_fields = addonify_quick_view_settings_fields();

		if ( $setting_id ) {

			return addonify_quick_view_get_option( $setting_id );
		} else {

			$key_values = array();

			foreach ( $setting_fields as $key => $value ) {

				$field_type = $value['type'];

				switch ( $field_type ) {

					case 'text':
						$key_values[ $key ] = addonify_quick_view_get_option( $key );
						break;

					case 'switch':
						$key_values[ $key ] = ( addonify_quick_view_get_option( $key ) === '1' ) ? true : false;
						break;

					case 'checkbox':
						$key_values[ $key ] = addonify_quick_view_get_option( $key ) ? unserialize( addonify_quick_view_get_option( $key ) ): array(); // phpcs:ignore
						break;

					case 'select':
						if ( isset( $value['multiselect'] ) && $value['multiselect'] ) {

							$setting_value = addonify_quick_view_get_option( $key );

							if ( is_array( $setting_value ) ) {
								$key_values[ $key ] = $setting_value;
							} else {
								$json_decode_setting_value = json_decode( $setting_value, true );
								if ( is_array( $json_decode_setting_value ) ) {
									$key_values[ $key ] = $json_decode_setting_value;
								} else {
									$key_values[ $key ] = array();
								}
							}
						} else {
							$key_values[ $key ] = ( addonify_quick_view_get_option( $key ) === '' ) ? 'Choose value' : addonify_quick_view_get_option( $key );
						}
						break;

					case 'color':
						$key_values[ $key ] = addonify_quick_view_get_option( $key );
						break;

					default:
						$key_values[ $key ] = addonify_quick_view_get_option( $key );
						break;
				}
			}

			return $key_values;
		}
	}
}


if ( ! function_exists( 'addonify_quick_view_update_settings_fields_values' ) ) {
	/**
	 * Updates settings fields values.
	 *
	 * @since 1.0.7
	 *
	 * @param array $settings_fields_values Setting IDs and corresponding values.
	 * @return boolean true if updated successfully, false otherwise.
	 */
	function addonify_quick_view_update_settings_fields_values( $settings_fields_values ) {

		if (
			is_array( $settings_fields_values ) &&
			count( $settings_fields_values ) > 0
		) {

			$defaults = addonify_quick_view_setting_defaults();

			$settings_fields = addonify_quick_view_settings_fields();

			foreach ( $settings_fields_values as $key => $value ) {

				if ( array_key_exists( $key, $settings_fields ) ) {

					$setting_field_type = $settings_fields[ $key ]['type'];

					switch ( $setting_field_type ) {

						case 'switch':
							$sanitized_value = ( $value ) ? '1' : '0';
							break;

						case 'checkbox':
							$sanitize_args = array(
								'choices' => $settings_fields[ $key ]['choices'],
								'values'  => $value,
							);

							$sanitized_value = addonify_quick_view_sanitize_multi_choices( $sanitize_args );
							$sanitized_value = serialize( $value ); // phpcs:ignore
							break;

						case 'text':
							$sanitized_value = sanitize_text_field( $value );
							break;

						case 'select':
							$choices     = $settings_fields[ $key ]['choices'];
							$multiselect = isset( $settings_fields[ $key ]['multiselect'] ) ? $settings_fields[ $key ]['multiselect'] : false;

							if ( $multiselect ) {
								$values_exit = true;
								if ( is_array( $value ) && $value ) {
									foreach ( $value as $val ) {
										if ( ! array_key_exists( $val, $choices ) ) {
											$values_exit = false;
											break;
										}
									}
								}

								$sanitized_value = ! $values_exit ? $defaults[ $key ] : $value;

								$sanitized_value = wp_json_encode( $sanitized_value );
							} else {
								if ( array_key_exists( $value, $choices ) ) {
									$sanitized_value = sanitize_text_field( $value );
								} else {
									$sanitized_value = $defaults[ $key ];
								}
							}
							break;

						default:
							$sanitized_value = sanitize_text_field( $value );
							break;
					}
				}

				if ( ! update_option( ADDONIFY_DB_INITIALS . $key, $sanitized_value ) ) {
					return false;
				}
			}

			return true;
		}
	}
}


if ( ! function_exists( 'addonify_quick_view_get_settings_fields' ) ) {
	/**
	 * Define settings sections and respective settings fields.
	 *
	 * @since 1.0.7
	 *
	 * @return array
	 */
	function addonify_quick_view_get_settings_fields() {

		return array(
			'settings_values' => addonify_quick_view_get_settings_fields_values(),
			'tabs'            => array(
				'settings' => array(
					'sections' => apply_filters(
						'addonify_quick_view_general_sections',
						array(
							'general' => array(
								'title'       => __( 'General', 'addonify-quick-view' ),
								'description' => '',
								'fields'      => addonify_quick_view_general_settings_fields(),
							),
							'button'  => array(
								'title'       => __( 'Button Options', 'addonify-quick-view' ),
								'description' => '',
								'fields'      => addonify_quick_view_button_settings_fields(),
							),
							'modal'   => array(
								'title'       => __( 'Modal Box Options', 'addonify-quick-view' ),
								'description' => '',
								'fields'      => addonify_quick_view_modal_box_content_settings_fields(),
							),
						)
					),
				),
				'styles'   => array(
					'sections' => apply_filters(
						'addonify_quick_view_style_sections',
						array(
							'general'      => array(
								'title'       => __( 'Interface Design', 'addonify-quick-view' ),
								'description' => '',
								'fields'      => addonify_quick_view_general_styles_settings_fields(),
							),
							'button'       => array(
								'title'       => __( 'Quick view button', 'addonify-quick-view' ),
								'description' => __( 'Change how quick view button should appear in the WooCommerce products listing.', 'addonify-quick-view' ),
								'type'        => 'render-jumbo-box',
								'fields'      => addonify_quick_view_button_styles_settings_fields(),
							),
							'modal'        => array(
								'title'       => __( 'Modal box UI options', 'addonify-quick-view' ),
								'description' => __( 'Customize the look and feel of quick view modal box.', 'addonify-quick-view' ),
								'type'        => 'render-jumbo-box',
								'fields'      => addonify_quick_view_modal_box_styles_settings_fields(),
							),
							'product'      => array(
								'title'       => __( 'Product content options', 'addonify-quick-view' ),
								'description' => __( 'Product content inside modal box options.', 'addonify-quick-view' ),
								'type'        => 'render-jumbo-box',
								'fields'      => addonify_quick_view_modal_box_content_styles_settings_fields(),
							),
							'close_button' => array(
								'title'       => __( 'Modal box close button options', 'addonify-quick-view' ),
								'description' => __( 'Customize how modal close button should appear.', 'addonify-quick-view' ),
								'type'        => 'render-jumbo-box',
								'fields'      => addonify_quick_view_modal_box_close_button_styles_settings_fields(),
							),
							'misc_buttons' => array(
								'title'       => __( 'Misc buttons inside modal box', 'addonify-quick-view' ),
								'description' => __( 'This option will be applied to all the buttons inside the modal box except close button.', 'addonify-quick-view' ),
								'type'        => 'render-jumbo-box',
								'fields'      => addonify_quick_view_misc_button_styles_settings_fields(),
							),
						)
					),
				),
				'products' => array(
					'recommended' => array(
						// Recommend plugins here.
						'content' => __( 'Coming soon....', 'addonify-quick-view' ),
					),
				),
			),
		);
	}
}
