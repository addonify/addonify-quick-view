<?php
if ( ! function_exists( 'addonify_quick_view_misc_button_styles_settings_fields' ) ) {

    function addonify_quick_view_misc_button_styles_settings_fields() {

        return array(
            'modal_misc_buttons_text_color' => array(
                'label'			  => __( 'Default text', 'addonify-quick-view'),
                'type'            => 'color',
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_misc_buttons_text_hover_color' => array(
                'label'			  => __( 'Text on mouse hover', 'addonify-quick-view'),
                'type'            => 'color',
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_misc_buttons_background_color' => array(
                'label'			  => __( 'Default background', 'addonify-quick-view'),
                'type'            => 'color',
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_misc_buttons_background_hover_color' => array(
                'label'			  => __( 'Background on mouse hover', 'addonify-quick-view'),
                'type'            => 'color',
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_misc_button_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_misc_button_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_misc_button_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_misc_button_styles_add_to_settings_fields' );
}