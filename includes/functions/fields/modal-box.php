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
            'modal_content_column_layout' => array(  
                'label'         => __( 'Content column layout inside modal', 'addonify-quick-view' ),
                'description'   => __( 'Choose how content column should appear inside the modal box.', 'addonify-quick-view' ),
                'type'          => 'radio',
                'style'         => 'images',
                'className'     => 'fullwidth',
                'dependent'     => array('enable_quick_view'),
                'choices'       => array(
                    'default'          => __( 'Default', 'addonify-quick-view' ),
                    'row-reversed'     => __( 'Row reversed', 'addonify-quick-view' ),
                ),
            ),
            'modal_content_column_gap' => array(  
                'label'         => __( 'Modal content column gap', 'addonify-quick-view' ),
                'description'   => __( 'Specify the gap for the modal content inner column in px.', 'addonify-quick-view' ),
                'placeholder'   => __( '40', 'addonify-quick-view' ),
                'type'          => 'number',
                'style'         => 'buttons-plus-minus',
                'min'           => 0,
                'max'           => 150,
                'step'          => 5,
                'dependent'     => array('enable_quick_view'),
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
            'hide_modal_close_button' => array(
                'label'         => __( 'Hide modal close button', 'addonify-quick-view' ),
                'description'   => __( 'Enable this option is you wish to hide the modal close button.', 'addonify-quick-view' ),
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
                'description'   => __( 'Choose animation effect when modal opens.', 'addonify-quick-view' ),
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
                'description'   => __( 'Choose animation effect when modal close.', 'addonify-quick-view' ),
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
            'modal_zindex' => array(
                'label'         => __( 'Modal z-index', 'addonify-quick-view' ),
                'description'   => __( 'Do not change the value unless you know what you are doing.', 'addonify-quick-view'),
                'placeholder'   => __( '10000000000000000', 'addonify-quick-view' ),
                'type'          => 'number',
                'style'         => 'buttons-arrows',
                'min'           => 0,
                'max'           => 1000000000000000000,
                'step'          => 10,
                'dependent'     => array('enable_quick_view'),
            ),
            'modal_border_radius' => array(
                'label'         => __( 'Modal border radius', 'addonify-quick-view' ),
                'description'   => __( 'Border radius of addonify quick view modal box in px.', 'addonify-quick-view'),
                'placeholder'   => __( '10', 'addonify-quick-view' ),
                'type'          => 'number',
                'style'         => 'buttons-arrows',
                'min'           => 0,
                'max'           => 100,
                'step'          => 1,
                'dependent'     => array('enable_quick_view'),
            ),
            'modal_image_radius' => array(
                'label'         => __( 'Modal image border radius', 'addonify-quick-view' ),
                'description'   => __( 'Image border radius inside modal box.', 'addonify-quick-view'),
                'placeholder'   => __( '10', 'addonify-quick-view' ),
                'type'          => 'number',
                'style'         => 'buttons-arrows',
                'min'           => 0,
                'max'           => 100,
                'step'          => 1,
                'dependent'     => array('enable_quick_view'),
            ),
            'spinner_icons'     => array(
                'label'         => __( 'Spinner icon', 'addonify-quick-view' ),
                'description'   => __( 'Choose modal spinner icon', 'addonify-quick-view' ),
                'dependent'     => array('enable_quick_view'),
                'type'          => 'radio-icons',
                'className'     => 'fullwidth', 
                'choices'       => array(
                    'icon_one'     => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C12.5523 2 13 2.44772 13 3V6C13 6.55228 12.5523 7 12 7C11.4477 7 11 6.55228 11 6V3C11 2.44772 11.4477 2 12 2ZM12 17C12.5523 17 13 17.4477 13 18V21C13 21.5523 12.5523 22 12 22C11.4477 22 11 21.5523 11 21V18C11 17.4477 11.4477 17 12 17ZM22 12C22 12.5523 21.5523 13 21 13H18C17.4477 13 17 12.5523 17 12C17 11.4477 17.4477 11 18 11H21C21.5523 11 22 11.4477 22 12ZM7 12C7 12.5523 6.55228 13 6 13H3C2.44772 13 2 12.5523 2 12C2 11.4477 2.44772 11 3 11H6C6.55228 11 7 11.4477 7 12ZM19.0711 19.0711C18.6805 19.4616 18.0474 19.4616 17.6569 19.0711L15.5355 16.9497C15.145 16.5592 15.145 15.9261 15.5355 15.5355C15.9261 15.145 16.5592 15.145 16.9497 15.5355L19.0711 17.6569C19.4616 18.0474 19.4616 18.6805 19.0711 19.0711ZM8.46447 8.46447C8.07394 8.85499 7.44078 8.85499 7.05025 8.46447L4.92893 6.34315C4.53841 5.95262 4.53841 5.31946 4.92893 4.92893C5.31946 4.53841 5.95262 4.53841 6.34315 4.92893L8.46447 7.05025C8.85499 7.44078 8.85499 8.07394 8.46447 8.46447ZM4.92893 19.0711C4.53841 18.6805 4.53841 18.0474 4.92893 17.6569L7.05025 15.5355C7.44078 15.145 8.07394 15.145 8.46447 15.5355C8.85499 15.9261 8.85499 16.5592 8.46447 16.9497L6.34315 19.0711C5.95262 19.4616 5.31946 19.4616 4.92893 19.0711ZM15.5355 8.46447C15.145 8.07394 15.145 7.44078 15.5355 7.05025L17.6569 4.92893C18.0474 4.53841 18.6805 4.53841 19.0711 4.92893C19.4616 5.31946 19.4616 5.95262 19.0711 6.34315L16.9497 8.46447C16.5592 8.85499 15.9261 8.85499 15.5355 8.46447Z"></path></svg>',
                    'icon_two'     => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/></svg>',
                    'icon_three'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.364 5.63604L16.9497 7.05025C15.683 5.7835 13.933 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12H21C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C14.4853 3 16.7353 4.00736 18.364 5.63604Z"></path></svg>',
                    'icon_four'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4C9.25144 4 6.82508 5.38626 5.38443 7.5H8V9.5H2V3.5H4V5.99936C5.82381 3.57166 8.72764 2 12 2C17.5228 2 22 6.47715 22 12H20C20 7.58172 16.4183 4 12 4ZM4 12C4 16.4183 7.58172 20 12 20C14.7486 20 17.1749 18.6137 18.6156 16.5H16V14.5H22V20.5H20V18.0006C18.1762 20.4283 15.2724 22 12 22C6.47715 22 2 17.5228 2 12H4Z"></path></svg>',
                    'icon_five'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10.9999 2.04932L11 5.07082C7.6077 5.55605 5 8.47346 5 11.9999C5 15.8659 8.13401 18.9999 12 18.9999C13.5723 18.9999 15.0236 18.4815 16.1922 17.6063L18.3289 19.7427C16.605 21.1535 14.4014 21.9999 12 21.9999C6.47715 21.9999 2 17.5228 2 11.9999C2 6.81462 5.94662 2.55109 10.9999 2.04932ZM21.9506 13C21.7509 15.011 20.9555 16.8467 19.7433 18.3282L17.6064 16.1921C18.2926 15.2759 18.7595 14.1859 18.9291 12.9999L21.9506 13ZM13.0011 2.04942C17.725 2.51895 21.4815 6.27583 21.9506 10.9998L18.9291 10.9997C18.4905 7.93446 16.0661 5.50985 13.001 5.07096L13.0011 2.04942Z"></path></svg>',
                    'icon_six'      => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                    </svg>'
                )
            ),
            'spinner_size' => array(
                'label'         => __( 'Spinner font size', 'addonify-quick-view' ),
                'description'   => __( 'Specify the font size of the modal spinner in px.', 'addonify-quick-view'),
                'placeholder'   => __( '28', 'addonify-quick-view' ),
                'type'          => 'number',
                'style'         => 'buttons-plus-minus',
                'min'           => 14,
                'max'           => 100,
                'step'          => 2,
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