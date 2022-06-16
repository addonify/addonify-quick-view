<?php

if ( ! function_exists( 'addonify_quick_view_modal_box_content_settings_fields' ) ) {

    function addonify_quick_view_modal_box_content_settings_fields() {

        return array(
            'modal_box_content' => array(
                'label' => __( 'Content to display', 'addonify-quick-view' ),
                'description' => __( 'Which content would you like to display on quick view modal.', 'addonify-quick-view' ),
                'type'  => 'checkbox',
                'multi' => true,
                'choices' => array(
                    'image' => __( 'Image', 'addonify-quick-view' ),
                    'title' => __( 'Title', 'addonify-quick-view' ),
                    'price' => __( 'Price', 'addonify-quick-view' ),
                    'rating' => __( 'Rating', 'addonify-quick-view' ),
                    'excerpt' => __( 'Excerpt', 'addonify-quick-view' ),
                    'meta' => __( 'Meta', 'addonify-quick-view' ),
                    'add_to_cart' => __( 'Add to Cart', 'addonify-quick-view' ),
                )
            ),
            'product_thumbnail' => array(
                'label' => __( 'Product thumbnail', 'addonify-quick-view' ),
                'description' => __( 'Choose whether you want to display single product image or gallery in quick view modal.', 'addonify-quick-view' ),
                'type'  => 'select',
                'choices' => array(
                    'product_image_only' => __( 'Product image only', 'addonify-quick-view' ),
                    'product_image_or_gallery' => __( 'Product image or gallery', 'addonify-quick-view' ),
                )
            ),
            'enable_lightbox' => array(
                'label' => __( 'Enable lightbox', 'addonify-quick-view' ),
                'description' => __( 'Enable lightbox for product images in quick view modal.', 'addonify-quick-view' ),
                'type'  => 'checkbox'
            ),
            'display_read_more_button' => array(
                'label' => __( 'Display view detail button', 'addonify-quick-view' ), 
                'description' => __( 'Enable display view detail button in modal.', 'addonify-quick-view' ),
                'type'  => 'checkbox'
            ),
        );
    }
}


if ( ! function_exists( 'addonify_quick_view_modal_box_content_add_to_settings_fields' ) ) {

    function addonify_quick_view_modal_box_content_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_modal_box_content_settings_fields() );
    }

    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_modal_box_content_add_to_settings_fields' );
}

if ( ! function_exists( 'addonify_quick_view_modal_box_styles_settings_fields' ) ) {

    function addonify_quick_view_modal_box_styles_settings_fields() {

        return array(
            'modal_box_overlay_background_color' => array(
                'label'           => __( 'Modal overlay background', 'addonify-quick-view' ),
                'type'            => 'text',
            ),
            'modal_box_background_color' => array(
                'label'			  => __( 'Modal box inner background', 'addonify-quick-view' ),
                'type'            => 'text',
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_modal_box_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_modal_box_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_modal_box_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_modal_box_styles_add_to_settings_fields' );
}


if ( ! function_exists( 'addonify_quick_view_modal_box_content_styles_settings_fields' ) ) {

    function addonify_quick_view_modal_box_content_styles_settings_fields() {

        return array(
            'product_title_color' => array(
                'label'			  => __( 'Title text', 'addonify-quick-view'),
                'description'     => '',
                'type'            => 'text', 
            ),
            'product_rating_star_empty_color' => array(
                'label'			  => __( 'Rating star empty', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
            'product_rating_star_filled_color' => array(
                'label'			  => __( 'Rating star filled', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
            'product_price_color' => array(
                'label'			  => __( 'Regular price', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
            'product_on_sale_price_color' => array(
                'label'			  => __( 'On-sale price', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
            'product_excerpt_text_color' => array(
                'label'			  => __( 'Excerpt text', 'addonify-quick-view'),
                'description'     => '',
                'type'            => 'text', 
            ),
            'product_meta_text_color' => array(
                'label'			  => __( 'Meta text', 'addonify-quick-view'),
                'type'            => 'text',
            ),
            'product_meta_text_hover_color' => array(
                'label'			  => __( 'Meta text on hover', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_modal_box_content_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_modal_box_content_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_modal_box_content_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_modal_box_content_styles_add_to_settings_fields' );
}



if ( ! function_exists( 'addonify_quick_view_modal_box_close_button_styles_settings_fields' ) ) {

    function addonify_quick_view_modal_box_close_button_styles_settings_fields() {

        return array(
            'modal_close_button_text_color' => array(
                'label'			=> __( 'Default text', 'addonify-quick-view'),
                'type'            => 'text',
            ),
            'modal_close_button_text_hover_color' => array(
                'label'			  => __( 'Text on mouse hover', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
            'modal_close_button_background_color' => array(
                'label'			  => __( 'Default background', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
            'modal_close_button_background_hover_color' => array(
                'label'			  => __( 'Background on mouse hover', 'addonify-quick-view'),
                'type'            => 'text', 
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_modal_box_close_button_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_modal_box_close_button_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_modal_box_close_button_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view/settings_fields', 'addonify_quick_view_modal_box_close_button_styles_add_to_settings_fields' );
}