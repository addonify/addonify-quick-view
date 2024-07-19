<?php
/**
 * Define settings fields for quick view button displayed on product catalog.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes/functions/fields
 */

if ( ! function_exists( 'addonify_quick_view_button_settings_fields' ) ) {
	/**
	 * General setting fields for quick view button displayed on product cataglog.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_button_settings_fields() {

		return array(
			'quick_view_btn_position'      => array(
				'label'       => esc_html__( 'Button Position', 'addonify-quick-view' ),
				'description' => esc_html__( 'Choose where you want to display the quick view button.', 'addonify-quick-view' ),
				'type'        => 'select',
				'dependent'   => array( 'enable_quick_view' ),
				'placeholder' => esc_html__( 'Select Position', 'addonify-quick-view' ),
				'choices'     => array(
					'after_add_to_cart_button'  => esc_html__( 'After Add to Cart Button', 'addonify-quick-view' ),
					'before_add_to_cart_button' => esc_html__( 'Before Add to Cart Button', 'addonify-quick-view' ),
					'over_image'                => esc_html__( 'Over Product Image', 'addonify-quick-view' ),
				),
			),
			'quick_view_btn_label'         => array(
				'label'       => esc_html__( 'Button Label', 'addonify-quick-view' ),
				'placeholder' => esc_html__( 'Quick View', 'addonify-quick-view' ),
				'type'        => 'text',
				'dependent'   => array( 'enable_quick_view' ),
			),
			'enable_quick_view_btn_icon'   => array(
				'label'     => esc_html__( 'Enable icon in quick view button', 'addonify-quick-view' ),
				'type'      => 'switch',
				'dependent' => array( 'enable_quick_view' ),
			),
			'quick_view_btn_icon'          => array(
				'label'     => esc_html__( 'Quick view button icons', 'addonify-quick-view' ),
				'type'      => 'radio-icons',
				'className' => 'fullwidth',
				'dependent' => array( 'enable_quick_view', 'enable_quick_view_btn_icon' ),
				'choices'   => addonify_quick_view_get_button_icons( 'all' ),
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
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_button_styles_settings_fields' ) ) {
	/**
	 * General style setting fields for quick view button displayed on product cataglog.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_button_styles_settings_fields() {

		return apply_filters(
			'addonify_quick_view_button_style_fields',
			array(
				'quick_view_button_text_color'         => array(
					'label'     => esc_html__( 'Text color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'quick_view_button_text_color_hover'   => array(
					'label'     => esc_html__( 'Text color on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'quick_view_button_bg_color'           => array(
					'label'     => esc_html__( 'Background color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'quick_view_button_bg_color_hover'     => array(
					'label'     => esc_html__( 'Background color on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'quick_view_button_border_color'       => array(
					'label'     => esc_html__( 'Border color', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'quick_view_button_border_color_hover' => array(
					'label'     => esc_html__( 'Border color on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'isAlpha'   => true,
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'quick_view_button_border_width'       => array(
					'label'     => esc_html__( 'Border width', 'addonify-quick-view' ),
					'type'      => 'number',
					'style'     => 'slider',
					'min'       => 0,
					'max'       => 10,
					'step'      => 1,
					'unix'      => 'px',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'quick_view_button_border_style'       => array(
					'label'     => esc_html__( 'Border style', 'addonify-quick-view' ),
					'type'      => 'select',
					'choices'   => addonify_quick_view_get_border_styles(),
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'quick_view_button_border_radius'      => array(
					'label'     => esc_html__( 'Border radius (unit: px)', 'addonify-quick-view' ),
					'type'      => 'number',
					'style'     => 'buttons-plus-minus',
					'min'       => 0,
					'max'       => 100,
					'step'      => 2,
					'dependent' => array( 'enable_plugin_styles' ),
				),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_button_add_to_settings_field' ) ) {
	/**
	 * Add quick view button settings into settings fields.
	 *
	 * @param array $settings_fields Array of setting fields.
	 * @return array
	 */
	function addonify_quick_view_button_add_to_settings_field( $settings_fields ) {

		return array_merge(
			$settings_fields,
			addonify_quick_view_button_styles_settings_fields(),
			addonify_quick_view_button_settings_fields()
		);
	}

	add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_button_add_to_settings_field' );
}
