<?php
/**
 * Define style settings fields for buttons in quick view modal.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes/functions/fields
 */

if ( ! function_exists( 'addonify_quick_view_misc_button_styles_settings_fields' ) ) {
	/**
	 * General style setting fields for buttons in quick view modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_quick_view_misc_button_styles_settings_fields() {

		return apply_filters(
			'addonify_quick_view_misc_button_style_fields',
			array(
				'modal_misc_buttons_text_color'       => array(
					'label'     => esc_html__( 'Text color', 'addonify-quick-view' ),
					'type'      => 'color',
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_text_hover_color' => array(
					'label'     => esc_html__( 'Text color on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_background_color' => array(
					'label'     => esc_html__( 'Background color', 'addonify-quick-view' ),
					'type'      => 'color',
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_background_hover_color' => array(
					'label'     => esc_html__( 'Background on hover', 'addonify-quick-view' ),
					'type'      => 'color',
					'className' => 'fullwidth',
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_font_size'        => array(
					'label'       => esc_html__( 'Font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '15', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 10,
					'max'         => 24,
					'step'        => 1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_font_weight'      => array(
					'label'     => esc_html__( 'Font weight', 'addonify-quick-view' ),
					'type'      => 'select',
					'choices'   => array(
						'400' => __( 'Normal', 'addonify-quick-view' ),
						'500' => __( 'Medium', 'addonify-quick-view' ),
						'600' => __( 'Semi bold', 'addonify-quick-view' ),
						'700' => __( 'Bold', 'addonify-quick-view' ),
					),
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_text_transform'   => array(
					'label'     => esc_html__( 'Text transform', 'addonify-quick-view' ),
					'type'      => 'select',
					'choices'   => array(
						'default'    => esc_html__( 'Default', 'addonify-quick-view' ),
						'capitalize' => esc_html__( 'Capitalize', 'addonify-quick-view' ),
						'lowercase'  => esc_html__( 'Lowercase', 'addonify-quick-view' ),
						'uppercase'  => esc_html__( 'Uppercase', 'addonify-quick-view' ),
					),
					'dependent' => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_letter_spacing'   => array(
					'label'       => esc_html__( 'Letter spacing (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '0', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 0,
					'max'         => 10,
					'step'        => 0.1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_line_height'      => array(
					'label'       => esc_html__( 'Line height (unit: em)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '1', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 1,
					'max'         => 3,
					'step'        => 0.1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_height'           => array(
					'label'       => esc_html__( 'Height (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '50', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 30,
					'max'         => 100,
					'step'        => 1,
					'dependent'   => array( 'enable_plugin_styles' ),
				),
				'modal_misc_buttons_border_radius'    => array(
					'label'       => esc_html__( 'Border radius (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '5', 'addonify-quick-view' ),
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

if ( ! function_exists( 'addonify_quick_view_misc_button_add_to_settings_fields' ) ) {
	/**
	 * Add miscellaneous button settings into settings fields.
	 *
	 * @param array $settings_fields Array of setting fields.
	 * @return array
	 */
	function addonify_quick_view_misc_button_add_to_settings_fields( $settings_fields ) {

		return array_merge( $settings_fields, addonify_quick_view_misc_button_styles_settings_fields() );
	}

	add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_misc_button_add_to_settings_fields' );
}
