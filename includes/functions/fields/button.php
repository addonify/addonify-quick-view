<?php 

if ( ! function_exists( 'addonify_quick_view_button_settings_fields' ) ) {

    function addonify_quick_view_button_settings_fields() {

        return array(
            'quick_view_btn_position' => array(
                'label' => __( 'Button position', 'addonify-quick-view' ),
                'description' => __( 'Choose where you want to show the quick view button.', 'addonify-quick-view' ),
                'type'  => 'select',
                'choices' => array(
                    'after_add_to_cart_button' => __( 'After add to cart button', 'addonify-quick-view' ),
                    'before_add_to_cart_button' => __( 'Before add to cart button', 'addonify-quick-view' )
                )
            ),
            'quick_view_btn_label' => array(
                'label' => __( 'Button label', 'addonify-quick-view' ),
                'type'  => 'text',
            )
        );
    }
}


if ( ! function_exists( 'addonify_quick_view_button_add_to_settings_fields' ) ) {

    function addonify_quick_view_button_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_button_settings_fields() );
    }

    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_button_add_to_settings_fields' );
}