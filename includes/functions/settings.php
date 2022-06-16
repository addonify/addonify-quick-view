<?php 

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/general.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/button.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/modal-box.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/misc-buttons.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/custom-css.php';


/**
 * Define default values for the settings fields.
 * 
 * @since 1.0.7
 * @return array
 */
if ( ! function_exists( 'addonify_quick_view_settings_fields_defaults' ) ) {

    function addonify_quick_view_settings_fields_defaults() {

        return apply_filters(
            'addonify_quick_view/settings_fields_defaults',
            array(
                // Options
                'enable_quick_view' => false,
                'quick_view_btn_position' => 'after_add_to_cart_button',
                'quick_view_btn_label' => __( 'Quick view', 'addonify-quick-view' ),
                'modal_box_content' => serialize( array( 'image', 'title', 'price', 'add_to_cart', 'rating' ) ),
                'product_thumbnail' => 'product_image_only',
                'enable_lightbox' => false,
                'display_read_more_button' => false,
                'read_more_button_label' => __( 'View Detail', 'addonify-quick-view' ),
                // Styles
                'enable_plugin_styles' => false,
                'modal_box_overlay_background_color' => 'rgba(0, 0, 0, 0.8)',
                'modal_box_background_color' => 'rgba(255, 255, 255, 1)',
                'product_title_color' => 'rgba(0, 0, 0, 1)',
                'product_rating_star_empty_color' => 'rgba(147, 147, 147, 1)',
                'product_rating_star_filled_color' => 'rgba(245, 196, 14, 1)',
                'product_price_color' => 'rgba(0, 0, 0, 1)',
                'product_on_sale_price_color' => 'rgba(255, 0, 0, 1)',
                'product_excerpt_text_color' => 'rgba(0, 0, 0, 1)',
                'product_meta_text_color' => 'rgba(0, 0, 0, 1)',
                'product_meta_text_hover_color' => 'rgba(2, 134, 231, 1)',
                'modal_close_button_text_color' => 'rgba(0, 0, 0, 1)',
                'modal_close_button_text_hover_color' => 'rgba(2, 134, 231, 1)',
                'modal_close_button_background_color' => 'rgba(255, 255, 255, 0)',
                'modal_close_button_background_hover_color' => 'rgba(255, 255, 255, 0)',
                'modal_misc_buttons_text_color' => 'rgba(255, 255, 255, 1)',
                'modal_misc_buttons_text_hover_color' => 'rgba(255, 255, 255, 1)',
                'modal_misc_buttons_background_color' => 'rgba(0, 0, 0, 1)',
                'modal_misc_buttons_background_hover_color' => 'rgba(2, 134, 231, 1)',
                // Custom CSS
                'custom_css' => '',
            )
        );
    }
}


/**
 * Define settings fields.
 * 
 * @since 1.0.7
 * @return array
 */
if ( ! function_exists( 'addonify_quick_view_settings_fields' ) ) {

    function addonify_quick_view_settings_fields() {

        return apply_filters( 'addonify_quick_view/settings_fields', array() );
    }
}


/**
 * Retrieve the value of a settings field.
 * 
 * @since 1.0.7
 * @param string $setting_id
 * @return mixed 
 */
if ( ! function_exists( 'addonify_quick_view_get_setting_field_value' ) ) {

    function addonify_quick_view_get_setting_field_value( $setting_id ) {

        $defaults = addonify_quick_view_settings_fields_defaults();

        return get_option( ADDONIFY_DB_INITIALS . $setting_id, $defaults[ $setting_id ] );
    }
}


/**
 * Create and return array of setting_id and respective setting_value of settings fields.
 * 
 * @since 1.0.7
 * @return array
 */
if ( ! function_exists( 'addonify_quick_view_get_settings_fields_values' ) ) {

    function addonify_quick_view_get_settings_fields_values( $setting_id = '' ) {

        $setting_fields = addonify_quick_view_settings_fields();

        if ( $setting_id ) {
            
            return addonify_quick_view_get_setting_field_value( $setting_id );
        } else {

            $key_values = array();

            foreach ( $setting_fields as $key => $value ) {

                $field_type = $value['type'];

                switch ( $field_type ) {
                    case 'text':
                        $key_values[ $key ] = addonify_quick_view_get_setting_field_value( $key );
                        break;
                    case 'checkbox':
                        $multi = ( isset( $value[ 'multi' ] )  && $value['multi'] == true ) ? true : false;

                        if ( $multi ) {
                            $key_values[ $key ] = addonify_quick_view_get_setting_field_value( $key ) ? unserialize( addonify_quick_view_get_setting_field_value( $key ) ): [];
                        } else {
                            $key_values[ $key ] = ( addonify_quick_view_get_setting_field_value( $key ) == '1' ) ? true : false;
                        }
                        
                        break;
                    case 'select':
                        $key_values[ $key ] = ( addonify_quick_view_get_setting_field_value( $key ) == '' ) ? 'Choose value' : addonify_quick_view_get_setting_field_value( $key );
                        break;
                    default:
                        $key_values[ $key ] = addonify_quick_view_get_setting_field_value( $key );
                }     
            }  

            return $key_values;
        }
    }
}


/**
 * Updates settings fields values.
 * 
 * @since 1.0.7
 * @param array $settings_fields_values
 * @return boolean true if updated successfully, false otherwise.
 */
if ( ! function_exists( 'addonify_quick_view_update_settings_fields_values' ) ) {

    function addonify_quick_view_update_settings_fields_values( $settings_fields_values ) {

        if ( 
            is_array( $settings_fields_values ) && 
            count( $settings_fields_values ) > 0 
        ) {

            $defaults = addonify_quick_view_settings_fields_defaults();

            $settings_fields = addonify_quick_view_settings_fields();

            foreach ( $settings_fields_values as $key => $value ) {

                if ( array_key_exists( $key, $settings_fields ) ) {

                    $setting_field_type = $settings_fields[ $key ][ 'type' ];

                    switch ( $setting_field_type ) {                     
                        case 'checkbox':
                            $is_multi = ( isset( $settings_fields[ $key ][ 'multi' ] ) && $settings_fields[ $key ][ 'multi' ] == true ) ? true : false;
                            if ( $is_multi ) {
                                $sanitize_args = array(
                                    'choices' => $settings_fields[$key]['choices'],
                                    'values' => $value
                                );
                                $value = addonify_quick_view_sanitize_multi_choices( $sanitize_args );
                                $value = serialize( $value );
                            } else {
                                $value = wp_validate_boolean( $value );
                            }                        
                            break;
                        case 'text':
                            $value = sanitize_text_field( $value );
                            break;
                        case 'select':
                            $choices = $settings_fields[ $key ][ 'choices' ];
                            if ( array_key_exists( $value, $choices ) ) {
                                $value = sanitize_text_field( $value );
                            } else {
                                $value = $defaults[ $key ];
                            }
                            break;
                        default:
                            $value = sanitize_text_field( $value );
                            break;
                    }                    
                }

                if ( ! update_option( ADDONIFY_DB_INITIALS . $key, $value ) ) {
                    return false;
                }
            }

            return true;
        }
    }
}


/**
 * Define settings sections and respective settings fields.
 * 
 * @since 1.0.7
 * @return array
 */
if ( ! function_exists( 'addonify_quick_view_get_settings_fields' ) ) {

    function addonify_quick_view_get_settings_fields() {

        return array(
            'settings_values' => addonify_quick_view_get_settings_fields_values(),
            'tabs' => array(
                'settings' => array(
                    'sections' => array(
                        'general' => array(
                            'title' => __( 'General', 'addonify-quick-view' ),
                            'description' => '',
                            'fields' => addonify_quick_view_general_settings_fields(),
                        ),
                        'button' => array(
                            'title' => __('Button Options', 'addonify-quick-view' ),
                            'description' => '',
                            'fields' => addonify_quick_view_button_settings_fields(),
                        ),
                        'modal' => array(
                            'title' => __('Modal Box Options', 'addonify-quick-view' ),
                            'description' => '',
                            'fields' => addonify_quick_view_modal_box_content_settings_fields(),
                        )
                    )
                ),
                'styles' => array(
                    'sections' => array(
                        'general' => array(
                            'title' => __( 'General', 'addonify-quick-view' ),
                            'description' => '',
                            'fields' => addonify_quick_view_modal_box_styles_settings_fields(),
                        ),
                        'modal' => array(
                            'title' => __( 'Modal Box Colors', 'addonify-quick-view' ),
                            'description' => __( 'Change the colors of modal box & overlay
                                    background.', 'addonify-quick-view' ),
                            'fields' => addonify_quick_view_modal_box_styles_settings_fields(),
                        ),
                        'product' => array(
                            'title' => __( 'Product Info Colors', 'addonify-quick-view' ),
                            'description' => __( 'Change the way the product title, meta, excerpt & price looks on modal.', 'addonify-quick-view' ),
                            'fields' => addonify_quick_view_modal_box_content_styles_settings_fields(),
                        ),
                        'close_button' => array(
                            'title' => __( 'Close Button Colors', 'addonify-quick-view' ),
                            'description' => __( 'Change the look & feel of close modal box button.', 'addonify-quick-view' ),
                            'fields' => addonify_quick_view_modal_box_close_button_styles_settings_fields(),
                        ),
                        'misc_buttons' => array(
                            'title' => __( 'Miscellaneous Buttons Colors', 'addonify-quick-view' ),
                            'description' => __( 'Tweak how miscellaneous buttons look on modal box.', 'addonify-quick-view' ),
                            'fields' => addonify_quick_view_misc_button_styles_settings_fields(),
                        ),
                        'custom_css' => array(
                            'title' => __( 'Developer', 'addonify-quick-view' ),
                            'description' => '',
                            'fields' => addonify_quick_view_custom_css_settings_fields(), 
                        )
                    )
                ),
                'products' => array(
                    'recommended' => array(
                        // Recommend plugins here.
                        'content' => __( 'Coming soon....', 'addonify-quick-view' ),
                    )
                ),
            ),
        );
    }
}