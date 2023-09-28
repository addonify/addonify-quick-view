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
	 * General setting fields for quick view modl.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_modal_box_content_settings_fields() {

		return array(
			'modal_box_content'                => array(
				'label'       => __( 'Content to Display', 'addonify-quick-view' ),
				'description' => __( 'Choose content that you want to display in quick view modal box.', 'addonify-quick-view' ),
				'type'        => 'checkbox',
				'typeStyle'   => 'buttons',
				'className'   => 'fullwidth',
				'dependent'   => array( 'enable_quick_view' ),
				'choices'     => array(
					'image'       => __( 'Image', 'addonify-quick-view' ),
					'title'       => __( 'Title', 'addonify-quick-view' ),
					'price'       => __( 'Price', 'addonify-quick-view' ),
					'rating'      => __( 'Rating', 'addonify-quick-view' ),
					'excerpt'     => __( 'Excerpt', 'addonify-quick-view' ),
					'meta'        => __( 'Meta', 'addonify-quick-view' ),
					'add_to_cart' => __( 'Add to Cart', 'addonify-quick-view' ),
				),
			),
			'modal_content_column_layout'      => array(
				'label'       => __( 'Content column layout inside modal', 'addonify-quick-view' ),
				'description' => __( 'Choose how content column should appear inside the modal box.', 'addonify-quick-view' ),
				'type'        => 'radio',
				'style'       => 'images',
				'className'   => 'fullwidth',
				'dependent'   => array( 'enable_quick_view' ),
				'choices'     => array(
					'default'      => __( 'Default', 'addonify-quick-view' ),
					'row-reversed' => __( 'Row reversed', 'addonify-quick-view' ),
				),
			),
			'modal_content_column_gap'         => array(
				'label'       => __( 'Modal content column gap', 'addonify-quick-view' ),
				'description' => __( 'Specify the gap for the modal content inner column in px.', 'addonify-quick-view' ),
				'placeholder' => __( '40', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 0,
				'max'         => 150,
				'step'        => 5,
				'dependent'   => array( 'enable_quick_view' ),
			),
			'product_thumbnail'                => array(
				'label'       => __( 'Product Thumbnail', 'addonify-quick-view' ),
				'type'        => 'select',
				'placeholder' => __( 'Choose option', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'choices'     => array(
					'product_image_only'       => __( 'Product Image only', 'addonify-quick-view' ),
					'product_image_or_gallery' => __( 'Product Image or Gallery', 'addonify-quick-view' ),
				),
			),
			'enable_lightbox'                  => array(
				'label'       => __( 'Enable Lightbox', 'addonify-quick-view' ),
				'description' => __( 'May not work with all the themes.', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'type'        => 'switch',
			),
			'hide_modal_close_button'          => array(
				'label'       => __( 'Hide modal close button', 'addonify-quick-view' ),
				'description' => __( 'If enabled, close button will be hidden for all media screen except mobile device.', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'type'        => 'switch',
			),
			'close_modal_when_esc_pressed'     => array(
				'label'       => __( 'Close modal if ESC key is pressed', 'addonify-quick-view' ),
				'description' => __( 'Enable to close modal if ESC key is pressed on keyboard.', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'type'        => 'switch',
			),
			'close_modal_when_clicked_outside' => array(
				'label'       => __( 'Close modal if clicked outside', 'addonify-quick-view' ),
				'description' => __( 'Enable to close modal if clicked outside of modal box.', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'type'        => 'switch',
			),
			'mobile_close_button_label'        => array(
				'label'       => __( 'Close button label on mobile device', 'addonify-quick-view' ),
				'description' => __( 'Check docs to learn about mobile close button.', 'addonify-quick-view' ),
				'type'        => 'text',
				'placeholder' => __( 'Close', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
			),
			'modal_opening_animation'          => array(
				'label'       => __( 'Modal opening animation', 'addonify-quick-view' ),
				'description' => __( 'Choose animation effect when modal opens.', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'type'        => 'select',
				'choices'     => array(
					'none'           => __( 'None', 'addonify-quick-view' ),
					'fade-in'        => __( 'Fade in', 'addonify-quick-view' ),
					'fade-in-up'     => __( 'Fade in from up', 'addonify-quick-view' ),
					'bounce-in'      => __( 'Bounce in', 'addonify-quick-view' ),
					'slide-in-left'  => __( 'Slide in from left', 'addonify-quick-view' ),
					'slide-in-right' => __( 'Slide in from right', 'addonify-quick-view' ),
					'zoom-in'        => __( 'Zoom in', 'addonify-quick-view' ),
					'swing'          => __( 'Swing effect', 'addonify-quick-view' ),
					'jello'          => __( 'Jello effect', 'addonify-quick-view' ),
					'rubber-band'    => __( 'Rubber band effect', 'addonify-quick-view' ),
				),
			),
			'modal_closing_animation'          => array(
				'label'       => __( 'Modal closing animation', 'addonify-quick-view' ),
				'description' => __( 'Choose animation effect when modal close.', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'type'        => 'select',
				'choices'     => array(
					'none'            => __( 'None', 'addonify-quick-view' ),
					'fade-out'        => __( 'Fade out', 'addonify-quick-view' ),
					'fade-out-down'   => __( 'Fade out down', 'addonify-quick-view' ),
					'bounce-out'      => __( 'Bounce out', 'addonify-quick-view' ),
					'slide-out-left'  => __( 'Slide out to left', 'addonify-quick-view' ),
					'slide-out-right' => __( 'Slide out to right', 'addonify-quick-view' ),
					'zoom-out'        => __( 'Zoom out', 'addonify-quick-view' ),
				),
			),
			'display_read_more_button'         => array(
				'label'       => __( 'Display View Detail Button', 'addonify-quick-view' ),
				'description' => __( 'Enable to display link to product single page button', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'type'        => 'switch',
			),
			'read_more_button_label'           => array(
				'label'       => __( 'View Detail Button Label', 'addonify-quick-view' ),
				'placeholder' => __( 'View Detail', 'addonify-quick-view' ),
				'type'        => 'text',
				'dependent'   => array( 'enable_quick_view', 'display_read_more_button' ),
			),
			'spinner_icons'                    => array(
				'label'       => __( 'Spinner icon', 'addonify-quick-view' ),
				'description' => __( 'Choose modal box loading spinner icon', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_quick_view' ),
				'type'        => 'radio-icons',
				'className'   => 'fullwidth',
				'choices'     => addonify_quick_view_get_spinner_icon( 'all' ),
			),
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

		return array(
			'modal_general_text_font_size'           => array(
				'label'       => __( 'General text font size inside modal box', 'addonify-quick-view' ),
				'placeholder' => __( '28', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 13,
				'max'         => 32,
				'step'        => 1,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'modal_zindex'                           => array(
				'label'       => __( 'Modal CSS z-index', 'addonify-quick-view' ),
				'placeholder' => __( '10000000000000000', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-arrows',
				'min'         => 0,
				'max'         => 1000000000000000000,
				'step'        => 10,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'modal_border_radius'                    => array(
				'label'       => __( 'Modal border radius (unit: px)', 'addonify-quick-view' ),
				'placeholder' => __( '10', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'modal_box_overlay_background_color'     => array(
				'label'     => __( 'Modal overlay background', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_box_background_color'             => array(
				'label'     => __( 'Modal box inner background', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_box_general_text_color'           => array(
				'label'     => __( 'Text color inside modal box', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_box_general_border_color'         => array(
				'label'     => __( 'General border color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_box_inputs_background_color'      => array(
				'label'     => __( 'Input fields background color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_box_inputs_text_color'            => array(
				'label'     => __( 'Input fields text color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_box_spinner_icon_color'           => array(
				'label'     => __( 'Modal box spinner icon color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'spinner_size'                           => array(
				'label'       => __( 'Spinner icon font size (unit: px)', 'addonify-quick-view' ),
				'placeholder' => __( '28', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 14,
				'max'         => 100,
				'step'        => 2,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'modal_image_radius'                     => array(
				'label'       => __( 'Modal image border radius (unit: px)', 'addonify-quick-view' ),
				'placeholder' => __( '10', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'modal_gallery_thumbs_columns'           => array(
				'label'       => __( 'Gallery thumbnail items row', 'addonify-quick-view' ),
				'placeholder' => __( '4', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'slider',
				'min'         => 1,
				'max'         => 8,
				'step'        => 1,
				'unit'        => __( 'items', 'addonify-quick-view' ),
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'modal_gallery_thumbs_columns_gap'       => array(
				'label'     => __( 'Gallery thumbnail column gap (unit: px)', 'addonify-quick-view' ),
				'type'      => 'number',
				'style'     => 'slider',
				'min'       => 0,
				'max'       => 50,
				'step'      => 1,
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'wc_gallery_trigger_icon_color'          => array(
				'label'     => __( 'Gallery trigger button color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'wc_gallery_trigger_icon_hover_color'    => array(
				'label'     => __( 'Gallery trigger button color on hover', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'wc_gallery_trigger_icon_bg_color'       => array(
				'label'     => __( 'Gallery trigger button background color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'wc_gallery_trigger_icon_bg_hover_color' => array(
				'label'     => __( 'Gallery trigger button background color on hover', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'wc_gallery_image_border_color'          => array(
				'label'     => __( 'Gallery image border color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'wc_gallery_trigger_icon_size'           => array(
				'label'       => __( 'Gallery trigger icon font size (unit: px)', 'addonify-quick-view' ),
				'placeholder' => __( '18', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 12,
				'max'         => 32,
				'step'        => 2,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'wc_gallery_trigger_icon_border_radius'  => array(
				'label'       => __( 'Gallery trigger icon border radius (unit: px)', 'addonify-quick-view' ),
				'placeholder' => __( '10', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 0,
				'max'         => 100,
				'step'        => 2,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
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

		return array(
			'product_title_color'              => array(
				'label'     => __( 'Title text', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_product_title_font_size'    => array(
				'label'       => __( 'Title font size (unit: px)', 'addonify-quick-view' ),
				'placeholder' => __( '32', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 14,
				'max'         => 42,
				'step'        => 2,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'modal_product_title_font_weight'  => array(
				'label'     => __( 'Title font weight', 'addonify-quick-view' ),
				'type'      => 'select',
				'choices'   => array(
					'400' => __( 'Normal', 'addonify-quick-view' ),
					'500' => __( 'Medium', 'addonify-quick-view' ),
					'600' => __( 'Semi bold', 'addonify-quick-view' ),
					'700' => __( 'Bold', 'addonify-quick-view' ),
				),
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_product_title_line_height'  => array(
				'label'       => __( 'Title line height (unit: em)', 'addonify-quick-view' ),
				'placeholder' => __( '1.2', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 1,
				'max'         => 3,
				'step'        => 0.1,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'product_price_color'              => array(
				'label'     => __( 'Regular price', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_product_price_font_size'    => array(
				'label'       => __( 'Price font size (unit: px)', 'addonify-quick-view' ),
				'placeholder' => __( '22', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 13,
				'max'         => 32,
				'step'        => 1,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'modal_product_price_font_weight'  => array(
				'label'     => __( 'Price font weight', 'addonify-quick-view' ),
				'type'      => 'select',
				'choices'   => array(
					'400' => __( 'Normal', 'addonify-quick-view' ),
					'500' => __( 'Medium', 'addonify-quick-view' ),
					'600' => __( 'Semi bold', 'addonify-quick-view' ),
					'700' => __( 'Bold', 'addonify-quick-view' ),
				),
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'product_on_sale_price_color'      => array(
				'label'     => __( 'On-sale price', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_on_sale_badge_font_size'    => array(
				'label'       => __( 'Sale badge font size (unit: px)', 'addonify-quick-view' ),
				'placeholder' => __( '14', 'addonify-quick-view' ),
				'type'        => 'number',
				'style'       => 'buttons-plus-minus',
				'min'         => 11,
				'max'         => 20,
				'step'        => 1,
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'product_rating_star_empty_color'  => array(
				'label'     => __( 'Rating star empty', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'product_rating_star_filled_color' => array(
				'label'     => __( 'Rating star filled', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'product_excerpt_text_color'       => array(
				'label'       => __( 'Excerpt text', 'addonify-quick-view' ),
				'description' => '',
				'type'        => 'color',
				'isAlpha'     => true,
				'className'   => 'fullwidth',
				'dependent'   => array( 'enable_plugin_styles' ),
			),
			'product_meta_text_color'          => array(
				'label'     => __( 'Meta text', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'product_meta_text_hover_color'    => array(
				'label'     => __( 'Meta text on hover', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
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

		return array(
			'modal_close_button_text_color'             => array(
				'label'     => __( 'Icon color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_close_button_text_hover_color'       => array(
				'label'     => __( 'Icon color on hover', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_close_button_background_color'       => array(
				'label'     => __( 'Icon background color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'modal_close_button_background_hover_color' => array(
				'label'     => __( 'Icon background color hover', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'className' => 'fullwidth',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'mobile_close_button_font_size'             => array(
				'label'     => __( 'Mobile close button font size (unit: px)', 'addonify-quick-view' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 12,
				'max'       => 18,
				'step'      => 1,
				'dependent' => array( 'enable_plugin_styles' ),
			),
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

		$settings_fields = array_merge( $settings_fields, addonify_quick_view_modal_box_content_settings_fields() );

		$settings_fields = array_merge( $settings_fields, addonify_quick_view_modal_box_styles_settings_fields() );

		$settings_fields = array_merge( $settings_fields, addonify_quick_view_modal_box_content_styles_settings_fields() );

		$settings_fields = array_merge( $settings_fields, addonify_quick_view_modal_box_close_button_styles_settings_fields() );

		return $settings_fields;
	}

	add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_modal_box_add_to_settings_fields' );
}
