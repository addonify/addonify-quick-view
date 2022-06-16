<?php
if ( ! function_exists( 'addonify_quick_view_misc_button_styles_settings_fields' ) ) {

    function addonify_quick_view_misc_button_styles_settings_fields() {

        return array(
            'modal_misc_buttons_text_color' => array(
                'label'			  => __( 'Default text', 'addonify-quick-view'),
                'type'            => 'text',
            ),
            'modal_misc_buttons_text_hover_color' => array(
                'label'			  => __( 'Text on mouse hover', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
            'modal_misc_buttons_background_color' => array(
                'label'			  => __( 'Default background', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
            'modal_misc_buttons_background_hover_color' => array(
                'label'			  => __( 'Background on mouse hover', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_misc_button_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_misc_button_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_misc_button_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_misc_button_styles_add_to_settings_fields' );
}