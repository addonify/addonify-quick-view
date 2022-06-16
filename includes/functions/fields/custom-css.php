<?php 

if ( ! function_exists( 'addonify_quick_view_custom_css_settings_fields' ) ) {

    function addonify_quick_view_custom_css_settings_fields() {

        return array(
            'custom_css' => array(
                'label'			    => __('Custom CSS', 'addonify-quick-view' ),
                'description'       => __('If required, you may add your own custom CSS code here.', 'addonify-quick-view' ),
                'type'              => 'textarea',
            ),
        );
    }
}


if ( ! function_exists( 'addonify_quick_view_custom_css_add_to_settings_fields' ) ) {

    function addonify_quick_view_custom_css_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_custom_css_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_custom_css_add_to_settings_fields' );
}