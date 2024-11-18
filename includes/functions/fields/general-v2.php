<?php
/**
 * Return general option fields.
 *
 * @since 1.0.0.
 * @package addonify_quick_view.
 */

if ( ! function_exists( 'addonify_quick_view_general_tab_general_section' ) ) {
	/**
	 * Function to return general fields.
	 *
	 * @param array $sections section fields.
	 */
	function addonify_quick_view_general_tab_general_section( $sections ) {

		$sections['general_options'] = array(
			'title'        => esc_html__( 'General', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_general_fields(),
		);

		$sections['style_options'] = array(
			'title'        => esc_html__( 'Custom CSS', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_general_styles_fields(),
		);

		return $sections;
	}

	add_filter( 'addonify_quick_view_general_sections', 'addonify_quick_view_general_tab_general_section' );
}

if ( ! function_exists( 'addonify_quick_view_general_fields' ) ) {
	/**
	 * Function to return general fields.
	 */
	function addonify_quick_view_general_fields() {
		return apply_filters(
			'addonify_quick_view_general_fields',
			array(
				'enable_quick_view'                   => array(
					'label'       => esc_html__( 'Enable quick view', 'addonify-quick-view' ),
					'description' => esc_html__( 'If disabled, quick view features will be disabled completely.', 'addonify-quick-view' ),
					'type'        => 'switch',
					'value'       => addonify_quick_view_get_option( 'enable_quick_view' ),
				),
				'disable_quick_view_on_mobile_device' => array(
					'label'       => esc_html__( 'Disable on mobile devices', 'addonify-quick-view' ),
					'description' => esc_html__( 'If enabled, quick view will be disabled on mobile devices.', 'addonify-quick-view' ),
					'type'        => 'switch',
					'value'       => addonify_quick_view_get_option( 'disable_quick_view_on_mobile_device' ),
				),
			)
		);
	}
}

if ( ! function_exists( 'addonify_quick_view_general_styles_fields' ) ) {
	/**
	 * Function to return general styles fields.
	 */
	function addonify_quick_view_general_styles_fields() {
		return apply_filters(
			'addonify_quick_view_general_styles_fields',
			array(
				'custom_css' => array(
					'label'       => esc_html__( 'Additional CSS', 'addonify-quick-view' ),
					'description' => esc_html__( 'If necessary, you can add your own custom CSS code from here.', 'addonify-quick-view' ),
					'type'        => 'textarea',
					'width'       => 'full',
					'placeholder' => '#app { color: blue; }',
					'value'       => addonify_quick_view_get_option( 'custom_css' ),
				),
			)
		);
	}
}
