<?php
if ( ! function_exists( 'addonify_quick_view_general_settings_fields' ) ) {

    function addonify_quick_view_general_settings_fields() {

        return array(
            'enable_quick_view' => array(
                'label'			=> __( 'Enable quick view', 'addonify-quick-view' ),
                'description'     => 'Once enabled, it will be visible in product catalog.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
            ),
            'disable_quick_view_on_mobile_device' => array(
                'label'			=> __( 'Disable on mobile device', 'addonify-quick-view' ),
                'description'     => 'If this option is enabled, quick view will not work on mobile devices.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_general_add_to_settings_fields' ) ) {

    function addonify_quick_view_general_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_general_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_general_add_to_settings_fields' );
}


if ( ! function_exists( 'addonify_quick_view_general_styles_settings_fields' ) ) {

    function addonify_quick_view_general_styles_settings_fields() {

        return array(
            'enable_plugin_styles' => array(
                'label'			    => __('Enable pugin styles', 'addonify-quick-view' ),
                'description'       => __( 'Once enabled, the colors selected below will be applied to the quick view modal & elements.', 'addonify-quick-view' ),
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
    
    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_general_styles_add_to_settings_fields' );
}