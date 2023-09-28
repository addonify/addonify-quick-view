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
				'label'       => __( 'Button Position', 'addonify-quick-view' ),
				'description' => __( 'Choose where you want to display the quick view button.', 'addonify-quick-view' ),
				'type'        => 'select',
				'dependent'   => array( 'enable_quick_view' ),
				'placeholder' => __( 'Select Position', 'addonify-quick-view' ),
				'choices'     => array(
					'after_add_to_cart_button'  => __( 'After Add to Cart Button', 'addonify-quick-view' ),
					'before_add_to_cart_button' => __( 'Before Add to Cart Button', 'addonify-quick-view' ),
				),
			),
			'quick_view_btn_label'         => array(
				'label'       => __( 'Button Label', 'addonify-quick-view' ),
				'placeholder' => __( 'Quick View', 'addonify-quick-view' ),
				'type'        => 'text',
				'dependent'   => array( 'enable_quick_view' ),
			),
			'enable_quick_view_btn_icon'   => array(
				'label'     => __( 'Enable icon in quick view button', 'addonify-quick-view' ),
				'type'      => 'switch',
				'dependent' => array( 'enable_quick_view' ),
			),
			'quick_view_btn_icon'          => array(
				'label'     => __( 'Quick view button icons', 'addonify-quick-view' ),
				'type'      => 'radio-icons',
				'className' => 'fullwidth',
				'dependent' => array( 'enable_quick_view', 'enable_quick_view_btn_icon' ),
				'choices'   => addonify_quick_view_get_button_icons( 'all' ),
			),
			'quick_view_btn_icon_position' => array(
				'label'     => __( 'Quick view button icon position', 'addonify-quick-view' ),
				'type'      => 'select',
				'dependent' => array( 'enable_quick_view', 'enable_quick_view_btn_icon' ),
				'choices'   => array(
					'before_label' => __( 'Before Label', 'addonify-quick-view' ),
					'after_label'  => __( 'After Label', 'addonify-quick-view' ),
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

		return array(
			'quick_view_button_text_color'         => array(
				'label'     => __( 'Text color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'quick_view_button_text_color_hover'   => array(
				'label'     => __( 'Text color on hover', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'quick_view_button_bg_color'           => array(
				'label'     => __( 'Background color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'quick_view_button_bg_color_hover'     => array(
				'label'     => __( 'Background color on hover', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'quick_view_button_border_color'       => array(
				'label'     => __( 'Border color', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'quick_view_button_border_color_hover' => array(
				'label'     => __( 'Border color on hover', 'addonify-quick-view' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'quick_view_button_border_width'       => array(
				'label'     => __( 'Border width', 'addonify-quick-view' ),
				'type'      => 'number',
				'style'     => 'slider',
				'min'       => 0,
				'max'       => 10,
				'step'      => 1,
				'unix'      => 'px',
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'quick_view_button_border_style'       => array(
				'label'     => __( 'Border style', 'addonify-quick-view' ),
				'type'      => 'select',
				'choices'   => array(
					'none'   => __( 'None', 'addonify-quick-view' ),
					'solid'  => __( 'Solid', 'addonify-quick-view' ),
					'dotted' => __( 'Dotted', 'addonify-quick-view' ),
					'dashed' => __( 'Dashed', 'addonify-quick-view' ),
					'double' => __( 'Double', 'addonify-quick-view' ),
				),
				'dependent' => array( 'enable_plugin_styles' ),
			),
			'quick_view_button_border_radius'      => array(
				'label'     => __( 'Border radius (unit: px)', 'addonify-quick-view' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 0,
				'max'       => 100,
				'step'      => 2,
				'dependent' => array( 'enable_plugin_styles' ),
			),
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

		$settings_fields = array_merge( $settings_fields, addonify_quick_view_button_styles_settings_fields() );

		$settings_fields = array_merge( $settings_fields, addonify_quick_view_button_settings_fields() );

		return $settings_fields;
	}

	add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_button_add_to_settings_field' );
}
