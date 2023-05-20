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
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/general.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/button.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/modal-box.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/misc-buttons.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/custom-css.php';



if ( ! function_exists( 'addonify_quick_view_settings_fields_defaults' ) ) {
	/**
	 * Define default values for the settings fields.
	 *
	 * @since 1.0.7
	 *
	 * @return array
	 */
	function addonify_quick_view_settings_fields_defaults() {

		return apply_filters(
			'addonify_quick_view_settings_fields_defaults',
			array(
				// Options.
				'enable_quick_view'                   => true,
				'disable_quick_view_on_mobile_device' => false,
				'quick_view_btn_position'             => 'after_add_to_cart_button',
				'quick_view_btn_label'                => __( 'Quick view', 'addonify-quick-view' ),
				'modal_box_content'                   => serialize( array( 'image', 'title', 'price', 'add_to_cart', 'rating', 'excerpt' ) ), // phpcs:ignore
				'product_thumbnail'                   => 'product_image_only',
				'enable_lightbox'                     => false,
				'display_read_more_button'            => false,
				'read_more_button_label'              => __( 'View Detail', 'addonify-quick-view' ),
				// Styles.
				'enable_plugin_styles'                => false,
				'modal_box_overlay_background_color'  => 'rgba(0, 0, 0, 0.8)',
				'modal_box_background_color'          => 'rgba(255, 255, 255, 1)',
				'modal_box_general_text_color'        => 'rgba(51, 51, 51, 1)',
				'modal_box_inputs_background_color'   => 'rgba(255, 255, 255, 1)',
				'modal_box_inputs_text_color'         => 'rgba(51, 51, 51, 1)',
				'modal_box_spinner_icon_color'        => 'rgba(51, 51, 51, 1)',
				'product_title_color'                 => 'rgba(51, 51, 51, 1)',
				'product_rating_star_empty_color'     => 'rgba(147, 147, 147, 1)',
				'product_rating_star_filled_color'    => 'rgba(245, 196, 14, 1)',
				'product_price_color'                 => 'rgba(51, 51, 51, 1)',
				'product_on_sale_price_color'         => 'rgba(255, 0, 0, 1)',
				'product_excerpt_text_color'          => 'rgba(88, 88, 88, 1)',
				'product_meta_text_color'             => 'rgba(2, 134, 231, 1)',
				'product_meta_text_hover_color'       => 'rgba(88, 88, 88, 1)',
				'modal_close_button_text_color'       => 'rgba(118, 118, 118, 1)',
				'modal_close_button_text_hover_color' => 'rgba(2, 134, 231, 1)',
				'modal_close_button_background_color' => 'rgba(238, 238, 238, 1)',
				'modal_close_button_background_hover_color' => 'rgba(182, 222, 255, 1)',
				'modal_misc_buttons_text_color'       => 'rgba(255, 255, 255, 1)',
				'modal_misc_buttons_text_hover_color' => 'rgba(255, 255, 255, 1)',
				'modal_misc_buttons_background_color' => 'rgba(51, 51, 51, 1)',
				'modal_misc_buttons_background_hover_color' => 'rgba(2, 134, 231, 1)',
				// Custom CSS.
				'custom_css'                          => '',
			)
		);
	}
}


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


if ( ! function_exists( 'addonify_quick_view_get_setting_field_value' ) ) {
	/**
	 * Retrieve the value of a settings field.
	 *
	 * @since 1.0.7
	 *
	 * @param string $setting_id Setting ID.
	 */
	function addonify_quick_view_get_setting_field_value( $setting_id ) {

		$defaults = addonify_quick_view_settings_fields_defaults();

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

			return addonify_quick_view_get_setting_field_value( $setting_id );
		} else {

			$key_values = array();

			foreach ( $setting_fields as $key => $value ) {

				$field_type = $value['type'];

				switch ( $field_type ) {

					case 'text':
						$key_values[ $key ] = addonify_quick_view_get_setting_field_value( $key );
						break;

					case 'switch':
						$key_values[ $key ] = ( addonify_quick_view_get_setting_field_value( $key ) === '1' ) ? true : false;
						break;

					case 'checkbox':
						$key_values[ $key ] = addonify_quick_view_get_setting_field_value( $key ) ? unserialize( addonify_quick_view_get_setting_field_value( $key ) ): array(); // phpcs:ignore
						break;

					case 'select':
						$key_values[ $key ] = ( addonify_quick_view_get_setting_field_value( $key ) === '' ) ? 'Choose value' : addonify_quick_view_get_setting_field_value( $key );
						break;

					case 'color':
						$key_values[ $key ] = addonify_quick_view_get_setting_field_value( $key );
						break;

					default:
						$key_values[ $key ] = addonify_quick_view_get_setting_field_value( $key );
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

			$defaults = addonify_quick_view_settings_fields_defaults();

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
							$choices = $settings_fields[ $key ]['choices'];
							if ( array_key_exists( $value, $choices ) ) {
								$sanitized_value = sanitize_text_field( $value );
							} else {
								$sanitized_value = $defaults[ $key ];
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
					'sections' => array(
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
					),
				),
				'styles'   => array(
					'sections' => array(
						'general'      => array(
							'title'       => __( 'General', 'addonify-quick-view' ),
							'description' => '',
							'fields'      => addonify_quick_view_general_styles_settings_fields(),
						),
						'modal'        => array(
							'title'       => __( 'Modal Box Colors', 'addonify-quick-view' ),
							'description' => __( 'Choose inner and overlay background colors of quick view modal box.', 'addonify-quick-view' ),
							'type'        => 'color-options-group',
							'fields'      => addonify_quick_view_modal_box_styles_settings_fields(),
						),
						'product'      => array(
							'title'       => __( 'Product Content Colors', 'addonify-quick-view' ),
							'description' => __( 'Choose colors for each individual content elements of quick view modal box.', 'addonify-quick-view' ),
							'type'        => 'color-options-group',
							'fields'      => addonify_quick_view_modal_box_content_styles_settings_fields(),
						),
						'close_button' => array(
							'title'       => __( 'Close Button Colors', 'addonify-quick-view' ),
							'description' => __( 'Choose colors for quick view modal box close button.', 'addonify-quick-view' ),
							'type'        => 'color-options-group',
							'fields'      => addonify_quick_view_modal_box_close_button_styles_settings_fields(),
						),
						'misc_buttons' => array(
							'title'       => __( 'Miscellaneous Buttons Colors', 'addonify-quick-view' ),
							'description' => __( 'Choose colors for buttons inside quick view modal box.', 'addonify-quick-view' ),
							'type'        => 'color-options-group',
							'fields'      => addonify_quick_view_misc_button_styles_settings_fields(),
						),
						'custom_css'   => array(
							'title'       => __( 'Developer', 'addonify-quick-view' ),
							'description' => '',
							'fields'      => addonify_quick_view_custom_css_settings_fields(),
						),
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
