<?php
if ( ! function_exists( 'addonify_quick_view_general_settings_fields' ) ) {

    function addonify_quick_view_general_settings_fields() {

        return array(
            'enable_quick_view' => array(
                'label'			=> __( 'Enable Quick View', 'addonify-quick-view' ),
                'description'     => 'Enable this to enable the quick view in frontend.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
            ),
            'disable_quick_view_on_mobile_device' => array(
                'label'			=> __( 'Disable on Mobile Devices', 'addonify-quick-view' ),
                'description'     => 'Enable this to disable quick view on mobile devices.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
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
                'label'			    => __('Enable Plugin Styles', 'addonify-quick-view' ),
                'description'       => __( 'Enable this to apply custom styles from plugin for quick view content.', 'addonify-quick-view' ),
                'badge'             => __('Optional', 'addonify-quick-view' ),
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