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

if ( ! function_exists( 'addonify_quick_view_get_button_icons' ) ) {
	/**
	 * Return quick view button icons
	 *
	 * @since 1.2.8
	 *
	 * @param string $key Icon key.
	 * @return string|array Icon string if found, else returns the array of icons.
	 */
	function addonify_quick_view_get_button_icons( $key ) {

		$icons = array(
			'icon_one'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path></svg>',

			'icon_two'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z"></path></svg>',

			'icon_three' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>',

			'icon_four'  => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg>',

			'icon_five'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z"></path></svg>',

			'icon_six'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168Z"></path></svg>',
		);

		if ( 'all' === $key ) {
			return $icons;
		}

		// Return specific icon or array.
		return array_key_exists( $key, $icons ) ? $icons[ $key ] : false;
	}
}



if ( ! function_exists( 'addonify_quick_view_get_spinner_icon' ) ) {
	/**
	 * Return the spinner svg icon.
	 *
	 * @since 1.2.8
	 *
	 * @param string $key Icon key.
	 * @return string|array Icon string if found, else returns the array of icons.
	 */
	function addonify_quick_view_get_spinner_icon( $key ) {

		$icons = array(
			'icon_one'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C12.5523 2 13 2.44772 13 3V6C13 6.55228 12.5523 7 12 7C11.4477 7 11 6.55228 11 6V3C11 2.44772 11.4477 2 12 2ZM12 17C12.5523 17 13 17.4477 13 18V21C13 21.5523 12.5523 22 12 22C11.4477 22 11 21.5523 11 21V18C11 17.4477 11.4477 17 12 17ZM22 12C22 12.5523 21.5523 13 21 13H18C17.4477 13 17 12.5523 17 12C17 11.4477 17.4477 11 18 11H21C21.5523 11 22 11.4477 22 12ZM7 12C7 12.5523 6.55228 13 6 13H3C2.44772 13 2 12.5523 2 12C2 11.4477 2.44772 11 3 11H6C6.55228 11 7 11.4477 7 12ZM19.0711 19.0711C18.6805 19.4616 18.0474 19.4616 17.6569 19.0711L15.5355 16.9497C15.145 16.5592 15.145 15.9261 15.5355 15.5355C15.9261 15.145 16.5592 15.145 16.9497 15.5355L19.0711 17.6569C19.4616 18.0474 19.4616 18.6805 19.0711 19.0711ZM8.46447 8.46447C8.07394 8.85499 7.44078 8.85499 7.05025 8.46447L4.92893 6.34315C4.53841 5.95262 4.53841 5.31946 4.92893 4.92893C5.31946 4.53841 5.95262 4.53841 6.34315 4.92893L8.46447 7.05025C8.85499 7.44078 8.85499 8.07394 8.46447 8.46447ZM4.92893 19.0711C4.53841 18.6805 4.53841 18.0474 4.92893 17.6569L7.05025 15.5355C7.44078 15.145 8.07394 15.145 8.46447 15.5355C8.85499 15.9261 8.85499 16.5592 8.46447 16.9497L6.34315 19.0711C5.95262 19.4616 5.31946 19.4616 4.92893 19.0711ZM15.5355 8.46447C15.145 8.07394 15.145 7.44078 15.5355 7.05025L17.6569 4.92893C18.0474 4.53841 18.6805 4.53841 19.0711 4.92893C19.4616 5.31946 19.4616 5.95262 19.0711 6.34315L16.9497 8.46447C16.5592 8.85499 15.9261 8.85499 15.5355 8.46447Z"></path></svg>',

			'icon_two'   => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/></svg>',

			'icon_three' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.364 5.63604L16.9497 7.05025C15.683 5.7835 13.933 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12H21C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C14.4853 3 16.7353 4.00736 18.364 5.63604Z"></path></svg>',

			'icon_four'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4C9.25144 4 6.82508 5.38626 5.38443 7.5H8V9.5H2V3.5H4V5.99936C5.82381 3.57166 8.72764 2 12 2C17.5228 2 22 6.47715 22 12H20C20 7.58172 16.4183 4 12 4ZM4 12C4 16.4183 7.58172 20 12 20C14.7486 20 17.1749 18.6137 18.6156 16.5H16V14.5H22V20.5H20V18.0006C18.1762 20.4283 15.2724 22 12 22C6.47715 22 2 17.5228 2 12H4Z"></path></svg>',

			'icon_five'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10.9999 2.04932L11 5.07082C7.6077 5.55605 5 8.47346 5 11.9999C5 15.8659 8.13401 18.9999 12 18.9999C13.5723 18.9999 15.0236 18.4815 16.1922 17.6063L18.3289 19.7427C16.605 21.1535 14.4014 21.9999 12 21.9999C6.47715 21.9999 2 17.5228 2 11.9999C2 6.81462 5.94662 2.55109 10.9999 2.04932ZM21.9506 13C21.7509 15.011 20.9555 16.8467 19.7433 18.3282L17.6064 16.1921C18.2926 15.2759 18.7595 14.1859 18.9291 12.9999L21.9506 13ZM13.0011 2.04942C17.725 2.51895 21.4815 6.27583 21.9506 10.9998L18.9291 10.9997C18.4905 7.93446 16.0661 5.50985 13.001 5.07096L13.0011 2.04942Z"></path></svg>',

			'icon_six'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
			<path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
			</svg>',
		);

		if ( 'all' === $key ) {
			return $icons;
		}

		// Return specific icon or array.
		return array_key_exists( $key, $icons ) ? $icons[ $key ] : false;
	}
}


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

/**
 * Sanitizes SVG
 *
 * @since 1.2.8
 * @package Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes/functions
 */

if ( ! function_exists( 'addonify_quick_view_escape_svg' ) ) {
	/**
	 * Sanitizes SVG
	 *
	 * @param string $svg SVG code.
	 * @return string $svg Sanitized SVG code.
	 */
	function addonify_quick_view_escape_svg( $svg ) {

		$allowed_html = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);

		return wp_kses( $svg, $allowed_html );
	}
}

if ( ! function_exists( 'addonify_quick_view_get_border_styles' ) ) {
	/**
	 * Get border styles.
	 *
	 * @since 1.2.16
	 */
	function addonify_quick_view_get_border_styles() {

		return array(
			'none'   => esc_html__( 'None', 'addonify-quick-view' ),
			'solid'  => esc_html__( 'Solid', 'addonify-quick-view' ),
			'dotted' => esc_html__( 'Dotted', 'addonify-quick-view' ),
			'dashed' => esc_html__( 'Dashed', 'addonify-quick-view' ),
			'double' => esc_html__( 'Double', 'addonify-quick-view' ),
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_get_font_weights' ) ) {
	/**
	 * Get font weights.
	 *
	 * @since 1.2.16
	 */
	function addonify_quick_view_get_font_weights() {

		return array(
			'400' => esc_html__( 'Normal', 'addonify-quick-view' ),
			'500' => esc_html__( 'Medium', 'addonify-quick-view' ),
			'600' => esc_html__( 'Semi bold', 'addonify-quick-view' ),
			'700' => esc_html__( 'Bold', 'addonify-quick-view' ),
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_get_text_transforms' ) ) {
	/**
	 * Get text transforms.
	 *
	 * @since 1.2.16
	 */
	function addonify_quick_view_get_text_transforms() {

		return array(
			'inherit'    => esc_html__( 'Deafult', 'addonify-quick-view' ),
			'capitalize' => esc_html__( 'Capitalize', 'addonify-quick-view' ),
			'lowercase'  => esc_html__( 'Lowercase', 'addonify-quick-view' ),
			'uppercase'  => esc_html__( 'Uppercase', 'addonify-quick-view' ),
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_get_font_styles' ) ) {
	/**
	 * Get font styles.
	 *
	 * @since 1.2.16
	 */
	function addonify_quick_view_get_font_styles() {

		return array(
			'inherit' => esc_html__( 'Default', 'addonify-quick-view' ),
			'italic'  => esc_html__( 'Italic', 'addonify-quick-view' ),
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_minify_css' ) ) {
	/**
	 * Minifies CSS code.
	 *
	 * @since 1.0.0
	 *
	 * @param string $css Unminified CSS.
	 */
	function addonify_quick_view_minify_css( $css ) {

		$css = preg_replace( '/\s+/', ' ', $css );
		$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
		$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

		return trim( $css );
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

		return get_option( ADDONIFY_QUICK_VIEW_DB_INITIALS . $setting_id, $defaults[ $setting_id ] );
	}
}
