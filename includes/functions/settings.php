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
require_once plugin_dir_path( __DIR__ ) . 'functions/fields/general.php';
require_once plugin_dir_path( __DIR__ ) . 'functions/fields/button.php';
require_once plugin_dir_path( __DIR__ ) . 'functions/fields/modal-box.php';
require_once plugin_dir_path( __DIR__ ) . 'functions/fields/misc-buttons.php';
require_once plugin_dir_path( __DIR__ ) . 'functions/fields/custom-css.php';

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
							} else { // phpcs:ignore
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

				if ( ! update_option( ADDONIFY_QUICK_VIEW_DB_INITIALS . $key, $sanitized_value ) ) {
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

if ( ! function_exists( 'addonify_quick_view_get_settings_fields' ) ) {
	/**
	 * Define settings sections and respective settings fields.
	 *
	 * @since 2.0.0
	 * @return array
	 */
	function addonify_quick_view_get_settings_fields() {

		return apply_filters(
			'addonify_quick_view_general_sections',
			array(
				'settings_values' => addonify_quick_view_get_settings_fields_values(),
				'tabs'            => array(
					'general'          => array(
						'title'    => __( 'General Settings', 'addonify-quick-view' ),
						'icon'     => "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='20' height='20' > <path d='M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z' /><path d='M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z'/></svg>",
						'sections' => apply_filters( 'addonify_wishlist_general_v_2_options', array() ),
					),
					'popup_modal'      => array(
						'title'    => __( 'Popup Modals', 'addonify-quick-view' ),
						'icon'     => '',
						'sections' => apply_filters( 'addonify_wishlist_popup_modal_v_2_options', array() ),
					),
					'wishlist_button'  => array(
						'title'    => __( 'Wishlist Button', 'addonify-quick-view' ),
						'icon'     => "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='20' height='20'><path d='M19,24H5c-2.76,0-5-2.24-5-5V5C0,2.24,2.24,0,5,0h14c2.76,0,5,2.24,5,5v14c0,2.76-2.24,5-5,5ZM5,2c-1.65,0-3,1.35-3,3v14c0,1.65,1.35,3,3,3h14c1.65,0,3-1.35,3-3V5c0-1.65-1.35-3-3-3H5Zm7,18c-4.41,0-8-3.59-8-8S7.59,4,12,4s8,3.59,8,8-3.59,8-8,8Zm0-14c-3.31,0-6,2.69-6,6s2.69,6,6,6,6-2.69,6-6-2.69-6-6-6Zm0,7.5c.83,0,1.5-.67,1.5-1.5s-.67-1.5-1.5-1.5-1.5,.67-1.5,1.5,.67,1.5,1.5,1.5Z'/></svg>",
						'sections' => apply_filters( 'addonify_wishlist_wishlist_button_v_2_options', array() ),
					),
					'wishlist_page'    => array(
						'title'    => __( 'Wishlist Page', 'addonify-quick-view' ),
						'icon'     => "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='20' height='20'><path d='M22.485,10.975,12,17.267,1.515,10.975A1,1,0,1,0,.486,12.69l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z'/><path d='M22.485,15.543,12,21.834,1.515,15.543A1,1,0,1,0,.486,17.258l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z'/><path d='M12,14.773a2.976,2.976,0,0,1-1.531-.425L.485,8.357a1,1,0,0,1,0-1.714L10.469.652a2.973,2.973,0,0,1,3.062,0l9.984,5.991a1,1,0,0,1,0,1.714l-9.984,5.991A2.976,2.976,0,0,1,12,14.773ZM2.944,7.5,11.5,12.633a.974.974,0,0,0,1,0L21.056,7.5,12.5,2.367a.974.974,0,0,0-1,0h0Z'/></svg>",
						'sections' => apply_filters( 'addonify_wishlist_wishlist_page_v_2_options', array() ),
					),
					'wishlist_sidebar' => array(
						'title'    => __( 'Wishlist Sidebar', 'addonify-quick-view' ),
						'icon'     => "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='20' height='20'><path d='M21,2H3C1.346,2,0,3.346,0,5V22H24V5c0-1.654-1.346-3-3-3ZM2,5c0-.552,.449-1,1-1H13V20H2V5Zm20,15h-7V4h6c.551,0,1,.448,1,1v15Zm-5-10h3v2h-3v-2Zm0,4h3v2h-3v-2Zm0-8h3v2h-3v-2Z'/></svg>",
						'sections' => apply_filters( 'addonify_wishlist_wishlist_sidebar_v_2_options', array() ),
					),
					'wishlist_notice'  => array(
						'title'    => __( 'Wishlist Notice', 'addonify-quick-view' ),
						'icon'     => "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='20' height='20'><path d='m19,4h-1.101c-.465-2.279-2.485-4-4.899-4H5C2.243,0,0,2.243,0,5v12.854c0,.794.435,1.52,1.134,1.894.318.171.667.255,1.015.255.416,0,.831-.121,1.19-.36l2.95-1.967c.691,1.935,2.541,3.324,4.711,3.324h5.697l3.964,2.643c.36.24.774.361,1.19.361.348,0,.696-.085,1.015-.256.7-.374,1.134-1.1,1.134-1.894v-12.854c0-2.757-2.243-5-5-5ZM2.23,17.979c-.019.012-.075.048-.152.007-.079-.042-.079-.109-.079-.131V5c0-1.654,1.346-3,3-3h8c1.654,0,3,1.346,3,3v7c0,1.654-1.346,3-3,3h-6c-.327,0-.541.159-.565.175l-4.205,2.804Zm19.77,3.876c0,.021,0,.089-.079.131-.079.041-.133.005-.151-.007l-4.215-2.811c-.164-.109-.357-.168-.555-.168h-6c-1.304,0-2.415-.836-2.828-2h4.828c2.757,0,5-2.243,5-5v-6h1c1.654,0,3,1.346,3,3v12.854Z'/></svg>",
						'sections' => apply_filters( 'addonify_wishlist_notice_options', array() ),
					),
					'tools'            => array(
						'title'    => __( 'Tools', 'addonify-quick-view' ),
						'icon'     => "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='20' height='20'><path d='M23.854,22.479l-4.545-7.437c.824-.474,1.614-1.027,2.352-1.674,.415-.364,.456-.996,.092-1.411-.366-.416-.996-.455-1.412-.092-.65,.57-1.347,1.055-2.075,1.47l-3.045-4.983c.485-.662,.78-1.47,.78-2.351,0-1.858-1.279-3.411-3-3.858V1c0-.552-.447-1-1-1s-1,.448-1,1v1.142c-1.721,.447-3,2-3,3.858,0,.881,.295,1.689,.78,2.351l-3.045,4.982c-.728-.414-1.425-.899-2.075-1.47-.416-.364-1.046-.324-1.412,.092-.364,.415-.323,1.046,.092,1.412,.737,.647,1.527,1.201,2.352,1.674L.146,22.479c-.288,.472-.14,1.087,.332,1.375,.163,.1,.343,.146,.521,.146,.337,0,.666-.17,.854-.479l4.648-7.606c1.76,.71,3.627,1.077,5.498,1.077s3.738-.367,5.498-1.077l4.648,7.606c.188,.309,.518,.479,.854,.479,.178,0,.357-.047,.521-.146,.472-.288,.62-.903,.332-1.375ZM12,4c1.103,0,2,.897,2,2s-.897,2-2,2-2-.897-2-2,.897-2,2-2ZM7.555,14.191l2.787-4.561c.506,.232,1.064,.37,1.657,.37s1.151-.138,1.657-.37l2.788,4.562c-2.859,1.067-6.03,1.067-8.889,0Z'/></svg>",
						'sections' => array(
							'generate-wishlist-page' => array(
								'title'        => 'Generate Page',
								'type'         => 'sub_section',
								'sub_sections' => array(
									'generate-wishlist-page' => array(
										'label' => esc_html__( 'Generate wishlist page', 'addonify-quick-view' ),
										'type'  => 'action-button',
										'task'  => array(
											'type'        => 'POST',
											'endpoint'    => 'create_wishlist_page',
											'opperation'  => 'reset',
											'buttonLabel' => esc_html__( 'Generate', 'addonify-quick-view' ),
											'buttonIcon'  => '',
											'buttonClass' => '',
											'confirm'     => array(
												'required' => true,
												'confirmBtnLabel' => esc_html__( 'Yes', 'addonify-quick-view' ),
												'cancelBtnLabel' => esc_html__( 'No, cancel', 'addonify-quick-view' ),
												'content'  => esc_html__( 'Do you really want to create new wishlist page?', 'addonify-quick-view' ),
												'size'     => '350px',
											),
										),
									),
								),
							),
							'reset-import-export'    => array(
								'title'        => 'Export/Import/Reset Tools',
								'type'         => 'sub_section',
								'sub_sections' => array(
									'export-options' => array(
										'label'       => esc_html__( 'Export settings', 'addonify-quick-view' ),
										'description' => esc_html__( 'Backup all settings that can be imported in future.', 'addonify-quick-view' ),
										'type'        => 'export-option',
										'buttonLabel' => esc_html__( 'Export', 'addonify-quick-view' ),
									),
									'import-options' => array(
										'label'       => esc_html__( 'Import settings', 'addonify-quick-view' ),
										'caption'     => esc_html__( 'Drop a file here or click here to upload.', 'addonify-quick-view' ),
										'note'        => esc_html__( 'Only .json file is permitted.', 'addonify-quick-view' ),
										'description' => esc_html__( 'Drag or upload the .json file that you had exported.', 'addonify-quick-view' ),
										'type'        => 'import-option',
										'width'       => 'full',
									),
									'reset-options'  => array(
										'label'       => esc_html__( 'Reset settings', 'addonify-quick-view' ),
										'type'        => 'action-button',
										'description' => esc_html__( 'All the settings will be set to default.', 'addonify-quick-view' ),
										'task'        => array(
											'type'        => 'POST',
											'endpoint'    => 'reset_options',
											'opperation'  => 'reset',
											'buttonLabel' => esc_html__( 'Reset', 'addonify-quick-view' ),
											'buttonIcon'  => '',
											'buttonClass' => 'danger',
											'confirm'     => array(
												'required' => true,
												'confirmBtnLabel' => esc_html__( 'Yes', 'addonify-quick-view' ),
												'cancelBtnLabel' => esc_html__( 'No, cancel', 'addonify-quick-view' ),
												'content'  => esc_html__( 'Are you sure you would like to reset all settings?', 'addonify-quick-view' ),
												'size'     => '200px',
											),
										),
									),
									'remove_all_plugin_data_on_uninstall' => array(
										'label'       => __( 'Remove data on plugin uninstallation.', 'addonify-quick-view' ),
										'description' => __( 'Enable this option to remove all data related to the plugin on plugin unistallation.', 'addonify-quick-view' ),
										'type'        => 'switch',
										'className'   => '',
										'badge'       => 'Required',
										'value'       => addonify_quick_view_get_option( 'remove_all_plugin_data_on_uninstall' ),
									),
								),
							),
						),
					),
				),
			)
		);
	}
}
