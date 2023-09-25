<?php
/**
 * Includes template actions.
 *
 * @package Addonify_Quick_View
 * @subpackage Addonify_Quick_View/addonify-quick-view-template-hooks
 */

add_action( 'addonify_quick_view_button', 'addonify_quick_view_render_button_template' );

add_action( 'addonify_quick_view_content', 'addonify_quick_view_content_template' );

add_action( 'addonify_quick_view_after_product_summary_content', 'addonify_quick_view_detail_button_template' );
