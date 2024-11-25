<?php
/**
 * Return product option fields.
 *
 * @since 1.0.0.
 * @package addonify_quick_view.
 */

if ( ! function_exists( 'addonify_quick_view_product_section' ) ) {
	/**
	 * Function to return product control fields.
	 *
	 * @param array $sections section fields.
	 */
	function addonify_quick_view_product_section( $sections ) {

		$sections['product_options'] = array(
			'title'        => esc_html__( 'Product Options', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_product_option_fields(),
		);

		$sections['product_content_options'] = array(
			'title'        => esc_html__( 'Product Content Options', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_product_content_option_fields(),
		);

		$sections['product_styles_options'] = array(
			'title'        => esc_html__( 'Product Options Styles', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_product_option_styles_fields(),
		);
		return $sections;
	}
	add_filter( 'addonify_quick_view_product_sections', 'addonify_quick_view_product_section' );
}

if ( ! function_exists( 'addonify_quick_view_product_option_fields' ) ) {
	/**
	 * Function to return product options fields.
	 */
	function addonify_quick_view_product_option_fields() {
		return apply_filters(
			'addonify_quick_view_product_option_fields',
			array(
				'product_thumbnail'        => array(
					'label'       => esc_html__( 'Product Thumbnail', 'addonify-quick-view' ),
					'type'        => 'select',
					'placeholder' => esc_html__( 'Choose option', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'choices'     => array(
						'product_image_only'       => esc_html__( 'Product Image only', 'addonify-quick-view' ),
						'product_image_or_gallery' => esc_html__( 'Product Image or Gallery', 'addonify-quick-view' ),
					),
				),
				'enable_lightbox'          => array(
					'label'       => esc_html__( 'Enable Lightbox', 'addonify-quick-view' ),
					'description' => esc_html__( 'May not work with all the themes.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
				'display_read_more_button' => array(
					'type'        => 'switch',
					'label'       => esc_html__( 'Display view detail button', 'addonify-quick-view' ),
					'description' => esc_html__( 'Enable to display link to product single page button', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
				),
				'read_more_button_label'   => array(
					'type'        => 'text',
					'label'       => esc_html__( 'View detail button label', 'addonify-quick-view' ),
					'placeholder' => esc_html__( 'View Detail', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view', 'display_read_more_button' ),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_product_content_option_fields' ) ) {
	/**
	 * Function to return product ccontent options fields.
	 */
	function addonify_quick_view_product_content_option_fields() {
		return apply_filters(
			'addonify_quick_view_product_content_option_fields',
			array(
				'product_title_color'              => array(
					'label' => esc_html__( 'Title text', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_product_title_font_size'    => array(
					'label'       => esc_html__( 'Title font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '32', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 14,
					'max'         => 42,
					'step'        => 2,
				),
				'modal_product_title_font_weight'  => array(
					'label'   => esc_html__( 'Title font weight', 'addonify-quick-view' ),
					'type'    => 'select',
					'choices' => array(
						'400' => esc_html__( 'Normal', 'addonify-quick-view' ),
						'500' => esc_html__( 'Medium', 'addonify-quick-view' ),
						'600' => esc_html__( 'Semi bold', 'addonify-quick-view' ),
						'700' => esc_html__( 'Bold', 'addonify-quick-view' ),
					),
				),
				'modal_product_title_line_height'  => array(
					'label'       => esc_html__( 'Title line height (unit: em)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '1.2', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 1,
					'max'         => 3,
					'step'        => 0.1,
					'precision'   => 2,
				),
				'product_price_color'              => array(
					'label' => esc_html__( 'Regular price', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'product_on_sale_price_color'      => array(
					'label' => esc_html__( 'Sale price', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_product_price_font_size'    => array(
					'label'       => esc_html__( 'Price font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '22', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 13,
					'max'         => 32,
					'step'        => 1,
				),
				'modal_product_price_font_weight'  => array(
					'label'   => esc_html__( 'Price font weight', 'addonify-quick-view' ),
					'type'    => 'select',
					'choices' => array(
						'400' => esc_html__( 'Normal', 'addonify-quick-view' ),
						'500' => esc_html__( 'Medium', 'addonify-quick-view' ),
						'600' => esc_html__( 'Semi bold', 'addonify-quick-view' ),
						'700' => esc_html__( 'Bold', 'addonify-quick-view' ),
					),
				),
				'modal_on_sale_badge_font_size'    => array(
					'label'       => esc_html__( 'Sale badge font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '14', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 11,
					'max'         => 20,
					'step'        => 1,
				),
				'product_rating_star_empty_color'  => array(
					'label' => esc_html__( 'Rating star empty', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'product_rating_star_filled_color' => array(
					'label' => esc_html__( 'Rating star filled', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'product_excerpt_text_color'       => array(
					'label' => esc_html__( 'Excerpt text', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'product_meta_text_color'          => array(
					'label' => esc_html__( 'Meta text', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'product_meta_text_hover_color'    => array(
					'label' => esc_html__( 'Meta text on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
			),
		);
	}
}

if ( ! function_exists( 'addonify_quick_view_product_option_styles_fields' ) ) {
	/**
	 * Function to return product options fields.
	 */
	function addonify_quick_view_product_option_styles_fields() {
		return apply_filters(
			'addonify_quick_view_product_option_styles_fields',
			array(
				'modal_image_radius'                     => array(
					'label'       => esc_html__( 'Modal image border radius (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '10', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
				),
				'modal_gallery_thumbs_columns'           => array(
					'label'       => esc_html__( 'Gallery thumbnail items row', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '4', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'slider',
					'min'         => 1,
					'max'         => 8,
					'step'        => 1,
					'unit'        => esc_html__( 'items', 'addonify-quick-view' ),
				),
				'modal_gallery_thumbs_columns_gap'       => array(
					'label'  => esc_html__( 'Gallery thumbnail column gap (unit: px)', 'addonify-quick-view' ),
					'type'   => 'number',
					'design' => 'slider',
					'min'    => 0,
					'max'    => 50,
					'step'   => 1,
					'unit'   => esc_html__( 'px', 'addonify-quick-view' ),
				),
				'wc_gallery_trigger_icon_color'          => array(
					'label' => esc_html__( 'Gallery trigger button color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'wc_gallery_trigger_icon_hover_color'    => array(
					'label' => esc_html__( 'Gallery trigger button color on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'wc_gallery_trigger_icon_bg_color'       => array(
					'label' => esc_html__( 'Gallery trigger button background color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'wc_gallery_trigger_icon_bg_hover_color' => array(
					'label' => esc_html__( 'Gallery trigger button background color on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'wc_gallery_image_border_color'          => array(
					'label' => esc_html__( 'Gallery image border color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'wc_gallery_trigger_icon_size'           => array(
					'label'       => esc_html__( 'Gallery trigger icon font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '18', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 12,
					'max'         => 32,
					'step'        => 2,
				),
				'wc_gallery_trigger_icon_border_radius'  => array(
					'label'       => esc_html__( 'Gallery trigger icon border radius (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '10', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 0,
					'max'         => 100,
					'step'        => 2,
				),
			)
		);
	}
}
