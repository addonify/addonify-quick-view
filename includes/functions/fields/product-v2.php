<?php

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
				'product_thumbnail' => array(
					'label'       => esc_html__( 'Product Thumbnail', 'addonify-quick-view' ),
					'type'        => 'select',
					'placeholder' => esc_html__( 'Choose option', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'choices'     => array(
						'product_image_only'       => esc_html__( 'Product Image only', 'addonify-quick-view' ),
						'product_image_or_gallery' => esc_html__( 'Product Image or Gallery', 'addonify-quick-view' ),
					),
				),
			)
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
