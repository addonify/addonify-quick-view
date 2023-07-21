<?php

if ( ! function_exists( 'addonify_quick_view_modal_box_content_settings_fields' ) ) {

    function addonify_quick_view_modal_box_content_settings_fields() {

        return array(
            'modal_box_content' => array(
                'label'         => __( 'Content to Display', 'addonify-quick-view' ),
                'description'   => __( 'Choose content that you want to display in quick view modal box.', 'addonify-quick-view' ),
                'type'          => 'checkbox',
                'typeStyle'     => 'buttons',
                'className'     => 'fullwidth',
                'dependent'     => array('enable_quick_view'),
                'choices'       => array(
                    'image'     => __( 'Image', 'addonify-quick-view' ),
                    'title'     => __( 'Title', 'addonify-quick-view' ),
                    'price'     => __( 'Price', 'addonify-quick-view' ),
                    'rating'    => __( 'Rating', 'addonify-quick-view' ),
                    'excerpt'   => __( 'Excerpt', 'addonify-quick-view' ),
                    'meta'      => __( 'Meta', 'addonify-quick-view' ),
                    'add_to_cart' => __( 'Add to Cart', 'addonify-quick-view' ),
                ),
                
            ),
            'product_thumbnail' => array(
                'label'         => __( 'Product Thumbnail', 'addonify-quick-view' ),
                'description'   => __( 'Choose whether you want to display single product image or gallery in quick view modal box.', 'addonify-quick-view' ),
                'type'          => 'select',
                'placeholder'   => __('Choose option', 'addonify-quick-view'),
                'dependent'     => array('enable_quick_view'),
                'choices'       => array(
                    'product_image_only'       => __( 'Product Image only', 'addonify-quick-view' ),
                    'product_image_or_gallery' => __( 'Product Image or Gallery', 'addonify-quick-view' ),
                )
            ),
            'enable_lightbox' => array(
                'label'         => __( 'Enable Lightbox', 'addonify-quick-view' ),
                'description'   => __( 'Enable lightbox for product images in quick view.', 'addonify-quick-view' ),
                'dependent'     => array('enable_quick_view'),
                'type'          => 'switch'
            ),
            'close_modal_when_esc_pressed' => array(
                'label'         => __( 'Close modal if ESC key is pressed', 'addonify-quick-view' ),
                'description'   => __( 'Enable to close modal if ESC key is pressed on keyboard.', 'addonify-quick-view' ),
                'dependent'     => array('enable_quick_view'),
                'type'          => 'switch'
            ),
            'close_modal_when_clicked_outside' => array(
                'label'         => __( 'Close modal if clicked outside', 'addonify-quick-view' ),
                'description'   => __( 'Enable to close modal if clicked outside of modal box.', 'addonify-quick-view' ),
                'dependent'     => array('enable_quick_view'),
                'type'          => 'switch'
            ),
            'modal_opening_animation' => array(
                'label'         => __( 'Modal opening animation', 'addonify-quick-view' ),
                'dependent'     => array('enable_quick_view'),
                'type'          => 'select',
                 'choices'      => array(
                    'none'              => __( 'None', 'addonify-quick-view' ),
                    'fade-in'           => __( 'Fade in', 'addonify-quick-view' ),
                    'fade-in-up'        => __( 'Fade in from up', 'addonify-quick-view' ),
                    'bounce-in'         => __( 'Bounce in', 'addonify-quick-view' ),
                    'slide-in-left'     => __( 'Slide in from left', 'addonify-quick-view' ),
                    'slide-in-right'    => __( 'Slide in from right', 'addonify-quick-view' ),
                    'zoom-in'           => __( 'Zoom in', 'addonify-quick-view' ),
                    'swing'             => __( 'Swing effect', 'addonify-quick-view' ),
                    'jello'             => __( 'Jello effect', 'addonify-quick-view' ),
                    'rubber-band'       => __( 'Rubber band effect', 'addonify-quick-view' ),
                )
            ),
            'modal_closing_animation' => array(
                'label'         => __( 'Modal closing animation', 'addonify-quick-view' ),
                'dependent'     => array('enable_quick_view'),
                'type'          => 'select',
                 'choices'      => array(
                    'none'              => __( 'None', 'addonify-quick-view' ),
                    'fade-out'          => __( 'Fade out', 'addonify-quick-view' ),
                    'fade-out-down'     => __( 'Fade out down', 'addonify-quick-view' ),
                    'bounce-out'        => __( 'Bounce out', 'addonify-quick-view' ),
                    'slide-out-left'    => __( 'Slide out to left', 'addonify-quick-view' ),
                    'slide-out-right'   => __( 'Slide out to right', 'addonify-quick-view' ),
                    'zoom-out'          => __( 'Zoom out', 'addonify-quick-view' ),
                )
            ),
            'display_read_more_button' => array(
                'label'         => __( 'Display View Detail Button', 'addonify-quick-view' ), 
                'description'   => __( 'Enable to display View Detail Button in quick view modal box.', 'addonify-quick-view' ),
                'dependent'     => array('enable_quick_view'),
                'type'          => 'switch'
            ),
             'read_more_button_label' => array(
                'label'         => __( 'View Detail Button Label', 'addonify-quick-view' ),
                'placeholder'   => __( 'View Detail', 'addonify-quick-view'), 
                'type'          => 'text',
                'dependent'     => array('enable_quick_view', 'display_read_more_button'),
            ),
        );
    }
}


if ( ! function_exists( 'addonify_quick_view_modal_box_content_add_to_settings_fields' ) ) {

    function addonify_quick_view_modal_box_content_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_modal_box_content_settings_fields() );
    }

    add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_modal_box_content_add_to_settings_fields' );
}

if ( ! function_exists( 'addonify_quick_view_modal_box_styles_settings_fields' ) ) {

    function addonify_quick_view_modal_box_styles_settings_fields() {

        return array(
            'modal_box_overlay_background_color' => array(
                'label'           => __( 'Modal overlay background', 'addonify-quick-view' ),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_box_background_color' => array(
                'label'			  => __( 'Modal box inner background', 'addonify-quick-view' ),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_box_general_text_color' => array(
                'label'			  => __( 'Text color inside modal box', 'addonify-quick-view' ),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_box_inputs_background_color' => array(
                'label'			  => __( 'Inputs background color inside modal box', 'addonify-quick-view' ),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_box_inputs_text_color' => array(
                'label'			  => __( 'Inputs text color inside modal box', 'addonify-quick-view' ),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_box_spinner_icon_color' => array(
                'label'			  => __( 'Modal box spinner icon color', 'addonify-quick-view' ),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_modal_box_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_modal_box_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_modal_box_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_modal_box_styles_add_to_settings_fields' );
}


if ( ! function_exists( 'addonify_quick_view_modal_box_content_styles_settings_fields' ) ) {

    function addonify_quick_view_modal_box_content_styles_settings_fields() {

        return array(
            'product_title_color' => array(
                'label'			  => __( 'Title text', 'addonify-quick-view'),
                'description'     => '',
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ), 
            ),
            'product_rating_star_empty_color' => array(
                'label'			  => __( 'Rating star empty', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ), 
            ),
            'product_rating_star_filled_color' => array(
                'label'			  => __( 'Rating star filled', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'product_price_color' => array(
                'label'			  => __( 'Regular price', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ), 
            ),
            'product_on_sale_price_color' => array(
                'label'			  => __( 'On-sale price', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ), 
            ),
            'product_excerpt_text_color' => array(
                'label'			  => __( 'Excerpt text', 'addonify-quick-view'),
                'description'     => '',
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth', 
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'product_meta_text_color' => array(
                'label'			  => __( 'Meta text', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'product_meta_text_hover_color' => array(
                'label'			  => __( 'Meta text on hover', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth', 
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_modal_box_content_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_modal_box_content_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_modal_box_content_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_modal_box_content_styles_add_to_settings_fields' );
}



if ( ! function_exists( 'addonify_quick_view_modal_box_close_button_styles_settings_fields' ) ) {

    function addonify_quick_view_modal_box_close_button_styles_settings_fields() {

        return array(
            'modal_close_button_text_color' => array(
                'label'			=> __( 'Default text', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth',
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_close_button_text_hover_color' => array(
                'label'			  => __( 'Text on mouse hover', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth', 
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_close_button_background_color' => array(
                'label'			  => __( 'Default background', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth', 
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
            'modal_close_button_background_hover_color' => array(
                'label'			  => __( 'Background on mouse hover', 'addonify-quick-view'),
                'type'            => 'color',
                'isAlpha'         => true,
                'className'       => 'fullwidth', 
                'dependent'       => array( 'enable_plugin_styles' ),
            ),
        );
    }
}

if ( ! function_exists( 'addonify_quick_view_modal_box_close_button_styles_add_to_settings_fields' ) ) {

    function addonify_quick_view_modal_box_close_button_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_quick_view_modal_box_close_button_styles_settings_fields() );
    }
    
    add_filter( 'addonify_quick_view_settings_fields', 'addonify_quick_view_modal_box_close_button_styles_add_to_settings_fields' );
}