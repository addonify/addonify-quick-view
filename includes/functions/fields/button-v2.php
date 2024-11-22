<?php
/**
 * Return quick view button option fields.
 *
 * @since 1.0.0.
 * @package addonify_quick_view.
 */

if ( ! function_exists( 'addonify_quick_view_button_section' ) ) {
	/**
	 * Function to return quick view button control fields.
	 *
	 * @param array $sections section fields.
	 */
	function addonify_quick_view_button_section( $sections ) {

		$sections['button_options'] = array(
			'title'        => esc_html__( 'Button Options', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_button_fields(),
		);

		$sections['button_style_options'] = array(
			'title'        => esc_html__( 'Button Style Options', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_button_style_fields(),
		);

		return $sections;
	}

	add_filter( 'addonify_quick_view_button_sections', 'addonify_quick_view_button_section' );
}


if ( ! function_exists( 'addonify_quick_view_button_fields' ) ) {
	/**
	 * Function to return quick view button control fields.
	 */
	function addonify_quick_view_button_fields() {

		return apply_filters(
			'addonify_quick_view_button_fields',
			array(
				'quick_view_btn_position'      => array(
					'label'       => esc_html__( 'Button position', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose where you want to display the quick view button.', 'addonify-quick-view' ),
					'type'        => 'select',
					'placeholder' => esc_html__( 'Select position', 'addonify-quick-view' ),
					'choices'     => array(
						'after_add_to_cart_button'  => esc_html__( 'After Add to Cart Button', 'addonify-quick-view' ),
						'before_add_to_cart_button' => esc_html__( 'Before Add to Cart Button', 'addonify-quick-view' ),
						'over_image'                => esc_html__( 'Over Product Image', 'addonify-quick-view' ),
					),
				),
				'quick_view_btn_label'         => array(
					'label'       => esc_html__( 'Button label', 'addonify-quick-view' ),
					'placeholder' => esc_html__( 'Quick View', 'addonify-quick-view' ),
					'type'        => 'text',
				),
				'enable_quick_view_btn_icon'   => array(
					'label' => esc_html__( 'Enable icon in quick view button', 'addonify-quick-view' ),
					'type'  => 'switch',
				),
				'quick_view_btn_icon'          => array(
					'label'   => esc_html__( 'Quick view button icons', 'addonify-quick-view' ),
					'type'    => 'radio',
					'design'  => 'icons',
					'width'   => 'full',
					'choices' => addonify_quick_view_get_button_icons( 'all' ),
				),
				'quick_view_btn_icon_position' => array(
					'label'     => esc_html__( 'Quick view button icon position', 'addonify-quick-view' ),
					'type'      => 'select',
					'dependent' => array( 'enable_quick_view', 'enable_quick_view_btn_icon' ),
					'choices'   => array(
						'before_label' => esc_html__( 'Before Label', 'addonify-quick-view' ),
						'after_label'  => esc_html__( 'After Label', 'addonify-quick-view' ),
					),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_button_style_fields' ) ) {
	/**
	 * Function to return quick view button styles fields.
	 */
	function addonify_quick_view_button_style_fields() {

		return apply_filters(
			'addonify_quick_view_button_style_fields',
			array(
				'quick_view_button_text_color'         => array(
					'label' => esc_html__( 'Text color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'quick_view_button_text_color_hover'   => array(
					'label' => esc_html__( 'Text color on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'quick_view_button_bg_color'           => array(
					'label' => esc_html__( 'Background color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'quick_view_button_bg_color_hover'     => array(
					'label' => esc_html__( 'Background color on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'quick_view_button_border_style'       => array(
					'label'   => esc_html__( 'Border style', 'addonify-quick-view' ),
					'type'    => 'select',
					'choices' => addonify_quick_view_get_border_styles(),
				),
				'quick_view_button_border_width'       => array(
					'label' => esc_html__( 'Border width', 'addonify-quick-view' ),
					'type'  => 'number',
					'style' => 'slider',
					'min'   => 0,
					'max'   => 10,
					'step'  => 1,
					'unix'  => 'px',
				),
				'quick_view_button_border_radius'      => array(
					'label' => esc_html__( 'Border radius (unit: px)', 'addonify-quick-view' ),
					'type'  => 'number',
					'style' => 'plus-minus',
					'min'   => 0,
					'max'   => 100,
					'step'  => 2,
				),
				'quick_view_button_border_color'       => array(
					'label' => esc_html__( 'Border color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'quick_view_button_border_color_hover' => array(
					'label' => esc_html__( 'Border color on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
			)
		);
	}
}
