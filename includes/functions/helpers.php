<?php 
/**
 * Sanitize multiple choices values.
 * 
 * @since 1.0.7
 * @param array $args
 * @return array $sanitized_values
 */
if ( ! function_exists( 'addonify_quick_view_sanitize_multi_choices' ) ) {

    function addonify_quick_view_sanitize_multi_choices( $args ) {

        if ( 
            is_array( $args['choices'] ) && 
            count( $args['choices'] ) && 
            is_array( $args['values'] ) && 
            count( $args['values'] ) 
        ) {

            $sanitized_values = array();

            foreach ( $args['values'] as $value ) {
                
                if ( array_key_exists( $value, $args['choices'] ) ) {

                    $sanitized_values[] = $value;
                }
            }

            return $sanitized_values;
        }

        return array();
    }
}



/**
 * Check if the device is mobile.
 * 
 * @since 1.1.1
 * @return boolean
 */
if ( ! function_exists( 'addonify_quick_view_is_mobile' ) ) {

    function addonify_quick_view_is_mobile() {

        if ( class_exists( 'Mobile_Detect' ) ) {

            $mobile_detect = new Mobile_Detect;

            return $mobile_detect->isMobile();
        }
    }
}


/**
 * Check if the device is tablet.
 * 
 * @since 1.1.1
 * @return boolean
 */
if ( ! function_exists( 'addonify_quick_view_is_tablet' ) ) {

    function addonify_quick_view_is_tablet() {

        if ( class_exists( 'Mobile_Detect' ) ) {

            $mobile_detect = new Mobile_Detect;

            return $mobile_detect->isTablet();
        }
    }
}