<?php
if ( ! function_exists( 'addonify_quick_view_general_settings_fields' ) ) {

    function addonify_quick_view_general_settings_fields() {

        return array(
            'enable_quick_view' => array(
                'label'			=> __( 'Enable Quick View', 'addonify-quick-view' ),
                'description'     => __( 'If disabled, quick view features will be disabled completely.', 'addonify-quick-view' ),
                'type'            => 'switch',
            ),
            'disable_quick_view_on_mobile_device' => array(
                'label'			  => __( 'Disable on Mobile Devices', 'addonify-quick-view' ),
                'description'     => __( 'If enabled, quick view will be disabled on mobile devices.', 'addonify-quick-view'),
                'type'            => 'switch',
                'dependent'       => array('enable_quick_view'),
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_general_add_to_settings_fields' ) ) {

    function addonify_quick_view_general_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_general_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_general_add_to_settings_fields' );
}


if ( ! function_exists( 'addonify_quick_view_general_styles_settings_fields' ) ) {

    function addonify_quick_view_general_styles_settings_fields() {

        return array(
            'enable_plugin_styles' => array(
                'label'			    => __('Enable dymanic styles', 'addonify-quick-view' ),
                'description'       => __('Once enabled, below selected option will overwrite the default plugin stylesheet.', 'addonify-quick-view' ),
                'type'              => 'switch',
            ),
        );
    }
}


if ( ! function_exists( 'addonify_quick_view_general_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_general_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_general_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_general_styles_add_to_settings_fields' );
}