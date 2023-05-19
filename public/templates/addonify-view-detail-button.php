<?php
/**
 * Display view detail button in quick view modal.
 *
 * This template can be overridden by copying it to yourtheme/addonify/addonify-view-detail-button.php.
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

echo apply_filters( // phpcs:ignore
	'addonify_quick_view_detail_button',
	sprintf(
		'<a href="%s" class="button" >%s</a>',
		get_the_permalink( $args['product_id'] ),
		esc_html( $args['button_label'] )
	)
);
