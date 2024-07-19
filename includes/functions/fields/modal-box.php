<?php
/**
 * Define settings fields for quick view modal.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes/functions/fields
 */

if ( ! function_exists( 'addonify_quick_view_modal_box_content_settings_fields' ) ) {
	/**
	 * General setting fields for quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_modal_box_content_settings_fields() {

		$setting_fields = array_merge(
			addonify_quick_view_modal_content_setting_fields(),
			addonify_quick_view_modal_close_setting_fields(),
			addonify_quick_view_modal_animation_setting_fields(),
			addonify_quick_view_product_page_link_setting_fields(),
			addonify_quick_view_content_loader_setting_fields()
		);

		return apply_filters(
			'addonify_quick_view_modal_box_content_setting_fields',
			$setting_fields
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_modal_content_setting_fields' ) ) {
	/**
	 * Modal content setting fields for quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_modal_content_setting_fields() {

		return apply_filters(
			'addonify_quick_view_modal_content_setting_fields',
			array(
				'modal_box_content'           => array(
					'label'       => esc_html__( 'Content to Display', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose content that you want to display in quick view modal box.', 'addonify-quick-view' ),
					'type'        => 'checkbox',
					'typeStyle'   => 'buttons',
					'className'   => 'fullwidth',
					'dependent'   => array( 'enable_quick_view' ),
					'choices'     => array(
						'image'       => esc_html__( 'Image', 'addonify-quick-view' ),
						'title'       => esc_html__( 'Title', 'addonify-quick-view' ),
						'price'       => esc_html__( 'Price', 'addonify-quick-view' ),
						'rating'      => esc_html__( 'Rating', 'addonify-quick-view' ),
						'excerpt'     => esc_html__( 'Excerpt', 'addonify-quick-view' ),
						'meta'        => esc_html__( 'Meta', 'addonify-quick-view' ),
						'add_to_cart' => esc_html__( 'Add to Cart', 'addonify-quick-view' ),
					),
				),
				'modal_content_column_layout' => array(
					'label'       => esc_html__( 'Content column layout inside modal', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose how content column should appear inside the modal box.', 'addonify-quick-view' ),
					'type'        => 'radio',
					'style'       => 'images',
					'className'   => 'fullwidth',
					'dependent'   => array( 'enable_quick_view' ),
					'choices'     => array(
						'default'      => esc_html__( 'Default', 'addonify-quick-view' ),
						'row-reversed' => esc_html__( 'Row reversed', 'addonify-quick-view' ),
					),
				),
				'modal_content_column_gap'    => array(
					'label'       => esc_html__( 'Modal content column gap', 'addonify-quick-view' ),
					'description' => esc_html__( 'Specify the gap for the modal content inner column in px.', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '40', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 0,
					'max'         => 150,
					'step'        => 5,
					'dependent'   => array( 'enable_quick_view' ),
				),
				'product_thumbnail'           => array(
					'label'       => esc_html__( 'Product Thumbnail', 'addonify-quick-view' ),
					'type'        => 'select',
					'placeholder' => esc_html__( 'Choose option', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'choices'     => array(
						'product_image_only'       => esc_html__( 'Product Image only', 'addonify-quick-view' ),
						'product_image_or_gallery' => esc_html__( 'Product Image or Gallery', 'addonify-quick-view' ),
					),
				),
				'enable_lightbox'             => array(
					'label'       => esc_html__( 'Enable Lightbox', 'addonify-quick-view' ),
					'description' => esc_html__( 'May not work with all the themes.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_modal_close_setting_fields' ) ) {
	/**
	 * Modal close setting fields for quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_modal_close_setting_fields() {

		return apply_filters(
			'addonify_quick_view_modal_close_setting_fields',
			array(
				'hide_modal_close_button'          => array(
					'label'       => esc_html__( 'Hide modal close button', 'addonify-quick-view' ),
					'description' => esc_html__( 'If enabled, close button will be hidden for all media screen except mobile device.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
				'close_modal_when_esc_pressed'     => array(
					'label'       => esc_html__( 'Close modal if ESC key is pressed', 'addonify-quick-view' ),
					'description' => esc_html__( 'Enable to close modal if ESC key is pressed on keyboard.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
				'close_modal_when_clicked_outside' => array(
					'label'       => esc_html__( 'Close modal if clicked outside', 'addonify-quick-view' ),
					'description' => esc_html__( 'Enable to close modal if clicked outside of modal box.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
				'mobile_close_button_label'        => array(
					'label'       => esc_html__( 'Close button label on mobile device', 'addonify-quick-view' ),
					'description' => esc_html__( 'Check docs to learn about mobile close button.', 'addonify-quick-view' ),
					'type'        => 'text',
					'placeholder' => esc_html__( 'Close', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_modal_animation_setting_fields' ) ) {
	/**
	 * Modal animation setting fields for quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_modal_animation_setting_fields() {

		return apply_filters(
			'addonify_quick_view_modal_animation_setting_fields',
			array(
				'modal_opening_animation' => array(
					'label'       => esc_html__( 'Modal opening animation', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose animation effect when modal opens.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'select',
					'choices'     => array(
						'none'           => esc_html__( 'None', 'addonify-quick-view' ),
						'fade-in'        => esc_html__( 'Fade in', 'addonify-quick-view' ),
						'fade-in-up'     => esc_html__( 'Fade in from up', 'addonify-quick-view' ),
						'bounce-in'      => esc_html__( 'Bounce in', 'addonify-quick-view' ),
						'slide-in-left'  => esc_html__( 'Slide in from left', 'addonify-quick-view' ),
						'slide-in-right' => esc_html__( 'Slide in from right', 'addonify-quick-view' ),
						'zoom-in'        => esc_html__( 'Zoom in', 'addonify-quick-view' ),
						'swing'          => esc_html__( 'Swing effect', 'addonify-quick-view' ),
						'jello'          => esc_html__( 'Jello effect', 'addonify-quick-view' ),
						'rubber-band'    => esc_html__( 'Rubber band effect', 'addonify-quick-view' ),
					),
				),
				'modal_closing_animation' => array(
					'label'       => esc_html__( 'Modal closing animation', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose animation effect when modal close.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'select',
					'choices'     => array(
						'none'            => esc_html__( 'None', 'addonify-quick-view' ),
						'fade-out'        => esc_html__( 'Fade out', 'addonify-quick-view' ),
						'fade-out-down'   => esc_html__( 'Fade out down', 'addonify-quick-view' ),
						'bounce-out'      => esc_html__( 'Bounce out', 'addonify-quick-view' ),
						'slide-out-left'  => esc_html__( 'Slide out to left', 'addonify-quick-view' ),
						'slide-out-right' => esc_html__( 'Slide out to right', 'addonify-quick-view' ),
						'zoom-out'        => esc_html__( 'Zoom out', 'addonify-quick-view' ),
					),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_product_page_link_setting_fields' ) ) {
	/**
	 * Product page link setting fields for quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_product_page_link_setting_fields() {

		return apply_filters(
			'addonify_quick_view_product_page_link_setting_fields',
			array(
				'display_read_more_button' => array(
					'label'       => esc_html__( 'Display View Detail Button', 'addonify-quick-view' ),
					'description' => esc_html__( 'Enable to display link to product single page button', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
				'read_more_button_label'   => array(
					'label'       => esc_html__( 'View Detail Button Label', 'addonify-quick-view' ),
					'placeholder' => esc_html__( 'View Detail', 'addonify-quick-view' ),
					'type'        => 'text',
					'dependent'   => array( 'enable_quick_view', 'display_read_more_button' ),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_content_loader_setting_fields' ) ) {
	/**
	 * Modal content loader setting fields for quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_content_loader_setting_fields() {

		return apply_filters(
			'addonify_quick_view_content_loader_setting_fields',
			array(
				'spinner_icons' => array(
					'label'       => esc_html__( 'Spinner icon', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose modal box loading spinner icon', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'radio-icons',
					'className'   => 'fullwidth',
					'choices'     => addonify_quick_view_get_spinner_icon( 'all' ),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_modal_box_styles_settings_fields' ) ) {
	/**
	 * General style setting fields for quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_modal_box_styles_settings_fields() {

		return apply_filters(
			'addonify_quick_view_modal_box_style_fields',
			array(
				'modal_general_text_font_size'           => array(
					'label'       => esc_html__( 'General text font size inside modal box', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '28', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 13,
					'max'         => 32,
					'step'        => 1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_zindex'                           => array(
					'label'       => esc_html__( 'Modal CSS z-index', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '10000000000000000', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-arrows',
					'min'         => 0,
					'max'         => 1000000000000000000,
					'step'        => 10,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_border_radius'                    => array(
					'label'       => esc_html__( 'Modal border radius (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '10', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_box_overlay_background_color'     => array(
					'label'     => esc_html__( 'Modal overlay background', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_box_background_color'             => array(
					'label'     => esc_html__( 'Modal box inner background', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_box_general_text_color'           => array(
					'label'     => esc_html__( 'Text color inside modal box', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_box_general_border_color'         => array(
					'label'     => esc_html__( 'General border color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_box_inputs_background_color'      => array(
					'label'     => esc_html__( 'Input fields background color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_box_inputs_text_color'            => array(
					'label'     => esc_html__( 'Input fields text color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_box_spinner_icon_color'           => array(
					'label'     => esc_html__( 'Modal box spinner icon color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'spinner_size'                           => array(
					'label'       => esc_html__( 'Spinner icon font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '28', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 14,
					'max'         => 100,
					'step'        => 2,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_image_radius'                     => array(
					'label'       => esc_html__( 'Modal image border radius (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '10', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_gallery_thumbs_columns'           => array(
					'label'       => esc_html__( 'Gallery thumbnail items row', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '4', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'slider',
					'min'         => 1,
					'max'         => 8,
					'step'        => 1,
					'unit'        => esc_html__( 'items', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_gallery_thumbs_columns_gap'       => array(
					'label'     => esc_html__( 'Gallery thumbnail column gap (unit: px)', 'addonify-quick-view' ),
					'type'      => 'number',
					'style'     => 'slider',
					'min'       => 0,
					'max'       => 50,
					'step'      => 1,
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'wc_gallery_trigger_icon_color'          => array(
					'label'     => esc_html__( 'Gallery trigger button color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'wc_gallery_trigger_icon_hover_color'    => array(
					'label'     => esc_html__( 'Gallery trigger button color on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'wc_gallery_trigger_icon_bg_color'       => array(
					'label'     => esc_html__( 'Gallery trigger button background color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'wc_gallery_trigger_icon_bg_hover_color' => array(
					'label'     => esc_html__( 'Gallery trigger button background color on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'wc_gallery_image_border_color'          => array(
					'label'     => esc_html__( 'Gallery image border color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'wc_gallery_trigger_icon_size'           => array(
					'label'       => esc_html__( 'Gallery trigger icon font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '18', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 12,
					'max'         => 32,
					'step'        => 2,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'wc_gallery_trigger_icon_border_radius'  => array(
					'label'       => esc_html__( 'Gallery trigger icon border radius (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '10', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 0,
					'max'         => 100,
					'step'        => 2,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_modal_box_content_styles_settings_fields' ) ) {
	/**
	 * General setting fields for contents inside quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_modal_box_content_styles_settings_fields() {

		return apply_filters(
			'addonify_quick_view_modal_box_content_style_fields',
			array(
				'product_title_color'              => array(
					'label'     => esc_html__( 'Title text', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_product_title_font_size'    => array(
					'label'       => esc_html__( 'Title font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '32', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 14,
					'max'         => 42,
					'step'        => 2,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_product_title_font_weight'  => array(
					'label'     => esc_html__( 'Title font weight', 'addonify-quick-view' ),
					'type'      => 'select',
					'choices'   => array(
						'400' => esc_html__( 'Normal', 'addonify-quick-view' ),
						'500' => esc_html__( 'Medium', 'addonify-quick-view' ),
						'600' => esc_html__( 'Semi bold', 'addonify-quick-view' ),
						'700' => esc_html__( 'Bold', 'addonify-quick-view' ),
					),
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_product_title_line_height'  => array(
					'label'       => esc_html__( 'Title line height (unit: em)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '1.2', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 1,
					'max'         => 3,
					'step'        => 0.1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'product_price_color'              => array(
					'label'     => esc_html__( 'Regular price', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_product_price_font_size'    => array(
					'label'       => esc_html__( 'Price font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '22', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 13,
					'max'         => 32,
					'step'        => 1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_product_price_font_weight'  => array(
					'label'     => esc_html__( 'Price font weight', 'addonify-quick-view' ),
					'type'      => 'select',
					'choices'   => array(
						'400' => esc_html__( 'Normal', 'addonify-quick-view' ),
						'500' => esc_html__( 'Medium', 'addonify-quick-view' ),
						'600' => esc_html__( 'Semi bold', 'addonify-quick-view' ),
						'700' => esc_html__( 'Bold', 'addonify-quick-view' ),
					),
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'product_on_sale_price_color'      => array(
					'label'     => esc_html__( 'On-sale price', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_on_sale_badge_font_size'    => array(
					'label'       => esc_html__( 'Sale badge font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '14', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 11,
					'max'         => 20,
					'step'        => 1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'product_rating_star_empty_color'  => array(
					'label'     => esc_html__( 'Rating star empty', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'product_rating_star_filled_color' => array(
					'label'     => esc_html__( 'Rating star filled', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'product_excerpt_text_color'       => array(
					'label'       => esc_html__( 'Excerpt text', 'addonify-quick-view' ),
					'description' => '',
					'type'        => 'color',
					'isAlpha'     => true,
					'className'   => 'fullwidth',
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'product_meta_text_color'          => array(
					'label'     => esc_html__( 'Meta text', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'product_meta_text_hover_color'    => array(
					'label'     => esc_html__( 'Meta text on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_modal_box_close_button_styles_settings_fields' ) ) {
	/**
	 * General setting fields for quick view modal close button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_modal_box_close_button_styles_settings_fields() {

		return apply_filters(
			'addonify_quick_view_modal_box_close_button_style_fields',
			array(
				'modal_close_button_text_color'       => array(
					'label'     => esc_html__( 'Icon color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_close_button_text_hover_color' => array(
					'label'     => esc_html__( 'Icon color on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_close_button_background_color' => array(
					'label'     => esc_html__( 'Icon background color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_close_button_background_hover_color' => array(
					'label'     => esc_html__( 'Icon background color hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'mobile_close_button_font_size'       => array(
					'label'     => esc_html__( 'Mobile close button font size (unit: px)', 'addonify-quick-view' ),
					'type'      => 'number',
					'style'     => 'buttons-plus-minus',
					'min'       => 12,
					'max'       => 18,
					'step'      => 1,
					'dependent' => array( 'enable_plugin_styles' ),
				),
			)
		);
	}
}

if ( ! function_exists( 'addonify_quick_view_modal_box_add_to_settings_fields' ) ) {
	/**
	 * Add quick view modal box settings into settings fields.
	 *
	 * @param array $settings_fields Array of setting fields.
	 * @return array
	 */
	function addonify_quick_view_modal_box_add_to_settings_fields( $settings_fields ) {

		return array_merge(
			$settings_fields,
			addonify_quick_view_modal_box_content_settings_fields(),
			addonify_quick_view_modal_box_styles_settings_fields(),
			addonify_quick_view_modal_box_content_styles_settings_fields(),
			addonify_quick_view_modal_box_close_button_styles_settings_fields(),
		);
	}

	add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_modal_box_add_to_settings_fields' );
}
