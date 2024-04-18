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

	if ( is_array( $args ) && isset( $args ) ) {

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
 * @param array $args Button arguments.
 */
function addonify_quick_view_render_button_template( $args ) {

	addonify_quick_view_get_template(
		'addonify-quick-view-button',
		apply_filters(
			'addonify_quick_view_button_args',
			$args
		),
	);
}


/**
 * Renders view detail button in quick view product content.
 *
 * @since 1.1.6
 */
function addonify_quick_view_detail_button_template() {

	if ( (int) addonify_quick_view_get_option( 'display_read_more_button' ) !== 1 ) {
		return;
	}

	addonify_quick_view_get_template(
		'addonify-view-detail-button',
		apply_filters(
			'addonify_quick_view_detail_button_template_args',
			array(
				'button_label' => addonify_quick_view_get_option( 'read_more_button_label' ),
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
 */
function addonify_quick_view_content_template() {

	addonify_quick_view_get_template(
		'addonify-quick-view-content',
		apply_filters(
			'addonify_quick_view_content_template_args',
			array()
		)
	);
}



if ( ! function_exists( 'addonify_quick_view_get_modal_animation' ) ) {
	/**
	 * Return the name of the modal animation.
	 *
	 * @since 1.2.8
	 *
	 * @param string $action Opening or closing.
	 */
	function addonify_quick_view_get_modal_animation( $action ) {

		if ( ! $action ) {

			return 'none';
		}

		if ( 'opening' === $action ) {

			return addonify_quick_view_get_option( 'modal_opening_animation' ) ? addonify_quick_view_get_option( 'modal_opening_animation' ) : 'jello';
		}

		if ( 'closing' === $action ) {

			return addonify_quick_view_get_option( 'modal_closing_animation' ) ? addonify_quick_view_get_option( 'modal_closing_animation' ) : 'bounce-out';
		}
	}
}


if ( ! function_exists( 'addonify_quick_view_generate_quick_view_content' ) ) {
	/**
	 * Renders product content with respect to setting's selection.
	 *
	 * @since 1.0.0
	 */
	function addonify_quick_view_generate_quick_view_content() {

		$modal_box_content = unserialize( addonify_quick_view_get_option( 'modal_box_content' ) ); // phpcs:ignore

		if (
			! is_array( $modal_box_content ) ||
			empty( $modal_box_content )
		) {
			return;
		}

		// Show Hide Image according to user choices.
		if ( in_array( 'image', $modal_box_content, true ) ) {

			// Show or hide gallery thumbnails according to user choice.
			if ( addonify_quick_view_get_option( 'product_thumbnail' ) === 'product_image_only' ) {
				remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
			}

			// Show images.
			add_action( 'addonify_quick_view_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'addonify_quick_view_product_image', 'woocommerce_show_product_images', 20 );
		}

		// Show or hide title.
		if ( in_array( 'title', $modal_box_content, true ) ) {
			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_title', 5 );
		}

		// Show or hide product ratings.
		if ( in_array( 'rating', $modal_box_content, true ) ) {
			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_rating', 10 );
		}

		// Show or hide price.
		if ( in_array( 'price', $modal_box_content, true ) ) {
			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_price', 15 );
		}

		// Show or hide excerpt.
		if ( in_array( 'excerpt', $modal_box_content, true ) ) {
			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_excerpt', 20 );
		}

		// Show or hide add to cart button.
		if ( in_array( 'add_to_cart', $modal_box_content, true ) ) {
			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
		}

		// Show or hide product meta.
		if ( in_array( 'meta', $modal_box_content, true ) ) {
			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_meta', 30 );
		}
	}
}
