<?php

if ( ! function_exists( 'addonify_quick_view_button_settings_fields' ) ) {

	function addonify_quick_view_button_settings_fields() {

		return array(
			'quick_view_btn_position' => array(
				'label'       => __( 'Button Position', 'addonify-quick-view' ),
				'description' => __( 'Choose where you want to display the quick view button.', 'addonify-quick-view' ),
				'type'        => 'select',
				'dependent'   => array('enable_quick_view'),
				'placeholder' => __('Select Position', 'addonify-quick-view'),
				'choices'     => array(
					'after_add_to_cart_button'  => __( 'After Add to Cart Button', 'addonify-quick-view' ),
					'before_add_to_cart_button' => __( 'Before Add to Cart Button', 'addonify-quick-view' )
				)
			),
			'quick_view_btn_label' => array(
				'label'       => __( 'Button Label', 'addonify-quick-view' ),
				'placeholder' => __('Quick View', 'addonify-quick-view'),
				'type'        => 'text',
				'dependent'   => array('enable_quick_view'),
			)
		);
	}
}


if ( ! function_exists( 'addonify_quick_view_button_add_to_settings_fields' ) ) {
	/**
	 * General options.
	 *
	 * @return array
	 */
	function addonify_quick_view_button_add_to_settings_fields( $settings_fields ) {

		return array_merge( $settings_fields, addonify_quick_view_button_settings_fields() );
	}

	add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_button_add_to_settings_fields' );
}
