<?php
/**
 * Display quick view button in product loop.
 *
 * This template can be overridden by copying it to yourtheme/addonify/addonify-quick-view-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package     Addonify_Quick_View\Public\Templates
 * @version     1.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

echo wp_kses_post(
	apply_filters(
		'addonify_quick_view_quick_view_button',
		sprintf(
			'<button type="button" class="addonify-qvm-button button %s" data-product_id="%s" rel="nofollow" >%s</button>',
			esc_attr( $args['css_class'] ),
			esc_attr( $args['product_id'] ),
			$args['label']
		)
	)
);
