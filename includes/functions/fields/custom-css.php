<?php 

if ( ! function_exists( 'addonify_quick_view_custom_css_settings_fields' ) ) {

    function addonify_quick_view_custom_css_settings_fields() {

        return array(
            'custom_css' => array(
                'label'			    => __('Additional CSS', 'addonify-quick-view' ),
                'description'       => __('If necessary, you can add your own custom CSS code from here.', 'addonify-quick-view' ),
                'type'              => 'textarea',
                'className'         => 'fullwidth custom-css-box',
                'placeholder'       => '#app { color: blue; }',
                'dependent'         => array( 'enable_plugin_styles' ),
            ),
        );
    }
}


if ( ! function_exists( 'addonify_quick_view_custom_css_add_to_settings_fields' ) ) {

    function addonify_quick_view_custom_css_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_custom_css_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_custom_css_add_to_settings_fields' );
}