<?php
/**
 * The file that defines template functions.
 *
 * @link https://addonify.com/
 * @since 1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/public
 */

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 * yourtheme/addonify/quick-view/$template_path/$template_name
 * yourtheme/addonify/quick-view/$template_name
 * $default_path/$template_name
 *
 * @param string $template_name Template name.
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 * @return string
 */
function addonify_quick_view_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	// Set template location for theme.
	if ( empty( $template_path ) ) {
		$template_path = 'addonify/quick-view/';
	}

	// Set default plugin templates path.
	if ( ! $default_path ) {
		$default_path = plugin_dir_path( dirname( __FILE__ ) ) . 'public/templates/'; // Path to the template folder.
	}

	// Search template file in theme folder.
	$template = locate_template(
		array(
			$template_path . $template_name,
			$template_name,
		)
	);

	// Get plugins template file.
	if ( ! $template ) {
		$template = $default_path . $template_name;
	}

	return apply_filters( 'addonify_quick_view_locate_template', $template, $template_name, $template_path, $default_path );
}


/**
 * Get other templates passing attributes and including the file.
 *
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 */
function addonify_quick_view_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

	if (  is_array( $args ) && isset( $args ) ) {

		extract( $args ); //phpcs:ignore
	}

	$template_file = addonify_quick_view_locate_template( $template_name . '.php', $template_path, $default_path );

	if ( ! file_exists( $template_file ) ) {
		/* translators: %s template */
		_doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'addonify-quick-view' ), '<code>' . $template_file . '</code>' ), '1.0.0' ); // phpcs:ignore
		return;
	}

	include $template_file;
}


/**
 * Renders quick view button.
 *
 * @since 1.1.6
 */
function addonify_quick_view_render_button_template() {

	if ( 
		empty( addonify_quick_view_get_settings_fields_values( 'quick_view_btn_label' ) ) && !addonify_quick_view_get_settings_fields_values( 'enable_quick_view_btn_icon' )
	) {

		return;
	}

	global $product;

	$button_icon = '';

	$icon_position = '';

	$button_css_classes = array( 'button', 'addonify-qvm-button' );

	if ( 
		addonify_quick_view_get_settings_fields_values( 'enable_quick_view_btn_icon' ) &&  				 addonify_quick_view_get_settings_fields_values( 'quick_view_btn_icon_position' )
	) {

		$icon_key = addonify_quick_view_get_settings_fields_values( 'quick_view_btn_icon' );

		$button_icon = addonify_quick_view_get_button_icons( $icon_key );

		$position = addonify_quick_view_get_settings_fields_values( 'quick_view_btn_icon_position' );

		$icon_position = $position === 'before_label' ? 'left' : 'right';
	}

	$quick_view_button_args = array(
		'product_id' 	=> $product->get_id(),
		'label'      	=> addonify_quick_view_get_settings_fields_values( 'quick_view_btn_label' ),
		'classes'    	=> apply_filters( 'addonify_quick_view_button_css_classes', $button_css_classes ),
		'icon'		 	=> $button_icon,
		'icon_position' => $icon_position,
	);

	addonify_quick_view_get_template(
		'addonify-quick-view-button',
		apply_filters(
			'addonify_quick_view_button_args', 
			$quick_view_button_args 
		),
	);
}


/**
 * Renders view detail button in quick view product content.
 *
 * @since 1.1.6
 * @param int $product_id Product ID.
 */
function addonify_quick_view_detail_button_template( $product_id ) {

	if ( (int) addonify_quick_view_get_settings_fields_values( 'display_read_more_button' ) !== 1 ) {
		return;
	}

	addonify_quick_view_get_template(
		'addonify-view-detail-button',
		apply_filters(
			'addonify_quick_view_detail_button_template_args',
			array(
				'product_id'   => $product_id,
				'button_label' => addonify_quick_view_get_settings_fields_values( 'read_more_button_label' ),
			)
		)
	);
}



/**
 * Renders quick view product content wrapper.
 *
 * @since 1.1.6
 */
function addonify_quick_view_content_wrapper_template() {

	addonify_quick_view_get_template( 'addonify-quick-view-content-wrapper' );
}


/**
 * Renders quick view product content.
 *
 * @since 1.1.6
 * @param int $product_id Product ID.
 */
function addonify_quick_view_content_template( $product_id ) {

	addonify_quick_view_get_template(
		'addonify-quick-view-content',
		apply_filters(
			'addonify_quick_view_content_template_args',
			array(
				'product_id' => $product_id,
			)
		)
	);
}


/**
 * Return the name of the modal animation.
 *
 * @since 1.2.8
 * @param string action. Opening or closing.
 */
if ( ! function_exists( 'addonify_quick_view_get_modal_animation' ) ) {

	function addonify_quick_view_get_modal_animation( $action ) {

		if ( $action === '') {

			return 'none';
		}

		if ( $action === 'opening' ) {

			return addonify_quick_view_get_settings_fields_values( 'modal_opening_animation' ) ? addonify_quick_view_get_settings_fields_values( 'modal_opening_animation' ) : 'jello';
		}

		if ( $action === 'closing' ) {

			return addonify_quick_view_get_settings_fields_values( 'modal_closing_animation' ) ? addonify_quick_view_get_settings_fields_values( 'modal_closing_animation' ) : 'bounce-out';
		}
	}
}
