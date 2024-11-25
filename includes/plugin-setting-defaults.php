<?php
/**
 * Define default values for plugin's settings.
 *
 * @since 1.2.17
 *
 * @package Addonify_Quick_View
 */

if ( ! function_exists( 'addonify_quick_view_setting_defaults' ) ) {
	/**
	 * Returns default plugin's settings values.
	 *
	 * @since 1.2.17
	 */
	function addonify_quick_view_setting_defaults() {

		return apply_filters(
			'addonify_quick_view_setting_defaults',
			array(
				// Options.
				'enable_quick_view'                      => '1',
				'disable_quick_view_on_mobile_device'    => false,
				'quick_view_btn_position'                => 'after_add_to_cart_button',
				'quick_view_btn_label'                   => esc_html__( 'Quick view', 'addonify-quick-view' ),
				'enable_quick_view_btn_icon'             => false,
				'quick_view_btn_icon'                    => 'icon_one',
				'quick_view_btn_icon_position'           => 'before_label',
				'modal_box_content'                   => serialize( array( 'image', 'title', 'price', 'add_to_cart', 'rating', 'excerpt' ) ), // phpcs:ignore
				// phpcs:ignore 'modal_width'            => 30, // PLANNED WITH RESPONSIVE CONTROL.
				'modal_content_column_layout'            => 'default', // since 1.2.8.
				'modal_content_column_gap'               => 40, // since 1.2.8.
				'product_thumbnail'                      => 'product_image_only',
				'enable_lightbox'                        => false,
				'display_read_more_button'               => false,
				'modal_opening_animation'                => 'jello', // since 1.2.8.
				'modal_closing_animation'                => 'bounce-out', // since 1.2.8.
				'hide_modal_close_button'                => false, // since 1.2.8.
				'close_modal_when_esc_pressed'           => '1', // since 1.2.8.
				'close_modal_when_clicked_outside'       => false, // since 1.2.8.
				'mobile_close_button_label'              => esc_html__( 'Close', 'addonify-quick-view' ), // since 1.2.8.
				'modal_zindex'                           => 10000000000000000, // since 1.2.8.
				'modal_border_radius'                    => 10, // since 1.2.8.
				'modal_image_radius'                     => 10, // since 1.2.8.
				'modal_gallery_thumbs_columns'           => 4, // since 1.2.8.
				'modal_gallery_thumbs_columns_gap'       => 20, // since 1.2.8.
				'spinner_icons'                          => 'icon_one', // since 1.2.8.
				'spinner_size'                           => 28, // since 1.2.8.
				'modal_general_text_font_size'           => 15, // since 1.2.8.
				'modal_product_title_font_size'          => 32, // since 1.2.8.
				'modal_product_title_font_weight'        => '400', // since 1.2.8.
				'modal_product_title_line_height'        => 1.2, // since 1.2.8.
				'modal_product_price_font_size'          => 22, // since 1.2.8.
				'modal_product_price_font_weight'        => '400', // since 1.2.8.
				'modal_on_sale_badge_font_size'          => 14, // since 1.2.8.
				'wc_gallery_trigger_icon_size'           => 18, // since 1.2.8.
				'wc_gallery_trigger_icon_border_radius'  => 10, // since 1.2.8.
				'read_more_button_label'                 => esc_html__( 'View Detail', 'addonify-quick-view' ),

				// Quick view button.
				'quick_view_button_text_color'           => 'rgba(255, 255, 255, 1)',
				'quick_view_button_text_color_hover'     => 'rgba(255, 255, 255, 1)',
				'quick_view_button_bg_color'             => 'rgba(0, 0, 0, 1)',
				'quick_view_button_bg_color_hover'       => 'rgba(14, 86, 255)',
				'quick_view_button_border_color'         => 'rgba(255, 255, 255, 0)',
				'quick_view_button_border_color_hover'   => 'rgba(255, 255, 255, 0)',
				'quick_view_button_border_width'         => 0,
				'quick_view_button_border_width_hover'   => 0,
				'quick_view_button_border_style'         => 'solid',
				'quick_view_button_border_radius'        => 4,

				// Modal box.
				'modal_box_overlay_background_color'     => 'rgba(0, 0, 0, 0.8)',
				'modal_box_background_color'             => 'rgba(255, 255, 255, 1)',
				'modal_box_general_text_color'           => 'rgba(51, 51, 51, 1)',
				'modal_box_inputs_background_color'      => 'rgba(255, 255, 255, 1)',
				'modal_box_inputs_text_color'            => 'rgba(51, 51, 51, 1)',
				'modal_box_general_border_color'         => 'rgba(238, 238, 238, 1)', // since 1.2.8.
				'modal_box_spinner_icon_color'           => 'rgba(51, 51, 51, 1)',

				// WC Gallery.
				'wc_gallery_trigger_icon_color'          => '#9F9F9F', // since 1.2.8.
				'wc_gallery_trigger_icon_hover_color'    => 'rgba(54, 91, 255)', // since 1.2.8.
				'wc_gallery_trigger_icon_bg_color'       => 'rgba(255, 255, 255, 1)', // since 1.2.8.
				'wc_gallery_trigger_icon_bg_hover_color' => 'rgba(255, 255, 255, 1)', // since 1.2.8.
				'wc_gallery_image_border_color'          => 'rgba(238, 238, 238, 1)', // since 1.2.8.

				'product_title_color'                    => 'rgba(51, 51, 51, 1)',
				'product_rating_star_empty_color'        => 'rgba(147, 147, 147, 1)',
				'product_rating_star_filled_color'       => 'rgba(245, 196, 14, 1)',
				'product_price_color'                    => 'rgba(51, 51, 51, 1)',
				'product_on_sale_price_color'            => 'rgba(255, 0, 0, 1)',
				'product_excerpt_text_color'             => 'rgba(88, 88, 88, 1)',
				'product_meta_text_color'                => 'rgba(2, 134, 231, 1)',
				'product_meta_text_hover_color'          => 'rgba(88, 88, 88, 1)',
				'modal_close_button_text_color'          => 'rgba(118, 118, 118, 1)',
				'modal_close_button_text_hover_color'    => 'rgba(2, 134, 231, 1)',
				'modal_close_button_background_color'    => 'rgba(238, 238, 238, 1)',
				'modal_close_button_background_hover_color' => 'rgba(182, 222, 255, 1)',
				'mobile_close_button_font_size'          => 14, // since 1.2.8.
				'modal_misc_buttons_font_size'           => 15, // since 1.2.8.
				'modal_misc_buttons_font_weight'         => '400', // since 1.2.8.
				'modal_misc_buttons_letter_spacing'      => 0, // since 1.2.8.
				'modal_misc_buttons_line_height'         => 1, // since 1.2.8.
				'modal_misc_buttons_text_transform'      => 'capitalize', // since 1.2.8.
				'modal_misc_buttons_height'              => 50, // since 1.2.8.
				'modal_misc_buttons_border_radius'       => 4, // since 1.2.8.
				'modal_misc_buttons_text_color'          => 'rgba(255, 255, 255, 1)',
				'modal_misc_buttons_text_hover_color'    => 'rgba(255, 255, 255, 1)',
				'modal_misc_buttons_background_color'    => 'rgba(51, 51, 51, 1)',
				'modal_misc_buttons_background_hover_color' => 'rgba(2, 134, 231, 1)',

				// Custom CSS.
				'custom_css'                             => '',

				'delete_plugin_data_on_deactivation'     => false, // since 1.2.17.
			)
		);
	}
}
